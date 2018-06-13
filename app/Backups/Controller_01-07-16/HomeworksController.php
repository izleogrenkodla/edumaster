<?php
// app/Controller/UsersController.php
class HomeworksController extends AppController
{ 
    var $name = 'Homeworks';

    public function beforeFilter()
    {
        parent::beforeFilter();
$this->Auth->allow('App_AddHomework','App_HomeWorkList','App_HomeWorkAttendByStudent','App_StudentActionOnHomework','App_TeacherActionOnHomework','App_HomeWorkNotAttendByStudent');
        
        if(isset($this->Security) &&  ($this->RequestHandler->isAjax() || $this->RequestHandler->isPost())){
            $this->Security->validatePost = false;
            $this->Security->enabled = false;
            $this->Security->csrfCheck = false;
        }
    }
    
     public function admin_index()
    {
        $this->layout = 'admin_form_layout';

        $Session = $this->Session->read('Auth.Admin');
$conditions = array();
		switch($Session["ROLE_ID"]) { 
			case TEACHER_ID:
                $conditions = array(
                    'TEACHER_ID' => $Session['ID'],
                );
			break;
			case STUDENT_ID:
                $conditions = array(
                    'Homework.CLASS_ID' => $Session['CLASS_ID'],
                );
			break;
		}

        $this->paginate = array(
            'conditions' => $conditions,
            //'contain' => array('User'),
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'Homework.HW_ID DESC'
        );

        $this->set('homeworks', $this->paginate('Homework'));

    }


