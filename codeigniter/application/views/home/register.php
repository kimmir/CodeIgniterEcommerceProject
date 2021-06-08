<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Registration Page</title>

	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

	<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css')?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome.min.css')?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/ionicons.min.css')?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/pageStyling.min.css')?>">

	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition register-page">
<div class="register-box">
	<div class="register-box-body">
		<p class="login-box-msg">Register a new membership</p>
		<form action="<?php echo site_url('home/registerUser') ?>" method="post">
			<div class="form-group has-feedback">
				<input type="text" class="form-control" placeholder="Name">
			</div>
			<div class="form-group has-feedback">
				<input type="email" class="form-control" placeholder="Email">
			</div>
			<div class="form-group has-feedback">
				<input type="password" class="form-control" placeholder="Password">
			</div>
			<div class="form-group has-feedback">
				<input type="password" class="form-control" placeholder="Retype Password">
			</div>
			<div class="row">
				<div class="col-xs-8">

				</div>
				<div class="col-xs-4">
					<button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
				</div>
			</div>
		</form>
		<a href="" class="text-center">I already have a membership</a>
	</div>
</div>
<script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js')?>"></script>
</body>
</html>
