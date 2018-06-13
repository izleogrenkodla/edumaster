<?php
class TerminationController extends AppController
{ 
    var $name = 'Termination';

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
	 
		$roles = $this->Termination->Role->GetRoles();
        $this->set('user_roles', $roles);

     }
	 
	public function admin_add($id = null){
	
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
						
						
						
			$this->set('ro',$rol);			
			
			$month = date('m');
			$year = date('Y');

			$tdays = cal_days_in_month(CAL_GREGORIAN, $month, date('Y'));
		
			$first_date = date('Y-m-d', mktime(0, 0, 0, $month, 1, $year));
			$last_date = date('Y-m-t', mktime(0, 0, 0, $month, 1, $year));
			 
			$this->StaffAttendance = ClassRegistry::init('StaffAttendance');
		
			$pre_day =  $this->StaffAttendance->find('count',array(
								'conditions'=>array(
								'StaffAttendance.ATTENDANCE_DATE between ? and ?' => array($first_date, $last_date),
								'StaffAttendance.USER_ID'=>$id,
								'StaffAttendance.STATUS'=>1,
								
							),
						));
						
			 $date1=date_create($first_date);
				$date2=date_create($last_date);
				$diff=date_diff($date1,$date2);
				$pending = $diff->format("%R%a");
				$dif =  str_replace('+','',$pending);



		   $sundays = intval($dif / 7) + ($date1->format('N') + $dif % 7 >= 7);

		   $presentday = $pre_day+$sundays;
		   
			
		   $per_day_sal = $rol['User']['BASE_SALARY']/$tdays;
		   
		 
		   $net_sal = $per_day_sal*$presentday;
		   
			$this->Outstanding = ClassRegistry::init('Outstanding');
		  
			 $out = $this->Outstanding->find('first', array(
					'contain' => array(),
					'conditions' => array('USER_ID' => $id)
				));

       if(sizeof($out)>0){
       $out_Amount = $out['Outstanding']['OUTSTANDING_AMOUNT'];
	   $this->set('out_Amount',$out_Amount);
       }
	    
	   $this->Allowance = ClassRegistry::init('Allowance');

       $allow =  $this->Allowance->find('all',array(
                        'conditions'=>array(),
                ));


      foreach ($allow as $abc => $value) {
      	
      	$type = $value['Allowance']['ALLOWANCE_TYPE'];
        $ta[] = $value['Allowance']['AMOUNT'];
        $pere[] = $value['Allowance']['PERCENTAGE'];
        

      }

    
		$tra =  $ta[0];
		$tax = $ta[2];
		$da =  $ta[3];
		$oa =  $ta[4];
		$od =  $ta[5];
		$p = $pere[1];
   
      
     $pf = $net_sal*$p/100;

     $pay_salary = $net_sal+$tra-$pf-$tax+$da+$oa-$od;

	   
	  $this->set('nsal',$pay_salary);
	  
	  
        if ($this->request->is('post')) {
			
					
            $this->Termination->set($this->request->data);
            if ($this->Termination->Validation()) 
			{
					$StaffLoan['Termination'] = array(
							"USER_ID" => $id,
							"ROLE_ID" => $rol['User']['ROLE_ID'],
							"TERM_DATE" => $this->General->datefordb(date('d/m/Y')),
							"REASON" => $this->request->data['Termination']['REMARK'],
							"OUTSTANDING_AMOUNT" => $out_Amount,
							"NET_SALARY"=>$pay_salary,
						);

                    $this->Termination->create();
                    $this->Termination->save($StaffLoan);
					
					
					$this->User = ClassRegistry::init('User');
					
					$this->User->id = $id;
					if (empty($this->User->id)) {
						$this->Session->setFlash('Invalid User !', 'message_bad');
						$this->redirect(array('action' => 'index'));
					}
					
					if ($this->request->is('put') || $this->request->is('post')) {
					  
							if ($this->User->save($this->request->data)) {
								$this->User->saveField('STATUS',0);
								
							} 
					
					
                    $this->Session->setFlash('Termination Added Successfully!', 'message_good');
                     $this->redirect(array('controller' => 'Termination', 'action' => 'list'));
					}
                } else {
                $this->Session->setFlash('Termination Not Added Please Try Again!', 'message_bad');
                }
		}

	
	}
	
		 public function admin_list()
		{
			 $this->layout = 'admin_form_layout';		
			 $Session_data = $this->Session->read('Auth.Admin');
	
			if (empty($Session_data)) {
				$this->Session->setFlash('Please login', 'message_bad');
				$this->redirect(array('action' => 'index'));
			}
			
			$history  = $this->Termination->find('all', array(
								'contain' => array('Name','Role'),
								
							));
			
			$this->set('list', $history);
			
			
		}
		
		public function admin_fullfinal($id = null)
		{
			 $this->layout = 'admin_form_layout';		
			 $Session_data = $this->Session->read('Auth.Admin');
	
			if (empty($Session_data)) {
				$this->Session->setFlash('Please login', 'message_bad');
				$this->redirect(array('action' => 'index'));
			}
			
			$history  = $this->Termination->find('all', array(
								'contain' => array('Name','Role'),
								
							));
			
			$this->set('list', $history);
		}
}
?>