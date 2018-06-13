<?php
// app/Controller/UsersController.php


class LibraryMemberController extends AppController
{
    var $name = 'LibraryMember';

    public function beforeFilter()
    {
        parent::beforeFilter();

        // $this->Auth->allow('App_UserTypes');

        if(isset($this->Security) &&  ($this->RequestHandler->isAjax() || $this->RequestHandler->isPost())){
            $this->Security->validatePost = false;
            $this->Security->enabled = false;
            $this->Security->csrfCheck = false;
        }
    }

    public function admin_index()
    {
		
		$conditions = array();
		
		if(isset($this->request->data["LibraryMember"]["GROUP_ID"]) && ($this->request->data["LibraryMember"]["GROUP_ID"])>0 &&
		isset($this->request->data["LibraryMember"]["ROLE_ID"]) && ($this->request->data["data"]["LibraryMember"]["ROLE_ID"])>0 &&
		isset($this->request->data["LibraryMember"]["CLASS_ID"]) && ($this->request->data["LibraryMember"]["CLASS_ID"])>0
		)
		{
			
			
			$group =$this->request->data["LibraryMember"]["GROUP_ID"];
			$role =$this->request->data["LibraryMember"]["ROLE_ID"];
			$class =$this->request->data["LibraryMember"]["CLASS_ID"];
			$conditions = array('LibraryMember.GROUP_ID' => $group,
					'LibraryMember.ROLE_ID' => $role,		
					'LibraryMember.CLASS_ID' => $class			
			);

			
		}
		elseif(isset($this->request->data["LibraryMember"]["GROUP_ID"]) && ($this->request->data["LibraryMember"]["GROUP_ID"])>0 &&
		isset($this->request->data["LibraryMember"]["ROLE_ID"]) && ($this->request->data["LibraryMember"]["ROLE_ID"])>0
		)
		{
			
			
			$group =$this->request->data["LibraryMember"]["GROUP_ID"];
			$role =$this->request->data["LibraryMember"]["ROLE_ID"];
			$conditions = array('LibraryMember.GROUP_ID' => $group,
					'LibraryMember.ROLE_ID' => $role			
			);

			
		}
		elseif(isset($this->request->data["LibraryMember"]["ROLE_ID"]) && ($this->request->data["LibraryMember"]["ROLE_ID"])>0 &&
		isset($this->request->data["LibraryMember"]["CLASS_ID"]) && ($this->request->data["LibraryMember"]["CLASS_ID"])>0
		)
		{
			
			
			$role =$this->request->data["LibraryMember"]["ROLE_ID"];
			$class =$this->request->data["LibraryMember"]["CLASS_ID"];
			$conditions = array('LibraryMember.ROLE_ID' => $role,
					'LibraryMember.CLASS_ID' => $class);
			
			
		}
		elseif(isset($this->request->data["LibraryMember"]["GROUP_ID"]) && ($this->request->data["LibraryMember"]["GROUP_ID"])>0)
		{
			
			
			$group =$this->request->data["LibraryMember"]["GROUP_ID"];
			$conditions = array('LibraryMember.GROUP_ID' => $group);

			
		}
		elseif(isset($this->request->data["LibraryMember"]["ROLE_ID"]) && ($this->request->data["LibraryMember"]["ROLE_ID"])>0)
		{
			
			
			$role =$this->request->data["LibraryMember"]["ROLE_ID"];
			$conditions = array('LibraryMember.ROLE_ID' => $role);

			
		}
		elseif(isset($this->request->data["LibraryMember"]["CLASS_ID"]) && ($this->request->data["LibraryMember"]["CLASS_ID"])>0)
		{
			
			
			$class =$this->request->data["LibraryMember"]["CLASS_ID"];
			$conditions = array('LibraryMember.CLASS_ID' => $class);

			
		}

		
		
        $this->layout = 'admin_form_layout';
        $this->LibraryMember->recursive = 0;
        $this->paginate = array(
            'conditions' => $conditions,
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'LibraryMember.created ASC'
        );
	// PR($this->paginate('LibraryMember'));
	// die;
		$this->loadModel('LibraryGroup');
		$librarygroup = $this->LibraryGroup->getLibraryGroup();
		$this->set('LibraryGroup',$librarygroup);
		$this->loadModel('Role');
		$roles = $this->Role->GetRoles();
		$this->set('roles',$roles);
		$this->loadModel('AcademicClass');
		$AcademicClass = $this->AcademicClass->GetAcademicClasses();
		$this->set('class',$AcademicClass);
		$this->loadModel('LibraryBook');
		$LibraryBook = $this->LibraryBook->GetLibraryBook();
		$this->set('LibraryBook',$LibraryBook);
        $this->set('IssueBook', $this->paginate('LibraryMember'));
		$status = array("[0]"=>"Select Status","[Issued]"=>"Issued","[Pending]"=>"Pending","[Returned]"=>"Returned");
		$this->set('status',$status);
    }

