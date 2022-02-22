<?php

class Model {
    protected static $tableName = '';
    protected static $columns = [];
    protected $values = [];

    function __construct($arr, $sanitize = true){
        $this->loadFromArray($arr, $sanitize);
    }

    function loadFromArray($arr, $sanitize = true){
        if($arr){
            $conn = Database::connectionDB();
            foreach($arr as $key => $value){
                $cleanValue = $value;
                if($sanitize && isset($cleanValue)){
                    $cleanValue = strip_tags(trim($cleanValue)); // limpar tags html
                    $cleanValue = htmlentities($cleanValue, ENT_NOQUOTES); // substituir entidades html
                    $cleanValue = mysqli_real_escape_string($conn, $cleanValue); // prepare statement já trata, isto fica opctional
                }
                $this->$key = $cleanValue;
            }
            $conn->close();
        }
    }

    public function __set($key, $value){
        $this->values[$key] = $value;
    }

    public function __get($key){
        return $this->values[$key];
    }

    public function getValues(){
        return $this->values;
    }

    public function fixFields(){
        $valores = $this->getValues();
        foreach($valores as $key => $valor){
            $this->$key = html_entity_decode(utf8_decode($valor));
        }
    }

    function insert(){
        $sql = "INSERT INTO " . static::$tableName . "(" . implode(',', static::$columns) . ") VALUES (";
        foreach(static::$columns as $col){
            $sql .= static::FixFilter($this->$col) . ',';
        }
        $sql[strlen($sql) - 1] = ')';
        $id = Database::executeSQL($sql);
        $this->id = $id;
    }

    public function update(){
        $sql = "UPDATE " . static::$tableName . " SET ";
        foreach(static::$columns as $col){
            $sql .= " ${col} = " . static::FixFilter($this->$col) . ",";
        }
        $sql[strlen($sql) - 1] = ' ';
        $sql .= "WHERE id = {$this->id}";
        Database::executeSQL($sql);
    }

    function disableRow(){
        $sql = "UPDATE " . static::$tableName . " SET is_disabled = 1 WHERE id = {$this->id}";
        Database::executeSQL($sql);
    }
    
    function enableRow(){
        $sql = "UPDATE " . static::$tableName . " SET is_disabled = 0 WHERE id = {$this->id}";
        Database::executeSQL($sql);
    }

    public static function getOne($filters = [], $columns = '*'){
        $class = get_called_class();
        $result = static::getResultFromSelected($filters, $columns);
        return $result ? new $class($result->fetch_assoc()) : null;
    }

    public static function get($filters = [], $columns = '*'){
        $objects = [];
        $result = static::getResultFromSelected($filters, $columns);
        if($result){
            $class = get_called_class(); // nome da classe que chamou esta função. No caso User
            while($row = $result->fetch_assoc()){
                array_push($objects, new $class($row));
                // acima, o $class($row) passa o registro para o User, que passa para o Model e seu construtor (primeira coisa que fizemos nesta classe)
            }
        }
        return $objects;
    }

    public static function getMultiple($columns = [], $tables = [], $relationTablesFilter = []){
        $objects = [];
        $result = static::getResultFromSelectedMultipleTables($columns, $tables, $relationTablesFilter);
        if($result){
            $class = get_called_class();
            while($row = $result->fetch_assoc()){
                array_push($objects, new $class($row));
            }
        }
        return $objects;
    }

    public static function getResultFromSelected($filters = [], $columns = '*'){
        $sql = "SELECT ${columns} FROM " . static::$tableName . static::getFilters($filters);
        $result = Database::getResultFromQuery($sql);
        if($result->num_rows === 0){
            return null;
        } else{
            return $result;
        }
    }

    public static function getResultFromSelectedMultipleTables($columns = [], $tables = [], $relationTablesFilter = []){
        $sql = "SELECT" . static::getColumns($columns) . " FROM" . static::getTables($tables) . static::getTablesRelation($relationTablesFilter);
        $result = Database::getResultFromQuery($sql);
        if($result->num_rows === 0){
            return null;
        }
        else{
            return $result;
        }
    }

    private static function getColumns($columns){
        $sql = '';
        if(count($columns) > 0){
            foreach($columns as $table => $fields){
                foreach($fields as $field => $as){
                    $sql .= " {$table}.{$field} AS {$as},";
                }
            }
            $sql[strlen($sql) - 1] = ' ';
        }
        else{
            $sql = ' *';
        }
        return $sql;
    }

    private static function getTables($tables){
        $sql = '';
        if(count($tables) > 0){
            foreach($tables as $table){
                $sql .= " {$table},";
            }
            $sql[strlen($sql) - 1] = ' ';
        }
        return $sql;
    }

    private static function getTablesRelation($relationTablesFilter){
        $sql = '';
        if(count($relationTablesFilter) > 0){
            $sql = ' WHERE 1 = 1';
            foreach($relationTablesFilter as $relation1 => $relationFK){
                    $sql .= " AND {$relation1} = {$relationFK}";
            }
        }
        return $sql;
    }

    private static function getFilters($filters){
        $sql = '';
        if(count($filters) > 0){
            $sql = ' WHERE 1 = 1';
            foreach($filters as $key => $value){
                $sql .= " AND {$key} = " . static::FixFilter($value);
            }
        }
        return $sql;
    }

    private static function FixFilter($value){
        if(is_null($value)){
            return 'null';
        } elseif(gettype($value) === 'string'){
            return "'${value}'";
        } else{
            return $value;
        }
    }
}