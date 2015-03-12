<?php
include 'dbaccess.php';
include 'api.php';

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


class TaskAPI extends API {
    public function get() {
        $dbAccess = new DBAccess();
        $tasks = $dbAccess->getTasks();

        http_response_code(200);
        echo json_encode($tasks);
    }

    public function post() {
        $dbAccess = new DBAccess();
        $success = $dbAccess->addTask($_POST['title'], $_POST['project-id'], $_POST['desc']);

        if ($success) {
            $res = array('status' => 'success');
            http_response_code(201);
            echo json_encode($res);
        }
    }
}

$taskApi = new TaskAPI();
$taskApi->processRequest();


?>
