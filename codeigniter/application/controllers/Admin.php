<?php

class Admin extends CI_Controller //Controller for admin side management of website
{
	public function modelViewInformationUpdate($data, $mId) //Pusher function to update viewModelInformation
	{
		require __DIR__ . '/vendor/autoload.php';

		$options = array(
			'cluster' => 'eu',
			'useTLS' => true
		);

		$pusher = new Pusher\Pusher(
			'7f96ba03b37c3ed41601',
			'2842cf217f47e3faa901',
			'1169323',
			$options
		);

		$obj['mId'] = $mId;
		$obj['quantity'] = $data['mQuantity'];
		$obj['price'] = $data['mPrice'];

		$pusher->trigger(
			'modelViewInformation-channel',
			'model-update-event',
			array('mId' => $obj['mId'],'mQuantity' => $obj['quantity'],'mPrice' => $obj['price'])
		);
	}

	public function modelViewUpdate($data, $mId) //Pusher function to update viewModels
	{
		require __DIR__ . '/vendor/autoload.php';

		$options = array(
			'cluster' => 'eu',
			'useTLS' => true
		);

		$pusher = new Pusher\Pusher(
			'7f96ba03b37c3ed41601',
			'2842cf217f47e3faa901',
			'1169323',
			$options
		);

		$obj['mId'] = $mId;
		$obj['name'] = $data['mName'];
		$obj['quantity'] = $data['mQuantity'];
		$obj['price'] = $data['mPrice'];

		$pusher->trigger(
			'modelView-channel',
			'view-model-update-event',
			array('mId' => $obj['mId'],'mName' => $obj['name'],'mQuantity' => $obj['quantity'],'mPrice' => $obj['price'])
		);
	}

	public function productViewUpdate($data,$pId) //Pusher function to update viewProducts
	{
		require __DIR__ . '/vendor/autoload.php';

		$options = array(
			'cluster' => 'eu',
			'useTLS' => true
		);

		$pusher = new Pusher\Pusher(
			'7f96ba03b37c3ed41601',
			'2842cf217f47e3faa901',
			'1169323',
			$options
		);

		$obj['pId'] = $pId;
		$obj['name'] = $data['pName'];

		$pusher->trigger(
			'productView-channel',
			'view-product-update-event',
			array('pId' => $obj['pId'],'pName' => $obj['name'])
		);
	}

	public function categoryViewUpdate($data,$cId) //Pusher function to update viewCategories
	{
		require __DIR__ . '/vendor/autoload.php';

		$options = array(
			'cluster' => 'eu',
			'useTLS' => true
		);

		$pusher = new Pusher\Pusher(
			'7f96ba03b37c3ed41601',
			'2842cf217f47e3faa901',
			'1169323',
			$options
		);

		$obj['cId'] = $cId;
		$obj['name'] = $data['cName'];

		$pusher->trigger(
			'categoryView-channel',
			'view-category-update-event',
			array('cId' => $obj['cId'],'cName' => $obj['name'])
		);
	}

	public function index()
	{
		//changed this to helper function
		if (isAdminLoggedIn())
		{
			//Checking that the session exists
			$this->load->view('admin/header/header');
			$this->load->view('admin/header/css');
			$this->load->view('admin/header/navtop');
			$this->load->view('admin/header/navleft');
			$this->load->view('admin/home/index');
			$this->load->view('admin/header/footer');
			$this->load->view('admin/header/htmlclose');
		} else {
			//Redirecting if session doesn't exist
			redirectTo('admin/login','Session not found. Log in first!','alert-danger');

		}
	}

	public function login()
	{
		$this->load->view('admin/login');
	}

	public function logOut()
	{
		if (isAdminLoggedIn()) //If session exists, destroy it as well as the credentials
		{
			$this->session->set_userdata('aId','');
			redirectTo('admin/login','Your session has been destroyed','alert-warning');

		} else {
			redirectTo('admin/login','Login Available','alert-info');
		}
	}

