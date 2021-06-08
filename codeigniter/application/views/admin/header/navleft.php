<aside class="main-sidebar">
	<section class="sidebar">
		<ul class="sidebar-menu" data-widget="tree">
			<li class="header">MAIN NAVIGATION</li>
			<li class="active treeview">
				<a href="#">
					<i class="fa fa-home"></i> <span>Dashboard</span>
					<span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
				</a>
				<ul class="treeview-menu">
					<li>
						<a href="<?php echo site_url('admin/index') ?>">
							 Home
						</a>
					</li>

				</ul>
			</li>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-pie-chart"></i>
						<span>Categories</span>
						<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
				</a>
				<ul class="treeview-menu">
					<li>
						<a href="<?php echo site_url('admin/addCategory');?>">
							Add Category
						</a>
					</li>
					<li>
						<a href="<?php echo site_url('admin/viewCategories');?>">
							View Categories
						</a>
					</li>
				</ul>
			</li>

			<li class="treeview">
				<a href="#">
					<i class="fa fa-bar-chart"></i>
						<span>Products</span>
						<span class="pull-right-container">
							<i class ="fa fa-angle-left pull-right"></i>
						</span>
				</a>
				<ul class="treeview-menu">
					<li>
						<a href="<?php echo site_url('admin/addProduct')?>">
							Add Product
						</a>
					</li>
					<li>
						<a href="<?php echo site_url('admin/viewProducts')?>">
							View Products
						</a>
					</li>
				</ul>
			</li>

			<li class="treeview">
				<a href="#">
					<i class="fa fa-barcode"></i>
					<span>Models</span>
					<span class="pull-right-container">
							<i class ="fa fa-angle-left pull-right"></i>
						</span>
				</a>
				<ul class="treeview-menu">
					<li>
						<a href="<?php echo site_url('admin/addModel')?>">
							Add Model
						</a>
					</li>
					<li>
						<a href="<?php echo site_url('admin/viewModels')?>">
							View Models
						</a>
					</li>
				</ul>
			</li>
		</ul>
	</section>
</aside>
