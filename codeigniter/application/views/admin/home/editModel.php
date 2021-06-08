<div class="content-wrapper">

	<div class="row padtop">
		<?php if($this->session->flashdata('class')): ?>
			<div class="alert <?php echo $this->session->flashdata('class') ?> alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<?php echo $this->session->flashdata('message'); ?>
			</div>
		<?php endif; ?>
		<div class="col-md-6 col-md-offset-3">
			<?php echo form_open_multipart('admin/updateModel','','') ?>
			<input name="mId" type="hidden" value="<?php echo $models[0]['mId']?>">
			<input name="modelPictureOld" type="hidden" value="<?php echo $models[0]['mPicture']?>">

			<div class="form-group">
				<?php echo form_input('modelName',$models[0]['mName'],array('placeholder'=>'Model Name','class'=>'form-control')); ?>
			</div>
			<div class="form-group">
				<?php echo form_textarea('modelDescription',$models[0]['mDescription'],array('placeholder'=>'Model Description','class'=>'form-control')); ?>
			</div>
			<div class="form-group">
				<?php echo form_input('modelPrice',$models[0]['mPrice'],array('placeholder'=>'Model Price','class'=>'form-control')); ?>
			</div>
			<div class="form-group">
				<?php echo form_input('modelQuantity',$models[0]['mQuantity'],array('placeholder'=>'Model Quantity Available','class'=>'form-control')); ?>
			</div>
			<div class="form-group">
				<?php
				$modelArray = array();
				foreach($products->result() as $product) {
					$modelArray[$product->pId] = $product->pName;
				}
				echo form_dropdown('prodId',$modelArray,$models[0]['prodId'],'class="form-control"');
				?>
			</div>
			<div class="form-group">
				<?php echo form_upload('modelImage','',''); ?>
			</div>
			<div class="form-group">
				<?php echo form_submit('Edit Model','Edit Model','class="btn btn-primary"'); ?>
			</div>
			<?php echo form_close(); ?>

			<img src="<?php echo base_url('assets/images/models/'.$models[0]['mPicture']) ?>" class="img-responsive">
		</div>
	</div>
</div>
