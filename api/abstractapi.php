<?php
abstract class API {
    protected $args;

    public function __construct($args) {
        $this->args = $args;
    }

    public function processRequest() {
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
                $this->delete();
                break;
            default:
                break;
        }
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

    public function delete() {
        http_response_code(501);
        echo json_encode(array('message' => 'operation not available'));
    }
}
?>
