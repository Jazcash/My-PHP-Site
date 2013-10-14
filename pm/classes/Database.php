<?php
require_once 'config.php';
class Database
{
    private $_mysqli;

    public function __construct(){
        global $cfg;
        $this->_mysqli = @new mysqli($cfg['db']['host'],
                                $cfg['db']['name'],
                                $cfg['db']['pass'],
                                $cfg['db']['database']);
        if ($this->_mysqli->connect_errno) {
            throw new Exception('Failed to connect to MySQL: ' . $this->_mysqli->connect_error);
        }
    }
    
    public function select($sql){
        $result = @$this->_mysqli->query($sql);
        if($this->_mysqli->errno) {
            throw new Exception($this->_mysqli->error);
        }
        $arrayReturn = array();
        while($row = $result->fetch_assoc()) {
            $arrayReturn[] = $row;
        }
        return $arrayReturn;
    }
    
    public function insert($table, $arrayFieldValues){
        $fields = array_keys($arrayFieldValues);
        $values = array_values($arrayFieldValues);
        $cleanValues = array();
        foreach ($values as $value) {
            if(!is_numeric($value)) {
                $value = '\'' . $this->_mysqli->real_escape_string($value) . '\'';
            }
            $cleanValues[] = $value;
        }
        $sql = 'INSERT INTO '. $table . '(' . join(', ', $fields) . ')' .
                ' VALUES (' . join(' ,', $cleanValues) . ')';
        $result = @$this->_mysqli->query($sql);
        if($this->_mysqli->errno) {
            throw new Exception($this->_mysqli->error);
        }
        return $this->_mysqli->affected_rows;
    }
    
    public function update($table, $arrayFieldValues, $arrayConditions){
        $arrayUpdates = array();
        foreach($arrayFieldValues as $field => $value) {
            if(!is_numeric($value)) {
                $value = '\'' . $this->_mysqli->real_escape_string($value) . '\'';
            }
            $arrayUpdates[] = $field . ' = ' . $value;
        }
        $cleanWhereConditions = array();
        foreach($arrayConditions as $field => $value) {
            if(!is_numeric($value)) {
                $value = '\'' . $this->_mysqli->real_escape_string($value) . '\'';
            }
            $cleanWhereConditions[] = $field . ' = ' . $value;
        }
        $sql = 'UPDATE ' . $table . ' SET ' . join(' ,', $arrayUpdates) .
                ' WHERE ' . join(' AND ', $cleanWhereConditions);
        $result = @$this->_mysqli->query($sql);
        if($this->_mysqli->errno) {
            throw new Exception($this->_mysqli->error);
        }
        return $this->_mysqli->affected_rows;
    }
    
    public function delete($table, $arrayConditions){
        $cleanWhereConditions = array();
        foreach ($arrayConditions as $field => $value) {
            if(!is_numeric($value)) {
                $value = '\'' . $this->_mysqli->real_escape_string($value) . '\'';
            }
            $cleanWhereConditions[] = $field . ' = ' . $value;
        }
        $sql = 'DELETE FROM ' . $table .
                ' WHERE ' . join(' AND ', $cleanWhereConditions);
        $result = @$this->_mysqli->query($sql);
        if($this->_mysqli->errno) {
            throw new Exception($this->_mysqli->error);
        }
        return $this->_mysqli->affected_rows;
    }
    
    public function escapeString($escString){
        return mysqli_real_escape_string($this->_mysqli, $escString);
    }
    
    public function __destruct(){
        $this->_mysqli->close();
    }
}
