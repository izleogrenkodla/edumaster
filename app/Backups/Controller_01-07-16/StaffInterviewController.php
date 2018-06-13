<?php
class StaffInterviewController extends AppController
{
    var $name = 'StaffInterview';

    public function beforeFilter()
    {
        parent::beforeFilter();

        $this->Auth->allow('App_GetSubjects');

        if(isset($this->Security) &&  ($this->RequestHandler->isAjax() || $this->RequestHandler->isPost())){
            $this->Security->validatePost = false;
            $this->Security->enabled = false;
            $this->Security->csrfCheck = false;
        }
    }
    
    public function admin_index()
    {
    $Session = $this->Session->read('Auth.Admin');
		$conditions = array('Subject.STATUS'=>1);

		
        $this->layout = 'admin_form_layout';
		
		$this->VacancyReplay = ClassRegistry::init('VacancyReplay');
      
	  $data  = $this->VacancyReplay->find('all', array(
							'contain' => array(),
							'conditions' => '',
						));
						
        $this->set('inq', $data);
    }
	
	 public function admin_view($id = null)
    {
        $this->layout = 'admin_form_layout';
		$this->VacancyReplay = ClassRegistry::init('VacancyReplay');
		
       $data  = $this->VacancyReplay->find('first', array(
							'contain' => array(),
							'conditions' => array('REPLAY_ID'=>$id),
						));
						
        $this->set('data', $data);
    }
	
}
?>