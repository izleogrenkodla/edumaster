<?php
// app/Controller/UsersController.php
class TestimonialsController extends AppController
{
    var $name = 'Testimonials';

    public function beforeFilter()
    {
        parent::beforeFilter();

        $this->Auth->allow('App_Testimonials');

        if(isset($this->Security) &&  ($this->RequestHandler->isAjax() || $this->RequestHandler->isPost())){
            $this->Security->validatePost = false;
            $this->Security->enabled = false;
            $this->Security->csrfCheck = false;
        }
    }
    
    public function admin_index()
    {
        $this->layout = 'admin_form_layout';
        $this->paginate = array(
            'conditions' => '',
            'Contain' => '',
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'Testimonial.NAME DESC'
        );

        $this->set('testimonials', $this->paginate('Testimonial'));
    }
    
	 public function admin_view($ID = null)
    {
        $this->layout = 'admin_form_layout';
        $Testimonial = $this->Testimonial->find('first', array(
            'contain' => array(),
            'conditions' => array('TESTIMONIAL_ID' => $ID)
        ));
		$this->request->data = $Testimonial;

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

            $this->Testimonial->set($this->request->data);

            if ($this->Testimonial->Validation()) {
                $this->Testimonial->create();
                $img = '';
                if($this->request->data["Testimonial"]["UPLOAD_IMAGE"]["size"]>0) {
                    $img = $this->request->data["Testimonial"]["UPLOAD_IMAGE"];
                    unset($this->request->data["Testimonial"]["UPLOAD_IMAGE"]);
                }

                if ($this->Testimonial->save($this->request->data)) {

                    $lastid = $this->Testimonial->getLastInsertId();

                    if(is_array($img) && $img["size"]>0) {

                        $extension = $img['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname = strtotime(date('Y-m-d H:i:s')).$lastid.'.'.$ext[1];
                        move_uploaded_file($img["tmp_name"],$path.$fname);

                        $im = file_get_contents($path.$fname);
                        //$imdata = base64_encode($im);

                        $this->Testimonial->id = $lastid;

                        $this->Testimonial->saveField("PROFILE_IMAGE",$fname);
                        //$this->Testimonial->saveField("BASE_CODE",$imdata);
                    }

                    $this->Session->setFlash('Testimonial Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
            } else {
                $this->Session->setFlash('Testimonial Not Added Please Try Again!', 'message_bad');
            }
        }
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

        $this->Testimonial->id = $id;
        if (empty($this->Testimonial->id)) {
            $this->Session->setFlash('Invalid Testimonial !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->Testimonial->Validation()) {
                $img = '';
                if($this->request->data["Testimonial"]["UPLOAD_IMAGE"]["size"]>0) {
                    $img = $this->request->data["Testimonial"]["UPLOAD_IMAGE"];
                    unset($this->request->data["Testimonial"]["UPLOAD_IMAGE"]);
                }

                if ($this->Testimonial->save($this->request->data)) {
                    if(is_array($img) && $img["size"]>0) {

                        $extension = $img['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname = strtotime(date('Y-m-d H:i:s')).$id.'.'.$ext[1];
                        move_uploaded_file($img["tmp_name"],$path.$fname);

                        $im = file_get_contents($path.$fname);
                        //$imdata = base64_encode($im);

                        $this->Testimonial->id = $id;

                        $TestimonialData = $this->Testimonial->find('first', array(
                            'contain' => array(),
                            'conditions' => array('TESTIMONIALS_ID' => $id)
                        ));

                        $fileName = $TestimonialData['Testimonial']['PROFILE_IMAGE'];

                        if($fileName != '')
                        {
                            $this->General->delete_file("/files/upload_document/".$fileName);
                        }

                        $this->Testimonial->saveField("PROFILE_IMAGE",$fname);
                        //$this->Testimonial->saveField("BASE_CODE",$imdata);
                    }

                    $this->Session->setFlash('Testimonial Updated Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Testimonial Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Testimonial Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $Content = $this->Testimonial->find('first', array(
                'contain' => array(),
                'conditions' => array('TESTIMONIAL_ID' => $id)
            ));
            if(empty($Content)) {
                $this->Session->setFlash('Invalid Testimonial !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $Content;
        }
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
		
        $ContentData = $this->Testimonial->find('first', array(
            'contain' => array(),
            'conditions' => array('TESTIMONIAL_ID' => $Id)
        ));

        $fileName = $ContentData['Testimonial']['PROFILE_IMAGE'];
        
        if (!empty($Id)) {
            try {
                if ($this->Testimonial->delete($Id)) {

                    $this->General->delete_file("/files/upload_document/".$fileName);

                    $this->Session->setFlash('Testimonial is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid Testimonial.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
    }

    public function App_Testimonials()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;

        $TestimonialData = $this->Testimonial->find('all', array(
            'conditions' => array('STATUS' => 1),
            'fields' => array(),
            'contain' => array(),
            'order' => 'NAME ASC' 
        ));

        $Testimonial = Set::extract('/Testimonial/.', $TestimonialData);

        if(!empty($Testimonial))
        {
            $message = 'Available Testimonials';
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
            'data' => $Testimonial
        );

        echo json_encode($result_array); die;

    }


}