     public function admin_add()
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('post')) {

            $date = $this->General->datefordb($this->request->data['Homework']['DATE']);
            $submissionDate = $this->General->datefordb($this->request->data['Homework']['SUBMISSION_DATE']);
				
            $this->request->data['Homework']['DATE'] = $date;
            $this->request->data['Homework']['SUBMISSION_DATE'] = $submissionDate;
            $this->request->data['Homework']['TEACHER_ID'] = $Session_data['ID'];

            $this->Homework->set($this->request->data);

            if ($this->Homework->Validation()) {
                $this->Homework->create();

                if ($this->Homework->save($this->request->data)) {
					$st_lists = $this->Homework->User->find("all",array('fields'=>array("FIRST_NAME","LAST_NAME","MIDDLE_NAME","EMAIL_ID"),"conditions"=>array("User.ROLE_ID"=>STUDENT_ID,"User.CLASS_ID"=>$Session_data["CLASS_ID"])));
					if(is_array($st_lists) && sizeof($st_lists)) { 
						foreach($st_lists as $list) { 
							$full_name = $list["User"]["FIRST_NAME"].' '.$list["User"]["MIDDLE_NAME"].' '.$list["User"]["LAST_NAME"];
			
						   $notification = array(
									'STUDENT_NAME'=>$full_name,
									'HW_MESSAGE'=>$this->request->data["Homework"]["DESCRIPTION"],
									'EMAIL_ID'=>$list["User"]["EMAIL_ID"],
									'HW_SUBMISSION_DATE'=>$this->General->dbfordate($this->request->data['Homework']['SUBMISSION_DATE']),
								);
							$this->send_new_mail_to_student($notification);
						}	
					}
                    $this->Session->setFlash('Homework Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
            } else {
                $this->Session->setFlash('Homework Not Added Please Try Again!', 'message_bad');
            }
        }

        $subjects = $this->Homework->Subject->GetSubjects();
        $this->set('subjects',$subjects);

        $class = $this->Homework->AcademicClass->GetAcademicClasses();
        $this->set('classes',$class);

    }


    public function admin_edit($id = null)
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        $this->Homework->id = $id;

        if (empty($this->Homework->id)) {
            $this->Session->setFlash('Invalid Homework !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->Homework->Validation()) {

                if ($this->Homework->save($this->request->data)) {

                    $this->HomeworkXref = ClassRegistry::init('HomeworkXref');
                    $this->request->data['HomeworkXref']['HW_ID'] = $id;
                    $this->request->data['HomeworkXref']['STUDENT_ID'] = $Session_data['ID'];
                  //  $this->request->data['HomeworkXref']['STATUS'] = $this->request->data['Homework']['STATUS'];

                    $this->HomeworkXref->save($this->request->data['HomeworkXref']);

                    $this->Session->setFlash('Homework Updated Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Homework Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Homework Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $Content = $this->Homework->find('first', array(
                'contain' => array(),
                'conditions' => array('HW_ID' => $id)
            ));
            if(empty($Content)) {
                $this->Session->setFlash('Invalid Homework !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $Content;
        }

        $subjects = $this->Homework->Subject->GetSubjects();
        $this->set('subjects',$subjects);

        $class = $this->Homework->AcademicClass->GetAcademicClasses();
        $this->set('classes',$class);
    }
   	public function send_mail_to_student($post=array()) {
        $mailing_list = $post['EMAIL_ID'];
        $mg_api = 'key-74be9f4872781161d12408795f411673';
        $mg_version = 'api.mailgun.net/v2/';
        $mg_domain = "sandbox0b14f0410b2a4555920843d785a10b10.mailgun.org";
        $mg_from_email = ADMIN_EMAIL;
        $mg_reply_to_email = ADMIN_EMAIL;
        $mg_message_url = "https://".$mg_version.$mg_domain."/messages";


        $message = '<div align="center">
                          <table cellspacing="5" cellpadding="5" border="0" width="600" style="background: none repeat scroll 0% 0% rgb(244, 244, 244); border: 1px solid rgb(102, 102, 102);">
                            <tbody>
                              <tr>
                                <th style="background-color: rgb(204, 204, 204);">Welcome to [WEBSITE_NAME]</th>
                              </tr>
                              <tr>
                                <td valign="top" style="text-align: left;">
                                   <br />
                                   Hello <strong>[STUDENT_NAME] </strong>,<br />
                                   <br />
                                   Your home work has been reviewed by teacher.<br />
                                    <br /><hr /><br />
									HW Message: [HW_MESSAGE]
                                    <br /><hr /><br />
									Status: [TEACHER_STATUS]
                                    <br /><hr /><br />
                                   </td>
                              </tr>
                              <tr>
                                <td style="text-align: left;"><em>Thanks,<br />
                                     [WEBSITE_NAME]<br />
                                     <a href="[URL]">[URL]</a></em></td>
                              </tr>
                            </tbody>
                          </table></div>';

        $body = str_replace(
            array('[STUDENT_NAME]','[HW_MESSAGE]','[TEACHER_STATUS]', '[URL]', '[WEBSITE_NAME]'),
            array($post['STUDENT_NAME'],$post['HW_MESSAGE'],$post['TEACHER_STATUS'],SITE_URL, WEBSITE_NAME), $message);
			

        $subject = 'Home work has been reviewed by teacher ';

        $postArr = array(
            'from'      => WEBSITE_NAME.' <' . $mg_from_email . '>',
            'to'        => $post['EMAIL_ID'],
            'h:Reply-To'=>  ' <' . $mg_reply_to_email . '>',
            'subject'   => $subject,
            'html'      => $body,
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

        curl_setopt ($ch, CURLOPT_MAXREDIRS, 3);
        curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, false);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_VERBOSE, 0);
        curl_setopt ($ch, CURLOPT_HEADER, 1);
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);

        curl_setopt($ch, CURLOPT_USERPWD, 'api:' . $mg_api);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: multipart/form-data"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($ch, CURLOPT_POST, true);
        //curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_HEADER, false);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_URL, $mg_message_url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postArr);
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result,TRUE);


    }// end of mail
