<?php
@include '../components/connect.php';
require_once './includes/functions.php';
session_start();

$admin_id = $_SESSION['admin_id'];
if (!isset($admin_id)) {
    header('location:admin_login.php');
}

$query = $_GET['q'] ?? '';
$posts = [];

if (!empty($query)) {
    $posts = searchPosts($query, 10, 0);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Post</title>

    <!-- CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="./bootstrap-5.3.8-dist/bootstrap-5.3.8-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/adminStyle.css">


</head>

<body>
    <?php include './components/admin_header.php'; ?>

<h2>Search Posts</h2>

<form method="GET">
    <input type="text" name="q" placeholder="Search..." value="<?= $query ?>">
    <button type="submit">Search</button>
</form>

<hr>

<?php if (empty($query)): ?>
    <p>Enter something to search 🔍</p>

<?php elseif (empty($posts)): ?>
    <p>No results found ❌</p>

<?php else: ?>
    
    <?php foreach ($posts as $post): ?>
        <div style="margin-bottom:20px;">
            <h3><?= htmlspecialchars($post['title']) ?></h3>
            <p><?= substr(htmlspecialchars($post['content']), 0, 100) ?>...</p>
            
            <small>
                By <?= $post['name'] ?> |
                <?= $post['date'] ?> |
                ❤️ <?= $post['like_count'] ?> |
                💬 <?= $post['comment_count'] ?>
            </small>

            <br>
            <a href="post.php?id=<?= $post['id'] ?>">Read More</a>
        </div>
    <?php endforeach; ?>

<?php endif; ?>




    <!-- JS -->

    <script src="./bootstrap-5.3.8-dist/bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="./js/adminScript.js"></script>


</body>

</html>