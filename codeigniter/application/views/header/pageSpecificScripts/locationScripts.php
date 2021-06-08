<script>
	function getLocation() {
		var result = document.getElementById("locationResult");
		if(navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(showPosition);
		} else {
			result.innerHTML = "Geolocation not supported by this browser"
		}
	}

	function showPosition(position) {
		var result = document.getElementById("locationResult");
		result.innerHTML = "Latitude: " + position.coords.latitude +
			"| Longitude: " + position.coords.longitude;
	}
</script>
