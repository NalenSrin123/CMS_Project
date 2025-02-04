<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/style/theme.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="content-login">
        <form method="post">
            <label>Name or Email</label>
            <input type="text" class="box" name="name_email">
            <label>Password</label>
            <input type="password" class="box" name="password">
            <div class="wrap-btn">
                <a href="register.php" class="btn">Register?</a>&ensp;
                <input type="submit" class="btn" name="btn_login" value="LOGIN">
            </div>
        </form>
    </div>
</body>
</html>
<?php 
$conn = new mysqli('localhost', 'root', '', 'db_project');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn_login'])) {
    $name_email = trim($_POST['name_email']);
    $password = $_POST['password'];

    // Prepare the query
    $smt = $conn->prepare("SELECT password, email, role FROM tbl_user WHERE email=? OR user_name=? LIMIT 1");
    $smt->bind_param("ss", $name_email, $name_email);
    $smt->execute();
    $smt->store_result();

    $script = "<script>";

    // Check if a matching user was found
    if ($smt->num_rows > 0) {
        // Bind results
        $smt->bind_result($hashedPassword, $email, $role);
        $smt->fetch();

        // Verify password
        if (password_verify($password, $hashedPassword)) {
            session_start();
            $_SESSION['user'] = $email;  // Store the email (or user identifier)
            $_SESSION['role'] = $role;  // Store the role
            
            // Redirect based on role
            if ($role == 'admin') {
                header("location: index.php");
            } else {
                header("location:../article/index.php");
            }
        } else {
            // Invalid password
            $script .= 'Swal.fire({
                title: "Invalid Password",
                text: "Error password not allowed",
                icon: "error"
            });';
        }
    } else {
        // Account not found
        $script .= 'Swal.fire({
            title: "Not Found Account",
            text: "Account not found",
            icon: "error"
        });';
    }

    $script .= "</script>";
    echo $script;

    // Close the prepared statement
    $smt->close();
}

$conn->close();
?>
