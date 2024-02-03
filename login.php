<?php
session_start();


$host = "localhost:3306";
$username = "uash7276_rahma";
$password = "rahma123";
$database = "uash7276_mhs_dj_rahma";
$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_SESSION['npm'])) {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $npm = $_POST['npm'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE npm = '$npm' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $_SESSION['npm'] = $npm;
        header('Location: index.php');
        exit();
    } else {
        $login_error = 'NPM atau Password salah.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #000;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        .login-container h2 {
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }

        .form-group input {
            width: calc(100% - 16px);
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        .form-group button {
            background-color: #0B60B0;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        .register-link {
            color: #777;
            margin-top: 15px;
        }

        .register-link a {
            color: #3498db;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Sign-In</h2>

    <?php
    if (isset($login_error)) {
        echo '<p class="error-message">' . $login_error . '</p>';
    }
    ?>

    <form action="login.php" method="post">
        <div class="form-group">
            <label for="npm">NPM:</label>
            <input type="text" id="npm" name="npm" placeholder="Masukkan NPM" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Masukkan Password" required>
        </div>
        <div class="form-group">
            <button type="submit">Sign In</button>
        </div>
    </form>
    <div class="register-link">
        Belum punya akun? <a href="registrasi.php">Register</a>
    </div>
</div>

</body>
</html>

