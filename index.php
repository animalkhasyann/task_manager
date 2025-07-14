<?php include 'db.php';

// Handle adding task
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["title"])) {
    $title = $conn->real_escape_string($_POST["title"]);
    $conn->query("INSERT INTO tasks (title) VALUES ('$title')");
    header("Location: index.php");
}

// Fetch tasks
$result = $conn->query("SELECT * FROM tasks ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Task Manager</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Task Manager</h1>
    <form method="POST">
        <input type="text" name="title" placeholder="New Task" required>
        <button type="submit">Add</button>
    </form>

    <ul>
        <?php while($row = $result->fetch_assoc()): ?>
        <li>
            <?= htmlspecialchars($row["title"]) ?>
            <a href="edit.php?id=<?= $row['id'] ?>">Edit</a>
            <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this task?')">Delete</a>
        </li>
        <?php endwhile; ?>
    </ul>
</body>
</html>
