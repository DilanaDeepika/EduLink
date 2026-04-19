<?php

class PapersModel extends Model
{
    protected $table = 'papers';

    protected $rules = [
        'class_id'    => 'required|integer',
        'title'       => 'required|max:255',
        'is_released' => 'integer',
    ];


    protected $allowedColumns = [
        'class_id',
        'title',
        'is_released',
        'created_at'
    ];

    

    
    public function countReleasedPapersByClass($class_id)
    {
        $sql = "SELECT COUNT(*) as total 
                FROM {$this->table} 
                WHERE class_id = :class_id 
                AND is_released = 1";

        $result = $this->query($sql, ['class_id' => $class_id]);

        return $result[0]->total ?? 0;
    }

    

}
