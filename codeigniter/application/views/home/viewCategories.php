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

			<?php if($allCategories): ?>
			<div id =result>
				<?php foreach($allCategories as $category): ?>
					<div id="categoryId<?php echo $category->cId?>" hidden><?php echo $category->cId?></div>
					<div class="col-md-6 col-md-offset-2">
						<div class="box box-success">
							<div class="box-header with-border">
								<h3 id="categoryName<?php echo $category->cId?>" class="box-title" align="center"><?php echo $category->cName?></h3>
							</div>
							<div class="box-body">
								<a class="thumbnail imgDimensions" href="<?php echo site_url('home/viewProducts/'. $category->cId) ?>">
									<img class="img-responsive imgDimensions" src="<?php echo base_url('assets/images/category/'.$category->cPicture)?>"alt="">
								</a>
							</div>
						</div>
					</div>

				<?php endforeach;?>
			</div>
				<?php echo $links; ?>
			<?php else: ?>
				No categories enabled
			<?php endif; ?>
	</div>
</div>
