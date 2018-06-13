<?php
class SendReplayController extends AppController
{
    var $name = 'SendReplay';

    public function beforeFilter()
    {
        parent::beforeFilter();

        $this->Auth->allow('');

        if(isset($this->Security) &&  ($this->RequestHandler->isAjax() || $this->RequestHandler->isPost())){
            $this->Security->validatePost = false;
            $this->Security->enabled = false;
            $this->Security->csrfCheck = false;
        }
    }
    
    public function admin_index()
    {
    $Session = $this->Session->read('Auth.Admin');
		

		
        $this->layout = 'admin_form_layout';
        //$this->EBook->recursive = 0;
        $this->paginate = array(
            'Contain' => array(''),
            'limit' => PAGINATION_LIMIT_ADMIN,
        );

        $this->set('SendReplay', $this->paginate('SendReplay'));
    }
}
?>