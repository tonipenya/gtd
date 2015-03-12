<?php
include 'dbaccess.php';

class Task {
    public $id;
    public $projectId;
    public $title;

    public function __construct($id, $projectId, $title) {
        $this->id = $id;
        $this->projectId = $projectId;
        $this->title = $title;
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
    $tasks = $dbAccess->getTasks();

    echo json_encode($tasks);
}

function post() {
    $dbAccess = new DBAccess();
    $success = $dbAccess->addTask($_POST['title'], $_POST['project-id'], $_POST['desc']);

    if ($success) {
        $res = array('status' => 'success');
        echo json_encode($res);
    }
}


?>
