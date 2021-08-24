<?php require_once "_require/dbconn.php"?>



<!DOCTYPE html>
<html>
	<head>
		<title>Revamp</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<?php /* require_once "_require/metalink.php" */?>

		<style>
			.carousel-indicators {
			    justify-content: left;
			}

			input{
				margin: 50px;
			}

			.no-border{
				border: none;
			}

			.border{
				border: medium none currentColor
			}

			.highlight-success{
				background-color: Lime;
				color: white;
			}
		</style>

	</head>
	<body>
		<header></header>
		<div class="hirevlogo"></div>

		<?php require_once "_require/navbar.php"?>

        <input type="text" id="tt" name="tt" readonly
        	   	class="no-border"
        		value="test"
        		onclick="enablewrite(this)" 
        		onfocusout="disablewrite(this)"
        		onkeydown="update(1, this)">

	


		<?php require_once "_require/footer.php"?>

		<?php require_once "_require/js.php"?>
		<script>
			function enablewrite(ele){
				$(ele).prop("readonly", false);
				$(ele).removeClass("no-border");
				$(ele).addClass("border");
			}

			function disablewrite(ele){
				$(ele).prop("readonly", true);
				$(ele).removeClass("border");
				$(ele).addClass("no-border");				
			}

			function update(id, ele){
				if(event.key === 'Enter') {
			        alert("Value for id: " + id + " is " + ele.value);
			        addSuccessHighlight(ele);
			    }
			}

			function addSuccessHighlight(ele){
				$(ele).addClass('highlight-success');
			    setTimeout(
			        function() { $(ele).removeClass('highlight-success'); },
			        1000
			    );				
			}
		</script>
	</body>
</html>