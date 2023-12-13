<?php
class TodoList {
    private $id;
    private $user_id;
    private $title;
    private $tasks = array();

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    public function addTask($task) {
        $this->tasks[] = $task;
    }

    public function saveToDatabase($conn) {
        $title = $this->title;
        $user_id = $this->user_id;
        $tasks = json_encode($this->tasks);

        $sql = "INSERT INTO todos (user_id, title, tasks) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iss", $user_id, $title, $tasks);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public static function getAllTodos($conn, $user_id) {
        $sql = "SELECT id, title FROM todos WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();

        $result = $stmt->get_result();
        $todos = $result->fetch_all(MYSQLI_ASSOC);

        return $todos;
    }

    public static function getTodoDetails($conn, $todo_id) {
        $sql = "SELECT title, tasks FROM todos WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $todo_id);
        $stmt->execute();

        $result = $stmt->get_result();
        $todoDetails = $result->fetch_assoc();

        return $todoDetails;
    }

    public static function deleteTodo($conn, $todo_id) {
        $sql = "DELETE FROM todos WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $todo_id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>
