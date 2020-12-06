<?php session_start();
include "../Database/register_user.data.php";

// ******* getting form data through post method ****************
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['submit'])) {
        $contact_name = validate_input($_REQUEST['contact_name']);
        $contact_number = validate_input($_REQUEST['contact_number']);
        $contact_email = validate_input($_REQUEST['contact_email']);
        $contact_edit = $_REQUEST['update_contact'];
        if (email_check($contact_email) == false) {
            $_SESSION['contact_type'] = "warning";
            $_SESSION['contact_msg'] = "Invalid Email Adress";
            header("location: ../index.php");
        } else if ($contact_edit == "true") {
            $contact_id = validate_input($_REQUEST['contact_id']);
            //echo $contact_id . " || " . $contact_name . " " . $contact_email . " " . $contact_number . "||  " . $_SESSION['login_session_id'];
            $user = edit_contact($contact_id, $contact_name, $contact_number, $contact_email, $_SESSION['login_session_id']);
            if ($user['error'] == 100) {
                $_SESSION['contact_type'] = "success";
                $_SESSION['contact_msg'] = "Contact Updated Successfully";
                header("location: ../index.php");

            } else if ($user['error'] == 101 || $user['error'] == 102) {
                $_SESSION['contact_type'] = "danger";
                $_SESSION['contact_msg'] = "Connection Error Occured";
                header("location: ../index.php");

            } else if ($user['error'] == 103) {
                $_SESSION['contact_type'] = "danger";
                $_SESSION['contact_msg'] = "Contact Do Not Exists";
                header("location: ../index.php");

            }
        } else {
            $user = add_contact($contact_name, $contact_number, $contact_email, $_SESSION['login_session_id']);
            if ($user['error'] == 100) {
                $_SESSION['contact_type'] = "success";
                $_SESSION['contact_msg'] = "Contact Added Successfully";
                header("location: ../index.php");

            } else if ($user['error'] == 101 || $user['error'] == 102) {
                $_SESSION['contact_type'] = "danger";
                $_SESSION['contact_msg'] = "Connection Error";
                header("location: ../index.php");
            } else if ($user['error'] == 103) {
                $_SESSION['contact_type'] = "danger";
                $_SESSION['contact_msg'] = "Contact Already Exists";
                header("location: ../index.php");

            }
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
function email_check($email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        return true;
    } else {
        return false;
    }
}

/*
$user = edit_contact($contact_name, $contact_number, $contact_email, $_SESSION['login_session_id']);
if ($user['error'] == 100) {
$_SESSION['contact_type'] = "success";
$_SESSION['contact_msg'] = "Contact Updated Successfully";
header("location: ../index.php");

} else if ($user['error'] == 102) {
$_SESSION['contact_type'] = "danger";
$_SESSION['contact_msg'] = "Connection Error";
header("location: ../index.php");
} else if ($user['error'] == 101) {
$_SESSION['contact_type'] = "danger";
$_SESSION['contact_msg'] = "Failed Update Contacts";
header("location: ../index.php");

}

$user = edit_contact($contact_name, $contact_number, $contact_email, $_SESSION['login_session_id']);
if ($user['error'] == 100) {
$_SESSION['contact_type'] = "success";
$_SESSION['contact_msg'] = "Contact Updated Successfully";
header("location: ../index.php");

} else if ($user['error'] == 101 || $user['error'] == 102) {
$_SESSION['contact_type'] = "danger";
$_SESSION['contact_msg'] = "Connection Error";
header("location: ../index.php");
}
 */
