<?php
class OutstandingController extends AppController
{ 
    var $name = 'Outstanding';

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
		 
		
		 
		$roles = $this->Outstanding->Role->GetRoles();
        $this->set('user_roles', $roles);
		
       
    }

     public function admin_add($id)
    {
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
					$rol  = $this->User->find('first', array(
							'contain' => array(),
							'conditions' => array('ID' => $id)
						));
						
			$roleid = $rol['User']['ROLE_ID'];
			$bs = $rol['User']['BASE_SALARY'];
			
		    $this->set('ro',$rol);
			
			$abc = $this->Outstanding->find('first', array(
                'contain' => array(),
                'conditions' => array('USER_ID' => $id)
            ));
			
			$out = $abc['Outstanding']['OUT_ID'];
					
				$rsal = $abc['Outstanding']['REMAINING_AMOUNT'];
				$userid = $abc['Outstanding']['USER_ID'];
				
				if(isset($this->request->data['Outstanding']['LOAN_AMOUNT']))
				{
				$outamount = $abc['Outstanding']['REMAINING_AMOUNT'] + $this->request->data['Outstanding']['LOAN_AMOUNT'];
				
				}
				if(isset($this->request->data['Outstanding']['LOAN_AMOUNT']))
				{
				$loanamount = $this->request->data['Outstanding']['LOAN_AMOUNT'];
				}
				
				if(isset($this->request->data['Outstanding']['REMARK'])){
					$remark = $this->request->data['Outstanding']['REMARK'];
				}
				$loandate = $this->General->datefordb(date("m.d.y"));
				

				$this->set('rsal',$rsal);	
				

        if ($this->request->is('post')) {
			
					
            $this->Outstanding->set($this->request->data);
            if ($this->Outstanding->Validation()) {
                
					  $this->StaffLoan = ClassRegistry::init('StaffLoan');

						$StaffLoan['StaffLoan'] = array(
							'ROLE_ID' => $roleid,
							'USER_ID' => $userid,
							'OUTSTANDING_AMOUNT' => $outamount,
							'BASE_SALARY' => $bs,
							'LOAN_AMOUNT' => $loanamount,
							'LOAN_DATE' => $loandate,
							'REMARK' => $remark,
							
						);

                    $this->StaffLoan->create();
                    $this->StaffLoan->save($StaffLoan);
					
					
						$this->Outstanding->id = $out;
						if (empty($this->Outstanding->id)) {
							$this->Session->setFlash('Invalid Outstanding !', 'message_bad');
							$this->redirect(array('action' => 'index'));
						}

						if ($this->request->is('put') || $this->request->is('post')) {
						  
								if ($this->Outstanding->save($this->request->data)) {
									$this->Outstanding->saveField('OUTSTANDING_AMOUNT',$outamount);
									$this->Outstanding->saveField('REMAINING_AMOUNT',$outamount);
								} 
				
			
           
					} 
                    $this->Session->setFlash('Outstanding Added Successfully!', 'message_good');
                     $this->redirect(array('controller' => 'Outstanding', 'action' => 'list'));
                
                } else {
                $this->Session->setFlash('Outstanding Not Added Please Try Again!', 'message_bad');
                }
		}

		 
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
				$conditions['Outstanding.USER_ID'] = $id;
				$conditions['Outstanding.ROLE_ID'] = $rdata['User']['ROLE_ID'];
			} 
		
		$Outstanding  = $this->Outstanding->find('all', array(
							'contain' => array('Role','Name'),
							'conditions' => $conditions,
		));
		
		
		
		$this->set('list', $Outstanding);
		//$this->set('id', $id);

		 $roles = $this->Outstanding->Role->GetRoles();
        $this->set('user_roles', $roles);
		
	}


}
?>