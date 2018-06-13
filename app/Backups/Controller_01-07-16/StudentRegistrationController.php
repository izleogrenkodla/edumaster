<?php
class StudentRegistrationController extends AppController
{
    var $name = 'StudentRegistration'; 
 
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
	
	public function admin_interview_index(){
		  $this->layout = 'admin_form_layout';
       // $this->StudentRegistration->recursive = 0;
        $this->paginate = array(
            'conditions' => $conditions,
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'StudentRegistration.created DESC'
        );
		$this->set('StudentRegistration', $this->paginate('StudentRegistration'));
	}
	
	

    public function admin_index()
    {
		
		$this->layout = 'admin_form_layout';
		 if(isset($this->params->query["data"]["StudentRegistration"]['Document']))
		 {
			 echo $this->params->query["data"]["StudentRegistration"]['Document'];
			
		 }
		
		 if(isset($this->params->query["data"]["StudentRegistration"]) && is_array($this->params->query["data"]["StudentRegistration"])) {
            $post = $this->params->query["data"]["StudentRegistration"];
            if(isset($post["first_name"]) && $post["first_name"]!='') {
                $conditions['StudentRegistration.FIRST_NAME LIKE'] = '%'.$post["first_name"].'%';
            }
			 if(isset($post["middle"]) && $post["middle"]!='') {
                $conditions['StudentRegistration.MIDDLE_NAME'] = $post["middle"];
            }
            if(isset($post["last_name"]) && $post["last_name"]!='') {
                $conditions['StudentRegistration.LAST_NAME LIKE'] = '%'.$post["last_name"].'%';
            }
          
            if((isset($post["from_date"]) && $post["from_date"]!='') && (isset($post["to_date"]) && $post["to_date"]!='') ) {
                $conditions['StudentRegistration.created BETWEEN ? AND ?'] = array($this->General->datefordb($post["from_date"]),$this->General->datefordb($post["to_date"]));
            }
        }
		
        
       // $this->StudentRegistration->recursive = 0;
        $this->paginate = array(
            'conditions' => $conditions,
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'StudentRegistration.created DESC'
        );
		$this->set('StudentRegistration', $this->paginate('StudentRegistration'));
		
		
	}
	
	
	public function admin_add()
	{
		 $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->redirect(array('action' => 'login'));
        }
		
		 if ($this->request->is('post')) 
		{
			
				$this->StudentRegistration->set($this->request->data);
				
				
			if ($this->StudentRegistration->Validation()) 
			{
					 if ($this->StudentRegistration->Validation()) {
						
						if(isset($this->request->data['StudentRegistration']['UID_NUMBER']))
					{
						 $chk_uid = $this->StudentRegistration->find('count',array(
							'conditions'=>array('UID_NUMBER'=>$this->request->data['StudentRegistration']['UID_NUMBER'])
							  ));
						
								 if($chk_uid == 1)
									{
										$uid = '';
										
									}else{
										$uid = $this->request->data['StudentRegistration']['UID_NUMBER'];
									}
					}
					
					if(isset($this->request->data['StudentRegistration']['AADHAR_NUMBER']))
					{
						 $chk_add = $this->StudentRegistration->find('count',array(
							'conditions'=>array('AADHAR_NUMBER'=>$this->request->data['StudentRegistration']['UID_NUMBER'])
							  ));
					   
								 if($chk_add == 1)
									{
										$aid = '';
									}else{
										$aid = $this->request->data['StudentRegistration']['AADHAR_NUMBER'];
									}
					}
				
					$this->StudentRegistration->create();
					if ($this->StudentRegistration->save($this->request->data)) {
						
						$this->StudentRegistration->saveField("UID_NUMBER",$uid);
					
					    $this->StudentRegistration->saveField("AADHAR_NUMBER",$aid);
						
						
						$this->AdmissionVacancy = ClassRegistry::init('AdmissionVacancy');
						$fee = $this->AdmissionVacancy->find('first', array(
							'contain' => array(),
							'conditions' => array('CLASS_ID'=>$this->request->data['StudentRegistration']['ADM_CLASS_ID'])
						));
						
						$fee_atm = $fee['AdmissionVacancy']['FORM_FEE'];
						$this->StudentRegistration->saveField("FORM_FEE",$fee_atm);
						
						$this->request->data['StudentRegistration']['REG_DATE'] = $this->General->datefordb(date('d/m/Y'));
					
						$this->request->data['StudentRegistration']['USER_ID'] = $Session_data['ID'];
						$this->StudentRegistration->saveField("created_by",$Session_data['ID']);
						
						$ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
						$this->StudentRegistration->saveField("created_ip",$ip);
			
						$this->request->data['StudentRegistration']['DOB'] = $this->General->datefordb($this->request->data['StudentRegistration']['DOB']);
						$this->StudentRegistration->saveField("DOB",$this->request->data['StudentRegistration']['DOB']);
						
						
						$this->Session->setFlash('Student Registration Added Successfully!', 'message_good');
						$this->redirect(array('action' => 'index'));
					}
				} else {
					$this->Session->setFlash('Student Registration Not Added Please Try Again!', 'message_bad');
				}
			}
		
		}

