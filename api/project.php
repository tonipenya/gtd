<?php
include 'dbaccess.php';
include 'api.php';

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

class ProjectAPI extends API {
    public function get() {
        $dbAccess = new DBAccess();
        $projects = $dbAccess->getProjects();
        http_response_code(200);
        echo json_encode($projects);
    }

    public function post() {
        $dbAccess = new DBAccess();
        $success = $dbAccess->addProject($_POST['title'], $_POST['desc']);

        if ($success) {
            $res = array('status' => 'success');
            http_response_code(201);
            echo json_encode($res);
        }
    }

    public function delete($id) {
        $dbAccess = new DBAccess();
        $success = $dbAccess->deleteProject($id);

        if ($success) {
            $res = array('status' => 'success');
            http_response_code(201);
            echo json_encode($res);
        }
    }
}

$projectApi = new ProjectAPI();
$projectApi->processRequest();

?>
