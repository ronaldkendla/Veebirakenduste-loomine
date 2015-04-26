<?php

function dbconnect(){
    $servername="ruumiderent1.cloudapp.net";
    $username="guest";
    $password="guest";
    $dbname="ruumiderentdb";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    if($conn->connect_error){
        die("connection failed:" . $conn->connect_error);
    } else {
        return $conn;
    }
}
function getAllUsers() {
    $conn = dbconnect();
    $sql="SELECT * FROM WebsiteUsers";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
        } 
    } else {
         echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
function addUser($fname, $uname, $email, $pass) {
    $conn = dbconnect();
    $sql = "INSERT INTO WebsiteUsers (fullname, userName, email, pass) 
        VALUES ('$fname', '$uname', '$email', '$pass')";
    if ($conn->query($sql)) {
        echo "User  created okay?";
        // header("Location: index.html?msg=User was created successfully. You can now login.");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
function lengthControl($fname, $uname, $email, $pass) {
    if (strlen($email) < 1) {
        header("Location: register.php?msg=Email field was left empty.");
        return false;
    } elseif (strlen($fname) < 1) {
        header("Location: register.php?msg=Full name field was left empty.");
        return false;
    } elseif (strlen($uname) < 1) {
        header("Location: register.php?msg=Last name field was left empty.");
        return false;
    } elseif (strlen($pass) < 1) {
        header("Location: register.php?msg=Password field was left empty.");
        return false;
    }
    return true;
}
function checkEmail() {
    if(isset($_POST['email'])) {
        $conn = dbconnect();
        $email = $_POST['email'];
        $sql="SELECT * FROM WebsiteUsers WHERE email = '$email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "<span style='color:red;'>Already exists</span>";
            return false;
        } else {
            echo "<span style='color:green;'>Available</span>";
            return true;
        }
    }
}
function registering() {
    $fname = $_POST['fname'];
    $uname = $_POST['uname'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    if (lengthControl($fname, $uname, $email, $pass)) {
        if (checkEmail()) {
            addUser($_POST['fname'], $_POST['uname'], $_POST['email'], $_POST['pass']);
        } else {
            header("Location: register.php?msg=User with the given email already exists.");
        }
    }
}

/*function SignUp() 
{ 
	if(!empty($_POST['user']))  

{ 
	$query = "SELECT * FROM WebsiteUsers WHERE userName = '$_POST[user]' AND pass = '$_POST[pass]'"; 
    
	if(!$row = mysql_fetch_array($query) or die(mysql_error())) 
		{ 
			registering(); 
		} 
		else 
		{ 
			echo "You are already registered"; 
		} 
} 
} 
if(isset($_POST['submit'])) 
{ 
	SignUp(); 
} */

/*
function sec_session_start() {
    $session_name = 'sec_session_id';   // Set a custom session name
    $secure = SECURE;
    // This stops JavaScript being able to access the session id.
    $httponly = true;
    // Forces sessions to only use cookies.
    if (ini_set('session.use_only_cookies', 1) === FALSE) {
        header("Location: ../error.php?err=Could not initiate a safe session (ini_set)");
        exit();
    }
    // Gets current cookies params.
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"],
        $cookieParams["path"], 
        $cookieParams["domain"], 
        $secure,
        $httponly);
    // Sets the session name to the one set above.
    session_name($session_name);
    session_start();            // Start the PHP session 
    session_regenerate_id(true);    // regenerated the session, delete the old one. 
}

function login($email, $password, $mysqli) {
    // Using prepared statements means that SQL injection is not possible. 
    if ($stmt = $mysqli->prepare("SELECT id, username, password, salt 
        FROM members
       WHERE email = ?
        LIMIT 1")) {
        $stmt->bind_param('s', $email);  // Bind "$email" to parameter.
        $stmt->execute();    // Execute the prepared query.
        $stmt->store_result();
 
        // get variables from result.
        $stmt->bind_result($user_id, $username, $db_password, $salt);
        $stmt->fetch();
 
        // hash the password with the unique salt.
        $password = hash('sha512', $password . $salt);
        if ($stmt->num_rows == 1) {
            // If the user exists we check if the account is locked
            // from too many login attempts 
 
            if (checkbrute($user_id, $mysqli) == true) {
                // Account is locked 
                // Send an email to user saying their account is locked
                return false;
            } else {
                // Check if the password in the database matches
                // the password the user submitted.
                if ($db_password == $password) {
                    // Password is correct!
                    // Get the user-agent string of the user.
                    $user_browser = $_SERVER['HTTP_USER_AGENT'];
                    // XSS protection as we might print this value
                    $user_id = preg_replace("/[^0-9]+/", "", $user_id);
                    $_SESSION['user_id'] = $user_id;
                    // XSS protection as we might print this value
                    $username = preg_replace("/[^a-zA-Z0-9_\-]+/", 
                                                                "", 
                                                                $username);
                    $_SESSION['username'] = $username;
                    $_SESSION['login_string'] = hash('sha512', 
                              $password . $user_browser);
                    // Login successful.
                    return true;
                } else {
                    // Password is not correct
                    // We record this attempt in the database
                    $now = time();
                    $mysqli->query("INSERT INTO login_attempts(user_id, time)
                                    VALUES ('$user_id', '$now')");
                    return false;
                }
            }
        } else {
            // No user exists.
            return false;
        }
    }
}

*/




?>