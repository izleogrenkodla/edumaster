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

      public function admin_index()
    {
        $this->layout = 'admin_form_layout';
        $this->Classwork->recursive = 0;
		$Session_data = $this->Session->read('Auth.Admin');
		$conditions = array();
		$conditions["Classwork.STATUS"] = 1;
		$conditions["Classwork.CLASS_ID"] = $Session_data["CLASS_ID"];
		
		
       $lists = $this->Classwork->find('all', array(
			'contain' => array("User","Subject","AcademicClass"),
			'conditions' => array($conditions)
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
		
		$this->set('user_role', $Session_data["ROLE_ID"]);
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
            $this->Classwork->set($this->request->data);
            if ($this->Classwork->Validation()) {
				
				$today_dt = new DateTime(date("Y-m-d"));
				$expire_dt = new DateTime($this->General->datefordb($this->request->data["Classwork"]["CW_DATE"]));
				
				if(($expire_dt < $today_dt)) {
					$this->Session->setFlash('Invalid date selected. Please try again.!', 'message_bad');
					
				}else{
					$this->Classwork->create();
						$this->request->data["Classwork"]["TEACHER_ID"] = $Session_data['ID'];
						$this->request->data["Classwork"]["CW_DATE"] = $this->General->datefordb($this->request->data["Classwork"]["CW_DATE"]);
					if ($this->Classwork->save($this->request->data)) {
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

        $this->Classwork->id = $id;
        if (empty($this->Classwork->id)) {
            $this->Session->setFlash('Invalid Classwork!', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->Classwork->Validation()) {
				$this->request->data["Classwork"]["CW_DATE"] = $this->General->datefordb($this->request->data["Classwork"]["CW_DATE"]);
                if ($this->Classwork->save($this->request->data)) {
				
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

      
            $lists = $this->Classwork->find('all', array(
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
	

        $this->set('listing', $return);
    }

      public function admin_delete($Id = null)
    {
        $this->layout = 'admin_form_layout';
        if (!empty($Id)) {
            try {
				$this->Classwork->id = $Id;
				
                if ($this->Classwork->saveField("STATUS",0)) {
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