<?php
class ExperienceController extends AppController
{ 
    var $name = 'Experience';

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

$this->User = ClassRegistry::init('User');
            
            $history  = $this->User->find('first', array(
                                'contain' => array('Role'),
                                'conditions' => array('User.ID' => $id)
                            ));

            $rol = $history['User']['ROLE_ID'];
            $jd = $history['User']['JOINING_DATE'];
            
            
            $this->set('list', $history);

$this->Termination = ClassRegistry::init('Termination');
            
            $last  = $this->Termination->find('first', array(
                                'contain' => array(),
                                'conditions' => array('User_ID' => $id)
                            ));
            $ldate = $last['Termination']['TERM_DATE'];

            
            $this->set('leave_date', $ldate);

             if ($this->request->is('post')) {
      
                       $abc['Experience'] = array(
                        'ROLE_ID' => $rol,
                        'USER_ID' => $id,
                        'JOINING_DATE' => $jd,
                        'LEAVE_DATE' => $ldate,
                        
                    );
                    
                    $this->Experience->create();
                    $this->Experience->save($abc);
                    
                    $this->redirect(array('action' => 'pre_experience',$id));
                
            } 
    
    }

    public function admin_pre_experience($id){
      $this->layout = 'admin_form_layout';
                $Session_data = $this->Session->read('Auth.Admin');
        
                if (empty($Session_data)) {
                    $this->Session->setFlash('Please login', 'message_bad');
                    $this->redirect(array('action' => 'index'));
                }
               
               $this->School = ClassRegistry::init('School');
               
               $this->request->data['Appointment']['USER_ID'] = $Session_data['ID'];
               
               $hrname = $this->User->find('first', array(
                    'contain' => array(),
                    'conditions' => array('ID' => $Session_data['ID'])
                ));
                
                
                $atu_name = $hrname['User']['FIRST_NAME'].' '.$hrname['User']['LAST_NAME'];
              
                $this->set('hr',$atu_name);
                
                    $user_data = $this->User->read(null, $id);
                
                  $this->set('data',$user_data);
                 
                 $this->School = ClassRegistry::init('School');
                 $school = $this->School->find('first',array(
                    'ID'=>1,
                 ));
                 $this->set('school',$school);

                 $this->Termination = ClassRegistry::init('Termination');
            
            $last  = $this->Termination->find('first', array(
                                'contain' => array(),
                                'conditions' => array('User_ID' => $id)
                            ));
            $ldate = $last['Termination']['TERM_DATE'];

            
            $this->set('leave_date', $ldate);
                
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
					$conditions['Experience.USER_ID'] = $id;
					$conditions['Experience.ROLE_ID'] = $rdata['User']['ROLE_ID'];
				}
			
             $data = $this->Experience->find('all', array(
                'contain' => array('Role','Name'),
				'conditions' => $conditions,
            ));
            
            $this->set('data',$data);
        }

}
?>