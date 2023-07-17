<html>
<head>
    <title>Install Parkamon</title>
</head>
<body>
<?php
require_once "config.php";
try {
    $dbh = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
    //create comic table
    $query = file_get_contents('test.sql');
    $dbh->exec($query);
    echo "<p>Successfully installed databases</p>";
}
catch (PDOException $e) {
    echo "<p>Error: {$e->getMessage()}</p>";
}
?>
</body>
</html>

<!-- https://www.php.net/manual/en/function.file-get-contents.php
https://www.php.net/manual/en/pdo.exec.php 
-->