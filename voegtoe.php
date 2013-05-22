<?php 
	include_once("classes/User.php");
 	

	// Initialization DB
	$conn = mysql_connect('localhost', 'root', 'root');
	mysql_select_db('project', $conn);

	// Error checking
	if(!$conn) {
	    die('Could not connect ' . mysql_error());
	}


$name=$_SESSION['name'];



	$vrienden = mysql_query("SELECT * FROM login WHERE vriend != 1 && name!= '$name' ORDER BY punt DESC ");

			if($vrienden == FALSE) {
			    die(mysql_error()); // TODO: better error handling
			}
/*ik moet de naam van de nieuwe vriend hebben
$selectVriend= "";*/

/*dit zorgt ervoor dat ik maar 1 record terug krijg*/
//$nieuw=mysql_fetch_array($vrienden);

/*voeg vriend toe*/
	if(isset($_POST['voegtoe'])){

		try {
			if ($nieuw['vriend']==0) {
				
			
				$telop=$nieuw['vriend']+1;
				
				$voegVriendToe = mysql_query("UPDATE login  SET vriend='$telop' WHERE name='$name'");//UPDATE login  SET vriend='1' WHERE name='wij'

					if($voegVriendToe == FALSE) {
					    die("fout met query".mysql_error()); // TODO: better error handling
					}


				$vrienden = mysql_query("SELECT name, punt FROM login WHERE vriend != 1 && name!= '$name' ORDER BY name ");

				if($vrienden == FALSE) {
				    die(mysql_error()); // TODO: better error handling
				}
			}
			
		} catch (Exception $e) {
			$e= "het werkt niet";
			echo $e;
		}


	}
	
 ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Voeg vrienden toe</title>
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
			
			<h1>Vrienden toevoegen</h1>
						<!--navigation-->
			<?php include_once("include/nav.php");?>
			
		</div>
		<div id="container" data-role="content">
		
		<?php
			
			
			echo $_SESSION['name'];
		?>

		<table>
			<tr>
				<td><strong>Naam</strong></td>
				<td><strong>Score</strong></td>
			</tr>
		<?php  
				
				while($row = mysql_fetch_array($vrienden))
				{
				    echo "<tr>
				    <td>".$row['name']."<td>
				    <td>".$row['punt']."</td>
				    <td width='10%'><form action=".$_SERVER['PHP_SELF']." method='post'>
				        <input type='submit' name='voegtoe' value='Voeg toe' />
				        </form>
				    </td>
				    </tr>";
				}

			
			
		?>
	</table>
 
		

		</div>

		<div data-role="footer" data-theme="" data-position="fixed">
			<!-- Ga terug naar vorige lijst -->
			<a href="vrienden.php" data-theme="b">Terug</a> 
		</div>
	</div>
</body>
</html>