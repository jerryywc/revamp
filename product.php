<?php require_once "_require/dbconn.php"?>

<?php

$item_id;
if(isset($_GET['IID']) && !empty(trim($_GET['IID']))){
	$item_id = $_GET['IID'];
}

function cleanb($string){

    $string = str_replace('{123', '<ol><li>', $string);
    $string = str_replace('}123', '</li></ol>', $string);
    $string = str_replace('{', '<ul><li>', $string);
    $string = str_replace('#', '</li><li>', $string);
    $string = str_replace('}', '</li></ul>', $string);

    return $string;
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Revamp</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<?php require_once "_require/metalink.php"?>

		<style>
			.carousel-indicators {
			    justify-content: left;
			}
		</style>

	</head>
	<body>
		<header></header>
		<div class="hirevlogo"></div>

		<?php require_once "_require/navbar.php"?>

		<?php
			if(!$conn){
			    echo "<script> alert('Connection to database failed'); </script>";
			    die("Connection failed: " . mysqli_connect_error());
			}

			$product_images = array();
			$product_name = "";
			$product_desc_lt = "";
			$product_detail_desc_lt = "";

			try{
				$sql = "SELECT * FROM invent_table WHERE item_status = 0 AND item_visible != 1 AND item_public = 0 AND item_id = ? ";

				if($stmt = mysqli_prepare($conn, $sql)){       
			      mysqli_stmt_bind_param($stmt,"s",$item_id);
			      //$result = mysqli_stmt_execute($stmt);
			      mysqli_stmt_execute($stmt) or die( mysqli_error($conn));
			    } 

				$result = $stmt -> get_Result();				               

    			if($row = mysqli_fetch_array($result)) {
    				$category = $row['item_cat_det'];
    				$product_name = $row['item_name'];
    				$product_desc_lt = $row['item_desc_lt'];
    				$product_detail_desc_lt = $row['item_detail_desc_lt'];

    				if(!empty($row['item_img_name_1'])){
    					array_push($product_images, $category. '/' . $row['item_img_name_1']);
    				}
    				if(!empty($row['item_img_name_2'])){
    					array_push($product_images, $category. '/' . $row['item_img_name_2']);
    				}
    				if(!empty($row['item_img_name_3'])){
    					array_push($product_images, $category. '/' . $row['item_img_name_3']);
    				}
    				if(!empty($row['item_img_name_4'])){
    					array_push($product_images, $category. '/' . $row['item_img_name_4']);
    				}
    				if(!empty($row['item_img_name_5'])){
    					array_push($product_images, $category. '/' . $row['item_img_name_5']);
    				}
    				if(!empty($row['item_img_name_6'])){
    					array_push($product_images, $category. '/' . $row['item_img_name_6']);
    				}
				}

				//print_r($product_images);
			} catch (mysqli_sql_exception $e){
			    echo $e->getMessage();    
			}       

		?>

	
        <div class="container white pb-5">
        	
          	<div class="row pt-5">
            	<div class="col-lg-4 col-md-6 col-sm-12">            		
					<div id="custCarousel" class="carousel slide" data-ride="carousel" align="center">
                		<!-- slides -->
                		<ol class="carousel-indicators list-inline mb-0 pb-0">

                			<?php
                				foreach($product_images as $i => $image){
                					if($i == 0){
                						echo 
                						'<li class="list-inline-item active pb-5"> 
					                    	<a id="carousel-selector-0" class="selected" data-slide-to="0" data-target="#custCarousel"> 
					                    		<img src="../0/IMG/product/' . $image . '" class="img-fluid"> 
					                    	</a> 
					                    </li>';
                					} else {
                						echo
                						'<li class="list-inline-item pb-5"> 
					                    	<a id="carousel-selector-0" data-slide-to="0" data-target="#custCarousel"> 
					                    		<img src="../0/IMG/product/' . $image . '" class="img-fluid"> 
					                    	</a> 
					                    </li>';
                					}
                				}

                			?>



		                </ol>
		                <div class="carousel-inner">
		                	<?php
		                		foreach($product_images as $i => $image){
                					if($i == 0){
                						echo '<div class="carousel-item my-2 active"> <img src="../0/IMG/product/' . $image . '" alt="Hills"> </div>';
                					} else {
                						echo '<div class="carousel-item my-2 "> <img src="../0/IMG/product/' . $image . '" alt="Hills"> </div>';
                					}
                				}
		                	?>
		                </div> <!-- Left right --> 
		                <a class="carousel-control-prev mt-5 pt-5" href="#custCarousel" data-slide="prev"> 
		                	<span class="carousel-control-prev-icon"></span> 
		                </a> 
		                <a class="carousel-control-next mt-5 pt-5" href="#custCarousel" data-slide="next"> 
		                	<span class="carousel-control-next-icon"></span> 
		                </a> <!-- Thumbnails -->
                
            		</div><!-- end of custCarousel -->
            	</div>

            	<div class="col-lg-8 col-md-6  col-sm-12 px-5">
              		<div class="productdesc mb-4 pt-0">
              			<h3 class="pb-4 border-bottom"><?=$product_name?></h3>
                		<div class="pr-4 item-desc-lt"><?=$product_desc_lt?></div>
                		<div class="pr-4 item-detail-desc-lt"><?=$product_detail_desc_lt?></div>
              		</div>
            	</div>            
        	</div><!--EndOf row-->
        	<div class="row pt-3 p-5">
        		<div class="col-md-4 col-sm-12 min-h-150 ">
			        <p class=" assist-link">
				        <a href="#"><img src="IMG/map-pointer.png"/>FIND HI-REV NEAR YOU</a>
				    </p>
			    </div>
			    <div class="col-md-4 col-sm-12 min-h-150 ">
			        <p class=" assist-link">
			            <a href="#">FIND RIGHT OIL FOR YOUR VEHICLE</a>
			        </p>
			    </div>
			    <div class="col-md-4 col-sm-12 min-h-150">
			        <p class=" assist-link">
			            <a href="#">BUY ONLINE</a>
			        </p>
			    </div>      
        	</div>
    	</div><!-- end of container -->
	


		<?php require_once "_require/footer.php"?>

		<?php require_once "_require/js.php"?>
	</body>
</html>