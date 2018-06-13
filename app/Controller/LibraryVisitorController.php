<?php
// app/Controller/UsersController.php
class LibraryVisitorController extends AppController
{
    var $name = 'LibraryVisitor'; 

    public function beforeFilter() 
    {
        parent::beforeFilter();

        $this->Auth->allow('App_ViewBooks','App_AllBooks');
 
        if(isset($this->Security) &&  ($this->RequestHandler->isAjax() || $this->RequestHandler->isPost())){
            $this->Security->validatePost = false;
            $this->Security->enabled = false;
            $this->Security->csrfCheck = false;
        }
    }

    public function admin_index($id = null)
    {
		$condtions = array();
		if(isset($this->request->data["LibraryVisitor"]["CLASS_ID"]) && ($this->request->data["LibraryVisitor"]["CLASS_ID"])>0)
		{ 
			
			
			$class =$this->request->data["LibraryVisitor"]["CLASS_ID"];
			$conditions = array('LibraryVisitor.CLASS_ID' => $class);
			
			
		}
		
		
		$rdata = $this->LibraryVisitor->find('first',array(
            'contain' => array(),
            'conditions' => array('LibraryVisitor.USER_ID' =>$id),
        ));
		
		if((isset($id)) && ($id)>0)
			{
				$conditions['LibraryVisitor.USER_ID'] = $id;
				//$conditions['LibraryVisitor.ROLE_ID'] = $rdata['LibraryVisitor']['ROLE_ID'];
			}
		
		
		$this->layout = 'admin_form_layout';
        $this->LibraryVisitor->recursive = 0;
        $this->paginate = array(
            'conditions' => $conditions,
            'limit' => PAGINATION_LIMIT_ADMIN,
            
        );
		$this->loadModel('AcademicClass');
		$AcademicClass = $this->AcademicClass->GetAcademicClasses();
		$this->set('class',$AcademicClass);
        $this->set('LibraryVisitor', $this->paginate('LibraryVisitor'));
		 
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
            $this->LibraryVisitor->set($this->request->data);
            if ($this->LibraryVisitor->Validation()) {
                $this->LibraryVisitor->create();
                if ($this->LibraryVisitor->save($this->request->data)) {
					$start = $this->request->data['LibraryVisitor']['IN_TIME'];
					$end = $this->request->data['LibraryVisitor']['OUT_TIME'];
					$s =  date('H:i:s',strtotime($start));
					$e =  date('H:i:s',strtotime($end));
					
					$this->LibraryVisitor->saveField("INTIME",$start);
					$this->LibraryVisitor->saveField("OUTTIME",$end);
				
                    $this->Session->setFlash('Blood Group Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
                } else {
                $this->Session->setFlash('Blood Group Not Added Please Try Again!', 'message_bad');
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
		$this->loadModel('LibraryGroup');
		$LibraryGroup = $this->LibraryGroup->GetLibraryGroup();
		$this->set('LibraryGroup',$LibraryGroup);
		$books[0] ="Select Books";
		$this->set('books',$books);
		
    
        
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
                if ($this->LibraryVisitor->delete($Id)) {
                    $this->Session->setFlash('Library Visitor Record is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid Library Visitor Record.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

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
		<select name='data[LibraryVisitor][USER_ID]' class = 'form-control select2me'>";
		 echo "<option value='0'>Select Students</option>";
        foreach ($book as $b) {
            
			 echo "<option value='" . $b['Users']['ID'] ."'>" . $b['Users']['FIRST_NAME'] ."  ".$b['Users']['LAST_NAME']."</option>";
	
        }
		
		echo "</select></div></div></div>";
			
			
			
		die;
	}
		public function admin_getOthers(){
		
		$this->loadModel('Users');
		$sid = $this->request->data["id"];
	
	
	
		$book = $this->Users->find('all',array(
				
            'conditions' => array('Users.ROLE_ID'=>$sid)
            
        ));
		
		echo "<div class='col-md-6'>
          <div class='form-group' >
		 <label class='control-label col-md-3'>Select User<span class='required'>* </span></label>
         <div class='col-md-9'>
		<select name='data[LibraryVisitor][USER_ID]' class = 'form-control select2me'>";
		 echo "<option value='0'>Select User</option>";
        foreach ($book as $b) {
            
			 echo "<option value='" . $b['Users']['ID'] ."'>" . $b['Users']['FIRST_NAME'] ."  ".$b['Users']['LAST_NAME']."</option>";
	
        }
		
		echo "</select></div></div></div>";
			
			
			
		die;
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
		<select name='data[LibraryVisitor][BOOK_ID]' id='books' class = 'form-control select2me'>";
		 echo "<option value='0'>Select Books</option>";
        foreach ($book as $b) {
            
			 echo "<option value='" . $b['LibraryBook']['BOOK_ID'] ."'>" . $b['LibraryBook']['BOOK_NAME'] ."</option>";
	
        }
		
		echo "</select></div></div></div>";
			
			
			
		die;
	}
	

}
