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
	                ID bigint(20) NOT NULL PRIMARY KEY,
	                jmeno text,
	                penize bigint DEFAULT 1500         
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
			
			$castka = 1500;
			$stmt = $conn->prepare('INSERT INTO ucty VALUES(:id, :jmeno, :penize)');
			$stmt->execute(array(
				':id'   => 1,
				':jmeno' => $_POST['h1'],
			    ':penize'   => $castka
			));
			$stmt->execute(array(
				':id'   => 2,
			   ':jmeno' => $_POST['h2'],
			   ':penize'   => $castka
			));	
			$stmt->execute(array(
				':id'   => 3,
			    ':jmeno' => $_POST['h3'],
			    ':penize'   => $castka
			));
			$stmt->execute(array(
				':id'   => 4,
				':jmeno' => $_POST['h4'],
			    ':penize'   => $castka
			    
			));
			$stmt->execute(array(
				':id'   => 5,
			   ':jmeno' => $_POST['h5'],
			   ':penize'   => $castka
			));	
			$stmt->execute(array(
				':id'   => 6,
			    ':jmeno' => $_POST['h6'],
			    ':penize'   => $castka
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