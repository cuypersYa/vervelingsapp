 <?php  
	$currentPage= $_SERVER['PHP_SELF'];
	//laten ontploffen naar aarrray 
	//op basis van delimiter
	$url = explode("/", $currentPage);
	//neem laatste element uit array via end()
	$page = end($url);
?>
 <div data-role="footer" data-theme="b">
			<!-- Ga terug naar vorige lijst -->
			<?php echo "<a href=\"javascript:history.go(-1)\">Vorige</a>"; ?>
</div>