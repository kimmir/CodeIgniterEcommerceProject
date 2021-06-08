<div class="content-wrapper">
	<div class="row padtop">
		<?php if($this->session->flashdata('class')): ?>
			<div class="alert <?php echo $this->session->flashdata('class') ?> alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<?php echo $this->session->flashdata('message'); ?>
			</div>
		<?php endif; ?>

		<div id="serverUpdate" class="updateMessage">

		</div>

		<div class="col-md-6">

			<div class="box box-primary">
				<?php if($model): ?>
					<div class="box-header with-border">
						<canvas id="status" width="30"height="30"></canvas>
						<h5 id="statusText" class="box-title"></h5>
						<button id="disconnectBtn" class="btn btn-primary">Disconnect</button>
					</div>

					<div class="box-header with-border">
						<h3 class="box-title">Product Image</h3>
					</div>
					<div class="box-body">
						<?php foreach($model as $returnModel): ?>
							<a class="thumbnail imgDimensions" href="#"">
							<img class="img-responsive imgDimensions" src="<?php echo base_url('assets/images/models/'.$returnModel->mPicture)?>">
							</a>
						<?php endforeach;?>
					</div>
					<div class="box-footer">
						<button type="submit" class="btn btn-primary">
							Add To Cart
						</button>
					</div>
				<?php else: ?>
					No models enabled
				<?php endif; ?>
			</div>
			<div class="box box-success">
				<div class="box-header with-border">
					<h3 class="box-title">Product Details</h3>
				</div>
				<div class="box-body">
					<?php if($model): ?>

						<?php foreach($model as $returnModel): ?>

							<div id="modelId" hidden><?php echo $returnModel->mId?></div>

						<form role="form">
							<div class="form-group">
								<label>Product Name</label>
								<input type="text" class="form-control" placeholder="<?php echo  $returnModel->mName?>" disabled>
							</div>
							<div class="form-group">
								<label>Price (£)</label>
								<input id="priceUpdate" type="text" class="form-control" placeholder="<?php echo $returnModel->mPrice?>" disabled>
							</div>
							<div class="form-group">
								<label>Quantity Available</label>
								<input id="quantityUpdate"  type="text" class="form-control" placeholder="<?php echo $returnModel->mQuantity?>" disabled>
							</div>
							<div class="form-group">
								<label>Description</label>
								<textarea class="form-control" rows="5" disabled>
									<?php echo $returnModel->mDescription?>
								</textarea>
							</div>
						</form>
						<?php endforeach;?>
					<?php else: ?>
						No models enabled
					<?php endif; ?>
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Where this product comes from</h3>
				</div>
				<div class="box-body">
					<div id="map"></div>
					<script async
							src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBojgYGsqgF-mr-iqswYeZYRxZUuGRie-U&callback=initMap&libraries=&v=weekly">
					</script>
				</div>
				<div class="box-footer">
					<h3 class="box-title">Find out if we deliver to you!</h3>
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon">Search</span>
							<input type="text" name="search_text" id="search_text" placeholder="Enter A Country..." class="form-control"/>
						</div>
					</div>
					<div id="result"></div>
				</div>
			</div>
		</div>
	</div>


</div>
