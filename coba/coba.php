<?php
var_dump($_POST);
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	
</head>

<body>
	<input type="text" name="" id="id">
	<button class="submit" value="1" method="takedown">takedown</button>
	<button class="submit" value="1" method="approve">approve</button>
	
	<div id="info"></div>
	<form action="" method="POST" id="form">
		<input type="text" name="halo">
		<input type="text" name="budi">
		<button id="submit" type="button" name="submit">submit</button>
	</form>
	<script>
		$(document).ready(function() {
			$('.submit').click(function() {
				var id = $(this).val();
				var method = $(this).attr("method");
				$.ajax({
					type: 'POST',
					url: 'coba4.php',
					data: {id: id, method: method},
					success: function(response) {
						$("#info").html(response);
					}
				});
			});

			$("#submit").click(function() {
				$("#form").submit();
			});
		});


	</script>
	
</body>

</html>