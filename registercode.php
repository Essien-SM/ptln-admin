<?php
include('security.php');

function sanitize_user_input($data)
{
    $data = trim($data, " ");
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function valisantize_email($data)
{
    $data = filter_var($data, FILTER_VALIDATE_EMAIL);
    $data = filter_var($data, FILTER_SANITIZE_EMAIL);
    return $data;
}
// registration code
if (isset($_POST['register'])) {
    if (empty($_POST['firstname'])) {

        $_SESSION['warning'] = "Firstname is required";
        header('Location: register-admin.php');
    } elseif (empty($_POST['surname'])) {

        $_SESSION['warning'] = "Surname is required";
        header('Location: register-admin.php');
    } elseif (empty($_POST['username'])) {

        $_SESSION['warning'] = "Username is required";
        header('Location: register-admin.php');
    } elseif (empty($_POST['email'])) {

        $_SESSION['warning'] = "Email is required";
        header('Location: register-admin.php');
    } elseif (empty($_POST['phone_number'])) {

        $_SESSION['warning'] = "Phone Number is required";
        header('Location: register-admin.php');
    } elseif (empty($_POST['password'])) {

        $_SESSION['warning'] = "Password is required";
        header('Location: register-admin.php');
    } elseif (empty($_POST['confirm_password'])) {

        $_SESSION['warning'] = "Please confirm your password";
        header('Location: register-admin.php');
    } else {

        $firstname          = sanitize_user_input(ucfirst($_POST['firstname']));
        $surname            = sanitize_user_input(ucfirst($_POST['surname']));
        $username           = sanitize_user_input($_POST['username']);
        $email              = valisantize_email($_POST['email']);
        $phone_number       = sanitize_user_input($_POST['phone_number']);
        $password           = $_POST['password'];
        $confirm_password   = $_POST['confirm_password'];

        $email_query = "SELECT email FROM admin_registration WHERE email = ?";
        $stmt_check = $connection->prepare($email_query);
        $stmt_check->bind_param("s", $email);
        $stmt_check->execute();
        $stmt_check->store_result();

        if ($stmt_check->num_rows > 0) {
            $stmt_check->bind_result($email);
            $stmt_check->fetch();
            $stmt_check->close();

            $_SESSION['warning'] = "This <strong>Email</strong> is registered to another user";
            header('Location: register-admin.php');
        } else {

            if ($password != $confirm_password) {
                $_SESSION['warning'] =  "Passwords Do Not Match";
                header('Location: register-admin.php');
            } else {

                $password = password_hash($password, PASSWORD_BCRYPT);

                $query = "INSERT INTO admin_registration (firstname, surname, username, email, phone_number, password) VALUES (?,?,?,?,?,?)";
                $stmt_insert = $connection->prepare($query);
                $stmt_insert->bind_param("ssssss", $firstname, $surname, $username, $email, $phone_number, $password);
                $stmt_insert->execute();

                if ($stmt_insert->affected_rows > 0) {
                    $_SESSION['success'] =  "Admin Registered";
                    header('Location: register-admin.php');
                } else {
                    $_SESSION['status'] =  "Admin Not Added ";
                    header('Location: register-admin.php');
                }
                $stmt_insert->close();
            }
        }
        $stmt_check->close();
    }
}


// delete admin
if (isset($_POST['delete_admin_profile'])) {
    $id = $_POST['delete_id'];

    $query = "DELETE FROM admin_registration WHERE  id = ?";
    $stmt_del = $connection->prepare($query);
    $stmt_del->bind_param("i", $id);
    $stmt_del->execute();

    if ($stmt_del) {

        $_SESSION['warning'] = "Admin <strong>Terminated</strong>";
        header("location: register-admin.php");
    } else {

        $_SESSION['status'] = "User termination <strong>Failed</strong>";
        header("location: register-admin.php");
    }
    $stmt_del->close();
}


// update other admins password
if (isset($_POST['update-user-profile'])) {

    $id                 = $_POST['id'];
    $username           = sanitize_user_input($_POST['username']);
    $email              = valisantize_email($_POST['email']);
    $password           = sanitize_user_input($_POST['new_password']);
    $confirm_password   = sanitize_user_input($_POST['con_password']);

    if (empty($username)) {
        $_SESSION['warning'] = "Username is required";
        header('Location: register-admin.php');
    } elseif (empty($email)) {
        $_SESSION['warning'] = "Email is required";
        header('Location: register-admin.php');
    } elseif (empty($password)) {

        $_SESSION['warning'] = "Password is required";
        header('Location: register-admin.php');
    } else {

        if ($password != $confirm_password) {
            $_SESSION['warning'] =  "Passwords Do Not Match";
            header('Location: registeredit.php');
        } else {

            $password = password_hash($password, PASSWORD_BCRYPT);

            $query = "UPDATE admin_registration SET username = ?, email = ?, password = ? WHERE id = ? ";
            $stmt_update = $connection->prepare($query);
            $stmt_update->bind_param("sssi", $username, $email, $password, $id);
            $stmt_update->execute();

            if ($stmt_update) {

                $_SESSION['success'] = "Admins profile is updated";
                header("location: register-admin.php");
                exit();
            } else {

                $_SESSION['status'] = "Admins profile is not updated";
                header("location: registeredit.php");
                exit();
            }
            $stmt_update->close();
        }
        $stmt_check->close();
    }
} else {
    $_SESSION['status'] = "An error occured!";
    header("Location: register-admin.php");
}

// updating active users profile
if (isset($_POST['updateprofile'])) {

    if (empty($_POST['firstname'])) {

        $_SESSION['warning'] = "Firstname is required";
        header('Location: register-admin.php');
    } elseif (empty($_POST['surname'])) {

        $_SESSION['warning'] = "Surname is required";
        header('Location: register-admin.php');
    } elseif (empty($_POST['email'])) {

        $_SESSION['warning'] = "Email is required";
        header('Location: register-admin.php');
    } elseif (empty($_POST['phone_number'])) {

        $_SESSION['warning'] = "Phone Number is required";
        header('Location: register-admin.php');
    } else {
        function sanitize_user_update($input)
        {
            $input = trim($input, " ");
            $input = stripslashes($input);
            $input = htmlspecialchars($input);
            return $input;
        }
        function valisantize_update($input)
        {
            $input = filter_var($input, FILTER_VALIDATE_EMAIL);
            $input = filter_var($input, FILTER_SANITIZE_EMAIL);
            return $input;
        }

        $id             = $_POST['id'];
        $firstname      = sanitize_user_update($_POST['firstname']);
        $surname        = sanitize_user_update($_POST['surname']);
        $username       = sanitize_user_update($_POST['username']);
        $phone_number   = sanitize_user_update($_POST['phone_number']);
        $email          = valisantize_update($_POST['email']);

        $query = "UPDATE admin_registration SET firstname = ?, surname = ?, username = ?, phone_number = ?, email = ? WHERE id = ? ";
        $stmt_update = $connection->prepare($query);
        $stmt_update->bind_param("sssssi", $firstname, $surname, $username, $phone_number, $email, $id);
        $stmt_update->execute();

        if ($stmt_update) {

            $_SESSION['success'] = "Your profile is updated";
            header("location: profile.php");
            exit();
        } else {

            $_SESSION['status'] = "Your profile is not updated";
            header("location: profile.php");
            exit();
        }
    }
} else {
    $_SESSION['status'] = "An error occured!";
    header("Location: register-admin.php");
}
