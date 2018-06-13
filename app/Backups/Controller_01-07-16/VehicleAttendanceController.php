<?php
// app/Controller/UsersController.php
class VehicleAttendanceController extends AppController
{
    var $name = 'VehicleAttendance';

    public function beforeFilter()
    {
        parent::beforeFilter();

        $this->Auth->allow();

        if(isset($this->Security) &&  ($this->RequestHandler->isAjax() || $this->RequestHandler->isPost())){
            $this->Security->validatePost = false;
            $this->Security->enabled = false;
            $this->Security->csrfCheck = false;
        }
    }
    
    public function admin_index()
    {
		
	$conditions = array();
	$this->loadModel('Vehicle');
	$vehicle = $this->Vehicle->GetVehicle();
    $Session = $this->Session->read('Auth.Admin');
       
    $this->layout = 'admin_form_layout';
         
     if(isset($this->request->data["VehicleAttendance"]["VEHICLE_ID"]) && ($this->request->data["VehicleAttendance"]["VEHICLE_ID"])>0  && (isset($this->request->data["VehicleAttendance"]["FromDate"]) && isset($this->request->data["VehicleAttendance"]["ToDate"]))){
			
			
			$VehicleAttendance =$this->request->data["VehicleAttendance"]["VEHICLE_ID"];
			$conditions = array('VehicleAttendance.VEHICLE_ID ' => $VehicleAttendance);		
			$conditions['VehicleAttendance.ATTENDENCE_DATE BETWEEN ? AND ?'] = array($this->General->datefordb($this->request->data["VehicleAttendance"]["FromDate"]),$this->General->datefordb($this->request->data["VehicleAttendance"]["ToDate"]));
		
			}
     elseif(isset($this->request->data["VehicleAttendance"]["VEHICLE_ID"]) && ($this->request->data["VehicleAttendance"]["VEHICLE_ID"])>0 )
		{
			
			$VehicleAttendance =$this->request->data["VehicleAttendance"]["VEHICLE_ID"];
			$conditions = array('VehicleAttendance.VEHICLE_ID ' => $VehicleAttendance);		
			// PR($conditions);
			// die;
		}
    elseif(
		(isset($this->request->data["VehicleAttendance"]["FromDate"])) && (isset($this->request->data["VehicleAttendance"]["ToDate"])) ) {
		
					$conditions['VehicleAttendance.ATTENDENCE_DATE BETWEEN ? AND ?'] = array($this->General->datefordb($this->request->data["VehicleAttendance"]["FromDate"]),$this->General->datefordb($this->request->data["VehicleAttendance"]["ToDate"]));
				}
	
        
        $this->layout = 'admin_form_layout';
        $this->paginate = array(
            'conditions' => $conditions,
            'Contain' => array(''),
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'VehicleAttendance.created DESC'
        );
		
		// PR($this->paginate('VehicleAttendance'));
		// die;
        $this->set('VehicleAttendance', $this->paginate('VehicleAttendance'));
        $this->set('vehicle',$vehicle);
        
        
    }

   /* public function admin_add(){

        
        
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
         
         $this->set('users', $students);
         
        
         
        $roles = $this->User->Role->GetRoles();
        $this->set('user_roles', $roles);
        
        $classes = $this->User->AcademicClass->GetAcademicClasses();
        $this->set('classes', $classes);
    }*/


     public function admin_add(){
		$this->loadModel('VehicleRouteFee');
        $us = $this->VehicleRouteFee->find('all',array(
            'Contain' => array(),
            'conditions' =>array(),
        ));
        
        $this->set('users', $us);
            $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');


        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('post')) {

           $this->VehicleAttendance->set($this->request->data);
         
        

              //  $this->TeacherTimeTable->create();
                
                if ($this->request->data) {
                     if ($this->VehicleAttendance->Validation()) {
                  
                    $list = $this->request->data['selected_users'];
                    
                    $id = $this->request->data['id'];
                    $vid = $this->request->data['vid'];
					
                   

                     
					$vid = $this->request->data['vid'];
                    $this->request->data['VehicleAttendance']['USER_ID'] = $Session_data['ID'];
                    
                    $ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
                   

                      foreach($list as $key => $stid)
                        {
                            $status = $stid;
                                foreach($id as $uid)
                                {
                                   
                                    $user_id= $id[$key];
                                }

                                foreach($vid as $vvid)
                                {
                                   
                                    $vvvid= $vid[$key];
									
                                }
                            
                         
                             $ttdata['VehicleAttendance'] = array(
                                        'STATUS'=>$status,
                                        'ATTENDENCE_DATE'=>$this->General->datefordb($this->request->data['VehicleAttendance']['ATTENDANCE_DATE']),
                                        'USER_ID'=>$user_id,
                                        'VEHICLE_ID'=>$vvvid,
                                        'created_by' => $Session_data['ID'],
                                        'created_ip' => $ip,

                                    );
								// PR($ttdata);
								// die;
                                 $this->VehicleAttendance->create();
                                 $this->VehicleAttendance->save($ttdata);
                       
                           
                        }
                   
                    $this->Session->setFlash('Staff Attendance Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                 }
            } else
            {
                $this->Session->setFlash('Staff Attendance Not Added Please Try Again!', 'message_bad');
            }
        }
        
       $this->User = ClassRegistry::init('User');

       // $conditions = array('ROLE_ID !='=>5)

       $us = $this->VehicleRouteFee->find('all',array(
            'Contain' => array(),
            'conditions' =>array(),
        ));
		// PR($us);
        // die;
        $this->set('users', $us);

        



        /*$this->layout = 'admin_form_layout';

        if ($this->request->is('post')) {
            $this->VehicleAttendance->set($this->request->data);
                $this->VehicleAttendance->create();
                if ($this->VehicleAttendance->save($this->request->data)) {

                     $st = $this->request->data['selected_users'];
                    

                    foreach ($st as $value) {

                        $rec[] = explode('.',$value );

                    }

                    
                  foreach ($rec as $data) {
                            /*PR($data[0]);
                            PR($data[1]);
                         
                         $this->VehicleAttendance->saveField("USER_ID",$data[1]);
                         $this->VehicleAttendance->saveField("STATUS",$data[0]);
                        
                    }
                    echo $this->General->getLastQuery();
        die;

                     die;   
                    $this->Session->setFlash('Attendance Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
               
                } else {
                $this->Session->setFlash('Attendance Not Added Please Try Again!', 'message_bad');
                }
        
        




      }*/ 
     }
    

}