	public function checkAdmin() //Gets data from admin/login.php form and checks against the model/db | creates credentials/session
	{
		$data['aEmail'] = $this->input->post('email',true);
		$data['aPassword'] = $this->input->post('password',true);

		if (!empty($data['aEmail']) && !empty($data['aPassword'])) {
			$admin = $this->AdminModel->checkAdmin($data);
			if (count($admin) == 1) {

				//Shows the db dump data -> var_dump($admin);

				$sessionData = array( //Putting user data into array from db
					'aId'=>$admin[0]['aId'],
					'aName'=>$admin[0]['aName'],
					'aEmail'=>$admin[0]['aEmail'],
				);

				$this->session->set_userdata($sessionData); //Setting data for session
				if ($this->session->userdata('aId')) { //If this ID exists
					//Redirect to dashboard
					redirect('admin');
					//Session will need to be checked in AdminController
				} else {
					echo 'logged in unsuccessfully';
				}

				//echo 'found profile';

			} else {
				redirectTo('admin/login','Incorrect email or password','alert-warning');
			}
		}
		else {
			//echo 'something went wrong...';
			//Will redirect back to login instead if there are empty fields
			redirectTo('admin/login','Ensure that the required fields have been filled','alert-warning');

		}
	}

	public function addCategory() //Executes in admin dashboard if admin needs to add a new category | called in admin/navleft.php
	{
		if (isAdminLoggedIn())
		{
			//Admin is logged in
			$this->load->view('admin/header/header');
			$this->load->view('admin/header/css');
			$this->load->view('admin/header/navtop');
			$this->load->view('admin/header/navleft');
			$this->load->view('admin/home/addCategory');
			$this->load->view('admin/header/footer');
			$this->load->view('admin/header/htmlclose');
		} else {
			//Admin not logged in
			redirectTo('admin/login','Log in to add a new category','alert-danger');
		}
	}

	public function viewCategories() //Executes in admin dashboard when needing to view all categories
	{
		if (isAdminLoggedIn())
		{
			//Admin is logged in

			//Need some form of paging when dealing with this information
			//Otherwise it will try to display every record in 1 view
			//https://codeigniter.com/userguide3/libraries/pagination.html
			//Pagination class

			$config['base_url'] = site_url('admin/viewCategories');
			$numRecords = $this->AdminModel->getCategories(); //Get number of records from categories using AdminModel
			$config['total_rows'] = $numRecords;
			$config['per_page']= 15; //Setting how many records I want per page
			$config['uri_segment'] = 3;

			$this->load->library('pagination'); //Loading pagination
			$this->load->library('pagination'); //Loading pagination
			$this->pagination->initialize($config); //Configuring pagination

			//Calculating the page
			$page = ($this->uri->segment(3))? $this->uri->segment(3):0;
			//Getting the data
			$data['allCategories'] = $this->AdminModel->getCategoriesData($config['per_page'],$page);
			$data['links'] = $this->pagination->create_links();

			$this->load->view('admin/header/header');
			$this->load->view('admin/header/css');
			$this->load->view('admin/header/navtop');
			$this->load->view('admin/header/navleft');
			$this->load->view('admin/home/viewCategories',$data); //Passing categories records
			$this->load->view('admin/header/footer');
			$this->load->view('admin/header/htmlclose');
		} else {
			//Admin is not logged in
			redirectTo('admin/login','Log in to view all categories','alert-danger');
		}
	}

	public function submitCategory() //Works with addCategory
	{
		if (isAdminLoggedIn()) {
			//Admin is logged in
			//Accepting form data from admin/home/addCategory
			$data['cName'] = $this->input->post('categoryName',true);
			if (!empty($data['cName'])) {
				$path = realpath(APPPATH.'../assets/images/category/');
				$config['upload_path'] = $path;
				$config['allowed_types'] = 'png|jpg|jpeg';
				$this->load->library('upload',$config);

				if(!$this->upload->do_upload('categoryImage')) {
					$error = $this->upload->display_errors(); //If image upload goes wrong
					redirectTo('admin/addCategory',$error,'alert-warning');

				} else { //If image can be uploaded
					$filename = $this->upload->data();
					$data['cPicture'] = $filename['file_name'];
					$data['cDate'] = date('Y-M-d h:i:sa');
				}

				$categoryValidation = $this->AdminModel->categoryExists($data); //Checks if it already exists
				if ($categoryValidation->num_rows() > 0) {
					redirectTo('admin/addCategory','Category Already Exists!','alert-warning');

				} else {

					$categoryValidation = $this->AdminModel->addCategory($data); //Sending data to model
					if ($categoryValidation) {
						//Successfully added category
						redirectTo('admin/addCategory','Category Added!','alert-success');
					} else {
						//Did not successfully add category
						redirectTo('admin/addCategory','Something went wrong!','alert-danger');
					}
				}

				//Issues with form not being filled
				redirectTo('admin/addCategory','Category name cannot be blank!','alert-warning');
			}

		} else {
			//Admin not logged in
			redirectTo('admin/login','Log in to add a new category!','alert-danger');
		}
	}

