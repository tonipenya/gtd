<?php
include_once 'dbaccess.php';
include_once 'abstractapi.php';
include_once 'project.php';

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
            $res = array('message' => 'success');
            http_response_code(201);
            echo json_encode($res);
        } else {
            $res = array('message' => 'error');
            http_response_code(500);
            echo json_encode($res);
        }
    }

    public function put() {
        parse_str(file_get_contents("php://input"),$put_vars);
        $dbAccess = new DBAccess();
        $project = new Project($put_vars['id'], $put_vars['title'], $put_vars['desc']);
        $success = $dbAccess->updateProject($project);

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

    public function delete() {
        $id = $this->args[0];

        $dbAccess = new DBAccess();
        $success = $dbAccess->deleteProject($id);

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
