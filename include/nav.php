<?php  
	$currentPage= $_SERVER['PHP_SELF'];
	//laten ontploffen naar aarrray 
	//op basis van delimiter
	$url = explode("/", $currentPage);
	//neem laatste element uit array via end()
	$page = end($url);
?>
<style type="text/css">
	nav{
		text-align: center;
		color: #fff;

	}
	

</style>

        <div data-role="navbar" data-iconpos="top" >
            <ul>
                <li>
                    <a href="home.php" data-transition="fade" data-theme="b" data-icon="">
                        Home
                    </a>
                </li>
                <li>
                    <a href="list-events.php" data-transition="fade" data-theme="b" data-icon="">
                        Events
                    </a>
                </li>
                <li>
                    <a href="indekijker.php" data-transition="fade" data-theme="b" data-icon="">
                        In de kijker
                    </a>
                </li>
                <li>
                    <a href="klassement.php" data-transition="fade" data-theme="b" data-icon="">
                        Klassement
                    </a>
                </li>
            </ul>
        </div>
        

<!--<div data-role="navbar" data-iconpos="top">
				
					<a data-transition="fade" data-theme="a"
					<?php if ($page=="home.php") {
							echo 'class="selected"';
					}?>  
						href="home.php">Home
					</a>
					<a data-transition="fade" data-theme="a"
					<?php if ($page=="list-events.php") {
						echo 'class="selected"';
					}?>  
						href="list-events.php">Events
					</a>
					<a data-transition="fade" data-theme="a"
					<?php if ($page=="klassement.php") {
						echo 'class="selected"';
					}?>  
						href="klassement.php">Klassement
					</a>
					<a data-transition="fade" data-theme="a"
					<?php if ($page=="vrienden.php") {
						echo 'class="selected"';
					}?>  
						href="vrienden.php">Vrienden
					</a>
				
</div>-->
