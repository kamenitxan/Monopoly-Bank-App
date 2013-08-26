<?php
$dbname='Bank.db';
if(!class_exists('SQLite3'))
  die("SQLite 3 NOT supported.");
 
$base=new SQLite3($dbname, 0666);
echo "SQLite 3 supported."; 
?>

<?php
$dbname='Bank.db';
$mytable ="ucty";
 
if(!class_exists('SQLite3'))
   die("SQLite 3 NOT supported.");
 
$base=new SQLite3($dbname, 0666); 
 
$query = "CREATE TABLE $mytable(
            ID bigint(20) NOT NULL PRIMARY KEY,
            jmeno text,
            penize bigint          
            )";
$results = $base->exec($query);



?>

