<div class="content-wrapper">

	<div class="row padtop">
		<?php if($this->session->flashdata('class')): ?>
			<div class="alert <?php echo $this->session->flashdata('class') ?> alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<?php echo $this->session->flashdata('message'); ?>
			</div>
		<?php endif; ?>
		<div class="col-md-6 col-md-offset-3">
			<?php echo form_open_multipart('admin/updateCategory','','') ?>
			<input name="categoryId" type="hidden" value="<?php echo $category[0]['cId']?>">
			<input name="categoryPictureOld" type="hidden" value="<?php echo $category[0]['cPicture']?>">
			<div class="form-group">
				<?php echo form_input('categoryName',$category[0]['cName'],'class="form-control"'); ?>
			</div>
			<div class="form-group">
				<?php echo form_upload('categoryImage','',''); ?>
			</div>
			<div class="form-group">
				<?php echo form_submit('Edit Category','Edit Category','class="btn btn-primary"'); ?>
			</div>
			<?php echo form_close(); ?>

			<img src="<?php echo base_url('assets/images/category/'.$category[0]['cPicture']) ?>" class="img-responsive">
		</div>
	</div>
</div>
