<?php


class AdminModel extends CI_Model
{

	public function checkAdmin($data) //Will check admin credentials
	{
		return $this->db->get_where('admin',$data)
			->result_array();
	}

	public function addCategory($data) //Inserts category to db
	{
		return $this->db->insert('categories',$data);
	}

	public function categoryExists($data) //Checks if a category name already exists
	{
		return $this->db->get_where('categories',array('cName'=>$data['cName']));
	}

	public function getCategories() //Gets number of records in categories that are set to be available
	{
		return $this->db->get_where('categories',array('cAvailable'=>1))->num_rows();
	}

	public function getProducts() //Gets number of records in products that are set to be available
	{
		return $this->db->get_where('products',array('pAvailable'=>1))->num_rows();
	}

	public function getCategoriesData($limit,$start) //Gets the data from categories are puts it into an array
	{
		$this->db->limit($limit,$start);
		$query = $this->db->get_where('categories',array('cAvailable'=>1)); //Querying db
		if ($query->num_rows() > 0) //If there are records
		{
			foreach ($query->result() as $row) //Put into array
			{
				$data[] = $row;
			}
			return $data; //Return data
		}
		return false;
	}

	public function getProductData($limit,$start) //Gets the data from products are puts it into an array
	{
		$this->db->limit($limit,$start);
		$query = $this->db->get_where('products',array('pAvailable'=>1)); //Querying db
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	public function findCategoryById($categoryId) //Takes a category Id and looks in the db for the matching record
	{
		return $this->db->get_where('categories',array('cId'=>$categoryId))->result_array();
	}

	public function findProductById($productId) //Takes a category Id and looks in the db for the matching record
	{
		return $this->db->get_where('products',array('pId'=>$productId))->result_array();
	}

	public function updateCategory($data,$categoryId) //Updates the record db with new category data
	{
		$this->db->where('cId',$categoryId); //Update db where the ID matches the form id
		return $this->db->update('categories',$data); //Update
	}

	public function deleteCategory($categoryId) //Deletes record where Id matches in table
	{
		$this->db->where('cId',$categoryId); //Find the Id in table
		return $this->db->delete('categories'); //Delete
	}

	public function getCategoryPicture($categoryId) //Gets cPicture result array for deleting a category
	{
		return $this->db->select('cPicture')
			->from('categories')
			->where('cId',$categoryId)
			->get()
			->result_array();
	}

	public function getAvailableCategories() //Gets all categories available
	{
		return $this->db->get_where('categories',array('cAvailable'=>1));
	}

	public function productExists($data) //Returning values where there is a matching name and category ID
	{
		return $this->db->get_where('products',array('pName'=>$data['pName'],'catId'=>$data['catId'],'pBrand'=>$data['pBrand']));
	}

	public function addProduct($data) //Inserting product into db
	{
		return $this->db->insert('products',$data);
	}

	public function updateProduct($data, $productId) //Updating product in the product table
	{
		$this->db->where('pId',$productId); //Update db where the ID matches the form id
		return $this->db->update('products',$data); //Update
	}

	public function getProductPicture($productId) //Gets pPicture result array for deleting a category
	{
		return $this->db->select('pPicture')
			->from('products')
			->where('pId',$productId)
			->get()
			->result_array();
	}

	public function deleteProduct($productId) //Deletes record where Id matches in table
	{
		$this->db->where('pId',$productId); //Find the Id in table
		return $this->db->delete('products'); //Delete
	}

	public function getAvailableProducts() //Gets available products in db
	{
		return $this->db->get_where('products',array('pAvailable'=>1));
	}

	public function modelExists($data) //Getting all available models
	{
		return $this->db->get_where('models',array('mName'=>$data['mName'],'prodId'=>$data['prodId']));
	}

	public function addModel($data) //Inserts model into db
	{
		return $this->db->insert('models',$data);
	}

	public function getModels() //Gets number of records available in models
	{
		return $this->db->get_where('models',array('mAvailable'=>1))->num_rows();
	}

	public function getModelData($limit,$start)
	{
		$this->db->limit($limit,$start);
		$query = $this->db->get_where('models',array('mAvailable'=>1)); //Querying db
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	public function findModelById($modelId) //Takes a model Id and looks in the db for the matching record
	{
		return $this->db->get_where('models',array('mId'=>$modelId))->result_array();
	}

	public function getAvailableModels() //Gets available products in db
	{
		return $this->db->get_where('models',array('mAvailable'=>1));
	}

	public function modelExistsArray($data) //Returning values where there is a matching name and model ID
	{
		//return $this->db->get_where('products',array('pName'=>$data['pName'],'catId'=>$data['catId'],'pBrand'=>$data['pBrand']));
		return $this->db->get_where('models',array('mName'=>$data['mName'],'prodId'=>$data['prodId']));
	}

	public function updateModel($data,$modelId)
	{
		$this->db->where('mId',$modelId); //Update db where the ID matches the form id
		return $this->db->update('models',$data); //Update
	}

	public function getModelPicture($modelId) //Getting picture details of a model
	{
		return $this->db->select('mPicture')
			->from('models')
			->where('mId',$modelId)
			->get()
			->result_array();
	}

	public function deleteModel($modelId) //Deletes a model from db using model ID
	{
		$this->db->where('mId',$modelId); //Find the Id in table
		return $this->db->delete('models'); //Delete
	}



}
