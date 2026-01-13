<?php

class ClassSessionsModel extends Model
{
    protected $table = "class_sessions"; 

    protected $allowedColumns = [
        'class_id',
        'title',
        'description',
        'start_time',
        'end_time',
        'session_type', 
        'place',        
        'meeting_link'  
    ];

    protected $rules = [
        'class_id'     => 'required',
        'title'        => 'required',
        'start_time'   => 'required',
        'end_time'     => 'required',
        'session_type' => 'required',
        
    ];
    
    public function validateDates($data)
    {
        parent::validateDates();
        if (strtotime($data['end_time']) <= strtotime($data['start_time'])) {
            $this->errors['end_time'] = "End time must be after start time";
            return false;
        }
        return true;
    }



public function ensureMonthlySessionsExist($class_id) {
    $scheduleModel = new ClassScheduleModel();
    

    $schedules = $scheduleModel->where(['class_id' => $class_id]);
    
    if (empty($schedules)) {
        return; 
    }

    $firstDay = date('Y-m-01');
    $monthName = date('F Y');  
    $lastDay  = date('Y-m-t');

    foreach ($schedules as $schedule) {
        $dayName = ucfirst($schedule->day_of_week);
        

        $dateString = "first $dayName of $monthName";
        $date = strtotime($dateString);
        $endDate = strtotime($lastDay);

        if (!$date) continue;

        while ($date <= $endDate) {
            $sessionDate = date('Y-m-d', $date);
            
            $cleanStartTime = date('H:i:s', strtotime($schedule->start_time));
            $cleanEndTime   = date('H:i:s', strtotime($schedule->end_time));

            $startDateTime = $sessionDate . ' ' . $cleanStartTime; 
            $endDateTime   = $sessionDate . ' ' . $cleanEndTime;

            // 4. Check Duplicates
            $query = "SELECT session_id FROM class_sessions WHERE class_id = :cid AND start_time = :stime LIMIT 1";
            $exists = $this->query($query, ['cid' => $class_id, 'stime' => $startDateTime]);

            if (empty($exists)) {
                $this->insert([
                    'class_id'     => $class_id,
                    'title'        => "Weekly Session ($dayName)",
                    'start_time'   => $startDateTime,
                    'end_time'     => $endDateTime,
                    'session_type' => 'Physical',
                    'place'        => 'Main Hall',
                    'meeting_link' => ''
                ]);
            }

            $date = strtotime('+1 week', $date);
        }
    }

}
}