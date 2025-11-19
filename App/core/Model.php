<?php

class Model extends Database
{
    protected $table = 'users';
    protected $limit = 10;
    protected $offset = 0;
    protected $rules = []; 
    public $validation_errors = [];

 public function search($columns, $keywords, $sort = 'newest')
{
    $conditions = [];
    $params = [];

    foreach ($keywords as $i => $word) {
        $likeParts = [];
        foreach ($columns as $col) {
            $paramKey = "{$col}_$i";
            $likeParts[] = "$col LIKE :$paramKey";
            $params[$paramKey] = "%" . $word . "%";
        }
        $conditions[] = '(' . implode(' OR ', $likeParts) . ')';
    }

    $query = "SELECT * FROM $this->table";
    if (!empty($conditions)) {
        $query .= " WHERE " . implode(' OR ', $conditions);
    }
            switch ($sort) {
            // case 'highest-rated':
            //     $query .= " ORDER BY rating DESC"; 
            //     break;
            // case 'most-reviewed':
            //     $query .= " ORDER BY review_count DESC"; 
            //     break;
            // case 'most-relevant':
            //     $query .= " ORDER BY relevance_score DESC"; 
            //     break;
            case 'newest':
            default:
                $query .= " ORDER BY created_at DESC";
                break;
    }

    return $this->query($query, $params);
}

    public function where($data, $data_not = [], $orderBy = null)
    {
        $conditions = [];
        $params = [];
        
        // Handle equal conditions (=)
        foreach ($data as $key => $value) {
            $conditions[] = "$key = :$key";
            $params[$key] = $value;
        }
        
        // Handle not equal conditions (!=)
        foreach ($data_not as $key => $value) {
            $conditions[] = "$key != :not_$key";
            $params["not_$key"] = $value;
        }
        
        // Build the query
        $query = "SELECT * FROM $this->table";
        
        if (!empty($conditions)) {
            $query .= " WHERE " . implode(' AND ', $conditions);
        }

        if (!empty($orderBy)) {
            if (!is_array($orderBy)) {
                throw new Exception("orderBy must be an associative array.");
            }

            $orderParts = [];
            foreach ($orderBy as $col => $dir) {
                $direction = strtoupper($dir) === "DESC" ? "DESC" : "ASC";
                $orderParts[] = "$col $direction";
            }

            $query .= " ORDER BY " . implode(", ", $orderParts);
        }

        // Add limit/offset if set
        if ($this->limit !== null) {
            $query .= " LIMIT $this->limit";
            if ($this->offset !== null) {
                $query .= " OFFSET $this->offset";
            }
        }

        return $this->query($query, $params);
    }
    public function first($data, $data_not = [])
    {
        $conditions = [];
        $params = [];
        
        // Handle equal conditions (=)
        foreach ($data as $key => $value) {
            $conditions[] = "$key = :$key";
            $params[$key] = $value;
        }
        
        // Handle not equal conditions (!=)
        foreach ($data_not as $key => $value) {
            $conditions[] = "$key != :not_$key";
            $params["not_$key"] = $value;
        }
        
        // Build the query
        $query = "SELECT * FROM $this->table";
        
        if (!empty($conditions)) {
            $query .= " WHERE " . implode(' AND ', $conditions);
        }
        
        // Add limit/offset if set
        if ($this->limit !== null) {
            $query .= " LIMIT $this->limit";
            if ($this->offset !== null) {
                $query .= " OFFSET $this->offset";
            }
        }

        $result = $this->query($query, $params);
        if($result)
        {
            return $result[0];
        }
        return false;

    }
public function insert($data){
    if (empty($data) || !is_array($data)) {
        return false;
    }

    $keys = array_keys($data);
    $columns = implode(',', $keys);
    $placeholders = implode(',', array_map(fn($key) => ":$key", $keys));

    $query = "INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})";

    try {
        $con = $this->connect();
        $stm = $con->prepare($query);
        $success = $stm->execute($data);

        if (!$success) {
            return false;
        }

        return $con->lastInsertId();

    } catch (PDOException $e) {
        return false;
    }
}

public function insertAndGetId($data) {
    return $this->insert($data);
}

public function update($id, $data, $id_column = 'id')
    {
        if (empty($data) || !is_array($data)) {
            // Invalid data provided
            return false;
        }

        $setClauses = [];
        $params = [];

        foreach ($data as $key => $value) {
            $setClauses[] = "`$key` = :$key";
            $params[":$key"] = $value;
        }

        $params[":" . $id_column] = $id;

        $query = "UPDATE `{$this->table}` SET " . implode(', ', $setClauses) . " WHERE `$id_column` = :$id_column";
        
        return $this->query($query, $params);
    }

    public function delete($conditions)
    {
        if (empty($conditions) || !is_array($conditions)) {
            throw new InvalidArgumentException("Conditions must be provided as an associative array.");
        }

        $whereClauses = [];
        $params = [];

        foreach ($conditions as $key => $value) {
            $whereClauses[] = "$key = :$key";
            $params[":$key"] = $value;
        }

        $query = "DELETE FROM {$this->table} WHERE " . implode(' AND ', $whereClauses);

        return $this->query($query, $params);
    }


 public function validate($data)
    {
        $this->validation_errors = []; 

        if (empty($this->rules)) {
            return true; 
        }

        foreach ($this->rules as $column => $rule_string) {
            
            $is_present = array_key_exists($column, $data);
            $value = $is_present ? $data[$column] : '';
            $rules = explode('|', $rule_string);
            
            foreach ($rules as $rule) {
                
                // 1. REQUIRED Rule
                if ($rule === 'required' && (!$is_present || $value === '' || $value === null)) {
                    $this->validation_errors[$column] = ucfirst(str_replace('_', ' ', $column)) . " is required.";
                    break; 
                }

                if ((!$is_present || $value === '' || $value === null)) {
                    continue; 
                }

                // 2. EMAIL Rule
                if ($rule === 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->validation_errors[$column] = ucfirst(str_replace('_', ' ', $column)) . " is not a valid email format.";
                } 
                
                // 3. MAX Length Rule (e.g., max:255)
                elseif (strpos($rule, 'max:') === 0) {
                    $max = (int) explode(':', $rule)[1];
                    if (strlen($value) > $max) {
                        $this->validation_errors[$column] = ucfirst(str_replace('_', ' ', $column)) . " must be less than $max characters.";
                    }
                } 
                
                // 4. MIN Length Rule (e.g., min:6)
                elseif (strpos($rule, 'min:') === 0) {
                    $min = (int) explode(':', $rule)[1];
                    if (strlen($value) < $min) {
                        $this->validation_errors[$column] = ucfirst(str_replace('_', ' ', $column)) . " must be at least $min characters.";
                    }
                }
                
                // 5. NUMERIC Rule
                elseif ($rule === 'numeric' && !is_numeric($value)) {
                    $this->validation_errors[$column] = ucfirst(str_replace('_', ' ', $column)) . " must be a number.";
                }
                
                // 6. ALPHA_DASH Rule (Letters, numbers, dashes, and underscores)
                elseif ($rule === 'alpha_dash' && !preg_match('/^[a-zA-Z0-9_-]+$/', $value)) {
                    $this->validation_errors[$column] = ucfirst(str_replace('_', ' ', $column)) . " can only contain letters, numbers, dashes, and underscores.";
                }

                if (isset($this->validation_errors[$column])) {
                    break;
                }
            }
        }
        
        return empty($this->validation_errors);
    }
    }
