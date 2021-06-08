<?php require_once "_require/dbconn.php"?>

<?php


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
				$sql = "SELECT * FROM invent_table";

				if($stmt = mysqli_prepare($conn, $sql)){       
			      //mysqli_stmt_bind_param($stmt,"s",$item_id);
			      //$result = mysqli_stmt_execute($stmt);
			      mysqli_stmt_execute($stmt) or die( mysqli_error($conn));
			    } 

				$result = $stmt -> get_Result();				               

    			while($row = mysqli_fetch_array($result)) {
    				$item_details_spec = "";
    				$item_spec = "";
    				$item_spec_desc = "";

    				$item_id = $row['item_id'];
    				$item_details_spec = "<p>" . $row['item_details_spec'] . "</p>";
    				if(!empty($row['item_spec'])){
	    				$item_spec = "<p>" . "<u>Technical Specifications</u><br/>" .  cleanb($row['item_spec']) . "</p>";
	    			}
	    			if(!empty($row['item_spec_desc'])){
	    				$item_spec_desc = "<p>" . "<u>Advantages</u><br/>" . cleanb($row['item_spec_desc']) . "</p>";
	    			}


    				echo $item_details_spec;
    				echo $item_spec;
    				echo $item_spec_desc;

    				$item_detail_desc_lt = $item_details_spec . $item_spec . $item_spec_desc;

    				$sql = "UPDATE invent_table SET item_detail_desc_lt = ? WHERE item_id = ?";

					if($stmt = mysqli_prepare($conn, $sql)){       
				      mysqli_stmt_bind_param($stmt,"ss",$item_detail_desc_lt, $item_id);
				      //$result = mysqli_stmt_execute($stmt);
				      mysqli_stmt_execute($stmt) or die( mysqli_error($conn));
				    } 
				}

				


				//print_r($product_images);
			} catch (mysqli_sql_exception $e){
			    echo $e->getMessage();    
			}       

		?>

	
       
	


		<?php require_once "_require/footer.php"?>

		<?php require_once "_require/js.php"?>
	</body>
</html>