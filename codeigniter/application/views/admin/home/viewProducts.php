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
			<?php if($allProducts): ?>

				<table class="table">
					<thead>
					<tr>
						<th scope="col">ID</th>
						<th scope="col">Name</th>
						<th scope="col">Brand</th>
						<th scope="col">Edit</th>
						<th scope="col">Delete</th>
					</tr>
					</thead>
					<tbody>
					<?php foreach($allProducts as $product): ?>
						<tr class="updateProductRow<?php echo $product->pId;?>">
							<td>
								<?php echo $product->pId?>
							</td>
							<td>
								<?php echo $product->pName?>
							</td>
							<td>
								<?php echo $product->pBrand?>
							</td>
							<td>
								<a href="<?php echo site_url('admin/editProduct/'. $product->pId) ?>" class="btn btn-info">
									Edit Product
								</a>
							</td>
							<td>
								<a href="javascript:void(0)" class="btn btn-danger deleteProduct" data-id="<?php echo $product->pId;?>" data-text="<?php echo $product->pId; ?>">
									Delete Product
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
