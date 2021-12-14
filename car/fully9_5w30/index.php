<?php require_once "../_require/dbconn.php"?>

<?php
/*
$item_id;
if(isset($_POST['item_id']) && !empty(trim($_POST['item_id']))){
	$item_id = $_POST['item_id'];
}

if(isset($_GET['IID']) && !empty(trim($_GET['IID']))){
	$item_id = $_GET['IID'];
}
*/
function cleanb($string){

    $string = str_replace('{123', '<ol><li>', $string);
    $string = str_replace('}123', '</li></ol>', $string);
    $string = str_replace('{', '<ul><li>', $string);
    $string = str_replace('#', '</li><li>', $string);
    $string = str_replace('}', '</li></ul>', $string);

    return $string;
}

?>


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

				if(!isset($item_id) && empty($item_id)){
					$currdir = '%/' .  basename(__DIR__) . '/%';
					$sql = "SELECT * FROM hirevadm_db.invent_url WHERE url LIKE ?";

					if($stmt = mysqli_prepare($conn, $sql)){       
				      mysqli_stmt_bind_param($stmt,"s",$currdir);
				      //$result = mysqli_stmt_execute($stmt);
				      mysqli_stmt_execute($stmt) or die( mysqli_error($conn));
				    } 

					$result = $stmt -> get_Result();
					if($row = mysqli_fetch_array($result)) {
    				  $item_id = $row['item_id'];
    				}
				}

				$sql = "SELECT i.item_name, i.item_cat, c.item_cat_desc, i.item_cat_det, c.item_cat_det_desc, i.item_desc_lt, i.item_detail_desc_lt,
						i.item_img_name_1, i.item_img_name_2, i.item_img_name_3, i.item_img_name_4, i.item_img_name_5, i.item_img_name_6 FROM invent_table i, invent_cat c
						WHERE i.item_cat = c.item_cat 
						AND i.item_cat_det = c.item_cat_det 
						AND  item_status = 0 AND item_visible != 1 AND item_public = 0 AND item_id = ? ";

				if($stmt = mysqli_prepare($conn, $sql)){       
			      mysqli_stmt_bind_param($stmt,"s",$item_id);
			      //$result = mysqli_stmt_execute($stmt);
			      mysqli_stmt_execute($stmt) or die( mysqli_error($conn));
			    } 

				$result = $stmt -> get_Result();				               

    			if($row = mysqli_fetch_array($result)) {
    				$type = $row['item_cat'];
    				$type_desc = $row['item_cat_desc'];
    				$category = $row['item_cat_det'];
    				$category_desc = $row['item_cat_det_desc'];
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


				$sql = "SELECT * FROM hirevadm_db.invent_seo WHERE item_id = ? ";

				if($stmt = mysqli_prepare($conn, $sql)){       
			      mysqli_stmt_bind_param($stmt,"s",$item_id);
			      //$result = mysqli_stmt_execute($stmt);
			      mysqli_stmt_execute($stmt) or die( mysqli_error($conn));
			    } 

				$result = $stmt -> get_Result();				               

    			if($row = mysqli_fetch_array($result)) {
    				$metadesc = $row['metadesc'];    				
				}

				//print_r($product_images);
			} catch (mysqli_sql_exception $e){
			    echo $e->getMessage();    
			}       

		?>

<!DOCTYPE html>
<html>
	<head>
		<title>Revamp</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?=$metadesc?>">
		<?php require_once "../_require/metalink.php"?>
		<meta name="description" content="<?=$metadesc?>">
		<link rel="stylesheet" href="../../css/product.css" />


		<style>
			.carousel-indicators {
			    justify-content: left;
			}
		</style>

	</head>
	<body>
		<header></header>
		<div class="hirevlogo"></div>

		<?php require_once "../_require/navbar.php"?>



	
        <div class="container white pb-5">
        	<p class="px-2 py-1">
				<a href="../../product_menu.php" class="text-uppercase">Products</a> /
				<a href="../../product_category.php?type=<?=$type?>" class="text-uppercase"><?=$type_desc?></a> /
				<a href="../../product_category.php?type=<?=$type?>&category=<?=$category?>" class="text-uppercase"><?=$category_desc?></a> /
				<?=$product_name?>
			</p>

          	<div class="row pt-5">
            	<div class="col-lg-4 col-md-6 col-sm-12">            		
					<div id="custCarousel" class="carousel slide border" data-ride="carousel" align="center" >
                		<!-- slides -->
                		<ol class="carousel-indicators list-inline mb-0 pb-0">

                			<?php
                				foreach($product_images as $i => $image){
                					if($i == 0){
                						echo 
                						'<li class="list-inline-item active pb-5"> 
					                    	<a id="carousel-selector-0" class="selected" data-slide-to="0" data-target="#custCarousel"> 
					                    		<img src="../../../0/IMG/product/' . $image . '" class="img-fluid"> 
					                    	</a> 
					                    </li>';
                					} else {
                						echo
                						'<li class="list-inline-item pb-5"> 
					                    	<a id="carousel-selector-0" data-slide-to="0" data-target="#custCarousel"> 
					                    		<img src="../../../0/IMG/product/' . $image . '" class="img-fluid"> 
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
                						echo '<div class="carousel-item my-2 active"> <img src="../../../0/IMG/product/' . $image . '" alt="Hills"> </div>';
                					} else {
                						echo '<div class="carousel-item my-2 "> <img src="../../../0/IMG/product/' . $image . '" alt="Hills"> </div>';
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
				        <a href="#"><img src="../../IMG/map-pointer.png"/>FIND HI-REV NEAR YOU</a>
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
	


		<?php require_once "../_require/footer.php"?>

		<?php require_once "../_require/js.php"?>
	</body>
</html>