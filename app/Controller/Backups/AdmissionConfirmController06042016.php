<?php
// app/Controller/UsersController.php
class AdmissionConfirmController extends AppController
{
    var $name = 'AdmissionConfirm'; 
 
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
	
	public function admin_index(){
		
		$this->StudentRegistration = ClassRegistry::init('StudentRegistration');
		  $this->layout = 'admin_form_layout';
          $this->paginate = array(
            'conditions' => array('INTERVIEW_RESULT'=>1),
            //'Contain' => array('Role','AcademicClass'),
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'StudentRegistration.created DESC'
        );
		

        $this->set('StudentRegistration', $this->paginate('StudentRegistration'));

	}
	
	 public function admin_edit($Id = null)
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');
		
	
        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
       // $this->AdmissionConfirm->id = $id;
        if ($this->request->is('post')) {
            $this->AdmissionConfirm->set($this->request->data);
            if ($this->AdmissionConfirm->Validation()) {
                $this->AdmissionConfirm->create();
		
                if ($this->AdmissionConfirm->save($this->request->data)) {
					
					$this->request->data['AdmissionConfirm']['USER_ID'] = $Session_data['ID'];
					$this->AdmissionConfirm->saveField("created_by",$Session_data['ID']);
					
					$this->AdmissionConfirm->saveField("AMOUNT",$this->request->data['AdmissionConfirm']['AMOUNT']);
					
					$ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
					$this->AdmissionConfirm->saveField("created_ip",$ip);
                   	
					$this->AdmissionConfirm->saveField("FORM_NO",$Id);
					
					
					$this->StudentRegistration = ClassRegistry::init('StudentRegistration');
					$abc = $this->StudentRegistration->find('first', array(
						'contain' => array(),
						'conditions' => array('FORM_NO' => $Id)
					));
					
					$lastid = $this->User->getLastInsertId();

                    $total_user = $this->User->find('count',array(
                        'contain' => array()
                    ));

                    $username = $this->GenerateTeacherUser($abc['StudentRegistration']['FIRST_NAME'],$total_user);
                  $password = $this->General->generate_password(6);
				  $hash_password = Security::hash($password, null, true);
				  
				  $this->Users = ClassRegistry::init('Users');
				 // $this->Users->find('count');
				 $no =  $this->Users->find('first', 
				  					  array('conditions' => array(), 
                               'order' => array('ID' => 'DESC') ));
				  
				$g_gr = $no['Users']['ID'] + 1;
				
				$exists = $this->Users->find('count', 
				  					  array('conditions' => array('GR_NO' => $g_gr)
                           ));
							   
				if($exists == 1)
				{
					$g_reg = $g_gr + 1;
					$gr = $this->chk_gr($g_reg);
					
				}else{
					$gr = $g_gr;
				}
				
				 $adm =  $this->AdmissionConfirm->find('first', 
				  					  array('conditions' => array(), 
                               'order' => array('ADM_ID' => 'DESC') ));
				  
				$admid = $adm['AdmissionConfirm']['ADM_ID'];
							   
				  

					 $data['Users'] = array(
                        'ROLE_ID' => 5,
                        'FIRST_NAME' => $abc['StudentRegistration']['FIRST_NAME'],
						'MIDDLE_NAME' => $abc['StudentRegistration']['MIDDLE_NAME'],
						'LAST_NAME' => $abc['StudentRegistration']['LAST_NAME'],
						'GENDER' => $abc['StudentRegistration']['GENDER'],
						'DOB' => $abc['StudentRegistration']['DOB'],
						'BIRTH_PLACE' => $abc['StudentRegistration']['BIRTH_PLACE'],
						'AGE' => $abc['StudentRegistration']['AGE'],
						'FATHER_NAME' => $abc['StudentRegistration']['FATHER_NAME'],
						'FATHER_OCCUPATION' => $abc['StudentRegistration']['FATHER_OCCUPATION'],
						'MOTHER_NAME' => $abc['StudentRegistration']['MOTHER_NAME'],
						'MOTHER_OCCUPATION' => $abc['StudentRegistration']['MOTHER_OCCUPATION'],
						'NATIONAL_LANGUAGE' => $abc['StudentRegistration']['NATIONAL_LANGUAGE'],
						'RELIGION' => $abc['StudentRegistration']['RELIGION'],
						'MOTHER_TONGUE' => $abc['StudentRegistration']['MOTHER_TONGUE'],
						'CAST' => $abc['StudentRegistration']['CAST'],
						'SUB_CAST' => $abc['StudentRegistration']['SUB_CAST'],
						'CAST_CAT_ID' => $abc['StudentRegistration']['CAST_CAT_ID'],
						'PASSWORD' => $hash_password,
						'BLOOD_GROUP_ID' => $abc['StudentRegistration']['BLOOD_GROUP_ID'],
						'CLASS_ID' => $abc['StudentRegistration']['ADM_CLASS_ID'],
						'MEDIUM_ID' => $abc['StudentRegistration']['ADM_MEDIUM_ID'],
						'EMAIL_ID' => $abc['StudentRegistration']['EMAIL_ID'],
						'CONTACT_NO' => $abc['StudentRegistration']['CONTACT_NO'],
						'MOBILE_NO' => $abc['StudentRegistration']['MOBILE_NO'],
						'USERNAME' => $username,
						'COUNTRY_ID' => $abc['StudentRegistration']['COUNTRY_ID'],
						'STATE_ID' => $abc['StudentRegistration']['STATE_ID'],
						'CITY_ID' => $abc['StudentRegistration']['CITY_ID'],
						'PINCODE' => $abc['StudentRegistration']['PINCODE'],
						'ADDRESS' => $abc['StudentRegistration']['ADDRESS'],
						'LAST_SCHOOL_NAME' => $abc['StudentRegistration']['LAST_SCHOOL_NAME'],
						'GR_NO' => $gr,
						'ADM_ID' => $admid,
						'LAST_BOARD' => $abc['StudentRegistration']['LAST_BOARD'],
						'LAST_MEDIUM_ID' => $abc['StudentRegistration']['LAST_MEDIUM_ID'],
						'LAST_CLASS_ID' => $abc['StudentRegistration']['LAST_CLASS_ID'],
						'LAST_PERCENTAGE' => $abc['StudentRegistration']['LAST_PERCENTAGE'],
						'EXTRA_ACTIVITIES' => $abc['StudentRegistration']['EXTRA_ACTIVITIES'],
						'GROUP' => $abc['StudentRegistration']['GROUP'],
						'FATHER_MOBILE' => $abc['StudentRegistration']['FATHER_MOBILE'],
						'FATHER_EMAIL' => $abc['StudentRegistration']['FATHER_EMAIL'],
						'MOTHER_MOBILE' => $abc['StudentRegistration']['MOTHER_MOBILE'],
						'MOTHER_EMAIL' =>$abc['StudentRegistration']['MOTHER_EMAIL'],
						
                    );

                    $this->Users->create();
                    $this->Users->save($data);
					
					$this->send_mail($Id,$password,$username);
					$admid = $this->AdmissionConfirm->getLastInsertId();
					
                    $this->Session->setFlash('Donation Fee Paid Successfully!', 'message_good');
                    $this->redirect(array('action' => 'receipt',$admid));
                }
            } else {
                $this->Session->setFlash('Donation Fee Paid Please Try Again!', 'message_bad');
            }
        }
		$this->StudentRegistration = ClassRegistry::init('StudentRegistration');
			$abc = $this->StudentRegistration->find('first', array(
                'contain' => array(),
                'conditions' => array('FORM_NO' => $Id)
            ));
			 $this->set('udocumaent',$abc);
	}
	
	public function admin_GetStatus($id = null){
		
		$total = $this->AdmissionConfirm->find('count',array(
                        'contain' => array(),
						'conditions' => array('FORM_NO'=>$id),
                    ));
		if($total == 1)
		{
			 return 1;
		}else{
			 return 0;
		}
		
	}
	
	
	 public function GenerateTeacherUser($name_letter,$total_user) {
        $FIRSTLETTER = substr($name_letter, 0, 3);
        $a = ($total_user+1).rand(0, 99);
        $username = str_pad($a, 6, STR_PAD_LEFT);
        $ids = $this->checkUniqueId($username, $total_user);
        if($ids != 0)
        {
            $username = $ids;
        }

        return strtoupper($FIRSTLETTER).$username;

    }
	
	 public function GeneratePassword($total_user) {
        $FIRSTLETTER = substr($name_letter, 0, 3);
        $a = ($total_user+1).rand(0, 99);
        $username = str_pad($a, 4, '0', STR_PAD_LEFT);
        $ids = $this->checkUniqueId($username, $total_user);
        if($ids != 0)
        {
            $username = $ids;
        }

        return strtoupper($FIRSTLETTER).$username;

    }
	
	  public function checkUniqueId($id = null, $no_user)
    {
		$this->Users = ClassRegistry::init('Users');
        $total_User = $this->User->find('count',array(
            'contain' => array(),
            'conditions' => array('User.USERNAME' =>$id),
        ));

        if($total_User == 0)
        {
            return $id;

        } else {
            $a = $no_user.rand(0, 99);
            $username = str_pad($a, 4, '0', STR_PAD_LEFT);
            $new_id = $this->checkUniqueId($username, $no_user);
            return $new_id;
        }
    }
	
	
	 public function send_mail($id,$password,$username) {
		 $role = 'Student';
		 $this->StudentRegistration = ClassRegistry::init('StudentRegistration');
					$abc = $this->StudentRegistration->find('first', array(
						'contain' => array(),
						'conditions' => array('FORM_NO' => $id)
					));

		 
        $mailing_list = $abc['StudentRegistration']['EMAIL_ID'];
		
        $mg_api = 'key-74be9f4872781161d12408795f411673';
        $mg_version = 'api.mailgun.net/v2/';
        $mg_domain = "sandbox0b14f0410b2a4555920843d785a10b10.mailgun.org";
        $mg_from_email = ADMIN_EMAIL;
        $mg_reply_to_email = ADMIN_EMAIL;
        $mg_message_url = "https://".$mg_version.$mg_domain."/messages";

        $this->Roles = ClassRegistry::init('Role');

        $roles = $this->Roles->GetRoles();

        $role_name = '';
        if(isset($abc['StudentRegistration']['ROLE_ID']) && $abc['StudentRegistration']['ROLE_ID']>0) {
            $role_name = $roles[$abc['StudentRegistration']['ROLE_ID']];
        }

        /////////////////////////////////////

        $message = '<div align="center">
                          <table cellspacing="5" cellpadding="5" border="0" width="600" style="background: none repeat scroll 0% 0% rgb(244, 244, 244); border: 1px solid rgb(102, 102, 102);">
                            <tbody>
                              <tr>
                                <th style="background-color: rgb(204, 204, 204);">Welcome to [WEBSITE_NAME] Thanks for Registering.</th>
                              </tr>
                              <tr>
                                <td valign="top" style="text-align: left;">
                                   <br />
                                   Hello <strong>[FULL_NAME] </strong>,<br />
                                   <br />
                                   You\'ve successfully registered with [WEBSITE_NAME] <br />Here are your Login Details. Please keep them safe.<br />
                                   <br />
                                   Username: <strong>'.$username.'</strong><br />
                                   Password: <strong>'.$password.'</strong><br />
								   Select Type: <strong>'.$role.'</strong><br />
								   
								   <br />
                                   You can login your account by clicking on below link <br />
                                   <a href="[LINK]">Login details </a>
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
            array('[FULL_NAME]', '[USERID]', '[PASSWORD]', '[LINK]', '[URL]', '[WEBSITE_NAME]','[ROLE_TYPE]'),
            array($abc['StudentRegistration']['FIRST_NAME'].' '.$abc['StudentRegistration']['MIDDLE_NAME'].' '.$abc['StudentRegistration']['LAST_NAME'],$abc['StudentRegistration']['USERNAME'],$abc['StudentRegistration']['PASSWORD'],SITE_URL, SITE_URL, WEBSITE_NAME,$role_name), $message);



        $subject = 'Thanks for Registering '.WEBSITE_NAME;

        $postArr = array(
            'from'      => WEBSITE_NAME.' <' . $mg_from_email . '>',
            'to'        => $abc['StudentRegistration']['EMAIL_ID'],
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

	public function admin_receipt($id= null){
		
		//$lastid = $this->AdmissionConfirm->getLastInsertId();
		/*echo $id;
		die;*/
		$this->layout = 'admin_form_layout';
        $AdmissionConfirm = $this->AdmissionConfirm->find('first', array(
            //'contain' => array(''),
            'conditions' => array('AdmissionConfirm.ADM_ID' => $id)
        ));
		/*echo '<pre>';
		print_r($data);
		die;*/

        $this->set('AdmissionConfirm', $AdmissionConfirm);
		
		 $this->StudentRegistration = ClassRegistry::init('StudentRegistration');
		 $data = $this->StudentRegistration->find('first', array(
            //'contain' => array(''),
            'conditions' => 
		array('StudentRegistration.FORM_NO' => $AdmissionConfirm['AdmissionConfirm']['FORM_NO'])
        ));
		
		$this->set('data', $data);
		
		$this->School = ClassRegistry::init('School');
		 $school = $this->School->find('first', array(
            //'contain' => array(''),
            'conditions' => array(),
        ));
		
		$this->set('school', $school);
	}
	
	public function chk_gr($g_reg){
		
		$exists01 = $this->Users->find('count', 
				  					  array('conditions' => array('GR_NO' => $g_reg)
                           ));	 
						   
		if($exists01 == 1)
		{
			$id = $g_reg + 1;
			return $this->chk_gr($id);
		}else{
			return $g_reg;
		}
						   
		
	}

}
?>