<?php include('../includes/header.php'); ?>

<section>
    <h2>Create Todo</h2>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = $_POST['title'];
        $task = $_POST['task'];

        $todo = new TodoList();
        $todo->setTitle($title);
        $todo->setUserId($user->getId());
        $todo->addTask($task);

        if ($todo->saveToDatabase($conn)) {
            echo "<p>Todo list saved successfully.</p>";
        } else {
            echo "<p>Error saving todo list.</p>";
        }
    }
    ?>

    <form action="create_todo.php" method="post">
        <label for="title">Title:</label>
        <input type="text" name="title" required>

        <label for="task">Task:</label>
        <textarea name="task" required></textarea>

        <input type="submit" name="submit" value="Save Todo">
    </form>

</section>

<?php include('../includes/footer.php'); ?>
