<?php
// app/Controller/UsersController.php
class StaffUploadDocumentController extends AppController
      
{
    var $name = 'StaffUploadDocument'; 
 
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
	
	public function admin_index($id = null)
    {
		$conditions = '';
		$this->User = ClassRegistry::init('User');
			$rdata = $this->User->find('first',array(
				'contain' => array(),
				'conditions' => array('User.ID' =>$id),
			));
			
			if((isset($id)) && ($id)>0)
				{
					$conditions['StaffUploadDocument.USER_ID'] = $id;
					$conditions['StaffUploadDocument.ROLE_ID'] = $rdata['User']['ROLE_ID'];
				}

		
        $this->layout = 'admin_form_layout';
        $this->StaffUploadDocument->recursive = 0;
        $this->paginate = array(
            'conditions' => $conditions ,
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'StaffUploadDocument.ROLE_ID ASC'
        );
		/*PR($this->paginate('StaffUploadDocument'));
		die;*/
		
		
		$roles = $this->StaffUploadDocument->Role->GetRoles();
        $this->set('user_roles', $roles);
		

        $this->set('StaffUploadDocument', $this->paginate('StaffUploadDocument'));
		
		 
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
            $this->StaffUploadDocument->set($this->request->data);
            if ($this->StaffUploadDocument->Validation()) {
                $this->StaffUploadDocument->create();

				 $d = '';
                if(isset($this->request->data["StaffUploadDocument"]["UPLOAD_DOC"]["size"]) && $this->request->data["StaffUploadDocument"]["UPLOAD_DOC"]["size"] >0) {
                    $d = $this->request->data["StaffUploadDocument"]["UPLOAD_DOC"];
                    unset($this->request->data["StaffUploadDocument"]["UPLOAD_DOC"]);
                }
				
                if ($this->StaffUploadDocument->save($this->request->data)) {
					
					$this->Users = ClassRegistry::init('Users');
						$abc = $this->Users->find('first', array(
								'contain' => array(),
								'conditions' => array('ID' => $Id)
							));
							
		
					$this->request->data['StaffUploadDocument']['USER_ID'] = $Session_data['ID'];
					$this->StaffUploadDocument->saveField("created_by",$Session_data['ID']);
					
					
					
					$ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
					$this->StaffUploadDocument->saveField("created_ip",$ip);
                   	
					$path = WWW_ROOT . "/files/staff_document/";
					$fname = 'DOC'.strtotime(date('Y-m-d H:i:s')).'.zip';
					
					move_uploaded_file($d["tmp_name"],$path.$fname);

					$this->StaffUploadDocument->saveField("DOC_NAME",$fname);	
					
					$this->StaffUploadDocument->saveField("USER_ID",$Id);
					
					$this->StaffUploadDocument->saveField("PROOF_ID",$this->request->data['StaffUploadDocument']['PROOF_ID']);
					
					$this->StaffUploadDocument->saveField("ROLE_ID",$abc['Users']['ROLE_ID']);
					
                    $this->Session->setFlash('Document Upload Successfully!', 'message_good');
					
					 $this->redirect(array('controller' => 'StaffUploadDocument', 
					 'action' => 'index'));
                }
            } else {
                $this->Session->setFlash('Document Not Upload Please Try Again!', 'message_bad');
            }
        }
		$this->Users = ClassRegistry::init('Users');
			$abc = $this->Users->find('first', array(
                'contain' => array(),
                'conditions' => array('ID' => $Id)
            ));
			
			$role_id = $abc['Users']['ROLE_ID'];
			
				$this->SfaffDocumentChecklist = ClassRegistry::init('SfaffDocumentChecklist');
				$doc = $this->SfaffDocumentChecklist->find('all', array(
					'contain' => array(),
					'conditions' => array('ROLE_ID' => $role_id)
				));
				
				$type = array();
				$type[0] = 'Select Proof Type';
				foreach ($doc as $row) {
					$type[$row['SfaffDocumentChecklist']['DOC_CHE_ID']] = ucwords($row['SfaffDocumentChecklist']['PROOF_NAME']);
				}
				$type;
				
				$this->Role = ClassRegistry::init('Role');
				$role = $this->Role->find('first', array(
					'contain' => array(),
					'conditions' => array('ID' => $role_id)
				));
				
				//$role_name = $role['Role']['ROLE_NAME']
				
			$this->set('role_name',$role['Role']['ROLE_NAME']);
				
			 $this->set('type',$type);
				
			 $this->set('udocumaent',$abc);



      /*  $roles = $this->StaffUploadDocument->Role->GetRoles();
        $this->set('user_roles', $roles);*/
		
    }
	
	 public function admin_delete($Id = null)
    {
        $StaffUploadDocument = $this->StaffUploadDocument->find('first', array(
            'contain' => array(),
            'conditions' => array('UPL_DOC_ID' => $Id)
        ));

        $fileName = $StaffUploadDocument['StaffUploadDocument']['DOC_NAME'];

        $this->layout = 'admin_form_layout';
        if (!empty($Id)) {
            try {
                if ($this->StaffUploadDocument->delete($Id)) {

                    $this->General->delete_file("/files/upload_document/".$fileName);

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
	
	 public function admin_pending($id = null)
    {
		  $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		$this->User = ClassRegistry::init('User');
		$rdata = $this->User->find('first',array(
            'contain' => array(),
            'conditions' => array('User.ID' =>$id),
        ));
		
		if((isset($id)) && ($id)>0){
			$conditions['User.ID'] = $id;
			$conditions['User.ROLE_ID'] = $rdata['User']['ROLE_ID'];
		}else{
			$conditions = array('ROLE_ID !='=>'5');
		}
		
		$this->User = ClassRegistry::init('User');
		

		$ulist = $this->User->find('all', array(
            'contain' => array(''),
            'conditions' => $conditions,
			'fields' => array('ID', 'FIRST_NAME', 'MIDDLE_NAME', 'LAST_NAME', 'ROLE_ID'),
        ));
		
		
        	
		
	foreach ($ulist as $key => $value)
				{			
				 
					$this->SfaffDocumentChecklist = ClassRegistry::init('SfaffDocumentChecklist');
						$req[] =  $this->SfaffDocumentChecklist->find('count', array(
						'contain' => array('Role'),
						'conditions' => array('ROLE_ID'=>$value['User']['ROLE_ID'])
						));
						
				}
				
			$this->set('req',$req);
	 
	 foreach ($ulist as $key => $value)
				{
					$this->StaffUploadDocument = ClassRegistry::init('StaffUploadDocument');
						$sub[] =  $this->StaffUploadDocument->find('count', array(
						'contain' => array('Role'),
						'conditions' => array('USER_ID'=>$value['User']['ID'])
						));
				}

		$this->set('sub',$sub);
		
		
	
		$this->set('StaffUploadDocument',$ulist);	
		
		
		
	}

	
}
?>