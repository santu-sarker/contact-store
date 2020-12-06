<?php session_start();
include_once "../Database/register_user.data.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['submit'])) {
        $contact_id = $_POST['delete_id'];
        $user_id = $_SESSION['login_session_id'];
        printf($contact_id);
        $response = delete_contact($user_id, $contact_id);
        if ($response['error'] == 100) {
            $_SESSION['contact_type'] = "success";
            $_SESSION['contact_msg'] = "Contact Deleted Successfully";
            header("location: ../index.php");

        } else if ($response['error'] == 101 || $user['error'] == 102) {
            $_SESSION['contact_type'] = "danger";
            $_SESSION['contact_msg'] = "Failed To Delete Contact";
            header("location: ../index.php");
        }
    }
}
