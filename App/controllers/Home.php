<?php

class Home extends Controller
{
    public function index()
    {
        $data = [];
        
        // Check if the user is logged in by looking at the session
        if (isset($_SESSION['user_id'])) {
            
            $user_id = $_SESSION['user_id'];
            
            // --- THIS IS THE FIX ---
            // Changed 'user_type' to 'user_role' to match your session
            $user_type = $_SESSION['user_role'];
            // -----------------------
            
            
            // Now, get the user's *full* details
            $specific_model = null;

            if ($user_type === 'student') {
                $specific_model = new Student();
            } elseif ($user_type === 'teacher') {
                $specific_model = new Teacher();
            } elseif ($user_type === 'institute') {
                $specific_model = new Institute();
            }
            
            // Find the user by their 'account_id'
            if ($specific_model) {
                $data['user'] = $specific_model->first(['account_id' => $user_id]);
            }
        }

        //Hero Adveritising
        $ad= new AdvertisementRequest();
        $approvedAds = $ad->findAdsWithPriority();
        $data['approved_ads']=$approvedAds;
        

        $classModel   = new ClassModel();
        $teachers= new Teacher();

        //Priority Classes
        $priority= new ClassPriority();
        $priorityItems=$priority->query("SELECT * FROM classes_priority ORDER BY priority_order  ASC");

        $priorityClasses=[];
        foreach($priorityItems as $priority_item){
            $classobj=$classModel->first(['class_id'=>$priority_item->class_id]);

            if($classobj){
                $teacher = $teachers->first(['teacher_id' => $classobj->teacher_id]);

                $classobj->teacher_name = $teacher
                    ? $teacher->first_name . ' ' . $teacher->last_name
                    : 'Unknown';

                $priorityClasses[] = $classobj;

            }
        }
        $data['priority_classes'] = $priorityClasses;

        //Classes Filtering
        $subject=$_GET['subject'] ?? null;

        if ($subject) {
            $subject = str_replace('_', ' ', $subject);
        }

        $items = $classModel->getClasses($subject);
        

        foreach($items as $class){
            
            $teacher=$teachers->first(['teacher_id'=>$class->teacher_id]);
            $class->teacher_name = $teacher ? $teacher->first_name.' '.$teacher->last_name: 'Unknown';
        }

        $data['subject_classes']=$items;

        //Priority institutes
        $instituteModel = new Institute();
        $priorityInstitutes = $instituteModel->getPriorityInstitutes(5); // method in model
        $data['priorityInstitutes'] = $priorityInstitutes;


        


        $this->view('home', $data);
    
    }
    
    
    

    

}