	public function editCategory($categoryId) //Executes in viewCategories as a button | Gets category and displays it in a page
	{
		if (isAdminLoggedIn()) { //Check if admin is logged in, else redirect

			if (!empty($categoryId)) { //Checking that ID is not empty

				$data['category'] = $this->AdminModel->findCategoryById($categoryId);
				if (count($data['category']) == 1) { //Checking that the db found the record

					$this->load->view('admin/header/header');
					$this->load->view('admin/header/css');
					$this->load->view('admin/header/navtop');
					$this->load->view('admin/header/navleft');
					$this->load->view('admin/home/editCategory',$data); //Sending record to be changed
					$this->load->view('admin/header/footer');
					$this->load->view('admin/header/htmlclose');

				} else {
					redirectTo('admin/viewCategories','Category not found in DB!','alert-danger');
				}

			} else {
				redirectTo('admin/viewCategories','Something went wrong!','alert-danger');
			}
		} else {
			redirectTo('admin/login','Log in to edit a category!','alert-danger');
		}
	}

	public function updateCategory() //Sends updated category information to db to update record using the AdminModel | Executes in editCategory
	{
		if (isAdminLoggedIn()) { //Ensure that admin is logged in

			$data['cName'] =  $this->input->post('categoryName',true); //Getting category name from form
			$categoryId = $this->input->post('categoryId',true);
			$categoryPictureOld = $this->input->post('categoryPictureOld',true);

			//https://www.php.net/manual/en/function.is-uploaded-file.php
			//https://www.php.net/manual/en/reserved.variables.php

			if(!empty($data['cName']) && isset($data['cName'])) { //Ensuring name isn't empty

				if (isset($_FILES['categoryImage']) && is_uploaded_file($_FILES['categoryImage']['tmp_name'])) { //Finding if admin is sending an image
					//Upload image process
					$path = realpath(APPPATH.'../assets/images/category/');
					$config['upload_path'] = $path;
					$config['allowed_types'] = 'png|jpg|jpeg';
					$this->load->library('upload',$config);

					if(!$this->upload->do_upload('categoryImage')) {
						$error = $this->upload->display_errors(); //If image upload goes wrong
						redirectTo('admin/viewCategories',$error,'alert-danger');

					} else { //If image can be uploaded
						$filename = $this->upload->data();
						$data['cPicture'] = $filename['file_name'];

					}
				}

				$status = $this->AdminModel->updateCategory($data,$categoryId); //Updating record in db using model
				if($status) { //If db update is successful

					if (!empty($data['cPicture']) && isset($data['cPicture'])) { //Have to change the image file
						if (file_exists($path.'/'.$categoryPictureOld)) {
							//https://www.php.net/manual/en/function.unlink.php
							//Deletes said file
							unlink($path.'/'.$categoryPictureOld);
						}
					}

					$this->categoryViewUpdate($data,$categoryId);

					redirectTo('admin/viewCategories','Category Updated!','alert-success');
				} else {
					redirectTo('admin/viewCategories','Something went wrong!','alert-danger');
				}

			} else {
				redirectTo('admin/viewCategories','Category name cannot be empty','alert-danger');
			}

		} else {
			redirectTo('admin/login','Log in to edit a category!','alert-danger');
		}
	}

