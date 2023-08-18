<!DOCTYPE html>
<html lang="en">



    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registration and Login</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
      
<style>
.custom-div{
    margin-bottom: 15px;
}
</style>



    </head>

    <body>
        <div class="container" style="margin-top: 20px; width: 700px;">
            <form id="registrationForm" action="" method="post">
                <h1 style="margin-bottom: 10px; text-align: center; font-weight: bold;">Registration</h1>
                <div class="row justify-content-center">
                
                        <div class="form-group custom-div">
                            <label for="inputAddress2">First Name</label>
                            <input type="text" class="form-control" style="height: 45px;" id="fname"
                                name="fname" placeholder="Enter First Name"  pattern="[A-Za-z ]+" title="Only alphabetical characters and spaces are allowed" required>
                        </div>
                    
                    
                        <div class="form-group custom-div">
                            <label for="inputCity">Last Name</label>
                            <input type="text" class="form-control" style="height: 45px;" id="lname"
                                name="lname" placeholder="Enter Last Name"  pattern="[A-Za-z ]+" title="Only alphabetical characters and spaces are allowed" required>
                        </div>
                    
                    <div>
                        <div class="form-group custom-div">
                            <label for="inputEmail4">Email</label>
                            <input type="email" class="form-control" style="height: 45px;" id="inputEmail4"
                                placeholder="Email" name="inputEmail4" placeholder="Email"  required>
                        </div>
                    </div>
                  
                        <div class="form-group custom-div">
                            <label for="inputPassword4">Password</label>
                            <input type="password" class="form-control" style="height: 45px;" id="inputPassword4"
                                name="inputPassword4" placeholder="Password" required>
                        
                    </div>
                
                
                  
                        <div class="form-group custom-div">
                            <label for="inputAddress">Student ID</label>
                            <input type="text" class="form-control" id="studenid"
                                style="height: 45px;" name="studenid" placeholder="Student ID" required>
                        </div>
                   
                    </div>
               
                <div class="row justify-content-center">
                    <div>
                        <button type="submit" class="btn btn-success" name="submitRegistration">Register</button>
                        <button type="button" class="btn btn-link" onclick="toggleForm()">Login</button>
                    </div>
                </div>
            </form>
            <form id="loginForm" action="" method="post" style="display: none;" onsubmit="return validateLoginForm()">
                <h1 style="margin-bottom: 20px; text-align: center; font-weight: bold;">Login</h1>
                <div class="row justify-content-center">
                    <div>
                        <div class="form-group custom-div">
                            <label for="inputLoginEmail">Email</label>
                            <input type="email" class="form-control" style="height: 45px;" id="loginEmail"
                                placeholder="Email" name="loginEmail"  pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" title="Enter a valid email address">
                        </div>
                    </div>
                    <div>
                        <div class="form-group custom-div">
                            <label for="inputLoginPassword">Password</label>
                            <input type="password" class="form-control" style="height: 45px;" id="loginPassword"
                                placeholder="Password" name="loginPassword">
                        </div>
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

    // Registration Logic
    if (isset($_POST["submitRegistration"])) {
        // Retrieve the form data
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

    // Login Logic
    if (isset($_POST["loginSubmit"])) {
        // Retrieve the login form data
        $loginEmail = $_POST["loginEmail"];
        $loginPassword = $_POST["loginPassword"];

        // Check if the user exists in the database
        $sql = "SELECT * FROM registration WHERE email = '$loginEmail' AND password = '$loginPassword'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            
            //   echo "Logged In";
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
        </script>

    </body>

    </html>