   public function admin_add()
    {	
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		if($Session_data["ROLE_ID"]!=LIBRARY_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}

        if ($this->request->is('post')) {
            $this->LibraryMember->set($this->request->data);
            if ($this->LibraryMember->Validation()) {
                $this->LibraryMember->create();
                if ($this->LibraryMember->save($this->request->data)) {
					if($this->request->data["LibraryMember"]["DATE"]!= "" ){
					$this->request->data["LibraryMember"]["DATE"] = $this->General->datefordb($this->request->data["LibraryMember"]["DATE"]);
					$this->LibraryMember->saveField("DATE",$this->request->data["LibraryMember"]["DATE"]);
					}
					
					$this->LibraryMember->saveField("DATE",$this->request->data["LibraryMember"]["DATE"]);
					
					
				
					
					
					
					
					
                    $this->Session->setFlash('Book Issued Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
                } else {
                $this->Session->setFlash('Book  Not Issued Please Try Again!', 'message_bad');
                }
        }
		$this->loadModel('LibraryGroup');
		$librarygroup = $this->LibraryGroup->getLibraryGroup();
		$this->set('LibraryGroup',$librarygroup);
		$this->loadModel('Role');
		$roles = $this->Role->GetRoles();
		$this->set('roles',$roles);
		$this->loadModel('AcademicClass');
		$AcademicClass = $this->AcademicClass->GetAcademicClasses();
		$this->set('class',$AcademicClass);
		$this->loadModel('LibraryBook');
		$LibraryBook = $this->LibraryBook->GetLibraryBook();
		$this->set('LibraryBook',$LibraryBook);

		
		
    }

    public function admin_edit($id = null)
     {	
		// PR($_POST);
		// die;
			
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		if($Session_data["ROLE_ID"]!=LIBRARY_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}

        $this->LibraryMember->id = $id;
        if (empty($this->LibraryMember->id)) {
            $this->Session->setFlash('Invalid LibraryMember !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
			
            if ($this->LibraryMember->Validation()) {
                if ($this->LibraryMember->save($this->request->data)) {
					
					
					if($this->request->data["LibraryMember"]["DATE"]!= "" ){
					$this->request->data["LibraryMember"]["DATE"] = $this->General->datefordb($this->request->data["LibraryMember"]["DATE"]);
					}
					if($this->request->data["LibraryMember"]["RETURN_DATE"]!= "" ){
					$this->request->data["LibraryMember"]["RETURN_DATE"] = $this->General->datefordb($this->request->data["LibraryMember"]["RETURN_DATE"]);
					}
					if($this->request->data['LibraryMember']['ROLE_ID'] != STUDENT_ID){
						$this->LibraryMember->saveField("CLASS_ID","");
						
					}else{
						$this->LibraryMember->saveField("CLASS_ID",$this->request->data['LibraryMember']['CLASS_ID']);
					}
					
					$this->LibraryMember->saveField("DATE",$this->request->data["LibraryMember"]["DATE"]);
					$this->LibraryMember->saveField("RETURN_DATE",$this->request->data["LibraryMember"]["RETURN_DATE"]);
					
					
					
                    $this->Session->setFlash('Book Issue Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Book Not Issued Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Book Not Issued Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $LibraryMember = $this->LibraryMember->find('first', array(
                'contain' => array(),
                'conditions' => array('MEMBER_ID' => $id)
            ));
            if(empty($LibraryMember)) {
                $this->Session->setFlash('Invalid LibraryMember !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
			if($LibraryMember['LibraryMember']['DATE'] === NULL){
				
			}else{
			$LibraryMember['LibraryMember']['DATE'] = date('d/m/Y', strtotime(str_replace('-','/',$LibraryMember['LibraryMember']['DATE'])));
			}
			
	
            $this->request->data = $LibraryMember;
        }
		$this->loadModel('LibraryGroup');
		$librarygroup = $this->LibraryGroup->getLibraryGroup();
		$this->set('LibraryGroup',$librarygroup);
		$this->loadModel('Role');
		$roles = $this->Role->GetRoles();
		$this->set('roles',$roles);
		$this->loadModel('AcademicClass');
		$AcademicClass = $this->AcademicClass->GetAcademicClasses();
		$this->set('class',$AcademicClass);
		$this->loadModel('LibraryBook');
		$books = $this->LibraryBook->GetLibraryBook();
		$this->set('books',$books);
		$this->loadModel('Users');
		if($LibraryMember['LibraryMember']['CLASS_ID']>0 && $LibraryMember['LibraryMember']['ROLE_ID']>0){
			$users = $this->getUsersByClassId($LibraryMember['LibraryMember']['CLASS_ID']);
			$croles = $LibraryMember['LibraryMember']['ROLE_ID'];
			
		}	
		else{
			$users = $this->getUsersByRoleId($LibraryMember['LibraryMember']['ROLE_ID']);
			$croles = $LibraryMember['LibraryMember']['ROLE_ID'];
			
			
		}
		
		
		$this->set('users',$users);
		$this->set('croles',$croles);
		
		

    }

    public function admin_delete($Id = null)
    {
        $this->layout = 'admin_form_layout';
		
		$Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		if($Session_data["ROLE_ID"]!=LIBRARY_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}
		
        if (!empty($Id)) {
            try {
                if ($this->LibraryMember->delete($Id)) {
                    $this->Session->setFlash('LibraryMember is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid LibraryMember.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }
	
	
	public function admin_getBooks(){
		
		$this->loadModel('LibraryBook');
		$bid = $this->request->data["bid"];
	
	
	
		$book = $this->LibraryBook->find('all',array(
				
            'conditions' => array('LibraryBook.CATEGORY_ID'=>$bid)
            
        ));
		
		echo "<div class='col-md-6'>
          <div class='form-group' >
		 <label class='control-label col-md-3'>Select Books<span class='required'>* </span></label>
         <div class='col-md-9'>
		<select name='BOOK_ID' id='books' class = 'form-control select2me'>";
		 echo "<option value='0'>Select Books</option>";
        foreach ($book as $b) {
            
			 echo "<option value='" . $b['LibraryBook']['BOOK_ID'] ."'>" . $b['LibraryBook']['BOOK_NAME'] ."</option>";
	
        }
		
		echo "</select></div></div></div>";
			
			
			
		die;
	}

	public function admin_getStudents(){
		
		$this->loadModel('Users');
		$sid = $this->request->data["sid"];
		$rid = $this->request->data["rid"];
	
	
	
		$book = $this->Users->find('all',array(
				
            'conditions' => array('Users.CLASS_ID'=>$sid,
							'Users.ROLE_ID'=>$rid
							)
            
        ));
		
		echo "<div class='col-md-6'>
          <div class='form-group' >
		 <label class='control-label col-md-3'>Select Students<span class='required'>* </span></label>
         <div class='col-md-9'>
		<select name='data[LibraryMember][USER_ID]' class = 'form-control select2me'>";
		 echo "<option value='0'>Select Students</option>";
        foreach ($book as $b) {
            
			 echo "<option value='" . $b['Users']['ID'] ."'>" . $b['Users']['FIRST_NAME'] ."  ".$b['Users']['LAST_NAME']."</option>";
	
        }
		
		echo "</select></div></div></div>";
			
			
			
		die;
	}
		public function admin_getOthers(){
		
		$this->loadModel('Users');
	
		$book = $this->Users->find('all',array('conditions' => array('Users.ROLE_ID'=>$sid)));
		
		echo "<div class='col-md-6'>
          <div class='form-group' >
		 <label class='control-label col-md-3'>Select User<span class='required'>* </span></label>
         <div class='col-md-9'>";
		 echo "<option value='0'>Select User</option>";
        foreach ($book as $b) {
            
			 echo "<option value='" . $b['Users']['ID'] ."'>" . $b['Users']['FIRST_NAME'] ."  ".$b['Users']['LAST_NAME']."</option>";
	
        }
		echo "</select></div></div></div>";
			
		die;
	}

	public function getUsersByClassId($data){
		
		$this->loadModel('Users');
		$result = $this->Users->find('all',array(
				
            'conditions' => array('Users.CLASS_ID'=>$data),
            

		
            
        ));
		

		$user = array();
        $user[0] = 'Select User';
        foreach ($result as $row) {
            $user[$row['Users']['ID']] = ucwords($row['Users']['FIRST_NAME']. " " .$row['Users']['LAST_NAME']);
        }
		
		return $user;
	}
		public function getUsersByRoleId($data){
		
		$this->loadModel('Users');
		$result = $this->Users->find('all',array(
				
            'conditions' => array('Users.ROLE_ID'=>$data)
            
        ));
		$user = array();
        $user[0] = 'Select User';
        foreach ($result as $row) {
            $user[$row['Users']['ID']] = ucwords($row['Users']['FIRST_NAME']. " " .$row['Users']['LAST_NAME']);
        }
		
		
		return $user;
	}

	
	
				public function checkBooks(){
					
				$conditions = array('LibraryMember.STATUS' =>'Issued');
				$rec = $this->LibraryMember->find('all',
				array('conditions' => $conditions,
				));
				$sdate = date('Y-m-d');
						 
				
				
				foreach($rec as $r){
					$bid = $r['LibraryMember']['BOOK_ISSUE_ID'];
						
						$rdate=$r['LibraryMember']['RETURN_DATE'];
						
						
						if($sdate > $rdate){
						$this->LibraryMember->updateAll(
						array(
							'Status' => "'Pending'",
							
							
						),array('BOOK_ISSUE_ID '=>$bid
						)
					);
						}
					//echo $diff;
				}
				
		// return $rec;
				
				}
			
}