	public function deleteCategory() //Function to delete a category using AJAX
	{
		if (isAdminLoggedIn()) {

			//Need to determine if the request is from AJAX or if someone is trying to access this method directly
			//https://www.codeigniter.com/userguide3/libraries/input.html?highlight=is_ajax_request#CI_Input::is_ajax_request
			if ($this->input->is_ajax_request()) {

				$this->input->post('id',true);
				$categoryId = $this->input->post('text',true);
				if (!empty($categoryId)) {
					//echo $categoryId = $this->encryption->decrypt($categoryId); //Decrypt the id as it is passed in encrypted form
					//echo $categoryId;

					$categoryPictureOld = $this->AdminModel->getCategoryPicture($categoryId); //Getting the old picture
					if (!empty($categoryPictureOld) && count($categoryPictureOld) == 1) { //Getting image from result array
						$categoryPictureNew = $categoryPictureOld[0]['cPicture'];
					}

					//Now send the id to the AdminModel to find and delete the record
					//die();
					$success = $this->AdminModel->deleteCategory($categoryId);

					if ($success) { //Check if it deleted successfully

						if (!empty($categoryPictureNew) && isset($categoryPictureNew)) { //Deleting the physical image
							$path = realpath(APPPATH.'../assets/images/category/');
							if (file_exists($path.'/'.$categoryPictureNew)) { //Ensuring it exists
								//https://www.php.net/manual/en/function.unlink.php
								//Deletes said file
								unlink($path.'/'.$categoryPictureNew); //Delete picture
							}
						}

						$updateData['return'] = true;
						$updateData['message'] = 'Category has been deleted';
						echo json_encode($updateData); //Send the update to the view -> item in view removed (adminJS.js)
					} else {
						$updateData['return'] = false;
						$updateData['message'] = 'Something went wrong!';
						echo json_encode($updateData); //Send the update to the view -> Not removed, there was a problem (adminJS.js)
					}
				} else {
					$updateData['return'] = false;
					$updateData['message'] = 'Something went wrong! AJAX value issue';
					echo json_encode($updateData);
				}

			} else {
				redirectTo('admin/login','Something went wrong!','alert-danger');
			}
		} else {
			redirectTo('admin/login','Log in to delete a category!','alert-danger');
		}
	}

	public function addProduct()
	{
		if (isAdminLoggedIn())
		{
			//Admin is logged in
			//https://codeigniter.com/user_guide/helpers/form_helper.html

			//Getting categories for the drop down menu in addProduct
			$data['categories'] = $this->AdminModel->getAvailableCategories();

			$this->load->view('admin/header/header');
			$this->load->view('admin/header/css');
			$this->load->view('admin/header/navtop');
			$this->load->view('admin/header/navleft');
			$this->load->view('admin/home/addProduct',$data);
			$this->load->view('admin/header/footer');
			$this->load->view('admin/header/htmlclose');
		} else {
			//Admin not logged in
			redirectTo('admin/login','Log in to add a new product','alert-danger');
		}
	}

	public function submitProduct()
	{
		if (isAdminLoggedIn()) {
			//Admin is logged in
			//Accepting form data from admin/home/addProduct
			$data['pName'] = $this->input->post('productName',true);
			$data['pBrand'] = $this->input->post('productBrand',true);
			$data['catId'] = $this->input->post('catId',true);

			if (!empty($data['pName']) && !empty($data['pBrand']) && !empty($data['catId'])) {
				$path = realpath(APPPATH.'../assets/images/products/');
				$config['upload_path'] = $path;
				$config['allowed_types'] = 'png|jpg|jpeg';
				$this->load->library('upload',$config);

				if(!$this->upload->do_upload('productImage')) {
					$error = $this->upload->display_errors(); //If image upload goes wrong
					redirectTo('admin/addProduct',$error,'alert-warning');

				} else { //If image can be uploaded
					$filename = $this->upload->data();
					$data['pPicture'] = $filename['file_name'];
					$data['pDate'] = date('Y-M-d h:i:sa');
				}

				$productValidation = $this->AdminModel->productExists($data); //Checks if it already exists
				if ($productValidation->num_rows() > 0) {
					redirectTo('admin/addProduct','Product Already Exists!','alert-warning');

				} else {

					$productValidation = $this->AdminModel->addProduct($data); //Sending data to model
					if ($productValidation) {
						//Successfully added category
						redirectTo('admin/addProduct','Product Added!','alert-success');
					} else {
						//Did not successfully add category
						redirectTo('admin/addProduct','Something went wrong!','alert-danger');
					}
				}

			} else {
				//Issues with form not being filled
				redirectTo('admin/addProduct','Ensure all fields are filled!','alert-warning');
			}

		} else {
			//Admin not logged in
			redirectTo('admin/login','Log in to add a new category!','alert-danger');
		}
	}

