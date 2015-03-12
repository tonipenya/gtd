<?php
include 'dbaccess.php';

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

$method = $_SERVER['REQUEST_METHOD'];

switch($method) {
    case "GET":
        get();
        break;
    case "POST":
        post();
        break;
    default:
        break;
}

function get() {
    $dbAccess = new DBAccess();
    $projects = $dbAccess->getProjects();
    echo json_encode($projects);
}

function post() {
    $dbAccess = new DBAccess();
    $success = $dbAccess->addProject($_POST['title'], $_POST['desc']);

    if ($success) {
        $res = array('status' => 'success');
        echo json_encode($res);
    }
}


?>
