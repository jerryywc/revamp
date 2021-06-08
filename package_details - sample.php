<?php require_once "_includes/dbconn.php"?>

<!--
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
-->
<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="IMG/icon32x32.png" sizes="32x32">

    <title>HI-REV</title>

    <?php require_once "_includes/rellink.php" ?>
    <link rel="stylesheet" type="text/css" href="IMG/engine1/style.css" />
    <link rel="stylesheet" type="text/css" href="styletab.css" />
	  <script type="text/javascript" src="IMG/engine1/jquery.js"></script>

</head>
<body class="bodyClass" style="text-align:center;"><!-- <body class="bodyClass"> --> 
<div class="divclass">
<center>
<div class="res_header_desk" >
<?php require_once "menu_header.php";?>
</div>
<div class="res_header_mob">
<?php require_once "menu_header_mob.php";?>
</div>

<style>
.desk_class{
  display: inline;
  font-family: 'Open Sans';

}
.mobi_class{
  display: none;
}
.content_des{
    width: 95%;
    text-align: left;
    border-top-style: solid;
    border-top-width: 0.5px;
    border-top-color: #dddddd;
    padding-top: 10px;
    padding-bottom: 10px;
}
@media screen and (max-width:680px) 
{
  .desk_class{
    display: none;
  }
  .mobi_class{
    display: inline;
  }
}
</style>


  <?php

function clean($string){
    $string = str_replace('{', '<ul><li>', $string);
    $string = str_replace('#', '</li><li>', $string);
    $string = str_replace('}', '</li></ul>', $string);
    return $string;
  }


    $ID = htmlspecialchars($_GET['PID']);

/*
    $select_pid = "SELECT * from invent_table where item_id = '$ID' ";
    $query_pid = mysql_query($select_pid, $conn) or die(mysql_error()."\n".$select_pid);
    if($row_pid = mysql_fetch_assoc($query_pid)){
      $img1 = $row_pid['item_img'];
      $img2 = $row_pid['item_img_2'];

      $item_id = $row_pid['item_id'];
      $item_name = $row_pid['item_name'];
      $item_desc = $row_pid['item_desc'];
      $item_detail = $row_pid['item_details_spec'];
      $item_spec = $row_pid['item_spec'];
      $item_spec_desc = $row_pid['item_spec_desc'];
      $item_price = $row_pid['item_price'];

      $item_cat = $row_pid['item_cat_det'];

     //echo $item_detail;

    }
*/

    try{
      $sql ="SELECT * from invent_table where item_id = ?";

      if($stmt = mysqli_prepare($mysqli_conn, $sql)){       
        mysqli_stmt_bind_param($stmt,"s",$ID);
        $result = mysqli_stmt_execute($stmt);
      } 

      $result = $stmt -> get_Result();
        
      if($row = mysqli_fetch_array($result)){
        $item_id = $row['item_id'];
        $item_name = $row['item_name'];
        $item_price = $row['item_price'];
        $item_cat = $row['item_cat_det'];

        $item_img_name_1 = $row['item_img_name_1'];
        $item_img_name_2 = $row['item_img_name_2'];
        $item_img_name_3 = $row['item_img_name_3'];
        $item_img_name_4 = $row['item_img_name_4'];
        $item_img_name_5 = $row['item_img_name_5'];
        $item_img_name_6 = $row['item_img_name_6'];

        $item_desc_lt = $row['item_desc_lt'];
        $item_detail_desc_lt = $row['item_detail_desc_lt'];
      }

    }catch (mysqli_sql_exception $e){
        echo $e->getMessage();    
    }      


  ?>