	public function viewProducts()
	{
		if (isAdminLoggedIn())
		{
			//Admin is logged in
			$config['base_url'] = site_url('admin/viewProducts');
			$numRecords = $this->AdminModel->getProducts(); //Get number of records from categories using AdminModel
			$config['total_rows'] = $numRecords;
			$config['per_page']= 15; //Setting how many records I want per page
			$config['uri_segment'] = 3;

			$this->load->library('pagination'); //Loading pagination
			$this->pagination->initialize($config); //Configuring pagination

			//Calculating the page
			$page = ($this->uri->segment(3))? $this->uri->segment(3):0;
			//Getting the data
			$data['allProducts'] = $this->AdminModel->getProductData($config['per_page'],$page);
			$data['links'] = $this->pagination->create_links();

			$this->load->view('admin/header/header');
			$this->load->view('admin/header/css');
			$this->load->view('admin/header/navtop');
			$this->load->view('admin/header/navleft');
			$this->load->view('admin/home/viewProducts',$data);
			$this->load->view('admin/header/footer');
			$this->load->view('admin/header/htmlclose');
		} else {
			//Admin not logged in
			redirectTo('admin/login','Log in to view products','alert-danger');
		}

	}

	public function editProduct($productId) //Executes in viewProducts as a button | Gets category and displays it in a page
	{
		//$data['categories'] = $this->AdminModel->getAvailableCategories();
		//$data['categories'] = $this->AdminModel->getAvailableCategories();
		if (isAdminLoggedIn()) { //Check if admin is logged in, else redirect

			if (!empty($productId)) { //Checking that ID is not empty

				$data['products'] = $this->AdminModel->findProductById($productId);
				$data['categories'] = $this->AdminModel->getAvailableCategories();
				if (count($data['products']) == 1) { //Checking that the db found the record

					$this->load->view('admin/header/header');
					$this->load->view('admin/header/css');
					$this->load->view('admin/header/navtop');
					$this->load->view('admin/header/navleft');
					$this->load->view('admin/home/editProduct',$data); //Sending record to be changed
					$this->load->view('admin/header/footer');
					$this->load->view('admin/header/htmlclose');

				} else {
					redirectTo('admin/viewProducts','Product not found in DB!','alert-danger');
				}

			} else {
				redirectTo('admin/viewProducts','Something went wrong!','alert-danger');
			}
		} else {
			redirectTo('admin/login','Log in to edit a category!','alert-danger');
		}
	}

	public function updateProduct() //Result of a form submission in editProduct
	{
		if (isAdminLoggedIn()) {
			//Admin is logged in
			//Accepting form data from admin/home/addProduct
			$data['pName'] = $this->input->post('productName',true);
			$data['pBrand'] = $this->input->post('productBrand',true);
			$data['catId'] = $this->input->post('catId',true);
			$pId = $this->input->post('pId',true);
			$productPictureOld = $this->input->post('productPictureOld',true);

			if (!empty($data['pName']) && !empty($data['pBrand']) && !empty($data['catId'])) {

				if (isset($_FILES['productImage']) && is_uploaded_file($_FILES['productImage']['tmp_name'])) { //Finding if admin is sending an image
					//Upload image process
					$path = realpath(APPPATH.'../assets/images/products/');
					$config['upload_path'] = $path;
					$config['allowed_types'] = 'png|jpg|jpeg';
					$this->load->library('upload',$config);

					if(!$this->upload->do_upload('productImage')) {
						$error = $this->upload->display_errors(); //If image upload goes wrong
						redirectTo('admin/viewProducts',$error,'alert-danger');

					} else { //If image can be uploaded
						$filename = $this->upload->data();
						$data['pPicture'] = $filename['file_name'];

					}
				}


				$productValidation = $this->AdminModel->productExists($data); //Checks if it already exists
				if ($productValidation->num_rows() > 0) {
					redirectTo('admin/viewProducts','Product Already Exists!','alert-warning');

				} else {

					$productValidation = $this->AdminModel->updateProduct($data, $pId); //Sending data to model
					if ($productValidation) {
						//Successfully added category

						if (!empty($data['pPicture']) && isset($data['pPicture'])) { //Have to change the image file
							if (file_exists($path.'/'.$productPictureOld)) {
								//https://www.php.net/manual/en/function.unlink.php
								//Deletes said file
								unlink($path.'/'.$productPictureOld);
							}
						}

						$this->productViewUpdate($data,$pId);

						redirectTo('admin/viewProducts','Product Updated!','alert-success');
					} else {
						//Did not successfully add category
						redirectTo('admin/viewProducts','Something went wrong!','alert-danger');
					}
				}

			} else {
				//Issues with form not being filled
				redirectTo('admin/viewProducts','Ensure all fields are filled!','alert-warning');
			}

		} else {
			//Admin not logged in
			redirectTo('admin/login','Log in to add a new category!','alert-danger');
		}
	}

