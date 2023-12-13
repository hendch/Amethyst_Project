<?php
include 'C:\xampp\htdocs\WorkshopProject\Front Office\Controller\User.php';
include 'C:\xampp\htdocs\WorkshopProject\Front Office\Model\userm.php';

$error = "";
$User = new Users();

if (isset($_GET['updatePhoneNumber'])) {
    $PhoneNumber = $_GET['updatePhoneNumber'];
    $userm = $User->showuser($PhoneNumber);

    if ($userm) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $valid = 1;

            if (
                !empty($_POST["FirstName"]) &&
                !empty($_POST["LastName"]) &&
                !empty($_POST["phone"]) &&
                !empty($_POST["email"]) &&
                !empty($_POST["username"])
            ) {
                // Your validation logic here...

                if ($valid == 1) {
                    $userToUpdate = new User(
                        $_POST["FirstName"],
                        $_POST["LastName"],
                        $_POST["phone"],
                        $_POST["email"],
                        $_POST["username"]
                    );

                    $User->updateuser($userToUpdate, $PhoneNumber);
                    header('Location: listuser.php');
                    exit;
                }
            } else {
                $error = "Missing information";
            }
        }
    } else {
        echo "User not found.";
    }
} else {
    echo "Invalid request. Please provide a user to update.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Request</title>
</head>
<body>
    <h2>Update User Information</h2>
    <?php
    if (isset($userm)) {
    ?>
        <form method="POST">
            <label for="FirstName">New First Name:</label>
            <input type="text" name="FirstName" value="<?php echo $userm['FirstName']; ?>"><br>
            <label for="LastName">New Last Name:</label>
            <input type="text" name="LastName" value="<?php echo $userm['LastName']; ?>"><br>
            <label for="phone">New Phone:</label>
            <input type="text" name="phone" value="<?php echo $userm['phone']; ?>"><br>
            <label for="email">New Email:</label>
            <input type="text" name="email" value="<?php echo $userm['email']; ?>"><br>
            <label for="username">New Username:</label>
            <input type="text" name="username" value="<?php echo $userm['username']; ?>"><br>
            <input type="submit" value="Update User">
        </form>
    <?php
    } else {
        echo "User not found.";
    }
    ?>
</body>
</html>
