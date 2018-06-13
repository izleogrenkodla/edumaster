<?php
// app/Controller/UsersController.php


class LibaryLedgerController extends AppController
{
    var $name = 'LibaryLedger';

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
		$this->loadModel('LibraryMember');
		$conditions = array();
		$rdata = $this->LibraryMember->find('first',array(
            'contain' => array(),
            'conditions' => array('LibraryMember.USER_ID' =>$id),
        ));
		
		if((isset($id)) && ($id)>0)
			{
				$conditions['LibraryMember.USER_ID'] = $id;
				$conditions['LibraryMember.ROLE_ID'] = $rdata['LibraryMember']['ROLE_ID'];
			}
		
		
		
        $this->layout = 'admin_form_layout';
       // $this->LibraryMember->recursive = 0;
		
        $this->paginate = array(
            'conditions' => $conditions,
            'limit' => PAGINATION_LIMIT_ADMIN,
           
        );
		
		
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
	// $this->set('IssueBook', $this->paginate('LibraryBookIssue'));
		
    }
	
	
	public function admin_report($id){
		 
		 $this->layout = 'admin_form_layout';
       // $this->LibraryBookIssue->recursive = 0;
		$this->loadModel('LibraryBookIssue');
        $this->paginate = array(
            'conditions' => array('LibraryBookIssue.USER_ID'=>$id),
            'limit' => PAGINATION_LIMIT_ADMIN,
           
        );
		
		
		
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
	// $this->set('IssueBook', $this->paginate('LibraryBookIssue'));
		
	}
	
	
}	