<?php
	$currentpage = basename($_SERVER['PHP_SELF']);

	$home_active = "";
	$product_active = "";
	$career_active = "";
	
	if($currentpage == "index.php"){
		$home_active = "active";

	} else if($currentpage == "product_menu.php" || $currentpage == "product_category.php" || $currentpage == "product.php"){
		$product_active = "active";

	} else if($currentpage == "career.php"){
		$career_active = "active";

	} 

?>

<nav class="navbar navbar-fixed-top navbar-expand-lg navbar-light">
			
	  		<a class="navbar-brand d-lg-none ml-4 pl-2" href="#">Hirev</a>
	  		
	  		<button class="navbar-toggler" class="background-color:white" type="button" data-toggle="collapse" data-target="
	  			#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    		<span class="navbar-toggler-icon"></span>
	  		</button>

	  		<div class="collapse navbar-collapse text-center" id="navbarSupportedContent">
			    <ul class="navbar-nav mx-auto">
			      	<li class="nav-item  text-left rightborder">
			        	<a class="nav-link <?=$home_active?>" href="index.php">Home</span></a>
			      	</li>

			      	<li class="nav-item rightborder text-left">
			        	<a class="nav-link" href="#">About Us</a>
			      	</li>

			      	<li class="nav-item rightborder text-left">
			        	<a class="nav-link <?=$product_active?>" href="product_menu.php">Products</a>
			      	</li>

			      	<li class="nav-item rightborder text-left">
			        	<a class="nav-link" href="#">Recommender</a>
			      	</li>

			      	<li class="nav-item rightborder text-left">
			        	<a class="nav-link" href="#">Contact</a>
			      	</li>

			      	<li class="nav-item rightborder text-left">
			        	<a class="nav-link <?=$career_active?>" href="career.php">Career</a>
			      	</li>
			    </ul>			    
			</div>
		</nav>