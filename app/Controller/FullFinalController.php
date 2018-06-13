<?php
class FullFinalController extends AppController
{ 
    var $name = 'FullFinal';

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
		 $this->layout = 'admin_form_layout';		
			 $Session_data = $this->Session->read('Auth.Admin');
	
			if (empty($Session_data)) {
				$this->Session->setFlash('Please login', 'message_bad');
				$this->redirect(array('action' => 'index'));
			}
			$this->Termination = ClassRegistry::init('Termination');
			
			$history  = $this->Termination->find('all', array(
								'contain' => array('Name','Role'),
							));

			
			$this->set('list', $history);

	}
	
	
	public function admin_add($id) {
			$this->layout = 'admin_form_layout';
			$Session_data = $this->Session->read('Auth.Admin');

			if (empty($Session_data)) {
				$this->Session->setFlash('Please login', 'message_bad');
				$this->redirect(array('action' => 'index'));
			}
			
			if($Session_data["ROLE_ID"]!=HR_ID) {
				$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
				$this->redirect(array('controller' => 'Users','action' => 'index'));
			}

			$this->Termination = ClassRegistry::init('Termination');
			
			$history  = $this->Termination->find('first', array(
								'contain' => array('Name','Role'),
								'conditions' => array('TERM_ID' => $id)
							));

			$rol = $history['Termination']['ROLE_ID'];
			$user = $history['Termination']['USER_ID'];
			$net = $history['Termination']['NET_SALARY'];
			$dt = $history['Termination']['TERM_DATE'];
			
			$this->set('list', $history);

			 if ($this->request->is('post')) {
      
					   $abc['FullFinal'] = array(
                        'ROLE_ID' => $rol,
                        'USER_ID' => $user,
                        'NET_SALARY' => $net,
                       	'FULL_DATE' => $dt,
						
                    );
					
                    $this->FullFinal->create();
                    $this->FullFinal->save($abc);
                    
                    $this->redirect(array('action' => 'pre_full',$user));
                
            } 
	
	}

	
	public function admin_pre_full($id) {
			$this->layout = 'admin_form_layout';
				$Session_data = $this->Session->read('Auth.Admin');
		
				if (empty($Session_data)) {
					$this->Session->setFlash('Please login', 'message_bad');
					$this->redirect(array('action' => 'index'));
				}
				
				if($Session_data["ROLE_ID"]!=HR_ID) {
					$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
					$this->redirect(array('controller' => 'Users','action' => 'index'));
				}
			   
			   $this->User = ClassRegistry::init('User');
			   
			   $this->request->data['Appointment']['USER_ID'] = $Session_data['ID'];
			   
			   $hrname = $this->User->find('first', array(
					'contain' => array(),
					'conditions' => array('ID' => $Session_data['ID'])
				));
				
				
			    $atu_name = $hrname['User']['FIRST_NAME'].' '.$hrname['User']['LAST_NAME'];
			  
				$this->set('hr',$atu_name);
				
				
			   $this->Termination = ClassRegistry::init('Termination');

				$user_data = $this->Termination->read(null, $id);
				
				  $this->set('data',$user_data);
				 
				 $this->School = ClassRegistry::init('School');
				 $school = $this->School->find('first',array(
					'ID'=>1,
				 ));
				 $this->set('school',$school);
			
	}

	public function admin_list($id = null){
			
			  $this->layout = 'admin_form_layout';
			  $Session_data = $this->Session->read('Auth.Admin');
	
			if (empty($Session_data)) {
				$this->Session->setFlash('Please login', 'message_bad');
				$this->redirect(array('action' => 'index'));
			}
			
			$this->User = ClassRegistry::init('User');
			$rdata = $this->User->find('first',array(
				'contain' => array(),
				'conditions' => array('User.ID' =>$id),
			));
			
			if((isset($id)) && ($id)>0)
				{
					$conditions['FullFinal.USER_ID'] = $id;
					$conditions['FullFinal.ROLE_ID'] = $rdata['User']['ROLE_ID'];
				}
				
				 $data = $this->FullFinal->find('all', array(
					'contain' => array('Role','Name'),
					'conditions' => $conditions,
				));
			
			$this->set('data',$data);
		}


}