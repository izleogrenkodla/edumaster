<?php
class StaffRegistrationController extends AppController
{ 
    var $name = 'StaffRegistration';

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
	
	
	  public function admin_index($id = Null)
     {
		
		if(isset($this->params->query["data"]["StaffRegistration"]) && is_array($this->params->query["data"]["StaffRegistration"])) {
            $post = $this->params->query["data"]["StaffRegistration"];
            if(isset($post["first_name"]) && $post["first_name"]!='') {
                $conditions['StaffRegistration.FIRST_NAME LIKE'] = '%'.$post["first_name"].'%';
            }
            if(isset($post["last_name"]) && $post["last_name"]!='') {
                $conditions['StaffRegistration.LAST_NAME LIKE'] = '%'.$post["last_name"].'%';
            }
            if(isset($post["email"]) && $post["email"]!='') {
                $conditions['StaffRegistration.EMAIL_ID'] = $post["email"];
            }
          
            if((isset($post["from_date"]) && $post["from_date"]!='') && (isset($post["to_date"]) && $post["to_date"]!='') ) {
                $conditions['StaffRegistration.created BETWEEN ? AND ?'] = array($this->General->datefordb($post["from_date"]),$this->General->datefordb($post["to_date"]));
            }
        }
		
		$rdata = $this->StaffRegistration->find('first',array(
            'contain' => array(),
            'conditions' => array('StaffRegistration.ID' =>$id),
        ));
		
		if((isset($id)) && ($id)>0)
			{
				$conditions['StaffRegistration.ID'] = $id;
				$conditions['StaffRegistration.ROLE_ID'] = $rdata['StaffRegistration']['ROLE_ID'];
			}
		

		 
        $Session = $this->Session->read('Auth.Admin');
		//$conditions = array('StaffRegistration.STATUS'=>1);
		
        $this->layout = 'admin_form_layout';
        $this->paginate = array(
            'conditions' => array(
			'StaffRegistration.STATUS'=>1,'StaffRegistration.ROLE_ID !='=>'5',$conditions),
            'Contain' => array(''),
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'StaffRegistration.created DESC'
        );
	
        $this->set('StaffRegistration', $this->paginate('StaffRegistration'));
		
		 $roles = $this->StaffRegistration->Role->GetRoles();
        $this->set('roles', $roles);
     }
	 
