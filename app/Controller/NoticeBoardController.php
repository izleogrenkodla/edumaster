<?php
// app/Controller/UsersController.php
class NoticeBoardController extends AppController
{
    var $name = 'NoticeBoard';

    public function beforeFilter()
    {
        parent::beforeFilter();

        $this->Auth->allow('App_NoticeBoard','App_SentNotice','App_SendNotice','App_UpdateNoticeReadFlag','App_UnreadNoticeCount');

        if(isset($this->Security) &&  ($this->RequestHandler->isAjax() || $this->RequestHandler->isPost())){
            $this->Security->validatePost = false;
            $this->Security->enabled = false;
            $this->Security->csrfCheck = false;
        }
    }

    public function send_mail_notification($post=array()) {
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
                                <th style="background-color: rgb(204, 204, 204);">Welcome to [WEBSITE_NAME] Notice Board Message.</th>
                              </tr>
                              <tr>
                                <td valign="top" style="text-align: left;">
                                   <br />
                                   Hello <strong>[FULL_NAME] </strong>,<br />
                                   <br />
                                   You have received notice from <strong>:[FROM_NAME] ([FROM_ROLE_NAME])  </strong><br />
                                   <br />
                                   Notice Title: [MESSAGE_TITLE]
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
            array('[FULL_NAME]','[FROM_NAME]','[MESSAGE_TITLE]', '[URL]', '[WEBSITE_NAME]','[FROM_ROLE_NAME]'),
            array($post['FULL_NAME'],$post['FROM_NAME'],$post['NOTICE_TITLE'],SITE_URL, WEBSITE_NAME,$from_role_name), $message);


        $subject = 'New Notice arrived from : '.$post["FROM_NAME"];

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

    public function admin_teachers() {

        $this->layout = 'admin_form_layout';

        $Session = $this->Session->read('Auth.Admin');

        $conditions = array();

        switch($Session["ROLE_ID"]) {
            case STUDENT_ID:
                $conditions['NoticeBoardXref.TO_ID']= $Session["ID"];
                break;
            case HR_ID:
                $conditions['NoticeBoardXref.TO_ID']= $Session["ID"];
                break;
            case TEACHER_ID:
                $conditions['NoticeBoardXref.TO_ID']= $Session["ID"];
                //$conditions['CLASS_ID']=$Session["CLASS_ID"];
                break;
            case ACCOUNT_ID:
                $conditions['NoticeBoardXref.TO_ID']= $Session["ID"];
                //$conditions['CLASS_ID']=$Session["CLASS_ID"];
                break;
            case SUPERVISOR_ID:
                $conditions['NoticeBoardXref.TO_ID']= $Session["ID"];
                //$conditions['CLASS_ID']=$Session["CLASS_ID"];
                break;
        }

        $this->NoticeBoardXref =  ClassRegistry::init('NoticeBoardXref');

        $this->paginate = array(
            'contain' => array('NoticeBoard','User','UserFrom'),
            'conditions' => $conditions,
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'NoticeBoardXref.created DESC'
        );

        $this->set('notices', $this->paginate('NoticeBoardXref'));
    }// end of functions

    public function admin_index($id = null)
    {
        $this->layout = 'admin_form_layout';

        $Session = $this->Session->read('Auth.Admin');
        $conditions = array();
		if((isset($id)) && ($id)>0)
			{
				$conditions['NoticeBoard.USER_ID'] = $id;
				//$conditions['LibraryFine.ROLE_ID'] = $rdata['LibraryFine']['ROLE_ID'];
			}
        switch($Session["ROLE_ID"]) {
            case STUDENT_ID:
//				$conditions['NoticeBoardXref.TO_ID']= $Session["ID"];
                //   $this->render('users_notice');
                break;
            case TEACHER_ID:
                $conditions['NoticeBoard.USER_ID']= $Session["ID"];
                //$conditions['CLASS_ID']=$Session["CLASS_ID"];
                break;
            case HR_ID:
                $conditions['NoticeBoard.USER_ID']= $Session["ID"];
                //$conditions['CLASS_ID']=$Session["CLASS_ID"];
                break;
            case ACCOUNT_ID:
                $conditions['NoticeBoard.USER_ID']= $Session["ID"];
                //$conditions['CLASS_ID']=$Session["CLASS_ID"];
                break;
            case SUPERVISOR_ID:
                $conditions['NoticeBoard.USER_ID']= $Session["ID"];
                //$conditions['CLASS_ID']=$Session["CLASS_ID"];
                break;

        }


        $this->paginate = array(
            'conditions' => $conditions,
            'contain' => array('NoticeBoardXref'=>array("User"=>array("Role"))),
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'NoticeBoard.created DESC'
        );
        $this->set('notices', $this->paginate('NoticeBoard'));
    }

