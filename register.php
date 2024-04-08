<?php
include'db_connection.php' ;
 if (isset($_POST["submit"])){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($password !== $confirmPassword) {
        echo "Error: Passwords do not match";
    } else {
    //hash password
    $hashedPassword = password_hash($password,PASSWORD_DEFAULT);
    }
// preparation of statement//
       
    $stmt = $conn->prepare( "INSERT INTO newusers (first_name, last_name, email, user_password) VALUES (?,?,?,?)");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error); // Check for prepare error
    }
    $stmt->bind_param("ssss",$firstname,$lastname,$email,$hashedPassword);
    
    if ($stmt->execute()) {
        echo "User registered successfully";
    } else {
        echo "Error: " . $conn->error;
    }
    $stmt->close();
    $conn->close();
    
    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration</title>
    <link rel="stylesheet"href="style.css">
</head>
<body>
    <ul>
        <form action="" method="post" autocomplete="off">
        <h2>Registration form</h2>
            <label>first name</label>
            <input type="text" name="firstname" placeholder="First name"><br>
            <label>last name</label>
            <input type="text" name="lastname" placeholder="Last name"><br>
            <label>email</label>
            <input type="text" name="email" placeholder="Email"><br>
            <label>password</label>
            <input type="password" name="password" placeholder="Password"><br>
            <label>confirm password</label>
            <input type="password" name="confirm_password" placeholder="Confirm Password"><br>
            <button type="submit" name="submit">Register</button>
            <p>Already a member? <a href="login.php">login</a></p>
        </form>
    </ul>
</body>
</html>