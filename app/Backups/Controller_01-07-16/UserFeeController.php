<?php
class UserFeeController extends AppController
{ 
    var $name = 'UserFee';

    public function beforeFilter()
    {
        parent::beforeFilter();

        $this->Auth->allow('App_AllocateTransport');

        if(isset($this->Security) &&  ($this->RequestHandler->isAjax() || $this->RequestHandler->isPost())){
            $this->Security->validatePost = false;
            $this->Security->enabled = false;
            $this->Security->csrfCheck = false;
        }
    }
	
	public function admin_index(){
		
		$conditions = array();
		$Session = $this->Session->read('Auth.Admin');
		
		 $this->layout = 'admin_form_layout';
    
				if(isset($this->request->data["UserFee"]["VEHICLE"]) && ($this->request->data["UserFee"]["VEHICLE"])!="" )
		{
			
			$userlist =$this->request->data["UserFee"]["VEHICLE"];
			$conditions = array('UserFee.VEHICLE_ID ' => $userlist);
				
				
			
		}
			$UserFee = $this->UserFee->find("all",array(
            'conditions' => $conditions,
            'limit' => PAGINATION_LIMIT_ADMIN));
			$this->set('userlist', $UserFee);
			
			$this->loadModel('Vehicle');
			$result = $this->Vehicle->GetVehicle();
			$this->set('vehicle',$result);
	}
	
}