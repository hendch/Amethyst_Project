<?php
include '../controller/Requestcontroller.php';
include '../model/Request.php';
$error = "";
$requests = null;
$valid = 0;

// create an instance of the controller
$requestcontroller = new requestcontroller();

if (
    isset($_POST["userid"]) &&
    isset($_POST["reqtype"]) &&
    isset($_POST["reqdate"]) &&
    isset($_POST["servicestatus"])
) {
    if (
        !empty($_POST["userid"]) &&
        !empty($_POST['reqtype']) &&
        !empty($_POST["reqdate"]) &&
        !empty($_POST["servicestatus"])
    ) {
            $valid = 1; // Form validation passed
    }
}
if ($valid == 1) {
    // Form is valid, proceed with adding the user
    $request = new request(
        $_POST['userid'],
        $_POST['reqtype'],
        $_POST['reqdate'],
        $_POST['servicestatus']
    );
    $requestcontroller->createrequest($request);
    
    header('Location:listrequest.php');
    exit();
} 


?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Request </title>
</head>
<!--
<body>
    <a href="listrequest.php">Back to list </a>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <form action="" method="POST">
        <table>
            <tr>
                <td><label for="userid">userid :</label></td>
                <td>
                    <input type="number" id="userid" name="userid" placeholder="Enter user id"/>
                    <span id="error" style="color: red"></span>
                </td>
            </tr>
            <tr>
                <td><label for="reqtype">Request Type:</label></td>
                <td>
                    <input type="text" id="reqtype" name="reqtype"/>
                    <span id="error" style="color: red"></span>
                </td>
            </tr>
            <tr>
                <td><label for="reqdate">reqdate :</label></td>
                <td>
                    <input type="text" id="reqdate" name="reqdate" />
                    <span id="error" style="color: red"></span>
                </td>
            </tr>
            <tr>
                <td><label for="servicestatus">servicestatus Type:</label></td>
                <td>
                    <input type="text" id="servicestatus" name="servicestatus"/>
                    <span id="error" style="color: red"></span>
                </td>
            </tr>

            <td>
                <input type="submit" value="Save">
            </td>
            <td>
                <input type="reset" value="Reset">
            </td>
        </table>
    </form>
</body>-->
<body>
    <a href="listrequest.php">Back to list </a>
    <hr>

    <div id="error">
        ?php echo $error; ?>
    </div>

    <form action="" method="POST">
        <table>
            <tr>
                <td><label for="userid">userid :</label></td>
                <td>
                    <input type="number" id="userid" name="userid" placeholder="Enter user id"/>
                    <span id="userid" style="color: red"></span>
                </td>
            </tr>
            <tr>
                <td><label for="reqtype">Request Type:</label></td>
                <td>
                    <select id="reqtype" name="reqtype">
                        <option value="feedback">Feedback</option>
                        <option value="refund">Refund</option>
                    </select>
                    <span id="error" style="color: red"></span>
                </td>
            </tr>
            <tr>
                <td><label for="reqdate">reqdate :</label></td>
                <td>
                    <input type="date" id="reqdate" name="reqdate" />
                    <span id="error" style="color: red"></span>
                </td>
            </tr>
            <tr>
                <td><label for="servicestatus">servicestatus Type:</label></td>
                <td>
                    <select id="servicestatus" name="servicestatus">
                        <option value="ongoing">Ongoing</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                    <span id="error" style="color: red"></span>
                </td>
            </tr>

            <td>
                <input type="submit" value="Save">
            </td>
            <td>
                <input type="reset" value="Reset">
            </td>
        </table>
    </form>
</body>
</html>