	public function deleteProduct() //Executes in viewProducts page
	{
		if (isAdminLoggedIn()) {

			//Need to determine if the request is from AJAX or if someone is trying to access this method directly
			//https://www.codeigniter.com/userguide3/libraries/input.html?highlight=is_ajax_request#CI_Input::is_ajax_request
			if ($this->input->is_ajax_request()) {

				$this->input->post('id',true);
				$productId = $this->input->post('text',true);
				if (!empty($productId)) {

					$productPictureOld = $this->AdminModel->getProductPicture($productId); //Getting the old picture
					if (!empty($productPictureOld) && count($productPictureOld) == 1) { //Getting image from result array
						$productPictureNew = $productPictureOld[0]['pPicture'];
					}

					//Now send the id to the AdminModel to find and delete the record
					//die();
					$success = $this->AdminModel->deleteProduct($productId);

					if ($success) { //Check if it deleted successfully

						if (!empty($productPictureNew) && isset($productPictureNew)) { //Deleting the physical image
							$path = realpath(APPPATH.'../assets/images/products/');
							if (file_exists($path.'/'.$productPictureNew)) { //Ensuring it exists
								//https://www.php.net/manual/en/function.unlink.php
								//Deletes said file
								unlink($path.'/'.$productPictureNew); //Delete picture
							}
						}

						$updateData['return'] = true;
						$updateData['message'] = 'Product has been deleted';
						echo json_encode($updateData); //Send the update to the view -> item in view removed (adminJS.js)
					} else {
						$updateData['return'] = false;
						$updateData['message'] = 'Something went wrong!';
						echo json_encode($updateData); //Send the update to the view -> Not removed, there was a problem (adminJS.js)
					}
				} else {
					$updateData['return'] = false;
					$updateData['message'] = 'Something went wrong! AJAX value issue';
					echo json_encode($updateData);
				}

			} else {
				redirectTo('admin/login','Something went wrong!','alert-danger');
			}
		} else {
			redirectTo('admin/login','Log in to delete a product!','alert-danger');
		}

	}

	public function addModel() //Executes in navbar
	{
		if (isAdminLoggedIn())
		{
			//Admin is logged in
			//https://codeigniter.com/user_guide/helpers/form_helper.html

			//Getting categories for the drop down menu in addModel
			$data['products'] = $this->AdminModel->getAvailableProducts();

			$this->load->view('admin/header/header');
			$this->load->view('admin/header/css');
			$this->load->view('admin/header/navtop');
			$this->load->view('admin/header/navleft');
			$this->load->view('admin/home/addModel',$data);
			$this->load->view('admin/header/footer');
			$this->load->view('admin/header/htmlclose');
		} else {
			//Admin not logged in
			redirectTo('admin/login','Log in to add a new model','alert-danger');
		}
	}

