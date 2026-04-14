<?php
// ==========================
// INCLUDE REQUIRED FILES
// ==========================
require_once 'includes/auth.php';
require_once 'includes/functions.php';

// ==========================
// PAGE INFO
// ==========================
$pageTitle = 'Home';
$pageDesc = 'Discover amazing blog posts on BlogSphere. Technology, lifestyle, travel, health and more.';

// ==========================
// PAGINATION SETTINGS
// ==========================
$perPage = 6; // posts per page

// current page (default = 1)
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;

// calculate offset for SQL
$offset = ($page - 1) * $perPage;

// ==========================
// FETCH DATA FROM DATABASE
// ==========================
$posts = getAllPosts($perPage, $offset);
$totalPosts = countAllPosts();

$totalPages = ceil($totalPosts / $perPage);

// sidebar data
$categories = getAllCategories();
$recentPosts = getRecentPosts(5);

// admin stats for hero section
$stats = getAdminStats();

// include header
include 'components/header.php';
?>

<!-- ==========================
     HERO SECTION
========================== -->
<section class="hero-section">
    <div class="container position-relative">

        <div class="row align-items-center">

            <!-- LEFT SIDE TEXT -->
            <div class="col-lg-7">

                <p class="mb-2 text-uppercase" style="color:var(--accent); font-weight:600; font-size:0.9rem;">
                    <i class="fas fa-pen-nib me-2"></i>Welcome to BlogSphere
                </p>

                <h1 class="hero-title">
                    Your Platform for <span>Stories</span>, Ideas & Knowledge
                </h1>

                <p class="hero-subtitle mt-3 mb-4">
                    Discover insightful articles written by passionate writers.
                </p>

                <!-- Buttons -->
                <div class="d-flex gap-3 flex-wrap">
                    <a href="#posts" class="btn-accent btn">
                        Explore Posts <i class="fas fa-arrow-down ms-2"></i>
                    </a>

                    <?php if (!isUserLoggedIn()): ?>
                        <a href="register.php" class="btn btn-outline-light">
                            Join Free <i class="fas fa-user-plus ms-2"></i>
                        </a>
                    <?php endif; ?>
                </div>

            </div>

            <!-- RIGHT SIDE STATS -->
            <div class="col-lg-5 d-none d-lg-block">

                <div class="d-flex gap-3">

                    <?php
                    // prepare stats array
                    $statItems = [
                        ['Posts', $stats['total_posts'], 'fas fa-file-alt'],
                        ['Users', $stats['total_users'], 'fas fa-users'],
                        ['Comments', $stats['total_comments'], 'fas fa-comments'],
                    ];

                    foreach ($statItems as $item):
                    ?>
                        <div class="hero-stat flex-fill text-center">

                            <i class="<?= $item[2] ?>" style="color:var(--accent); font-size:1.3rem;"></i>

                            <div class="stat-number">
                                <?= $item[1] ?>+
                            </div>

                            <div class="stat-label">
                                <?= $item[0] ?>
                            </div>

                        </div>
                    <?php endforeach; ?>

                </div>

                <!-- LATEST POST BOX -->
                <?php if (!empty($posts)): ?>
                    <?php $latest = $posts[0]; ?>

                    <div class="mt-3 p-3 rounded-3"
                         style="background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.12);">

                        <small style="color:var(--accent); text-transform:uppercase;">
                            <i class="fas fa-fire me-1"></i>Latest Post
                        </small>

                        <p class="mb-1 text-white fw-bold">
                            <?= sanitize($latest['title']) ?>
                        </p>

                        <a href="post.php?id=<?= $latest['id'] ?>" style="color:#ccc;">
                            Read now →
                        </a>

                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</section>

<!-- ==========================
     MAIN CONTENT
