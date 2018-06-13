<?php
// app/Controller/UsersController.php
class VacancyReplayController extends AppController
{
    var $name = 'VacancyReplay'; 
 
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
        $this->layout = 'admin_form_layout';
        $this->VacancyReplay->recursive = 0;
        $this->paginate = array(
           // 'conditions' => array("Vacancy.STATUS"=>1),
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'VacancyReplay.created DESC'
        );

        $this->set('VacancyReplay', $this->paginate('VacancyReplay'));
    }
	
	 public function admin_stactive($id=null) {
        $AppAdmission = $this->VacancyReplay->find('first', array(
            'contain' => array(),
            'conditions' => array('VacancyReplay.REPLAY_ID' => $id)
        ));

        if(is_array($AppAdmission) && sizeof($AppAdmission)>0) {
            $this->VacancyReplay->id = $id;
            if($this->VacancyReplay->saveField('INQ_STATUS',1)) {
            
                $this->Session->setFlash('Inquiry has been updated.', 'message_good');
            }else{
                $this->Session->setFlash('Inquiry could not updated. Please try again.', 'message_bad');
            }
        }else{
            $this->Session->setFlash('Invalid request. Please try agian.', 'message_bad');
        }
	 
        $this->redirect(array('action' => 'VacancyReplay','action'=>"index"));
    }
	
	//===============
	 public function admin_streject($id=null) {
        $AppAdmission = $this->VacancyReplay->find('first', array(
            'contain' => array(),
            'conditions' => array('VacancyReplay.REPLAY_ID' => $id)
        ));

        if(is_array($AppAdmission) && sizeof($AppAdmission)>0) {
            $this->VacancyReplay->id = $id;
            if($this->VacancyReplay->saveField('INQ_STATUS',2)) {
			   
             $this->Session->setFlash('Inquiry has been updated.', 'message_good');
            }else{
                $this->Session->setFlash('Inquiry could not updated. Please try again.', 'message_bad');
            }
        }else{
            $this->Session->setFlash('Invalid request. Please try agian.', 'message_bad');
        }
	 
        $this->redirect(array('action' => 'VacancyReplay','action'=>"index"));
    }
	
	//=======
	
	
	 public function admin_sthold($id=null) {
        $AppAdmission = $this->VacancyReplay->find('first', array(
            'contain' => array(),
            'conditions' => array('VacancyReplay.REPLAY_ID' => $id)
        ));

        if(is_array($AppAdmission) && sizeof($AppAdmission)>0) {
            $this->VacancyReplay->id = $id;
            if($this->VacancyReplay->saveField('INQ_STATUS',3)) {
			   
             $this->Session->setFlash('Inquiry has been updated.', 'message_good');
            }else{
                $this->Session->setFlash('Inquiry could not updated. Please try again.', 'message_bad');
            }
        }else{
            $this->Session->setFlash('Invalid request. Please try agian.', 'message_bad');
        }
	 
        $this->redirect(array('action' => 'VacancyReplay','action'=>"index"));
    }
	
	
	public function inq_rejected($id) {
		 
		 $data = $this->VacancyReplay->find('first', array(
						'contain' => array(),
						'conditions' => array('REPLAY_ID' => $id)
					));
					
					
		
        $mailing_list = $data['VacancyReplay']['EMAIL_ID'];
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
                                <th style="background-color: rgb(204, 204, 204);">Welcome to [WEBSITE_NAME].</th>
                              </tr>
                              <tr>
                                <td valign="top" style="text-align: left;">
                                   <br />
                                   Hello <strong>[FULL_NAME] </strong>,<br />
                                   <br />
								   Your vacancy inquiry is rejected.<br />
                                   Please try again next time. <br />
                                   <br />
                                   
                                   
                                    <br /><hr />
                                   </td>
                              </tr>
                              <tr>
                                <td style="text-align: left;"><em>Thanks,<br />
                                     [WEBSITE_NAME]<br />
                                </td>
                              </tr>
                            </tbody>
                          </table></div>';

         $body = str_replace(
            array('[FULL_NAME]', '[LINK]', '[URL]', '[WEBSITE_NAME]'),
            array($data['VacancyReplay']['NAME'],SITE_URL, SITE_URL, WEBSITE_NAME), $message);

        $subject = WEBSITE_NAME.' - Job Inquiry';

        $postArr = array(
            'from'      => WEBSITE_NAME.' <' . $mg_from_email . '>',
            'to'        => $data['VacancyReplay']['EMAIL_ID'],
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
	
	public function inq_hold($id) {
		 
		 $data = $this->VacancyReplay->find('first', array(
						'contain' => array(),
						'conditions' => array('REPLAY_ID' => $id)
					));
					
					
		
        $mailing_list = $data['VacancyReplay']['EMAIL_ID'];
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
                                <th style="background-color: rgb(204, 204, 204);">Welcome to [WEBSITE_NAME].</th>
                              </tr>
                              <tr>
                                <td valign="top" style="text-align: left;">
                                   <br />
                                   Hello <strong>[FULL_NAME] </strong>,<br />
                                   <br />
								   
								   Your vacancy inquiry is currently on hold, and we will be in contact with you shortly to let you know the next stage of the recruitment process.
								 <br />
                                   . <br />
                                   <br />
                                   
                                   
                                    <br /><hr />
                                   </td>
                              </tr>
                              <tr>
                                <td style="text-align: left;"><em>Thanks,<br />
                                     [WEBSITE_NAME]<br />
                                </td>
                              </tr>
                            </tbody>
                          </table></div>';

         $body = str_replace(
            array('[FULL_NAME]', '[LINK]', '[URL]', '[WEBSITE_NAME]'),
            array($data['VacancyReplay']['NAME'],SITE_URL, SITE_URL, WEBSITE_NAME), $message);

        $subject = WEBSITE_NAME.' - Job Inquiry';

        $postArr = array(
            'from'      => WEBSITE_NAME.' <' . $mg_from_email . '>',
            'to'        => $data['VacancyReplay']['EMAIL_ID'],
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
	
	
	  public function admin_edit($id = null)
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        $this->VacancyReplay->id = $id;
        if (empty($this->VacancyReplay->id)) {
            $this->Session->setFlash('Invalid Replay !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->VacancyReplay->Validation()) {
				
				$status = $this->request->data['VacancyReplay']['INQ_STATUS'];
				
                if ($this->VacancyReplay->save($this->request->data)) {
					
					if($status == 1){
						$this->inq_selected($id);
						$msg = 'Your vacancy inquiry is selected.
                                   Please visit the school for interview.';
					}elseif($status == 2){
						$this->inq_rejected($id);
						$msg = 'Your vacancy inquiry is rejected.
                                   Please try again next time.';
					}elseif($status == 3){
						$this->inq_hold($id);
						$msg = 'Your vacancy inquiry is currently on hold, and we will be in contact with you shortly to let you know the next stage of the recruitment process.
								';
					}
					
					$data = $this->VacancyReplay->find('first', array(
						'contain' => array(),
						'conditions' => array('REPLAY_ID' => $id)
					));
					
					$name = $data['VacancyReplay']['NAME'];
					$mail = $data['VacancyReplay']['EMAIL_ID'];
					$apl = $data['VacancyReplay']['APPLY_FOR'];
					
					 $this->SendReplay = ClassRegistry::init('SendReplay');

                    //$admissionFee = isset($this->request->data["User"]["AMOUNT"])?$this->request->data["User"]["AMOUNT"]:'';

                    $FeeArr['SendReplay'] = array(
                        'NAME' => $name,
                        'EMAIL_ID' => $mail,
                        'APPLY_FOR' => $apl,
                        'INQ_STATUS' => $status,
                        'DESCRIPTION' => $this->request->data['VacancyReplay']['DESCRIPTION'],
						'MSG' => $msg,
                    );

                    $this->SendReplay->create();
                    $this->SendReplay->save($FeeArr);

                    $this->Session->setFlash('Replay Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Replay Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Replay Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $VacancyReplay = $this->VacancyReplay->find('first', array(
                'contain' => array(),
                'conditions' => array('REPLAY_ID' => $id)
            ));
            if(empty($VacancyReplay)) {
                $this->Session->setFlash('Invalid VacancyReplay !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
			
           $this->set('VacancyReplay',$VacancyReplay);
        }

	}
	
	 public function inq_selected($id) {
		 
		 $data = $this->VacancyReplay->find('first', array(
						'contain' => array(),
						'conditions' => array('REPLAY_ID' => $id)
					));
					
					
		
        $mailing_list = $data['VacancyReplay']['EMAIL_ID'];
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
                                <th style="background-color: rgb(204, 204, 204);">Welcome to [WEBSITE_NAME].</th>
                              </tr>
                              <tr>
                                <td valign="top" style="text-align: left;">
                                   <br />
                                   Hello <strong>[FULL_NAME] </strong>,<br />
                                   <br />
								   Your vacancy inquiry is selected.<br />
                                   Please visit the school for interview. <br />
                                   <br />
                                   
                                   
                                    <br /><hr />
                                   </td>
                              </tr>
                              <tr>
                                <td style="text-align: left;"><em>Thanks,<br />
                                     [WEBSITE_NAME]<br />
                                </td>
                              </tr>
                            </tbody>
                          </table></div>';

         $body = str_replace(
            array('[FULL_NAME]', '[LINK]', '[URL]', '[WEBSITE_NAME]'),
            array($data['VacancyReplay']['NAME'],SITE_URL, SITE_URL, WEBSITE_NAME), $message);

        $subject = WEBSITE_NAME.' - Job Inquiry';

        $postArr = array(
            'from'      => WEBSITE_NAME.' <' . $mg_from_email . '>',
            'to'        => $data['VacancyReplay']['EMAIL_ID'],
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
	
	
	
	
/*	public function admin_edit($id){
		   $this->layout = 'admin_form_layout';
		   
		    $AppAdmission = $this->VacancyReplay->find('first', array(
            'contain' => array(),
            'conditions' => array('VacancyReplay.REPLAY_ID' => $id)
			));
		
		$this->set('vac_rep',$AppAdmission);


	}*/
	
    
	
}
?>