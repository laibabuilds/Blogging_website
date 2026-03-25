<?php
@include __DIR__ . '/connect.php';

if(session_status() === PHP_SESSION_NONE){
    session_start();
}

// Dummy admin (for now)
$currentAdmin = [
    'name' => 'Admin'
];

// current page
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!-- SIDEBAR -->
<aside class="admin-sidebar" id="adminSidebar">

    <a href="dashboard.php" class="sidebar-brand">
        Blog<span class="text-warning">Sphere</span>
        <span class="admin-text">ADMIN PANEL</span>
    </a>

    <nav class="sidebar-menu">

        <div class="menu-label">Main</div>
        <a href="dashboard.php" class="<?= ($current_page == 'dashboard.php') ? 'active' : '' ?>">
            <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>

        <div class="menu-label">Content</div>
        <a href="view_posts.php" class="<?= ($current_page == 'view_posts.php') ? 'active' : '' ?>">
            <i class="fas fa-file-alt"></i> View Posts
        </a>

        <a href="add_posts.php" class="<?= ($current_page == 'add_posts.php') ? 'active' : '' ?>">
            <i class="fas fa-plus-circle"></i> Add New Post
        </a>

        <!-- <a href="comments.php" class="">
            <i class="fas fa-comments"></i> Comments
        </a> -->

        <!-- <div class="menu-label">Users</div>
        <a href="users.php" class="">
            <i class="fas fa-users"></i> User Accounts
        </a> -->

        <div class="menu-label">Admin</div>
        <a href="admins.php" class="<?= ($current_page == 'admins.php') ? 'active' : '' ?>">
            <i class="fas fa-user-shield"></i> Admin Accounts
        </a>

        <a href="update_profile.php" class="<?= ($current_page == 'update-account.php') ? 'active' : '' ?>">
            <i class="fas fa-user-cog"></i> Update Account
        </a>

        <div class="menu-label">Website</div>
        <a href="../home.php" target="_blank">
            <i class="fas fa-external-link-alt"></i> View Website
        </a>

        <a href="../components/admin_logout.php" class="text-danger">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>

    </nav>
</aside>


<!-- MAIN AREA -->
<div class="admin-main">

    <!-- TOPBAR -->
   <div class="admin-topbar">
    <div class="d-flex align-items-center gap-3">

        <!-- Toggle Button (mobile only) -->
        <button class="sidebar-toggle d-lg-none" id="toggleSidebar">
    <i class="fas fa-bars"></i>
</button>

        <!-- Breadcrumb -->
        <div class="fw-semibold text-muted small">
            Dashboard / Dashboard
        </div>
    </div>

    <div class="d-flex align-items-center gap-3">

        <a href="../index.php" target="_blank" class="btn btn-sm view-site-btn">
            <i class="fas fa-eye"></i> View Site
        </a>

        <div class="d-flex align-items-center gap-2">
            <div class="user-avatar">A</div>
            <span class="fw-medium">admin</span>
        </div>

    </div>
</div>

    