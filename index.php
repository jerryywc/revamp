<!DOCTYPE html>
<html>
	<head>
		<title>Revamp</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?php require_once "require/linkrel.php"?>		
	</head>
	<body>
		<header></header>
		<div class="hirevlogo"></div>



		<nav class="navbar navbar-fixed-top navbar-expand-lg navbar-light">
			
	  		<a class="navbar-brand d-lg-none ml-4 pl-2" href="#">Hirev</a>
	  		
	  		<button class="navbar-toggler" class="background-color:white" type="button" data-toggle="collapse" data-target="
	  			#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    		<span class="navbar-toggler-icon"></span>
	  		</button>

	  		<div class="collapse navbar-collapse text-center" id="navbarSupportedContent">
			    <ul class="navbar-nav mx-auto">
			      	<li class="nav-item active text-left rightborder">
			        	<a class="nav-link active" href="#">Home</span></a>
			      	</li>

			      	<li class="nav-item rightborder text-left">
			        	<a class="nav-link" href="#">About Us</a>
			      	</li>

			      	<li class="nav-item rightborder text-left">
			        	<a class="nav-link" href="product1.php">Products</a>
			      	</li>

			      	<li class="nav-item rightborder text-left">
			        	<a class="nav-link" href="#">Recommender</a>
			      	</li>

			      	<li class="nav-item rightborder text-left">
			        	<a class="nav-link" href="#">Contact</a>
			      	</li>

			      	<li class="nav-item rightborder text-left">
			        	<a class="nav-link" href="#">Feed</a>
			      	</li>

			      	<li class="nav-item text-left">
			        	<a class="nav-link" href="#">Info</a>
			      	</li>
			    </ul>			    
			</div>
		</nav>

		<?php

		$conn = mysqli_connect("localhost", "hirevadm_pbm_usr", "posimADMIN!111", "hirevadm_db");
		if(!$conn){
		    echo "<script> alert('Connection to database failed'); </script>";
		    die("Connection failed: " . mysqli_connect_error());
		}

		$sql = "SELECT * FROM settings_mainpage_sliders WHERE row_status = 1 ORDER BY seq";
		$result = mysqli_query($conn, $sql);

		$row_cnt = mysqli_num_rows($result);
		?>

		
		<!-- Carousel -->
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
				    	$img_name = $row['img_name'];
				    	$url = $row['url'];
				
						if($i == 0) {
							$active = "active";
						} else {
							$active = "";
						}
						$i++;

						if(!empty($url)){
							echo '<div class="carousel-item ' . $active . ' ">
								<a href="' . $url . '">
				      			<img class="d-block w-100" src="img/mainpage/' . $img_name . '" alt="Slide #' . $i . '">
				      			</a>
				    		  	</div>';
						} else {
				    		echo '<div class="carousel-item ' . $active . ' ">
				      			<img class="d-block w-100" src="img/mainpage/' . $img_name . '" alt="Slide #' . $i . '">
				    		  	</div>';
				    	}
				    	
				    }
				}
				mysqli_close($conn);
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

	<div class="main py-3">
      <div class="album py-2 pb-5 mx-5">
        <div class="container">

          <div class="row ">
            <div class="col-lg-4 col-md-6 col-sm-12">
              <div class="card mb-4 shadow-sm">
                Facebook post
              </div>
            </div>
            <div class="col-lg-4 col-md-6  col-sm-12">
              <div class="card mb-4 shadow-sm">
                Gallery
              </div>
            </div>
            <div class="col-lg-4 col-md-6  col-sm-12">
              <div class="card mb-4 shadow-sm video-responsive">
              	<?php
					$conn = mysqli_connect("localhost", "hirevadm_pbm_usr", "posimADMIN!111", "hirevadm_db");
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
				    		echo '<iframe width="350" height="210" 
				    			src="' . $youtube_link . '" 
				    			frameborder="0" allow="accelerometer; autoplay; clipboard-write; 
				    			encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
				    	}
				    }
				
				?>
                
              </div>
            </div>
        </div><!--EndOf main-->
    </div>
	</div>
	</div>


	<div class="footer">
		<div class="bg-vertical-r">
			About
		</div>
		<div class="bg-vertical-r">
			Latest from us	
		</div>
		<div>
			Contact Us
		</div>
	</div>

        <div class="copyright">
        		COPYRIGHT (C) 2020. www.hi-rev.com.my | TERMS OF USAGE | SUPPORT / HELP
        </div>

		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	</body>
</html>