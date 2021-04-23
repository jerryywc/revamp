<?php require_once "../_require/dbconn.php" ?>



<?php 
    


    $page;
  
    if(isset($_GET['page']) && !empty($_GET['page']))
    {
        $page = $_GET['page'];
    } else {
        echo "No page specified";

        exit;
    }
    
    $panel;
  
    if(isset($_GET['panel']) && !empty($_GET['panel']))
    {
        $panel = $_GET['panel'];
    } else {
        echo "No panel specified";


        exit;
    }  


    /* Search for existing setup */


    try{
        $sql = "select * from quill_designer_row r, quill_designer_col c where r.row_status = 1 and r.id = c.row_id and r.page = ? and r.panel = ? order by c.row_id, c.id;";

        if($stmt = mysqli_prepare($conn, $sql)){
            mysqli_stmt_bind_param($stmt,"ss",$page, $panel);
            $result = mysqli_stmt_execute($stmt);
        } 

        $result = $stmt -> get_Result();


        $prev_row_id = 0;
        $curr_row_id = 0;
        $index = 0;
        $close_tag = 0;
        while($row = mysqli_fetch_array($result)){
          $close_tag = 1; // has row, need to close the last row

          $curr_row_id = $row['row_id'];
          $width_class = $row['width_class'];
          $quill_html = $row['quill_html'];
          $col_height = $row['col_height'];

          if($index == 0 && $curr_row_id != $prev_row_id){
            echo '<div class="clearfix ql-container ql-snow" onclick="clicked(this, ' . $curr_row_id . ')">'; // start new row
          } else if($index > 0 && $curr_row_id != $prev_row_id){
            echo '</div>'; // close previous row
            echo '<div class="clearfix ql-container ql-snow" onclick="clicked(this, ' . $curr_row_id . ')">'; // start new row
          }
          /*
          echo '<div class="float-left column ql-editor ' . $width_class . '" style="height:' . $col_height . 'px" >' . $quill_html . '</div>';
          */
          echo '<div class="float-left column ql-editor ' . $width_class . '" style="min-height:'. $col_height .'px ">' . $quill_html . '</div>';

          $index++;
          $prev_row_id = $curr_row_id;
          /*
            if($row['col_id'] == 1){
                $col_1_id = $row['id'];
                $col_1_class = $row['width_class']; // get col width
                $col_1_content = $row['quill_html']; // get col content
            } else if($row['col_id'] == 2){
                $col_2_id = $row['id'];
                $col_2_class = $row['width_class']; // get col width
                $col_2_content = $row['quill_html']; // get col content
            } else if($row['col_id'] == 3){
                $col_3_id = $row['id'];
                $col_3_class = $row['width_class']; // get col width
                $col_3_content = $row['quill_html']; // get col content
            }
            */
        }

        if($close_tag == 1){
          echo '</div>';
        }

        $conn -> close();



                
    } catch (mysqli_sql_exception $e){
        echo $e->getMessage();


    }              
?>


