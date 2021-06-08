<div class="content-wrapper">
	<div class="row padtop">
		<?php if($this->session->flashdata('class')): ?>
			<div class="alert <?php echo $this->session->flashdata('class') ?> alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<?php echo $this->session->flashdata('message'); ?>
			</div>
		<?php endif; ?>

		<div class="col-md-6 col-md-offset-1">
			<canvas id="status" width="30"height="30"></canvas>
			<h5 id="statusText" class="box-title"></h5>
			<button id="disconnectBtn" class="btn btn-primary">Disconnect</button>
		</div>

		<div class="updateMessage">
		</div>

		<?php if($allProducts): ?>
			<?php foreach($allProducts as $product): ?>
				<div id="productId<?php echo $product->pId?>" hidden><?php echo $product->pId?></div>
				<div class="col-md-6 col-md-offset-1">
					<div class="box box-success">
						<div class="box-header with-border">
							<h3 id="productName<?php echo $product->pId?>" class="box-title h3Align"><?php echo $product->pName?></h3>
						</div>
						<div class="box-body">
							<a class="thumbnail imgDimensions" href="<?php echo site_url('home/viewModels/'. $product->pId) ?>"">
							<img class="img-responsive imgDimensions" src="<?php echo base_url('assets/images/products/'.$product->pPicture)?>"alt="">
							</a>
						</div>
					</div>
				</div>
			<?php endforeach;?>
		<?php else: ?>
			No products enabled
		<?php endif; ?>

	</div>
</div>

