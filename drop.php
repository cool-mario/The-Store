<html>
<head>
    <title>Parkamon drop</title>
</head>
<body>
<?php
require_once "config.php";

try {
    $dbh = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
    $dbh->exec('DROP TABLE IF EXISTS store; DROP TABLE IF EXISTS info;');
    $dbh->exec('DROP TABLE IF EXISTS items; DROP TABLE IF EXISTS info;');
    $dbh->exec('DROP TABLE IF EXISTS users; DROP TABLE IF EXISTS info;');
    $dbh->exec('DROP TABLE IF EXISTS cart;  DROP TABLE IF EXISTS info;');
    echo "<p>Successfully dropped databases</p>";
}
catch (PDOException $e) {
    echo "<p>Error: {$e->getMessage()}</p>";
}
?>
</body>
</html>
