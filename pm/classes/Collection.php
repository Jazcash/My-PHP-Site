<?php
require_once 'KeyInUseException.php';
require_once 'KeyInvalidException.php';
require_once 'CollectionIterator.php';

class Collection implements IteratorAggregate{
    private $_members = array();
    private $_onload;
    private $_isLoaded = false;

    public function addItem($obj, $key = null){
        $this->_checkCallback();
        if($key) {
            if(isset($this->_members[$key])) {
                throw new KeyInUseException('Key ' . $key . 'already in use!');
            } else {
                $this->_members[$key] = $obj;
            }
        } else {
            $this->_members[] = $obj;
        }
    }
    
    public function removeItem($key){
        $this->_checkCallback();
        if(isset($this->_members[$key])) {
            unset($this->_members[$key]);
        } else {
            throw new KeyInvalidException('Invalid key '. $key . '!');
        }
    }
    
    public function getItem($key){
        $this->_checkCallback();
        if(isset($this->_members[$key])) {
            return $this->_members[$key];
        } else {
            throw new KeyInvalidException('Invalid key ' . $key . '!');
        }
    }
    
    public function asArray(){
        return $_members;
    }
    
    public function keys(){
        $this->_checkCallback();
        return array_keys($this->_members);
    }
    
    public function length(){
        $this->_checkCallback();
        return sizeof($this->_members);
    }
    
    public function setLoadCallback($functionName, $objOrClass = null){
        if($objOrClass) {
            $callback = array($objOrClass, $functionName);
        } else {
            $callback = $functionName;
        }
        if(!is_callable($callback, false, $callableName)) {
            throw new Exception($callableName . ' is not callable ' . 'as a parameter to onload');
            return false;
        }
        $this->_onload = $callback;
    }
    
    private function _checkCallback(){
        if(isset($this->_onload) && !$this->_isLoaded) {
            $this->_isLoaded = true;
            call_user_func($this->_onload, $this);
        }
    }
    
    public function getIterator(){
        $this->_checkCallback();
        return new CollectionIterator($this);
    }
}
?>