	 public function admin_add() {
		 
		 
		 $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		if($Session_data["ROLE_ID"]!=HR_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}
		
		 if ($this->request->is('post')) {
			 
			 
            $this->StaffRegistration->set($this->request->data);
            if ($this->StaffRegistration->Validation()) {
                $this->StaffRegistration->create();

                $img = '';
                if(isset($this->request->data["StaffRegistration"]["UPLOAD_IMAGE"]["size"]) && $this->request->data["StaffRegistration"]["UPLOAD_IMAGE"]["size"]>0) {
                    $img = $this->request->data["StaffRegistration"]["UPLOAD_IMAGE"];
                    unset($this->request->data["StaffRegistration"]["UPLOAD_IMAGE"]);
                }
				
				

                if ($this->StaffRegistration->save($this->request->data)) {
					
					$lastid =  $this->StaffRegistration->getLastInsertId();
					
					
					$first = $this->request->data["StaffRegistration"]["FIRST_NAME"];
					
					 $total_user = $this->User->find('count',array(
                        'contain' => array()
                    ));

                    $username = $this->GenerateTeacherUser($first,$total_user);
					
                  $password = $this->General->generate_password(6);
				  $hash_password = Security::hash($password, null, true);
				  
				  $this->send_mail($this->request->data['StaffRegistration'],$username,$password);

                
                    if(is_array($img) && $img["size"]>0) {

                        $extension = $img['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname = strtotime(date('Y-m-d H:i:s')).'.'.$ext[1];
                        move_uploaded_file($img["tmp_name"],$path.$fname);

                        $im = file_get_contents($path.$fname);
                        $imdata = base64_encode($im);


                        $this->StaffRegistration->saveField("IMAGE_URL",$fname);
                        $this->StaffRegistration->saveField("BASE_CODE",$imdata);
                    }
					
					$this->request->data['StaffRegistration']['DOB'] = $this->General->datefordb($this->request->data['StaffRegistration']['DOB']);
					
					$this->request->data['StaffRegistration']['USER_ID'] = $Session_data['ID'];
					$this->StaffRegistration->saveField("created_by",$Session_data['ID']);
					
					$ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
					$this->StaffRegistration->saveField("created_ip",$ip);
					
					 $this->StaffRegistration->saveField("DOB",$this->request->data['StaffRegistration']['DOB']);
					 
					  $this->StaffRegistration->saveField("USERNAME",$username);
					  $this->StaffRegistration->saveField("PASSWORD",$hash_password);
					  
					  
					  $this->request->data['StaffRegistration']['JOINING_DATE'] = $this->General->datefordb($this->request->data['StaffRegistration']['JOINING_DATE']);
					  $this->StaffRegistration->saveField("JOINING_DATE",$this->request->data['StaffRegistration']['JOINING_DATE']);
					  
					   $this->Outstanding = ClassRegistry::init('Outstanding');

                    //$admissionFee = isset($this->request->data["User"]["AMOUNT"])?$this->request->data["User"]["AMOUNT"]:'';

                    $Out['Outstanding'] = array(
                        'ROLE_ID' => $this->request->data["StaffRegistration"]["ROLE_ID"],
                        'USER_ID' => $lastid,
                        'BASE_SALARY' => $this->request->data["StaffRegistration"]["BASE_SALARY"],
                        'OUTSTANDING_AMOUNT' => '0',
                        'PAID_AMOUNT' => '0',
						'REMAINING_AMOUNT' => '0',
						'created_by' => $Session_data['ID'],
						'created_ip' => $ip,
						'STATUS' => '1',
						
						
                    );

                    $this->Outstanding->create();
                    $this->Outstanding->save($Out);
					  
                    $this->Session->setFlash('Registration Added Successfully!', 'message_good');
					
                    $this->redirect(array('controller'=>"StaffRegistration",
					'action' => 'index'));
					
                }
                else {
                    $this->Session->setFlash('Registration Not Added Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Registration Not Added Please Try Again!', 'message_bad');
            }
        }

		
		
        $CastCategories = $this->StaffRegistration->CastCategory->GetCastCategories();
        $this->set('CastCategories', $CastCategories);
		
	    $bloodgroups = $this->StaffRegistration->BloodGroup->GetBloodGroups();
        $this->set('bloodgroups', $bloodgroups);
		
	    $roles = $this->StaffRegistration->Role->GetRoles();
        $this->set('user_roles', $roles);
		
		$state = $this->StaffRegistration->State->GetStates();
        $this->set('state', $state);

        $cities = $this->StaffRegistration->City->GetCity();
        $this->set('cities', $cities);
		
		
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
	
	public function send_mail($post=array(),$username,$password) {
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
								   Select Type: <strong>[ROLE_TYPE]</strong><br />
								   
								   <br />
                                   You can login your account by clicking on below link <br />
                                   <a href="[LINK]">Login details </a>
                                    <br /><hr />
                                   </td>
                              </tr>
                              <tr>
                                <td style="text-align: left;"><em>Thanks,<br />
                                     [WEBSITE_NAME]<br />
                                     </em></td>
                              </tr>
                            </tbody>
                          </table></div>';

        $body = str_replace(
            array('[FULL_NAME]', '[USERID]', '[PASSWORD]', '[LINK]', '[WEBSITE_NAME]','[ROLE_TYPE]'),
            array($post['FIRST_NAME'].' '.$post['MIDDLE_NAME'].' '.$post['LAST_NAME'],                            $post['USERNAME'],$post['PASSWORD'],ADMIN_URL, WEBSITE_NAME,$role_name), $message);



        $subject = 'Thanks for Registering '.WEBSITE_NAME;

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
	
	public function admin_view($id = null)
    {
        $this->layout = 'admin_form_layout';
        $this->StaffRegistration->id = $id;

        if (empty($this->StaffRegistration->id)) {

            $this->Session->setFlash('Invalid user !', 'message_bad');
            $this->redirect(array('action' => 'index'));

        }

        $StaffRegistration = $this->StaffRegistration->read(null, $id);
		/*PR($StaffRegistration);
		die;*/

        if (empty($StaffRegistration)) {
            $this->Session->setFlash('Invalid user !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
        $this->request->data = $StaffRegistration;
		
        $CastCategories = $this->StaffRegistration->CastCategory->GetCastCategories();
        $this->set('CastCategories', $CastCategories);
		
	    $bloodgroups = $this->StaffRegistration->BloodGroup->GetBloodGroups();
        $this->set('bloodgroups', $bloodgroups);
		
	    $roles = $this->StaffRegistration->Role->GetRoles();
        $this->set('user_roles', $roles);
		
		$state = $this->StaffRegistration->State->GetStates();
        $this->set('state', $state);

        $cities = $this->StaffRegistration->City->GetCity();
        $this->set('cities', $cities);
		
    }
	
	 public function admin_edit($id = null)
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		if($Session_data["ROLE_ID"]!=HR_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}

        $this->StaffRegistration->id = $id;
        if (empty($this->StaffRegistration->id)) {
            $this->Session->setFlash('Invalid Registration !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        $img = '';
                if(isset($this->request->data["StaffRegistration"]["UPLOAD_IMAGE"]["size"]) && $this->request->data["StaffRegistration"]["UPLOAD_IMAGE"]["size"]>0) {
                    $img = $this->request->data["StaffRegistration"]["UPLOAD_IMAGE"];
                    unset($this->request->data["StaffRegistration"]["UPLOAD_IMAGE"]);
                }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->StaffRegistration->Validation()) {
                if ($this->StaffRegistration->save($this->request->data)) {


                    if(is_array($img) && $img["size"]>0) {

                        $extension = $img['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname = strtotime(date('Y-m-d H:i:s')).'.'.$ext[1];
                        move_uploaded_file($img["tmp_name"],$path.$fname);

                        $im = file_get_contents($path.$fname);
                        $imdata = base64_encode($im);


                        $this->StaffRegistration->saveField("IMAGE_URL",$fname);
                        $this->StaffRegistration->saveField("BASE_CODE",$imdata);
                    }
                    
                    $this->request->data['StaffRegistration']['DOB'] = $this->General->datefordb($this->request->data['StaffRegistration']['DOB']);
                    
                     $this->StaffRegistration->saveField("DOB",$this->request->data['StaffRegistration']['DOB']);

                     $this->request->data['StaffRegistration']['JOINING_DATE'] = $this->General->datefordb($this->request->data['StaffRegistration']['JOINING_DATE']);

                     $this->StaffRegistration->saveField("JOINING_DATE",$this->request->data['StaffRegistration']['JOINING_DATE']);


                    $this->Session->setFlash('Registration Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Registration Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Registration Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $StaffRegistration = $this->StaffRegistration->find('first', array(
                'contain' => array(),
                'conditions' => array('ID' => $id)
            ));
            if(empty($StaffRegistration)) {
                $this->Session->setFlash('Invalid Registration !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }

             $StaffRegistration['StaffRegistration']['DOB'] = date('d/m/Y', strtotime(str_replace('-','/',$StaffRegistration['StaffRegistration']['DOB'] )));
            $StaffRegistration['StaffRegistration']['JOINING_DATE'] = date('d/m/Y', strtotime(str_replace('-','/',$StaffRegistration['StaffRegistration']['JOINING_DATE'])));

            $this->request->data = $StaffRegistration;
        }

          $CastCategories = $this->StaffRegistration->CastCategory->GetCastCategories();
        $this->set('CastCategories', $CastCategories);
        
        $bloodgroups = $this->StaffRegistration->BloodGroup->GetBloodGroups();
        $this->set('bloodgroups', $bloodgroups);
        
        $roles = $this->StaffRegistration->Role->GetRoles();
        $this->set('user_roles', $roles);
        
        $state = $this->StaffRegistration->State->GetStates();
        $this->set('state', $state);

        $cities = $this->StaffRegistration->City->GetCity();
        $this->set('cities', $cities);
    }
  
 
}
?>