<?php 
	
	include_once("classes/User.php");
	
	

	if(!isset($_SESSION['name']))
	{
		header("Location: index.php");
	}

	/*gratis of niet*/
	if (isset($_GET['gratis'])) {
		$free="&isfree=true";
	}
	

	/*Zoek op stad*/
	if(!empty($_GET['city'])){
    
        $c = "&city=".htmlspecialchars($_GET['city']);

	}else{
		$c = "";
	}
	/*Zoek op naam*/
	if(!empty($_GET['nameEvent'])){
    
        $n = "&q=".htmlspecialchars($_GET['nameEvent']);
	}else{
		$n = "";
	}
	/*zoek op datum*/
	if (!empty($_GET['datetype'])) {
		$d="&datetype=true";
	}else{
		$d="";
	}
	
	$url ="http://build.uitdatabank.be/api/events/search?key=AEBA59E1-F80E-4EE2-AE7E-CEDD6A589CA9&pagelength=300&sort=title&heading=muziek;film;komedie;festival;concert;nachtleven&format=json".$c.$n.$d.$free;
	$events = json_decode(file_get_contents($url));
	$ce=count(file_get_contents($url));




 ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Alle Events</title>
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" href="themes/orange.min.css" />
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.1/jquery.mobile.structure-1.3.1.min.css" />
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/css.css">
	<!--<link rel="stylesheet" href="themes/gray.min.css" />
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.1/jquery.mobile.structure-1.3.1.min.css" />
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/css.css">-->
</head>
<body>
	<div data-role="page">
		<div data-role="header">

			
			<h1 >Zoek een event</h1>
			<!--navigation-->
			<?php include_once("include/nav.php");?>
		</div>
		<div id="container" data-role="content">
		<!--de switch-->
		<!--<div data-role="fieldcontain">
		<label data-icon="search" for="toggleswitch1">Zoek</label>
            <select name="zoek" id="toggleswitch1" data-theme="" data-role="slider" data-icon="search">

                <option value="off">
                    Uit
                </option>
                <option value="on">
                    Aan
                </option>
            </select>
       <!-- </div>-->
		<!--zoek-->
			<form method="get">
				<table>
					<tr>
						<td><label>Naam</label></td>
						<td><input type="text" name="nameEvent" placeholder="Naam van het event"/></td>
					</tr>
					<tr>
						<td><label>Stad</label></td>
						<td><input type="text" name="city" placeholder="Naam van uw stad"/></td>
					</tr>
					
				</table>
			<div class="left">
				
					<select name="datetype">
                        <option value="" >Datum</option>
                        <option value="next12months">Binnen 12 maanden</option>
                        <option value="next6months">Binnen 6 maanden</option>
                        <option value="next3months">Binnen 3 maanden</option>
                        <option value="next30days">Binnen 30 dagen</option>
                        <option value="thismonth">Deze maand</option>
                        <option value="nextweekend">Volgende week</option>
                        <option value="thisweek">Deze week</option>
                        <option value="tomorrow">Morgen</option>
                        <option value="today">Vandaag</option>
             		</select>
             	
            
            </div>
            <div class="left">

             	
	             	<fieldset data-role="controlgroup" data-type="vertical">
	                <input id="checkbox1" name="gratis" type="checkbox" value='true'>
	                <label for="checkbox1">
	                    Gratis
	                </label>
	            	</fieldset>
	            
	        </div>
             	<div class="clear">
						<input  type="submit" value="zoek" data-icon="search" data-iconpos="right"/>
				</div>
			</form>
		<!--einde zoek-->
			<br/>
			<?php 
			
				if(empty($_GET['city'])&& empty($_GET['nameEvent'])){
					echo "<h3>Zoek op de naam, stad en/of datum en kijk wat er allemaal te doen valt.</h3>";
					} else{
						if(empty($events)){
							echo "<h3>Wij kunnen het gevraagde event niet weergeven</h3>";
							} else{
					?>
		
		<!--geef lijst weer-->
		
		
			<ul data-role="listview" data-inset="true" data-filter="true">
			<?php 
			//if(isset($event->event->categories->category->concert))
			//{
				try 
				{
					foreach ($events as $e) 
					{
						echo "<li><a id='footer' href='list_details.php?id=".$e->cdbid."'>".$e->title."</a></li>";
					}
					
				} catch  (Exception $ex)
				{
					echo $ex="<h2>Sorry, er zijn geen evenementen gevonden</h2>";
					
				}




			//}
			 ?>

			</ul>
			<?php } }?>
		
		</div>

		<div data-theme="" data-role="footer" data-position="fixed">
			<!--<a href=\"javascript:history.go(-1)\" data-theme="b">Terug</a>-->
		</div>
	</div>
</body>
</html>