<?php
class DBAccess {
    private $host =  'localhost';
    private $db = 'gtd';
    private $user = 'gtd';
    private $password = 'VccQMEhDEtm3zmYZ';
    private $link;

    private function open() {
        $this->link = mysql_connect($this->host, $this->user, $this->password)
        or die('Could not connect: ' . mysql_error());
        mysql_select_db($this->db) or die('Could not select database');
    }

    private function close() {
        // Closing connection
        mysql_close($this->link);
    }

    public function getProjects() {
        $this->open();

        $query = 'SELECT * FROM project';
        $result = mysql_query($query) or die('Query failed: ' . mysql_error());

        $projects = array();
        while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
            $projects[] = new Project($line['id'], $line['title'], $line['description']);
        }

        // Free resultset
        mysql_free_result($result);
        $this->close();

        return $projects;
    }

    public function getTasks() {
        $this->open();

        $query = 'SELECT * FROM task';
        $result = mysql_query($query) or die('Query failed: ' . mysql_error());

        $tasks = array();
        while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
            $tasks[] = new Task($line['id'], $line['id_project'], $line['title'], $line['description']);
        }

        // Free resultset
        mysql_free_result($result);
        $this->close();

        return $tasks;
    }

    public function addProject($title, $description) {
        $this->open();

        $query = "INSERT INTO project (title, description) VALUES ('$title', '$description')";
        $result = mysql_query($query) or die('Query failed: ' . mysql_error());

        $this->close();

        return $result;
    }

    public function addTask($title, $projectId, $description) {
        $this->open();

        $query = "INSERT INTO task (title, id_project, description) VALUES ('$title', $projectId, '$description')";
        $result = mysql_query($query) or die('Query failed: ' . mysql_error());

        $this->close();

        return $result;
    }

    public function deleteProject($id) {
        $this->open();

        $query = "DELETE FROM project WHERE id = $id";
        $result = mysql_query($query) or die('Query failed: ' . mysql_error());

        $this->close();

        return $result;
    }
}
?>
