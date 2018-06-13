<?php
// app/Controller/UsersController.php
class BlogController extends AppController
{
    var $name = 'Blog';

    public function beforeFilter()
    {
        parent::beforeFilter();

        $this->Auth->allow('App_BlogList','App_BlogDetails');

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
				$conditions['Blog.ROLE_ID']=STUDENT_ID;
			break;
			case TEACHER_ID:
				$conditions['Blog.ROLE_ID']=TEACHER_ID;
			break;
		 }
        
        $this->layout = 'admin_form_layout';
        $this->paginate = array(
            'conditions' => $conditions,
            'Contain' => array('Category','Role','User'),
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'Blog.created DESC'
        );

        $this->set('blogs', $this->paginate('Blog'));
    }
    
    public function admin_add()
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		if($Session_data["ROLE_ID"]!=ADMIN_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}

        if ($this->request->is('post')) {

            $this->Blog->set($this->request->data);

            if ($this->Blog->Validation()) {
                $this->Blog->create();
                $img = '';
                if($this->request->data["Blog"]["UPLOAD_IMAGE"]["size"]>0) {
                    $img = $this->request->data["Blog"]["UPLOAD_IMAGE"];
                    unset($this->request->data["Blog"]["UPLOAD_IMAGE"]);
                }

                $this->request->data["Blog"]['ROLE_ID'] = $Session_data['ROLE_ID'];
                $this->request->data["Blog"]['USER_ID'] = $Session_data['ID'];


                if ($this->Blog->save($this->request->data)) {

                    $lastid = $this->Blog->getLastInsertId();

                    if(is_array($img) && $img["size"]>0) {

                        $extension = $img['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname = strtotime(date('Y-m-d H:i:s')).$lastid.'.'.$ext[1];
                        move_uploaded_file($img["tmp_name"],$path.$fname);

                        $im = file_get_contents($path.$fname);
                        $imdata = base64_encode($im);

                        $this->Blog->id = $lastid;

                        $this->Blog->saveField("BLOG_IMAGE",$fname);
                        $this->Blog->saveField("BASE_CODE",$imdata);
                    }

                    $this->Session->setFlash('Blog Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
            } else {
                $this->Session->setFlash('Blog Not Added Please Try Again!', 'message_bad');
            }
        }

        $categories = $this->Blog->Category->GetCategories();
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
		
		if($Session_data["ROLE_ID"]!=ADMIN_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}

        $this->Blog->id = $id;
        if (empty($this->Blog->id)) {
            $this->Session->setFlash('Invalid Blog !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->Blog->Validation()) {
                $img = '';
                if($this->request->data["Blog"]["UPLOAD_IMAGE"]["size"]>0) {
                    $img = $this->request->data["Blog"]["UPLOAD_IMAGE"];
                    unset($this->request->data["Blog"]["UPLOAD_IMAGE"]);
                }

                $this->request->data["Blog"]['ROLE_ID'] = $Session_data['ROLE_ID'];
                $this->request->data["Blog"]['USER_ID'] = $Session_data['ID'];

                if ($this->Blog->save($this->request->data)) {
                    if(is_array($img) && $img["size"]>0) {

                        $extension = $img['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname = strtotime(date('Y-m-d H:i:s')).$id.'.'.$ext[1];
                        move_uploaded_file($img["tmp_name"],$path.$fname);

                        $im = file_get_contents($path.$fname);
                        $imdata = base64_encode($im);

                        $this->Blog->id = $id;

                        $BlogData = $this->Blog->find('first', array(
                            'contain' => array(),
                            'conditions' => array('BLOG_ID' => $id)
                        ));

                        $fileName = $BlogData['Blog']['BLOG_IMAGE'];

                        if($fileName != '')
                        {
                            $this->General->delete_file("/files/upload_document/".$fileName);
                        }

                        $this->Blog->saveField("BLOG_IMAGE",$fname);
                        $this->Blog->saveField("BASE_CODE",$imdata);
                    }

                    $this->Session->setFlash('Blog Updated Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Blog Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Blog Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $Blog = $this->Blog->find('first', array(
                'contain' => array(),
                'conditions' => array('BLOG_ID' => $id)
            ));
            if(empty($Blog)) {
                $this->Session->setFlash('Invalid Blog !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $Blog;
        }

        $categories = $this->Blog->Category->GetCategories();
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
		
		if($Session_data["ROLE_ID"]!=ADMIN_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}
		
        $BlogData = $this->Blog->find('first', array(
            'contain' => array(),
            'conditions' => array('BLOG_ID' => $Id)
        ));

        $fileName = $BlogData['Blog']['BLOG_IMAGE'];
        
        if (!empty($Id)) {
            try {
                if ($this->Blog->delete($Id)) {

                    $this->General->delete_file("/files/upload_document/".$fileName);

                    $this->Session->setFlash('Blog is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid Blog.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
    }

    public function App_BlogList()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;

        $userRoleId = $this->request->data['ROLE_ID'];

        $this->Blog->virtualFields = array(
            'created' => "DATE_FORMAT(created,'%d/%m/%Y %h:%i %p')"
        );

        $BlogData = $this->Blog->find('all', array(
            'conditions' => array('ROLE_ID' => $userRoleId),
            'fields' => array(),
            'contain' => array()
        ));

        $Blog = Set::extract('/Blog/.', $BlogData);

        if(!empty($Blog))
        {
            $message = 'Blog Available';
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
            'data' => $Blog
        );

        echo json_encode($result_array); die;

    }

    public function App_BlogDetails()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;

        $blogId = $this->request->data['BLOG_ID'];

        $this->Blog->virtualFields = array(
            'created' => "DATE_FORMAT(created,'%d/%m/%Y %h:%i %p')"
        );

        if(!empty($blogId))
        {
            $TempData = $this->Blog->find('first', array(
                'contain' => array(),
                'conditions' => array('BLOG_ID' => $blogId,'STATUS' => 1)
            ));

            $Data = Set::extract('/Blog/.', $TempData);

            if(!empty($Data))
            {
                $message = 'Available Details!';
                $status = true;
            }
            else
            {
                $message = 'No Records Found!';
                $status = false;
            }
        }
        else
        {
            $message = 'Opps something wrong!';
            $status = false;
        }

        $result_array = array(
            'status' => $status,
            'message' => $message,
            'data' => $Data
        );

        echo json_encode($result_array); die;

    }
}