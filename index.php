<?php
include 'config/koneksi.php';
session_start();

if (isset($_SESSION['id'])) {
    header("Location: dashboard");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM staff WHERE staff_id='$id' AND sandi='$password'";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['id'] = $row['staff_id'];
        header("Location: dashboard/");
        exit();
    } else { ?>
        <div class="row justify-content-center">
            <div class='alert alert-danger alert-dismissible text-center col-lg-4 mt-3'>
                <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                <strong>Gagal!</strong> ID dan Password tidak valid.
            </div>
        </div>
    <?php }
} ?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login - LibraryLTE</title>
    <link href="bootstrap/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="mt-5">
                                <h3 class="text-center font-weight-light my-4">Login</h3>

                                <form method="POST">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="inputID" type="text" placeholder="ID" name="id"
                                            required>
                                        <label for="inputID">ID</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="inputPassword" type="password"
                                            placeholder="Password" name="password" required>
                                        <label for="inputPassword">Password</label>
                                    </div>
                                    <div class="d-grid ">
                                        <button type="submit" name="submit"
                                            class="btn btn-primary btn-block btn-lg">Login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="bootstrap/js/scripts.js"></script>
</body>

</html>