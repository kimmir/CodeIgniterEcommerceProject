<div class="content-wrapper">

	<div class="row padtop">
		<?php if($this->session->flashdata('class')): ?>
			<div class="alert <?php echo $this->session->flashdata('class') ?> alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<?php echo $this->session->flashdata('message'); ?>
			</div>
		<?php endif; ?>
		<div class="col-md-6 col-md-offset-3">
			<?php echo form_open_multipart('admin/submitModel','','') ?>
			<div class="form-group">
				<?php echo form_input('modelName','',array('placeholder'=>'Model Name','class'=>'form-control')); ?>
			</div>
			<div class="form-group">
				<?php echo form_textarea('modelDescription','',array('placeholder'=>'Model Description','class'=>'form-control')); ?>
			</div>
			<div class="form-group">
				<?php echo form_input('modelPrice','',array('placeholder'=>'Model Price','class'=>'form-control')); ?>
			</div>
			<div class="form-group">
				<?php echo form_input('modelQuantity','',array('placeholder'=>'Model Quantity Available','class'=>'form-control')); ?>
			</div>
			<div class="form-group">
				<?php
				$productArray = array();
				foreach($products->result() as $product) {
					$productArray[$product->pId] = $product->pName;
				}
				echo form_dropdown('pId',$productArray,'','class="form-control"');
				?>
			</div>
			<div class="form-group">
				<?php echo form_upload('modelImage','',''); ?>
			</div>
			<div class="form-group">
				<?php echo form_submit('Add Model','Add Model','class="btn btn-primary"'); ?>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>
