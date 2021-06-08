<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script type="text/javascript">

	Pusher.logToConsole = true;

	var pusher = new Pusher('7f96ba03b37c3ed41601', {
		cluster: 'eu'
	});
	var channel = pusher.subscribe('productView-channel');

	const canvas = document.getElementById("status");
	const ctx = canvas.getContext('2d');
	const centerX = canvas.width / 2;
	const centerY = canvas.height / 2;
	const radius = 10;

	channel.bind('view-product-update-event', function(data) {

		var obj = data['pId'];

		var exists = document.getElementById("productId"+obj);
		if (typeof(exists) != 'undefined' && exists != null) {
			document.getElementById("productName"+obj).innerText = data['pName'];
		}

	});

	pusher.connection.bind('connecting',function(){
		document.getElementById("statusText").innerText = "Real-Time Connecting..."

		ctx.beginPath();
		ctx.arc(centerX,centerY,radius,0,2 * Math.PI, false);
		ctx.fillStyle = 'yellow';
		ctx.fill();
		ctx.lineWidth = 1;
		ctx.strokeStyle = '#023700';
		ctx.stroke();
	});

	pusher.connection.bind('connected',function(){
		document.getElementById("statusText").innerText = "Real-Time Updates Currently Active"

		ctx.beginPath();
		ctx.arc(centerX,centerY,radius,0,2 * Math.PI, false);
		ctx.fillStyle = 'green';
		ctx.fill();
		ctx.lineWidth = 1;
		ctx.strokeStyle = '#023700';
		ctx.stroke();
	});

	pusher.connection.bind('unavailable',function(){
		document.getElementById("statusText").innerText = "Real-Time Unavailable..."

		ctx.beginPath();
		ctx.arc(centerX,centerY,radius,0,2 * Math.PI, false);
		ctx.fillStyle = 'red';
		ctx.fill();
		ctx.lineWidth = 1;
		ctx.strokeStyle = '#023700';
		ctx.stroke();
	});

	pusher.connection.bind('failed',function(){
		document.getElementById("statusText").innerText = "Real-Time Unavailable..."

		ctx.beginPath();
		ctx.arc(centerX,centerY,radius,0,2 * Math.PI, false);
		ctx.fillStyle = 'red';
		ctx.fill();
		ctx.lineWidth = 1;
		ctx.strokeStyle = '#023700';
		ctx.stroke();
	});

	pusher.connection.bind('disconnected',function(){
		document.getElementById("statusText").innerText = "Real-Time Disconnected..."

		ctx.beginPath();
		ctx.arc(centerX,centerY,radius,0,2 * Math.PI, false);
		ctx.fillStyle = 'red';
		ctx.fill();
		ctx.lineWidth = 1;
		ctx.strokeStyle = '#023700';
		ctx.stroke();
	});

	document.getElementById("disconnectBtn").onclick = function(){
		pusher.disconnect();
	};
</script>
