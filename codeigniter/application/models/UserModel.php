<?php


class UserModel extends CI_Model
{
	public function numberOfCategories() //returns the number of available categories
	{
		return $this->db->get_where('categories',array('cAvailable'=>1))->num_rows();
	}

	public function getCategoriesData($limit,$start) //Using pagination, returns categories as an array
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

	public function findProductByCategoryId($categoryId) //using the category ID selected by user, return relevant records
	{

		$query = $this->db->get_where('products',array('catId'=>$categoryId,'pAvailable'=>1)); //Querying db
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

	public function findModelsByProductId($productId) //Get all models with matching product id
	{
		$query = $this->db->get_where('models',array('prodId'=>$productId,'mAvailable'=>1)); //Querying db
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

	public function getModelData($modelData) //Get a singular model using model id
	{
		$query = $this->db->get_where('models',array('mId'=>$modelData,'mAvailable'=>1)); //Querying db
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

	function get_data($query) //For categories search bar
	{
		$this->db->select("*");
		$this->db->from("countries");

		if ($query != '')
		{
			$this->db->like('countryName',$query);
		}
		$this->db->order_by('countryId','DESC');
		return $this->db->get();
	}


}
