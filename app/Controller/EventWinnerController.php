<?php
// app/Controller/UsersController.php
class EventWinnerController extends AppController
{
    var $name = 'EventWinner';

    public function beforeFilter()
    {
        parent::beforeFilter();

        if(isset($this->Security) &&  ($this->RequestHandler->isAjax() || $this->RequestHandler->isPost())){
            $this->Security->validatePost = false;
            $this->Security->enabled = false;
            $this->Security->csrfCheck = false;
        }
    }


    public function admin_index(){

    $this->layout = 'admin_form_layout';
    $data =  $this->EventWinner->find('all');
    
   
    $this->set('data',$data);
   
   
    }


    public function admin_add(){

        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		if($Session_data["ROLE_ID"]!=SUPERVISOR_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}

		$this->loadModel('Event');
        $event = $this->Event->getEvent();
        $this->set('event',$event);
		
         if ($this->request->is('post')) {
            PR($_POST);
            
            
           
            if ($this->EventWinner->Validation()) {
                $this->EventWinner->create();
                if ($this->EventWinner->save($this->request->data)) {
                    $cid =  $this->request->data['STUDENT_ID'];
                    

                     $this->loadModel('Users');
                     $result = $this->Users->find('first',
                                     array('conditions' => array('USers.ID' => $cid)));

                     $classid = $result['Users']['CLASS_ID'];

                     $this->loadModel('AcademicClass');
                     $result1 = $this->AcademicClass->find('first',
                                     array('conditions' => array('AcademicClass.CLASS_ID' => $classid)));
                     $cid1 = $result1['AcademicClass']['CLASS_ID'];
                    
                         $this->EventWinner->saveField('STUDENT_ID',$cid);
                          $this->EventWinner->saveField('CLASS_ID',$cid1);

                     $this->request->data['StudentRegistration']['USER_ID'] = $Session_data['ID'];
                    $this->EventWinner->saveField("created_by",$Session_data['ID']);
                    
                    $ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
                    $this->EventWinner->saveField("created_ip",$ip);

                    $this->Session->setFlash('Event Winner Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
                } else {
                $this->Session->setFlash('Event Winner Not Added Please Try Again!', 'message_bad');
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
		
		if($Session_data["ROLE_ID"]!=SUPERVISOR_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}

        $this->EventWinner->id = $id;
        if (empty($this->EventWinner->id)) {
            $this->Session->setFlash('Invalid Event Winner !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->EventWinner->Validation()) {
                if ($this->EventWinner->save($this->request->data)) {

                     $cid =  $this->request->data['STUDENT_ID'];
                    

                     $this->loadModel('Users');
                     $result = $this->Users->find('first',
                                     array('conditions' => array('USers.ID' => $cid)));

                     $classid = $result['Users']['CLASS_ID'];

                     $this->loadModel('AcademicClass');
                     $result1 = $this->AcademicClass->find('first',
                                     array('conditions' => array('AcademicClass.CLASS_ID' => $classid)));
                     $cid1 = $result1['AcademicClass']['CLASS_ID'];
                    
                         $this->EventWinner->saveField('STUDENT_ID',$cid);
                          $this->EventWinner->saveField('CLASS_ID',$cid1);
                    $this->Session->setFlash('Event Winner Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Event Winner Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Event Winner Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $EventWinner = $this->EventWinner->find('first', array(
                'contain' => array(),
                'conditions' => array('WINNER_ID' => $id)
            ));


            if(empty($EventWinner)) {
                $this->Session->setFlash('Invalid Event Winner !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $EventWinner;
        }
        $student = $this->GetStudentNameByEvent($EventWinner['EventWinner']['EVENT_ID']);
        $this->set('student',$student);


        $this->loadModel('AcademicClass');
        $class = $this->AcademicClass->GetAcademicClasses();
        $this->set('class',$class);

        $this->loadModel('Event');
        $event = $this->Event->GetEvent();
        $this->set('event',$event);



        

    }

      public function admin_delete($Id = null){

        $this->layout = 'admin_form_layout';
		
		$Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		if($Session_data["ROLE_ID"]!=SUPERVISOR_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}
		
        if (!empty($Id)) {
            try {
                if ($this->EventWinner->delete($Id)) {
                    $this->Session->setFlash('Event Winner  is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid Winner Participant .', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }


    }


    public function admin_getStudentByEvent(){

       $eid = $this->request->data["eid"];
        $this->loadModel('EventParticipant');
        $result = $this->EventParticipant->find('all', 
            array('conditions' => array('EventParticipant.EVENT_ID' => $eid)));
      
        
        echo "<div class='col-md-6'>
        <div class='form-group'>
         <label class='control-label col-md-3'>Student Name</label>
         <div class='col-md-9'><select name='STUDENT_ID'  class = 'form-control select2me' onchange='getSeats()'><option value='0'>Select Name</option>";
        foreach($result as $data){
            
             echo "<option value='" . $data['User']['ID'] ."'>Name:  ". $data['User']['FIRST_NAME']." ".$data['User']['LAST_NAME']." | Class:  ". $data['AcademicClass']['CLASS_NAME']."</option>";
              
            
        }

        echo "</select>
        </div>
        </div>
        </div>";
        die;
    }

     public function GetStudentNameByEvent($class_id){
        
        $this->loadModel('EventParticipant');
        $result = $this->EventParticipant->find('all', 
            array('conditions' => array('EventParticipant.EVENT_ID' => $class_id)));
        
    
        
        
        $uname = array();
        $uname[0] = 'Select Student ';
        foreach ($result as $row) {
            $uname[$row['User']['ID']] = ucwords($row['User']['FIRST_NAME'] ." ". $row['User']['LAST_NAME'] . " | " . $row['AcademicClass']['CLASS_NAME']);
        }
        
        
        
        return $uname;
        
    }
   
}