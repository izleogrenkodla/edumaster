<?php
class RoundController extends AppController
{
    var $name = 'Round';

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
		$conditions = array('Round.STATUS'=>1);
		
        $this->layout = 'admin_form_layout';
        $this->paginate = array(
            'conditions' => $conditions,
            'Contain' => array(''),
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'Round.created DESC'
        );

        $this->set('Round', $this->paginate('Round'));
    }
	
	public function admin_add(){
	
	    $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('post')) {
            $this->Round->set($this->request->data);
            if ($this->Round->Validation()) {
                $this->Round->create();
                if ($this->Round->save($this->request->data)) {
					
					$this->request->data['Uploaddocument']['USER_ID'] = $Session_data['ID'];
					$this->Round->saveField("created_by",$Session_data['ID']);
					
					$ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
					$this->Round->saveField("created_ip",$ip);
					
                    $this->Session->setFlash('Round Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
                } else {
                $this->Session->setFlash('Round Not Added Please Try Again!', 'message_bad');
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

        $this->Round->id = $id;
        if (empty($this->Round->id)) {
            $this->Session->setFlash('Invalid Round !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->Round->Validation()) {
                if ($this->Round->save($this->request->data)) {
					
					$this->request->data['Uploaddocument']['USER_ID'] = $Session_data['ID'];
					$this->Round->saveField("created_by",$Session_data['ID']);
					
					$ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
					$this->Round->saveField("created_ip",$ip);
					
                    $this->Session->setFlash('Round Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Round Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Round Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $Round = $this->Round->find('first', array(
                'contain' => array(),
                'conditions' => array('ROUND_ID' => $id)
            ));
            if(empty($Round)) {
                $this->Session->setFlash('Invalid Round !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $Round;
        }
    }

}
?>