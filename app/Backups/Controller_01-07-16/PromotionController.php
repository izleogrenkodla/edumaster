<?php
// app/Controller/UsersController.php
class PromotionController extends AppController
{
    var $name = 'Promotion';

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
	
	/*public function admin_index(){
		
		 $this->layout = 'admin_form_layout';
        $this->Promotion->recursive = 0;
        $this->paginate = array(
            'conditions' => '',
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'Promotion.created DESC'
        );
		$this->set('Promotion', $this->paginate('Promotion'));
	}*/
	
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
		 
		
		 
		$roles = $this->Promotion->Role->GetRoles();
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
		
			$this->User = ClassRegistry::init('User');
					$rol  = $this->User->find('first', array(
							'contain' => array(),
							'conditions' => array('ID' => $id)
						));
						
			$roleid = $rol['User']['ROLE_ID'];
			$bs = $rol['User']['BASE_SALARY'];
			
		    $this->set('ro',$rol);
			
			/*$abc = $this->Outstanding->find('first', array(
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
				

				$this->set('rsal',$rsal);	*/
				

        if ($this->request->is('post')) {
			
					
            $this->Promotion->set($this->request->data);
            if ($this->Promotion->Validation()) {
				
				$this->request->data["Promotion"]["DATE"] = $this->General->datefordb($this->request->data["Promotion"]["PRO_DATE"]);
				
				$this->request->data['Promotions']['USER_ID'] = $Session_data['ID'];
					//$this->StaffVacancy->saveField("created_by",$Session_data['ID']);
					
					$ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
					//$this->StaffVacancy->saveField("created_ip",$ip);

						$StaffLoan['Promotion'] = array(
							
							'USER_ID' => $id,
							'OLD_ROLE_ID' => $roleid,
							'NEW_ROLE_ID' => $this->request->data['Promotion']['NEW_ROLE_ID'],
							'OLD_SALARY' => $bs,
							'NEW_SALARY' => $this->request->data['Promotion']['NEW_SALARY'],
							'REMARK' => $this->request->data['Promotion']['REMARK'],
							'PRO_DATE' => $this->request->data["Promotion"]["DATE"],
							'created_by' => $Session_data['ID'],
							'created_ip' => $ip,
							
						);
						

                    $this->Promotion->create();
                    $this->Promotion->save($StaffLoan);
					
					
					$this->User = ClassRegistry::init('User');
					
		$this->User->id = $id;
        if (empty($this->User->id)) {
            $this->Session->setFlash('Invalid User !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
        if ($this->request->is('put') || $this->request->is('post')) {
          
                if ($this->User->save($this->request->data)) {
					$this->User->saveField('ROLE_ID',$this->request->data['Promotion']['NEW_ROLE_ID']);
					$this->User->saveField('BASE_SALARY',$this->request->data['Promotion']['NEW_SALARY']);
                } 
				
			
           
        } else {
           
        }
                    $this->Session->setFlash('Promotion Added Successfully!', 'message_good');
                     $this->redirect(array('controller' => 'Promotion', 'action' => 'list'));
                
                } else {
                $this->Session->setFlash('Promotion Not Added Please Try Again!', 'message_bad');
                }
		}
		
		$roles = $this->Promotion->Role->GetRoles();
        $this->set('user_roles', $roles);
		 
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
				$conditions['Promotion.USER_ID'] = $id;
				$conditions['Promotion.OLD_ROLE_ID'] = $rdata['User']['ROLE_ID'];
			}
		
		$Promotion  = $this->Promotion->find('all', array(
							'contain' => array('Role','Name','NewRole'),
							'conditions' => $conditions,
		));
		 $this->set('Promotion', $Promotion);

		 $roles = $this->Promotion->Role->GetRoles();
        $this->set('user_roles', $roles);
		
	}
}
?>