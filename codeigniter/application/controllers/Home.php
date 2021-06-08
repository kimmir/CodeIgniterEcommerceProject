<?php

class Home extends CI_Controller
{
	public function index() //Home Page
	{
		//Splitting each page into sections
        $this->load->view('header/header');
        $this->load->view('header/css');
        $this->load->view('header/navtop');
		$this->load->view('header/navleft');
        $this->load->view('home/mainHome');
        $this->load->view('header/footer');
		$this->load->view('header/pageSpecificScripts/deviceDetection');
        $this->load->view('header/htmlclose');

    }

	public function aboutUs()
	{
		$this->load->view('header/header');
		$this->load->view('header/css');
		$this->load->view('header/navtop');
		$this->load->view('header/navleft');
		$this->load->view('about/mainHome');
		$this->load->view('header/footer');
		$this->load->view('header/pageSpecificScripts/extraAboutUsFooter'); //Loads Ajax/Jquery script
		$this->load->view('header/htmlclose');
	}

    public function login()
	{

		$this->load->view('header/header');
		$this->load->view('header/css');
		$this->load->view('header/navtop');
		$this->load->view('header/navleft');
		$this->load->view('home/login');
		$this->load->view('header/footer');
		$this->load->view('header/htmlclose');
	}

	public function register()
	{
		$this->load->view('home/register');
	}

	public function viewCategories() //Executes on navbar. Returns records of all categories with pagination
	{
		//Need some form of paging when dealing with this information
		//Otherwise it will try to display every record in 1 view
		//https://codeigniter.com/userguide3/libraries/pagination.html
		//Pagination class

		$config['base_url'] = site_url('/viewCategories');
		$numRecords = $this->UserModel->numberOfCategories(); //Get number of records from categories using AdminModel
		$config['total_rows'] = $numRecords;
		$config['per_page']= 10; //Setting how many records I want per page
		$config['uri_segment'] = 3;

		$this->load->library('pagination'); //Loading pagination
		$this->pagination->initialize($config); //Configuring pagination

		//Calculating the page
		$page = ($this->uri->segment(3))? $this->uri->segment(3):0;
		//Getting the data
		$data['allCategories'] = $this->UserModel->getCategoriesData($config['per_page'],$page);
		$data['links'] = $this->pagination->create_links();

		$this->load->view('header/header');
		$this->load->view('header/css');
		$this->load->view('header/navtop');
		$this->load->view('header/navleft');
		$this->load->view('home/viewCategories',$data);
		$this->load->view('header/footer');
		$this->load->view('header/pageSpecificScripts/extraViewCategoryFooter');
		$this->load->view('header/htmlclose');
	}

	public function viewProducts($categoryId) //Executes in viewCategories. Returns products that have a matching category ID
	{
		if (!empty($categoryId)) //Redirect something is wrong with ID
		{
			$data['allProducts'] = $this->UserModel->findProductByCategoryId($categoryId); //Getting products that have matching ID

			$this->load->view('header/header');
			$this->load->view('header/css');
			$this->load->view('header/navtop');
			$this->load->view('header/navleft');
			$this->load->view('home/viewProducts',$data); //Send records to view
			$this->load->view('header/footer');
			$this->load->view('header/pageSpecificScripts/extraViewProductFooter');
			$this->load->view('header/htmlclose');
		} else {
			redirectTo('home/viewCategories','Something went wrong!','alert-danger');
		}
	}

	public function viewModels($productId)
	{
		if (!empty($productId))
		{
			$data['allModels'] = $this->UserModel->findModelsByProductId($productId);

			$this->load->view('header/header');
			$this->load->view('header/css');
			$this->load->view('header/navtop');
			$this->load->view('header/navleft');
			$this->load->view('home/viewModels',$data); //Send records to view
			$this->load->view('header/footer');
			$this->load->view('header/pageSpecificScripts/extraViewModelFooter');

			//$this->load->view('header/pageSpecificScripts/extraViewModelFooter');

			$this->load->view('header/htmlclose');
		} else {
			redirectTo('home/viewCategories','Something went wrong!','alert-danger');
		}
	}

	public function viewModelInformation($modelId)
	{
		if (!empty($modelId))
		{
			$data['model'] = $this->UserModel->getModelData($modelId);

			$this->load->view('header/header');
			$this->load->view('header/css');
			$this->load->view('header/navtop');
			$this->load->view('header/navleft');
			$this->load->view('home/viewModelInformation',$data); //Send records to view
			$this->load->view('header/footer');
			$this->load->view('header/pageSpecificScripts/extraAboutUsFooter'); //Loads Ajax/Jquery script
			$this->load->view('header/pageSpecificScripts/extraViewModelInformationFooter');
			$this->load->view('header/pageSpecificScripts/locationScripts');
			$this->load->view('header/htmlclose');
		}
	}

	public function fetchData() //Runs in about page through Ajax Jquery | Uses search text to return dynamic table
	{
		$output = '';
		$query = '';

		if($this->input->post('query'))
		{
			$query = $this->input->post('query');
		}
		$data = $this->UserModel->get_data($query);
		$output .= '
  <div class="table-responsive">
     <table class="table table-bordered table-striped">
      <tr>            
       <th>Country</th>
      </tr>
  ';
		if($data->num_rows() > 0)
		{
			foreach($data->result() as $row)
			{
				$output .= '
      <tr>        
       <td>'.$row->countryName.'</td>
      </tr>
    ';
			}
		}
		else
		{
			$output .= '<tr>
       <td colspan="5">No Data Found</td>
      </tr>';
		}
		$output .= '</table>';
		echo $output;
	}



}