	public function submitModel() //Form submission function for addModel
	{
		if (isAdminLoggedIn()) {
			//Admin is logged in
			//Accepting form data from admin/home/addProduct
			$data['mName'] = $this->input->post('modelName',true);
			$data['prodId'] = $this->input->post('pId',true);
			$data['mDescription'] = $this->input->post('modelDescription',true);
			$data['mPrice'] = $this->input->post('modelPrice',true);
			$data['mQuantity'] = $this->input->post('modelQuantity',true);

			if (!empty($data['mName']) && !empty($data['prodId'])) {
				$path = realpath(APPPATH.'../assets/images/models/');
				$config['upload_path'] = $path;
				$config['allowed_types'] = 'png|jpg|jpeg';
				$this->load->library('upload',$config);

				if(!$this->upload->do_upload('modelImage')) {
					$error = $this->upload->display_errors(); //If image upload goes wrong
					redirectTo('admin/addModel',$error,'alert-warning');

				} else { //If image can be uploaded
					$filename = $this->upload->data();
					$data['mPicture'] = $filename['file_name'];
					$data['mDate'] = date('Y-M-d h:i:sa');
				}

				$modelValidation = $this->AdminModel->modelExists($data); //Checks if it already exists
				if ($modelValidation->num_rows() > 0) {
					redirectTo('admin/addModel','Model Already Exists!','alert-warning');

				} else {

					$modelValidation = $this->AdminModel->addModel($data); //Sending data to model
					if ($modelValidation) {
						//Successfully added model

						redirectTo('admin/addModel','Model Added!','alert-success');
					} else {
						//Did not successfully add category
						redirectTo('admin/addModel','Something went wrong!','alert-danger');
					}
				}

			} else {
				//Issues with form not being filled
				redirectTo('admin/addModel','Ensure all fields are filled!','alert-warning');
			}

		} else {
			//Admin not logged in
			redirectTo('admin/login','Log in to add a new model!','alert-danger');
		}
	}


	public function viewModels() //Executes in navbar
	{
		if (isAdminLoggedIn())
		{
			//Admin is logged in
			$config['base_url'] = site_url('admin/viewModels');
			$numRecords = $this->AdminModel->getModels(); //Get number of records from models using AdminModel
			$config['total_rows'] = $numRecords;
			$config['per_page']= 15; //Setting how many records I want per page
			$config['uri_segment'] = 3;

			$this->load->library('pagination'); //Loading pagination
			$this->pagination->initialize($config); //Configuring pagination

			//Calculating the page
			$page = ($this->uri->segment(3))? $this->uri->segment(3):0;
			//Getting the data
			$data['allModels'] = $this->AdminModel->getModelData($config['per_page'],$page);
			$data['links'] = $this->pagination->create_links();

			$this->load->view('admin/header/header');
			$this->load->view('admin/header/css');
			$this->load->view('admin/header/navtop');
			$this->load->view('admin/header/navleft');
			$this->load->view('admin/home/viewModels',$data);
			$this->load->view('admin/header/footer');
			$this->load->view('admin/header/htmlclose');
		} else {
			//Admin not logged in
			redirectTo('admin/login','Log in to view products','alert-danger');
		}
	}

	public function editModel($modelId) //Executes in viewProducts as a button | Gets category and displays it in a page
	{

		if (isAdminLoggedIn()) { //Check if admin is logged in, else redirect

			if (!empty($modelId)) { //Checking that ID is not empty

				$data['models'] = $this->AdminModel->findModelById($modelId);
				$data['products'] = $this->AdminModel->getAvailableProducts();
				if (count($data['models']) == 1) { //Checking that the db found the record

					$this->load->view('admin/header/header');
					$this->load->view('admin/header/css');
					$this->load->view('admin/header/navtop');
					$this->load->view('admin/header/navleft');
					$this->load->view('admin/home/editModel',$data); //Sending record to be changed
					$this->load->view('admin/header/footer');
					$this->load->view('admin/header/htmlclose');

				} else {
					redirectTo('admin/viewModels','Product not found in DB!','alert-danger');
				}

			} else {
				redirectTo('admin/viewModels','Something went wrong!','alert-danger');
			}
		} else {
			redirectTo('admin/login','Log in to edit a category!','alert-danger');
		}
	}

