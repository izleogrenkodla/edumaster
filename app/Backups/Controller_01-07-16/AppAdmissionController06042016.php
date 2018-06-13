<?php
// app/Controller/UsersController.php
class AppAdmissionController extends AppController
{
    var $name = 'AppAdmission';

    public function beforeFilter()
    {
        parent::beforeFilter();

        $this->Auth->allow('App_Addmission');

        if(isset($this->Security) &&  ($this->RequestHandler->isAjax() || $this->RequestHandler->isPost())){
            $this->Security->validatePost = false;
            $this->Security->enabled = false;
            $this->Security->csrfCheck = false;
        }
    }
	
	//===============
	
	 public function inq_approv($id) {
		 
		 $data = $this->AppAdmission->find('first', array(
						'contain' => array(),
						'conditions' => array('INQUIRY_ID' => $id)
					));
					
					
					
		$this->Document = ClassRegistry::init('Document');
		
		$conditions = array('CLASS_ID' => $data['AppAdmission']['CLASS_ID'],'MEDIUM_ID' => $data['AppAdmission']['MEDIUM_ID'],'STATUS' => 1);
		
		 $doc = $this->Document->find('all', array(
						'contain' => array(),
						'conditions' => $conditions,
					));

			if(sizeof($doc)>0) {
						foreach ($doc as $key => $value)
						{	
							 $offerArray[$key] = $value['Document']['DOC_NAME'];
							//echo $key . "->" . $value['Document']['DOC_NAME'];
							//echo $key;
							//$a = array($value['Document']['DOC_NAME']);
							//echo '<br>';
							
						}
					
				}
				else{
					echo 'Document Not Available';
				}
				
				$che = (implode('<br>',$offerArray));
				//echo '<pre>';
				//print_r($offerArray);
				//echo $offerArray[0];
				
				//	die;
        $mailing_list = $data['AppAdmission']['EMAIL'];
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
                                   Please visit the school with below given documents for admission process. <br />
                                   <br />
                                   [KEY]
								   
								   <br />
                                   
                                    <br /><hr /><br />
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
            array('[FULL_NAME]','[KEY]', '[LINK]', '[URL]', '[WEBSITE_NAME]'),
            array($data['AppAdmission']['STUDENT_NAME'],$che,SITE_URL, SITE_URL, WEBSITE_NAME), $message);

        $subject = WEBSITE_NAME.' - Admission Inquiry';

