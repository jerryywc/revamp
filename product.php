<?php require_once "_require/dbconn.php"?>
<!DOCTYPE html>
<html>
<body>
<script>
			function redirect2(item_id, url) {
				//alert(url+"index.php");
				var actionurl = url+"index.php";



			    var form = document.createElement("form");
    			form.setAttribute("method", "post");
    			form.setAttribute("action", actionurl);

			    var fitem_id = document.createElement("input");
			    fitem_id.setAttribute("type", "text");
			    fitem_id.setAttribute("name", "item_id");
			    fitem_id.setAttribute("value", item_id);

			    form.appendChild(fitem_id);  

			    console.log(item_id);

			    document.getElementsByTagName("body")[0].appendChild(form);

			    form.submit();
			}
		</script>

<?php
$item_id;
if(isset($_GET['IID']) && !empty(trim($_GET['IID']))){
	$item_id = $_GET['IID'];
}



			if(!$conn){
			    echo "<script> alert('Connection to database failed'); </script>";
			    die("Connection failed: " . mysqli_connect_error());
			}

			$product_images = array();
			$product_name = "";
			$product_desc_lt = "";
			$product_detail_desc_lt = "";

			try{
				/*
				$sql = "SELECT i.item_name, i.item_cat, c.item_cat_desc, i.item_cat_det, c.item_cat_det_desc, i.item_desc_lt, i.item_detail_desc_lt,
						i.item_img_name_1, i.item_img_name_2, i.item_img_name_3, i.item_img_name_4, i.item_img_name_5, i.item_img_name_6 FROM invent_table i, invent_cat c
						WHERE i.item_cat = c.item_cat 
						AND i.item_cat_det = c.item_cat_det 
						AND  item_status = 0 AND item_visible != 1 AND item_public = 0 AND item_id = ? ";
						*/
				$sql = "SELECT * FROM invent_url WHERE item_id = ?";

				if($stmt = mysqli_prepare($conn, $sql)){       
			      mysqli_stmt_bind_param($stmt,"s",$item_id);
			      //$result = mysqli_stmt_execute($stmt);
			      mysqli_stmt_execute($stmt) or die( mysqli_error($conn));
			    } 

				$result = $stmt -> get_Result();				               

    			if($row = mysqli_fetch_array($result)) {
    				$item_id = $row['item_id'];
    				$url = $row['url'];

    				echo "<script>redirect2('" . $item_id . "', '" . $url . "');</script>";

				}

				//print_r($product_images);
			} catch (mysqli_sql_exception $e){
			    echo $e->getMessage();    
			}       

		?>

</body>
</html>
		
