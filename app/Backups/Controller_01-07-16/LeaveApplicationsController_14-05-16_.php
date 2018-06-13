<?php
// app/Controller/UsersController.php
class LeaveApplicationsController extends AppController
{
    var $name = 'LeaveApplications';

    public function beforeFilter()
    {
        parent::beforeFilter();

        $this->Auth->allow('App_ApplyForLeave','App_LeaveRecords','App_ViewLeaveData','App_PendingLeaveApplicationOfStudent','App_LeaveApplicationUpdate');

        if(isset($this->Security) &&  ($this->RequestHandler->isAjax() || $this->RequestHandler->isPost())){
            $this->Security->validatePost = false;
            $this->Security->enabled = false;
            $this->Security->csrfCheck = false;
        }
    }

    public function leave_request_mail($post=array()) {
        $mailing_list = $post['EMAIL_ID'];
        $mg_api = 'key-74be9f4872781161d12408795f411673';
        $mg_version = 'api.mailgun.net/v2/';
        $mg_domain = "sandbox0b14f0410b2a4555920843d785a10b10.mailgun.org";
        $mg_from_email = ADMIN_EMAIL;
        $mg_reply_to_email = ADMIN_EMAIL;
        $mg_message_url = "https://".$mg_version.$mg_domain."/messages";

        $this->Roles = ClassRegistry::init('Role');

        $roles = $this->Roles->GetRoles();

        $role_name = '';
        if(isset($post['FROM_ROLE_ID']) && $post['FROM_ROLE_ID']>0) {
            $from_role_name = $roles[$post['FROM_ROLE_ID']];
        }

        /////////////////////////////////////

        $message = '<div align="center">
                          <table cellspacing="5" cellpadding="5" border="0" width="600" style="background: none repeat scroll 0% 0% rgb(244, 244, 244); border: 1px solid rgb(102, 102, 102);">
                            <tbody>
                              <tr>
                                <th style="background-color: rgb(204, 204, 204);">Leave Request.</th>
                              </tr>
                              <tr>
                                <td valign="top" style="text-align: left;">
                                   <br />
                                   Hello <strong>[FULL_NAME]</strong>,<br />
                                   <br />
                                   [REASON]
								   <br />
                                   <br />
                                   From Date: [FROM_DATE] |  Till Date: [TO_DATE]
                                    <br />
									<br />
                                    Requested Role:'.$from_role_name.'
                                    <br />
                                    				<br />
                                    Request By:[FROM_NAME]

                                    <br />
						<br />
                                    Class Name:[FROM_CLASS_NAME]

                                    <br />			<br />
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
            array('[FULL_NAME]','[FROM_DATE]','[TO_DATE]','[REASON]','[FROM_NAME]','[FROM_CLASS_NAME]', '[URL]', '[WEBSITE_NAME]','[FROM_ROLE_NAME]'),
            array($post['FULL_NAME'],$post['FROM_DATE'],$post['TO_DATE'],$post['REASON'],$post['FROM_NAME'],$post['FROM_CLASS_NAME'],SITE_URL, WEBSITE_NAME,$from_role_name), $message);


        $subject = 'New Leave Request from '.$post['FROM_NAME'];

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

    public function revert_request_mail($post=array()) {
        $mailing_list = $post['EMAIL_ID'];
        $mg_api = 'key-74be9f4872781161d12408795f411673';
        $mg_version = 'api.mailgun.net/v2/';
        $mg_domain = "sandbox0b14f0410b2a4555920843d785a10b10.mailgun.org";
        $mg_from_email = ADMIN_EMAIL;
        $mg_reply_to_email = ADMIN_EMAIL;
        $mg_message_url = "https://".$mg_version.$mg_domain."/messages";

        $this->Roles = ClassRegistry::init('Role');

        $roles = $this->Roles->GetRoles();

        $role_name = '';
        if(isset($post['FROM_ROLE_ID']) && $post['FROM_ROLE_ID']>0) {
            $from_role_name = $roles[$post['FROM_ROLE_ID']];
        }

        /////////////////////////////////////

        $message = '<div align="center">
                          <table cellspacing="5" cellpadding="5" border="0" width="600" style="background: none repeat scroll 0% 0% rgb(244, 244, 244); border: 1px solid rgb(102, 102, 102);">
                            <tbody>
                              <tr>
                                <th style="background-color: rgb(204, 204, 204);">Leave Request Reviewed.</th>
                              </tr>
                              <tr>
                                <td valign="top" style="text-align: left;">
                                   <br />
                                   Hello <strong>[FULL_NAME]</strong>,<br />
                                   <br />
								   Your leave has been reviewed.
								   <br />
								   Status: [STATUS]
								   <br />
								   <BR />
                                   [REASON]
								   <br />
                                   <br />
                                   From Date: [FROM_DATE] |  Till Date: [TO_DATE]
                                    <br />
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
            array('[FULL_NAME]','[FROM_DATE]','[TO_DATE]','[REASON]', '[URL]','[STATUS]', '[WEBSITE_NAME]'),
            array($post['FULL_NAME'],$post['FROM_DATE'],$post['TO_DATE'],$post['REASON'],SITE_URL,$post['STATUS'], WEBSITE_NAME), $message);


