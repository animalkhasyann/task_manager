<?php
include 'db.php';

if (!isset($_GET["id"])) die("ID missing");

$id = (int) $_GET["id"];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["title"])) {
    $title = $conn->real_escape_string($_POST["title"]);
    $conn->query("UPDATE tasks SET title='$title' WHERE id=$id");
    header("Location: index.php");
    exit;
}


$result = $conn->query("SELECT * FROM tasks WHERE id=$id");
$task = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Task/Tasks management</title>
</head>
<body>
    <h2>Edit</h2>
    <form method="POST">
        <input type="text" name="title" value="<?= htmlspecialchars($task['title']) ?>" >
        <button type="submit">Save</button>
    </form>
    <p>testing</p>
    <button>test</button>
</body>
</html>
