<?php
// app/Controller/UsersController.php
class SmsCommController extends AppController
{
    var $name = 'SmsComm';

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
        $Session = $this->Session->read('Auth.Admin');
		
        $conditions = array();
        switch($Session["ROLE_ID"]) {
            case STUDENT_ID:
                $conditions['User.ROLE_ID']=STUDENT_ID;
                $conditions['User.CLASS_ID']=$Session["CLASS_ID"];
                break;
            case TEACHER_ID:
                $conditions['User.ROLE_ID']=STUDENT_ID;
                $conditions['User.CLASS_ID']=$Session["CLASS_ID"];
                break;
            default:
                $conditions['ROLE_ID']=STUDENT_ID;
                break;
        }
		
		if(isset($this->request->data["SmsComm"]["ROLE"]) && ($this->request->data["SmsComm"]["ROLE"] == STUDENT_ID)){
			
		
			
			$disable = '';
			$this->set('disable', $disable);
			}else{
				
				
				$disable = 'disabled';
			$this->set('disable', $disable);
			}
		
        if(isset($this->request->data['SmsComm']["ROLE"]) ) {
			
            $conditions = array('ROLE_ID' => $this->request->data['SmsComm']["ROLE"]);
			if(isset($this->request->data['SmsComm']["CLS"]) ) {
			
            $conditions["User.CLASS_ID"] = $this->request->data['SmsComm']["CLS"];
			
			   }
            $this->request->data["User"]["ROLE"] = $this->request->data['SmsComm']["ROLE"];
			$this->layout = 'admin_form_layout';	
			$students = $this->User->find('all',array(
            'limit' => PAGINATION_LIMIT_ADMIN,			
            'conditions' => $conditions,  
        ));
		if(sizeof($students)>0) {
		$this->Session->write('Filter_Students',$students);
		}
		}
		elseif(isset($this->request->data["ROLE"]) && ($this->request->data["ROLE"] == STUDENT_ID)){
        $conditions["User.ROLE_ID"] = $this->params->query["ROLE"];
        $this->layout = 'admin_form_layout';
		$this->layout = 'ajax';
		$students = $this->User->find('all',array(
            'limit' => PAGINATION_LIMIT_ADMIN,
            'conditions' => $conditions
        ));
			
		}else{
			  $this->layout = 'admin_form_layout';
			  $students=array();
		}
		 
		 $this->set('users', $students);
		 
		
		 
		$roles = $this->User->Role->GetRoles();
        $this->set('user_roles', $roles);
		
		$classes = $this->User->AcademicClass->GetAcademicClasses();
        $this->set('classes', $classes);
       
    }
	
	public function admin_list(){
		
		$this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');
		
        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		if($Session_data["ROLE_ID"]!=ADMIN_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}
		
		$conditions = array();
        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

		 
		  if(isset($this->request->data["selected_users"])) {
			
			 

			 $user = $this->User->find('all',array(
            'limit' => PAGINATION_LIMIT_ADMIN,
			
            'conditions' => array('User.ID'=> $this->request->data["selected_users"])
            
        ));
		
		
		
		
		
		foreach($user as $sms){
			
		$mobile[] = $sms['User']['MOBILE_NO'];
		$user_id[] = $sms['User']['ID'];
		
		}
		
		
		$list = rtrim(implode(',',$mobile),',');
		$user_id = implode(',',$user_id);
		$this->set('user', $list);
		$this->set('id', $user_id);
			
			
		}elseif(($this->request->data["SmsComm"]["SMS_ID"])){
			
			$list = $this->request->data["SmsComm"]["SMS_ID"];
			$ids = $this->request->data["ids"];
			$this->set('user', $list);
			$this->set('id', $ids);
			$this->SmsComm->set($this->request->data);
            if ($this->SmsComm->Validation()) {
				$this->SmsComm->create();					
				$list = $this->request->data["SmsComm"]["SMS_ID"];
				$this->set('user', $list);
				$ids = $this->request->data["ids"];		
				$title = $this->request->data["SmsComm"]["SMS_TITLE"];
				$body = $this->request->data["SmsComm"]["SMS_BODY"];
				$ids = $this->request->data["SmsComm"]["SMS_ID"];
				$this->SmsComm->saveField("SMS_TITLE",$title);
				$this->SmsComm->saveField("USER_IDS",$ids);
				$this->SmsComm->saveField("SMS_BODY",$body);
				$this->SmsComm->saveField("created_by",$Session_data['ID']);
				$ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
				$this->SmsComm->saveField("created_ip",$ip);
				$this->Session->setFlash('Sms Sent Successfully!', 'message_good');
				$this->redirect(array('action' => 'index'));
				
				
			}
		 }
		 elseif(!isset($this->request->data["SmsComm"]["SMS_ID"]))
		 { 
			$this->Session->setFlash('Please select users', 'message_bad'); 
			$this->redirect(array('action' => 'index'));
		 } 
		 elseif(!isset($id))
		 {
			 $this->Session->setFlash('Please Update Contact Nos for selected users', 'message_bad');
			 $this->redirect(array('action' => 'index')); 
		 }
			
		}
	
   

  

}