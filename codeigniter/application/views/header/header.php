<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>6CS028-Ecommerce | Dashboard</title>

	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

	<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css')?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/pageStyling.min.css')?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/colours.min.css')?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/style.css') ?>">

	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

	<style>
		#map {
			width: 40vw;
			height: 40vh;
		}
	</style>

	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

	<script>
		let map;
		const myLatLng = {lat: 52.59, lng: -2.11};
		function initMap() {
			map = new google.maps.Map(document.getElementById("map"), {
				center: myLatLng,
				zoom: 5,
			});
			var marker = new google.maps.Marker({
				position: myLatLng,
				map,
				title: "Where we operate from!",
			});
			marker.setMap(map);
		}
	</script>
