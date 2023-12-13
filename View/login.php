<?php
include "../controller/User.php";
if (isset($_COOKIE['remember_me'])) {
  $cookieData = json_decode($_COOKIE['remember_me'], true);
  $username = $cookieData['username'];
  $number = $cookieData['number'];

  $authentifier = authenticateUser($username, $number);

  if ($authentifier) {
          if (!isset($_GET['usePreviousCookies'])) {
              echo '<script>';
              echo 'var usePrevious = confirm("Do you want to use your previous login information?");';
              echo 'if (usePrevious) {';
              echo '  window.location.href = "../php/login.php?usePreviousCookies=true";';
              echo '} else {';
              echo '  document.cookie = "remember_me=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";';
              echo '  alert("You chose not to use the previous login information. Please enter your credentials.");';
              echo '  window.location.href = "\htdocs\WorkshopProject\Front Office\View\login.php";';  
              echo '}';
              echo '</script>';
              exit();
          }

          header("Location: \WorkshopProject\Front Office\templatemo_577_liberty_market\index.html");
  }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST["username"]) ? $_POST["username"] : "";
    $number = isset($_POST["number"]) ? $_POST["number"] : "";
    $rememberMe = isset($_POST["remember_me"]) ? $_POST["remember_me"] : "";

    if (!empty($username) && !empty($number)) {
        // Debugging output
        echo "Username: $username, Number: $number<br>";

        $authentifier = authenticateUser($username, $number);

        if ($authentifier) {
            if ($rememberMe == "on") {
                setRememberMeCookies($username, $number);
            }

            // Assuming you want to redirect to an HTML page
            header("Location: ../templatemo_577_liberty_market/index.html");
            exit();
        } else {
            echo "Invalid username or number, please try again";
        }
    } else {
        echo "Please enter both username and number.";
    }
}

function setRememberMeCookies($username, $number)
{
    $cookieData = json_encode(['username' => $username, 'number' => $number]);
    setcookie('remember_me', $cookieData, time() + (30 * 24 * 60 * 60), '/'); // Cookie will expire in 30 days
}

function authenticateUser($username, $number)
{
    try {
        $pdo = config::getConnexion();
        $query = $pdo->prepare('SELECT * FROM usertest WHERE (UserName = :username OR Email = :username)');
        $query->execute(['username' => $username]);
        
        if ($query->rowCount() == 1) {
            $usertest = $query->fetch(PDO::FETCH_ASSOC);

            if ((int)$number === $usertest['PhoneNumber']) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    } catch (PDOException $e) {
        logError('Error: ' . $e->getMessage());
        return false;
    }
}
?>
