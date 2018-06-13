<?php
class UploaddocumentController extends AppController 
{ 
    var $name = 'Uploaddocument';
	  
    public function beforeFilter()
    {
		$this->Auth->allow('');
        parent::beforeFilter();
        $this->Auth->allow('');
        if(isset($this->Security) &&  ($this->RequestHandler->isAjax() || $this->RequestHandler->isPost())){
            $this->Security->validatePost = false;
            $this->Security->enabled = false;
            $this->Security->csrfCheck = false;
        }
    }
	
	public function admin_index($id = null)
    {		
		$sessionData = $this->Session->read('Auth.Admin');
		
		$conditions = '';		
		
		$abc = null;	
			
		if((isset($id)) && ($id)>0)
			{
				$abc = $id;
			}else {
				 /*$this->User->id = $sessionData['ID'];
				 $abc = $sessionData['ID'];*/
		}
		
		 $std_name = $this->Uploaddocument->AppAdmission->GetName();
         $this->set('student', $std_name);
		
		if((isset($abc)) && ($abc)>0)
		{
			$conditions['Uploaddocument.USER_ID'] = $abc;			
		}
		
		$conditions = array('Uploaddocument.STATUS'=>1);
        $this->layout = 'admin_form_layout';
        $this->paginate = array(
            'conditions' => $conditions,
            'Contain' => array(),
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'uploaddocument.created DESC'
        );
		
        $this->set('udocumaent', $this->paginate('Uploaddocument'));
    }
	
	
	    public function admin_add($Id = null)
    {	
       $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('post')) {
            $this->Uploaddocument->set($this->request->data);
            if ($this->Uploaddocument->Validation()) {
                $this->Uploaddocument->create();

				 $d = '';
                if(isset($this->request->data["Uploaddocument"]["UPLOAD_DOC"]["size"]) && $this->request->data["Uploaddocument"]["UPLOAD_DOC"]["size"] >0) {
                    $d = $this->request->data["Uploaddocument"]["UPLOAD_DOC"];
                    unset($this->request->data["Uploaddocument"]["UPLOAD_DOC"]);
                }
				
                if ($this->Uploaddocument->save($this->request->data)) {
					
					$this->StudentRegistration = ClassRegistry::init('StudentRegistration');
		$abc = $this->StudentRegistration->find('first', array(
                'contain' => array(),
                'conditions' => array('FORM_NO' => $Id)
            ));

					$this->request->data['Uploaddocument']['USER_ID'] = $Session_data['ID'];
					$this->Uploaddocument->saveField("CREATED_BY",$Session_data['ID']);
					
					$this->Uploaddocument->saveField("STATUS",$this->request->data['Uploaddocument']['STATUS']);
					
					$ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
					$this->Uploaddocument->saveField("created_ip",$ip);
                   	
					/*$path = WWW_ROOT . "/files/student_document/";
					$fname = 'DOC'.strtotime(date('Y-m-d H:i:s')).'.zip';*/
					
					$unique_id = uniqid();
					$path = UPLOADURL."student_document/";
					$up_doc_ext_arr = explode(".",$d['name']);
					$up_doc_ext = end($up_doc_ext_arr);
					if(isset($up_doc_ext) && $up_doc_ext != "")
					{	
					$fname = strtotime(date('Y-m-d H:i:s')).$unique_id.".".$up_doc_ext;
					}
					else
					{
					$fname = $d['name'];
					}					
					
					move_uploaded_file($d["tmp_name"],$path.$fname);

					$this->Uploaddocument->saveField("DOC_NAME",$fname);	
					
					$this->Uploaddocument->saveField("INQUIRY_ID",$Id);
					
                    $this->Session->setFlash('Document Upload Successfully!', 'message_good');
					
					 $this->redirect(array('controller' => 'StudentRegistration', 'action' => 'index'));
                }
            } else {
                $this->Session->setFlash('Document Not Upload Please Try Again!', 'message_bad');
            }
        }
		$this->StudentRegistration = ClassRegistry::init('StudentRegistration');
			$abc = $this->StudentRegistration->find('first', array(
                'contain' => array(),
                'conditions' => array('FORM_NO' => $Id)
            ));
			
			 $this->set('udocumaent',$abc);
			

