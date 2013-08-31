<?php 
//$title = "NewDB";
//include("../header.php");
?>
<?php 
	function vytvordb(){
	    $dbname='Bank.db';
	    $mytable ="ucty";
	    
	    if(!class_exists('SQLite3'))
	      die("SQLite 3 NOT supported.");
	 
	    $base=new SQLite3($dbname, 0666);
	    //echo "SQLite 3 supported."; 
	     
	    $query = "DROP TABLE $mytable";
	    $base->exec($query); 
	    $query = "CREATE TABLE $mytable(
	                ID INTEGER PRIMARY KEY,
	                jmeno text,
	                penize bigint DEFAULT 1500,
	                dluh bigint
	                )";
	    $results = $base->exec($query);
	    
	    $query = "DROP TABLE log";
	    $base->exec($query); 
	    $query = "CREATE TABLE log(
	                ID INTEGER PRIMARY KEY,
	                od text,
	                komu text,
	                penize bigint,
	                zobrazeno STATUS VARCHAR DEFAULT 'FALSE'         
	                )";
	    $results = $base->exec($query);
	}
	function napln() {
		try {
			$conn = new PDO('sqlite:Bank.db');
			
			$stmt = $conn->prepare('INSERT INTO ucty VALUES(null, :jmeno, 1500, null)');
			$stmt->execute(array(
				':jmeno' => $_POST['h1']
			));
			$stmt->execute(array(
			   ':jmeno' => $_POST['h2']
			));
			$stmt->execute(array(
			    ':jmeno' => $_POST['h3']
			));
			$stmt->execute(array(
				':jmeno' => $_POST['h4']
			));
			$stmt->execute(array(
			   ':jmeno' => $_POST['h5']
			));	
			$stmt->execute(array(
			    ':jmeno' => $_POST['h6']
			));			
		}	
		catch (PDOException $e) {
			error_log("Databaze neni dostupna " . $e, 0);
			echo("<b>Databaze neni dostupna</b><br> " . $e);
		}		
	}
	vytvordb();
	napln();
	
	header ("Location: ../index.php");
?>

</head>
<body>
<h1>NewDB DEBUG</h1>
<?php 
echo $_POST["h1"] . "<br>";
echo $_POST["h2"] . "<br>";
echo $_POST["h3"] . "<br>";
echo $_POST["h4"] . "<br>";
echo $_POST["h5"] . "<br>";
echo $_POST["h6"] . "<br>";
 ?>

</body>
</html>