<?php
// app/Controller/UsersController.php


class LibraryBookController extends AppController
{
    var $name = 'LibraryBook';

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
		if(isset($this->request->data["LibraryBook"]["GROUP_ID"]) && ($this->request->data["LibraryBook"]["GROUP_ID"])>0 && 
		isset($this->request->data["LibraryBook"]["PUBLISHER_ID"]) && ($this->request->data["LibraryBook"]["PUBLISHER_ID"])>0 &&
		isset($this->request->data["LibraryBook"]["CLASS_ID"]) && ($this->request->data["LibraryBook"]["CLASS_ID"])>0)
		{
			$group =$this->request->data["LibraryBook"]["GROUP_ID"];
			$publisher =$this->request->data["LibraryBook"]["PUBLISHER_ID"];
			$class =$this->request->data["LibraryBook"]["CLASS_ID"];
			$conditions = array('LibraryBook.CATEGORY_ID' => $group,
								'LibraryBook.PUBLISHER_ID '=> $publisher,
								'LibraryBook.CLASS_ID '=> $class,
								
			);
		}
		elseif(isset($this->request->data["LibraryBook"]["GROUP_ID"]) && ($this->request->data["LibraryBook"]["GROUP_ID"])>0 && 
		isset($this->request->data["LibraryBook"]["PUBLISHER_ID"]) && ($this->request->data["LibraryBook"]["PUBLISHER_ID"])>0)
		{
			$group =$this->request->data["LibraryBook"]["GROUP_ID"];
			$publisher =$this->request->data["LibraryBook"]["PUBLISHER_ID"];
			$conditions = array('LibraryBook.CATEGORY_ID' => $group,
								'LibraryBook.PUBLISHER_ID '=> $publisher,
							
			);
		}
		elseif(isset($this->request->data["LibraryBook"]["GROUP_ID"]) && ($this->request->data["LibraryBook"]["GROUP_ID"])>0 && 
		isset($this->request->data["LibraryBook"]["CLASS_ID"]) && ($this->request->data["LibraryBook"]["CLASS_ID"])>0)
		{
			$group =$this->request->data["LibraryBook"]["GROUP_ID"];
			$class =$this->request->data["LibraryBook"]["CLASS_ID"];
			$conditions = array('LibraryBook.CATEGORY_ID' => $group,
								'LibraryBook.CLASS_ID' => $class,
								
			);
		}
		elseif(isset($this->request->data["LibraryBook"]["PUBLISHER_ID"]) && ($this->request->data["LibraryBook"]["PUBLISHER_ID"])>0 && 
		isset($this->request->data["LibraryBook"]["CLASS_ID"]) && ($this->request->data["LibraryBook"]["CLASS_ID"])>0)
		{
			$publisher =$this->request->data["LibraryBook"]["PUBLISHER_ID"];
			$class =$this->request->data["LibraryBook"]["CLASS_ID"];
			$conditions = array('LibraryBook.PUBLISHER_ID' => $publisher,
								'LibraryBook.CLASS_ID' => $class,
								
			);
		}
		elseif(isset($this->request->data["LibraryBook"]["GROUP_ID"]) && ($this->request->data["LibraryBook"]["GROUP_ID"])>0)
		{
			
			
			$group =$this->request->data["LibraryBook"]["GROUP_ID"];
			
			$conditions = array('LibraryBook.CATEGORY_ID' => $group);

			
		}elseif(isset($this->request->data["LibraryBook"]["PUBLISHER_ID"]) && ($this->request->data["LibraryBook"]["PUBLISHER_ID"])>0)
		{
			
			
			$publisher =$this->request->data["LibraryBook"]["PUBLISHER_ID"];
			$conditions = array('LibraryBook.PUBLISHER_ID' => $publisher);

			
		}elseif(isset($this->request->data["LibraryBook"]["Status"]) && ($this->request->data["LibraryBook"]["Status"])>0)
		{
			
			
			$class =$this->request->data["LibraryBook"]["Status"];
			$conditions = array('LibraryBook.Status' => $class);

			
		}
		
		
        $this->layout = 'admin_form_layout';
        $this->LibraryBook->recursive = 0;
        $this->paginate = array(
            'conditions' => $conditions,
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'LibraryBook.created ASC'
        );
		
		$this->loadModel('LibraryGroup');
		$librarygroup = $this->LibraryGroup->getLibraryGroup();
		$this->set('group',$librarygroup);
		
		$this->loadModel('LibraryPublisher');
		$librarypublisher = $this->LibraryPublisher->getLibraryPublisher();
		$this->set('publisher',$librarypublisher);
		
		$this->loadModel('AcademicClass');
		$AcademicClass = $this->AcademicClass->GetAcademicClasses();
		$this->set('classes',$AcademicClass);
        $this->set('LibraryBook', $this->paginate('LibraryBook'));
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
            $this->LibraryBook->set($this->request->data);
            if ($this->LibraryBook->Validation()) {
                $this->LibraryBook->create();
                if ($this->LibraryBook->save($this->request->data)) {
                    $this->Session->setFlash('LibraryBook Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
                } else {
                $this->Session->setFlash('LibraryBook Not Added Please Try Again!', 'message_bad');
                }
        }
		
		
		$this->loadModel('LibraryGroup');
		$librarygroup = $this->LibraryGroup->getLibraryGroup();
		$this->set('LibraryGroup',$librarygroup);
		
		$this->loadModel('LibraryPublisher');
		$librarypublisher = $this->LibraryPublisher->getLibraryPublisher();
		$this->set('LibraryPublisher',$librarypublisher);
		
		$this->loadModel('AcademicClass');
		$AcademicClass = $this->AcademicClass->GetAcademicClasses();
		$this->set('AcademicClass',$AcademicClass);
		$from = array('Donate'=>'Donate','Purchase'=>'Purchase');
		$this->set('from',$from);
		
    }

    public function admin_edit($id = null)
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        $this->LibraryBook->id = $id;
        if (empty($this->LibraryBook->id)) {
            $this->Session->setFlash('Invalid LibraryBook !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->LibraryBook->Validation()) {
                if ($this->LibraryBook->save($this->request->data)) {
                    $this->Session->setFlash('LibraryBook Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('LibraryBook Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('LibraryBook Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $LibraryBook = $this->LibraryBook->find('first', array(
                'contain' => array(),
                'conditions' => array('BOOK_ID' => $id)
            ));
            if(empty($LibraryBook)) {
                $this->Session->setFlash('Invalid LibraryBook !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $LibraryBook;
        }

		$this->loadModel('LibraryGroup');
		$librarygroup = $this->LibraryGroup->getLibraryGroup();
		$this->set('LibraryGroup',$librarygroup);
		
		$this->loadModel('LibraryPublisher');
		$librarypublisher = $this->LibraryPublisher->getLibraryPublisher();
		$this->set('LibraryPublisher',$librarypublisher);
		
		$this->loadModel('AcademicClass');
		$AcademicClass = $this->AcademicClass->GetAcademicClasses();
		$this->set('AcademicClass',$AcademicClass);
    }

    public function admin_delete($Id = null)
    {
        $this->layout = 'admin_form_layout';
        if (!empty($Id)) {
            try {
                if ($this->LibraryBook->delete($Id)) {
                    $this->Session->setFlash('LibraryBook is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid LibraryBook.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }
}
