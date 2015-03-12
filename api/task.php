<?php
class Task {
    public $id;
    public $projectId;
    public $title;
    public $description;

    public function __construct($id, $projectId, $title, $description) {
        $this->id = $id;
        $this->projectId = $projectId;
        $this->title = $title;
        $this->description = $description;
    }
}
?>
