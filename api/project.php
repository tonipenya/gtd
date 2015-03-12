<?php
class Project {
    public $id;
    public $title;
    public $description;

    public function __construct($id, $title, $description) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
    }
}
?>
