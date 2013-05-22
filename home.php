<?php 
	
		session_start();
		if (empty($_SESSION['name'])) {
		header('Location: index.php');
	}
		include_once("classes/Promoot.class.php");

		$conn = mysql_connect('localhost', 'root', 'root');
		mysql_select_db('project', $conn);

		// Error checking
		if(!$conn) {
		    die('Could not connect ' . mysql_error());
		}

		$name=$_SESSION['name'];


		$tweet = new Tweet();
		if(isset($_POST['btnCreatePost']))
		{
			try
			{
				$tweet->Text = $_POST['post'];
				$tweet->UserId = $row['id'];//get this from session instead of hardcoded!
				//$tweet->id =$row['id'];
				$tweet->Save();
				$feedback['text'] = "Your tweet has been posted!";
				$feedback['status'] = "success";
			}
			catch(Exception $e)
			{
				$feedback['text'] = $e->getMessage();
				$feedback['status'] = "error";
			}
		}

		$allTweets = $tweet->getAll();


		$result = mysql_query("SELECT punt FROM login WHERE name='$name' ORDER BY punt DESC");

				if($result == FALSE) {
				    die(mysql_error()); // TODO: better error handling
				}
			
	
 ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>De VervelingsApp</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" href="themes/orange.min.css" />
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.1/jquery.mobile.structure-1.3.1.min.css" />
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/css.css">
</head>
<body>
	<div data-role="page">
		<div class="header1" data-role="header" >
			

				<h1>De VervelingsApp</h1>
				<!--navigation-->
			<?php include_once("include/nav.php");?>
		</div>
		

		<div id="container" data-role="content">
			
		<div data-role="content">
		<h2>Welkom </h2>
		<table>
			<tr>
				<td><strong>Gebruiker:</strong></td>
				<td><?php echo $_SESSION['name'] ;?></td>
			</tr>
			<tr>
				<td><strong>Email:</strong></td>
				<td><?php echo $_SESSION['email'] ;?></td>
			</tr>
			<tr>
				<td><strong>Score:</strong><td>
				<?php 
					while($row = mysql_fetch_array($result))
				{
						echo "<td>".$row['punt']."</td>";
				}

				 ?>
			 </tr>
		</table>
	
	
	<section id="tweets">
		<h3>Wat staat er in de kijker?</h3>
		
		<ul>
		<?php if(count($allTweets) > 0): ?>
		<?php foreach($allTweets as $tweet){ ?>
			<li class="clearfix">
				
				<!--<img class="avatar" src="images/avatar.jpg" />-->
				<p><?php echo $tweet['text'] . "<br/> <i>Gepost op: " . $tweet['date_posted'] . "</i>"; ?></p>
				<p>_________________________</p>
			</li>
		<?php } ?>
		<?php else: ?>
		<li id="noposts">Oops, er zijn momenteel geen evenementen in de kijker</li>
		<?php endif; ?>
		</ul>
		
		
		
	</section>
        
        
    </div>
		

		</div>


		<div data-theme="" data-role="footer" data-position="fixed">
			<a href="logout.php" data-theme="b">Logout</a>
		</div>
	</div>
	<!-- scripts at the bottom for faster loading -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="js/app.js"></script>
</body>
</html>