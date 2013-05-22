<?php 
	include_once("classes/Db.class.php");
 	
	session_start();
	// Initialization
	$conn = mysql_connect('localhost', 'root', 'root');
	mysql_select_db('project', $conn);

	// Error checking
	if(!$conn) {
	    die('Could not connect ' . mysql_error());
	}

	/*$type   = isset($_GET['type']) ? $_GET['type'] : "global";
	$offset = isset($_GET['offset']) ? $_GET['offset'] : "0";
	$count  = isset($_GET['count']) ? $_GET['count'] : "100";
	$sort   = isset($_GET['sort']) ? $_GET['sort'] : "score DESC";*/



	$result = mysql_query("SELECT * FROM login ORDER BY punt DESC");

			if($result == FALSE) {
			    die(mysql_error()); // TODO: better error handling
			}
	
 ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Klassement</title>
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

			<!-- Ga terug naar vorige lijst -->
			

			
			<h1>Klassement</h1>
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
			while($row = mysql_fetch_array($result))
			{
				if ($row['name']==$_SESSION['name']) {
					echo "<tr><td><strong>".$row['name']."</strong><td><td><strong>".$row['punt']."</strong></td></tr>";
				}else{
					echo "<tr><td>".$row['name']."<td><td>".$row['punt']."</td></tr>";
				}
			    
			}
		?>
	</table>
 
		

		</div>

		<div data-theme="" data-role="footer" data-position="fixed">
			<a href="home.php" data-theme="b">Terug</a>

			<a  id="right" data-theme="b" href="vrienden.php">Score van vrienden</a>
		
		</div>
	</div>
</body>
</html>