<?php
// app/Controller/UsersController.php


class LibraryBookBankFineController extends AppController
{
    var $name = 'LibraryBookBankFineController';

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
        $this->layout = 'admin_form_layout';
        $this->LibraryBookBankFineController->recursive = 0;
        $this->paginate = array(
            'conditions' => '',
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'LibraryBookBankFineController.created ASC'
        );
		// PR($this->paginate('LibraryBookBankFineController'));
		// die;
        $this->set('LibraryBookBankFineController', $this->paginate('LibraryBookBankFineController'));
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
            $this->LibraryBookBankFineController->set($this->request->data);
            if ($this->LibraryBookBankFineController->Validation()) {
                $this->LibraryBookBankFineController->create();
                if ($this->LibraryBookBankFineController->save($this->request->data)) {
                    $this->Session->setFlash('LibraryBookBankFineController Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
                } else {
                $this->Session->setFlash('LibraryBookBankFineController Not Added Please Try Again!', 'message_bad');
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

        $this->LibraryBookBankFineController->id = $id;
        if (empty($this->LibraryBookBankFineController->id)) {
            $this->Session->setFlash('Invalid LibraryBookBankFineController !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->LibraryBookBankFineController->Validation()) {
                if ($this->LibraryBookBankFineController->save($this->request->data)) {
                    $this->Session->setFlash('LibraryBookBankFineController Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('LibraryBookBankFineController Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('LibraryBookBankFineController Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $LibraryBookBankFineController = $this->LibraryBookBankFineController->find('first', array(
                'contain' => array(),
                'conditions' => array('CATEGORY_ID' => $id)
            ));
            if(empty($LibraryBookBankFineController)) {
                $this->Session->setFlash('Invalid LibraryBookBankFineController !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $LibraryBookBankFineController;
        }
    }
*/
    public function admin_delete($Id = null)
    {
        $this->layout = 'admin_form_layout';
        if (!empty($Id)) {
            try {
                if ($this->LibraryBookBankFineController->delete($Id)) {
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
		
		$LibraryBookBankFineController = $this->LibraryBookBankFineController->find('first', array(
                'contain' => array(),
                'conditions' => array('FINE_ID' => $Id)
            ));
			$fineid = $LibraryBookBankFineController['LibraryBookBankFineController']['FINE_ID'];
			$bookid = $LibraryBookBankFineController['LibraryBookBankFineController']['BOOK_ISSUE_ID'];
			
			$this->LibraryBookBankFineController->updateAll(
						array(
							'STATUS' => "'Returned'",
							
							
						),array('FINE_ID '=>$fineid
						)
					);
			$this->loadModel('LibraryBookIssue');
			$this->LibraryBookIssue->updateAll(
						array(
							'Status' => "'Returned'",
							
							
						),array('BOOK_ISSUE_ID '=>$bookid
						)
					);
					
		?>
			
			<script>
				
				location.href = document.referrer;
			</script>
		<?php	
					
	}
}
