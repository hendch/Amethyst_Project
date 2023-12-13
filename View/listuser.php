<?php
include "../controller/User.php";

$c = new Users();
$tab = $c->listUsers();

/* // Check if a search term is provided
if (isset($_GET["searchTerm"])) {
    $searchTerm = $_GET["searchTerm"];
    $tab = $c->searchUsers($searchTerm);
} else {
    // If no search term, retrieve the list of all users
    $tab = $c->listUsers();
}

// Sorting logic
if (isset($_GET["sort"]) && $_GET["sort"] == "asc") {
    // Sort in ascending order
    usort($tab, function($a, $b) {
        return strtolower($a['FirstName']) <=> strtolower($b['FirstName']);
    });
} elseif (isset($_GET["sort"]) && $_GET["sort"] == "desc") {
    // Sort in descending order
    usort($tab, function($a, $b) {
        return strtolower($b['FirstName']) <=> strtolower($a['FirstName']);
    });
} */
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of users</title>
    <!-- Add your CSS and other head section elements here -->

    <style>
        /* Add your custom styles here */
        .container {
            margin-top: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .edit-btn, .login-btn {
            text-decoration: none;
            padding: 5px 10px;
            margin: 0 5px;
        }

        .text-light {
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Add sorting links -->
        <div>
            <a href="listuser.php?sort=asc">Sort A-Z</a> |
            <a href="listuser.php?sort=desc">Sort Z-A</a>
        </div>

        <!-- Add a search form -->
        <form action="listuser.php" method="GET">
            <label for="searchTerm">Search Users:</label>
            <input type="text" id="searchTerm" name="searchTerm">
            <input type="submit" value="Search">
        </form>
        <div class="col-12">
            <!-- Link to adduser.php -->
            <button class="submit-btn"><a href="adduser.php" class="text-light">Add User</a></button>
        </div>
        <!-- Your existing user listing table -->
        <table class="table">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($tab as $user) {
                    echo '<tr>
                        <td>'.$user['FirstName'].'</td>
                        <td>'.$user['LastName'].'</td>
                        <td>'.$user['UserName'].'</td>
                        <td>'.$user['Email'].'</td>
                        <td>'.$user['PhoneNumber'].'</td>
                        <td>
                            <button class="edit-btn"><a href="updateuser.php?updatePhoneNumber='echo $user['PhoneNumber']'" class="text-light">Update</a></button>
                            <button class="login-btn"><a href="deleteuser.php?deletePhoneNumber='echo $user['PhoneNumber']'" class="text-light">Delete</a></button>
                        </td>
                    </tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

