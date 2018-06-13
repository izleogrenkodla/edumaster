<?php
// app/Controller/UsersController.php
class LibraryController extends AppController
{
    var $name = 'Library'; 

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

    public function admin_index()
    {
        $this->layout = 'admin_form_layout';
        $this->Library->recursive = 0;
        $this->paginate = array(
            'contain'=>array("Book","User"),
			'conditions' => array(),
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'Library.LIB_ID ASC'
        );

        $this->set('Library', $this->paginate('Library'));
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
            $this->Library->set($this->request->data);
            if ($this->Library->Validation()) {
                $this->Library->create();
				
				$d1 = strtotime($this->General->datefordb($this->request->data["Library"]["START_DATE"]));
                $d2 = strtotime($this->General->datefordb($this->request->data["Library"]["END_DATE"]));
				
				$curdate=strtotime(date('d-m-Y'));

				if(($d2 < $d1) || ($curdate > $d1)) {
                    $this->Session->setFlash('End date greater than start date!', 'message_bad');
					if($curdate > $d1) { 
						$this->Session->setFlash('Library date should not be older date.', 'message_bad');
					}
                }else{
				
				$this->request->data["Library"]["START_DATE"] = $this->General->datefordb($this->request->data["Library"]["START_DATE"]);
				
				$this->request->data["Library"]["END_DATE"] = $this->General->datefordb($this->request->data["Library"]["END_DATE"]);
                if ($this->Library->save($this->request->data)) {
					$lastid = $this->Library->getLastInsertId();
					$book_id = $this->request->data["Library"]["BOOK_ID"];
					$lb_info = $this->Library->Book->find("first",array(
						'conditions'=>array(
							'BOOK_ID'=>$book_id
						),
						'fields'=>array("NO_OF_BOOK"),
					));
					$available = (int)$lb_info["Book"]["NO_OF_BOOK"] - 1;
					$this->Library->Book->id = $book_id;
					$this->Library->Book->saveField("NO_OF_BOOK",$available);
					
                    $this->Session->setFlash('Library Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
                else {
             	   $this->Session->setFlash('Library Not Added Please Try Again!', 'message_bad');
                }
			}
			
			
		}
		}
     
		
		$books = $this->Library->Book->GetBooks();
		$this->set('books',$books);

		$Users = $this->Library->User->getLibraryUsers();
		$this->set('users',$Users);
		

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

        $this->Library->id = $id;
        if (empty($this->Library->id)) {
            $this->Session->setFlash('Invalid Library !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->Library->Validation()) {
			$this->request->data["Library"]["START_DATE"] = $this->General->datefordb($this->request->data["Library"]["START_DATE"]);
				
				$this->request->data["Library"]["END_DATE"] = $this->General->datefordb($this->request->data["Library"]["END_DATE"]);
                if ($this->Library->save($this->request->data)) {
                    $this->Session->setFlash('Library Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Library Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Library Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $Library = $this->Library->find('first', array(
                'contain' => array(),
                                'conditions' => array('Library.LIB_ID' => $id)
            ));
            if(empty($Library)) {
                $this->Session->setFlash('Invalid Library !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
			$Library["Library"]["START_DATE"] = $this->General->dbfordate($Library["Library"]["START_DATE"]);
			$Library["Library"]["END_DATE"] = $this->General->dbfordate($Library["Library"]["END_DATE"]);
            $this->request->data = $Library;
        }
		
		
		$books = $this->Library->Book->GetBooks();
		$this->set('books',$books);

		$Users = $this->Library->User->getLibraryUsers();
		$this->set('users',$Users);
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
				$this->Library->id = $Id;
                if ($this->Library->saveField("STATUS",0)) {
                    $this->Session->setFlash('Library is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid Library.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }
	
	public function App_AllBooks() {
		 $this->layout = 'ajax';
			$this->autoRender = false;
			$message = '';
			$result_array = array();
			$status = false;
	
			$BookData = $this->Library->Book->find('all', array(
				'fields' => array(),
				'conditions' => array('Book.STATUS' => 1,'Book.NO_OF_BOOK >'=>0),
//				'contain' => array('AcademicClass','Medium'),
				'order' => 'Book.BOOK_ID ASC' 
			));
			
		//	pr($BookData);die;
	
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
	
	public function App_ViewBooks() {
	
		 $this->layout = 'ajax';
			$this->autoRender = false;
			$message = '';
			$result_array = array();
			$status = false;
	  if(!empty($this->request->data))
        {
		$conditions = array();
		if(isset($this->request->data["USER_ID"])) {
			$conditions["Library.USER_ID"] = $this->request->data["USER_ID"];
		}
		if(isset($this->request->data["STATUS"])) {
			$conditions["Library.STATUS"] = $this->request->data["STATUS"];
		}
		if(isset($this->request->data["BOOK_ID"])) {
			$conditions["Library.BOOK_ID"] = $this->request->data["BOOK_ID"];
		}

	//	pr($conditions);die;
			$LibData = $this->Library->find('all', array(
			//	'fields' => array('SELECT User.FIRST_NAME AS Library.USER_ID'),
				'conditions' => $conditions,
				'contain' => array('Book'=>array("Category")),
				'order' => 'Library.LIB_ID ASC' 
			));
			
			//pr($LibData);die;
	
			if(!empty($LibData))
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
				'data' => $LibData
			);
			
	}
        else
        {
            $message = 'Opps something wrong!';
            $status = false;

            $result_array = array(
                'status' => $status,
                'message' => $message
            );

        }
			
	
			echo json_encode($result_array); die;

	
	}//end of function
}
