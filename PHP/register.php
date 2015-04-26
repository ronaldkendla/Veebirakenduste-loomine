<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8" />

        <link rel="stylesheet" type="text/css" href="style/register.css">
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'>

        <script src="js/jquery-1.11.2.min.js" type="text/javascript"></script>
        <script src="js/registreeri.js" type="text/javascript"></script>

        <title>GoRentaBitify</title>
    </head>
    <body>
	    <div class="register">
            <?php
            if($_GET['msg']) { 
                echo '<span>' . $_GET["msg"] . '<span>';
            };
            ?>
            <form id='register-form' action='registreeri1.php' method='post' accept-charset='UTF-8'>
                <input type='hidden' name='submitted' id='submitted' value='1'/>

                <label>Email</label>
                <input type='text' name='email' id='email' maxlength="50" />

                <div id="valid"></div>

                <label>Name</label>
                <input type='text' name='fname' id='fname' maxlength="50" />

                <label>Username</label>
                <input type='text' name='uname' id='uname' maxlength="50" />
                 
                <label>Password</label>
                <input type='password' name='pass' id='pass' maxlength="50" />
                <input type='submit' name='Submit' value='Submit' />
            </form>
        </div>
    </body>
</html>