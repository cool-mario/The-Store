<!DOCTYPE html>
<html  lang=en-US>
<head>
  <title>  Log In   </title>
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
  <link rel="stylesheet" href="style.css">
    <style>
        form {
            outline: 5px solid #03a283;
            padding: 1.5% 4% 1.5% 4%;
            border-radius: 10px;
            line-height: 2;
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

        <label for="userInput1">Please enter your username</label>
        <input id="userInput1" type="text" name="userName"></input>
        <br>
        <label for="userInput2">Please enter your password</label>
        <input id="userInput2" type="password" name="password"></input>
        <br>
        <input type="submit" value="Log in">


      </form>
  </body>
</html>
