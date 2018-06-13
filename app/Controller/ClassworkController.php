<?php
// app/Controller/UsersController.php
class ClassworkController extends AppController
{
    var $name = 'Classwork';

    public function beforeFilter()
    {
        parent::beforeFilter();

        $this->Auth->allow('App_AddClasswork');

        if(isset($this->Security) &&  ($this->RequestHandler->isAjax() || $this->RequestHandler->isPost())){
            $this->Security->validatePost = false;
            $this->Security->enabled = false;
            $this->Security->csrfCheck = false;
        }
    }

      public function admin_index($id = null)
    {
        $this->layout = 'admin_form_layout';
        $this->Classwork->recursive = 0;
		$Session_data = $this->Session->read('Auth.Admin');
		
		$abc = null;
		
		if((isset($id)) && ($id)>0)
			{
				$abc = $id;
			}else {
				 $this->User->id = $Session_data['ID'];
				 $abc = $Session_data['ID'];
		}
		$user = $this->User->read(null, $abc);
		$sel_role_id=$user["User"]["ROLE_ID"];
		
		$conditions = array();
		$conditions["Classwork.STATUS"] = 1;
		//if($sel_role_id==STUDENT_ID || $sel_role_id==TEACHER_ID)
		if($sel_role_id==STUDENT_ID)	
		{
		//$conditions["Classwork.CLASS_ID"] = $Session_data["CLASS_ID"];
		$conditions["Classwork.CLASS_ID"] = $user["User"]["CLASS_ID"];
		}
		if($sel_role_id==TEACHER_ID)
		{		
		$conditions["Classwork.TEACHER_ID"] = $user["User"]["ID"];
		}	
		
		
		
       $lists = $this->Classwork->find('all', array(
			'contain' => array("User","Subject","AcademicClass"),
			'conditions' => array($conditions),
			'limit' => PAGINATION_LIMIT_ADMIN
		));
	
		if(empty($lists)) {
			$this->Session->setFlash('Invalid Classwork!', 'message_bad');
			//$this->redirect(array('action' => 'index'));
		}
		
		  
		$return = array();

		if(is_array($lists) && sizeof($lists)) { 
    		foreach ($lists as $k=>$list) { 
				$title = $list["User"]["FIRST_NAME"].' '.$list["User"]["MIDDLE_NAME"].' '.$list["User"]["LAST_NAME"].' [ '.$list["Subject"]["TITLE"].']';
		    	$return[] = array(
					"id"=>$list["Classwork"]["CW_ID"],
					"title"=>$title,
					"description"=>$list["Classwork"]["NARRATION"],
					"start"=>$list["Classwork"]["CW_DATE"],
					"end"=>$list["Classwork"]["CW_DATE"],
					"subject"=>$list["Subject"]["TITLE"],
					"cw_date"=>$this->General->dbfordate($list["Classwork"]["START_TIME"]),
					"start_time"=>date("H:i A",strtotime($list["Classwork"]["START_TIME"])),
					"end_time"=>date("H:i A",strtotime($list["Classwork"]["END_TIME"])),
					
				);
			}
		}
        $this->set('listing', $return);
		
		$this->set('Classwork', $lists);
		
		$this->set('user_role', $Session_data["ROLE_ID"]);
		
		
		 /*$this->layout = 'admin_form_layout';
        $this->Classwork->recursive = 0;
		$Session_data = $this->Session->read('Auth.Admin');
		$conditions = array();
		$conditions["Classwork.STATUS"] = 1;
		$conditions["Classwork.CLASS_ID"] = $Session_data["CLASS_ID"];
		$conditions["Classwork.TEACHER_ID"] = $Session_data["ID"];
		
		
		$this->paginate = array(
            'conditions' => $conditions,
            'contain' => array("User","Subject","AcademicClass"),
            'limit' => PAGINATION_LIMIT_ADMIN,
            //'order' => 'MonthDistribution.created DESC'
        );

		$this->set('Classwork', $this->paginate('Classwork'));*/
		
    }


    public function admin_add()
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		if($Session_data["ROLE_ID"]!=TEACHER_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}

