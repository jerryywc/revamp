<?php require_once "_require/dbconn.php"?>

<!DOCTYPE html>
<html>
	<head>
		<title>HI-REV LUBRICANTS</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<?php require_once "_require/metalink.php"?>
		
	</head>
	<body>
		<!-- facebook plugins-->
		<div id="fb-root"></div>
		<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v10.0&appId=383230492974724&autoLogAppEvents=1" nonce="zvLJ9aBX"></script>

		<div id="fb-root"></div>
		<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v10.0" nonce="8EscK4w2"></script>
		<!-- end of facebook plugins -->

		<header></header>
		<div class="hirevlogo"></div>

		<?php require_once "_require/navbar.php"?>



		<!-- Carousel -->
		<?php
			if(!$conn){
			    echo "<script> alert('Connection to database failed'); </script>";
			    die("Connection failed: " . mysqli_connect_error());
			}

			$sql = "SELECT * from slider where status='1' order by slider_seq desc limit 10";
			$result = mysqli_query($conn, $sql);

			$row_cnt = mysqli_num_rows($result);
		?>

		
		
		<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="3000">
		  <ol class="carousel-indicators"> <!-- create indicators -->
		    <?php
		    	$i = 0;
		    	$active = "";
				if($row_cnt > 0){
					while($row_cnt > $i){
						if($i == 0){
							$active = "active";
						} else {
							$active = "";
						}
						echo "<li data-target='#carouselExampleIndicators' data-slide-to='$i' class='" . $active ."'></li>";
						$i++;
					}
				}
			?>
		  </ol>
		  <div class="carousel-inner"> <!-- insert slides -->
			<?php
				$i = 0;
				$active = "";
				if ($row_cnt > 0) {
				    while($row = mysqli_fetch_assoc($result)) {
				    	$img_name = $row['slider_img'];
				    	$url = $row['slider_link'];
				
						if($i == 0) {
							$active = "active";
						} else {
							$active = "";
						}
						$i++;

						if(!empty($url)){
							echo '<div class="carousel-item ' . $active . ' ">
								<a href="' . $url . '">
				      			<img class="d-block w-100" src="IMG/data1/images/' . $img_name . '" alt="Slide #' . $i . '">
				      			</a>
				    		  	</div>';
						} else {
				    		echo '<div class="carousel-item ' . $active . ' ">
				      			<img class="d-block w-100" src="IMG/data1/images/' . $img_name . '" alt="Slide #' . $i . '">
				    		  	</div>';
				    	}
				    	
				    }
				}
			?>
		  </div>
		  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
		    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
		    <span class="sr-only">Previous</span>
		  </a>
		  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
		    <span class="carousel-control-next-icon" aria-hidden="true"></span>
		    <span class="sr-only">Next</span>
		  </a>
		</div>
		<!-- end of Carousel -->


		<!-- social media panel -->
		<div class="main py-3">
      		<div class="album py-0 px-0 mx-0 mx-md-5">
        		<div class="container p-0 m-0 ">

          			<div class="row mx-0 px-0 rounded-border">
          				<!-- left column -->
            			<div class="col-lg-4  col-sm-12 mb-2 " >
              				<div class="card  shadow-sm text-center mb-5 mb-md-0" >
              	
                				<div class="fb-page" data-href="https://www.facebook.com/hirevjunction" data-tabs="timeline" data-width="500" data-height="450px" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="true"><blockquote cite="https://www.facebook.com/hirevjunction" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/hirevjunction">HI-REV Junction</a></blockquote></div>
              				</div>
            			</div>

            			<div class="col-12 d-block d-md-none " style="height:100px"></div>
            			<!-- end of left column -->

            			<!-- center column -->
            			<!--
            			<div class="col-lg-4   col-sm-12 mb-2">
              				<div class="card shadow-sm" style="height:400px">
                				<a href="gallery.php">Gallery</a>
              				</div>
            			</div>
            			-->
            			<!-- end of center column -->

            			<!-- right column -->
            			<div class="col-lg-8  col-sm-12">
              				<div class="card shadow-sm video-responsive mt-5 mt-md-0" >
              	<?php
					if(!$conn){
					    echo "<script> alert('Connection to database failed'); </script>";
					    die("Connection failed: " . mysqli_connect_error());
					}

					$sql = "SELECT * FROM settings_mainpage_video WHERE row_status = 1 ORDER BY id DESC";
					$result = mysqli_query($conn, $sql);

					if($row = mysqli_fetch_assoc($result)) {
				    	$video_type = $row['video_type'];
				    	$video_link = $row['video_link'];

				    	if(!empty($video_type) && $video_type == 1){
				    		$pos = strrpos($video_link, '/');
				    		$youtube_link = "https://www.youtube.com/embed" . substr($video_link,$pos);
				    		echo '<iframe style="width:100%;height:100%" height="100%" 
				    			src="' . $youtube_link . '" 
				    			frameborder="0" allow="accelerometer; autoplay; clipboard-write; 
				    			encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
				    	}
				    }
				
				?>
                
              				</div>
            			</div>
            			<!-- end of right column -->
        			</div>
    			</div>
			</div>
		</div><!--EndOf main-->
		<!-- end of social media panel -->

		<div id="bottom-panel">
					</div>

		<?php require_once "_require/footer.php"?>

		<?php require_once "_require/js.php"?>
		<script>
			$( document ).ready(function() {
		    	loadPanel();
		  	});

		  	function loadPanel(){
			    var page = 'index.php';
			    var panel = 'bottom-panel';

			    $.ajax({
			      url: "_ajax/quill_panel_load.php",
			      timeout:30000,
			      type: "GET",
			      data: {
			        page:page,
			        panel:panel
			    },
			    success: function(response){
			        console.log(response);
					$('#bottom-panel').html(response);
			    },
			    error: function(jqXHR, textStatus){
			        console.log(textStatus.toString());
			        alert('Error encoutered, kindly check the console log');
			    }
			}); 
		}
		</script>

	</body>
</html>