<div class="content_i" style="font-family: 'Open Sans'">
   
  <!-- Section 1 IMAGE -->

  <!-- <font class='title_header'> <?php echo $item_name; ?> </font> -->

  <div class="desk_class">
    <table border='0' cellpadding="1" cellspacing="1" width="100%" style="font-family: 'Open Sans'; font-size: 14px;"><tr><td rowspan="2" width="40%">
    <?php 
      echo "<img id='myImage' src='../0/IMG/product/".$item_cat."/".$item_img_name_1."' style='width:100%;'><br>";
      echo "<img border='1' src='../0/IMG/product/".$item_cat."/".$item_img_name_1."' style='width:16%' onclick='document.getElementById(\"myImage\").src=\"../0/IMG/product/".$item_cat."/".$item_img_name_1."\"' >";
      if(!empty($item_img_name_2)){
       echo "<img border='1' src='../0/IMG/product/".$item_cat."/".$item_img_name_2."' style='width:16%' onclick='document.getElementById(\"myImage\").src=\"../0/IMG/product/".$item_cat."/".$item_img_name_2."\"' >";
      }
      if(!empty($item_img_name_3)){
       echo "<img border='1' src='../0/IMG/product/".$item_cat."/".$item_img_name_3."' style='width:16%' onclick='document.getElementById(\"myImage\").src=\"../0/IMG/product/".$item_cat."/".$item_img_name_3."\"' >";
      }
      if(!empty($item_img_name_4)){
       echo "<img border='1' src='../0/IMG/product/".$item_cat."/".$item_img_name_4."' style='width:16%' onclick='document.getElementById(\"myImage\").src=\"../0/IMG/product/".$item_cat."/".$item_img_name_4."\"' >";
      }
      if(!empty($item_img_name_5)){
       echo "<img border='1' src='../0/IMG/product/".$item_cat."/".$item_img_name_5."' style='width:16%' onclick='document.getElementById(\"myImage\").src=\"../0/IMG/product/".$item_cat."/".$item_img_name_5."\"' >";
      }
      if(!empty($item_img_name_6)){
       echo "<img border='1' src='../0/IMG/product/".$item_cat."/".$item_img_name_6."' style='width:16%' onclick='document.getElementById(\"myImage\").src=\"../0/IMG/product/".$item_cat."/".$item_img_name_6."\"' >";
      }
      
      echo "</td><td><h2>".$item_name."</h2><br>".$item_desc_lt."</td></tr>";

      echo "<tr><td style='white-space:nowrap; text-align:right;'><span style='font-size:40px; color: red; font-weight:bold; font-family:\"Open Sans\"'>RM".$item_price."</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";

      if($Group_Dealer == ""){
        echo "<span class='add_cart_menu' style='cursor:pointer;' onclick='location.assign(\"package.php?s=cart&PID=".$item_id."\")'>Add to Cart</span>" ;
      }
       // echo "</td></tr><tr><td align='right'><span style='font-size:40px; color: red; font-weight:bold; font-family:\"Open Sans\"'>RM".$item_price."</span> </td><td align='right'> <span class='add_cart_menu' style='cursor:pointer;' onclick='location.assign(\"package.php?s=cart&PID=".$ID['item_id']."\")'>Add to Cart</span> </td></tr><tr><td colspan='2'>";

        ?>

       
  </td></tr></table>
  </div>

  <div class="mobi_class">
      <table border='0' cellpadding="2" cellspacing="2" width="100%" style="font-family: 'Open Sans'; font-size: 14px;"><tr><td align="center">
    <?php 
       echo "<h2 style='font-family:\"Open Sans\"; font-weight:400;'>".$item_name."</h2><br>";
      echo "<img src='../0/IMG/product/".$item_cat."/".$item_img_name_1."' style='max-height:450px'>";
    ?>
  </td></tr><tr><td>
      
      <div class="mobi_class">
      <?php
      echo "<center><span style='font-size:40px; color: red; font-weight:bold; font-family:\"Open Sans\"'>RM".$item_price."</span></center><br>";

if($Group_Dealer == ""){
    echo "<center><span class='add_cart_menu' style='cursor:pointer;' onclick='location.assign(\"package.php?s=cart&PID=".$item_id."\")'>Add to Cart</span></center>";
}
          //echo "<b>".$item_name."</b>";
        ?>
      </div>

      <?php 
        echo $item_desc_lt;
      ?>
  </td></tr></table>
  </div>

  <div class="content_des">
     

    <?php 
      echo "<br>".$item_detail_desc_lt;
    ?>
  </div>
  <!--
<div class="content_des">
    <?php 
      echo clean($item_spec);
    ?>
  </div>

<div class="content_des">
    <?php 
      echo clean($item_spec_desc);
    ?>
  </div>
-->


    <img src="IMG/adjuster.jpg" style="width: 100%">
</div>

<div class="res_footer_desk">
<?php require_once "footer_web.php";?>
</div>
<div class="res_footer_mob">

<?php require_once "footer_mob.php";?>
</div>
</center>
</div>
</body>
</html>
