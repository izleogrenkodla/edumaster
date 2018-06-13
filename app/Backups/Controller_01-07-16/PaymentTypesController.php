<?php
class PaymentTypesController extends AppController
{
    var $name = 'PaymentTypes';

    public function beforeFilter()
    {
        parent::beforeFilter();

        $this->Auth->allow('App_Subjects');

        if(isset($this->Security) &&  ($this->RequestHandler->isAjax() || $this->RequestHandler->isPost())){
            $this->Security->validatePost = false;
            $this->Security->enabled = false;
            $this->Security->csrfCheck = false;
        }
    }
    
    public function admin_index()
    {
    $Session = $this->Session->read('Auth.Admin');
		$conditions = array('PaymentType.STATUS'=>1);

		
        $this->layout = 'admin_form_layout';
        //$this->EBook->recursive = 0;
        $this->paginate = array(
            'conditions' => $conditions,
            'Contain' => array('AcademicClass'),
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'PaymentType.created DESC'
        );

        $this->set('modes', $this->paginate('PaymentType'));
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
            $this->PaymentType->set($this->request->data);

            if ($this->PaymentType->Validation()) {
                $this->PaymentType->create();
                if ($this->PaymentType->save($this->request->data)) {
                   
                    $this->Session->setFlash('Payment Terms Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
            } else {
                $this->Session->setFlash('Payment Terms Not Added Please Try Again!', 'message_bad');
            }
        }
    
    }
    
    public function admin_edit($id = null)
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        $this->PaymentType->id = $id;
        if (empty($this->PaymentType->id)) {
            $this->Session->setFlash('Invalid Payment Terms !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->PaymentType->Validation()) {
                $pdf = '';
               
                if ($this->PaymentType->save($this->request->data)) {

                   $this->Session->setFlash('Payment Terms Updated Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Payment Terms Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Payment Terms Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $PaymentType = $this->PaymentType->find('first', array(
                'contain' => array(),
                'conditions' => array('TYPE_ID' => $id)
            ));
            if(empty($PaymentType)) {
                $this->Session->setFlash('Invalid Payment Terms !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $PaymentType;
        }

    }

    public function admin_delete($Id = null)
    {
        $PaymentType = $this->PaymentType->find('first', array(
            'contain' => array(),
            'conditions' => array('TYPE_ID' => $Id)
        ));

    
        $this->layout = 'admin_form_layout';
        if (!empty($Id)) {
			$this->PaymentType->id = $Id;
			if($this->PaymentType->saveField("STATUS",0)) { 
				$this->Session->setFlash('Payment Terms has been removed successfully.', 'message_good');
				$this->redirect(array('action' => 'index'));
			}
		} else {
            $this->Session->setFlash('Invalid Payment Terms.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }

    public function App_Subjects()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;

        $Subjects = $this->Subject->find('all', array(
            'conditions' => array('STATUS' => 1),
            'fields' => array(),
            'contain' => array()
        ));

        $Subject = Set::extract('/Subject/.', $Subjects);

        if(!empty($Subject))
        {
            $message = 'Available Subject';
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
            'data' => $Subject
        );

        echo json_encode($result_array); die;

}    
}