         $classes = $this->StudentRegistration->AcademicClass->GetAcademicClasses();
        $this->set('classes', $classes);

        $bloodgroups = $this->StudentRegistration->BloodGroup->GetBloodGroups();
        $this->set('bloodgroups', $bloodgroups);

        $mediums = $this->StudentRegistration->Medium->GetMedium();
        $this->set('medium', $mediums);

        $CastCategories = $this->StudentRegistration->CastCategory->GetCastCategories();
        $this->set('CastCategories', $CastCategories);

        $country = $this->StudentRegistration->Country->GetCountries();
        $this->set('country', $country);

        $state = $this->StudentRegistration->State->GetStates();
        $this->set('state', $state);

        $cities = $this->StudentRegistration->City->GetCity();
        $this->set('cities', $cities);
		
		$group = $this->StudentRegistration->Group->GetGroup();
        $this->set('group', $group);
		
		
	}
	
	
	public function admin_delete($Id = null)
    {
        $this->layout = 'admin_form_layout';
        if (!empty($Id)) {
            try {
                if ($this->StudentRegistration->delete($Id)) {
                    $this->Session->setFlash('Student is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid Group.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
    }
	
	  public function admin_edit($id = null)
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        $this->StudentRegistration->id = $id;
        if (empty($this->StudentRegistration->id)) {
            $this->Session->setFlash('Invalid Student Registration !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		$data = $this->StudentRegistration->find('first', array(
								'contain' => array(),
								'conditions' => array('FORM_NO'=>$id)
							));
	
        if ($this->request->is('put') || $this->request->is('post')) 
		{
			
            if ($this->StudentRegistration->Validation()) {
				
				if(isset($this->request->data['StudentRegistration']['UID_NUMBER']))
					{
						 $chk_uid = $this->StudentRegistration->find('count',array(
							'conditions'=>array('UID_NUMBER'=>$this->request->data['StudentRegistration']['UID_NUMBER'])
							  ));
						
								 if($chk_uid == 1)
									{
										$uid = $data[StudentRegistration][UID_NUMBER];
										
									}else{
										$uid = $this->request->data['StudentRegistration']['UID_NUMBER'];
									}
					}
					
					if(isset($this->request->data['StudentRegistration']['AADHAR_NUMBER']))
					{
						 $chk_add = $this->StudentRegistration->find('count',array(
							'conditions'=>array('AADHAR_NUMBER'=>$this->request->data['StudentRegistration']['UID_NUMBER'])
							  ));
					   
								 if($chk_add == 1)
									{
										$aid = $data[StudentRegistration][AADHAR_NUMBER];
									}else{
										$aid = $this->request->data['StudentRegistration']['AADHAR_NUMBER'];
									}
					}
				
                if ($this->StudentRegistration->save($this->request->data)) {
					
					
					$this->StudentRegistration->saveField("UID_NUMBER",$uid);
					
					$this->StudentRegistration->saveField("AADHAR_NUMBER",$aid);
					
					$ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
					$this->StudentRegistration->saveField("created_ip",$ip);
		
					$this->request->data['StudentRegistration']['DOB'] = $this->General->datefordb($this->request->data['StudentRegistration']['DOB']);
					$this->StudentRegistration->saveField("DOB",$this->request->data['StudentRegistration']['DOB']);
					
                    $this->Session->setFlash('Student Registration Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Student Registration Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Student Registration Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $StudentRegistration = $this->StudentRegistration->find('first', array(
                'contain' => array(),
                'conditions' => array('FORM_NO'=>$id)
            ));
			
			$StudentRegistration['StudentRegistration']['DOB'] = date('d/m/Y', strtotime(str_replace('-','/',$StudentRegistration['StudentRegistration']['DOB'])));
				/*echo '<pre>';
				print_r($StudentRegistration['StudentRegistration']['ADM_CLASS_ID']);
				die;*/
            if(empty($StudentRegistration)) {
                $this->Session->setFlash('Invalid Student Registration !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
			
            $this->request->data = $StudentRegistration;
        }
		  $classes = $this->StudentRegistration->AcademicClass->GetAcademicClasses();
        $this->set('classes', $classes);

        $bloodgroups = $this->StudentRegistration->BloodGroup->GetBloodGroups();
        $this->set('bloodgroups', $bloodgroups);

        $mediums = $this->StudentRegistration->Medium->GetMedium();
        $this->set('medium', $mediums);

        $CastCategories = $this->StudentRegistration->CastCategory->GetCastCategories();
        $this->set('CastCategories', $CastCategories);

        $country = $this->StudentRegistration->Country->GetCountries();
        $this->set('country', $country);

        $state = $this->StudentRegistration->State->GetStates();
        $this->set('state', $state);

        $cities = $this->StudentRegistration->City->GetCity();
        $this->set('cities', $cities);
		
		$group = $this->StudentRegistration->Group->Get_Group_Class($StudentRegistration['StudentRegistration']['ADM_CLASS_ID']);
        $this->set('group', $group);
		
		
    }
	
	 public function admin_view($id = null)
    {
        $this->layout = 'admin_form_layout';
        $this->StudentRegistration->id = $id;

        if (empty($this->StudentRegistration->id)) {

            $this->Session->setFlash('Invalid user !', 'message_bad');
            $this->redirect(array('action' => 'index'));

        }

        $StudentRegistration = $this->StudentRegistration->read(null, $id);

        if (empty($StudentRegistration)) {
            $this->Session->setFlash('Invalid Student !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
        $this->request->data = $StudentRegistration;
		
		$this->Group = ClassRegistry::init('Group');
		$sub = $this->Group->find('all', array(
                'contain' => array(),
                'conditions' => array('CLASS_ID'=>$StudentRegistration['StudentRegistration']['ADM_CLASS_ID']),
				'fields' => array('GROUP_ID','SUBJECT_ID'),
				 'group' => 'GROUP_NAME',
				
				
            ));
		//echo $this->General->getLastQuery();
		//die;
			if(sizeof($sub)>0) {
						foreach ($sub as $key => $value)
						{	
							 $offerArray[$key] = $value['Group']['SUBJECT_ID'];
						
						} 
					
				}
				
				$che = (implode('<br>',$offerArray));
				
		///echo $che;
		//die;
				
		$this->set('sub',$che);



       $classes = $this->StudentRegistration->AcademicClass->GetAcademicClasses();
        $this->set('classes', $classes);

        $bloodgroups = $this->StudentRegistration->BloodGroup->GetBloodGroups();
        $this->set('bloodgroups', $bloodgroups);

        $mediums = $this->StudentRegistration->Medium->GetMedium();
        $this->set('medium', $mediums);

        $CastCategories = $this->StudentRegistration->CastCategory->GetCastCategories();
        $this->set('CastCategories', $CastCategories);

        $country = $this->StudentRegistration->Country->GetCountries();
        $this->set('country', $country);

        $state = $this->StudentRegistration->State->GetStates();
        $this->set('state', $state);

        $cities = $this->StudentRegistration->City->GetCity();
        $this->set('cities', $cities);
		
		$group = $this->StudentRegistration->Group->GetGroup();
        $this->set('group', $group);
		
    }
	 public function admin_interview($id = null)
    {
		
		 $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        $this->StudentRegistration->id = $id;
        if (empty($this->StudentRegistration->id)) {
            $this->Session->setFlash('Invalid Student Registration !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->StudentRegistration->Interview_Validation()) {
                if ($this->StudentRegistration->save($this->request->data)) {
					
					$this->StudentRegistration->saveField("WAITING_ID",1);
					$this->StudentRegistration->saveField("INTERVIEW_ID",1);
					$this->StudentRegistration->saveField("INTERVIEW_RESULT",$this->request->data['StudentRegistration']['INTERVIEW_RESULT']);
					
					$ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
					$this->StudentRegistration->saveField("created_ip",$ip);
					
                    $this->Session->setFlash('Student Registration Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Student Registration Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Student Registration Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $StudentRegistration = $this->StudentRegistration->find('first', array(
                'contain' => array(),
                'conditions' => array('FORM_NO'=>$id)
            ));
            if(empty($StudentRegistration)) {
                $this->Session->setFlash('Invalid Student Registration !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $StudentRegistration;
        }
		
		$round = $this->StudentRegistration->Round->GetRound();
        $this->set('Round', $round);
	}
	
	public function admin_GetGroupByClass(){
		$this->layout = 'ajax';
        $this->autoRender = false;
        //$message = '';
        //$result_array = array();
        //$status = false;
        $class_id = '';

        if(isset($this->request->data['StudentRegistration']['ADM_CLASS_ID'])) {
            $class_id = $this->request->data['StudentRegistration']['ADM_CLASS_ID'];
        }
   
		$this->Group = ClassRegistry::init('Group');
        $GroupByClass =$this->Group->find('all', array(
            'conditions' => array('Group.CLASS_ID'=>$class_id), 
			//'fields' => array('DISTINCT Group.GROUP_NAME','Group.GROUP_ID'),
			 'group' => 'GROUP_NAME', 
        ));

            if(sizeof($GroupByClass)>0) {
            
                foreach($GroupByClass as $k=>$value) {
                   echo '<option value="'.$value["Group"]["GROUP_ID"].'">'.$value["Group"]["GROUP_NAME"].'</option>';
                }
				die;
				
            }
    
	}
	
	 public function admin_download($id = null)
    {
		$this->Uploaddocument = ClassRegistry::init('Uploaddocument');
		
		$Uploaddocument = $this->Uploaddocument->find('first', array(
                'contain' => array(),
                'conditions' => array('INQUIRY_ID'=>$id)
            ));
		$doc =  $Uploaddocument['Uploaddocument']['DOC_NAME'];
		
		$abc =  SITE_URL . 'files/student_document'.'/'.$doc;
		$this->redirect($abc);
		//die;
		
	}
	
	public function admin_interviewlist () {
		
		
		 $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
	 $res =$this->StudentRegistration->find('all', array(
        ));
		$this->set('StudentRegistration',$res);
	}
	
	public function admin_getsubject () {

        if ($this->request->is('post') || $this->request->is('ajax')) {
            $Session_data = $this->Session->read('Auth.Admin');
            $this->autoRender = false;
            $this->layout = 'ajax';
            $this->Group = ClassRegistry::init('Group');
            $users = array();
            $conditions = array();
			 $gname =$this->Group->find('first', array(
            'conditions' => array('Group.GROUP_ID'=>$this->request->data["StudentRegistration"]["GROUP"]), 
			'fields' => array('Group.GROUP_NAME','Group.GROUP_ID'),     
        ));
		 $abc = $gname['Group']['GROUP_NAME'];	

            $conditions['Group.GROUP_Name'] = $abc;

            $gro =$this->Group->find('all',array(
                'conditions'=>$conditions,
            ));
			 
            $return = array();
            if(sizeof($gro)>0) {
                $return['status'] = "success";
                $html = '<ul>';
                foreach($gro as $k=>$value) {
					$this->Subject = ClassRegistry::init('Subject');
					$sub = $this->Subject->find('first', array(
            'conditions' => array('Subject.SUBJECT_ID'=>$value["Group"]["SUBJECT_ID"]), 
			'fields' => array('Subject.TITLE'),     
        ));
					
                    $html.='<li>'.$sub["Subject"]["TITLE"].'</li>';
                }
                $html.='</ul>';
                $return['lists'] = $html;
            }else{
                $return['status'] = "failed";
            }
            echo json_encode($return);die;
        }
    }
	
	public function admin_fee() 
	{
		$this->layout = 'admin_form_layout';
		 
	 if(isset($this->params->query["data"]["User"]) && is_array($this->params->query["data"]["User"])) {
            $post = $this->params->query["data"]["User"];
           
            if((isset($post["from_date"]) && $post["from_date"]!='') && (isset($post["to_date"]) && $post["to_date"]!='') ) {
                $conditions['StudentRegistration.REG_DATE BETWEEN ? AND ?'] = array($this->General->datefordb($post["from_date"]),$this->General->datefordb($post["to_date"]));
            }
        }
			
			$std_reg =  $res =$this->StudentRegistration->find('all', array(
        				'conditions' => $conditions,
						));
        
		$this->set('fee',$std_reg);
		
	}



      public function admin_chkuid(){
         $uno = $this->request->data["id"];
   
         $chk_uid = $this->StudentRegistration->find('count',array(
            'conditions'=>array('UID_NUMBER'=>$uno)
              ));
       
         
         if($chk_uid == 1)
            {
                ?>
                <script>
                alert('Unique Identification Number is Already Exists');
                </script>
                
            <?php   
            }else{
                
            }
        die;
        
    }


   public function admin_edt_chkuid(){
         $grno = $this->request->data["id"];
         $user_id = $this->request->data["uid"];
         
         $chk_uid = $this->StudentRegistration->find('count',array(
            'conditions'=>array('UID_NUMBER'=>$grno,'StudentRegistration.FORM_NO !='=>$user_id)
              ));
         
         if($chk_uid == 1)
            {
                ?>
                <script>
                  alert('Unique Identification Number is Already Exists');
                </script>
                
            <?php   
            }else{
                
            }
        die;
        
    }

     public function admin_edt_addh(){
         $grno = $this->request->data["id"];
         $user_id = $this->request->data["uid"];
         
         $chk_uid = $this->StudentRegistration->find('count',array(
            'conditions'=>array('AADHAR_NUMBER'=>$grno,'StudentRegistration.FORM_NO !='=>$user_id)
              ));
         
         if($chk_uid == 1)
            {
                ?>
                <script>
                  alert('Aadhar Card Number is Already Exists');
                </script>
                
            <?php   
            }else{
                
            }
        die;
        
    }

     public function admin_addh(){
         $uno = $this->request->data["id"];
   
         $chk_uid = $this->StudentRegistration->find('count',array(
            'conditions'=>array('AADHAR_NUMBER'=>$uno)
              ));
       
         
         if($chk_uid == 1)
            {
                ?>
                <script>
                  alert('Aadhar Card Number is Already Exists');
               
                </script>
                
            <?php   
            }else{
                
            }
        die;
        
    }

}
?>