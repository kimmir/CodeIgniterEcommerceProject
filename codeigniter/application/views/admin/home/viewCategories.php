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
			<?php if($allCategories): ?>

			<table class="table">
				<thead>
					<tr>
						<th scope="col">ID</th>
						<th scope="col">Name</th>
						<th scope="col">Edit</th>
						<th scope="col">Delete</th>
					</tr>
				</thead>
				<tbody>
			<?php foreach($allCategories as $category): ?>
				<tr class="updateCatRow<?php echo $category->cId;?>">
					<td>
						<?php echo $category->cId?>
					</td>
					<td>
						<?php echo $category->cName?>
					</td>
					<td>
						<a href="<?php echo site_url('admin/editCategory/'. $category->cId) ?>" class="btn btn-info">
							Edit Category
						</a>
					</td>
					<td>
						<a href="javascript:void(0)" class="btn btn-danger deleteCategory" data-id="<?php echo $category->cId;?>" data-text="<?php echo $category->cId; ?>">
							Delete Category
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
