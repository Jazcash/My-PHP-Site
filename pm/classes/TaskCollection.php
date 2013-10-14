<?php
require_once 'Collection.php';
require_once 'Task.php';

class TaskCollection extends Collection {
    public function addItem($task, $key = null) {
        parent::addItem($task, $key);
    }
}
?>