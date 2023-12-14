<?php
include '../../Controller/Config.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    try {
        $db = Config::getConnexion();
        // Using prepared statement to prevent SQL injection
        $stmt = $db->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$username, $email, $password]);
        echo "Registration successful!";
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
<!-- HTML form for user registration -->
<form method="post" action="signup.php">
    Username: <input type="text" name="username" required><br>
    Email: <input type="email" name="email" required><br>
    Password: <input type="password" name="password" required><br>
    <input type="submit" value="Register">
    <a href="login.php"><button type="button">login</button></a>
</form>