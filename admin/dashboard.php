<?php
@include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'] ?? null;

if(!$admin_id){
    // header('location:admin_login.php');
    $admin_id = 1;
}
$admin['name'] = "Admin";


// Total Posts
$select_posts = $conn->prepare("SELECT * FROM posts");
$select_posts->execute();
$total_posts = $select_posts->rowCount();

// Total Users
$select_users = $conn->prepare("SELECT * FROM users");
$select_users->execute();
$total_users = $select_users->rowCount();

// Total Comments
$select_comments = $conn->prepare("SELECT * FROM comments");
$select_comments->execute();
$total_comments = $select_comments->rowCount();

// Total Likes
$select_likes = $conn->prepare("SELECT * FROM likes");
$select_likes->execute();
$total_likes = $select_likes->rowCount();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="../bootstrap-5.3.8-dist/bootstrap-5.3.8-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/admin_style.css">

    
</head>

<body>

<?php include '../components/admin_header.php'; ?>

<!-- ✅ YOUR DASHBOARD CONTENT START -->


<!-- Welcome Section -->
<div class="dash-welcome">
    <div class="dash-welcome-left">
        <div class="dash-avatar">
            <?= strtoupper(substr($admin['name'], 0, 1)) ?>
        </div>
        <div>
            <h4>
                Good 
                <?= (date('H') < 12) ? 'Morning' : ((date('H') < 17) ? 'Afternoon' : 'Evening') ?>, 
                <?= explode(' ', $admin['name'])[0] ?>!
            </h4>
            <p>
                Here's your BlogSphere overview for 
                <strong><?= date('l, F j, Y') ?></strong>
            </p>
        </div>
    </div>

    <a href="add_posts.php" class="dash-new-post-btn">
        <i class="fas fa-plus"></i> New Post
    </a>
</div>

<!-- Cards -->
<div class="row mb-3">
    <div class="col-sm-6 col-xl-3">
        <div class="dash-stat-card dash-stat-blue">
            <div class="dash-stat-body">
                <div class="dash-stat-label">Total Posts</div>
                <div class="dash-stat-number"><?= $total_posts ?></div>
                <div class="dash-stat-trend"><i class="fas fa-arrow-up"></i> Published articles</div>
            </div>
            <div class="dash-stat-icon"><i class="fas fa-file-alt"></i></div>
            <div class="dash-stat-wave"></div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="dash-stat-card dash-stat-green">
            <div class="dash-stat-body">
                <div class="dash-stat-label">Registered Users</div>
                <div class="dash-stat-number"><?= $total_users ?></div>
                <div class="dash-stat-trend"><i class="fas fa-users"></i> Active members</div>
            </div>
            <div class="dash-stat-icon"><i class="fas fa-users"></i></div>
            <div class="dash-stat-wave"></div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="dash-stat-card dash-stat-amber">
            <div class="dash-stat-body">
                <div class="dash-stat-label">Total Comments</div>
                <div class="dash-stat-number"><?= $total_comments ?></div>
                <div class="dash-stat-trend"><i class="fas fa-comments"></i> Discussions</div>
            </div>
            <div class="dash-stat-icon"><i class="fas fa-comments"></i></div>
            <div class="dash-stat-wave"></div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="dash-stat-card dash-stat-red">
            <div class="dash-stat-body">
                <div class="dash-stat-label">Total Likes</div>
                <div class="dash-stat-number"><?= $total_likes?></div>
                <div class="dash-stat-trend"><i class="fas fa-heart"></i> Post reactions</div>
            </div>
            <div class="dash-stat-icon"><i class="fas fa-heart"></i></div>
            <div class="dash-stat-wave"></div>
        </div>
    </div>
</div>


<!-- JS -->
 
<script src="../bootstrap-5.3.8-dist/bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js"></script>
<!-- <script src="../js/admin_script.js"></script> -->
<!-- <script>
    function checkScriptConnection() {
  console.log(" External JS file is connected!");
}
checkScriptConnection();
</script> -->
 <script>
    document.addEventListener('DOMContentLoaded', function() {
    const toggleSidebar = document.getElementById('toggleSidebar');
    const adminSidebar = document.getElementById('adminSidebar');

    if (toggleSidebar && adminSidebar) {
        toggleSidebar.addEventListener('click', function() {
            adminSidebar.classList.toggle('show');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            if (window.innerWidth < 992 && 
                !adminSidebar.contains(event.target) && 
                !toggleSidebar.contains(event.target) &&
                adminSidebar.classList.contains('show')) {
                adminSidebar.classList.remove('show');
            }
        });
    }
});
 </script>
</body>
</html>