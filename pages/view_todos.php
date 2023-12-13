<?php include('../includes/header.php'); ?>

<section>
    <h2>View Todos</h2>

    <?php
    $todos = TodoList::getAllTodos($conn, $user->getId());

    if ($todos) {
        echo "<ul>";
        foreach ($todos as $todo) {
            echo "<li><a href='view_todos.php?todo_id={$todo['id']}'>{$todo['title']}</a></li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No todos found.</p>";
    }
    ?>

</section>

<?php include('../includes/footer.php'); ?>
