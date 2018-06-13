<?php
// app/Controller/UsersController.php


class LibraryNewsPaperItemController extends AppController
{
    var $name = 'LibraryNewsPaperItem';

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
		$conditions = array('LibraryNewsPaperItem.STATUS' => '1');
        $this->layout = 'admin_form_layout';
        $this->LibraryNewsPaperItem->recursive = 0;
        $this->paginate = array(
            'conditions' => $conditions ,
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'LibraryNewsPaperItem.created ASC'
        );
		
		
        $this->set('LibraryNewsPaperItem', $this->paginate('LibraryNewsPaperItem'));
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
            $this->LibraryNewsPaperItem->set($this->request->data);
            if ($this->LibraryNewsPaperItem->Validation()) {
                $this->LibraryNewsPaperItem->create();
                if ($this->LibraryNewsPaperItem->save($this->request->data)) {
					
					$this->request->data["LibraryNewsPaperItem"]["Date"] = $this->General->datefordb($this->request->data["LibraryNewsPaperItem"]["Date"]);
					
					$this->LibraryNewsPaperItem->saveField("Date",$this->request->data["LibraryNewsPaperItem"]["Date"]);
					
                    $this->Session->setFlash('LibraryNewsPaperItem Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
             } else {
             $this->Session->setFlash('LibraryNewsPaperItem Not Added Please Try Again!', 'message_bad');
            }
        }
		$data = date("Y-m-d") ;
		$this->set('date',$date);
		$this->loadModel('LibraryNewsPaper');
		$LibraryNewspaper = $this->LibraryNewsPaper->getLibraryNewsPaper();
		$this->set('LibraryNewsPaper',$LibraryNewspaper);
    }
	
    public function admin_edit($id = null)
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

        $this->LibraryNewsPaperItem->id = $id;
        if (empty($this->LibraryNewsPaperItem->id)) {
            $this->Session->setFlash('Invalid LibraryNewsPaperItem !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->LibraryNewsPaperItem->Validation()) {
                if ($this->LibraryNewsPaperItem->save($this->request->data)) {
					
					
					$this->request->data["LibraryNewsPaperItem"]["Date"] = $this->General->datefordb($this->request->data["LibraryNewsPaperItem"]["Date"]);
					
					$this->LibraryNewsPaperItem->saveField("Date",$this->request->data["LibraryNewsPaperItem"]["Date"]);
					
                    $this->Session->setFlash('LibraryNewsPaperItem Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('LibraryNewsPaperItem Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('LibraryNewsPaperItem Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $LibraryNewsPaperItem = $this->LibraryNewsPaperItem->find('first', array(
                'contain' => array(),
                'conditions' => array('NEWS_ID' => $id)
            ));
            if(empty($LibraryNewsPaperItem)) {
                $this->Session->setFlash('Invalid LibraryNewsPaperItem !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
			$LibraryNewsPaperItem['LibraryNewsPaperItem']['Date'] = date('d/m/Y', strtotime(str_replace('-','/',$LibraryNewsPaperItem['LibraryNewsPaperItem']['Date'])));
            $this->request->data = $LibraryNewsPaperItem;
			
        }
		$this->loadModel('LibraryNewsPaper');
		$LibraryNewspaper = $this->LibraryNewsPaper->getLibraryNewsPaper();
		$this->set('LibraryNewsPaper',$LibraryNewspaper);
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
                if ($this->LibraryNewsPaperItem->delete($Id)) {
                    $this->Session->setFlash('LibraryNewsPaperItem is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid LibraryNewsPaperItem.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }
}
