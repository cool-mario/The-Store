<!DOCTYPE html>
<html  lang=en-US>
<head>
  <title>  Catch Results  </title>
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
</head>
  <body>
    <h1>Store Home Page</h1>
    <!-- List of products -->
    <table>
    <?php
    require_once "config.php";
    try {
          // Getting PKM
          $dbh = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
          $sth = $dbh->prepare("SELECT * FROM items"); 
          $sth->execute();
          $items = $sth->fetchAll(); 
          
        foreach($items as $item){
        echo "<tr>";
          echo "<td>" . $item["name"] . "</td>";
          echo "<td>" . $item["price"] . "</td>";
          echo "</tr>";
        }
        //   Cycling and inserting items into table
      }
      catch (PDOException $e) {
          echo "<p>Error connecting to database!</p>";
          echo $e->getMessage();
      }
    ?>
    </table>

  </body>
</html>
