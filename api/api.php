<?php

abstract class API {
    public function processRequest() {
        $request = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];

        switch($method) {
            case "GET":
                $this->get();
                break;
            case "POST":
                $this->post();
                break;
            case "PUT":
                $this->put();
                break;
            case "DELETE":
                $this->delete($this->getId($request));
                break;
            default:
                break;
        }
    }

    private function getId($request) {
        $args = explode('/', $request);
        return $args[count($args)-1];
    }

    public function get() {
        http_response_code(501);
        echo json_encode(array('message' => 'operation not available'));
    }

    public function post() {
        http_response_code(501);
        echo json_encode(array('message' => 'operation not available'));
    }

    public function put() {
        http_response_code(501);
        echo json_encode(array('message' => 'operation not available'));
    }

    public function delete($id) {
        http_response_code(501);
        echo json_encode(array('message' => 'operation not available'));
    }
}

?>
