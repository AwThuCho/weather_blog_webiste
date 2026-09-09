<?php
session_start();
require_once __DIR__ . '/../includes/header.php';
?>


<main class="container d-flex flex-column justify-content-center align-items-center" style="min-height: 100vh;">
    <h1>Weather Blog</h1>
    <p>Welcome to the Weather Blog! Here you can find the latest weather updates and forecasts.</p>

    <div class="d-flex justify-content-center align-items-center">
        <?php if (isset($_SESSION['user_id'])): ?>
            <h2>Latest Weather Updates</h2>
            <p>Welcome <?php echo $_SESSION['username'] ?></p>
            <a href="../actions/logout.php" class="btn btn-danger">Logout</a>
        <?php else: ?>
            <a class="btn btn-primary me-2" href="../pages/login.php">Login</a>
            <a class="btn btn-secondary" href="../pages/register.php">Register</a>
        <?php endif; ?>
    </div>

</main>

<?php
require_once __DIR__ . '/../includes/footer.php';
?>