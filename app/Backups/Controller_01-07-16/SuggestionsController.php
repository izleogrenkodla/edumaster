<?php
// app/Controller/UsersController.php
class SuggestionsController extends AppController
{
    var $name = 'Suggestions';

    public function beforeFilter()
    {
        parent::beforeFilter();

        $this->Auth->allow('App_AddSuggestions','App_ReferFriend');

        if(isset($this->Security) &&  ($this->RequestHandler->isAjax() || $this->RequestHandler->isPost())){
            $this->Security->validatePost = false;
            $this->Security->enabled = false;
            $this->Security->csrfCheck = false;
        }
    }
    
    public function admin_index($id = null)
    {
	$Session = $this->Session->read('Auth.Admin');
		$conditions = array();
		if((isset($id)) && ($id)>0)
			{
				$conditions['Suggestion.USER_ID'] = $id;
				//$conditions['LibraryFine.ROLE_ID'] = $rdata['LibraryFine']['ROLE_ID'];
			}
		 switch($Session["ROLE_ID"]) {
		 	case STUDENT_ID:
				$conditions['Suggestion.ROLE_ID']=$Session["ROLE_ID"];
				$conditions['Suggestion.USER_ID']=$Session["ID"];
			break;
			case TEACHER_ID:
				$conditions['Suggestion.ROLE_ID']=$Session["ROLE_ID"];
				$conditions['Suggestion.USER_ID']=$Session["ID"];
			break;
		 }
		 	
	/*$this->Suggestion->virtualFields = array(
		'created' => "DATE_FORMAT(Suggestion.created,'%d/%m/%Y %h:%i %p')"
	);*/
			
        $this->layout = 'admin_form_layout';
        $this->paginate = array(
            'limit' => PAGINATION_LIMIT_ADMIN,
	    'conditions'=>$conditions,
            'order' => 'Suggestion.created DESC'
        );

        $this->set('suggestions', $this->paginate('Suggestion'));
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
            $this->Suggestion->set($this->request->data);
            if ($this->Suggestion->Validation()) {
                $this->Suggestion->create();       
			 $user = $this->User->find('all',array(
            'limit' => PAGINATION_LIMIT_ADMIN,
            'conditions' => array('User.ID'=> $Session_data['ID'])
			  ));
			  foreach($user as $u){	  
				  //$user_id = $u['User']['USER_ID'];
				  $role = $u['User']['ROLE_ID'];
				  $fname = $u['User']['FIRST_NAME'];
				  $mname = $u['User']['MIDDLE_NAME'];
				  $lname = $u['User']['LAST_NAME'];
			  }
			  $msg = $this->request->data['Suggestion']['SUGGESTION_MESSAGE'];
			  $this->Suggestion->saveField("USER_ID",$Session_data['ID']);
			  $this->Suggestion->saveField("ROLE_ID",$role);
			  $this->Suggestion->saveField("FIRST_NAME",$fname);
			  $this->Suggestion->saveField("MIDDLE_NAME",$mname);
			  $this->Suggestion->saveField("LAST_NAME",$lname);
			  $this->Suggestion->saveField("SUGGESTION_MESSAGE",$msg);
			  $this->Session->setFlash('Suggestion Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }	
        }
	}
	 public function admin_view($ID = null)
    {
        $this->layout = 'admin_form_layout';
        $Suggestion = $this->Suggestion->find('first', array(
            'contain' => array('Role'),
            'conditions' => array('SUGGESTION_ID' => $ID)
        ));
	
		$this->set('Suggestion', $Suggestion);
    }
	
	public function send_mail_admin($post=array()) {
        $mailing_list = ADMIN_EMAIL;
        $mg_api = 'key-74be9f4872781161d12408795f411673';
        $mg_version = 'api.mailgun.net/v2/';
        $mg_domain = "sandbox0b14f0410b2a4555920843d785a10b10.mailgun.org";
        $mg_from_email = ADMIN_EMAIL;
        $mg_reply_to_email = ADMIN_EMAIL;
        $mg_message_url = "https://".$mg_version.$mg_domain."/messages";

        

        /////////////////////////////////////

        $message = '<div align="center">
                          <table cellspacing="5" cellpadding="5" border="0" width="600" style="background: none repeat scroll 0% 0% rgb(244, 244, 244); border: 1px solid rgb(102, 102, 102);">
                            <tbody>
                              <tr>
                                <td valign="top" style="text-align: left;">
                                   <br />
                                   Hello <strong>[FULL_NAME] </strong>,<br />
                                   <br />
                                   Suggestion has arrived as below:<br />
                                   <br />
                                   Sender Name: <strong>[SENDER_NAME]</strong><br />
                                   Role: <strong>[ROLE_NAME]</strong><br />
								   Message: <strong>[SUGGESTION]</strong><br />
								   
								   <br />
                                
                                   </td>
                              </tr>
                              <tr>
                                <td style="text-align: left;"><em>Thanks,<br />
                                    
                                     <a href="[URL]">[URL]</a></em></td>
                              </tr>
                            </tbody>
                          </table></div>';

        $body = str_replace(
            array('[FULL_NAME]', '[SENDER_NAME]', '[ROLE_NAME]', '[SUGGESTION]', '[URL]', '[WEBSITE_NAME]'),
            array(ADMIN_EMAIL_NAME,$post['Name'],$post['Role'],$post['message'],SITE_URL, SITE_URL, WEBSITE_NAME), $message);



        $subject = 'New suggestion arrived ';

        $postArr = array(
            'from'      => WEBSITE_NAME.' <' . $mg_from_email . '>',
            'to'        => ADMIN_EMAIL,
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

	public function send_mail_user($post=array()) {
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
        if(isset($post['ROLE_ID']) && $post['ROLE_ID']>0) {
            $role_name = $roles[$post['ROLE_ID']];
        }

        /////////////////////////////////////

        $message = '<div align="center">
                          <table cellspacing="5" cellpadding="5" border="0" width="600" style="background: none repeat scroll 0% 0% rgb(244, 244, 244); border: 1px solid rgb(102, 102, 102);">
                            <tbody>
                              <tr>
                                <th style="background-color: rgb(204, 204, 204);">Welcome to [WEBSITE_NAME] Thanks for Suggestion.</th>
                              </tr>
                              <tr>
                                <td valign="top" style="text-align: left;">
                                   <br />
                                   Hello <strong>[FULL_NAME] </strong>,<br />
                                   <br />
                                   We\'ve proceed your suggestion,  <br />
                                   <br />
                                   Our Team will contact you soon.
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
            array('[FULL_NAME]', '[URL]', '[WEBSITE_NAME]'),
            array($post['FIRST_NAME'].' '.$post['MIDDLE_NAME'].' '.$post['LAST_NAME'],SITE_URL, WEBSITE_NAME), $message);



        $subject = 'Thanks for Suggestion '.WEBSITE_NAME;

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
	
    public function App_AddSuggestions()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;

        if(!empty($this->request->data))
        {
            $this->Suggestion->create();
            foreach($this->request->data as $key=>$fields)
            {
                $this->request->data['Suggestion'][$key] = $fields;
				$this->Suggestion->save($this->request->data);
            }
	        
			$this->User = ClassRegistry::init('User');
			$user = $this->User->find('first',array(
					'contain'=>array("Role"),
					'fields'=>array('User.FIRST_NAME','User.MIDDLE_NAME','User.LAST_NAME','User.EMAIL_ID','Role.ROLE_NAME'),
					'conditions'=>array(
						'User.ID'=>$this->request->data['Suggestion']['USER_ID']
					),
				));
			if(is_array($user) && sizeof($user)>0) { 
				
				$this->send_mail_user($user["User"]);
				$array = array(
						"message"=> $this->request->data['Suggestion']['SUGGESTION_MESSAGE'],
						"Role"=>$user['Role']['ROLE_NAME'],
						"Name"=>$user['User']['FIRST_NAME'].' '.$user['User']['MIDDLE_NAME'].' '.$user['User']['LAST_NAME'],
				);
				$this->send_mail_admin($array);
			}
            $message = 'Your Suggestion Successfully sent to Admin';
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
    
    public function App_ReferFriend()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;

        if(!empty($this->request->data))
        {
            $fullName = $this->request->data['FIRST_NAME'].' '.$this->request->data['MIDDLE_NAME'].' '.$this->request->data['LAST_NAME'];
            $fromEmail = $this->request->data['EMAIL'];
            $toEmail = $this->request->data['TO_EMAIL'];

            $data = array(
                'FULL_NAME' => $fullName,
                'FROM_EMAIL' => $fromEmail,
                'TO_EMAIL' => $toEmail
            );

            $this->send_refer_mail($data);

            $message = 'Your Suggestion Successfully sent to your reference';
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
    
    public function send_refer_mail($post=array()) {
        $mg_api = 'key-74be9f4872781161d12408795f411673';
        $mg_version = 'api.mailgun.net/v2/';
        $mg_domain = "sandbox0b14f0410b2a4555920843d785a10b10.mailgun.org";
        $mg_from_email = $post['FROM_EMAIL'];
        $mg_reply_to_email = $post['FROM_EMAIL'];
        $mg_message_url = "https://".$mg_version.$mg_domain."/messages";

        /////////////////////////////////////

        $message = '<div align="center">
                          <table cellspacing="5" cellpadding="5" border="0" width="600" style="background: none repeat scroll 0% 0% rgb(244, 244, 244); border: 1px solid rgb(102, 102, 102);">
                            <tbody>
                              <tr>
                                <th style="background-color: rgb(204, 204, 204);">Welcome to [WEBSITE_NAME]</th>
                              </tr>
                              <tr>
                                <td valign="top" style="text-align: left;">
                                   <br />
                                   Hello Friend,<br />
                                   <br />
                                    I am using this awesome app [WEBSITE_NAME] and would like you to install it and explore.
                                    This app is extremely helpful to me as it stores all my school data from class attendance, leaves, date of fee submission, bus fees, and assignments to e-books.
                                    <br /><br />
                                    A teacher can manage his class-sections, time-table, registers, broadcast home-work and other notices to students which will be online as every student will be able to check it in their dashboard of [WEBSITE_NAME].
                                    <br /><br />
                                    This app is easy to use and I no more have to worry about keeping hard-copies safe & secure as everything is handy!
                                    <br /><br />
                                    Do try it once, I am sure you too will be delighted by its features.

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
            array('[FULL_NAME]', '[LINK]', '[URL]', '[WEBSITE_NAME]'),
            array($post['FULL_NAME'], SITE_URL, SITE_URL, WEBSITE_NAME), $message);



        $subject = 'Try it out '.WEBSITE_NAME;

        $postArr = array(
            'from'      => $post['FULL_NAME'].' <' . $mg_from_email . '>',
            'to'        => $post['TO_EMAIL'],
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

    }
}