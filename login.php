<!DOCTYPE html>
<html  lang=en-US>
<head>
  <title>  Whimsy Wares - Log In   </title>
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
  <!-- import styles -->
  <link rel="stylesheet" href="style.css">
    <style>
        body {
            text-align:center;
        }
        form {
            outline: 5px solid #03a283;
            padding: 1.5% 4% 1.5% 4%;
            border-radius: 10px;
            line-height: 2;
            margin-left: auto;
            margin-right: auto;
            width: 20vw;
        }
        form > p, form > input, form > p {
          font-size: 2vmin;
        }
    </style>
</head>
    <body>
        <!-- Header -->
        <h1>Whimsy Wares!</h1>
        <br>
        <!-- Greeting -->
        <h3>Please enter your login info </h3>
        <!-- Credentials Input -->
        <form action="store.php" method="post">

            <label for="userInput1">Please enter your username: </label>
            <input id="userInput1" type="text" name="userName"></input>
            <br>
            <label for="userInput2">Please enter your password: </label>
            <input id="userInput2" type="password" name="password"></input>
            <br>
            <input type="submit" value="Log in">

            <?php
                // print different error message depending on the get information
                if (isset($_GET['m'])){
                    if ($_GET['m'] == "name"){
                        echo "<br><br><strong class='error'>Incorrect Username!!!!</strong>";
                    } elseif ($_GET['m'] == "pass"){
                        echo "<br><br><strong class='error'>Incorrect Password!!!!</strong>";
                    }
                }
            ?>
            

        </form>
        <br>
        <a href="signup.php">Register a new user</a>
    </body>
</html>
