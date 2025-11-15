<?php
class Controller
{
    public function view($name, $data = [])
    {    
        $fileName = "../app/views/".$name.".view.php";

        if (file_exists($fileName)) {
            // Extract the data array to individual variables
            extract($data);

            require $fileName;
        } else {
            $fileName = "../app/views/404.view.php";
            require $fileName;
        }
    }
}
