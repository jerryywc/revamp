<?php require_once "_require/dbconn.php"?>

<?php 
	// fetch request parameters
	$type = "PCMO"; // default
	$category = "";

	if(isset($_GET['type']) && !empty(trim($_GET['type'])))
	{
		$type = $_GET['type'];
	}

	if(isset($_GET['category']) && !empty(trim($_GET['category'])))
	{
		$category = $_GET['category'];
	}


	try{
		// get all other type and type desc for sidenav_others (not specified type)
		$sql = "SELECT item_cat, item_cat_desc FROM invent_cat WHERE item_cat != ? and status = 1 GROUP BY item_cat, item_cat_desc";

		if($stmt = mysqli_prepare($conn, $sql)){
			mysqli_stmt_bind_param($stmt, "s", $type);
            $result = mysqli_stmt_execute($stmt);
        } 

        $result = $stmt -> get_Result();

        $index = 0;
        $sidenav_others = "";

        $sidenav_others .= '<h5>Other Categories</h5>';
        $sidenav_others .= '<ul class="category-side-menu">'; // open tag for ul
        while($row = mysqli_fetch_array($result)){
        	$sidenav_others .= '<li><a href="product_category.php?type=' . $row['item_cat'] . '">' . 
	        						$row['item_cat_desc'] . '</a></li>';
        }
        $sidenav_others .= '</ul>'; // close tag for ul




		// get all type and type desc for type combo box
		$sql = "SELECT item_cat, item_cat_desc FROM invent_cat WHERE status = 1 GROUP BY item_cat, item_cat_desc";

		if($stmt = mysqli_prepare($conn, $sql)){
            $result = mysqli_stmt_execute($stmt);
        } 

        $result = $stmt -> get_Result();

        $index = 0;
        $type_options = "";

        while($row = mysqli_fetch_array($result)) {
        	$type_options .= '<option value="' . $row['item_cat_desc'] . '" selected>' . $row['item_cat_desc'] . '</option>';
        }




        // get all categories and categories desc for sidenav and category combo box
		$sql = "SELECT * FROM invent_cat WHERE item_cat = ? and status = 1";

		if($stmt = mysqli_prepare($conn, $sql)){
			mysqli_stmt_bind_param($stmt, "s", $type);
            $result = mysqli_stmt_execute($stmt);
        } 

        $result = $stmt -> get_Result();
                
        $index = 0;
        $type_desc = "";
        $sidenav = "";
		$category_options = "";

        while($row = mysqli_fetch_array($result)) {
        	$type_desc = $row['item_cat_desc'];

        	// get the first type desc as label for side nav, then start the ul for sidenav
        	if($index == 0){
        		$sidenav .= '<h4>' . $type_desc . '</h4>';
        		$sidenav .= '<ul class="category-side-menu">'; // open tag for ul
        	}

        	if(strcmp($row['item_cat'], $type) == 0){ // if type matched. list down all category for this type only

        		if(empty($category)){ 
        			// if no category specified, first item set to active
        			if($index == 0){ 
        				$sidenav .= '<li><a href="#" onclick="loadCategory(this,\'' . $row['item_cat_det'] . '\');return false;" class="active">' . 
        							$row['item_cat_det_desc'] . '</a></li>';
        			} else {
        				$sidenav .= '<li><a href="#" onclick="loadCategory(this,\'' . $row['item_cat_det'] . '\');return false;">' . 
        							$row['item_cat_det_desc'] . '</a></li>';
        			}

        		} else {
        			// if category specified, set the matching category to active
	        		if(strcmp($row['item_cat_det'], $category) == 0){ // if category matched, set it to active
	        			$sidenav .= '<li><a href="#" onclick="loadCategory(this,\'' . $row['item_cat_det'] . '\');return false;" class="active">' . 
	        						$row['item_cat_det_desc'] . '</a></li>';
	        		} else {
	        			$sidenav .= '<li><a href="#" onclick="loadCategory(this,\'' . $row['item_cat_det'] . '\');return false;">' . 
	        						$row['item_cat_det_desc'] . '</a></li>';
	        		}
	        	}

				$category_options .= '<option value="' . $row['item_cat_det'] . '" selected>' . $row['item_cat_det_desc'] . '</option>';
        	} 
        	$index++;
        }
        $sidenav .= '</ul>'; // close tag for ul




	} catch (mysqli_sql_exception $e){
        echo $e->getMessage();    
    }

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Revamp</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<?php require_once "_require/metalink.php"?>

		<style>
			ul.category-side-menu{
				list-style-type: none;
				padding:10px 0;
				margin:10px 0;
			}

			ul.category-side-menu li a{
				color:black;
				padding:2px 5px;
			}

			ul.category-side-menu li a.active{
				background-color:maroon;
				color:white;
				font-weight:bold;
				text-transform: none;
				border-radius:5px;
			}

			ul.category-side-menu li a:hover{
				color:lightgrey;
				text-decoration: none;
			}

			div.product{
				
			}

			div.product .product-panel{
				width:100%;
			}

			.feather{
				color:grey;
			}



			.feather-32{
				width:32px;
				height:32px;
			}
		</style>

	</head>
	<body>
		<header></header>
		<div class="hirevlogo"></div>

		<?php require_once "_require/navbar.php"?>

		

	
        <div class=" white mx-3">
        	<p class="px-2 py-1">
				<a href="product_menu.php" class="text-uppercase">Products</a> /
				<?=$type_desc?>
			</p>
			<div class="row justify-content-around m-0 p-0 d-sm-flex d-lg-none">
				<select class="col-5 m-0 py-3">
					<?=$type_options?>
				</select>
				<select class="col-5 m-0 px-1 py-3">
					<?=$category_options?>
				</select>
			</div>
			
          	<div class="row mx-0 px-0">
            	<div class="col-lg-2 col-md-4 col-sm-12 d-none d-lg-block mx-0 px-0">
	              	<div class="px-4 py-2 ">                	
	                	<?=$sidenav?>
	              	</div>
	              	<div class="px-4 py-2 ">                	
	                	<?=$sidenav_others?>
	              	</div>
            	</div>
            	<div class="col-lg-10 col-md-12  col-sm-12">
            		<div class="row mx-0 px-3 my-1 justify-content-end border-top border-bottom" style="background-color:Gainsboro">
						<span class="pt-1 mx-3">Order:</span>
						<a href="#" onclick="grid();return false;">
							<span class="px-1 feather feather-32" data-feather="grid"></span>
						</a>

						<a href="#" onclick="list();return false;">
							<span class="px-1 feather feather-32" data-feather="list"></span>
						</a>
					</div>
              		<div class="row mx-0 px-0 product-panel mb-4 pt-3">

                		<!-- List item by selected category using ajax -->
                		<div class="row mx-0 px-0 product col-6 col-sm-6 col-md-4 col-xl-3">
                			<div class="row mx-0 px-0 m-1 p-1 border product-panel">
	                			<div class="product-img col-12">
	                				<img src="IMG/fulls.png"/>
	                			</div>
	                			<div class="product-desc col-12">
	                				H
	                			</div>
	                			<div class="product-price col-12">
	                				RM999.00
	                			</div>
	                		</div>
                		</div>
                		<div class="row mx-0 px-0 product col-6 col-sm-6 col-md-4 col-xl-3">
                			<div class="row mx-0 px-0 m-1 p-1 border product-panel">
	                			<div class="product-img col-12">
	                				<img src="IMG/fulls.png"/>
	                			</div>
	                			<div class="product-desc col-12">
	                				I
	                			</div>
	                			<div class="product-price col-12">
	                				RM999.00
	                			</div>
	                		</div>
                		</div>
                		<div class="row mx-0 px-0 product col-6 col-sm-6 col-md-4 col-xl-3">
                			<div class="row mx-0 px-0 m-1 p-1 border product-panel">
	                			<div class="product-img col-12">
	                				<img src="IMG/fulls.png"/>
	                			</div>
	                			<div class="product-desc col-12">
	                				R
	                			</div>
	                			<div class="product-price col-12">
	                				RM999.00
	                			</div>
	                		</div>
                		</div>
                		<div class="row mx-0 px-0 product col-6 col-sm-6 col-md-4 col-xl-3">
                			<div class="row mx-0 px-0 m-1 p-1 border product-panel">
	                			<div class="product-img col-12">
	                				<img src="IMG/fulls.png"/>
	                			</div>
	                			<div class="product-desc col-12">
	                				E
	                			</div>
	                			<div class="product-price col-12">
	                				RM999.00
	                			</div>
	                		</div>
                		</div>
                		<div class="row mx-0 px-0 product col-6 col-sm-6 col-md-4 col-xl-3">
                			<div class="row mx-0 px-0 m-1 p-1 border product-panel">
	                			<div class="product-img col-12">
	                				<img src="IMG/fulls.png"/>
	                			</div>
	                			<div class="product-desc col-12">
	                				V
	                			</div>
	                			<div class="product-price col-12">
	                				RM999.00
	                			</div>
	                		</div>
                		</div>
              		</div>
            	</div>            
        	</div><!--EndOf row-->        	
    	</div>
	


		<?php require_once "_require/footer.php"?>

		<?php require_once "_require/js.php"?>
		<script>
			function loadCategory(ele,cat){
				$("ul.category-side-menu li a.active").removeClass("active");
				$(ele).addClass('active');
			}

			function list(){
				$('.product').removeClass("col-6 col-sm-6 col-md-4 col-xl-3");
				$('.product').addClass("col-12");

				$('.product-img').removeClass("col-12");
				$('.product-img').addClass("col-3");

				$('.product-desc').removeClass("col-12");
				$('.product-desc').addClass("col-6");

				$('.product-price').removeClass("col-12");
				$('.product-price').addClass("col-3");
			}

			function grid(){
				$('.product').addClass("col-6 col-sm-6 col-md-4 col-xl-3");
				$('.product').removeClass("col-12");

				$('.product-img').addClass("col-12");
				$('.product-img').removeClass("col-3");

				$('.product-desc').addClass("col-12");
				$('.product-desc').removeClass("col-6");

				$('.product-price').addClass("col-12");
				$('.product-price').removeClass("col-3");
			}
		</script>
	</body>
</html>