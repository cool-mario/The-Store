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
    </style>
    <title>Document</title>
</head>
<body>
    <h1>Register your account</h1>

    <form method="post" action="store.php">
        <label for="userInput1">Please enter a username: </label>
        <br>
        <input id="userInput1" type="text" name="inputName"></input>
        <br>
        <br>
        <label for="userInput2">Please enter a password: </label>
        <br>
        <input id="userInput2" type="password" name="inputPass"></input>
        <br>
        <input type="submit" value="register"></input>
    </form>
    
</body>
</html>
