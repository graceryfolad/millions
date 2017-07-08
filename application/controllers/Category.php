<?php
/* 
 * Generated by CRUDigniter v3.0 Beta 
 * www.crudigniter.com
 */
 
class Category extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Category_model');
    } 

    /*
     * Listing of categories
     */
    function index()
    {
        $data['categories'] = $this->Category_model->get_all_categories();

        $data['_view'] = 'category/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new category
     */
    function add()
    {   
        if(isset($_POST) && count($_POST) > 0)     
        {   
            $params = array(
				'cat_name' => $this->input->post('cat_name'),
            );
            
            $category_id = $this->Category_model->add_category($params);
            redirect('category/index');
        }
        else
        {            
            $data['_view'] = 'category/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a category
     */
    function edit($cat_id)
    {   
        // check if the category exists before trying to edit it
        $data['category'] = $this->Category_model->get_category($cat_id);
        
        if(isset($data['category']['cat_id']))
        {
            if(isset($_POST) && count($_POST) > 0)     
            {   
                $params = array(
					'cat_name' => $this->input->post('cat_name'),
                );

                $this->Category_model->update_category($cat_id,$params);            
                redirect('category/index');
            }
            else
            {
                $data['_view'] = 'category/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The category you are trying to edit does not exist.');
    } 

    /*
     * Deleting category
     */
    function remove($cat_id)
    {
        $category = $this->Category_model->get_category($cat_id);

        // check if the category exists before trying to delete it
        if(isset($category['cat_id']))
        {
            $this->Category_model->delete_category($cat_id);
            redirect('category/index');
        }
        else
            show_error('The category you are trying to delete does not exist.');
    }
    
}