========================== -->
<div class="container my-5" id="posts">

    <div class="row g-4">

        <!-- ==========================
             POSTS SECTION
        ========================== -->
        <div class="col-lg-8">

            <!-- HEADER -->
            <div class="d-flex justify-content-between mb-4">
                <h2 class="section-title">Latest Posts</h2>
                <span><?= $totalPosts ?> articles found</span>
            </div>

            <?php if (empty($posts)): ?>

                <!-- EMPTY STATE -->
                <div class="text-center p-5">
                    <i class="fas fa-file-alt fa-2x mb-3"></i>
                    <h4>No Posts Yet</h4>
                    <p>Be the first to read new posts.</p>
                </div>

            <?php else: ?>

                <!-- POSTS LIST -->
                <div class="row g-4">

                    <?php foreach ($posts as $post): ?>

                        <div class="col-md-6">

                            <div class="post-card">

                                <!-- IMAGE -->
                                <div class="post-card-img-wrapper">

                                    <?php if (!empty($post['image'])): ?>
                                        <img src="<?= postImageUrl($post['image']) ?>" alt="">
                                    <?php else: ?>
                                        <div class="img-placeholder">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    <?php endif; ?>

                                    <span class="post-card-category">
                                        <?= sanitize($post['category']) ?>
                                    </span>

                                </div>

                                <!-- CONTENT -->
                                <div class="post-card-body">

                                    <h3>
                                        <a href="post.php?id=<?= $post['id'] ?>">
                                            <?= sanitize($post['title']) ?>
                                        </a>
                                    </h3>

                                    <p>
                                        <?= excerpt($post['content'], 150) ?>
                                    </p>

                                    <!-- META -->
                                    <div class="post-card-meta">

                                        <div>
                                            <i class="fas fa-user"></i>
                                            <?= sanitize($post['name']) ?>
                                            <br>
                                            <small><?= formatDate($post['date']) ?></small>
                                        </div>

                                        <div>
                                            ❤️ <?= $post['like_count'] ?>
                                            💬 <?= $post['comment_count'] ?>
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    <?php endforeach; ?>

                </div>

                <!-- PAGINATION -->
                <?php if ($totalPages > 1): ?>

                    <nav class="mt-4">
                        <ul class="pagination justify-content-center">

                            <!-- PREVIOUS -->
                            <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                                <a class="page-link" href="?page=<?= $page - 1 ?>">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                            </li>

                            <!-- PAGES -->
                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                                    <a class="page-link" href="?page=<?= $i ?>">
                                        <?= $i ?>
                                    </a>
                                </li>
                            <?php endfor; ?>

                            <!-- NEXT -->
                            <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : '' ?>">
                                <a class="page-link" href="?page=<?= $page + 1 ?>">
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </li>

                        </ul>
                    </nav>

                <?php endif; ?>

            <?php endif; ?>

        </div>

        <!-- ==========================
             SIDEBAR
        ========================== -->
        <div class="col-lg-4">

            <!-- CATEGORIES -->
            <div class="sidebar-widget">
                <h5>Categories</h5>

                <?php foreach ($categories as $cat): ?>
                    <a href="category.php?cat=<?= urlencode($cat['category']) ?>" class="category-badge">
                        <?= sanitize($cat['category']) ?>
                        <span><?= $cat['post_count'] ?></span>
                    </a>
                <?php endforeach; ?>

            </div>

            <!-- RECENT POSTS -->
            <div class="sidebar-widget">
                <h5>Recent Posts</h5>

                <?php foreach ($recentPosts as $rp): ?>

                    <div class="recent-post-item">

                        <?php if (!empty($rp['image'])): ?>
                            <img src="<?= postImageUrl($rp['image']) ?>" class="recent-thumb">
                        <?php endif; ?>

                        <div>
                            <a href="post.php?id=<?= $rp['id'] ?>">
                                <?= sanitize($rp['title']) ?>
                            </a>

                            <small><?= formatDate($rp['date']) ?></small>
                        </div>

                    </div>

                <?php endforeach; ?>

            </div>

            <!-- JOIN BOX -->
            <?php if (!isUserLoggedIn()): ?>
                <div class="sidebar-widget text-center">
                    <h5>Join BlogSphere</h5>
                    <p>Create account to comment & like posts</p>
                    <a href="register.php" class="btn btn-primary btn-sm">
                        Get Started
                    </a>
                </div>
            <?php endif; ?>

        </div>

    </div>
</div>

<?php include 'components/footer.php'; ?>