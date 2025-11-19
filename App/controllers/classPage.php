<?php

class ClassPage extends Controller
{
    public function index()
    {
        // Get class_id from URL
        $class_id = $_GET['class_id'] ?? null;

        if (!$class_id) {
            die("Class ID not provided!");
        }

        $data = [];
        $classModel = new ClassModel();
        $classdetails = $classModel->where(['class_id' => $class_id]);
        $data['class_details'] = $classdetails;

        if (empty($classdetails)) {
            die("Class not found!");
        }

        
        $teacherId = $classdetails[0]->teacher_id;

        $teacherModel = new Teacher();
        $data['teacher_details'] = $teacherModel->where(['teacher_id' => $teacherId]);

        $ClassScheduleModel = new ClassScheduleModel();
        $data['Schedule_details'] = $ClassScheduleModel->where(['class_id' => $class_id]);

        $ClassObjectiveModel = new ClassObjectiveModel();
        $data['Objective_details'] = $ClassObjectiveModel->where(['class_id' => $class_id]);

        $this->view('class', $data);
    }
}

