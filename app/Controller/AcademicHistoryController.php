<?php
class AcademicHistoryController extends AppController
{ 
    var $name = 'AcademicHistory';
	
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
		
		if(isset($this->request->data["Mailer"]["ROLE"]) && ($this->request->data["Mailer"]["ROLE"] == STUDENT_ID)){
			
			
			
			$disable = '';
			$this->set('disable', $disable);
			}else{
				
				
				
				$disable = 'disabled';
			$this->set('disable', $disable);
			}
		
        if(isset($this->request->data['Mailer']["ROLE"]) ) {
			
            $conditions = array('ROLE_ID' => $this->request->data['Mailer']["ROLE"]);
			if(isset($this->request->data['Mailer']["CLS"]) ) {
			
            $conditions["User.CLASS_ID"] = $this->request->data['Mailer']["CLS"];
			
			   }
            $this->request->data["User"]["ROLE"] = $this->request->data['Mailer']["ROLE"];
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
		 
		 $this->set('AcademicHistory', $students);
		 
		
		 
		$roles = $this->AcademicHistory->Role->GetRoles();
        $this->set('user_roles', $roles);
		
		$classes = $this->AcademicHistory->AcademicClass->GetAcademicClasses();
        $this->set('classes', $classes);
       
    }
	
	public function admin_add($id = null){
	
		 $this->layout = 'admin_form_layout';		
		 $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		if($Session_data["ROLE_ID"]!=SUPERVISOR_ID && $Session_data["ROLE_ID"]!=HR_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}
				
			$this->User = ClassRegistry::init('User');
					$rol  = $this->User->find('first', array(
							'contain' => array(),
							'conditions' => array('ID' => $id)
						));
						
			$this->set('ro',$rol);			
				
					

        if ($this->request->is('post')) {
			
					
            $this->AcademicHistory->set($this->request->data);
            if ($this->AcademicHistory->Validation()) {
                $this->AcademicHistory->create();
                if ($this->AcademicHistory->save($this->request->data)) {
					
					$this->AcademicHistory->saveField("USER_ID",$id);
					$this->AcademicHistory->saveField("ROLE_ID",$rol['User']['ROLE_ID']);
					
					$this->request->data['AcademicHistory']['USER_ID'] = $Session_data['ID'];
					$this->AcademicHistory->saveField("created_by",$Session_data['ID']);
					
					$ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
					$this->AcademicHistory->saveField("created_ip",$ip);
					
					
                    $this->Session->setFlash('Academic History Added Successfully!', 'message_good');
                     $this->redirect(array('controller' => 'AcademicHistory', 'action' => 'list',$id));
                }
                } else {
                $this->Session->setFlash('Academic History Not Added Please Try Again!', 'message_bad');
                }
         }
		
        $roles = $this->AcademicHistory->Role->GetRoles();
        $this->set('user_roles', $roles);
		
		 $mediums = $this->AcademicHistory->Medium->GetMedium();
        $this->set('medium', $mediums);
		
		  $classes = $this->AcademicHistory->AcademicClass->GetAcademicClasses();
        $this->set('classes', $classes);

	
	}
	
	
	 public function admin_list($id = null)
    {
		 $this->layout = 'admin_form_layout';		
		 $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		$history  = $this->AcademicHistory->find('all', array(
							'contain' => array('AcademicClass','Medium'),
							'conditions' => array('USER_ID' => $id)
		));
		
		$this->set('list', $history);
		$this->set('id', $id);

		  $mediums = $this->AcademicHistory->Medium->GetMedium();
        $this->set('medium', $mediums);
		
		   $classes = $this->AcademicHistory->AcademicClass->GetAcademicClasses();
        $this->set('classes', $classes);
		
	}
	
	
	 public function admin_view($id = null)
    {
		 $this->layout = 'admin_form_layout';		
		 $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		$history  = $this->AcademicHistory->find('first', array(
							'contain' => array('AcademicClass','Medium'),
							'conditions' => array('ACD_HIS_ID' => $id)
						));
		
		$this->set('list', $history);

		  $mediums = $this->AcademicHistory->Medium->GetMedium();
        $this->set('medium', $mediums);
		
		  $classes = $this->AcademicHistory->AcademicClass->GetAcademicClasses();
        $this->set('classes', $classes);

	}
	
	public function admin_GetClassByUser(){
		
		$ROLE_ID = $this->request->data["AcademicHistory"]["ROLE"];
		
	 	if($ROLE_ID== 5){
		
			$this->AcademicClass = ClassRegistry::init('AcademicClass');
				$std = $this->AcademicClass->find('all',array(
				));
				
			echo "<div class=row>
			<div class='col-md-6'>
              <div class='form-group' >
			<label class='control-label col-md-3'>Select Class</label>
				<div class='col-md-9'>
							<select name='CLASS_ID' class = 'form-control select2me'>";
								echo "<option value='0'>Select Class</option>";
									foreach ($std as $data) 
									{
									echo "<option value='" . $data['AcademicClass']['CLASS_ID'] ."'>" . $data['AcademicClass']['CLASS_NAME'] ."</option>";
								
									}
		
							echo "</select>";
						echo "</div>";
					echo "</div>";
				echo "</div>";
			echo "</div>";
			
		}else{
			return false;
		}
		exit();
	}
	

}

?>