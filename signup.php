<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <style>
        body{
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
        form > label, form > input, form > p {
          font-size: 2vmin;
        }
    </style>
    <title>Create new account</title>
</head>
<body>
    <h1>Whimsy Wares!</h1>
    <br>
    <h2>Register your account</h2>

    <form method="post" action="store.php">
        <label for="userInput1">Please enter a username: </label>
        <br>
        <input id="userInput1" type="text" name="inputName"></input>
        <br>
        <label for="userInput2">Please enter a password: </label>
        <br>
        <input id="userInput2" type="password" name="inputPass"></input>
        <br>
        <input type="submit" value="register"></input>
    </form>

    <?php
    // print an error message if the user's username is taken already. store.php redirect back with the get info
    if (isset($_GET['m'])){
        if ($_GET['m'] == "taken" && isset($_GET['n'])){
            echo "<br><br><strong class='error'>Sorry, the username \"" . htmlspecialchars($_GET['n']) . "\" is taken!!!!</strong><br>";
        }
    }
    ?>

    <br>
    <a href="login.php">Already have an account? Login</a>
    
</body>
</html>
