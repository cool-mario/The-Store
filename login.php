<!DOCTYPE html>
<html  lang=en-US>
<head>
  <title>  Log In   </title>
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
  <style>
    body{
        text-align: center;
    }
    #loginBox{
    width:500px;
    height: 400px;
    margin: 0 auto;
    border: solid 5px black;
    border-radius: 5px;
    }
  </style>
</head>
  <body>
    <!-- Header -->
    <h1>Store Name</h1>
    <br>
    <!-- Greeting -->
    <h3>Please enter your login info </h3>
    <!-- Credentials Input -->
    <form action="store.php" method="post">
        <div id="loginBox">
            <div>
            <label for="userInput1">Please enter your username</label>
            <input id="userInput1" type="text" name="userName"></input>
            </div>
            <br>
            <div>
            <label for="userInput2">Please enter your password</label>
            <input id="userInput2" type="text" name="password"></input>
            </div>
            <br>
            <button type="submit">Enter</button>

        </div>
    </form>
  </body>
</html>
