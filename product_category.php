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
		// get all OTHERS type and type desc for sidenav_others (not specified type)
		$sql = "SELECT item_cat, item_cat_desc FROM invent_cat WHERE item_cat != ? and status = 1 
				GROUP BY item_cat, item_cat_desc ORDER BY seq";

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




		// get all TYPE for type combo box
		$sql = "SELECT item_cat, item_cat_desc FROM invent_cat WHERE status = 1 GROUP BY item_cat, item_cat_desc ORDER BY seq";

		if($stmt = mysqli_prepare($conn, $sql)){
            $result = mysqli_stmt_execute($stmt);
        } 

        $result = $stmt -> get_Result();

        $index = 0;
        $type_options = "";

        while($row = mysqli_fetch_array($result)) {
        	if(strcmp($row['item_cat'], $type) == 0){
        		$type_options .= '<option value="' . $row['item_cat'] . '" selected>' . $row['item_cat_desc'] . '</option>';
        	} else {
        		$type_options .= '<option value="' . $row['item_cat'] . '">' . $row['item_cat_desc'] . '</option>';
        	}       	
        }




        // get all CATEGORIES for for selected TYPE for sidenav and category combo box
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
        				$category = $row['item_cat_det']; // if no category specified, select the first one.
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

	        	if(!empty($category)){
	        		if(strcmp($row['item_cat_det'], $category) == 0){
	        			$category_options .= '<option value="' . $row['item_cat_det'] . '" selected>' . $row['item_cat_det_desc'] . '</option>';
	        		} else {
	        			$category_options .= '<option value="' . $row['item_cat_det'] . '">' . $row['item_cat_det_desc'] . '</option>';
	        		}
	        	} else {
	        		$category_options .= '<option value="' . $row['item_cat_det'] . '">' . $row['item_cat_det_desc'] . '</option>';
	        	}
				
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
				<select id="type" class="col-5 m-0 py-3" onchange="selectType()">
					<?=$type_options?>
				</select>
				<select id="category" class="col-5 m-0 px-1 py-3" onchange="selectCategory()">
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
						<a href="#" onclick="grid();return false;">
							<span class="px-1 feather feather-32" data-feather="grid"></span>
						</a>

						<a href="#" onclick="list();return false;">
							<span class="px-1 feather feather-32" data-feather="list"></span>
						</a>
					</div>
              		<div id="catalogue" class="row mx-0 px-0 product-panel mb-4 pt-3">

                		
              		</div>
            	</div>            
        	</div><!--EndOf row-->        	
    	</div>
	


		<?php require_once "_require/footer.php"?>

		<?php require_once "_require/js.php"?>
		<script>
			$( document ).ready(function() {
		        loadCatalogue();
		    });

		    function loadCatalogue(){
		    	var type = '<?=$type?>';
		        var category = '<?=$category?>';
		        reloadCatalogue(type, category);
		    }

		    function reloadCatalogue(type, category) {
		        $.ajax({
		          url: "_ajax/product_getcatalogue.php",
		          timeout:30000,
		          type: "GET",
		          data: {
		            type:type,
		            category:category
		          },
		          success: function(response){
		            $("#catalogue").html(response);
		            console.log(response);
		          },
		          error: function(jqXHR, textStatus){
		            $("#err").html(textStatus.toString());
		          }
		        });
		      } // end of getCountryTable

			function loadCategory(ele,cat){
				$("ul.category-side-menu li a.active").removeClass("active");
				$(ele).addClass('active');
				reloadCatalogue('<?=$type?>', cat);
			}


			function selectType(){
				var type = $('#type').val();
				window.location.href = "product_category.php?type=" + type;
			}

			function selectCategory(){
				var type = $('#type').val();
				var category = $('#category').val();

				reloadCatalogue(type, category);
			}



			function list(){
				//$('.product-panel').addClass("row");


				$('.product').removeClass("col-6 col-sm-6 col-md-3 ");
				$('.product').addClass("col-6");


				$('.product-img').removeClass("col-12");
				$('.product-img').removeClass("product-img-fixed-height");
				$('.product-img').addClass("col-3");

				$('.product-desc').removeClass("col-12");
				$('.product-desc').removeClass("product-desc-fixed-height");
				$('.product-desc').addClass("col-9");

				$('.product-price').removeClass("col-12");
				$('.product-price').addClass("col-0");
			}

			function grid(){
				//$('.product-panel').removeClass("row");

				$('.product').addClass("col-6 col-sm-6 col-md-3 ");
				$('.product').removeClass("col-6");				

				$('.product-img').addClass("col-12");
				$('.product-img').addClass("product-img-fixed-height");
				$('.product-img').removeClass("col-3");

				$('.product-desc').addClass("col-12");
				$('.product-desc').addClass("product-desc-fixed-height");
				$('.product-desc').removeClass("col-9");

				$('.product-price').addClass("col-12");
				$('.product-price').removeClass("col-0");

				
			}
		</script>
	</body>
</html>