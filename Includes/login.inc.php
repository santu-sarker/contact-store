<?php session_start();
include "../Database/register_user.data.php";

// ******* getting form data through post method ****************
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['submit'])) {
        $verify_key = validate_input($_REQUEST['verify_key']);

        $pass = validate_input($_REQUEST['input_password']);

        $user = login_user($verify_key, $pass);
        if ($user['error'] == 100) {
            $_SESSION['login_err_type'] = "success";
            $_SESSION['login_session_id'] = $user['login_session_id'];
            $_SESSION['login_session_name'] = $user['login_session_name'];
            header("location: ../index.php");

        } else if ($user['error'] == 101) {
            $_SESSION['login_err_type'] = "danger";
            $_SESSION['login_err'] = "Invalid Credentials ";
            header("location: ../login.php");

        } else if ($user['error'] == 102) {
            $_SESSION['login_err_type'] = "danger";
            $_SESSION['login_err'] = "User Do Not  Exists";
            header("location: ../login.php");

        } else if ($user['error'] == 103) {
            $_SESSION['login_err_type'] = "warning";
            $_SESSION['login_err'] = "Connection Error !";
            header("location: ../login.php");

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
