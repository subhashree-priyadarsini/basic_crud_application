<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'db.php';

$result = $conn->query("SELECT * FROM posts ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Welcome, <?php echo $_SESSION['username']; ?></h2>

<p>
   
    <a href="add_post.php">Add New Post</a> |
    <a href="logout.php">Logout</a>
</p>

<hr>

<h3>All Posts</h3>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Content</th>
        <th>Created At</th>
        <th>Actions</th>
    </tr>

    <?php while($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['title']; ?></td>
        <td><?php echo $row['content']; ?></td>
        <td><?php echo $row['created_at']; ?></td>
        <td>
            <a href="edit_post.php?id=<?php echo $row['id']; ?>">Edit</a> |
            <a href="delete_post.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this post?');">Delete</a>
        </td>
    </tr>
    <?php } ?>

</table>

</body>
</html>