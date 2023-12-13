<?php
include "../controller/User.php";

$c = new Users();

// Check if a search term is provided
if (isset($_GET["searchTerm"])) {
    $searchTerm = $_GET["searchTerm"];
    $tab = $c->searchUsers($searchTerm);
} else {
    // If no search term, redirect to the main listuser.php page
    header("Location: listuser.php");
    exit();
}
?>

<html lang="en">
<head>
    <!-- Your existing head content -->
</head>
<body>
    <center>
        <h1>Search Results</h1>

        <!-- Add a link to go back to the main listuser.php page -->
        <p><a href="listuser.php">Back to List</a></p>
    </center>

    <div class="container">
        <!-- Display the search results -->
        <table class="table">
            <!-- Table headers and rows to display search results -->
            <?php
            foreach ($tab as $user) {
                echo '<tr>
                    <td>'.$user['FirstName'].'</td>
                    <td>'.$user['LastName'].'</td>
                    <td>'.$user['UserName'].'</td>
                    <td>'.$user['Email'].'</td>
                    <td>'.$user['PhoneNumber'].'</td>
                    <td>
                        <button class="edit-btn"><a href="updateuser.php?updatePhoneNumber='.$user['PhoneNumber'].'" class="text-light">Update</a></button>
                        <button class="login-btn"><a href="deleteuser.php?deletePhoneNumber='.$user['PhoneNumber'].'" >Delete</a></button>
                    </td>
                </tr>';
            }
            ?>
        </table>
    </div>
</body>
</html>
