<?php
include_once "./Database/register_user.data.php";

$user_id = $_SESSION['login_session_id'];
$contact_details = get_contact($user_id);
/*foreach ($contact_details as $contact) {
printf($contact['contact_email'] . "<br>");
}
 */
