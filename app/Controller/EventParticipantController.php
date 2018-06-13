<?php
// app/Controller/UsersController.php
class EventParticipantController extends AppController
{
    var $name = 'EventParticipant';

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
        $data = $this->EventParticipant->find('all');
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

         if ($this->request->is('post')) {
             $cid =  $this->request->data['STUDENT_ID'];
        
            $this->EventParticipant->set($this->request->data);
            if ($this->EventParticipant->Validation()) {
                $this->EventParticipant->create();
                if ($this->EventParticipant->save($this->request->data)) {
                     $this->EventParticipant->saveField('STUDENT_ID',$cid);

                     $this->request->data['StudentRegistration']['USER_ID'] = $Session_data['ID'];
                    $this->EventParticipant->saveField("created_by",$Session_data['ID']);
                    
                    $ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
                    $this->EventParticipant->saveField("created_ip",$ip);

                    $this->Session->setFlash('Event Participant Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
                } else {
                $this->Session->setFlash('Event Participant Not Added Please Try Again!', 'message_bad');
                }
        }


        $this->loadModel('AcademicClass');
        $class = $this->AcademicClass->GetAcademicClasses();
        $this->set('class',$class);

        $this->loadModel('Event');
        $event = $this->Event->GetEvent();
        $this->set('event',$event);



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

        $this->EventParticipant->id = $id;
        if (empty($this->EventParticipant->id)) {
            $this->Session->setFlash('Invalid Event Participant !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->EventParticipant->Validation()) {
                if ($this->EventParticipant->save($this->request->data)) {

                     $cid =  $this->request->data['STUDENT_ID'];
                     $this->EventParticipant->saveField('STUDENT_ID',$cid);
                    $this->Session->setFlash('Event Participant Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Event Participant Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Event Participant Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $EventParticipant = $this->EventParticipant->find('first', array(
                'contain' => array(),
                'conditions' => array('PARTICIPANT_ID' => $id)
            ));


            if(empty($EventParticipant)) {
                $this->Session->setFlash('Invalid Event Participant !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $EventParticipant;
        }
        $student = $this->GetStudentNameByClass($EventParticipant['EventParticipant']['CLASS_ID']);
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
                if ($this->EventParticipant ->delete($Id)) {
                    $this->Session->setFlash('Event Participant  is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid Event Participant .', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }


    }


    public function admin_studentname(){

        $cid = $this->request->data["cid"];
        $this->loadModel('User');
        $result = $this->User->find("all", array(
            'contain' => array(),
            'conditions' => array('CLASS_ID' => $cid),
            'fields' => array('ID', 'FIRST_NAME'),
            'order' => 'User.FIRST_NAME asc'
        ));

        echo "<div class='col-md-6'>
        <div class='form-group'>
         <label class='control-label col-md-3'>Student Name</label>
         <div class='col-md-9'><select name='STUDENT_ID'  class = 'form-control select2me' onchange='getSeats()'><option value='0'>Select Name</option>";
        foreach($result as $data){
            
             echo "<option value='" . $data['User']['ID'] ."'>" . $data['User']['FIRST_NAME'] ."</option>";
            
        }
        echo "</select>
        </div>
        </div>
        </div>";
        die;
        
    }

    public function GetStudentNameByClass($class_id){
        
        $this->loadModel('AcademicClass');
        
       
        $result = $this->User->find("all", array(
            'contain' => array(),
            'conditions' => array('CLASS_ID' => $class_id),
            'fields' => array('ID', 'FIRST_NAME'),
            'order' => 'User.FIRST_NAME asc'
        ));
        
    
        
        
        $uname = array();
        $uname[0] = 'Select Student Name';
        foreach ($result as $row) {
            $uname[$row['User']['ID']] = ucwords($row['User']['FIRST_NAME']);
        }
        
        
        
        return $uname;
        
    }

    
}    