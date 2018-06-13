<?php
class RouteController extends AppController
{ 
    var $name = 'Route';

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
			
			$this->layout = 'admin_form_layout';
		 $result = $this->Route->find("all", array(
            'contain' => array(),
			 'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'Route.ROUTE_NAME asc'
        ));
		// echo "<pre>";
		// print_r($result);die;
        $this->set('route', $result);
		}
	
		public function admin_add(){
		
		
		$this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('post')) {
            $this->Route->set($this->request->data);
		
            if ($this->Route->Validation()) {
                $this->Route->create();
				$this->request->data['Route']['USER_ID'] = $Session_data['ID'];
					$this->Route->saveField("created_by",$Session_data['ID']);
					
					$ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
					$this->Route->saveField("created_ip",$ip);
                if ($this->Route->save($this->request->data)) {
					
                   
                    $this->Session->setFlash('Route Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
            } else {
                $this->Session->setFlash('Route Not Added Please Try Again!', 'message_bad');
            }
        }
        
       }
	   
	   
	public function admin_edit($id = null){
		
		
		 $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        $this->Route->id = $id;
        if (empty($this->Route->id)) {
            $this->Session->setFlash('Invalid Route !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
	

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->Route->Validation()) {
                if ($this->Route->save($this->request->data)) {
                    $this->Session->setFlash('Route Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Route Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Route Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $Route = $this->Route->find('first', array(
                'contain' => array(),
                'conditions' => array('ROUTE_ID' => $id)
            ));
			
			//print_r($Route);die;
            if(empty($Route)) {
                $this->Session->setFlash('Invalid Route !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $Route;
        }
	}
	
	
	 public function admin_delete($Id = null)
    {
        $this->layout = 'admin_form_layout';
        if (!empty($Id)) {
            try {
                if ($this->Route->delete($Id)) {
                    $this->Session->setFlash('Route is successfully deleted', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->redirect(array('action' => 'index'));
                    $this->Session->setFlash('Record was not deleted. Unknown error.', 'message_bad');
                }
            } catch (Exception $e) {
                $this->Session->setFlash("Delete failed. {$e->getMessage()}", 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->redirect(array('action' => 'index'));
        } else {
            $this->Session->setFlash('Invalid Route.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }
	   
	   
	   
      
	
	

}	