<?php session_start();
include "../Database/register_user.data.php";

// ******* getting form data through post method ****************
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['submit'])) {
        $user_name = validate_input($_REQUEST['user_name']);
        $user_number = validate_input($_REQUEST['user_number']);
        $user_email = validate_input($_REQUEST['user_email']);
        $pass = validate_input($_REQUEST['user_pass']);
        $confirm_pass = validate_input($_REQUEST['user_confirm_password']);
        $gender = $_REQUEST['gender'];
        $check_password = pass_check($pass, $confirm_pass);
        $check_email = email_check($user_email);

        if ($check_email == true && $check_password == true) {

            $user = create_user($user_name, $user_number, $user_email, $pass, $gender);
            if ($user['error'] == 101) {
                $_SESSION['error_type'] = "danger";
                $_SESSION['error'] = "something went Wronge , Please Try Again";
                header("location: ../registration.php");
                exit();
            } else if ($user['error'] == 102) {
                $_SESSION['error_type'] = "danger";
                $_SESSION['error'] = "User Already Exists";
                header("location: ../registration.php");
                exit();
            } else if ($user['error'] == 103) {
                $_SESSION['error_type'] = "danger";
                $_SESSION['error'] = "Connection Error !";
                header("location: ../registration.php");
                exit();
            } else if ($user['error'] == 100) {
                $_SESSION['error_type'] = "success";
                $_SESSION['error'] = "registration successfull";
                header("location: ../registration.php");

            }

        } else {
            $_SESSION['error_type'] = "danger";
            $_SESSION['error'] = "Password or Email Error";
            header("location: ../registration.php");
            exit();
        }

    }
}

// ***** function to sanitaize form input  data to prevent cross site attack **********
function validate_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = strip_tags($data);
    return $data;
}

// *********** function to check if 2 password actually match & not less than 6 digit **********
function pass_check($pass, $confirm_pass)
{
    if (strlen($pass) >= 6 && (strcmp($pass, $confirm_pass) == 0)) {
        return true;
    } else {
        return false;
    }

}

// *********** function to validate the email address  ***************
function email_check($email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        return true;
    } else {
        return false;
    }
}
