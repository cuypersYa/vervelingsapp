<?php 
	include_once("classes/User.php");
	
	/*if (!empty($_SESSION['name'])) {
		header('Location: home.php');
	}*/
	
	if(isset($_COOKIE['login']))
	{

		$cookieval = explode(',', $_COOKIE['name']);
		$_SESSION['name'] = $cookieval[0];
		$_SESSION['email'] = $cookieval[1];
		header('Location: home.php');
	}
	

	// DETECTEER SIGN UP
	if(isset($_POST['btnSignup']))
	{
		
		try
		{
			
			$user = new User();
			$user->Name = $_POST['name'];
			$user->Email = $_POST['email'];
			$user->Password = $_POST['password'];
			$user->Register();
			
			if($user->CanLogin()){
				$_SESSION['name'] = $user->Name;
				$_SESSION['email'] = $user->Email;
				header('Location: home.php');
			};
		}
		catch(Exception $e)
		{
			$error = $e->getMessage();
		}
	}

	//DETECTEER SIGN IN
	if(isset($_POST['btnLogin'])){
		
	
		
			
			$user = new User();
			$user->Email = $_POST['username'];
			$user->Password = $_POST['password'];

//header('Location: index.php');

			if($user->CanLogin()){
				$_SESSION['name'] = $user->Name;
				$_SESSION['email'] = $user->Email;
				header('Location: home.php');
				
				
			}
			
		
	}

 ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>VervelingsApp</title>
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" href="themes/orange.min.css" />
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.1/jquery.mobile.structure-1.3.1.min.css" />
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/css.css">
</head>
<body>
	<div data-role="page">
		<div data-role="header" class="header">
			
			<h1>De VervelingsApp</h1>
			<!--<form method="get">
			<input type="text" name="city" placeholder="Naam van uw stad"/>
			<input type="submit" value="zoek"/>
			</form>-->
		</div>
		<div data-role="content">
			

	<section id="login">
		<h2>Log in</h2>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<input type="text" name="username" placeholder="Email" />
		<input type="password" name="password" placeholder="Password" />
		<input type="submit" name="btnLogin" value="Sign in" />
		<!--<input type="checkbox" name="rememberme" value="yes" id="rememberme">
		<label for="rememberme">Remember me</label>-->
		</form>
		
	</section>	
	
	
	<section id="signup">
	
		<h2>Sign Up</h2>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<input type="text" name="name" placeholder="Full name" />
		<input type="email" name="email" placeholder="Email" />
		<input type="password" name="password" placeholder="Password" />
		<input type="submit" name="btnSignup" value="Sign up" />
		</form>
		
	</section>
		</div>
		<div data-theme="" data-role="footer" data-position="fixed">
			
		</div>
	</div>
</body>
</html>