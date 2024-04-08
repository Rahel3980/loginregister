<?php
include 'db_connection.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["submit"])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // preparation of statement
        $stmt = $conn->prepare("SELECT email, user_password FROM newusers WHERE email = ?");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error); // Check for prepare error
        }
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['user_password'])) {
                echo "Login successful";
            } else {
              header("Location",bs.php);
            }
        } else {
            echo "Invalid email or user not found";
        }
        $stmt->close();
    }

    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<ul>
    <form method="post" autocomplete="off">
        <h2>Login form</h2>
        <label>Email</label>
        <input type="text" name="email" placeholder="Email"><br>
        <label>Password</label>
        <input type="password" name="password" placeholder="Password"><br>
        <button type="submit" name="submit">Login</button>
    </form>
    <p>Not a member yet? <a href="register.php">Register</a></p>
</ul>
</body>
</html>