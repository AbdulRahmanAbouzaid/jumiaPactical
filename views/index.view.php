<html>
	<head>
		<!-- CSS only -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	</head>
	<body>
		<style>
			body {
				margin: 50px;
			}

			.filters {
				margin-bottom: 25px;
			}
		</style>
		<div class="row filters">
			<select class="col-md-5 country-filter" aria-label="Default select example">
				<option value="" selected>Select Country</option>
				<?php foreach (\App\Helpers\Data::COUNTRIES_LIST as $code => $data) {?>
					<option value="<?=$code?>"><?=$data['name']?></option>
				<?php } ?>
			</select>
			<div class="col-md-2"></div>
			<select class="col-md-5 state-filter" aria-label="Default select example">
				<option value="">Filter By State</option>
				<option value="ok">Valid Phone Numbers</option>
				<option value="nok">Not Valid Phone Numbers</option>
			</select>
		</div>

		<div class="row customers-data">
			<?php include 'table.view.php'?>
		</div>

		<script>
			$('.country-filter, .state-filter').change(function(){
				$.ajax({
					url: "",
					type: 'get',
					data: {
						countryCode: $('.country-filter').val(),
						state: $('.state-filter').val(),
						page: <?= $page ?>
					},
					success: function (data) {
						$('.customers-data').html(data);
					}
				});
			})

			$(document).on('click', '.next, .prev', function(){
				$.ajax({
					url: "",
					type: 'get',
					data: {
						page: $(this).data('page'),
						countryCode: $('.country-filter').val(),
						state: $('.state-filter').val()
					},
					success: function (data) {
						$('.customers-data').html(data);
					}
				});
			})
		</script>
	</body>
</html>
