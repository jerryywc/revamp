<!DOCTYPE html>
<html>
	<head>
		<title>Revamp</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<?php require_once "_require/metalink.php"?>

	</head>
	<body>
		<div id="fb-root"></div>
		<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v10.0&appId=383230492974724&autoLogAppEvents=1" nonce="Cu9UMj2p"></script>

		<header></header>
		<div class="hirevlogo"></div>



		<?php require_once "_require/navbar.php"?>

		
		<!-- main panel -->
		<div class="main py-0 mb-5 pb-5" >
			<div class="row mx-0 px-0">
	      		<div class="col-12 mx-0 px-2 py-5" style="background-color:white; min-height:60vh">
	      			<div id="content">
					</div>
	      		</div>
	      	</div>
	    </div><!--EndOf main-->
	    <!-- end of main panel -->
    

        <?php require_once "_require/footer.php"?>

		<?php require_once "_require/js.php"?>
		<script>
			$( document ).ready(function() {
		    	loadPanel();
		  	});

		  	function loadPanel(){
			    var page = 'career.php';
			    var panel = 'content-panel';

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
		          	$('#content').html(response);
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