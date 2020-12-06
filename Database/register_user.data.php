<?php
define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT']);
//printf(ROOT_PATH);
include ROOT_PATH . "/Contact_Store/Database/connect.data.php";
function create_user($user_name, $user_number, $user_email, $pass, $gender)
{
    $hash_pass = password_hash($pass, PASSWORD_DEFAULT);
    $conn = connect();
    if ($conn) {
        $message = array();
        $sql = "SELECT * FROM master_user WHERE user_email = ? or user_number = ?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            $message['error'] = 101;
            return $message;
        }
        mysqli_stmt_bind_param($stmt, "ss", $user_email, $user_number);
        mysqli_stmt_execute($stmt);
        $result_data = mysqli_stmt_get_result($stmt);
        if (mysqli_fetch_assoc($result_data)) {
            $message['error'] = 102;
            return $message;
        } else {
            $sql = "INSERT INTO master_user(user_name ,user_number, user_email, user_password,user_gender) VALUES(?,?,?,?,?);";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                $message['error'] = 101;
                return $message;
            }
            mysqli_stmt_bind_param($stmt, "sssss", $user_name, $user_number, $user_email, $hash_pass, $gender);
            mysqli_stmt_execute($stmt);
            mysqli_close();
            $message['error'] = 100;
            return $message;

        }
    } else {
        $message['error'] = 103;
        return $message;
    }

}

function login_user($verify_key, $password)
{
    $message = array();
    $conn = connect();
    if ($conn) {

        if (is_numeric($verify_key)) {
            $sql = "SELECT user_id ,  user_name,user_number,user_email,user_password FROM master_user WHERE  user_number = ?;";
        } else {
            $sql = "SELECT user_id, user_name,user_number,user_email,user_password FROM master_user WHERE user_email = ?;";
        }
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            $message['error'] = "statement error";
            return $message;
        }
        mysqli_stmt_bind_param($stmt, "s", $verify_key);
        mysqli_stmt_execute($stmt);
        $result_data = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($result_data) > 0) {
            $row = mysqli_fetch_assoc($result_data);
            $hash_password = $row['user_password'];
            if (password_verify($password, $hash_password)) {

                $message['error'] = 100; // code for successful login
                $message['login_session_id'] = $row['user_id'];
                $message['login_session_name'] = $row['user_name'];
                mysqli_close();
                return $message;
            } else {
                $message['error'] = 101; // code for invalid verify key or password

                return $message;
            }

        } else {
            $message['error'] = 102; // code for user do not exists
            return $message;

        }

    } else {
        $message['error'] = 103; // code for connection error
        return $message;
    }

}
function add_contact($contact_name, $contact_number, $contact_email, $user_id)
{
    $message = array();
    $conn = connect();
    if ($conn) {

        $message = array();
        $sql = "SELECT * FROM master_contact WHERE user_id = ? AND
                contact_email = ?  AND contact_number = ? ;";
        $stmt = mysqli_stmt_init($conn);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "sss", $user_id, $contact_email, $contact_number);
            mysqli_stmt_execute($stmt);
            $result_data = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($result_data) > 0) {
                $message['error'] = 103; // contact already exists
                return $message;
            } else {
                $sql = "INSERT INTO master_contact(contact_name ,contact_number, contact_email, user_id) VALUES(?,?,?,?);";
                $stmt = mysqli_stmt_init($conn);
                if (mysqli_stmt_prepare($stmt, $sql)) {
                    mysqli_stmt_bind_param($stmt, "ssss", $contact_name, $contact_number, $contact_email, $user_id);
                    mysqli_stmt_execute($stmt);
                    $message['error'] = 100; // inserted successfully
                    return $message;

                } else {
                    $message['error'] = 101; // statement failed
                    return $message;
                }
            }

        } else {
            $message['error'] = 101; // statement failed
            return $message;
        }

    } else {
        $message['error'] = 102; // code for connection error
        return $message;
    }

}
function edit_contact($contact_id, $contact_name, $contact_number, $contact_email, $user_id)
{
    $message = array();
    $conn = connect();
    if ($conn) {

        $message = array();
        $sql = "SELECT * FROM master_contact WHERE contact_id = ? AND user_id = ? ;";
        $stmt = mysqli_stmt_init($conn);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "ss", $contact_id, $user_id);
            mysqli_stmt_execute($stmt);
            $result_data = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($result_data) > 0) {
                $sql = "UPDATE  master_contact SET contact_name = ? , contact_number= ? , contact_email = ?, user_id = ?  where contact_id = ?;";
                $stmt = mysqli_stmt_init($conn);
                if (mysqli_stmt_prepare($stmt, $sql)) {
                    mysqli_stmt_bind_param($stmt, "sssss", $contact_name, $contact_number, $contact_email, $user_id, $contact_id);
                    mysqli_stmt_execute($stmt);
                    $message['error'] = 100; // updated successfully
                    return $message;

                } else {
                    $message['error'] = 101; // statement failed
                    return $message;
                }
            } else {
                $message['error'] = 103; // data not found
            }

        } else {
            $message['error'] = 101; // statement failed
            return $message;
        }

    } else {
        $message['error'] = 102; // code for connection error
        return $message;
    }

}
function get_contact($user_id)
{
    $message = array();
    $conn = connect();
    if ($conn) {
        $sql = "SELECT contact_id ,  contact_name,contact_number,contact_email , reg_date FROM master_contact WHERE  user_id = ?;";
        $stmt = mysqli_stmt_init($conn);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $user_id);
            mysqli_stmt_execute($stmt);
            $result_data = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result_data) > 0) {
                $contact = mysqli_fetch_all($result_data, MYSQLI_ASSOC);
                return $contact;
            } else {
                // no data found
                return $message;
            }

        } else {
            $message['error'] = 101; // statement failed
            return $message;
        }

    } else {
        $message['error'] = 102; // code for connection error
        return $message;
    }
}
function delete_contact($user_id, $contact_id)
{
    $message = array();
    $conn = connect();
    if ($conn) {
        $sql = "DELETE FROM master_contact WHERE  contact_id = ? AND user_id= ? ;";
        $stmt = mysqli_stmt_init($conn);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "ss", $contact_id, $user_id);
            mysqli_stmt_execute($stmt);
            $result_data = mysqli_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            $message['error'] = 100; // successfully deleted
            return $message;

        } else {
            $message['error'] = 101; // statement failed
            return $message;
        }

    } else {
        $message['error'] = 102; // code for connection error
        return $message;
    }
}

/*public function table_creation(){
$sql = "CREATE TABLE IF NOT EXISTS Master_User (
user_id INT(10) PRIMARY KEY AUTO_INCREMENT NOT NULL,
user_name VARCHAR(50) NOT NULL ,
user_number varchar(50) NOT NULL UNIQUE,
user_email varchar(50) NOT NULL UNIQUE,
user_password VARCHAR(50) NOT NULL ,
user_gender VARCHAR(10) NOT NULL ,
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
)";

$sql = "INSERT INTO master_contact(contact_name ,contact_number, contact_email, user_id) VALUES(?,?,?,?);";
$stmt = mysqli_stmt_init($conn);
if (mysqli_stmt_prepare($stmt, $sql)) {
mysqli_stmt_bind_param($stmt, "ssss", $contact_name, $contact_number, $contact_email, $user_id);
mysqli_stmt_execute($stmt);
$message['error'] = 100; // inserted successfully
return $message;

} else {
$message['error'] = 101; // statement failed
return $message;
}

 */