    public function admin_add()
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		if($Session_data["ROLE_ID"]!=ADMIN_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}
		
		/*$classes = $this->User->AcademicClass->GetAcademicClasses();
		$this->set('class',$classes);*/
		
		$CircularGroup = $this->NoticeBoard->CircularGroup->GetCircularGroup();
		$this->set('CircularGroup',$CircularGroup);

        if ($this->request->is('post')) {
       

            $this->NoticeBoard->set($this->request->data);
            if ($this->NoticeBoard->Validation()) {
                $this->NoticeBoard->create();
                if(isset($this->request->data["selected_user"]) && is_array($this->request->data["selected_user"]) && sizeof($this->request->data["selected_user"])>0) {
                    $this->request->data['NoticeBoard']['USER_ID'] = $Session_data['ID'];
                    if ($this->NoticeBoard->save($this->request->data)) {
                        $noticeId = $this->NoticeBoard->getInsertId();

                        $this->NoticeBoardXref = ClassRegistry::init('NoticeBoardXref');

                        $lists = $this->request->data["selected_user"];
                        foreach($lists as $key => $to_id)
                        {

                            $user_id = $to_id;
                            $XrefData['NoticeBoardXref'] = array(
                                'NOTICE_ID' => $noticeId,
                                'TO_ID' => $user_id,
                                'FROM_ID' => $Session_data['ID'],
                            );
							
                            $this->NoticeBoardXref->create();
							
                            $this->NoticeBoardXref->save($XrefData);

                            $this->User = ClassRegistry::init('User');
                            $usr = $this->User->find('first',array('fields'=>array('EMAIL_ID','FIRST_NAME','MIDDLE_NAME','LAST_NAME','ROLE_ID','DEVICE_ID'),'conditions'=>array('User.ID'=>$user_id),'contain' => array('Role')));

                            $notification = array(
                                'FROM_NAME'=>$Session_data["FIRST_NAME"].' '.$Session_data["MIDDLE_NAME"].' '.$Session_data["LAST_NAME"],
                                'FULL_NAME'=>$usr["User"]['FIRST_NAME'].' '.$usr["User"]['MIDDLE_NAME'].' '.$usr["User"]['LAST_NAME'],
                                'EMAIL_ID'=>$usr["User"]['EMAIL_ID'],
                                'FROM_ROLE_ID'=>$Session_data['ROLE_ID'],
                                'NOTICE_TITLE'=>$this->request->data['NoticeBoard']['NOTICE_TITLE']

                            );
                            $this->send_mail_notification($notification);
                            
                            $this->Role = ClassRegistry::init('Role');
                            
                            $role = $this->Role->find('first',array('fields'=>array('ID','ROLE_NAME'),'conditions'=>array('Role.ID'=>$Session_data["ROLE_ID"])));
                            
                            $fromName = $Session_data["FIRST_NAME"].' '.$Session_data["LAST_NAME"];
                            $toName = $usr["User"]['FIRST_NAME'].' '.$usr["User"]['LAST_NAME'];
                            $deviceId = $usr["User"]['DEVICE_ID'];
                            $circularTitle = $this->request->data['NoticeBoard']['NOTICE_TITLE'];
                            $roleName = $role["Role"]['ROLE_NAME'];
                            $circularDescription = $this->request->data['NoticeBoard']['NOTICE_DESC'];


                            $msg = '';
                            $msg = 'Hello '.$toName.', You have received notice from '.$fromName.' ( '.$roleName.' ), Circular Title : '.$circularTitle.', Description : '.$circularDescription.'';
                            
                            //echo $msg.'<br>'.$deviceId;

                            $this->General->Send_GCM($msg, $deviceId, 1);
                        }

                        $this->Session->setFlash('Notice Added Successfully!', 'message_good');
                        $this->redirect(array('action' => 'index'));
                    }
                }else{
                    $this->Session->setFlash('Notice could not proceed, Please select atleast one user.', 'message_bad');
                }

            } else {
                $this->Session->setFlash('Notice Class Not Added Please Try Again!', 'message_bad');
            }
        }

