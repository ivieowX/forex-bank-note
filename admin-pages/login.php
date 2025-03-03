<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/login.css">
</head>
<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow">
                    <div class="card-body p-5 text-center">
                        <!-- โลโก้ -->
                        <img src="https://app.forex-erp.com/images/touch/android-192-192.png" alt="Logo" class="mb-4" style="width: 100px; height: auto;">
                        <h2 class="card-title mb-4">Admin Login</h2>
                        <?php
                        require('db.php');
                        session_start();

                        if (isset($_POST['username'])) {
                            $username = stripslashes($_REQUEST['username']);
                            $username = mysqli_real_escape_string($conn, $username);
                            $password = stripslashes($_REQUEST['password']);
                            $password = mysqli_real_escape_string($conn, $password);

                            $query = "SELECT * FROM `users` WHERE username='$username' AND password='" . md5($password) . "'";
                            $result = mysqli_query($conn, $query) or die(mysql_error());
                            $rows = mysqli_num_rows($result);

                            if ($rows == 1) {
                                $_SESSION['username'] = $username;
                                header("Location: index.php");
                            } else {
                                echo "<div class='alert alert-danger' role='alert'>Username/password is incorrect.</div>";
                            }
                        }
                        ?>
                        <form action="" method="post" name="login">
                            <div class="mb-3">
                                
                                <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
                            </div>
                            <div class="mb-3">
                                
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" name="submit" class="btn btn-success">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>