<?php
include_once 'projectapi.php';
include_once 'taskapi.php';

class APIFactory {
    static function getAPI() {
        $request = $_SERVER['REQUEST_URI'];
        $args = explode('/', $request);

        while(count($args) > 0 && array_shift($args) != 'api.php'){
            continue;
        }

        $resource = array_shift($args);

        switch($resource) {
            case 'project':
                return new ProjectAPI($args);
                break;
            case 'task':
                return new TaskAPI($args);
                break;
            default:
                return NULL;
        }
    }
}
?>
