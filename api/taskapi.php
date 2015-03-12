<?php
include_once 'abstractapi.php';
include_once 'dbaccess.php';
include_once 'task.php';

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
            $res = array('message' => 'success');
            http_response_code(201);
            echo json_encode($res);
        } else {
            $res = array('message' => 'error');
            http_response_code(500);
            echo json_encode($res);
        }

    }
}
?>