        $subject = 'Leave Request has been reviewed';

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

    public function admin_index()
    {
        $Session = $this->Session->read('Auth.Admin');
        $conditions = array();

        switch($Session["ROLE_ID"]) {
            case STUDENT_ID:
                $conditions['LeaveApplication.ROLE_ID']=$Session["ROLE_ID"];
                $conditions['LeaveApplication.USER_ID']=$Session["ID"];
                break;
            case TEACHER_ID:
                $conditions['LeaveApplication.ROLE_ID']=array(STUDENT_ID);
                $conditions['LeaveApplication.CLASS_ID']=$Session["CLASS_ID"];
                break;
            case HR_ID:
                $conditions['LeaveApplication.ROLE_ID']=array(TEACHER_ID);
//				$conditions['LeaveApplication.CLASS_ID']=$Session["CLASS_ID"];
                break;
        }
        //$conditions["LEAVE_STATUS"] = 1;



        $this->layout = 'admin_form_layout';
        $this->paginate = array(
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'LeaveApplication.created DESC',
            'conditions'=>$conditions
        );

        $this->set('leaveApplications', $this->paginate('LeaveApplication'));
    }

     public function admin_hrleave()
    {

        $conditions['LeaveApplication.ROLE_ID']=array(HR_ID);

        $this->layout = 'admin_form_layout';
        $this->paginate = array(
            'limit' => PAGINATION_LIMIT_ADMIN,
            'contain' => array('Role','User'),
            'order' => 'LeaveApplication.created DESC',
            'conditions'=>$conditions,
        );


        $this->set('leaveApplications', $this->paginate('LeaveApplication'));
      

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



            $this->LeaveApplication->set($this->request->data);

            $date1=date_create($this->General->datefordb($this->request->data['LeaveApplication']['EVENT_START']));
            $date2=date_create($this->General->datefordb($this->request->data['LeaveApplication']['EVENT_END']));
            $diff=date_diff($date1,$date2);
            $pending = $diff->format("%R%a");
            $day = str_replace('+','',$pending);
            


            if ($this->LeaveApplication->Validation()) {
                $this->LeaveApplication->create();

                $this->request->data['LeaveApplication']['FROM_DATE'] = $this->General->datefordb($this->request->data['LeaveApplication']['EVENT_START']);
                $this->request->data['LeaveApplication']['TO_DATE'] = $this->General->datefordb($this->request->data['LeaveApplication']['EVENT_END']);
                $this->request->data['LeaveApplication']['NUMBER_DAY'] = $day; 
                $this->request->data["LeaveApplication"]["ROLE_ID"] = $Session_data["ROLE_ID"];
                $this->request->data["LeaveApplication"]["USER_ID"] = $Session_data["ID"];
                $this->request->data["LeaveApplication"]["CLASS_ID"] = $Session_data["CLASS_ID"];
                


                if ($this->LeaveApplication->save($this->request->data)) {


                switch($Session_data["ROLE_ID"]) {

                case STUDENT_ID:
                    $list = $this->LeaveApplication->User->find('first',array(
                        'fields'=>array('FIRST_NAME','MIDDLE_NAME','LAST_NAME','EMAIL_ID','DEVICE_ID'),
                        'conditions'=>array(
                            'User.ROLE_ID'=>TEACHER_ID,
                            'User.CLASS_ID'=>$Session_data["CLASS_ID"],
                        ),
                    ));

                    $my_info = $this->LeaveApplication->User->find('first',array(
                        'contain'=>array('AcademicClass','Role'),
                        'fields'=>array('FIRST_NAME','MIDDLE_NAME','LAST_NAME','EMAIL_ID'),
                        'conditions'=>array(
                            'User.ID'=>$Session_data["ID"],
                        ),
                    ));

                    $notification = array(
                        'REASON'=>$this->request->data['LeaveApplication']['REASON'],
                        'FULL_NAME'=>$list ["User"]['FIRST_NAME'].' '.$list ["User"]['MIDDLE_NAME'].' '.$list ["User"]['LAST_NAME'],
                        'EMAIL_ID'=>$list ["User"]['EMAIL_ID'],
                        'FROM_ROLE_ID'=>$this->request->data["LeaveApplication"]["ROLE_ID"],
                        'FROM_DATE'=>$this->request->data['LeaveApplication']['EVENT_START'],
                        'TO_DATE'=>$this->request->data['LeaveApplication']['EVENT_END'],
                        'FROM_NAME'=>$my_info['User']['FIRST_NAME'].' '.$my_info["User"]["MIDDLE_NAME"].' '.$my_info["User"]["LAST_NAME"],
                        'FROM_CLASS_NAME'=>$my_info['AcademicClass']['CLASS_NAME'],
                        'NUMBER_DAY'=>1,
                    );

                    $this->leave_request_mail($notification);

                    $fullName = $list ["User"]['FIRST_NAME'].' '.$list ["User"]['MIDDLE_NAME'].' '.$list ["User"]['LAST_NAME'];
                    $fromName = $my_info['User']['FIRST_NAME'].' '.$my_info["User"]["MIDDLE_NAME"].' '.$my_info["User"]["LAST_NAME"];
                    $fromRoleName = $my_info['Role']['ROLE_NAME'];
                    $className = $my_info['AcademicClass']['CLASS_NAME'];
                    $currentDate = date('d/m/Y');
                    $fromDate = $this->request->data['LeaveApplication']['EVENT_START'];
                    $ToDate = $this->request->data['LeaveApplication']['EVENT_END'];
                    $reason = $this->request->data['LeaveApplication']['REASON'];
                    $deviceId = $list ["User"]['DEVICE_ID'];

                    $msg = '';
                    $msg = 'Hello '.$fullName.', you have received a leave application from '.$fromName.' ( '.$fromRoleName.' ) of class '.$className.' on '.$currentDate.'. Leave From : '.$fromDate.' to '.$ToDate.', Reason : '.$reason.'';

                    $this->General->Send_GCM($msg, $deviceId, 1);


                    break;

                case SUPERVISOR_ID:

                    $list = $this->LeaveApplication->User->find('first',array(
                        'fields'=>array('FIRST_NAME','MIDDLE_NAME','LAST_NAME','EMAIL_ID'),
                        'conditions'=>array(
                            'User.ROLE_ID'=>HR_ID,
                        ),
                    ));


                    $my_info = $this->LeaveApplication->User->find('first',array(
                        'contain'=>array('AcademicClass'),
                        'fields'=>array('FIRST_NAME','MIDDLE_NAME','LAST_NAME','EMAIL_ID'),
                        'conditions'=>array(
                            'User.ID'=>$Session_data["ID"],
                        ),
                    ));

                    $notification = array(
                        
                        'REASON'=>$this->request->data['LeaveApplication']['REASON'],
                        'FULL_NAME'=>$list ["User"]['FIRST_NAME'].' '.$list ["User"]['MIDDLE_NAME'].' '.$list ["User"]['LAST_NAME'],
                        'EMAIL_ID'=>$list ["User"]['EMAIL_ID'],
                        'FROM_ROLE_ID'=>$this->request->data["LeaveApplication"]["ROLE_ID"],
                        'FROM_DATE'=>$this->request->data['LeaveApplication']['EVENT_START'],
                        'TO_DATE'=>$this->request->data['LeaveApplication']['EVENT_END'],
                        'FROM_NAME'=>$my_info['User']['FIRST_NAME'].' '.$my_info["User"]["MIDDLE_NAME"].' '.$my_info["User"]["LAST_NAME"],
                        'FROM_CLASS_NAME'=>$my_info['AcademicClass']['CLASS_NAME'],
                    );

                    $this->leave_request_mail($notification);
                    break;

                case TEACHER_ID:

                    $list = $this->LeaveApplication->User->find('first',array(
                        'fields'=>array('FIRST_NAME','MIDDLE_NAME','LAST_NAME','EMAIL_ID'),
                        'conditions'=>array(
                            'User.ROLE_ID'=>HR_ID,
                        ),
                    ));


                    $my_info = $this->LeaveApplication->User->find('first',array(
                        'contain'=>array('AcademicClass'),
                        'fields'=>array('FIRST_NAME','MIDDLE_NAME','LAST_NAME','EMAIL_ID'),
                        'conditions'=>array(
                            'User.ID'=>$Session_data["ID"],
                        ),
                    ));

                    $notification = array(
                        
                        'REASON'=>$this->request->data['LeaveApplication']['REASON'],
                        'FULL_NAME'=>$list ["User"]['FIRST_NAME'].' '.$list ["User"]['MIDDLE_NAME'].' '.$list ["User"]['LAST_NAME'],
                        'EMAIL_ID'=>$list ["User"]['EMAIL_ID'],
                        'FROM_ROLE_ID'=>$this->request->data["LeaveApplication"]["ROLE_ID"],
                        'FROM_DATE'=>$this->request->data['LeaveApplication']['EVENT_START'],
                        'TO_DATE'=>$this->request->data['LeaveApplication']['EVENT_END'],
                        'FROM_NAME'=>$my_info['User']['FIRST_NAME'].' '.$my_info["User"]["MIDDLE_NAME"].' '.$my_info["User"]["LAST_NAME"],
                        'FROM_CLASS_NAME'=>$my_info['AcademicClass']['CLASS_NAME'],
                    );

                    $this->leave_request_mail($notification);
                    break;

                case LIBRARY_ID:

                    $list = $this->LeaveApplication->User->find('first',array(
                        'fields'=>array('FIRST_NAME','MIDDLE_NAME','LAST_NAME','EMAIL_ID'),
                        'conditions'=>array(
                            'User.ROLE_ID'=>HR_ID,
                        ),
                    ));


                    $my_info = $this->LeaveApplication->User->find('first',array(
                        'contain'=>array('AcademicClass'),
                        'fields'=>array('FIRST_NAME','MIDDLE_NAME','LAST_NAME','EMAIL_ID'),
                        'conditions'=>array(
                            'User.ID'=>$Session_data["ID"],
                        ),
                    ));

                    $notification = array(
                        
                        'REASON'=>$this->request->data['LeaveApplication']['REASON'],
                        'FULL_NAME'=>$list ["User"]['FIRST_NAME'].' '.$list ["User"]['MIDDLE_NAME'].' '.$list ["User"]['LAST_NAME'],
                        'EMAIL_ID'=>$list ["User"]['EMAIL_ID'],
                        'FROM_ROLE_ID'=>$this->request->data["LeaveApplication"]["ROLE_ID"],
                        'FROM_DATE'=>$this->request->data['LeaveApplication']['EVENT_START'],
                        'TO_DATE'=>$this->request->data['LeaveApplication']['EVENT_END'],
                        'FROM_NAME'=>$my_info['User']['FIRST_NAME'].' '.$my_info["User"]["MIDDLE_NAME"].' '.$my_info["User"]["LAST_NAME"],
                        'FROM_CLASS_NAME'=>$my_info['AcademicClass']['CLASS_NAME'],
                    );

                    $this->leave_request_mail($notification);
                    break;

                case TRANSPORTATION_ID:

                    $list = $this->LeaveApplication->User->find('first',array(
                        'fields'=>array('FIRST_NAME','MIDDLE_NAME','LAST_NAME','EMAIL_ID'),
                        'conditions'=>array(
                            'User.ROLE_ID'=>HR_ID,
                        ),
                    ));


                    $my_info = $this->LeaveApplication->User->find('first',array(
                        'contain'=>array('AcademicClass'),
                        'fields'=>array('FIRST_NAME','MIDDLE_NAME','LAST_NAME','EMAIL_ID'),
                        'conditions'=>array(
                            'User.ID'=>$Session_data["ID"],
                        ),
                    ));

                    $notification = array(
                        
                        'REASON'=>$this->request->data['LeaveApplication']['REASON'],
                        'FULL_NAME'=>$list ["User"]['FIRST_NAME'].' '.$list ["User"]['MIDDLE_NAME'].' '.$list ["User"]['LAST_NAME'],
                        'EMAIL_ID'=>$list ["User"]['EMAIL_ID'],
                        'FROM_ROLE_ID'=>$this->request->data["LeaveApplication"]["ROLE_ID"],
                        'FROM_DATE'=>$this->request->data['LeaveApplication']['EVENT_START'],
                        'TO_DATE'=>$this->request->data['LeaveApplication']['EVENT_END'],
                        'FROM_NAME'=>$my_info['User']['FIRST_NAME'].' '.$my_info["User"]["MIDDLE_NAME"].' '.$my_info["User"]["LAST_NAME"],
                        'FROM_CLASS_NAME'=>$my_info['AcademicClass']['CLASS_NAME'],
                    );

                    $this->leave_request_mail($notification);
                    break;

                case STORE_ID:

                    $list = $this->LeaveApplication->User->find('first',array(
                        'fields'=>array('FIRST_NAME','MIDDLE_NAME','LAST_NAME','EMAIL_ID'),
                        'conditions'=>array(
                            'User.ROLE_ID'=>HR_ID,
                        ),
                    ));


                    $my_info = $this->LeaveApplication->User->find('first',array(
                        'contain'=>array('AcademicClass'),
                        'fields'=>array('FIRST_NAME','MIDDLE_NAME','LAST_NAME','EMAIL_ID'),
                        'conditions'=>array(
                            'User.ID'=>$Session_data["ID"],
                        ),
                    ));

                    $notification = array(
                        
                        'REASON'=>$this->request->data['LeaveApplication']['REASON'],
                        'FULL_NAME'=>$list ["User"]['FIRST_NAME'].' '.$list ["User"]['MIDDLE_NAME'].' '.$list ["User"]['LAST_NAME'],
                        'EMAIL_ID'=>$list ["User"]['EMAIL_ID'],
                        'FROM_ROLE_ID'=>$this->request->data["LeaveApplication"]["ROLE_ID"],
                        'FROM_DATE'=>$this->request->data['LeaveApplication']['EVENT_START'],
                        'TO_DATE'=>$this->request->data['LeaveApplication']['EVENT_END'],
                        'FROM_NAME'=>$my_info['User']['FIRST_NAME'].' '.$my_info["User"]["MIDDLE_NAME"].' '.$my_info["User"]["LAST_NAME"],
                        'FROM_CLASS_NAME'=>$my_info['AcademicClass']['CLASS_NAME'],
                    );

                    $this->leave_request_mail($notification);
                    break;

                case ACCOUNT_ID:

                    $list = $this->LeaveApplication->User->find('first',array(
                        'fields'=>array('FIRST_NAME','MIDDLE_NAME','LAST_NAME','EMAIL_ID'),
                        'conditions'=>array(
                            'User.ROLE_ID'=>HR_ID,
                        ),
                    ));


                    $my_info = $this->LeaveApplication->User->find('first',array(
                        'contain'=>array('AcademicClass'),
                        'fields'=>array('FIRST_NAME','MIDDLE_NAME','LAST_NAME','EMAIL_ID'),
                        'conditions'=>array(
                            'User.ID'=>$Session_data["ID"],
                        ),
                    ));

                    $notification = array(
                        
                        'REASON'=>$this->request->data['LeaveApplication']['REASON'],
                        'FULL_NAME'=>$list ["User"]['FIRST_NAME'].' '.$list ["User"]['MIDDLE_NAME'].' '.$list ["User"]['LAST_NAME'],
                        'EMAIL_ID'=>$list ["User"]['EMAIL_ID'],
                        'FROM_ROLE_ID'=>$this->request->data["LeaveApplication"]["ROLE_ID"],
                        'FROM_DATE'=>$this->request->data['LeaveApplication']['EVENT_START'],
                        'TO_DATE'=>$this->request->data['LeaveApplication']['EVENT_END'],
                        'FROM_NAME'=>$my_info['User']['FIRST_NAME'].' '.$my_info["User"]["MIDDLE_NAME"].' '.$my_info["User"]["LAST_NAME"],
                        'FROM_CLASS_NAME'=>$my_info['AcademicClass']['CLASS_NAME'],
                    );

                    $this->leave_request_mail($notification);
                    break;

                case HR_ID:

                    $list = $this->LeaveApplication->User->find('first',array(
                        'fields'=>array('FIRST_NAME','MIDDLE_NAME','LAST_NAME','EMAIL_ID'),
                        'conditions'=>array(
                            'User.ROLE_ID'=>ADMIN_ID,
                        ),
                    ));


                    $my_info = $this->LeaveApplication->User->find('first',array(
                        'contain'=>array('AcademicClass'),
                        'fields'=>array('FIRST_NAME','MIDDLE_NAME','LAST_NAME','EMAIL_ID'),
                        'conditions'=>array(
                            'User.ID'=>$Session_data["ID"],
                        ),
                    ));

                    $notification = array(
                        
                        'REASON'=>$this->request->data['LeaveApplication']['REASON'],
                        'FULL_NAME'=>$list ["User"]['FIRST_NAME'].' '.$list ["User"]['MIDDLE_NAME'].' '.$list ["User"]['LAST_NAME'],
                        'EMAIL_ID'=>$list ["User"]['EMAIL_ID'],
                        'FROM_ROLE_ID'=>$this->request->data["LeaveApplication"]["ROLE_ID"],
                        'FROM_DATE'=>$this->request->data['LeaveApplication']['EVENT_START'],
                        'TO_DATE'=>$this->request->data['LeaveApplication']['EVENT_END'],
                        'FROM_NAME'=>$my_info['User']['FIRST_NAME'].' '.$my_info["User"]["MIDDLE_NAME"].' '.$my_info["User"]["LAST_NAME"],
                        'FROM_CLASS_NAME'=>$my_info['AcademicClass']['CLASS_NAME'],
                    );

                    $this->leave_request_mail($notification);
                    break;
            }
                   
                
                    $this->Session->setFlash('Leave Application Added Successfully!', 'message_good');
                    if($Session_data['ROLE_ID']==STUDENT_ID) {
                        $this->redirect(array('action' => 'index'));
                    }else{
                        $this->redirect(array('action' => 'outbox'));
                    }
                }
            } else
            {
                $this->Session->setFlash('Leave Application Not Added Please Try Again!', 'message_bad');
            }
        }
         $ltype = $this->LeaveApplication->LeaveType->GetLType();
        $this->set('ltype', $ltype);
    }

    public function admin_view($ID = null)
    {
        $this->layout = 'admin_form_layout';
        $LeaveApplication = $this->LeaveApplication->find('first', array(
            'contain' => array('Role','User'),
            'conditions' => array('LeaveApplication.LEAVE_ID' => $ID)
        ));

        $this->set('leaveApplications', $LeaveApplication);
    }

    public function admin_stactive($id=null) {
        $LeaveApplication = $this->LeaveApplication->find('first', array(
            'contain' => array('User'),
            'conditions' => array('LeaveApplication.LEAVE_ID' => $id)
        ));

        if(is_array($LeaveApplication) && sizeof($LeaveApplication)>0) {
            $this->LeaveApplication->id = $id;
            if($this->LeaveApplication->saveField('LEAVE_STATUS',1)) {
            
            	$notification = array(
                'REASON'=>$LeaveApplication["LeaveApplication"]['REASON'],
                'FROM_DATE'=>$LeaveApplication["LeaveApplication"]['FROM_DATE'],
                'TO_DATE'=>$LeaveApplication["LeaveApplication"]['TO_DATE'],
                'FULL_NAME'=>$LeaveApplication["User"]['FIRST_NAME'].' '.$LeaveApplication["User"]['MIDDLE_NAME'].' '.$LeaveApplication["User"]['LAST_NAME'],
                'EMAIL_ID'=>$LeaveApplication["User"]['EMAIL_ID'],
                'STATUS'=>"Approved"
            );
            
		$this->revert_request_mail($notification);
		
		$fullName = $LeaveApplication["User"]['FIRST_NAME'].' '.$LeaveApplication["User"]['MIDDLE_NAME'].' '.$LeaveApplication["User"]['LAST_NAME'];
		$fromDate = $this->General->dbfordate($LeaveApplication["LeaveApplication"]['FROM_DATE']);
		$ToDate = $this->General->dbfordate($LeaveApplication["LeaveApplication"]['TO_DATE']);
		$deviceId = $LeaveApplication["User"]['DEVICE_ID'];
		$status = "Approved";
		
		$msg = '';
		
		$msg = 'Hello '.$fullName.', leave application that you applied from '.$fromDate.' to '.$ToDate.' has been reviewed and the status is '.$status.'';
		
		$this->General->Send_GCM($msg, $deviceId, 1);
            
                $this->Session->setFlash('Leave Application has been updated.', 'message_good');
            }else{
                $this->Session->setFlash('Leave Application could not updated. Please try again.', 'message_bad');
            }
        }else{
            $this->Session->setFlash('Invalid request. Please try agian.', 'message_bad');
        }
        $this->redirect(array('action' => 'leaveApplications','action'=>"index"));
    }// end of functions

    public function admin_streject($id=null) {
        $LeaveApplication = $this->LeaveApplication->find('first', array(
            'contain' => array('User'),
            'conditions' => array('LeaveApplication.LEAVE_ID' => $id)
        ));

        if(is_array($LeaveApplication) && sizeof($LeaveApplication)>0) {
            $this->LeaveApplication->id = $id;
            $this->LeaveApplication->saveField('LEAVE_STATUS',2);
            
            $notification = array(
                'REASON'=>$LeaveApplication["LeaveApplication"]['REASON'],
                'FROM_DATE'=>$LeaveApplication["LeaveApplication"]['FROM_DATE'],
                'TO_DATE'=>$LeaveApplication["LeaveApplication"]['TO_DATE'],
                'FULL_NAME'=>$LeaveApplication["User"]['FIRST_NAME'].' '.$LeaveApplication["User"]['MIDDLE_NAME'].' '.$LeaveApplication["User"]['LAST_NAME'],
                'EMAIL_ID'=>$LeaveApplication["User"]['EMAIL_ID'],
                'STATUS'=>"Rejected"
            );
            
		$this->revert_request_mail($notification);
		
		$fullName = $LeaveApplication["User"]['FIRST_NAME'].' '.$LeaveApplication["User"]['MIDDLE_NAME'].' '.$LeaveApplication["User"]['LAST_NAME'];
		$fromDate = $this->General->dbfordate($LeaveApplication["LeaveApplication"]['FROM_DATE']);
		$ToDate = $this->General->dbfordate($LeaveApplication["LeaveApplication"]['TO_DATE']);
		$deviceId = $LeaveApplication["User"]['DEVICE_ID'];
		$status = "Rejected";
		
		$msg = '';
		
		$msg = 'Hello '.$fullName.', leave application that you applied from '.$fromDate.' to '.$ToDate.' has been reviewed and the status is '.$status.'';
		
		$this->General->Send_GCM($msg, $deviceId, 1);
            
            $this->Session->setFlash('Leave Application has been updated.', 'message_good');
        }else{
            $this->Session->setFlash('Invalid request. Please try agian.', 'message_bad');
        }

        $this->redirect(array('action' => 'leaveApplications','action'=>"index"));
    }// end of functions

    public function admin_outbox()
    {

        $Session = $this->Session->read('Auth.Admin');
        $conditions = array();

        switch($Session["ROLE_ID"]) {
            case STUDENT_ID:
                $conditions['LeaveApplication.ROLE_ID']=$Session["ROLE_ID"];
                $conditions['LeaveApplication.USER_ID']=$Session["ID"];
                break;
            case TEACHER_ID:
                $conditions['LeaveApplication.ROLE_ID']=array($Session["ROLE_ID"]);
                $conditions['LeaveApplication.CLASS_ID']=$Session["CLASS_ID"];
                break;
            case HR_ID:
                $conditions['LeaveApplication.ROLE_ID']=array(HR_ID);
//				$conditions['LeaveApplication.CLASS_ID']=$Session["CLASS_ID"];
                break;
            case ADMIN_ID:
                $conditions['LeaveApplication.ROLE_ID']=array(HR_ID);
//              $conditions['LeaveApplication.CLASS_ID']=$Session["CLASS_ID"];
                break;
        }
        //$conditions["LEAVE_STATUS"] = 1;



        $this->layout = 'admin_form_layout';
        $this->paginate = array(
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'LeaveApplication.created DESC',
            'conditions'=>$conditions
        );

        $this->set('leaveApplications', $this->paginate('LeaveApplication'));
    }

    public function App_ApplyForLeave()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;

        if(!empty($this->request->data))
        {
            $this->LeaveApplication->create();
            /// pr($this->request->data);
            switch($this->request->data["ROLE_ID"]) {

                case STUDENT_ID:
                    $list = $this->LeaveApplication->User->find('first',array(
                        'fields'=>array('FIRST_NAME','MIDDLE_NAME','LAST_NAME','EMAIL_ID','DEVICE_ID'),
                        'conditions'=>array(
                            'User.ROLE_ID'=>TEACHER_ID,
                            'User.CLASS_ID'=>$this->request->data["CLASS_ID"],
                        ),
                    ));

                    $my_info = $this->LeaveApplication->User->find('first',array(
                        'contain'=>array('AcademicClass','Role'),
                        'fields'=>array('FIRST_NAME','MIDDLE_NAME','LAST_NAME','EMAIL_ID'),
                        'conditions'=>array(
                            'User.ID'=>$this->request->data["USER_ID"],
                        ),
                    ));

                    $notification = array(
                        'REASON'=>$this->request->data['REASON'],
                        'FULL_NAME'=>$list ["User"]['FIRST_NAME'].' '.$list ["User"]['MIDDLE_NAME'].' '.$list ["User"]['LAST_NAME'],
                        'EMAIL_ID'=>$list ["User"]['EMAIL_ID'],
                        'FROM_ROLE_ID'=>$this->request->data['ROLE_ID'],
                        'FROM_DATE'=>$this->request->data['FROM_DATE'],
                        'TO_DATE'=>$this->request->data['TO_DATE'],
                        'FROM_NAME'=>$my_info['User']['FIRST_NAME'].' '.$my_info["User"]["MIDDLE_NAME"].' '.$my_info["User"]["LAST_NAME"],
                        'FROM_CLASS_NAME'=>$my_info['AcademicClass']['CLASS_NAME'],

                    );
                    
                    $this->leave_request_mail($notification);
                    
                    $fullName = $list ["User"]['FIRST_NAME'].' '.$list ["User"]['MIDDLE_NAME'].' '.$list ["User"]['LAST_NAME'];
                    $fromName = $my_info['User']['FIRST_NAME'].' '.$my_info["User"]["MIDDLE_NAME"].' '.$my_info["User"]["LAST_NAME"];
                    $fromRoleName = $my_info['Role']['ROLE_NAME'];
                    $className = $my_info['AcademicClass']['CLASS_NAME'];
                    $currentDate = date('d/m/Y');
                    $fromDate = $this->request->data['FROM_DATE'];
		    $ToDate = $this->request->data['TO_DATE'];
		    $reason = $this->request->data['REASON'];
		    $deviceId = $list ["User"]['DEVICE_ID'];
                    
                    $msg = '';
                    $msg = 'Hello '.$fullName.', you have received a leave application from '.$fromName.' ( '.$fromRoleName.' ) of class '.$className.' on '.$currentDate.'. Leave From : '.$fromDate.' to '.$ToDate.', Reason : '.$reason.'';
                    
                    $this->General->Send_GCM($msg, $deviceId, 1);

                    
                    break;
                case TEACHER_ID:
                    $list = $this->LeaveApplication->User->find('first',array(
                        'fields'=>array('FIRST_NAME','MIDDLE_NAME','LAST_NAME','EMAIL_ID'),
                        'conditions'=>array(
                            'User.ROLE_ID'=>HR_ID,
                        ),
                    ));

                    $my_info = $this->LeaveApplication->User->find('first',array(
                        'contain'=>array('AcademicClass'),
                        'fields'=>array('FIRST_NAME','MIDDLE_NAME','LAST_NAME','EMAIL_ID'),
                        'conditions'=>array(
                            'User.ID'=>$this->request->data["USER_ID"],
                        ),
                    ));

                    $notification = array(
                        'REASON'=>$this->request->data['REASON'],
                        'FULL_NAME'=>$list ["User"]['FIRST_NAME'].' '.$list ["User"]['MIDDLE_NAME'].' '.$list ["User"]['LAST_NAME'],
                        'EMAIL_ID'=>$list ["User"]['EMAIL_ID'],
                        'FROM_ROLE_ID'=>$this->request->data['ROLE_ID'],
                        'FROM_DATE'=>$this->request->data['FROM_DATE'],
                        'TO_DATE'=>$this->request->data['TO_DATE'],
                        'FROM_NAME'=>$my_info['User']['FIRST_NAME'].' '.$my_info["User"]["MIDDLE_NAME"].' '.$my_info["User"]["LAST_NAME"],
                        'FROM_CLASS_NAME'=>$my_info['AcademicClass']['CLASS_NAME'],
                    );

                    $this->leave_request_mail($notification);
                    break;
            }

            $this->request->data['LeaveApplication'] = $this->request->data;
            $this->LeaveApplication->save($this->request->data);

            $message = 'Your Leave Application has been successfully sent';
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

    public function App_LeaveRecords()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;

        $userId = $this->request->data['USER_ID'];
        $leaveStatus = $this->request->data['LEAVE_STATUS'];

        $condition = array();

        if(!empty($userId) && $leaveStatus == 0)
        {
            $condition = array('USER_ID' => $userId, 'LEAVE_STATUS' => 0);
        }
        elseif(!empty($userId) && $leaveStatus == 1)
        {
            $condition = array('USER_ID' => $userId, 'LEAVE_STATUS' => 1);
        }
        elseif(!empty($userId) && $leaveStatus == 2)
        {
            $condition = array('USER_ID' => $userId, 'LEAVE_STATUS' => 2);
        }

        if(!empty($this->request->data))
        {
            $TempData = $this->LeaveApplication->find('all', array(
                'contain' => array('User','Role','AcademicClass'),
                'conditions' => $condition
            ));

            if(!empty($TempData))
            {
                $status = true;
            }
            else
            {
                $status = false;
            }
        }
        else
        {
            $message = 'Opps something wrong!';
            $status = false;
        }

        $result_array = array(
            'status' => $status,
            'message' => $message,
            'data' => $TempData
        );

        echo json_encode($result_array); die;

    }

    public function App_ViewLeaveData()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;

        $leaveId = $this->request->data['LEAVE_ID'];

        $this->LeaveApplication->virtualFields = array(
            'created' => "DATE_FORMAT(LeaveApplication.created,'%d/%m/%Y %h:%i %p')"
        );

        if(!empty($leaveId))
        {
            $TempData = $this->LeaveApplication->find('first', array(
                'contain' => array('Role','AcademicClass','User'),
                'conditions' => array('LEAVE_ID' => $leaveId)
            ));

            //$Data = Set::extract('/LeaveApplication/.', $TempData);

            if(!empty($TempData))
            {
                $message = 'Available Details!';
                $status = true;
            }
            else
            {
                $message = 'No Records Found!';
                $status = false;
            }
        }
        else
        {
            $message = 'Opps something wrong!';
            $status = false;
        }

        $result_array = array(
            'status' => $status,
            'message' => $message,
            'data' => $TempData
        );

        echo json_encode($result_array); die;

    }

    public function App_PendingLeaveApplicationOfStudent()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;


        $classId = $this->request->data['CLASS_ID'];


        $condition = array();

        if(!empty($classId))
        {
            $condition = array('LeaveApplication.ROLE_ID' => STUDENT_ID, 'LeaveApplication.CLASS_ID' => $classId, 'LEAVE_STATUS' => 0);

            $TempData = $this->LeaveApplication->find('all', array(
                'contain' => array('User','AcademicClass','Role'),
                'conditions' => $condition
            ));

            $message = 'Pending Leave Application of Students!';
            $status = true;

            $result_array = array(
                'status' => $status,
                'message' => $message,
                'data' => $TempData
            );
        }
        else
        {
            $message = 'No Data Available!';
            $status = false;

            $result_array = array(
                'status' => $status,
                'message' => $message,
                'data' => ''
            );
        }
        echo json_encode($result_array); die;
    }

    public function App_LeaveApplicationUpdate()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;

        $leaveId = $this->request->data['LEAVE_ID'];
        $leaveStatus = $this->request->data['LEAVE_STATUS'];

        $condition = array();

        if(!empty($leaveId))
        {

            $list = $this->LeaveApplication->find('first',array(
                'contain'=>array('User'),
                'conditions'=>array('LEAVE_ID'=>$leaveId),
            ));
            $notification = array(
                'REASON'=>$list["LeaveApplication"]['REASON'],
                'FROM_DATE'=>$list["LeaveApplication"]['FROM_DATE'],
                'TO_DATE'=>$list["LeaveApplication"]['TO_DATE'],
                'FULL_NAME'=>$list ["User"]['FIRST_NAME'].' '.$list ["User"]['MIDDLE_NAME'].' '.$list ["User"]['LAST_NAME'],
                'EMAIL_ID'=>$list["User"]['EMAIL_ID'],
                'STATUS'=>$leaveStatus==1?"Approved":"Rejected"
            );

            $this->LeaveApplication->id = $leaveId;

            $this->LeaveApplication->saveField("LEAVE_STATUS",$leaveStatus);
            
            $this->revert_request_mail($notification);
            
            $fullName = $list ["User"]['FIRST_NAME'].' '.$list ["User"]['MIDDLE_NAME'].' '.$list ["User"]['LAST_NAME'];
            $fromDate = $list["LeaveApplication"]['FROM_DATE'];
	    $ToDate = $list["LeaveApplication"]['TO_DATE'];
	    $deviceId = $list ["User"]['DEVICE_ID'];
	    $status = $leaveStatus==1?"Approved":"Rejected";
            
            $msg = '';

            $msg = 'Hello '.$fullName.', leave application that you applied from '.$fromDate.' to '.$ToDate.' has been reviewed and the status is '.$status.'';
            
            $this->General->Send_GCM($msg, $deviceId, 1);

            $message = 'Leave Application Updated Successfully!';
            $status = true;
        }
        else
        {
            $message = 'Oppps Something Wrong!';
            $status = false;
        }

        $result_array = array(
            'status' => $status,
            'message' => $message
        );
        echo json_encode($result_array); die;
    }
}