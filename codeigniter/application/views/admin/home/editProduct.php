<div class="content-wrapper">

	<div class="row padtop">
		<?php if($this->session->flashdata('class')): ?>
			<div class="alert <?php echo $this->session->flashdata('class') ?> alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<?php echo $this->session->flashdata('message'); ?>
			</div>
		<?php endif; ?>
		<div class="col-md-6 col-md-offset-3">
			<?php echo form_open_multipart('admin/updateProduct','','') ?>
			<input name="pId" type="hidden" value="<?php echo $products[0]['pId']?>">
			<input name="productPictureOld" type="hidden" value="<?php echo $products[0]['pPicture']?>">

			<div class="form-group">
				<?php echo form_input('productName',$products[0]['pName'],array('placeholder'=>'Product Name','class'=>'form-control')); ?>
			</div>
			<div class="form-group">
				<?php echo form_input('productBrand',$products[0]['pBrand'],array('placeholder'=>'Brand Name','class'=>'form-control')); ?>
			</div>
			<div class="form-group">
				<?php
				$categoryArray = array();
				foreach($categories->result() as $category) {
					$categoryArray[$category->cId] = $category->cName;
				}
				echo form_dropdown('catId',$categoryArray,$products[0]['catId'],'class="form-control"');
				?>
			</div>
			<div class="form-group">
				<?php echo form_upload('productImage','',''); ?>
			</div>
			<div class="form-group">
				<?php echo form_submit('Edit Product','Edit Product','class="btn btn-primary"'); ?>
			</div>
			<?php echo form_close(); ?>

			<img src="<?php echo base_url('assets/images/products/'.$products[0]['pPicture']) ?>" class="img-responsive">
		</div>
	</div>
</div>
