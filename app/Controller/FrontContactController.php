<?php
class FrontContactController extends AppController {
	

    var $name = 'FrontContact';

    public function beforeFilter()
    {
        parent::beforeFilter();

        if(isset($this->Security) &&  ($this->RequestHandler->isAjax() || $this->RequestHandler->isPost())){
            $this->Security->validatePost = false;
            $this->Security->enabled = false;
            $this->Security->csrfCheck = false;
        }
    }


  

     public function admin_index()
    {
        $this->layout = 'admin_form_layout';
        $this->FrontContact->recursive = 0;
        $this->paginate = array(
            'conditions' => '',
            'limit' => PAGINATION_LIMIT_ADMIN,
        );
       
    $this->set('frontcontact', $this->paginate('FrontContact'));
    }


    public function admin_view($id=null){

        $this->layout = 'admin_form_layout';
        $this->FrontContact->recursive = 0;
        $this->paginate = array(
            'conditions' => array('cID' => $id),
            'limit' => PAGINATION_LIMIT_ADMIN,
        );
       
        $this->set('frontcontact', $this->paginate('FrontContactUs'));
    }


   


      
   
   
}