        $name = $this->Uploaddocument->AppAdmission->GetName();
        $this->set('name', $name);
		
		

    }
	
	 public function admin_delete($Id = null)
    {
		
		$Data = $this->Uploaddocument->find('first', array(
            'contain' => array(),
            'conditions' => array('UPLOAD_DOC_ID' => $Id)
        ));

        $fileName = $Data['Uploaddocument']['DOC_NAME'];
        $this->layout = 'admin_form_layout';
        if (!empty($Id)) {
            try {
                if ($this->Uploaddocument->delete($Id)) {
					$this->General->delete_file("/files/student_document/".$fileName);
                    $this->Session->setFlash('Document is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid Document.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }
	
	 public function admin_edit($id = null)
    {
        $this->layout = 'admin_form_layout';
        $this->Uploaddocument->id = $id;
        if (empty($this->Uploaddocument->id)) {
            $this->Session->setFlash('Invalid Document !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Uploaddocument->edit_Validation()) {
               
                $d = '';
                if(isset($this->request->data["Uploaddocument"]["UPLOAD_DOC"]["size"]) && $this->request->data["Uploaddocument"]["UPLOAD_DOC"]["size"] >0) {
                    $d = $this->request->data["Uploaddocument"]["UPLOAD_DOC"];
                    unset($this->request->data["Uploaddocument"]["UPLOAD_DOC"]);
                }

                if ($this->Uploaddocument->save($this->request->data)) {

                    $UserData = $this->Uploaddocument->find('first',array(
                        'contain' => array(),
                        'conditions' => array('UPLOAD_DOC_ID' => $id),
                    ));
					
					$this->Uploaddocument->saveField("INQUIRY_ID",$this->request->data['Uploaddocument']['INQUIRY_ID']);
					
					$this->Uploaddocument->saveField("STATUS",$this->request->data['Uploaddocument']['STATUS']);
					
					$ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
					$this->Uploaddocument->saveField("created_ip",$ip);
					
                    /*$path = WWW_ROOT . "/files/student_document/";
					$fname = 'DOC'.strtotime(date('Y-m-d H:i:s')).'.zip';*/
					
					$unique_id = uniqid();
					$path = UPLOADURL."student_document/";
					$up_doc_ext_arr = explode(".",$d['name']);
					$up_doc_ext = end($up_doc_ext_arr);
					if(isset($up_doc_ext) && $up_doc_ext != "")
					{	
					$fname = strtotime(date('Y-m-d H:i:s')).$unique_id.".".$up_doc_ext;
					}
					else
					{
					$fname = $d['name'];
					}
					
					move_uploaded_file($d["tmp_name"],$path.$fname);
					
					$Data = $this->Uploaddocument->find('first', array(
                            'contain' => array(),
                            'conditions' => array('UPLOAD_DOC_ID' => $id)
                        ));

                       $fileName = $Data['Uploaddocument']['DOC_NAME'];
				
					if($fileName != '')
					{
						$this->General->delete_file("/files/student_document/".$fileName);
					}
						
					$this->Uploaddocument->saveField("DOC_NAME",$fname);	
					
                    $this->Session->setFlash('Document Updated Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Document Not Added Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Document Not Added Please Try Again!', 'message_bad');
            }
        } else {
            $user = $this->Uploaddocument->read(null, $id);

            if (empty($user)) {
                $this->Session->setFlash('Invalid Document !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $user;
           
        }

         $name = $this->Uploaddocument->AppAdmission->GetName();
        $this->set('name', $name);

    }
	
	public function admin_list(){
		$this->StudentRegistration = ClassRegistry::init('StudentRegistration');
		
        $this->layout = 'admin_form_layout';
       // $this->StudentRegistration->recursive = 0;
        $this->paginate = array(
            'conditions' => $conditions,
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'StudentRegistration.created DESC'
        );
		$this->set('StudentRegistration', $this->paginate('StudentRegistration'));
	
		
	}
	
	
	 public function admin_Getdownload($id = null)
    {
		$total = $this->Uploaddocument->find('count',array(
                        'contain' => array(),
						'conditions' => array('INQUIRY_ID'=>$id),
                    ));
		if($total == 1)
		{
			 return 1;
		}else{
			 return 0;
		}
	}
	
	
	
	
}
?>