	public function updateModel() //Result of a form submission in editModel
	{
		if (isAdminLoggedIn()) {
			//Admin is logged in
			//Accepting form data from admin/home/addProduct
			$data['mName'] = $this->input->post('modelName',true);
			$data['mDescription'] = $this->input->post('modelDescription',true);
			$data['mPrice'] = $this->input->post('modelPrice',true);
			$data['mQuantity'] = $this->input->post('modelQuantity',true);
			$data['prodId'] = $this->input->post('prodId',true);
			$mId = $this->input->post('mId',true);
			$modelPictureOld = $this->input->post('modelPictureOld',true);

			if (!empty($data['mName']) || !empty($data['mDescription']) || !empty($data['mPrice']) || !empty($data['mQuantity'])) {

				if (isset($_FILES['modelImage']) && is_uploaded_file($_FILES['modelImage']['tmp_name'])) { //Finding if admin is sending an image
					//Upload image process
					$path = realpath(APPPATH.'../assets/images/models/');
					$config['upload_path'] = $path;
					$config['allowed_types'] = 'png|jpg|jpeg';
					$this->load->library('upload',$config);

					if(!$this->upload->do_upload('modelImage')) {
						$error = $this->upload->display_errors(); //If image upload goes wrong
						redirectTo('admin/viewModels',$error,'alert-danger');

					} else { //If image can be uploaded
						$filename = $this->upload->data();
						$data['mPicture'] = $filename['file_name'];

					}
				}

				$modelValidation = $this->AdminModel->modelExistsArray($data); //Checks if it already exists
				if ($modelValidation->num_rows() > 0) {
					redirectTo('admin/viewModels','Model Already Exists!','alert-warning');

				} else {

					$modelValidation = $this->AdminModel->updateModel($data, $mId); //Sending data to model
					if ($modelValidation) {
						//Successfully added category

						if (!empty($data['pPicture']) && isset($data['pPicture'])) { //Have to change the image file
							if (file_exists($path.'/'.$modelPictureOld)) {
								//https://www.php.net/manual/en/function.unlink.php
								//Deletes said file
								unlink($path.'/'.$modelPictureOld);
							}
						}

						$this->modelViewInformationUpdate($data,$mId);
						$this->modelViewUpdate($data,$mId);

						redirectTo('admin/viewModels','Model Updated!','alert-success');
					} else {
						//Did not successfully add category
						redirectTo('admin/viewModels','Something went wrong!','alert-danger');
					}
				}

			} else {
				//Issues with form not being filled
				redirectTo('admin/viewModels','Ensure all fields are filled!','alert-warning');
			}

		} else {
			//Admin not logged in
			redirectTo('admin/login','Log in to add a new category!','alert-danger');
		}
	}

	public function deleteModel() //Deleting a product using AJAX
	{
		if (isAdminLoggedIn()) {

			//Need to determine if the request is from AJAX or if someone is trying to access this method directly
			//https://www.codeigniter.com/userguide3/libraries/input.html?highlight=is_ajax_request#CI_Input::is_ajax_request
			if ($this->input->is_ajax_request()) {

				$this->input->post('id',true);
				$modelId = $this->input->post('text',true);
				if (!empty($modelId)) {

					$modelPictureOld = $this->AdminModel->getModelPicture($modelId); //Getting the old picture
					if (!empty($modelPictureOld) && count($modelPictureOld) == 1) { //Getting image from result array
						$modelPictureNew = $modelPictureOld[0]['mPicture'];
					}

					//Now send the id to the AdminModel to find and delete the record
					//die();
					$success = $this->AdminModel->deleteModel($modelId);

					if ($success) { //Check if it deleted successfully

						if (!empty($modelPictureNew) && isset($modelPictureNew)) { //Deleting the physical image
							$path = realpath(APPPATH.'../assets/images/models/');
							if (file_exists($path.'/'.$modelPictureNew)) { //Ensuring it exists
								//https://www.php.net/manual/en/function.unlink.php
								//Deletes said file
								unlink($path.'/'.$modelPictureNew); //Delete picture
							}
						}

						$updateData['return'] = true;
						$updateData['message'] = 'Model has been deleted';
						echo json_encode($updateData); //Send the update to the view -> item in view removed (adminJS.js)
					} else {
						$updateData['return'] = false;
						$updateData['message'] = 'Something went wrong!';
						echo json_encode($updateData); //Send the update to the view -> Not removed, there was a problem (adminJS.js)
					}
				} else {
					$updateData['return'] = false;
					$updateData['message'] = 'Something went wrong! AJAX value issue';
					echo json_encode($updateData);
				}

			} else {
				redirectTo('admin/login','Something went wrong!','alert-danger');
			}
		} else {
			redirectTo('admin/login','Log in to delete a product!','alert-danger');
		}
	}
}