        switch($Session_data['ROLE_ID']) {
            case TEACHER_ID:
                $allow_role = array(STUDENT_ID);
                $tmp = array(''=>"Select Role");
                $roles = $this->NoticeBoard->Role->GetRoles();
                foreach($allow_role as $r) $tmp[$r] = $roles[$r];
                $this->set('students', $tmp);
                break;
            case ADMIN_ID:
                $roles = $this->NoticeBoard->Role->GetRoles();
                //unset($roles[0]);
                unset($roles[ADMIN_ID]);
                $this->set('students', $roles);
                break;
            case HR_ID:
                $roles = $this->NoticeBoard->Role->GetRoles();
                unset($roles[HR_ID]);
                $this->set('students', $roles);
                break;
            case ACCOUNT_ID:
                $roles = $this->NoticeBoard->Role->GetRoles();
                unset($roles[ACCOUNT_ID]);
                $this->set('students', $roles);
                break;
            case SUPERVISOR_ID:
                $roles = $this->NoticeBoard->Role->GetRoles();
                unset($roles[SUPERVISOR_ID]);
                $this->set('students', $roles);
                break;

        }

        $this->set('user_role',$Session_data['ROLE_ID']);
    }

    public function admin_getUserbyRole () {

        if ($this->request->is('post') || $this->request->is('ajax')) {
            $Session_data = $this->Session->read('Auth.Admin');
            $this->autoRender = false;
            $this->layout = 'ajax';
            $this->User = ClassRegistry::init('User');
            $users = array();
            $conditions = array();
            $conditions['User.ROLE_ID'] = $this->request->data["NoticeBoard"]["ROLE_ID"];
            switch($Session_data['ROLE_ID']) {
                case TEACHER_ID:
                    $conditions['User.CLASS_ID'] = $Session_data['CLASS_ID'];
                    break;
            }

            $users =$this->User->find('all',array(
                'conditions'=>$conditions,
            ));

            $return = array();
            if(sizeof($users)>0) {
                $return['status'] = "success";
                $html = '<ul>';
                foreach($users as $k=>$value) {
                    $html.='<li><input type="checkbox" name=selected_user[] value="'.$value["User"]["ID"].'">'.$value["User"]["FIRST_NAME"].' '.$value["User"]["LAST_NAME"].'</li>';
                }
                $html.='</ul>';
                $return['lists'] = $html;
            }else{
                $return['status'] = "failed";
            }
            echo json_encode($return);die;
        }
    }// end of functions 
	
	
	public function admin_getUserbyClass () {
	  $id = $this->request->data['id'];
	  
	  $this->CircularGroup = ClassRegistry::init('CircularGroup');
	  $con = array();
        $con['CircularGroup.CIR_GR_ID'] = $id;
		$cls =$this->CircularGroup->find('first',array(
                'conditions'=>$con,
            ));
		$title = $cls['CircularGroup']['TITLE']; 
		
		$con1['CircularGroup.TITLE'] = $title;
		$clsid =$this->CircularGroup->find('all',array(
                'conditions'=>$con1,
            ));
		
		foreach($clsid as $key => $val){
			$classid[] = $val['CircularGroup']['CLASS_ID'];
		}
	  	
		foreach($classid as $key => $val){
			$this->User = ClassRegistry::init('User');
			$conditions = array();
			$conditions['User.CLASS_ID'] = $val;
			$conditions['User.ROLE_ID'] = STUDENT_ID;
				$users =$this->User->find('all',array('conditions'=>$conditions));
				
				$return = array();
					$return['status'] = "success";
					$html = '<ul>';
					foreach($users as $k=>$value) {
						$html.='<li><input type="checkbox" name=selected_user[] value="'.$value["User"]["ID"].'">'.$value["User"]["FIRST_NAME"].' '.$value["User"]["LAST_NAME"].'</li>';
					}
					$html.='</ul>';
					$html.= "<script>
					$('#checkall').prop('checked', false)
					</script>";
					echo $html;
				
		}
		die;
		
		/*$this->User = ClassRegistry::init('User');
				$conditions = array();
				$conditions['User.CLASS_ID'] = $id;
				$conditions['User.ROLE_ID'] = STUDENT_ID;
				$users =$this->User->find('all',array(
                'conditions'=>$conditions,
            ));*/
		
		
				
		//PR($users);
	
	   exit();
    }
  

    public function admin_getNoticeInfo ($notice_id=null) {
        $Session_data = $this->Session->read('Auth.Admin');
        if ($notice_id!='') {
            $this->autoRender = false;
            $this->layout = 'ajax';
            $this->NoticeBoardXref = ClassRegistry::init('NoticeBoardXref');
            $info = array();
            $return = array();
            $info = $this->NoticeBoardXref->find('all',array(
                'contain'=>array("User"),
                'conditions'=>array(
                    'NoticeBoardXref.NOTICE_ID'=>$notice_id,
                    'NoticeBoardXref.FROM_ID'=>$Session_data["ID"],
                ),
            ));
            $html = '';

            if(is_array($info) && sizeof($info)) {
                $return["status"]="success";
                $html.='<ul>';
                foreach($info as $i) {
                    $html.='<li>'.$i["User"]["FIRST_NAME"].'</li>';
                }
                $html.='</ul>';
            }else{
                $html='No data found.';
                $return["status"]="failed";
            }
            $return["html"]=$html;
            echo json_encode($return);die;
        }
    }// end of functions

    public function admin_view($ID = null)
    {
        $this->layout = 'admin_form_layout';
        $NoticeBoard = $this->NoticeBoard->find('first', array(
            'contain' => array('User'),
            'conditions' => array('NoticeBoard.NOTICE_ID' => $ID)
        ));


        $this->set('NoticeBoard', $NoticeBoard);
    }

    public function admin_delete($Id = null)
    {
        $this->layout = 'admin_form_layout';
		
		$Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		if($Session_data["ROLE_ID"]!=ADMIN_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}
		
        if (!empty($Id)) {
            try {
                if ($this->NoticeBoard->delete($Id)) {
                    $this->Session->setFlash('Notice is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid Notice.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }

    public function App_NoticeBoard()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;

        $this->NoticeBoard->virtualFields = array(
            'created' => "DATE_FORMAT(NoticeBoard.created,'%d/%m/%Y %h:%i %p')"
        );

        $userId = $this->request->data['TO_ID'];

        $this->NoticeBoardXref = ClassRegistry::init('NoticeBoardXref');

        $NoticeBoard = $this->NoticeBoardXref->find('all', array(
            'fields' => array(),
            'contain' => array('NoticeBoard','UserFrom'=>array('Role')),
            'conditions' => array('TO_ID' => $userId),
            'order' => 'NoticeBoardXref.ID DESC'

        ));

        if(!empty($NoticeBoard))
        {
            $message = 'Notice Found';
            $status = true;
        }
        else
        {
            $message = 'No Data Found';
            $status = false;
        }

        $result_array = array(
            'status' => $status,
            'message' => $message,
            'data' => $NoticeBoard
        );

        echo json_encode($result_array); die;

    }

    public function App_SentNotice()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;

        $this->NoticeBoard->virtualFields = array(
            'created' => "DATE_FORMAT(NoticeBoard.created,'%d/%m/%Y %h:%i %p')"
        );

        $userId = $this->request->data['FROM_ID'];

        $this->NoticeBoardXref = ClassRegistry::init('NoticeBoardXref');

        $NoticeBoard = $this->NoticeBoardXref->find('all', array(
            'fields' => array(),
            'contain' => array('NoticeBoard','User'=>array('Role')),
            'conditions' => array('FROM_ID' => $userId),
            'order' => 'NoticeBoardXref.ID DESC'

        ));

        if(!empty($NoticeBoard))
        {
            $message = 'Notice Found';
            $status = true;
        }
        else
        {
            $message = 'No Data Found';
            $status = false;
        }

        $result_array = array(
            'status' => $status,
            'message' => $message,
            'data' => $NoticeBoard
        );

        echo json_encode($result_array); die;

    }

    public function App_SendNotice()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;

        if(!empty($this->request->data))
        {

            $data = $this->request->data;

            $userID = $data['USER_ID'];
            $NoticeTitle = $data['NOTICE_TITLE'];
            $NoticeDesc = $data['NOTICE_DESC'];

            $TempData['NoticeBoard'] = array(
                'USER_ID' => $userID,
                'NOTICE_TITLE' => $NoticeTitle,
                'NOTICE_DESC' => $NoticeDesc
            );

            if(isset($TempData) && !empty($TempData))
            {
                $this->NoticeBoard->create();
                if($this->NoticeBoard->save($TempData['NoticeBoard']))
                {
                    $NoticeId = $this->NoticeBoard->getLastInsertId();

                    $NoticeUser = json_decode($data['NOTICE_USER'], true);

                    $this->NoticeBoardXref = ClassRegistry::init('NoticeBoardXref');

                    foreach($NoticeUser as $users)
                    {
                        $Data['NoticeBoardXref'] = array(
                            'NOTICE_ID' => $NoticeId,
                            'TO_ID' => $users['TO_ID'],
                            'FROM_ID' => $users['FROM_ID']
                        );
                        $this->NoticeBoardXref->create();
                        $this->NoticeBoardXref->save($Data);
                        
                        $this->User = ClassRegistry::init('User');
                        $user = $this->User->find('first',array('fields'=>array('EMAIL_ID','FIRST_NAME','MIDDLE_NAME','LAST_NAME','ROLE_ID','DEVICE_ID'),'conditions'=>array('User.ID'=>$users['TO_ID'])));

                        $FromUser = $this->User->find('first',array('fields'=>array('EMAIL_ID','FIRST_NAME','MIDDLE_NAME','LAST_NAME','ROLE_ID','DEVICE_ID'),'conditions'=>array('User.ID'=>$users['FROM_ID']),'contain' => array('Role')));

                        $fromName = $FromUser['User']['FIRST_NAME'].' '.$FromUser['User']['LAST_NAME'];
                        $toName = $user['User']['FIRST_NAME'].' '.$user['User']['LAST_NAME'];
                        $deviceId = $user['User']['DEVICE_ID'];
                        $emailId = $user['User']['EMAIL_ID'];
                        $circularTitle = $NoticeTitle;
                        $roleName = $FromUser['Role']['ROLE_NAME'];
                        $circularDescription = $NoticeDesc;

                        $msg = '';
                        $msg = 'Hello '.$toName.', You have received notice from '.$fromName.' ( '.$roleName.' ), Circular Title : '.$circularTitle.', Description : '.$circularDescription.'';

                        $this->General->Send_GCM($msg, $deviceId, 1);

                        $notification = array(
                            'FROM_NAME'=>$fromName,
                            'FULL_NAME'=>$toName,
                            'EMAIL_ID'=>$emailId,
                            'FROM_ROLE_ID'=>$FromUser['User']['ROLE_ID'],
                            'NOTICE_TITLE'=>$circularTitle

                        );

                        $this->send_mail_notification($notification);
                    }

                    $message = 'Notice Successfully Send';
                    $status = true;

                }
            }
        }
        else
        {
            $message = 'Oppps Something Wrong!';
            $status = false;
        }

        $result_array = array(
            'status' => $status,
            'message' => $message,
        );

        echo json_encode($result_array); die;

    }

    public function App_UpdateNoticeReadFlag()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;

        if(!empty($this->request->data))
        {

            $data = $this->request->data;

            $NoticeId = $data['NOTICE_ID'];
            $ToId = $data['TO_ID'];

            if(isset($data) && !empty($data))
            {
                $this->NoticeBoardXref = ClassRegistry::init('NoticeBoardXref');

                $NoticeBoard = $this->NoticeBoardXref->find('first', array(
                    'contain' => array(),
                    'fields' => array('ID'),
                    'conditions' => array('NoticeBoardXref.NOTICE_ID' => $NoticeId, 'TO_ID' => $ToId),
                ));

                if(isset($NoticeBoard) && !empty($NoticeBoard))
                {
                    $NoticeBoardXrefId = $NoticeBoard['NoticeBoardXref']['ID'];
                    $this->NoticeBoardXref->id = $NoticeBoardXrefId;
                    $this->NoticeBoardXref->saveField("IS_READ",1);

                    $message = 'You have successfully read this notice';
                    $status = true;

                }

            }
            else
            {
                $message = 'Oppps Something Wrong!';
                $status = false;
            }
        }

        $result_array = array(
            'status' => $status,
            'message' => $message,
        );

        echo json_encode($result_array); die;

    }

    public function App_UnreadNoticeCount()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;

        if(!empty($this->request->data))
        {
            $data = $this->request->data;
            $ToId = $data['TO_ID'];

            if(isset($ToId) && !empty($ToId))
            {
                $this->NoticeBoardXref = ClassRegistry::init('NoticeBoardXref');

                $NoticeBoard = $this->NoticeBoardXref->find('count', array(
                    'contain' => array(),
                    'conditions' => array('TO_ID' => $ToId, 'IS_READ' => 0),
                ));

                if(isset($NoticeBoard) && !empty($NoticeBoard))
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
                $status = false;
            }
        }
        else
        {
            $status = false;
        }

        $result_array = array(
            'status' => $status,
            'data' => $NoticeBoard,
        );

        echo json_encode($result_array); die;

    }
    
    
}