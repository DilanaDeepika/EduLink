<?php
class LoginLog extends Model
{
    protected $table = "login_logs";
    protected $allowed_columns = ['user_id', 'login_time'];

    public function getWeeklyLoginCounts()
    {
        $sql = "
            SELECT 
                DAYNAME(login_time) AS day,
                COUNT(*) AS count
            FROM login_logs
            GROUP BY DAYOFWEEK(login_time)
            ORDER BY DAYOFWEEK(login_time)
        ";

        return $this->query($sql);
    }
}