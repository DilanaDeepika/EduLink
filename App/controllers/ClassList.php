<?php

class ClassList  extends Controller
{
    public function index()
    {

        $keywords = [];
        $searchText = '';
        $sort = 'newest';

        if (!empty($_GET['query'])) {
            $searchText = trim($_GET['query']);
            if ($searchText !== '') {
                $keywords = preg_split('/\s+/', $searchText);
            }
        }

        $data = [];
        if (!empty($_GET['sort'])) {
            $sort = $_GET['sort'];
        }
        $classModel = new ClassModel();
        $teacherModel = new Teacher();
        $items = $classModel->search(['class_name','description','subject_name','category_name','language_name'],$keywords,$sort);
        
        foreach ($items as $item) {
            $teacherResult = $teacherModel->where(['teacher_id' => $item->teacher_id]);

            
            if (!empty($teacherResult)) {
                $teacher = $teacherResult[0];
                $item->teacher_name = $teacher->first_name . ' ' . $teacher->last_name;
            } else {
                $item->teacher_name = 'Unknown Teacher';
            }
        }
        
        $data['items'] = $items;
        
        $this->view('class_list',$data);
    }

}