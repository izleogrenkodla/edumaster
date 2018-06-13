<?php
// app/Controller/UsersController.php
class MailerController extends AppController
{
    var $name = 'Mailer';

    public function beforeFilter()
    {
        parent::beforeFilter();

        if(isset($this->Security) &&  ($this->RequestHandler->isAjax() || $this->RequestHandler->isPost())){
            $this->Security->validatePost = false;
            $this->Security->enabled = false;
            $this->Security->csrfCheck = false;
        }
    }

    public function admin_index()
    {			
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
		// echo "<pre>";
		// print_r($this->request->data);
		// echo $this->request->data["Mailer"]["ROLE"];
		if(isset($this->request->data["Mailer"]["ROLE"]) && ($this->request->data["Mailer"]["ROLE"] == STUDENT_ID)){
			
			// echo "1";
			// exit();
			
			$disable = '';
			$this->set('disable', $disable);
			}else{
				
				// echo "2";
				// exit();
				
				$disable = 'disabled';
			$this->set('disable', $disable);
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
       
    }
	
	 public function admin_list(){		 
		
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
		
		$conditions = array();
        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
			
		 
		  if(isset($this->request->data["selected_users"])) {
			 
			 
			 

			 $user = $this->User->find('all',array(
            'limit' => PAGINATION_LIMIT_ADMIN,
			
            'conditions' => array('User.ID'=> $this->request->data["selected_users"])
            
        ));
		
		
		
		foreach($user as $emails){
			
		$email[] = $emails['User']['EMAIL_ID'];
		$user_id[] = $emails['User']['ID'];
		
		}
	
		
		$list =  rtrim(implode(',',$email),',');
		$user_id = implode(',',$user_id);
		$this->set('user', $list);
		$this->set('id', $user_id);
			
			
		}elseif(empty($this->request->data)){
			$this->Session->setFlash('Please make sure your file is less than '.ATTACHMENT_ALLOWED_SIZE.' MB.', 'message_bad');
			 $this->redirect(array('action' => 'index'));
		}elseif(($this->request->data["Mailer"]["EMAIL_ID"])){
			
			
			
			$files = $this->request->data["Mailer"]["UPLOAD_ATTACHMENT"];
			
			if(count($files)>0){
				
			
              foreach($files as $file){
				$size=$file['size'];
				
				 $path = UPLOADURL.UPLOAD_TEMP;
				 $attach[] = $file['name'];
				 
                  if(move_uploaded_file($file["tmp_name"],$path.$file['name'])){
					  
				  }
				 // echo $file['tmp_name'];
			  }
			}
             
			// PR($attach);die;
		
			$list = $this->request->data["Mailer"]["EMAIL_ID"];
			$ids = $this->request->data["ids"];
			$this->set('user', $list);
			$this->set('id', $ids);
			$this->Mailer->set($this->request->data);
            if ($this->Mailer->Validation()) {
				
                $this->Mailer->create();				
				$list = $this->request->data["Mailer"]["EMAIL_ID"];
				$this->set('user', $list);
				$ids = $this->request->data["ids"];
				$title = $this->request->data["Mailer"]["MAIL_TITLE"];
				$body = $this->request->data["Mailer"]["MAIL_BODY"];
				$ids = $this->request->data["ids"];
				
				$this->admin_send_mail_notification($list,$body,$title,$attach);
				$this->Mailer->saveField("USER_ID",$ids);
				$this->Mailer->saveField("MAIL_TITLE",$title);
				$this->Mailer->saveField("created_by",$Session_data['ID']);
				$ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
				$this->Session->setFlash('Mail Sent Successfully!', 'message_good');
				$this->redirect(array('action' => 'index'));
				
				
			}
		 }
		 elseif(!isset($this->request->data["Mailer"]["EMAIL_ID"])){
			$this->Session->setFlash('Please select users', 'message_bad');
			 $this->redirect(array('action' => 'index'));
		 }
		 elseif(!isset($id)){
			 $this->Session->setFlash('Please Update Email Ids for selected users', 'message_bad');
			 $this->redirect(array('action' => 'index'));
		 }
		 
			
}
		
	     public function admin_export_users() 
    {
        App::import('Vendor', 'Export', array('file' => 'Export' . DS . '/excel_xml.php'));
        $xls = new Excel_XML('UTF-8', false, 'Applicant Report');

        $report_column = array('Full Name','Email Address','Mobile No');
        $session_var = 'Filter_Event';
        $lists = $this->Session->read($session_var);
        $i = 0;
        foreach($lists as $list) {
            $events[0] = $report_column;
            $events[$i+1]  = array(
                $list["Mailer"]["FIRST_NAME"],
                $list["AcademicClass"]["CLASS_NAME"],
                $list["Mailer"]["EMAIL_ID"],
                
            );
            $i++;
        }

        $xls->addArray($events);
        $xls->generateXML('Event_'.date('d-m-Y'));
        $this->Session->delete($session_var);
        die;

    }
	 
	 
	 
	 
	 
		public function admin_send_mail_notification($email,$body,$title,$attach) {
		
		
			
        $mailing_list = $email;
        $mg_api = 'key-74be9f4872781161d12408795f411673';
        $mg_version = 'api.mailgun.net/v2/';
        $mg_domain = "sandbox0b14f0410b2a4555920843d785a10b10.mailgun.org";
        $mg_from_email = ADMIN_EMAIL;
        $mg_reply_to_email = ADMIN_EMAIL;
		//$files = DOWNLOADURL.'upload_document/test_file.attachment';
        $mg_message_url = "https://".$mg_version.$mg_domain."/messages";
		foreach($attach as $a){
		$attachment_link="@".UPLOADURL.UPLOAD_TEMP.$a;
		
		//echo $attachment_link;
		}
		
			
        
      
		if(!empty($a)){
        $postArr = array(
            'from'      => WEBSITE_NAME.' <' . $mg_from_email . '>',
            'to'        => ADMIN_EMAIL,
            'bcc'        => $email,
            'h:Reply-To'=>  ' <' . $mg_reply_to_email . '>',
            'subject'   =>$title ,
            'html'      => $body,
			'attachment[1]' =>$attachment_link
			
        );}else{
			 $postArr = array(
            'from'      => WEBSITE_NAME.' <' . $mg_from_email . '>',
            'to'        => ADMIN_EMAIL,
            'bcc'        => $email,
            'h:Reply-To'=>  ' <' . $mg_reply_to_email . '>',
            'subject'   =>$title ,
            'html'      => $body		
        );
			
		}
		
		// $postArr['attachment'] =  '';

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
		
		unlink(UPLOADURL.UPLOAD_TEMP.$a);
		
		
		
        curl_close($ch);
        return json_decode($result,TRUE);
			
           
		}
	

	public function admin_get(){
		$classes = $this->User->AcademicClass->GetAcademicClasses();
       //	print_r($classes);
	  
		    

		  echo '<select name="CLS"  class="form-control select2me">';
		foreach($classes as $key => $value):
			echo '<option value="' . htmlspecialchars($key) . '">' . htmlspecialchars($value) . '</option>';
		endforeach;
	   exit();
       
	}
	
	

   

  

}