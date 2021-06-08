<div class="content-wrapper">
	<div class="row padtop">
		<?php if($this->session->flashdata('class')): ?>
			<div class="alert <?php echo $this->session->flashdata('class') ?> alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<?php echo $this->session->flashdata('message'); ?>
			</div>
		<?php endif; ?>

		<div class="updateMessage">
		</div>

		<div class="col-md-6 col-md-offset-1">
			<canvas id="status" width="30"height="30"></canvas>
			<h5 id="statusText" class="box-title"></h5>
			<button id="disconnectBtn" class="btn btn-primary">Disconnect</button>
		</div>

		<?php if($allModels): ?>

			<?php foreach($allModels as $model): ?>

				<div id="modelId<?php echo $model->mId?>" hidden><?php echo $model->mId?></div>

				<div class="col-md-6 col-md-offset-1">
					<div class="box box-success">
						<div class="box-header with-border">
							<h3 class="box-title"><?php echo  $model->mName?></h3>
						</div>
						<div class="box-body">
							<a class="thumbnail imgDimensions " href="<?php echo site_url('home/viewModelInformation/'. $model->mId) ?>"">
							<img class="img-responsive imgDimensions " src="<?php echo base_url('assets/images/models/'.$model->mPicture)?>">
							</a>
						</div>
						<div class="box-pane-right">
							<form role="form">
								<div class="form-group">
									<label>Product Name</label>
									<input id="modelName<?php echo $model->mId?>" type="text" class="form-control" placeholder="<?php echo  $model->mName?>" disabled>
								</div>
								<div class="form-group">
									<label>Price (£)</label>
									<input id="modelPrice<?php echo $model->mId?>" type="text" class="form-control" placeholder="<?php echo $model->mPrice?>" disabled>
								</div>
								<div class="form-group">
									<label>Quantity Available</label>
									<input id="modelQuantity<?php echo $model->mId?>" type="text" class="form-control" placeholder="Available: <?php echo $model->mQuantity?>" disabled>
								</div>
							</form>
						</div>
					</div>
				</div>

			<?php endforeach;?>
		<?php else: ?>
			No models enabled
		<?php endif; ?>

	</div>
</div>
