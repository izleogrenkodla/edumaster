<?php
class SalaryController extends AppController
{ 
    var $name = 'Salary';

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
		 
		
		 
		$roles = $this->Salary->Role->GetRoles();
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
		    
		    $this->Outstanding = ClassRegistry::init('Outstanding');
		    $abc = $this->Outstanding->find('first', array(
                'contain' => array(),
                'conditions' => array('USER_ID' => $id)
            ));
			
			$out = $abc['Outstanding']['OUT_ID'];
			$outstanding = $abc['Outstanding']['OUTSTANDING_AMOUNT'];
			

			if ($this->request->is('post')) {
			
					
            $this->Salary->set($this->request->data);

                    $this->request->data['StudentRegistration']['USER_ID'] = $Session_data['ID'];
                    
                    $ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
            
                
					$totalday = $this->request->data['TOTAL_DAY'];
					$presentday = $this->request->data['PRESENT_DAY'];
					$net_sal = $this->request->data['NET_SALARY'];
					$ta = $this->request->data['TA'];
					$da = $this->request->data['DA'];
					$pf = $this->request->data['PF'];
					$tax = $this->request->data['TAX'];
					$oa = $this->request->data['OTHER_ADDITION'];
					$od = $this->request->data['OTHER_DEDUCTION'];
					$pay_sal = $this->request->data['PAYABLE_SALARY'];
					$out_amount = $this->request->data['OUTSANDING_AMOUNT'];
					$dud_amount = $this->request->data['DEDUCT_AMOUNT'];
					$mon = $this->request->data['Salary']['month'];
					$rem = $this->request->data['Salary']['REMARK'];

					$outstanding_amt = $outstanding-$dud_amount;

					$Salary['Salary'] = array(
							'ROLE_ID' => $roleid,
							'USER_ID' => $id,
							'OUTSANDING_AMOUNT' => $outstanding_amt,
							'BASE_SALARY' => $bs,
							'TOTAL_DAY' => $totalday,
							'PRESENT_DAY' => $presentday,
							'TA' => $ta,
							'NET_SALARY' => $net_sal,
							'DA' => $da,
							'PF' => $pf,
							'TAX' => $tax,
							'PAYABLE_SALARY' => $pay_sal,
							'OTHER_ADDITION' => $oa,
							'OTHER_DEDUCTION' => $od,
							'DEDUCT_AMOUNT' => $dud_amount,
							'PAID_MONTH' => $mon,
							'REMARK' => $rem,
							'GEN_DATE' => $this->General->datefordb(date("d-m-Y")),
							'STATUS' => 1,
							'created_by' => $Session_data['ID'],
							'created_ip' => $ip,
							
						);

                    $this->Salary->create();
                    $this->Salary->save($Salary);


					
					
						$this->Outstanding->id = $out;
						if (empty($this->Outstanding->id)) {
							$this->Session->setFlash('Invalid Outstanding !', 'message_bad');
							$this->redirect(array('action' => 'index'));
						}

						if ($this->request->is('put') || $this->request->is('post')) {
						  
								if ($this->Outstanding->save($this->request->data)) {
									$this->Outstanding->saveField('OUTSTANDING_AMOUNT',$outstanding_amt);
									$this->Outstanding->saveField('REMAINING_AMOUNT',$outstanding_amt);
								} 
				
			
           
					    } 
                    $this->Session->setFlash('Salary Added Successfully!', 'message_good');
                     $this->redirect(array('controller' => 'Salary', 'action' => 'list'));
                
                
                //$this->Session->setFlash('Outstanding Not Added Please Try Again!', 'message_bad');

		}


