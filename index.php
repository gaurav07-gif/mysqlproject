<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration and Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <link rel="stylesheet" 
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">



    <style>
        body{
            font-family: 'Caveat', cursive;
        }
        .custom-div {
            margin-bottom: 15px;
        }

        .label {
            font-size: 12px;
            font-weight: bold;

        }
    </style>



</head>

<body>
    <div class="container" style="margin-top: 20px; width: 700px;">

        <!-- Registration Form -->
        <form id="registrationForm" action="" method="post">
            <h1 style="margin-bottom: 10px; text-align: center; font-weight: bold;">Registration</h1>
            <div class="row justify-content-center">

                <div class="form-group custom-div">
                    <label for="inputAddress2" class="label">First Name</label>
                    <input type="text" class="form-control" style="height: 45px;" id="fname" name="fname"
                        placeholder="Enter First Name" pattern="[A-Za-z ]+"
                        title="Only alphabetical characters and spaces are allowed" required>
                </div>


                <div class="form-group custom-div">
                    <label for="inputCity" class="label">Last Name</label>
                    <input type="text" class="form-control" style="height: 45px;" id="lname" name="lname"
                        placeholder="Enter Last Name" pattern="[A-Za-z ]+"
                        title="Only alphabetical characters and spaces are allowed" required>
                </div>

                <div>
                    <div class="form-group custom-div">
                        <label for="inputEmail4" class="label">Email</label>
                        <input type="email" class="form-control" style="height: 45px;" id="inputEmail4"
                            placeholder="Email" name="inputEmail4" placeholder="Email"
                            pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" title="Enter a valid email address"
                            required>
                    </div>
                </div>

                <div class="form-group custom-div">
                    <label for="inputPassword4" class="label">Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" style="height: 45px;" id="inputPassword4"
                            name="inputPassword4" placeholder="Password" required>
                        <span class="input-group-append">
                            <span class="input-group-text" onclick="password_show_hide();">
                                <i class="fa-sharp fa-solid fa-eye fa-bounce" id="show_eye" style="line-height: 31px;"></i>
                                <i class="fas fa-eye-slash d-none" id="hide_eye" style="line-height: 31px;"></i>
                            </span>
                        </span>
                    </div>
                </div>




                <div class="form-group custom-div">
                    <label for="inputAddress" class="label">Student ID</label>
                    <input type="text" class="form-control" id="studenid" style="height: 45px;" name="studenid"
                        placeholder="Student ID" required>
                </div>

            </div>

            <div class="row justify-content-center">
                <div>
                    <button type="submit" class="btn btn-success" name="submitRegistration">Register</button>
                    <button type="button" class="btn btn-link" onclick="toggleForm()">Login</button>
                </div>
            </div>
        </form>

        <!-- Login Form -->
        <form id="loginForm" action="" method="post" style="display: none;" onsubmit="return validateLoginForm()">
            <h1 style="margin-bottom: 20px; text-align: center; font-weight: bold;">Login</h1>
            <div class="row justify-content-center">
                <div>
                    <div class="form-group custom-div">
                        <label for="inputLoginEmail" class="label">Email</label>
                        <div class="input-group" style="height: 45px;">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="fa-solid fa-user-secret fa-bounce" style="line-height: 31px;"></i>
                                </span>
                            </div>
                            <input type="email" class="form-control" style="height: 45px;" id="loginEmail"
                                placeholder="Email" name="loginEmail"
                                pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}"
                                title="Enter a valid email address" required>
                        </div>
                    </div>

                </div>

                <div class="form-group custom-div">
                    <label for="inputLoginPassword" class="label">Password</label>
                    <div class="input-group" style="height: 45px;">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="fa-solid fa-key fa-bounce" style="line-height: 31px;"></i>
                            </span>
                        </div>
                        <input type="password" class="form-control" style="height: 45px;" id="loginPassword"
                            placeholder="Password" name="loginPassword" required>
                        <span class="input-group-append" style="height: 45px;">
                            <span class="input-group-text" onclick="login_password_show_hide();">
                                <i class="fa-sharp fa-solid fa-eye fa-bounce" id="login_show_eye" style="line-height: 31px;"></i>
                                <i class="fas fa-eye-slash d-none" id="login_hide_eye" style="line-height: 31px;"></i>
                            </span>
                        </span>
                    </div>
                </div>




                <div class="row justify-content-center">
                    <div>
                        <button type="submit" class="btn btn-success" name="loginSubmit">Login</button>
                        <button type="button" class="btn btn-link" onclick="toggleForm()">Register</button>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div id="loginWarning" style="color: red; display: none;">Invalid email or password!</div>
                </div>
        </form>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Connect to the database
        $dbHost = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "database";

        $conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Registration 
        if (isset($_POST["submitRegistration"])) {

            $email = $_POST["inputEmail4"];
            $password = $_POST["inputPassword4"];
            $studentId = $_POST["studenid"];
            $First_name = $_POST["fname"];
            $Last_name = $_POST["lname"];

            // Insert data into the database
            $sql = "INSERT INTO registration (email, password, studentId, First_Name, Last_Name)
            VALUES ('$email', '$password', '$studentId', '$First_name', '$Last_name')";

            if ($conn->query($sql) === TRUE) {
                // Registration successful
                echo "<script>window.location.href = 'welcome.html';</script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        // Login 
    
        if (isset($_POST["loginSubmit"])) {
            // Retrieve the login form data
            $loginEmail = $_POST["loginEmail"];
            $loginPassword = $_POST["loginPassword"];

            // Check if the user exists in the database
            $sql = "SELECT * FROM registration WHERE email = '$loginEmail' AND password = '$loginPassword'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Successful login
                echo "<script>window.location.href = 'welcome.html';</script>";
                exit;
            } else {
                echo "<script>document.getElementById('loginWarning').style.display = 'block';</script>";

            }
        }

        $conn->close();
    }
    ?>

    <script>
        function toggleForm() {
            const registrationForm = document.getElementById("registrationForm");
            const loginForm = document.getElementById("loginForm");
            const loginWarning = document.getElementById("loginWarning");

            if (registrationForm.style.display === "none") {
                registrationForm.style.display = "block";
                loginForm.style.display = "none";
                loginWarning.style.display = "none"; // Hide the warning when switching to the registration form
            } else {
                registrationForm.style.display = "none";
                loginForm.style.display = "block";
            }
        }

        function validateLoginForm() {
            // Check if the warning is displayed and prevent form submission
            const loginWarning = document.getElementById("loginWarning");
            if (loginWarning.style.display === "block") {
                return false;
            }
            return true;
        }


        function password_show_hide() {
            const passwordInput = document.getElementById("inputPassword4");
            const showEyeIcon = document.getElementById("show_eye");
            const hideEyeIcon = document.getElementById("hide_eye");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                showEyeIcon.classList.add("d-none");
                hideEyeIcon.classList.remove("d-none");
            } else {
                passwordInput.type = "password";
                showEyeIcon.classList.remove("d-none");
                hideEyeIcon.classList.add("d-none");
            }
        }


        function login_password_show_hide() {
            const loginPasswordInput = document.getElementById("loginPassword");
            const loginShowEyeIcon = document.getElementById("login_show_eye");
            const loginHideEyeIcon = document.getElementById("login_hide_eye");

            if (loginPasswordInput.type === "password") {
                loginPasswordInput.type = "text";
                loginShowEyeIcon.classList.add("d-none");
                loginHideEyeIcon.classList.remove("d-none");
            } else {
                loginPasswordInput.type = "password";
                loginShowEyeIcon.classList.remove("d-none");
                loginHideEyeIcon.classList.add("d-none");
            }
        }

    </script>

</body>

</html>