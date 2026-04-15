<?php
// ================== CORE INCLUDES ==================
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/functions.php';

// ================== USER + DATA ==================
$currentUser = getCurrentUser();
$categories   = getAllCategories();
$flash        = getFlash();

// Base path (useful if project is in subfolder)
$basePath = '';

// Page variables (set from each page like index.php, post.php)
$pageTitle = $pageTitle ?? 'BlogSphere - Share Your Story';
$pageDesc  = $pageDesc ?? 'BlogSphere - A modern blogging platform for content creators and readers.';
?>
<!DOCTYPE html>
<html lang="en">

<!-- ================== HEAD SECTION ================== -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= sanitize($pageTitle) ?> - BlogSphere</title>
    <meta name="description" content="<?= sanitize($pageDesc) ?>">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap & Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="<?= $basePath ?>css/style.css">
</head>

<body>

    <!-- ================== NAVBAR ================== -->
    <nav class="navbar navbar-blogsphere navbar-expand-lg">
        <div class="container">

            <!-- Logo -->
            <a class="navbar-brand" href="<?= $basePath ?>index.php">
                Blog<span>Sphere</span>
            </a>

            <!-- Mobile Toggle -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu -->
            <div class="collapse navbar-collapse" id="navMenu">

                <!-- LEFT MENU -->
                <ul class="navbar-nav me-auto ms-3">

                    <!-- Home -->
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $basePath ?>index.php">
                            <i class="fas fa-home me-1"></i> Home
                        </a>
                    </li>

                    <!-- Categories (show only first 5) -->
                    <?php foreach (array_slice($categories, 0, 5) as $cat): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $basePath ?>category.php?cat=<?= urlencode($cat['category']) ?>">
                                <?= sanitize($cat['category']) ?>
                            </a>
                        </li>
                    <?php endforeach; ?>

                </ul>

                <!-- SEARCH BAR -->
                <form class="d-flex me-3" action="<?= $basePath ?>search.php" method="GET">
                    <input
                        type="search"
                        name="q"
                        class="form-control"
                        placeholder="Search posts..."
                        value="<?= sanitize($_GET['q'] ?? '') ?>">
                    <button class="btn btn-dark ms-2" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </form>

                <!-- RIGHT SIDE (USER AREA) -->
                <div class="d-flex align-items-center gap-2">

                    <?php if ($currentUser): ?>

                        <!-- Logged in user dropdown -->
                        <div class="dropdown">

                            <a class="nav-link dropdown-toggle d-flex align-items-center gap-2"
                                href="#"
                                data-bs-toggle="dropdown">

                                <span class="user-avatar">
                                    <?= strtoupper(substr($currentUser['name'], 0, 1)) ?>
                                </span>

                                <span>
                                    <?= sanitize($currentUser['name']) ?>
                                </span>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end">

                                <li>
                                    <a class="dropdown-item" href="<?= $basePath ?>profile.php">
                                        <i class="fas fa-user me-2"></i> Profile
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item" href="<?= $basePath ?>liked.php">
                                        <i class="fas fa-heart me-2"></i> Liked Posts
                                    </a>
                                </li>

                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                <li>
                                    <a class="dropdown-item text-danger" href="<?= $basePath ?>logout.php">
                                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                                    </a>
                                </li>

                            </ul>
                        </div>

                    <?php else: ?>

                        <!-- Guest buttons -->
                        <a href="<?= $basePath ?>login.php" class="btn btn-outline-light btn-sm">
                            Login
                        </a>

                        <a href="<?= $basePath ?>register.php" class="btn btn-primary btn-sm">
                            Register
                        </a>

                    <?php endif; ?>

                </div>
            </div>
        </div>
    </nav>

    <!-- ================== FLASH MESSAGE ================== -->
    <?php if (!empty($flash)): ?>
        <div class="container mt-3">
            <div class="alert alert-<?= $flash['type'] === 'error' ? 'danger' : $flash['type'] ?> alert-dismissible fade show">
                <?= sanitize($flash['message']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    <?php endif; ?>