<?php
session_start();

/* ====== CONFIG DB ====== */
$conn = new mysqli("localhost", "root", "", "gmail_clone");
if ($conn->connect_error) die("Erreur DB");

/* ====== ROUTING ====== */
$action = $_GET['action'] ?? '';

/* ====== REGISTER ====== */
if ($action === "register") {
    $email = $_POST['email'];
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $conn->query("INSERT INTO users (email,password) VALUES ('$email','$pass')");
    header("Location: ?");
    exit;
}

/* ====== LOGIN ====== */
if ($action === "login") {
    $email = $_POST['email'];
    $res = $conn->query("SELECT * FROM users WHERE email='$email'");
    $user = $res->fetch_assoc();

    if ($user && password_verify($_POST['password'], $user['password'])) {
        $_SESSION['user'] = $email;
    }
    header("Location: ?");
    exit;
}

/* ====== LOGOUT ====== */
if ($action === "logout") {
    session_destroy();
    header("Location: ?");
    exit;
}

/* ====== SEND MAIL ====== */
if ($action === "send") {
    $from = $_SESSION['user'];
    $to = $_POST['to'];
    $subject = $_POST['subject'];
    $body = $_POST['body'];

    $conn->query("INSERT INTO mails (sender,receiver,subject,body)
    VALUES ('$from','$to','$subject','$body')");

    header("Location: ?");
    exit;
}

/* ====== DELETE ====== */
if ($action === "delete") {
    $id = (int)$_GET['id'];
    $conn->query("DELETE FROM mails WHERE id=$id");
    header("Location: ?");
    exit;
}

/* ====== STAR ====== */
if ($action === "star") {
    $id = (int)$_GET['id'];
    $conn->query("UPDATE mails SET starred = NOT starred WHERE id=$id");
    header("Location: ?");
    exit;
}

$user = $_SESSION['user'] ?? null;
?>
