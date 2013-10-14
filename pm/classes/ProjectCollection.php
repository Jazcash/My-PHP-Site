<?php
require_once 'Collection.php';
require_once 'Project.php';

class ProjectCollection extends Collection {
    public function addItem($project, $key = null) {
        parent::addItem($project, $key);
    }
}
?>