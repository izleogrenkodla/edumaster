<?php
// app/Controller/UsersController.php
class EBookController extends AppController
{
    var $name = 'EBook';

    public function beforeFilter()
    {
        parent::beforeFilter();

        $this->Auth->allow('App_EBookList');

        if(isset($this->Security) &&  ($this->RequestHandler->isAjax() || $this->RequestHandler->isPost())){
            $this->Security->validatePost = false;
            $this->Security->enabled = false;
            $this->Security->csrfCheck = false;
        }
    }
    
    public function admin_index()
    {
    $Session = $this->Session->read('Auth.Admin');
		$conditions = array();

		 switch($Session["ROLE_ID"]) {
		 	case STUDENT_ID:
				$conditions['EBook.CLASS_ID']=$Session["CLASS_ID"];
			break;
			case TEACHER_ID:
				$conditions['EBook.CLASS_ID']=$Session["CLASS_ID"];
			break;
		 }
        $this->layout = 'admin_form_layout';
        //$this->EBook->recursive = 0;
        $this->paginate = array(
            'conditions' => $conditions,
            'Contain' => array('Category','AcademicClass'),
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'EBook.created DESC'
        );

        $this->set('ebooks', $this->paginate('EBook'));
    }
    
    public function admin_add()
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		if($Session_data["ROLE_ID"]!=ADMIN_ID && $Session_data["ROLE_ID"]!=TEACHER_ID && $Session_data["ROLE_ID"]!=SUPERVISOR_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}

        if ($this->request->is('post')) {
            $this->EBook->set($this->request->data);

            if ($this->EBook->Validation()) {
                $this->EBook->create();
                $pdf = '';
                if($this->request->data["EBook"]["UPLOAD_PDF"]["size"]>0) {
                    $pdf = $this->request->data["EBook"]["UPLOAD_PDF"];
                    unset($this->request->data["EBook"]["UPLOAD_PDF"]);
                }
               
                if ($this->EBook->save($this->request->data)) {
                    if(is_array($pdf) && $pdf["size"]>0) {
                        $lastid = $this->EBook->getLastInsertId();
                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname = strtotime(date('Y-m-d H:i:s')).$lastid.'.pdf';
                        move_uploaded_file($pdf["tmp_name"],$path.$fname);
                        $this->EBook->id = $lastid;
                        $this->EBook->saveField("PDF",$fname);
                    }
                    $this->Session->setFlash('EBook Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
            } else {
                $this->Session->setFlash('EBook Not Added Please Try Again!', 'message_bad');
            }
        }

        $classes = $this->EBook->AcademicClass->GetAcademicClasses();
        $this->set('classes', $classes);

        $categories = $this->EBook->Category->GetCategories();
        $this->set('categories', $categories);
    }
    
    public function admin_edit($id = null)
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		if($Session_data["ROLE_ID"]!=ADMIN_ID && $Session_data["ROLE_ID"]!=TEACHER_ID && $Session_data["ROLE_ID"]!=SUPERVISOR_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}

        $this->EBook->id = $id;
        if (empty($this->EBook->id)) {
            $this->Session->setFlash('Invalid EBook !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->EBook->Validation()) {
                $pdf = '';
                if($this->request->data["EBook"]["UPLOAD_PDF"]["size"]>0) {
                    $pdf = $this->request->data["EBook"]["UPLOAD_PDF"];
                    unset($this->request->data["EBook"]["UPLOAD_PDF"]);
                }

                if ($this->EBook->save($this->request->data)) {

                    if(is_array($pdf) && $pdf["size"]>0) {
                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname = strtotime(date('Y-m-d H:i:s')).$id.'.pdf';
                        move_uploaded_file($pdf["tmp_name"],$path.$fname);
                        $this->EBook->id = $id;
                        
                        $EbookData = $this->EBook->find('first', array(
                            'contain' => array(),
                            'conditions' => array('ID' => $id)
                        ));

                        $fileName = $EbookData['EBook']['PDF'];

                        if($fileName != '')
                        {
                            $this->General->delete_file("/files/upload_document/".$fileName);
                        }

                        $this->EBook->saveField("PDF",$fname);
                    }

                    $this->Session->setFlash('EBook Updated Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('EBook Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('EBook Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $EBook = $this->EBook->find('first', array(
                'contain' => array(),
                'conditions' => array('ID' => $id)
            ));
            if(empty($EBook)) {
                $this->Session->setFlash('Invalid EBook !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $EBook;
        }

        $classes = $this->EBook->AcademicClass->GetAcademicClasses();
        $this->set('classes', $classes);

        $categories = $this->EBook->Category->GetCategories();
        $this->set('categories', $categories);
    }

    public function admin_delete($Id = null)
    {
		$this->layout = 'admin_form_layout';
		
		$Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		if($Session_data["ROLE_ID"]!=ADMIN_ID && $Session_data["ROLE_ID"]!=TEACHER_ID && $Session_data["ROLE_ID"]!=SUPERVISOR_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}
		
        $EbookData = $this->EBook->find('first', array(
            'contain' => array(),
            'conditions' => array('ID' => $Id)
        ));

        $fileName = $EbookData['EBook']['PDF'];
        
        if (!empty($Id)) {
            try {
                if ($this->EBook->delete($Id)) {

                    $this->General->delete_file("/files/upload_document/".$fileName);

                    $this->Session->setFlash('EBook is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid EBook.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }

    public function App_EBookList()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;

        $classId = $this->request->data['CLASS_ID'];

        $this->EBook->virtualFields = array(
            'created' => "DATE_FORMAT(created,'%d/%m/%Y %h:%i %p')"
        );

        $BookData = $this->EBook->find('all', array(
            'conditions' => array('CLASS_ID' => $classId),
            'fields' => array(),
            'contain' => array()
        ));

        $Book = Set::extract('/EBook/.', $BookData);

        if(!empty($Book))
        {
            $message = 'Available E-Book';
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
            'data' => $Book
        );

        echo json_encode($result_array); die;

    }
}