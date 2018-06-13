<?php
class TransportsController extends AppController
{ 
    var $name = 'Transports';

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
    
    public function admin_index()
    {
   		$Session = $this->Session->read('Auth.Admin');
		$conditions = array('Transport.STATUS'=>1);

		
        $this->layout = 'admin_form_layout';
        //$this->EBook->recursive = 0;
        $this->paginate = array(
            'conditions' => $conditions,
            'Contain' => array(),
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'Transport.TRANSPORT_ID DESC'
        );

        $this->set('transports', $this->paginate('Transport'));
    }
    
    public function admin_add()
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('post')) {
            $this->Transport->set($this->request->data);

            if ($this->Transport->Validation()) {
                $this->Transport->create();
                if ($this->Transport->save($this->request->data)) {
                   
                    $this->Session->setFlash('Transport Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
            } else {
                $this->Session->setFlash('Transport Not Added Please Try Again!', 'message_bad');
            }
        }
        
        $drivers = $this->Transport->Driver->GetDrivers();
        $this->set('drivers', $drivers);
        
    }
    
   	public function admin_graphic() { 
		  $this->layout = 'admin_form_layout';
     	  $Session_data = $this->Session->read('Auth.Admin');

		if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		

		$list = $this->Transport->find('first',array(
                        'contain'=>array("Driver"),
			'conditions'=>array(
				'TRANSPORT_ID'=>$Session_data['TRANSPORT_ID'],
			),
		));
		
		//pr($list);die;
		$from_address = $this->getLatandlong(urlencode($list["Transport"]["VEHICLE_FROM"]));

		$end_address = $this->getLatandlong(urlencode($list["Transport"]["VEHICLE_END"]));
		
		$this->set('from_lat',$from_address->results[0]->geometry->location->lat);
		$this->set('from_long',$from_address->results[0]->geometry->location->lng);
		
		$this->set('end_lat',$end_address->results[0]->geometry->location->lat);
		$this->set('end_long',$end_address->results[0]->geometry->location->lng);
		$this->set('data',$list);
	
	}// end of function
	
	public function getLatandlong($address) {
		$url = "https://www.google.co.in/maps/place/Surat,+Gujarat/@21.1593526,72.7523856,12z/data=!3m1!4b1!4m2!3m1!1s0x3be04e59411d1563:0xfe4558290938b042";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$response = curl_exec($ch);
		curl_close($ch);
		return json_decode($response);
	
	}// end of function
	
	 
    public function admin_edit($id = null)
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        $this->Transport->id = $id;
        if (empty($this->Transport->id)) {
            $this->Session->setFlash('Invalid EBook !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->Transport->Validation()) {
                $pdf = '';
               
                if ($this->Transport->save($this->request->data)) {

                   $this->Session->setFlash('Transport Updated Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Transport Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Transport Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $Transport = $this->Transport->find('first', array(
                'contain' => array(),
                'conditions' => array('TRANSPORT_ID' => $id)
            ));
            if(empty($Transport)) {
                $this->Session->setFlash('Invalid Transport !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $Transport;
        }
        
        $drivers = $this->Transport->Driver->GetDrivers();
        $this->set('drivers', $drivers);
    }

    public function admin_delete($Id = null)
    {
        $Transport = $this->Transport->find('first', array(
            'contain' => array(),
            'conditions' => array('TRANSPORT_ID' => $Id)
        ));

    
        $this->layout = 'admin_form_layout';
        if (!empty($Id)) {
			$this->Transport->id = $Id;
			if($this->Transport->saveField("STATUS",0)) { 
				$this->Session->setFlash('Transport has been removed successfully.', 'message_good');
				$this->redirect(array('action' => 'index'));
			}
		} else {
            $this->Session->setFlash('Invalid Transport.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }

     public function App_AllocateTransport()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;

        $TransportId = $this->request->data['TRANSPORT_ID'];

        $Transport = $this->Transport->find('first', array(
            'conditions' => array('TRANSPORT_ID' => $TransportId, 'Transport.STATUS' => 1),
            'contain' => array('Driver')
        ));

        //$Transport = Set::extract('/Transport/.', $Transport);

        if(!empty($Transport))
        {
            $message = 'Available Transport';
            $status = true;
        }
        else
        {
            $message = 'No Data Found';
            $status = false;
        }

        $result_array = array(
            'status' => $status,
            'message' => $message,
            'data' => $Transport
        );

        echo json_encode($result_array); die;

    }
}