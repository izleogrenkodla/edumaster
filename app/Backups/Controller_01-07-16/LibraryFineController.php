<?php
// app/Controller/UsersController.php


class LibraryFineController extends AppController
{
    var $name = 'LibraryFine';

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
	
		$condtions = array();
		if(isset($this->request->data["LibraryFine"]["Status"]) && ($this->request->data["LibraryFine"]["Status"])!="")
		{ 
			
			
			$status =$this->request->data["LibraryFine"]["Status"];
			$conditions = array('LibraryFine.STATUS' => $status);
			
			
		}
		
			$rdata = $this->LibraryFine->find('first',array(
            'contain' => array(),
            'conditions' => array('LibraryFine.USER_ID' =>$id),
        ));
		
		if((isset($id)) && ($id)>0)
			{
				$conditions['LibraryFine.USER_ID'] = $id;
				//$conditions['LibraryFine.ROLE_ID'] = $rdata['LibraryFine']['ROLE_ID'];
			}
		
	
        $this->layout = 'admin_form_layout';
        $this->LibraryFine->recursive = 0;
        $this->paginate = array(
            'conditions' => $conditions,
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'LibraryFine.created ASC'
        );
		// PR($this->paginate('LibraryFine'));
		// die;
		$status = array("Pending"=>"Pending","Returned"=>"Returned");
        $this->set('LibraryFine', $this->paginate('LibraryFine'));
        $this->set('status', $status);

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
            $this->LibraryFine->set($this->request->data);
            if ($this->LibraryFine->Validation()) {
                $this->LibraryFine->create();
                if ($this->LibraryFine->save($this->request->data)) {
                    $this->Session->setFlash('LibraryFine Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
                } else {
                $this->Session->setFlash('LibraryFine Not Added Please Try Again!', 'message_bad');
                }
        }
    }
/*
    public function admin_edit($id = null)
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        $this->LibraryFine->id = $id;
        if (empty($this->LibraryFine->id)) {
            $this->Session->setFlash('Invalid LibraryFine !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->LibraryFine->Validation()) {
                if ($this->LibraryFine->save($this->request->data)) {
                    $this->Session->setFlash('LibraryFine Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('LibraryFine Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('LibraryFine Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $LibraryFine = $this->LibraryFine->find('first', array(
                'contain' => array(),
                'conditions' => array('CATEGORY_ID' => $id)
            ));
            if(empty($LibraryFine)) {
                $this->Session->setFlash('Invalid LibraryFine !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $LibraryFine;
        }
    }
*/
    public function admin_delete($Id = null)
    {
        $this->layout = 'admin_form_layout';
        if (!empty($Id)) {
            try {
                if ($this->LibraryFine->delete($Id)) {
                    $this->Session->setFlash('Library Fine is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid Library Fine.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }
	
	public function admin_action($Id = null){
		
		$LibraryFine = $this->LibraryFine->find('first', array(
                'contain' => array(),
                'conditions' => array('FINE_ID' => $Id)
            ));
			
			
			$fineid = $LibraryFine['LibraryFine']['FINE_ID'];
			$bookid = $LibraryFine['LibraryFine']['BOOK_ISSUE_ID'];
			
			$this->LibraryFine->updateAll(
						array(
							'STATUS' => "'Returned'",
							
							
						),array('LibraryFine.FINE_ID '=>$fineid
						)
					);
			if($LibraryFine['LibraryFine']['ISSUETYPE']== "BOOK"){
			$this->loadModel('LibraryBookIssue');
			$this->LibraryBookIssue->updateAll(
						array(
							'Status' => "'Returned'",
							'FINE_ID' => $Id,
							
							
						),array('BOOK_ISSUE_ID '=>$bookid
						)
					);
			}elseif($LibraryFine['LibraryFine']['ISSUETYPE']== "BOOK BANK"){
				
					$this->loadModel('LibraryBookBankIssue');
					$this->LibraryBookBankIssue->updateAll(
						array(
							'Status' => "'Returned'",
							'FINE_ID' => $Id,
							
							
						),array('BOOK_BANK_ISSUE_ID '=>$bookid
						)
					);
			}
					
		?>
			
			<script>
				
				location.href = document.referrer;
			</script>
		<?php	
					
	}
}
