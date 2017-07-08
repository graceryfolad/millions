<?php
class DataBundle extends MY_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Databundle_model');
    } 

    public function GetBundle() 
    {
    	if(isset($_POST) && count($_POST)>0)
    	{
    		$ser_code = $this->input->post('ser_code');
    		$bundles = $this->Databundle_model->get_databundle_service($ser_code);

    		if(is_array($bundles)){
    			
    			echo '<option value="">Select Data Bundle </option>';
                foreach($bundles as $row)
                { 
                	$title = "N{$row['data_price']} for {$row['data_size']}";
                 echo "<option value='".$row['data_price']."'>".$title."</option>";
                }
    		}
    		else{
    			echo "none";
    		}
    	}
    }
}