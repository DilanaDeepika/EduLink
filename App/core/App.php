<?php
class App
{
    private $controller = 'Home';
    private $method = 'index';
    private $params = []; // Add this property
    
    private function splitURL()
    {
        $URL = $_GET['url'] ?? 'home';
        $URL = explode("/", trim($URL, "/"));
        return $URL;
    }

    public function loadController()
    {
        $URL = $this->splitURL();
        
        // --- 1. Find the Controller ---
        // Uses 'App' (capital A) to match your folder
        $filename = "../App/controllers/" . ucfirst($URL[0]) . ".php";
        
        if(file_exists($filename))
        {
            require $filename;
            $this->controller = ucfirst($URL[0]);
            unset($URL[0]);
        }
        else
        {
            $filename = "../App/controllers/_404.php";
            require $filename;
            $this->controller = "_404";
        }

        // Create the controller object
        $controller = new $this->controller;

        // --- 2. THIS IS THE FIX ---
        // Find the Method in the URL
        if (!empty($URL[1])) {
            // Check if the method (e.g., 'save_student_details') exists in the controller
            if (method_exists($controller, $URL[1])) {
                $this->method = $URL[1];
                unset($URL[1]);
            }
        }
        // ---------------------------------

        // --- 3. Get the Parameters ---
        // Any remaining parts of the URL are parameters
        $this->params = array_values($URL);
        
        // --- 4. Call the method with its parameters ---
        // This will now call $controller->save_student_details()
        call_user_func_array([$controller, $this->method], $this->params);
    }
}