this is my create class
<?php

class CreateClass extends Controller
{
    public function index()
    {
        $this->view('createClassMain');
    }

    public function save_class_details()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Initialize models
            $classModel      = new ClassModel();
            $objectiveModel  = new ClassObjectiveModel();
            $scheduleModel   = new ClassScheduleModel();



            $uploadedThumbnail = handleFileUploads('image', 'thumbnail');
            $thumbnailPaths = !empty($uploadedThumbnail) ? implode(',', $uploadedThumbnail) : '';

            $uploadedTrailer = handleFileUploads('video', 'trailer');
            $TrailerPaths = !empty($uploadedTrailer) ? implode(',', $uploadedTrailer) : '';
            

            // === 1. Prepare Classes table data ===
            $classData = [
                'class_name'       => $_POST['class_name'] ?? '',
                'description'      => $_POST['description'] ?? '',
                'duration_hours'   => $_POST['duration_hours'] ?? 0,
                'subject_name'     => $_POST['subject_name'] ?? '',
                'grade_level_name' => $_POST['grade_level_name'] ?? '',
                'category_name'    => $_POST['category_name'] ?? '',
                'language_name'    => $_POST['language_name'] ?? '',
                'thumbnail_path'   => $thumbnailPaths,
                'trailer_path'     => $TrailerPaths,
                'max_students'     => $_POST['max_students'] ?? 0,
                'monthly_fee'      => $_POST['monthly_fee'] ?? 0,
                'target_audience'  => $_POST['target_audience'] ?? '',
                'prerequisites'    => $_POST['prerequisites'] ?? '',
                'welcome_message'  => $_POST['public_message'] ?? '',
                'congrats_message' => $_POST['congrats_message'] ?? '',
                'teacher_id'       => $_SESSION['USER']['teacher_id']?? 1,
                'institute_id'     => $_SESSION['USER']['institute_id'] ?? null
            ];


            // Filter only allowed columns
            $classData = array_intersect_key($classData, array_flip($classModel->getAllowedColumns()));

            // Validate class data
            if (!$classModel->validate($classData)) {
                die(json_encode(['errors' => $classModel->validation_errors]));
            }

            // Insert class
            $class_id = $classModel->insert($classData);
            if (!$class_id) {
                die('Failed to insert class');
            }

            // === 2. Insert Class Objectives ===
            if (!empty($_POST['learning_objectives'])) {
                foreach ($_POST['learning_objectives'] as $objective) {
                    if (trim($objective) === '') continue;

                    $objectiveData = [
                        'class_id'      => $class_id,
                        'objective_text'=> trim($objective)
                    ];
                    $objectiveData = array_intersect_key($objectiveData, array_flip($objectiveModel->getAllowedColumns()));

                    $objectiveModel->insert($objectiveData);
                }
            }

            // === 3. Insert Class Schedules ===
            if (!empty($_POST['days'])) {
                foreach ($_POST['days'] as $day) {
                    $start_time = $_POST['start_time_' . $day] ?? null;
                    $end_time   = $_POST['end_time_' . $day] ?? null;

                    if ($start_time && $end_time) {
                        $scheduleData = [
                            'class_id'   => $class_id,
                            'day_of_week'=> ucfirst($day),
                            'start_time' => $start_time,
                            'end_time'   => $end_time
                        ];
                        $scheduleData = array_intersect_key($scheduleData, array_flip($scheduleModel->getAllowedColumns()));
                        $scheduleModel->insert($scheduleData);
                    }
                }
            }

            // Redirect or return success
            header('Location: ' . ROOT . '/home');
            exit();
        }
   }
}