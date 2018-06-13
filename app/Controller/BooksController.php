<?php
// app/Controller/UsersController.php
class BooksController extends AppController
{
    var $name = 'Books'; 

    public function beforeFilter() 
    {
        parent::beforeFilter();

        $this->Auth->allow('App_GetBooks');
 
        if(isset($this->Security) &&  ($this->RequestHandler->isAjax() || $this->RequestHandler->isPost())){
            $this->Security->validatePost = false;
            $this->Security->enabled = false;
            $this->Security->csrfCheck = false;
        }
    }

    public function admin_index()
    {
        $this->layout = 'admin_form_layout';
        $this->Book->recursive = 0;
        $this->paginate = array(
            'conditions' => array("Book.STATUS"=>1),
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'Book.created DESC'
        );

        $this->set('books', $this->paginate('Book'));
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
            $this->Book->set($this->request->data);
            if ($this->Book->Validation()) {
                $this->Book->create();
                if ($this->Book->save($this->request->data)) {
                    $this->Session->setFlash('Book Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
                } else {
             	   $this->Session->setFlash('Book Not Added Please Try Again!', 'message_bad');
                }
        }
		
		$categories = $this->Book->Category->GetCategories();
		$this->set('categories',$categories);
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

        $this->Book->id = $id;
        if (empty($this->Book->id)) {
            $this->Session->setFlash('Invalid Book !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->Book->Validation()) {
                if ($this->Book->save($this->request->data)) {
                    $this->Session->setFlash('Book Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Book Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Book Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $Book = $this->Book->find('first', array(
                'contain' => array(),
                'conditions' => array('Book.STATUS' => 1,'BOOK_ID'=>$id)
            ));
            if(empty($Book)) {
                $this->Session->setFlash('Invalid Book !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $Book;
        }
		$categories = $this->Book->Category->GetCategories();
		$this->set('categories',$categories);
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
				$this->Book->id = $Id;
                if ($this->Book->saveField("STATUS",0)) {
                    $this->Session->setFlash('Boook is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid Category.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }
	
	public function App_GetBooks() {
		 $this->layout = 'ajax';
			$this->autoRender = false;
			$message = '';
			$result_array = array();
			$status = false;
	
			$BookData = $this->Book->find('all', array(
				'fields' => array(),
				'conditions' => array('Book.STATUS' => 1),
				//'contain' => array('Category'),
				'order' => 'Book.BOOK_ID ASC' 
			));
	
			if(!empty($BookData))
			{
				$message = 'Available Books';
				$status = true;
			}
			else
			{
				$message = 'No Data Found';
				$status = false;
			}
	
			$result_array = array(
				'status' => $status,
				'message' => $message,
				'data' => $BookData
			);
	
			echo json_encode($result_array); die;

	}
}
