<?php
session_start();
?>

<?php
if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success w-50 m-auto text-center alert-dismissible fade show" role="alert">
        <?php echo $_SESSION['success']; ?>
    </div>
    <?php unset($_SESSION['success']);
endif ?>