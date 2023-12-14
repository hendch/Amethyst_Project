<?php
session_start();
//var_dump($_SESSION);
include '../../Controller/Config.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    try {
        $db = Config::getConnexion();
        // Using prepared statement to prevent SQL injection
        $stmt = $db->prepare("SELECT user_id, username, password FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            if (password_verify($password, $row['password'])) {
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['username'] = $row['username'];
                echo "Login successful!";
                header('Location: index.html');
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "User not found or invalid password.";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
<!-- HTML form for user login -->
<form method="post" action="">
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    <input type="submit" value="Login">
    <a href="signup.php"><button type="button">Sign Up</button></a>
</form>