public function send_new_mail_to_student($post=array()) {
        $mailing_list = $post['EMAIL_ID'];
        $mg_api = 'key-74be9f4872781161d12408795f411673';
        $mg_version = 'api.mailgun.net/v2/';
        $mg_domain = "sandbox0b14f0410b2a4555920843d785a10b10.mailgun.org";
        $mg_from_email = ADMIN_EMAIL;
        $mg_reply_to_email = ADMIN_EMAIL;
        $mg_message_url = "https://".$mg_version.$mg_domain."/messages";


        $message = '<div align="center">
                          <table cellspacing="5" cellpadding="5" border="0" width="600" style="background: none repeat scroll 0% 0% rgb(244, 244, 244); border: 1px solid rgb(102, 102, 102);">
                            <tbody>
                              <tr>
                                <th style="background-color: rgb(204, 204, 204);">Welcome to [WEBSITE_NAME]</th>
                              </tr>
                              <tr>
                                <td valign="top" style="text-align: left;">
                                   <br />
                                   Hello <strong>[STUDENT_NAME] </strong>,<br />
                                   <br />
                                   You have assigned Homework by teacher.<br />
                                    <br /><hr /><br />
									Homework : [HW_MESSAGE]
                                    <br /><hr /><br />
									Submission Date: [HW_SUBMISSION_DATE]
                                    <br /><hr /><br />
                                   </td>
                              </tr>
                              <tr>
                                <td style="text-align: left;"><em>Thanks,<br />
                                     [WEBSITE_NAME]<br />
                                     <a href="[URL]">[URL]</a></em></td>
                              </tr>
                            </tbody>
                          </table></div>';

        $body = str_replace(
            array('[STUDENT_NAME]','[HW_MESSAGE]','[HW_SUBMISSION_DATE]', '[URL]', '[WEBSITE_NAME]'),
            array($post['STUDENT_NAME'],$post['HW_MESSAGE'],$post['HW_SUBMISSION_DATE'],SITE_URL, WEBSITE_NAME), $message);
			

        $subject = 'You have assigned new work by teacher ';

        $postArr = array(
            'from'      => WEBSITE_NAME.' <' . $mg_from_email . '>',
            'to'        => $post['EMAIL_ID'],
            'h:Reply-To'=>  ' <' . $mg_reply_to_email . '>',
            'subject'   => $subject,
            'html'      => $body,
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

        curl_setopt ($ch, CURLOPT_MAXREDIRS, 3);
        curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, false);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_VERBOSE, 0);
        curl_setopt ($ch, CURLOPT_HEADER, 1);
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);

        curl_setopt($ch, CURLOPT_USERPWD, 'api:' . $mg_api);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: multipart/form-data"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($ch, CURLOPT_POST, true);
        //curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_HEADER, false);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_URL, $mg_message_url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postArr);
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result,TRUE);


    }// end of mail
    public function admin_updateHomework() {
        $id = isset($this->params['pass'][0])?$this->params['pass'][0]:0;
        $sts = 1;
        if($id>0) {
            $Session_data = $this->Session->read('Auth.Admin');
            $this->HomeworkXref = ClassRegistry::init('HomeworkXref');
            $row = $this->HomeworkXref->find('first',
                array(
                    'fields'=>array("HomeworkXref.HW_ID","HomeworkXref.ID"),
				    'conditions'=>array(
                        'HomeworkXref.HW_ID'=>$id,
                        'HomeworkXref.STUDENT_ID'=>$Session_data["ID"],
                    )
                )
            );

            if(sizeof($row)==0) {
                $this->HomeworkXref->save(array("HomeworkXref"=>array("HW_ID"=>$id,'STUDENT_ID'=>$Session_data["ID"],'STUDENT_STATUS'=>$sts)));
            }
            if(sizeof($row)==1) {
                $this->HomeworkXref->id =$row["HomeworkXref"]["ID"];
                $this->HomeworkXref->save(array("HomeworkXref"=>array("HW_ID"=>$id,'STUDENT_ID'=>$Session_data["ID"],'STUDENT_STATUS'=>$sts,'TEACHER_STATUS'=>0)));
            }

            $this->Session->setFlash('Updated Successfuly', 'message_good');
            $this->redirect(array('action' => 'index'));

        }else{
            $this->Session->setFlash('Invalid requset !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }
    
   public function admin_view($id = null)
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        $lists = $this->Homework->find('first',array(
            'contain'=>array("HomeworkXref"=>array("User"),"AcademicClass",'Subject','User'),
            'conditions'=>array("Homework.HW_ID"=>$id),
        ));

        if ($this->request->is('put') || $this->request->is('post')) {
            $this->HomeworkXref = ClassRegistry::init('HomeworkXref');
			if(is_array($this->request->data["Homework"]) && sizeof($this->request->data["Homework"])) { 

				foreach($this->request->data["Homework"] as $key=>$list) {
				   $this->HomeworkXref->id =$key;
				   $array["COMMENT"] = $list["COMMENT"];
					   if(isset($list["TEACHER_STATUS"])) { 
							$array["TEACHER_STATUS"]=1;
					   }

					   $array["STUDENT_STATUS"] = (isset($list["TEACHER_STATUS"]) && $list["TEACHER_STATUS"]==1)?1:0;
					   $notification = array(
							'STUDENT_NAME'=>$list["STUDENT_NAME"],
							'HW_MESSAGE'=>$list["COMMENT"],
							'EMAIL_ID'=>$list["EMAIL_ID"],
							'FROM_ROLE_ID'=>$Session_data['ROLE_ID'],
							'TEACHER_STATUS'=>$list["TEACHER_STATUS"]==1?"Done":"Not Done",
							
						);

					   $this->send_mail_to_student($notification);

					   $this->HomeworkXref->save(array("HomeworkXref"=>$array));
				   }
			}
            $this->redirect(array("action"=>"index"));
        }

		$this->set('lists',$lists);
    }
    
    
    public function admin_delete($Id = null)
    {
        $TeacherTimeTable = $this->TeacherTimeTable->find('first', array(
            'contain' => array(),
            'conditions' => array('TT_ID' => $Id)
        ));

        $this->layout = 'admin_form_layout';
        if (!empty($Id)) {
				$this->TeacherTimeTable->id = $Id;
            try {
                if ($this->TeacherTimeTable->saveField('STATUS',0)) {
                    $this->Session->setFlash('Teacher Time Table is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid Event.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
    }
    
  public function App_AddHomework()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;

        if(!empty($this->request->data))
        {
            $this->Homework->create();
            foreach($this->request->data as $key=>$fields)
            {
                $this->request->data['Homework'][$key] = $fields;
                $this->Homework->save($this->request->data);
            }
            $message = 'Your Homework has been sent assigned to student';
            $status = true;
        }
        else
        {
            $message = 'Opps something wrong!';
            $status = false;
        }

        $result_array = array(
            'status' => $status,
            'message' => $message
        );

        echo json_encode($result_array); die;

    }
    
    public function App_HomeWorkList()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;

        $roleID = $this->request->data['ROLE_ID'];
        $date = $this->request->data['DATE'];

        $conditions = array();
        $TempData = array();

        if($roleID == TEACHER_ID)
        {
            $teacherID = $this->request->data['TEACHER_ID'];
            $conditions = array('TEACHER_ID' => $teacherID, 'DATE' => $date);

            $TempData = $this->Homework->find('all', array(
                'contain' => array('User','Subject','AcademicClass'),
                'conditions' => $conditions
            ));
        }
        elseif($roleID == STUDENT_ID)
        {
            $class = $this->request->data['CLASS_ID'];
            $studentID = $this->request->data['STUDENT_ID'];
            $conditions = array('Homework.CLASS_ID' => $class, 'DATE' => $date);

            $TempData = $this->Homework->find('all', array(
                'contain' => array('User','Subject','AcademicClass','HomeworkXref'=>array('conditions'=>array('STUDENT_ID'=> $studentID))),
                'conditions' => $conditions
            ));
        }

        if(!empty($TempData))
        {
            $status = true;
            $message = 'Found Home work which is assigned by you';
        }
        else
        {
            $status = false;
            $message = 'No data Available';
        }

        $response = array(
            'status' => $status,
            'message' => $message,
            'data' => $TempData
        );

        echo json_encode($response); die;
    }
    
    public function App_HomeWorkAttendByStudent()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;

        $HomeworkID = $this->request->data['HW_ID'];

        $conditions = array();

        $conditions = array('HW_ID' => $HomeworkID);

        if(!empty($HomeworkID))
        {
            $this->HomeworkXref = ClassRegistry::init('HomeworkXref');

            $TempData = $this->HomeworkXref->find('all', array(
                'contain' => array('User'),
                'conditions' => $conditions
            ));

            if(!empty($TempData))
            {
                $status = true;
                $message = 'Student has been Replied on this Homework';
            }
            else
            {
                $status = false;
                $message = 'No data Available';
            }

            $response = array(
                'status' => $status,
                'message' => $message,
                'data' => $TempData
            );

            echo json_encode($response); die;
        }
        else
        {
            $status = false;
            $message = 'No data Available';

            $response = array(
                'status' => $status,
                'message' => $message,
            );

            echo json_encode($response); die;
        }

    }
    
    public function App_StudentActionOnHomework()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;

        $conditions = array();

        if(!empty($this->request->data))
        {
            $HomeworkID = $this->request->data['HW_ID'];
            $studentID = $this->request->data['STUDENT_ID'];

            $conditions = array('HW_ID' => $HomeworkID, 'STUDENT_ID' => $studentID);

            $this->HomeworkXref = ClassRegistry::init('HomeworkXref');

            $TempData = $this->HomeworkXref->find('first', array(
                'contain' => array('User'),
                'conditions' => $conditions
            ));

            if(empty($TempData))
            {
                $this->HomeworkXref ->create();
                foreach($this->request->data as $key=>$fields)
                {
                    $this->request->data['HomeworkXref'][$key] = $fields;
                    $this->HomeworkXref->save($this->request->data);
                }

                $message = "You've successfully submitted your homework";
                $status = true;
            }
            else
            {
                $this->HomeworkXref->id = $TempData['HomeworkXref']['ID'];

                $this->HomeworkXref->saveField("STUDENT_STATUS",1);
                $this->HomeworkXref->saveField("TEACHER_STATUS",0);

                $message = "You've successfully respond to this homework";
                $status = true;
            }

        }
        else
        {
            $message = 'Opps something wrong!';
            $status = false;
        }

        $result_array = array(
            'status' => $status,
            'message' => $message
        );

        echo json_encode($result_array); die;

    }

    public function App_TeacherActionOnHomework()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;

        $conditions = array();

        if(!empty($this->request->data))
        {
            $Status= $this->request->data['STATUS'];
            $HomeworkID = $this->request->data['HW_ID'];
            $studentID = $this->request->data['STUDENT_ID'];
            $comment = $this->request->data['COMMENT'];

            $conditions = array('HW_ID' => $HomeworkID, 'STUDENT_ID' => $studentID);

            $this->HomeworkXref = ClassRegistry::init('HomeworkXref');
            
            $TempData = $this->HomeworkXref->find('first', array(
                'contain' => array('User'),
                'conditions' => $conditions
            ));

            $this->HomeworkXref->id = $TempData['HomeworkXref']['ID'];

            if($Status == 'Yes')
            {
                $this->HomeworkXref->saveField("STUDENT_STATUS",1);
                $this->HomeworkXref->saveField("TEACHER_STATUS",1);
                $this->HomeworkXref->saveField("COMMENT",$comment);
            }
            elseif($Status == 'No')
            {
                $this->HomeworkXref->saveField("STUDENT_STATUS",0);
                $this->HomeworkXref->saveField("TEACHER_STATUS",1);
                $this->HomeworkXref->saveField("COMMENT",$comment);
            }

            $message = "You've successfully respond to this homework";
            $status = true;

        }
        else
        {
            $message = 'Opps something wrong!';
            $status = false;
        }

        $result_array = array(
            'status' => $status,
            'message' => $message
        );

        echo json_encode($result_array); die;

    }
    
    public function App_HomeWorkNotAttendByStudent()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;

        $HomeworkID = $this->request->data['HW_ID'];

        $conditions = array();

        $conditions = array('HW_ID' => $HomeworkID);

        $ClassData = $this->Homework->find('first', array(
            'fields' => array('CLASS_ID'),
            'conditions' => $conditions
        ));

        $classId = $ClassData['Homework']['CLASS_ID'];

        $this->User = ClassRegistry::init('User');

        $UserTempData = $this->User->query('SELECT USER.ID,USER.FIRST_NAME,USER.MIDDLE_NAME,USER.LAST_NAME FROM `users` as USER LEFT JOIN homework_xref as HWXREF ON USER.ID = HWXREF.STUDENT_ID WHERE HWXREF.STUDENT_ID IS NULL AND USER.ROLE_ID = '.STUDENT_ID.' AND USER.CLASS_ID = '.$classId.'');

        if(!empty($UserTempData))
        {
            $status = true;
            $message = 'Student has not Replied on this Homework';

           $UserTempData = Set::extract('/USER/.', $UserTempData);

            $response = array(
                'status' => $status,
                'message' => $message,
                'data' => $UserTempData
            );

            echo json_encode($response); die;
        }
        else
        {
            $status = false;
            $message = 'No data Available';

            $response = array(
                'status' => $status,
                'message' => $message,
            );

            echo json_encode($response); die;
        }

    }
 
}