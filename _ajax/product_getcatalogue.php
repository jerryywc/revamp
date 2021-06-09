<?php require_once "../_require/dbconn.php" ?>



<?php 
    


    $type = "";
    $category = "";
  
    if(isset($_GET['type']) && !empty($_GET['type']))
    {
        $type = $_GET['type'];
    } else {
        echo "No type specified";
        exit;
    }
  
    if(isset($_GET['category']) && !empty($_GET['category']))
    {
        $category = $_GET['category'];
    } else {
        echo "No category specified";
        exit;
    }  


    /* Search for existing setup */


    try{
        $sql = "SELECT * FROM invent_table WHERE item_cat = ? AND item_cat_det = ? AND item_public = 0 AND item_visible != 1 AND item_status = 0";

        if($stmt = mysqli_prepare($conn, $sql)){
            mysqli_stmt_bind_param($stmt,"ss",$type, $category);
            $result = mysqli_stmt_execute($stmt);
        } 

        $result = $stmt -> get_Result();


        $previous_item_id = 0;
        $current_item_id = 0;
        $index = 0;
        $close_tag = 0;
        while($row = mysqli_fetch_array($result)){
          $close_tag = 1; // has row, need to close the last row

          $item_id = $row['item_id'];
          $item_name = $row['item_name'];
          $item_desc_lt = $row['item_desc_lt'];
          $item_detail_desc_lt = $row['item_detail_desc_lt'];
          $item_img_name_1 = $row['item_img_name_1'];
          
          $current_item_id = $item_id;

         
          echo '<div class="row mx-0 px-0 product col-6 col-sm-6 col-md-3 col-xl-2">';
          echo '<div class="row mx-0 px-0 m-1 p-1 border product-panel align-top">';
          echo '<div class="product-img product-img-fixed-height col-12 p-3">';
          echo '<a href="product.php?IID=' . $item_id . '"><img  src="../0/IMG/product/' . $category . '/' . $item_img_name_1 . '"/></a>';
          echo '</div>';
          echo '<div class="mt-0 pt-0 align-top product-desc product-desc-fixed-height col-12 p-3"><h5>' .  $item_name . '</h5>' . $item_desc_lt  . '</div>';
          echo '<div class="product-price col-12"></div>';
          echo '</div></div>';


          $index++;
          $previous_item_id = $current_item_id;

        }

        if($close_tag == 1){
          echo '</div>';
        }

        $conn -> close();



                
    } catch (mysqli_sql_exception $e){
        echo $e->getMessage();


    }              
?>


