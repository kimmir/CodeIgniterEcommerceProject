<div class="content-wrapper">

	<div class="row padtop">
		<?php if($this->session->flashdata('class')): ?>
			<div class="alert <?php echo $this->session->flashdata('class') ?> alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<?php echo $this->session->flashdata('message'); ?>
			</div>
		<?php endif; ?>
		<div class="col-md-6 col-md-offset-3">
			<?php echo form_open_multipart('admin/submitProduct','','') ?>
			<div class="form-group">
				<?php echo form_input('productName','',array('placeholder'=>'Product Name','class'=>'form-control')); ?>
			</div>
			<div class="form-group">
				<?php echo form_input('productBrand','',array('placeholder'=>'Brand Name','class'=>'form-control')); ?>
			</div>
			<div class="form-group">
				<?php
					$categoryArray = array();
					foreach($categories->result() as $category) {
						$categoryArray[$category->cId] = $category->cName;
					}
					echo form_dropdown('catId',$categoryArray,'','class="form-control"');
				?>
			</div>
			<div class="form-group">
				<?php echo form_upload('productImage','',''); ?>
			</div>
			<div class="form-group">
				<?php echo form_submit('Add Product','Add Product','class="btn btn-primary"'); ?>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>
