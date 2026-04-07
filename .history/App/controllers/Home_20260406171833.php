<?php

class Home extends Controller
{
    private $categories = ['Physics','Chemistry','Combined Mathematics','ICT','Accounting','Economics','Business Studies','Political Science'];

public function index()
    {
        $classModel = new ClassModel();
        
        $teacherModel = new Teacher();

        $adModel = new AdvertisementRequest();
        
        $all_class_details = []; 

        $ad_details = [];

        foreach($this->categories as $item){
            
            $result = $classModel->where(['subject_name' => $item]);

            if(!empty($result)){

                foreach($result as $key => $row) {
                    
                    $teacherId = $row->teacher_id;

                    $teacherData = $teacherModel->first(['teacher_id' => $teacherId]);

                   
                    if ($teacherData) {
                        $result[$key]->teacher_name = $teacherData->first_name . ' ' . $teacherData->last_name;
                        

                    } else {
  
                        $result[$key]->teacher_name = 'Unknown Teacher';
                    }
                }

                $all_class_details[$item] = $result;
            }
        }


        $currentDateTime = date('Y-m-d H:i:s');
        $adModel = new AdvertisementRequest(); // Create model once

        // --- 1. GET CLASS SECTION ADS ---
        $classAdsRaw = $adModel->where([
            'placement_option' => 'homepage_class_section',
            'status'           => 'Active'
        ]);

        $validClassAds = [];
        if ($classAdsRaw) {
            foreach ($classAdsRaw as $ad) {
                if ($ad->start_datetime <= $currentDateTime && $ad->end_datetime >= $currentDateTime) {
                    $validClassAds[] = $ad;
                }
            }
        }

        $sponsoredClasses = [];

        if (!empty($validClassAds)) {
            foreach ($validClassAds as $ad) {
                if (!empty($ad->class_id)) {
                    
                    $classData = $classModel->where(['class_id' => $ad->class_id]);

                    

                    if (!empty($classData)) {
                        $classObject = $classData[0];
                        
                        $classObject->ad_id = $ad->id; 


                        $teacherId = $classObject->teacher_id;
                        $teacherData = $teacherModel->first(['teacher_id' => $teacherId]);

                        if ($teacherData) {
                            $classObject->teacher_name = $teacherData->first_name . ' ' . $teacherData->last_name;
                        } else {
                            $classObject->teacher_name = 'Unknown Teacher';
                        }
                        
                        $sponsoredClasses[] = $classObject;
                    }
                }
            }
        }
        // SAVE TO 'class_ads' 
        $data['class_ads'] = $sponsoredClasses;

        // echo "<pre>";
        // print_r($data['class_ads']);
        // echo"</pre>";
        // die();


        // --- 2. GET HERO POSTER ADS ---
        $heroAdsRaw = $adModel->where([
            'placement_option' => 'homepage_poster',
            'status'           => 'Active'
        ]);

        $validHeroAds = [];
        if ($heroAdsRaw) {
            foreach ($heroAdsRaw as $ad) {
                if ($ad->start_datetime <= $currentDateTime && $ad->end_datetime >= $currentDateTime) {
                    $validHeroAds[] = $ad;
                }
            }
        }
        // SAVE TO 'hero_ads'
        $data['hero_ads'] = $validHeroAds;




        // echo "<pre>";
        // print_r( $data['hero_ads']);
        // echo"</pre>";
        // die();


        $data['all_class_details'] = $all_class_details;
    
        
        if (isset($_SESSION['user_id'])) {
            
            $user_id = $_SESSION['user_id'];
            
            $user_type = $_SESSION['user_role'];
            
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

<<<<<<< HEAD
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


        


=======
        // Pass the $data array (with or without user info) to the view
>>>>>>> cd8da66b64513e155fc3e34dabfbdd3dbee0a981
        $this->view('home', $data);
    
    }
    
    
    

    

}