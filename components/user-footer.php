<?php
// ================== DATA INIT ==================
// If categories are already available, use them
// otherwise fetch from database
$categories = $categories ?? getAllCategories();

// Base path for assets (safe fallback)
$basePath = $basePath ?? '';
?>

<!-- ================== FOOTER START ================== -->
<footer class="site-footer">

    <div class="container">

        <div class="row g-4">

            <!-- ================== BRAND SECTION ================== -->
            <div class="col-lg-4">
                <div class="footer-brand">
                    Blog<span>Sphere</span>
                </div>

                <p class="footer-desc">
                    A modern platform for content creators and readers.
                    Share your stories, ideas, and knowledge with the world.
                </p>

                <!-- Social Links -->
                <div class="footer-social mt-3">
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>

            <!-- ================== NAVIGATION LINKS ================== -->
            <div class="col-lg-2 col-6">
                <h6 class="footer-heading">Navigate</h6>

                <ul class="footer-links list-unstyled">
                    <li><a href="index.php"><i class="fas fa-chevron-right me-1"></i> Home</a></li>
                    <li><a href="search.php"><i class="fas fa-chevron-right me-1"></i> Search</a></li>
                    <li><a href="register.php"><i class="fas fa-chevron-right me-1"></i> Register</a></li>
                    <li><a href="login.php"><i class="fas fa-chevron-right me-1"></i> Login</a></li>
                </ul>
            </div>

            <!-- ================== CATEGORIES ================== -->
            <div class="col-lg-2 col-6">
                <h6 class="footer-heading">Categories</h6>

                <ul class="footer-links list-unstyled">

                    <?php if (!empty($categories)): ?>

                        <?php foreach (array_slice($categories, 0, 6) as $cat): ?>
                            <li>
                                <a href="category.php?cat=<?= urlencode($cat['category']) ?>">
                                    <i class="fas fa-chevron-right me-1"></i>
                                    <?= sanitize($cat['category']) ?>
                                </a>
                            </li>
                        <?php endforeach; ?>

                    <?php else: ?>
                        <li><small>No categories found</small></li>
                    <?php endif; ?>

                </ul>
            </div>

            <!-- ================== NEWSLETTER / CTA ================== -->
            <div class="col-lg-4">
                <h6 class="footer-heading">Stay Connected</h6>

                <p style="font-size:0.85rem; color:rgba(255,255,255,0.6);">
                    Join our community and never miss a new post.
                    Register for free today.
                </p>

                <a href="register.php"
                   class="btn btn-sm mt-2"
                   style="background:var(--accent);color:#fff;border-radius:20px;padding:0.4rem 1.2rem;font-size:0.85rem;">

                    <i class="fas fa-pen me-1"></i> Get Started
                </a>
            </div>

        </div>

        <!-- ================== BOTTOM COPYRIGHT ================== -->
        <div class="footer-bottom mt-4 text-center">

            <p>
                &copy; <?= date('Y') ?> BlogSphere.
                All rights reserved.
                Built with <i class="fas fa-heart" style="color:var(--accent);"></i>
                for writers and readers.
            </p>

        </div>

    </div>
</footer>

<!-- ================== BACK TO TOP BUTTON ================== -->
<button class="back-to-top" id="backToTop">
    <i class="fas fa-chevron-up"></i>
</button>

<!-- ================== SCRIPTS ================== -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>

<?php if (isset($csrfInline)): ?>
<script>
    const csrfToken = "<?= csrfToken() ?>";
</script>
<?php endif; ?>

<script src="<?= $basePath ?>assets/js/main.js"></script>

</body>
</html>