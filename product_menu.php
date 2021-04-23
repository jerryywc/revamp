<!DOCTYPE html>
<html>
	<head>
		<title>Revamp</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<?php require_once "_require/metalink.php"?>

	</head>
	<body>
		<header></header>
		<div class="hirevlogo"></div>

		<?php require_once "_require/navbar.php"?>

		

	
        <div class=" white mx-3">
          	<div class="row mx-0 px-0">
            	<div class="col-lg-3 col-md-4 col-sm-12 d-sm-none d-md-block">
	              	<div class="productmenu p-5">
	              		<h2>Products</h2>
	                	<a href="product_category.php?type=PCMO" class="productmenu-link">Motor Oil</a><br/>
	                	<a href="product_category.php?type=MO" class="productmenu-link">Motorcycle Oil</a><br/>
	                	<a href="product_category.php?type=IND" class="productmenu-link">Industrial Lubricants</a><br/>
	                	<a href="product_category.php?type=OP" class="productmenu-link">Other Products</a>
	              	</div>
            	</div>
            	<div class="col-lg-9 col-md-8  col-sm-12">
              		<div class="productoverview mb-4 pt-3">
                		<div class="row ">
			            	<div class="col-md-6 col-sm-12 p-3">
				              	<a href="product_category.php?type=PCMO"><img src="IMG/blank.png"/></a>
				              	<h3>Motor Oil</h3>
			            	</div>
			            	<div class="col-md-6  col-sm-12  p-3">
			              		<a href="product_category.php?type=MO"><img src="IMG/blank.png"/></a>
			              		<h3>Motorcycle Oil</h3>
			            	</div>
			            	<div class="col-md-6 col-sm-12 p-3">
				              	<a href="product_category.php?type=IND"><img src="IMG/blank.png"/></a>
				              	<h3>Industrial Lubricants</h3>
			            	</div>
			            	<div class="col-md-6  col-sm-12  p-3">
			              		<a href="product_category.php?type=OP"><img src="IMG/blank.png"/></a>
			              		<h3>Other Products</h3>
			            	</div>            
			        	</div>
			        	<div class="row ">
			            	<div class="col-md-6 col-sm-12 min-h-150 p-5">
			            		<p class=" assist-link">
				              		<a href="#"><img src="IMG/map-pointer.png"/>FIND HI-REV NEAR YOU</a>
				              	</p>
			            	</div>
			            	<div class="col-md-6 col-sm-12 min-h-150 p-5">
			              		<p class=" assist-link">
			              			<a href="#">FIND RIGHT OIL FOR YOUR VEHICLE</a>
			              		</p>
			            	</div>            
			        	</div>
              		</div>
            	</div>            
        	</div><!--EndOf row-->        	
    	</div>
	


		<?php require_once "_require/footer.php"?>

		<?php require_once "_require/js.php"?>
	</body>
</html>