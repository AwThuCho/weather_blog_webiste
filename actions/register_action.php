<?php
session_start();

require_once __DIR__ . "/../config/db.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../pages/register.php");
    exit;
}

$name = trim($_POST['name']);
$email = trim($_POST['email']);
$password = trim($_POST['password']);
$confirm_password = trim($_POST['confirm_password']);
$profile_picture = $_FILES['profile_picture'];
$photo = $_FILES['profile_picture'];
$photo = time() . $_FILES['profile_picture']['name'];
$tmp_name = $_FILES['profile_picture']['tmp_name'];
move_uploaded_file($tmp_name, "../public/images/profiles/" . $photo);

//store old value
$_SESSION['old_name'] = $name;
$_SESSION['old_email'] = $email;
$_SESSION['old_password'] = $password;
$_SESSION['old_confirm_password'] = $confirm_password;

if (empty($name) || empty($email) || empty($password) || empty($confirm_password) || empty($profile_picture)) {
    $_SESSION['error'] = "All fields are required.";
    header("Location: ../pages/register.php");
    exit;
}

if ($password !== $confirm_password) {
    $_SESSION['error'] = "Passwords do not match.";
    header("Location: ../pages/register.php");
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = "Invalid email format.";
    header("Location: ../pages/register.php");
    exit;
}

if (strlen($name) < 4) {
    $_SESSION['error'] = "Name must be at least 4 characters long.";
    header("Location: ../pages/register.php");
    exit;
}

if (strlen($password) < 6) {
    $_SESSION['error'] = "Password must be at least 6 characters long.";
    header("Location: ../pages/register.php");
    exit;
}

try {
    $qry = "SELECT * FROM users WHERE email = ?";
    $stmt = $pdo->prepare($qry);
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        $_SESSION['error'] = "Email already exists.";
        header("Location: ../pages/register.php");
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $qry = "INSERT INTO users (name, email, password, profile_picture) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($qry);
    $stmt->execute([$name, $email, $hashed_password, $photo]);

    $_SESSION['success'] = "Registration successful. Please log in.";
    header("Location: ../pages/login.php");
    exit;

} catch (\Throwable $th) {
    $_SESSION['error'] = "An error occurred while checking the email. Register Failed!";
    header("Location: ../pages/register.php");
    exit;

}


?>