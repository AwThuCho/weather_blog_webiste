<?php
session_start();
$page_title = "Register";
require_once __DIR__ . "/../includes/header.php";
?>

<div class="container p-5" style="min-height: 90vh;">

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger w-50 m-auto text-center alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['error']; ?>
        </div>
        <?php unset($_SESSION['error']);
    endif ?>

    <form action="../actions/register_action.php" class="p-5 w-50 m-auto shadow-lg rounded-3" method="post"
        enctype="multipart/form-data">
        <h3 class="text-center text-primary mb-3">Register</h3>
        <div class="mb-3">
            <label for="">Name</label>
            <input type="text" value="<?= $_SESSION['old_name'] ?? '' ?>" class="form-control" name="name"
                placeholder="name">
        </div>
        <div class="mb-3">
            <label for="">Email</label>
            <input type="email" value="<?= $_SESSION['old_email'] ?? '' ?>" class="form-control" name="email"
                placeholder="email">
        </div>
        <div class="mb-3">
            <label for="">Password</label>
            <input type="password" value="<?= $_SESSION['old_password'] ?? '' ?>" class="form-control" id="password"
                name="password" placeholder="password">
        </div>
        <div class="mb-3">
            <label for="">Confirm Password</label>
            <input type="password" value="<?= $_SESSION['old_confirm_password'] ?? '' ?>" class="form-control"
                name="confirm_password" placeholder="confirm Password">
        </div>
        <div class="mb-3">
            <label for="">Profile Image</label>
            <input type="file" class="form-control" name="profile_picture">
        </div>
        <button type="submit" name="register" class="btn btn-primary">Register</button>
    </form>
</div>


<?php
require_once __DIR__ . "/../includes/footer.php";
?>