        if ($this->request->is('post')) {
            $this->Classwork->set($this->request->data);
            if ($this->Classwork->Validation()) {
				
				$today_dt = new DateTime(date("Y-m-d"));
				$expire_dt = new DateTime($this->General->datefordb($this->request->data["Classwork"]["CW_DATE"]));
				
				if(($expire_dt < $today_dt)) {
					$this->Session->setFlash('Invalid date selected. Please try again.!', 'message_bad');
					
				}else{
					//$this->Classwork->create();
					
					$img = '';
					if(isset($this->request->data["Classwork"]["UPLOAD_IMAGE"]["size"]) && $this->request->data["Classwork"]["UPLOAD_IMAGE"]["size"]>0) {
						$img = $this->request->data["Classwork"]["UPLOAD_IMAGE"];
						unset($this->request->data["Classwork"]["UPLOAD_IMAGE"]);
					}
						$this->request->data["Classwork"]["TEACHER_ID"] = $Session_data['ID'];
						$this->request->data["Classwork"]["CW_DATE"] = $this->General->datefordb($this->request->data["Classwork"]["CW_DATE"]);
					if ($this->Classwork->save($this->request->data)) {
						
						$lastid = $this->Classwork->getLastInsertId();
						
					
						if(is_array($img) && $img["size"]>0) {

                        $extension = $img['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/homework_classwork/";
                        $fname = CW.strtotime(date('Y-m-d H:i:s')).$lastid.'.'.$ext[1];
                        move_uploaded_file($img["tmp_name"],$path.$fname);

                        $im = file_get_contents($path.$fname);
                        //$imdata = base64_encode($im);

                        $this->Classwork->id = $lastid;

                        $this->Classwork->saveField("IMAGE_URL",$fname);
                        //$this->User->saveField("BASE_CODE",$imdata);						
						
                    }
						
						$this->Session->setFlash('Classwork Added Successfully!', 'message_good');
						$this->redirect(array('action' => 'index'));
					}
				}
			} else {
				$this->Session->setFlash('Classwork Not Added Please Try Again!', 'message_bad');
			}
				
        }
		
       $AcademicClass =  $this->Classwork->AcademicClass->GetAcademicClasses();
	   $this->set('AcademicClass',$AcademicClass);
	   
       $Subject =  $this->Classwork->Subject->GetSubjects();
	   $this->set('Subject',$Subject);

    }

    public function admin_edit($id = null)
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		if($Session_data["ROLE_ID"]!=TEACHER_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}
		$this->Classwork->id = $id;
       
