<?php 
	include_once("classes/User.php");
	// Initialization
	$conn = mysql_connect('localhost', 'root', 'root');
	mysql_select_db('project', $conn);

	// Error checking
	if(!$conn) {
	    die('Could not connect ' . mysql_error());
	}

	if(isset($_GET['id'])){
		$id = $_GET['id'];
	}
	$gepost=1;
	//maak van sessie een variable
	$name=$_SESSION['name'];
	$punten= mysql_query("SELECT name, punt FROM login WHERE name = '$name'");
		 	if($punten == FALSE) {
					    echo "fout met query".mysql_error(); // TODO: better error handling
					}


	$url="http://build.uitdatabank.be/api/event/".$id."?key=AEBA59E1-F80E-4EE2-AE7E-CEDD6A589CA9&format=json";
	$event= json_decode(file_get_contents($url));
	$pageURL = "http://localhost:8888".$_SERVER['REQUEST_URI'] ;

	
		
//
$row=mysql_fetch_array($punten);
	
	
if(isset($_POST['addpoint'])){

	try {
		$telop=$row['punt']+1;
		
		$result = mysql_query("UPDATE login  SET punt='$telop' WHERE name='$name'");//UPDATE login  SET vriend='1' WHERE name='wij'

			if($result == FALSE) {
			    die("fout met query".mysql_error()); // TODO: better error handling
			}

			/*haal de date nog eens op zodat het direct verschijnt*/
		$punten= mysql_query("SELECT name, punt FROM login WHERE name = '$name'");
		 	if($punten == FALSE) {
					    die("fout met query".mysql_error()); // TODO: better error handling
					}
		/*refresh de pagina om de score te zien*/
		$gepost=$gepost+1;
		header('Location: '.$_SERVER['REQUEST_URI']);
		


	} catch (Exception $e) {
		$e= "het werkt niet";
		echo $e;
	}
 	
	


}

	if ($gepost=1) {
		$gepost='<input type="submit" name="addpoint" value="Dit ga ik doen!" id="addpoint">';
	}else{
		$gepost='<input style="display:none;" type="submit" name="addpoint" value="Dit ga ik doen!" id="addpoint">';
	}
	

 ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>List details</title>
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
			<?php echo "<a href=\"javascript:history.go(-1)\">Vorige</a>"; ?>
		<h1><?php echo $event->event->eventdetails->eventdetail->title;  ?></h1>
					<!--navigation-->
			<?php include_once("include/nav.php");?>
		
		</div>

		<div data-role="content">
			
			<!--haal de naam en score op-->
			<table>
			<?php 
			//geef de gebruiker weer met zijn score
				echo "<tr><td><strong>Gebruiker:</strong></td><td>"
				.$row['name']."</td><td><strong>Score:</strong></td><td>"
				.$row['punt']."</td></tr>";
			?>
			</table>
			<!-- Geef de event details weer-->
			<?php echo "<p>".$event->event->eventdetails->eventdetail->longdescription."</p>";  

				/*//Prijs weergeven
				if (isset($event->event->eventdetails->eventdetail->price)) {
					$prijs=$event->event->eventdetails->eventdetail->price;
					echo "<ul><li><strong>Prijs:</strong></li>";
						foreach ($prijs as $p ) {
							
								echo "<il>".$p->pricevalue."</il>";
							
								
							
						}
					echo "</ul>";
				}else{
								echo "hij vindt price niet terug";
							}*/
				//image
				if(isset($event->event->eventdetails->eventdetail->media->file))
				{
					$images= $event->event->eventdetails->eventdetail->media->file;
					foreach ($images as $image ) 
					{
						if(isset($image->mediatype))
						{
							if($image->mediatype=="photo")
							{
							echo "<img width='100%' src='".$image->hlink."'/>";
							}
						}
					}
					
				}	
			?>
			<br/><br/>
			<?php 
			//kalender
				if (isset($event->event->eventdetails->eventdetail->calendarsummary)) {

					echo "<strong>Kalender</strong><br/>".$event->event->eventdetails->eventdetail->calendarsummary;
				}
			?>
			</p>

			<address><strong>Adres</strong><br/>
			
		
				<?php 
				//adres
				if(isset($event->event->contactinfo->address->physical))
				{
					$address= $event->event->contactinfo->address->physical;
					echo "<strong> Straat: </strong>".$address->street.
					"<strong> Nr: </strong>".$address->housenr."</br> <strong>Plaats: </strong>"
					.$address->zipcode." ".$address->city."</address> <br/>";
				}

				/*
				$datum= $event->event->calendar->timestamps->timestamp;
				echo "<p><strong> Datum: </strong>".$datum->date."</br><strong> Tijdstip: </strong>".$datum->timestart."</p></br>";
				*/

							
	
		 		?>
		 		<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" >
		 		<?php echo $gepost;?><input type="hidden">
				</form>
				
			
		 </div>
		 <div data-role="footer" data-position="fixed">
			<!-- Ga terug naar vorige lijst 
			<a href=\"javascript:history.go(-1)\">Terug</a>-->
		</div>
	</div>
</body>
</html>