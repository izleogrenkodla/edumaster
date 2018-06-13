<?php
// app/Controller/UsersController.php


class LibraryBookIssueController extends AppController
{
    var $name = 'LibraryBookIssue';

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

    public function admin_index($id = null)
    {
		// $c = 
		$this->checkBooks();
		// PR($c);
		// die;
		$conditions = array();
		
		if(isset($this->request->data["LibraryBookIssue"]["GROUP_ID"]) && ($this->request->data["LibraryBookIssue"]["GROUP_ID"])>0 &&
		isset($this->request->data["LibraryBookIssue"]["ROLE_ID"]) && ($this->request->data["data"]["LibraryBookIssue"]["ROLE_ID"])>0 &&
		isset($this->request->data["LibraryBookIssue"]["CLASS_ID"]) && ($this->request->data["LibraryBookIssue"]["CLASS_ID"])>0
		)
		{
			
			
			$group =$this->request->data["LibraryBookIssue"]["GROUP_ID"];
			$role =$this->request->data["LibraryBookIssue"]["ROLE_ID"];
			$class =$this->request->data["LibraryBookIssue"]["CLASS_ID"];
			$conditions = array('LibraryBookIssue.GROUP_ID' => $group,
					'LibraryBookIssue.ROLE_ID' => $role,		
					'LibraryBookIssue.CLASS_ID' => $class			
			);

			
		}
		elseif(isset($this->request->data["LibraryBookIssue"]["GROUP_ID"]) && ($this->request->data["LibraryBookIssue"]["GROUP_ID"])>0 &&
		isset($this->request->data["LibraryBookIssue"]["ROLE_ID"]) && ($this->request->data["LibraryBookIssue"]["ROLE_ID"])>0
		)
		{
			
			
			$group =$this->request->data["LibraryBookIssue"]["GROUP_ID"];
			$role =$this->request->data["LibraryBookIssue"]["ROLE_ID"];
			$conditions = array('LibraryBookIssue.GROUP_ID' => $group,
					'LibraryBookIssue.ROLE_ID' => $role			
			);

			
		}
		elseif(isset($this->request->data["LibraryBookIssue"]["ROLE_ID"]) && ($this->request->data["LibraryBookIssue"]["ROLE_ID"])>0 &&
		isset($this->request->data["LibraryBookIssue"]["CLASS_ID"]) && ($this->request->data["LibraryBookIssue"]["CLASS_ID"])>0
		)
		{
			
			
			$role =$this->request->data["LibraryBookIssue"]["ROLE_ID"];
			$class =$this->request->data["LibraryBookIssue"]["CLASS_ID"];
			$conditions = array('LibraryBookIssue.ROLE_ID' => $role,
					'LibraryBookIssue.CLASS_ID' => $class);
			
			
		}
		elseif(isset($this->request->data["LibraryBookIssue"]["GROUP_ID"]) && ($this->request->data["LibraryBookIssue"]["GROUP_ID"])>0)
		{
			
			
			$group =$this->request->data["LibraryBookIssue"]["GROUP_ID"];
			$conditions = array('LibraryBookIssue.GROUP_ID' => $group);

			
		}
		elseif(isset($this->request->data["LibraryBookIssue"]["ROLE_ID"]) && ($this->request->data["LibraryBookIssue"]["ROLE_ID"])>0)
		{
			
			
			$role =$this->request->data["LibraryBookIssue"]["ROLE_ID"];
			$conditions = array('LibraryBookIssue.ROLE_ID' => $role);

			
		}
		elseif(isset($this->request->data["LibraryBookIssue"]["CLASS_ID"]) && ($this->request->data["LibraryBookIssue"]["CLASS_ID"])>0)
		{
			
			
			$class =$this->request->data["LibraryBookIssue"]["CLASS_ID"];
			$conditions = array('LibraryBookIssue.CLASS_ID' => $class);

			
		}

		$rdata = $this->LibraryBookIssue->find('first',array(
            'contain' => array(),
            'conditions' => array('LibraryBookIssue.USER_ID' =>$id),
        ));
		
		if((isset($id)) && ($id)>0)
			{
				$conditions['LibraryBookIssue.USER_ID'] = $id;
				$conditions['LibraryBookIssue.ROLE_ID'] = $rdata['LibraryBookIssue']['ROLE_ID'];
			}
		
		
        $this->layout = 'admin_form_layout';
        $this->LibraryBookIssue->recursive = 0;
        $this->paginate = array(
            'conditions' => $conditions,
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'LibraryBookIssue.created ASC'
        );
	// PR($this->paginate('LibraryBookIssue'));
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
        $this->set('IssueBook', $this->paginate('LibraryBookIssue'));
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

        if ($this->request->is('post')) {
            $this->LibraryBookIssue->set($this->request->data);
            if ($this->LibraryBookIssue->Validation()) {
                $this->LibraryBookIssue->create();
                if ($this->LibraryBookIssue->save($this->request->data)) {
					if($this->request->data["LibraryBookIssue"]["ISSUE_DATE"]!= "" ){
					$this->request->data["LibraryBookIssue"]["ISSUE_DATE"] = $this->General->datefordb($this->request->data["LibraryBookIssue"]["ISSUE_DATE"]);
					$this->LibraryBookIssue->saveField("ISSUE_DATE",$this->request->data["LibraryBookIssue"]["ISSUE_DATE"]);
					}
					if($this->request->data["LibraryBookIssue"]["RETURN_DATE"]!= "" ){
					$this->request->data["LibraryBookIssue"]["RETURN_DATE"] = $this->General->datefordb($this->request->data["LibraryBookIssue"]["RETURN_DATE"]);
					}
					$this->LibraryBookIssue->saveField("ISSUE_DATE",$this->request->data["LibraryBookIssue"]["ISSUE_DATE"]);
					$this->LibraryBookIssue->saveField("RETURN_DATE",$this->request->data["LibraryBookIssue"]["RETURN_DATE"]);
					$this->LibraryBookIssue->saveField("Status",$this->request->data["LibraryBookIssue"]["Status"]);
					
				
					$this->LibraryBookIssue->saveField("BOOK_ID",$this->request->data["BOOK_ID"]);
					
					
					//$this->LibraryBookIssue->saveField("USER_ID",$this->request->data["USER_ID"]);
					
					 $update_quantity = $this->getBooksMinus($this->request->data["BOOK_ID"]);
					 $this->loadModel('LibraryBook');
					 $this->LibraryBook->updateAll(
						array(
							'QUANTITY' => $update_quantity,
							
						),array('BOOK_ID '=>$this->request->data["BOOK_ID"])
					);
					
					
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
		
			
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        $this->LibraryBookIssue->id = $id;
        if (empty($this->LibraryBookIssue->id)) {
            $this->Session->setFlash('Invalid LibraryBookIssue !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
			
            if ($this->LibraryBookIssue->Validation()) {
                if ($this->LibraryBookIssue->save($this->request->data)) {
					
					
					if($this->request->data["LibraryBookIssue"]["ISSUE_DATE"]!= "" ){
					$this->request->data["LibraryBookIssue"]["ISSUE_DATE"] = $this->General->datefordb($this->request->data["LibraryBookIssue"]["ISSUE_DATE"]);
					}
					if($this->request->data["LibraryBookIssue"]["RETURN_DATE"]!= "" ){
					$this->request->data["LibraryBookIssue"]["RETURN_DATE"] = $this->General->datefordb($this->request->data["LibraryBookIssue"]["RETURN_DATE"]);
					}
					if($this->request->data['LibraryBookIssue']['ROLE_ID'] != STUDENT_ID){
						$this->LibraryBookIssue->saveField("CLASS_ID","");
						
					}else{
						$this->LibraryBookIssue->saveField("CLASS_ID",$this->request->data['LibraryBookIssue']['CLASS_ID']);
					}
					if($this->request->data["LibraryBookIssue"]["RETURN_DATE"] > 0){
						
					$update_quantity = $this->getBooksplus($this->request->data['LibraryBookIssue']["BOOK_ID"]);
					 $this->loadModel('LibraryBook');
					 $this->LibraryBook->updateAll(
						array(
							'QUANTITY' => $update_quantity,
							
						),array('BOOK_ID '=>$this->request->data['LibraryBookIssue']["BOOK_ID"])
					);
					
					}
					$this->LibraryBookIssue->saveField("ISSUE_DATE",$this->request->data["LibraryBookIssue"]["ISSUE_DATE"]);
					$this->LibraryBookIssue->saveField("RETURN_DATE",$this->request->data["LibraryBookIssue"]["RETURN_DATE"]);
					
					
					
                    $this->Session->setFlash('Book Issue Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Book Not Issued Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Book Not Issued Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $LibraryBookIssue = $this->LibraryBookIssue->find('first', array(
                'contain' => array(),
                'conditions' => array('LibraryBookIssue.BOOK_ISSUE_ID' => $id)
            ));
            if(empty($LibraryBookIssue)) {
                $this->Session->setFlash('Invalid LibraryBookIssue !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
			if($LibraryBookIssue['LibraryBookIssue']['ISSUE_DATE'] === NULL){
				
			}else{
			$LibraryBookIssue['LibraryBookIssue']['ISSUE_DATE'] = date('d/m/Y', strtotime(str_replace('-','/',$LibraryBookIssue['LibraryBookIssue']['ISSUE_DATE'])));
			}
			if($LibraryBookIssue['LibraryBookIssue']['RETURN_DATE'] === NULL){
				
			}else{
			$LibraryBookIssue['LibraryBookIssue']['RETURN_DATE'] = date('d/m/Y', strtotime(str_replace('-','/',$LibraryBookIssue['LibraryBookIssue']['RETURN_DATE'])));
            }
	
            $this->request->data = $LibraryBookIssue;
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
		if($LibraryBookIssue['LibraryBookIssue']['CLASS_ID']>0){
			$users = $this->getUsersByClassId($LibraryBookIssue['LibraryBookIssue']['CLASS_ID']);
			$croles = $LibraryBookIssue['LibraryBookIssue']['ROLE_ID'];
			
			
		}	
		else{
			$users = $this->getUsersByRoleId($LibraryBookIssue['LibraryBookIssue']['ROLE_ID']);
			$croles = $LibraryBookIssue['LibraryBookIssue']['ROLE_ID'];
			
			
		}
		
		
		
		$this->set('users',$users);
		$this->set('croles',$croles);
		
		

    }

    public function admin_delete($Id = null)
    {
        $this->layout = 'admin_form_layout';
        if (!empty($Id)) {
            try {
                if ($this->LibraryBookIssue->delete($Id)) {
                    $this->Session->setFlash('LibraryBookIssue is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid LibraryBookIssue.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }
	
	public function admin_Return($Id = null){
		
		  $LibraryBookIssue = $this->LibraryBookIssue->find('first', array(
                'contain' => array(),
                'conditions' => array('LibraryBookIssue.BOOK_ISSUE_ID' => $Id)
            ));
		$this->loadModel('LibraryFineMaster');
		 $LibraryFineMaster = $this->LibraryFineMaster->find('first', array(
                'contain' => array(),
                'conditions' => array()
            ));	
			$fine = $LibraryFineMaster['LibraryFineMaster']['FINE'];
			$date = date('Y-m-d');
		
			$date1=date_create($date);
			$date2=date_create($LibraryBookIssue['LibraryBookIssue']['RETURN_DATE']);
			$diff=date_diff($date1,$date2);
			$pending = $diff->format("%R%a days");
			$days = abs($pending);
			
			
			$bookid = $LibraryBookIssue['LibraryBookIssue']['BOOK_ISSUE_ID'];
			$totalfine = abs($pending * $fine);
			
			
			if($pending>=0){
			$this->LibraryBookIssue->updateAll(
						array(
							'Status' => "'Returned'",
							
							
						),array('LibraryBookIssue.BOOK_ISSUE_ID '=>$bookid
						)
					);
			}elseif($pending<0){
				$this->loadModel('LibraryFine');
				$this->LibraryFine->saveField('NO_OF_DAYS',$days);
				$this->LibraryFine->saveField('FINE_PER_DAY',$fine);
				$this->LibraryFine->saveField('TOTAL_AMOUNT',$totalfine);
				$this->LibraryFine->saveField('BOOK_ISSUE_ID',$bookid);
				$this->LibraryFine->saveField('GROUP_ID',$LibraryBookIssue['LibraryBookIssue']['GROUP_ID']);
				$this->LibraryFine->saveField('BOOK_ID',$LibraryBookIssue['LibraryBookIssue']['BOOK_ID']);
				$this->LibraryFine->saveField('CLASS_ID',$LibraryBookIssue['LibraryBookIssue']['CLASS_ID']);
				$this->LibraryFine->saveField('USER_ID',$LibraryBookIssue['LibraryBookIssue']['USER_ID']);
				$this->LibraryFine->saveField('STATUS','Pending');
				$this->LibraryFine->saveField('ISSUETYPE','BOOK');
				
				
				$this->loadModel("LibraryBookIssue");
				$this->LibraryBookIssue->updateAll(
						array(
							'Status' => "'Pending'",
							
							
						),array('BOOK_ISSUE_ID '=>$bookid
						)
						);
						
					$this->redirect(array(
						'controller' => 'LibraryFine',
						'action' => '', 
					));
			}
			
			
			
			$update_quantity = $this->getBooksPlus($LibraryBookIssue['LibraryBookIssue']['BOOK_ID']);
			 $this->loadModel('LibraryBook');
					 $this->LibraryBook->updateAll(
						array(
							'QUANTITY' => $update_quantity,
							
							
						),array('BOOK_ID '=>$LibraryBookIssue['LibraryBookIssue']['BOOK_ID']
						)
					);
					
		die;
		?>
			
			<script>
				
				location.href = document.referrer;
			</script>
		<?php
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
		$this->loadModel('LibraryMember');
		$uid = $this->LibraryMember->find('all',array(
				
            'conditions' => array('LibraryMember.CLASS_ID'=>$sid,
								'LibraryMember.ROLE_ID'=>$rid
							)
            
        ));
		foreach($uid as $uuid){
		$id = $uuid['LibraryMember']['USER_ID'];
		$rrid = $uuid['LibraryMember']['ROLE_ID'];
		}
		
		
	
		if(isset($id)){
		$book = $this->Users->find('all',array(
				
            'conditions' => array('Users.ID'=>$id
							)
            
        ));
		
		echo "<div class='col-md-6'>
          <div class='form-group' >
		 <label class='control-label col-md-3'>Select Students<span class='required'>* </span></label>
         <div class='col-md-9'>
		<select name='data[LibraryBookIssue][USER_ID]' class = 'form-control select2me'>";
		 echo "<option value='0'>Select Students</option>";
        foreach ($book as $b) {
            
			 echo "<option value='" . $b['Users']['ID'] ."'>" . $b['Users']['FIRST_NAME'] ."  ".$b['Users']['LAST_NAME']."</option>";
	
        }
		
		echo "</select></div></div></div>";
		}
		else{
			echo "No Student Found";
		}
		
			
			
		die;
	}
		public function admin_getOthers(){
		
		
		
		$this->loadModel('Users');
		$sid = $this->request->data["id"];
		$this->loadModel('LibraryMember');
		$uid = $this->LibraryMember->find('all',array(
				
            'conditions' => array('LibraryMember.ROLE_ID'=>$sid)
            
        ));
		foreach($uid as $uuid){
		$id = $uuid['LibraryMember']['USER_ID'];
		}
		
		if(isset($id)){
		$book = $this->Users->find('all',array(
				
            'conditions' => array('Users.ID'=>$id)
            
        ));
		
		echo "<div class='col-md-6'>
          <div class='form-group' >
		 <label class='control-label col-md-3'>Select User<span class='required'>* </span></label>
         <div class='col-md-9'>
		<select name='data[LibraryBookIssue][USER_ID]' class = 'form-control select2me'>";
		 echo "<option value='0'>Select User</option>";
        foreach ($book as $b) {
            
			 echo "<option value='" . $b['Users']['ID'] ."'>" . $b['Users']['FIRST_NAME'] ."  ".$b['Users']['LAST_NAME']."</option>";
	
        }
		
		echo "</select></div></div></div>";
			
		}else{
			echo "No User Found";
		}
			
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

		public function getBooksMinus($data){
			
		$this->loadModel('LibraryBook');
		
	
	
	
		$book = $this->LibraryBook->find('all',array(
				
            'conditions' => array('LibraryBook.BOOK_ID'=>$data)
            
        ));
		foreach($book as $data){
		$d = $data['LibraryBook']['QUANTITY']-1;
		}
		
		return $d;
			
		}
		public function getBooksPlus($data){
			
		$this->loadModel('LibraryBook');
		
	
	
	
		$book = $this->LibraryBook->find('all',array(
				
            'conditions' => array('LibraryBook.BOOK_ID'=>$data)
            
        ));
		foreach($book as $data){
		$d = $data['LibraryBook']['QUANTITY']+1;
		}
		
		return $d;
			
		}
		
				public function checkBooks(){
					
				$conditions = array('LibraryBookIssue.STATUS' =>'Issued');
				$rec = $this->LibraryBookIssue->find('all',
				array('conditions' => $conditions,
				));
				$sdate = date('Y-m-d');
						 
				
				
				foreach($rec as $r){
					$bid = $r['LibraryBookIssue']['BOOK_ISSUE_ID'];
						
						$rdate=$r['LibraryBookIssue']['RETURN_DATE'];
						
						
						if($sdate > $rdate){
						$this->LibraryBookIssue->updateAll(
						array(
							'Status' => "'Pending'",
							
							
						),array('LibraryBookIssue.BOOK_ISSUE_ID '=>$bid
						)
					);
						}
					//echo $diff;
				}
				
		// return $rec;
				
				}
			
}
