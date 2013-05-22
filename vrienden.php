<?php 
	//include_once("classes/Db.class.php");
 	
    session_start();
	// Initialization
	$conn = mysql_connect('localhost', 'root', 'root');
	mysql_select_db('project', $conn);

	// Error checking
	if(!$conn) {
	    die('Could not connect ' . mysql_error());
	}

	
	$name=$_SESSION['name'];


	$vrienden = mysql_query("SELECT name, punt FROM login WHERE vriend != 0 ORDER BY punt DESC");

			if($vrienden == FALSE) {
			    die(mysql_error()); // TODO: better error handling
			}
	
 ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Vrienden</title>
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" href="themes/orange.min.css" />
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.1/jquery.mobile.structure-1.3.1.min.css" />
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/css.css">
</head>
<body>
	<div data-role="page">
		<div data-role="header">
			

			

			<!--logout btn-->
			
			<h1>Mijn vrienden</h1>
			<!--navigation-->
			<?php include_once("include/nav.php");?>
			
		</div>
		<div id="container" data-role="content">
		
		<?php
			/*$query = mysql_query("select * from name order by punt");*/
			
			
		?>
		<table>
			<tr>
				<td><strong>Naam</strong></td>
				<td><strong>Score</strong></td>
			</tr>
		<?php  
			
				while($row = mysql_fetch_array($vrienden))
				{
				    echo "<tr><td>".$row['name']."<td><td>".$row['punt']."</td></tr>";
				}
			
			
		?>
	</table>
 
		

		</div>

		<div data-theme="" data-role="footer" data-position="fixed" >
			<a href="klassement.php" data-theme="b">Terug</a> 
			<!--<a  id="right" data-theme="b" href="voegtoe.php">Voeg vrienden toe</a>-->
		</div>
	</div>
</body>
</html>