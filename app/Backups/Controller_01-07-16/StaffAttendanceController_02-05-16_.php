<?php
// app/Controller/UsersController.php
class StaffAttendanceController extends AppController
{
    var $name = 'StaffAttendance';

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

    $Session = $this->Session->read('Auth.Admin');
       
        
        $this->layout = 'admin_form_layout';
        $this->paginate = array(
            'conditions' => '',
            'Contain' => array(''),
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'StaffAttendance.created DESC'
        );

        $this->set('StaffAttendance', $this->paginate('StaffAttendance'));
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

       
            $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');


        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('post')) {

           $this->StaffAttendance->set($this->request->data);
         
        

              //  $this->TeacherTimeTable->create();
                
                if ($this->request->data) {
                    
                    $list = $this->request->data['selected_users'];
                    
                    $id = $this->request->data['id'];

                    $role =  $this->request->data['role']; 

                     
                  
                    $this->request->data['StudentRegistration']['USER_ID'] = $Session_data['ID'];
                    
                    $ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
                   

                      foreach($list as $key => $stid)
                        {
                            $status = $stid;
                                foreach($id as $uid)
                                {
                                   
                                    $user_id= $id[$key];
                                }

                                foreach($role as $rid)
                                {
                                   
                                    $role_id= $role[$key];
                                }
                                
                         
                             $ttdata['StaffAttendance'] = array(
                                        'STATUS'=>$status,
                                        'ATTENDANCE_DATE'=>$this->General->datefordb(date("d-m-Y")),
                                        'ROLE_ID'=>$role_id,
                                        'USER_ID'=>$user_id,
                                        'created_by' => $Session_data['ID'],
                                        'created_ip' => $ip,

                                    );

                                 $this->StaffAttendance->create();
                                 $this->StaffAttendance->save($ttdata);
                       
                           
                        }
                    
                    $this->Session->setFlash('Staff Attendance Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                
            } else
            {
                $this->Session->setFlash('Staff Attendance Not Added Please Try Again!', 'message_bad');
            }
        }
        
       $this->User = ClassRegistry::init('User');

       // $conditions = array('ROLE_ID !='=>5)

        $us = $this->User->find('all',array(
            'Contain' => array(),
            'conditions' =>array('ROLE_ID !='=>5),
        ));
        $this->set('users', $us);

        



        /*$this->layout = 'admin_form_layout';

        if ($this->request->is('post')) {
            $this->StaffAttendance->set($this->request->data);
                $this->StaffAttendance->create();
                if ($this->StaffAttendance->save($this->request->data)) {

                     $st = $this->request->data['selected_users'];
                    

                    foreach ($st as $value) {

                        $rec[] = explode('.',$value );

                    }

                    
                  foreach ($rec as $data) {
                            /*PR($data[0]);
                            PR($data[1]);
                         
                         $this->StaffAttendance->saveField("USER_ID",$data[1]);
                         $this->StaffAttendance->saveField("STATUS",$data[0]);
                        
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