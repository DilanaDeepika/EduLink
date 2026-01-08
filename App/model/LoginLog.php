<?php
class LoginLog extends Model
{
    protected $table = "login_logs";
    protected $allowed_columns = ['user_id', 'login_time'];

    public function getWeeklyLoginCounts()
    {
    $sql = "SELECT 
                    DATE(login_time) as login_date, 
                    COUNT(*) as login_count 
                FROM login_logs 
                WHERE login_time >= DATE_SUB(NOW(), INTERVAL 7 DAY) 
                GROUP BY DATE(login_time) 
                ORDER BY login_date ASC";

        return $this->query($sql);
    }
}