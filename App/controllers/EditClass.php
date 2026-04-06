
<?php

class EditClass extends Controller
{
   
public function index($class_id = null)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['USER'])) {
            redirect('login');
            exit();
        }
        
        if (!$class_id) {
            redirect('dashboard'); 
            exit();
        }

        $classModel = new ClassModel();
        $scheduleModel = new ClassScheduleModel(); 
        $objectiveModel = new ClassObjectiveModel(); 

        $class = $classModel->first([
            'class_id' => $class_id, 
        ]);

        if (!$class) {
            redirect('dashboard'); 
            exit();
        }
        
        $schedules = $scheduleModel->where(['class_id' => $class_id]);

        $objectives = $objectiveModel->where(['class_id' => $class_id]); 

        $data['class'] = $class; 
        $data['schedules'] = $schedules ?? []; 
        $data['objectives'] = $objectives ?? []; 
        
        $this->view('editClassMain', $data);
    }
    public function update($class_id = null)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['USER']) || $_SERVER['REQUEST_METHOD'] !== 'POST' || !$class_id) {
            redirect('login');
            exit();
        }

        $classModel     = new ClassModel();
        $objectiveModel = new ClassObjectiveModel();
        $scheduleModel  = new ClassScheduleModel();
       

        $class = $classModel->first([
            'class_id' => $class_id
        ]);

        if (!$class) {
            redirect('dashboard');
            exit();
        }

        $classData = [
            'class_name' => $_POST['class_name'] ?? $class->class_name,
            'subject_name' => $_POST['subject_name'] ?? $class->subject_name,
            'grade_level_name' => $_POST['grade_level_name'] ?? $class->grade_level_name,
            'type' => $_POST['type_name'] ?? $class->type,
            'category_name' => $_POST['category_name'] ?? $class->category_name,
            'description' => $_POST['description'] ?? $class->description,
            'language_name' => $_POST['language_name'] ?? $class->language_name,
            'max_students' => $_POST['max_students'] ?? $class->max_students,
            'monthly_fee' => $_POST['monthly_fee'] ?? $class->monthly_fee,
            'target_audience' => $_POST['target_audience'] ?? $class->target_audience,
            'prerequisites' => $_POST['prerequisites'] ?? $class->prerequisites,
            'welcome_message' => $_POST['public_message'] ?? $class->welcome_message,
            'congrats_message' => $_POST['congrats_message'] ?? $class->congrats_message,
            
        ];
        
        $classData = array_intersect_key($classData, array_flip($classModel->getAllowedColumns()));
        $classModel->update($class_id, $classData, 'class_id');


        
        // Delete all existing objectives for this class
        $objectiveModel->delete(['class_id' => $class_id]);

        // Insert new ones from the form
        if (!empty($_POST['learning_objectives'])) {
            foreach ($_POST['learning_objectives'] as $objective) {
                if (trim($objective) === '') continue;

                $objectiveData = [
                    'class_id' => $class_id,
                    'objective_text' => trim($objective)
                ];
                $objectiveData = array_intersect_key($objectiveData, array_flip($objectiveModel->getAllowedColumns()));
                $objectiveModel->insert($objectiveData);
            }
        }


        // Delete all existing schedules for this class
        $scheduleModel->delete(['class_id' => $class_id]);

        // Insert new ones from the form
        if (!empty($_POST['days'])) {
            foreach ($_POST['days'] as $day) {
                $start_time = $_POST['start_time_' . $day] ?? null;
                $end_time   = $_POST['end_time_' . $day] ?? null;

                if ($start_time && $end_time) {
                    $scheduleData = [
                        'class_id'   => $class_id,
                        'day_of_week' => ucfirst($day),
                        'start_time' => $start_time,
                        'end_time'   => $end_time
                    ];
                    $scheduleData = array_intersect_key($scheduleData, array_flip($scheduleModel->getAllowedColumns()));
                    $scheduleModel->insert($scheduleData);
                }
            }
        }
        redirect('EditClass/index/' . $class_id);
    }

}