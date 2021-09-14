<?php require_once "_require/dbconn.php"?>

<?php
	if(!$conn){
		echo "<script> alert('Connection to database failed'); </script>";
		die("Connection failed: " . mysqli_connect_error());
	}

	try{
		/*
		$sql = "SELECT i.item_name, i.item_cat, c.item_cat_desc, i.item_cat_det, c.item_cat_det_desc, i.item_desc_lt, i.item_detail_desc_lt,
		i.item_img_name_1, i.item_img_name_2, i.item_img_name_3, i.item_img_name_4, i.item_img_name_5, i.item_img_name_6 FROM invent_table i, invent_cat c
		WHERE i.item_cat = c.item_cat 
		AND i.item_cat_det = c.item_cat_det 
		AND  item_status = 0 AND item_visible != 1 AND item_public = 0 AND item_id = ? ";
		*/
		
		$sql = "SELECT * FROM invent_url";

		if($stmt = mysqli_prepare($conn, $sql)){       
		    //mysqli_stmt_bind_param($stmt,"s",$item_id);
		    $result = mysqli_stmt_execute($stmt);
		    mysqli_stmt_execute($stmt) or die( mysqli_error($conn));
		} 

		$result = $stmt -> get_Result();				               

    	while($row = mysqli_fetch_array($result)) {
    		$item_id = $row['item_id'];
    		$url = $row['url'];

    		//echo "<script>redirect2('" . $item_id . "', '" . $url . "');</script>";

    		if(!file_exists($url)){
    			//mkdir($url);
    			echo $item_id . ": " . $url . "<br/>";
    			mkdir($url, 0777, true);

    			copy('templates/index.php', $url . "/index.php");
    			//break;
    		}

		}

		//print_r($product_images);
	} catch (mysqli_sql_exception $e){
	    echo $e->getMessage();    
	}  





?>