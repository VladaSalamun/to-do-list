<?php include('../includes/header.php'); ?>

<section>
    <h2>Delete Todo</h2>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $todo_id = $_POST['todo_id'];

        if (TodoList::deleteTodo($conn, $todo_id)) {
            echo "<p>Todo list deleted successfully.</p>";
        } else {
            echo "<p>Error deleting todo list.</p>";
        }
    }
    ?>

    <form action="delete_todo.php" method="post">
        <label for="todo_id">Select Todo to Delete:</label>
        <select name="todo_id">
            <?php
            $todos = TodoList::getAllTodos($conn, $user->getId());
            foreach ($todos as $todo) {
                echo "<option value='{$todo['id']}'>{$todo['title']}</option>";
            }
            ?>
        </select>

        <input type="submit" name="submit" value="Delete Todo">
    </form>

</section>

<?php include('../includes/footer.php'); ?>