        if (empty($this->Classwork->id)) {
            $this->Session->setFlash('Invalid Classwork!', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
			
            if ($this->Classwork->Validation()) {
				
				$img = '';
					if(isset($this->request->data["Classwork"]["UPLOAD_IMAGE"]["size"]) && $this->request->data["Classwork"]["UPLOAD_IMAGE"]["size"]>0) {
						$img = $this->request->data["Classwork"]["UPLOAD_IMAGE"];
						unset($this->request->data["Classwork"]["UPLOAD_IMAGE"]);
					}
				
				$this->request->data["Classwork"]["CW_DATE"] = $this->General->datefordb($this->request->data["Classwork"]["CW_DATE"]);
                if ($this->Classwork->save($this->request->data)) {
					
						$UserData = $this->Classwork->find('first', array(
						'contain' => array(),
						'conditions' => array('CW_ID' => $id)
						));
				
						if(is_array($img) && $img["size"]>0) {

                        $extension = $img['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/homework_classwork/";
                        $fname = CW.strtotime(date('Y-m-d H:i:s')).$id.'.'.$ext[1];
                        move_uploaded_file($img["tmp_name"],$path.$fname);

                        $im = file_get_contents($path.$fname);
                        //$imdata = base64_encode($im);

                        $fileName = $UserData['Classwork']['IMAGE_URL'];

                        if($fileName != '')
                        {
                            $this->General->delete_file("/files/homework_classwork/".$fileName);
                        }
											
						
                        $this->Classwork->saveField("IMAGE_URL",$fname);
                        //$this->User->saveField("BASE_CODE",$imdata);
						
						/*echo "<pre>";
						print_r($fname);
						
						echo $this->General->getLastQuery();
						echo "111";
						die;
						
						die;*/
						
                    }
					
                    $this->Session->setFlash('Classwork Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
					
                } else {
                    $this->Session->setFlash('Classwork Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Classwork Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $Classwork = $this->Classwork->find('first', array(
                'contain' => array(),
                'conditions' => array('CW_ID' => $id)
            ));
            if(empty($Classwork)) {
                $this->Session->setFlash('Invalid Classwork!', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
			$Classwork["Classwork"]["CW_DATE"] = $this->General->dbfordate($Classwork["Classwork"]["CW_DATE"]);
            $this->request->data = $Classwork;
        }
		
		$AcademicClass =  $this->Classwork->AcademicClass->GetAcademicClasses();
	   $this->set('AcademicClass',$AcademicClass);
	   
       $Subject =  $this->Classwork->Subject->GetSubjects();
	   $this->set('Subject',$Subject);
    }
	
	public function admin_view($id = null)
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        $this->Classwork->id = $id;
        if (empty($this->Classwork->id)) {
            $this->Session->setFlash('Invalid Classwork!', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

      
            $lists = $this->Classwork->find('first', array(
                'contain' => array("User","Subject","AcademicClass"),
                'conditions' => array('CW_ID' => $id)
            ));
			
            if(empty($lists)) {
                $this->Session->setFlash('Invalid Classwork!', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
			
		  
		$return = array();

		if(is_array($lists) && sizeof($lists)) { 
    		foreach ($lists as $k=>$list) { 
				$title = $list["User"]["FIRST_NAME"].' '.$list["User"]["MIDDLE_NAME"].' '.$list["User"]["LAST_NAME"].' [ '.$list["Subject"]["TITLE"].']';
		    	$return[] = array(
					"id"=>$list["Classwork"]["CW_ID"],
					"title"=>$title,
					"description"=>$list["Classwork"]["NARRATION"],
					"start"=>$list["Classwork"]["CW_DATE"],
					"end"=>$list["Classwork"]["CW_DATE"],
					"subject"=>$list["Subject"]["TITLE"],
					"cw_date"=>$this->General->dbfordate($list["Classwork"]["START_TIME"]),
					"start_time"=>date("H:i A",strtotime($list["Classwork"]["START_TIME"])),
					"end_time"=>date("H:i A",strtotime($list["Classwork"]["END_TIME"])),
					
				);
			}
		}
	

        //$this->set('listing', $return);
		$this->set('listing', $lists);
    }

      public function admin_delete($Id = null)
    {
        $this->layout = 'admin_form_layout';
		
		$Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		if($Session_data["ROLE_ID"]!=TEACHER_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}
		
        if (!empty($Id)) {
            try {
				$this->Classwork->id = $Id;
				
				$UserData = $this->Classwork->find('first', array(
                'contain' => array(),
                'conditions' => array('CW_ID' => $Id)
				));
				
				
				$fileName = $UserData['Classwork']['IMAGE_URL'];

                        if($fileName != '')
                        {
                            $this->General->delete_file("/files/homework_classwork/".$fileName);
                        }
				
               if ($this->Classwork->delete($Id, false)) {
                    $this->Session->setFlash('Classwork is successfully deleted', 'message_good');
                   // $this->redirect(array('action' => 'index'));
                } else {
                  //  $this->redirect(array('action' => 'index'));
                    $this->Session->setFlash('Record was not deleted. Unknown error.', 'message_bad');
                }
            } catch (Exception $e) {
                $this->Session->setFlash("Delete failed. {$e->getMessage()}", 'message_bad');
               // $this->redirect(array('action' => 'index'));
            }
            //$this->redirect(array('action' => 'index'));
        } else {
            $this->Session->setFlash('Invalid Role.', 'message_bad');
          //  $this->redirect(array('action' => 'index'));
        }
        $this->redirect(array('action' => 'index'));
    }

    public function App_AddClasswork()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;

        if(!empty($this->request->data))
        {
            $this->Classwork->create();
            foreach($this->request->data as $key=>$fields)
            {
                $this->request->data['Classwork'][$key] = $fields;
                $this->Classwork->save($this->request->data);
            }
            $message = 'Your Classwork has been assigned';
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