        /*if ($this->request->is('post')) {
        	
			
			$totalday = $this->request->data['TOTAL_DAY'];
			$presentday = $this->request->data['PRESENT_DAY'];
			$net_sal = $this->request->data['NET_SALARY'];
			$ta = $this->request->data['TA'];
			$da = $this->request->data['DA'];
			$pf = $this->request->data['PF'];
			$tax = $this->request->data['TAX'];
			$oa = $this->request->data['OTHER_ADDITION'];
			$od = $this->request->data['OTHER_DEDUCTION'];
			$pay_sal = $this->request->data['PAYABLE_SALARY'];
			$out_amount = $this->request->data['OUTSANDING_AMOUNT'];
			$dud_amount = $this->request->data['DEDUCT_AMOUNT'];
			$mon = $this->request->data['Outstanding']['month'];

			


					die;
           }*/
		 
    }


    public function admin_Calculation(){

       $month = $this->request->data["id"];
       $user_id = $this->request->data["uid"];
       $base_salary = $this->request->data["bsal"];
       $year = date('Y');

       

      $tdays = cal_days_in_month(CAL_GREGORIAN, $month, date('Y'));

     $first_date = date('Y-m-d', mktime(0, 0, 0, $month, 1, $year));
     $last_date = date('Y-m-t', mktime(0, 0, 0, $month, 1, $year));
     
     $this->StaffAttendance = ClassRegistry::init('StaffAttendance');

       $pre_day =  $this->StaffAttendance->find('count',array(
                        'conditions'=>array(
                        'StaffAttendance.ATTENDANCE_DATE between ? and ?' => array($first_date, $last_date),
                        'StaffAttendance.USER_ID'=>$user_id,
                        'StaffAttendance.STATUS'=>1,
                        
                    ),
                ));

       $date1=date_create($first_date);
			$date2=date_create($last_date);
			$diff=date_diff($date1,$date2);
			$pending = $diff->format("%R%a");
			$dif =  str_replace('+','',$pending);



       $sundays = intval($dif / 7) + ($date1->format('N') + $dif % 7 >= 7);

       $pday = $pre_day+$sundays;

       $per_day = $base_salary/$tdays;

       $net_sal = $per_day*$pday;

       $this->Allowance = ClassRegistry::init('Allowance');
      
       

      $this->Outstanding = ClassRegistry::init('Outstanding');
      
         $out = $this->Outstanding->find('first', array(
                'contain' => array(),
                'conditions' => array('USER_ID' => $user_id)
            ));

       if(sizeof($out)>0){
       $out_Amount = $out['Outstanding']['OUTSTANDING_AMOUNT'];
       }

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


    

        echo  "<div class='col-md-6' id='TOTAL_DAY'>
						<div class='form-group' >
						<label class='control-label col-md-3'>TOTAL DAY</label><div class='col-md-9'>
						<input type='text' name='TOTAL_DAY' class='form-control' value='$tdays' readonly/>
						</div></div></div>";	

	    echo  "<div class='col-md-6' id='TOTAL_DAY'>
						<div class='form-group' >
						<label class='control-label col-md-3'>Present DAY</label><div class='col-md-9'>
						<input type='text' name='PRESENT_DAY' class='form-control' value='$pday' readonly/>
						</div></div></div>";	

		echo  "<div class='col-md-6' id='TOTAL_DAY'>
						<div class='form-group' >
						<label class='control-label col-md-3'>per day salary</label><div class='col-md-9'>
						<input type='text' name='PER_DAY_SAL' class='form-control' value='$per_day' readonly/>
						</div></div></div>";

		echo  "<div class='col-md-6' id='TOTAL_DAY'>
						<div class='form-group' >
						<label class='control-label col-md-3'>Net Salary</label><div class='col-md-9'>
						<input type='text' name='NET_SALARY' class='form-control' value='$net_sal' readonly/>
						</div></div></div>";

		echo  "<div class='col-md-6' id='TOTAL_DAY'>
						<div class='form-group' >
						<label class='control-label col-md-3'>TD</label><div class='col-md-9'>
						<input type='text' name='TA' class='form-control' value='$tra' readonly/>
						</div></div></div>";

		echo  "<div class='col-md-6' id='TOTAL_DAY'>
						<div class='form-group' >
						<label class='control-label col-md-3'>DA</label><div class='col-md-9'>
						<input type='text' name='DA' class='form-control' value='$da' readonly/>
						</div></div></div>";

		echo  "<div class='col-md-6' id='TOTAL_DAY'>
						<div class='form-group' >
						<label class='control-label col-md-3'>PF</label><div class='col-md-9'>
						<input type='text' name='PF' class='form-control' value='$pf' readonly/>
						</div></div></div>";

		echo  "<div class='col-md-6' id='TOTAL_DAY'>
						<div class='form-group' >
						<label class='control-label col-md-3'>Tax</label><div class='col-md-9'>
						<input type='text' name='TAX' class='form-control' value='$tax' readonly/>
						</div></div></div>";

		echo  "<div class='col-md-6' id='TOTAL_DAY'>
						<div class='form-group' >
						<label class='control-label col-md-3'>Other Addition</label><div class='col-md-9'>
						<input type='text' name='OTHER_ADDITION' class='form-control' value='$oa' readonly/>
						</div></div></div>";

		echo  "<div class='col-md-6' id='TOTAL_DAY'>
						<div class='form-group' >
						<label class='control-label col-md-3'>Other Deduction</label><div class='col-md-9'>
						<input type='text' name='OTHER_DEDUCTION' class='form-control' value='$od' readonly/>
						</div></div></div>";

		echo  "<div class='col-md-6' id='TOTAL_DAY'>
						<div class='form-group' >
						<label class='control-label col-md-3'>gross salary</label><div class='col-md-9'>
						<input type='text' name='PAYABLE_SALARY' class='form-control' value='$pay_salary' readonly/>
						</div></div></div>";

     if($out['Outstanding']['OUTSTANDING_AMOUNT']>0)
    {
		echo  "<div class='col-md-6' id='TOTAL_DAY'>
						<div class='form-group' >
						<label class='control-label col-md-3'>Outstanding Amount</label><div class='col-md-9'>
						<input type='text' name='OUTSANDING_AMOUNT' class='form-control' value='$out_Amount' readonly/>
						</div></div></div>";

		echo  "<div class='col-md-6' id='PERCENTAGE'>
						<div class='form-group' >
						<label class='control-label col-md-3'> Deduction </label><div class='col-md-9'><input type='text' name='DEDUCT_AMOUNT' class='form-control' />
						</div></div></div>";	
	}
	


     die;
   }


   public function admin_list(){

   	     $this->layout = 'admin_form_layout';		
		 $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		$Salary  = $this->Salary->find('all', array(
							'contain' => array('Role','Name'),
							//'conditions' => array('USER_ID' => $id)
		));
		
		
		
		$this->set('list', $Salary);
		//$this->set('id', $id);

		 $roles = $this->Salary->Role->GetRoles();
        $this->set('user_roles', $roles);

   }

   public function admin_view($id){

         $this->layout = 'admin_form_layout';		
		 $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		$history  = $this->Salary->find('first', array(
							'contain' => array('Name','Role'),
							'conditions' => array('SALARY_ID' => $id)
						));
		
		$this->set('list', $history);

		/*$this->User = ClassRegistry::init('User');
		$rol  = $this->User->find('first', array(
							'contain' => array(),
							'conditions' => array('ID' => $id)
						));
			
		$this->set('ro',$rol);*/


   }
   
   public function admin_pre_salary($id){
	     $this->layout = 'admin_form_layout';		
		 $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		 $this->School = ClassRegistry::init('School');
         $school = $this->School->find('first',array(
            'ID'=>1,
         ));
		 $this->set('school',$school);
		 
		 $sal  = $this->Salary->find('first', array(
							'contain' => array('Name','Role'),
							'conditions' => array('SALARY_ID' => $id)
						));
		
		$this->set('data', $sal);
		 
   }

   	 
}
?>