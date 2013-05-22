<?php 
	
		session_start();
		include_once("classes/Promoot.class.php");

		$conn = mysql_connect('localhost', 'root', 'root');
		mysql_select_db('project', $conn);

		// Error checking
		if(!$conn) {
		    die('Could not connect ' . mysql_error());
		}

		$name=$_SESSION['name'];
		$owner = mysql_query("SELECT id, name FROM login WHERE name ='$name'");
		$row = mysql_fetch_array($owner);

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
		
	
 ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>In de kijker</title>
	
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
			

				<h1>In de kijker</h1>
				<!--navigation-->
			<?php include_once("include/nav.php");?>
		</div>
		

		<div id="container" data-role="content">
			
		<div data-role="content">
			<section id="newpost">
		<form action="" method="post">
			<label for="post" id="feedback"><h2>Wat wil je promoten?</h2></label>	
			<textarea name="post" id="post" cols="30" rows="2" placeholder="Vergeet zeker de naam, stad en datum niet te vermelden"></textarea>		
			<input type="submit" name="btnCreatePost" id="btnCreatePost" value="Send" />
			<!--<img id="loading" src="themes/images/loading.gif" />-->
			
			
		</form>
	</section>
	
	<section id="tweets">
		<h2>Wat staat er in de kijker?</h2>
		
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
		<li id="noposts">Oops, there are no posts yet.</li>
		<?php endif; ?>
		</ul>
		
		
		
	</section>
        
        
    </div>
		

		</div>


		<div data-theme="" data-role="footer" data-position="fixed">
			<a href=\"javascript:history.go(-1)\" data-theme="b">Vorige</a>
		</div>
	</div>
	<!-- scripts at the bottom for faster loading -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="js/app.js"></script>
</body>
</html>