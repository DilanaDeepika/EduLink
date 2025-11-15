<?php

class Database
{
    protected function connect()
    {
        $string = "mysql:host=".DBHOST.";dbname=".DBNAME;
        try {
            $con = new PDO($string, DBUSER, DBPASS);
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $con;
        } catch(PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
 public function query($query, $data = [])
{
    $con = $this->connect();
    $stm = $con->prepare($query);

    $check = $stm->execute($data);

    if ($check)
    {
        $isSelectQuery = (strpos(strtoupper(trim($query)), 'SELECT') === 0);

        if ($isSelectQuery)
        {
            $result = $stm->fetchAll(PDO::FETCH_OBJ);
            
            if (is_array($result))
            {
                return $result; 
            }
        } else {
            return true;
        }
    }

    return false;
}

}





