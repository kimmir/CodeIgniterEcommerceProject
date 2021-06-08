<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="row padtop">
		<div class="col-md-6">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Who are we? What do we do?</h3>
				</div>
				<div class="box-body">
					<form role="form">
						<div class="form-group">
							<textarea class="form-control" rows="10" disabled>
									Generic company description...
							</textarea>
						</div>
					</form>
				</div>
			</div>

			<div class="box box-success">
				<div class="box box-header with-border">
					<h3 class="box-title">Find out if we deliver to you!</h3>
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon">Search</span>
							<input type="text" name="search_text" id="search_text" placeholder="Enter A Country..." class="form-control"/>
						</div>
					</div>
				</div>
				<div class="box box-body">
					<div id="result"></div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Where we are located</h3>
				</div>
				<div class="box-body">
					<div id="map"></div>
					<script async
							src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBojgYGsqgF-mr-iqswYeZYRxZUuGRie-U&callback=initMap&libraries=&v=weekly">
					</script>
				</div>
			</div>
		</div>
	</div>

</div>