        $postArr = array(
            'from'      => WEBSITE_NAME.' <' . $mg_from_email . '>',
            'to'        => $data['AppAdmission']['EMAIL'],
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
	
	
	 public function inq_reject($id) {
		 
		 $abc = $this->AppAdmission->find('first', array(
						'contain' => array(),
						'conditions' => array('INQUIRY_ID' => $id)
					));
					
        $mailing_list = $abc['AppAdmission']['EMAIL'];
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
                                <th style="background-color: rgb(204, 204, 204);">[WEBSITE_NAME] - Admission Inquiry</th>
                              </tr>
                              <tr>
                                <td valign="top" style="text-align: left;">
                                   <br />
                                   Hello <strong>[FULL_NAME] </strong>,<br />
                                   <br />
                                   Your Inquiry is not related to admission process.<br /> If you have any query regarding admission process then please send admission inquiry again. <br />
                                  <br /><hr />
                              </tr>
                           	    <td style="text-align: left;"><em>Thanks,<br />
                                     [WEBSITE_NAME]<br />
                                </td>
                            </tbody>
                          </table></div>';
						  
		$subject = WEBSITE_NAME.' - Admission Inquiry';

       $body = str_replace(
            array('[FULL_NAME]', '[LINK]', '[URL]', '[WEBSITE_NAME]'),
            array($abc['AppAdmission']['STUDENT_NAME'],SITE_URL, SITE_URL, WEBSITE_NAME), $message);


      

        $postArr = array(
            'from'      => WEBSITE_NAME.' <' . $mg_from_email . '>',
            'to'        => $abc['AppAdmission']['EMAIL'],
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
	
	
	

	
	//============
	 public function admin_stactive($id=null) {
        $AppAdmission = $this->AppAdmission->find('first', array(
            'contain' => array(),
            'conditions' => array('AppAdmission.INQUIRY_ID' => $id)
        ));

        if(is_array($AppAdmission) && sizeof($AppAdmission)>0) {
            $this->AppAdmission->id = $id;
            if($this->AppAdmission->saveField('INQ_STATUS',1)) {
				
				$this->inq_approv($id);
            
                $this->Session->setFlash('Inquiry has been updated.', 'message_good');
            }else{
                $this->Session->setFlash('Inquiry could not updated. Please try again.', 'message_bad');
            }
        }else{
            $this->Session->setFlash('Invalid request. Please try agian.', 'message_bad');
        }
	 
        $this->redirect(array('action' => 'AppAdmission','action'=>"index"));
    }
	
	//===============
	 public function admin_streject($id=null) {
        $AppAdmission = $this->AppAdmission->find('first', array(
            'contain' => array(),
            'conditions' => array('AppAdmission.INQUIRY_ID' => $id)
        ));

        if(is_array($AppAdmission) && sizeof($AppAdmission)>0) {
            $this->AppAdmission->id = $id;
            if($this->AppAdmission->saveField('INQ_STATUS',2)) {
				
               $this->inq_reject($id);
			   
             $this->Session->setFlash('Inquiry has been updated.', 'message_good');
            }else{
                $this->Session->setFlash('Inquiry could not updated. Please try again.', 'message_bad');
            }
        }else{
            $this->Session->setFlash('Invalid request. Please try agian.', 'message_bad');
        }
	 
        $this->redirect(array('action' => 'AppAdmission','action'=>"index"));
    }
	
	//=======
    
    public function admin_index()
    {
        $this->layout = 'admin_form_layout';
        $this->paginate = array(
            'conditions' => '',
            'Contain' => array(),
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'AppAdmission.created DESC'
        );
		
		 $classes = $this->AppAdmission->AcademicClass->GetAcademicClasses();
         $this->set('classes', $classes);
		
		 $mediums = $this->AppAdmission->Medium->GetMedium();
         $this->set('medium', $mediums);

        $this->set('inquiries', $this->paginate('AppAdmission'));
    }
	
	public function admin_add()
	{
		 $this->layout = 'admin_form_layout';
         $this->AppAdmission->id = $id;
		 
		 
        if ($this->request->is('post')) {
           $this->AppAdmission->set($this->request->data);
		/* echo '<pre>';
		  print_r ($this->request->data);die;*/
		 
            if ($this->AppAdmission->Validation()) {
                $this->AppAdmission->create();
				$sta = 0;
				$this->AppAdmission->saveField("INQ_STATUS",$sta);
				
                if ($this->AppAdmission->save($this->request->data)) {
                    $this->Session->setFlash('Inquiry Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
            } else {
                $this->Session->setFlash('Inquiry Not Added Please Try Again!', 'message_bad');
            }
        }
		 
		 $classes = $this->AppAdmission->AcademicClass->GetAcademicClasses();
         $this->set('classes', $classes);
		
		 $mediums = $this->AppAdmission->Medium->GetMedium();
         $this->set('medium', $mediums);
	}
    
    public function admin_view_inquiry($id = null)
    {
        $this->layout = 'admin_form_layout';
        $this->AppAdmission->id = $id;
		
        if (empty($this->AppAdmission->id)) {
		
            $this->Session->setFlash('Invalid Inquiry!', 'message_bad');
            $this->redirect(array('action' => 'index'));
			
        }

            $inquiry = $this->AppAdmission->read(null, $id);

            if (empty($inquiry)) {
                $this->Session->setFlash('Invalid Inquiry!', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $inquiry;
			
		$classes = $this->AppAdmission->AcademicClass->GetAcademicClasses();
         $this->set('classes', $classes);
		
		 $mediums = $this->AppAdmission->Medium->GetMedium();
         $this->set('medium', $mediums);

    }
    
    public function admin_delete($Id = null)
    {
        $this->layout = 'admin_form_layout';
        if (!empty($Id)) {
            try {
                if ($this->AppAdmission->delete($Id)) {
                    $this->Session->setFlash('AppAdmission is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid AppAdmission.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }
  
    public function App_Addmission()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;

        if(!empty($this->request->data))
        {
            $this->AppAdmission->create();
            foreach($this->request->data as $key=>$fields)
            {
                $this->request->data['AppAdmission'][$key] = $fields;
                $this->AppAdmission->save($this->request->data);
            }
            
            $mailing_list = $this->request->data['AppAdmission']['EMAIL'];
		$mg_api = 'key-74be9f4872781161d12408795f411673';
		$mg_version = 'api.mailgun.net/v2/';
		$mg_domain = "sandbox0b14f0410b2a4555920843d785a10b10.mailgun.org";
		$mg_from_email = "pm@nividaweb.com";
		$mg_reply_to_email = "pm@nividaweb.com";
		$mg_message_url = "https://".$mg_version.$mg_domain."/messages";
        
                    /////////////////////////////////////

                    $message = '<div align="center">
                          <table cellspacing="5" cellpadding="5" border="0" width="600" style="background: none repeat scroll 0% 0% rgb(244, 244, 244); border: 1px solid rgb(102, 102, 102);">
                            <tbody>
                              <tr>
                                <th style="background-color: rgb(204, 204, 204);">Thanks for interest .</th>
                              </tr>
                              <tr>
                                <td valign="top" style="text-align: left;">
                                   <br />
                                   Dear [STUDENT_NAME],<br />
                                   <br />
                                   Hello Chaitali
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
                        array('[STUDENT_NAME]','[WEBSITE_ADMIN]','[WEBSITE_NAME]'),
                        array($this->request->data['AppAdmission']['STUDENT_NAME'],'EDU Master Admin','EDU Master'));



                    $subject = 'Thank You for your interest in '.WEBSITE_NAME;

					
					$postArr = array(
						'from'      => 'Nivida <' . 'pm@nividaweb.com' . '>',
						'to'        => $this->request->data['AppAdmission']['EMAIL'],
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
					$res = json_decode($result,TRUE);
            
            
            
            
            $message = 'Your Admission Inquiry has been sent to Admin';
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
}