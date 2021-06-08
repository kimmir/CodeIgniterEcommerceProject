<div class="content-wrapper">
	<div class="row padtop">
		<?php if($this->session->flashdata('class')): ?>
			<div class="alert <?php echo $this->session->flashdata('class') ?> alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<?php echo $this->session->flashdata('message'); ?>
			</div>
		<?php endif; ?>
		<div class="col-md-6 col-md-offset-3">
			<div class="updateMessage">

			</div>
			<?php if($allModels): ?>

				<table class="table">
					<thead>
					<tr>
						<th scope="col">ID</th>
						<th scope="col">Name</th>
						<th scope="col">Price</th>
						<th scope="col">Quantity</th>
						<th scope="col">Edit</th>
						<th scope="col">Delete</th>
					</tr>
					</thead>
					<tbody>
					<?php foreach($allModels as $model): ?>
						<tr class="updateModelRow<?php echo $model->mId;?>">
							<td>
								<?php echo $model->mId?>
							</td>
							<td>
								<?php echo $model->mName?>
							</td>
							<td>
								<?php echo $model->mPrice?>
							</td>
							<td>
								<?php echo $model->mQuantity?>
							</td>
							<td>
								<a href="<?php echo site_url('admin/editModel/'. $model->mId) ?>" class="btn btn-info">
									Edit Model
								</a>
							</td>
							<td>
								<a href="javascript:void(0)" class="btn btn-danger deleteModel" data-id="<?php echo $model->mId;?>" data-text="<?php echo $model->mId; ?>">
									Delete Model
								</a>
							</td>
						</tr>
					<?php endforeach;?>
					</tbody>
				</table>
				<?php echo $links; ?>

			<?php else: ?>
				No categories enabled
			<?php endif; ?>
		</div>
	</div>
</div>
