<?php
// app/Controller/UsersController.php
class AlbumController extends AppController
{
    var $name = 'Album';

    public function beforeFilter()
    {
        parent::beforeFilter();

        $this->Auth->allow('App_AlbumList','App_AlbumDetails');

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
            'conditions' => array('ALBUM_TYPE' => 1),
            'Contain' => array('AcademicClass'),
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'Album.ALBUM_NAME DESC'
        );

        $this->set('albums', $this->paginate('Album'));
    }
    
    public function admin_school()
    {
        $this->layout = 'admin_form_layout';
        $this->paginate = array(
            'conditions' => array('ALBUM_TYPE' => 2),
            'Contain' => array('AcademicClass'),
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'Album.ALBUM_NAME DESC'
        );

        $this->set('albums', $this->paginate('Album'));
    }
    
    public function admin_certification()
    {
        $this->layout = 'admin_form_layout';
        $this->paginate = array(
            'conditions' => array('ALBUM_TYPE' => 3),
            'Contain' => array('AcademicClass'),
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'Album.ALBUM_NAME DESC'
        );

        $this->set('albums', $this->paginate('Album'));
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

            $this->Album->set($this->request->data);

            if ($this->Album->Validation()) {
                $this->Album->create();
                $img = '';
                if(isset($this->request->data["Album"]["UPLOAD_IMAGE"]["size"]) && $this->request->data["Album"]["UPLOAD_IMAGE"]["size"]>0) {
                    $img = $this->request->data["Album"]["UPLOAD_IMAGE"];
                    unset($this->request->data["Album"]["UPLOAD_IMAGE"]);
                }

                if ($this->Album->save($this->request->data)) {

                    $lastid = $this->Album->getLastInsertId();

                    if(is_array($img) && $img["size"]>0) {

                        $extension = $img['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname = strtotime(date('Y-m-d H:i:s')).$lastid.'.'.$ext[1];
                        move_uploaded_file($img["tmp_name"],$path.$fname);

                        $im = file_get_contents($path.$fname);
                        //$imdata = base64_encode($im);

                        $this->Album->id = $lastid;

                        $this->Album->saveField("COVER_IMAGE",$fname);
                        //$this->Album->saveField("BASE_CODE",$imdata);
                    }

                    $this->Session->setFlash('Album Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
            } else {
                $this->Session->setFlash('Album Not Added Please Try Again!', 'message_bad');
            }
        }

        $classes = $this->Album->AcademicClass->GetAcademicClasses();
        $this->set('classes', $classes);
    }
    
    public function admin_add_school()
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'school'));
        }
		
		if($Session_data["ROLE_ID"]!=ADMIN_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}

        if ($this->request->is('post')) {

            $this->Album->set($this->request->data);

            if ($this->Album->Validation()) {
                $this->Album->create();
                $img = '';
                if(isset($this->request->data["Album"]["UPLOAD_IMAGE"]["size"]) && $this->request->data["Album"]["UPLOAD_IMAGE"]["size"]>0) {
                    $img = $this->request->data["Album"]["UPLOAD_IMAGE"];
                    unset($this->request->data["Album"]["UPLOAD_IMAGE"]);
                }

                if ($this->Album->save($this->request->data)) {

                    $lastid = $this->Album->getLastInsertId();

                    if(is_array($img) && $img["size"]>0) {

                        $extension = $img['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname = strtotime(date('Y-m-d H:i:s')).$lastid.'.'.$ext[1];
                        move_uploaded_file($img["tmp_name"],$path.$fname);

                        $im = file_get_contents($path.$fname);
                        //$imdata = base64_encode($im);

                        $this->Album->id = $lastid;

                        $this->Album->saveField("COVER_IMAGE",$fname);
                        //$this->Album->saveField("BASE_CODE",$imdata);
                    }

                    $this->Session->setFlash('Album Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'school'));
                }
            } else {
                $this->Session->setFlash('Album Not Added Please Try Again!', 'message_bad');
            }
        }

    }
    
    public function admin_add_certification()
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'certification'));
        }
		
		/*if($Session_data["ROLE_ID"]!=ADMIN_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}*/

        if ($this->request->is('post')) {

            $this->Album->set($this->request->data);

            if ($this->Album->Validation()) {
                $this->Album->create();
                $img = '';
                if(isset($this->request->data["Album"]["UPLOAD_IMAGE"]["size"]) && $this->request->data["Album"]["UPLOAD_IMAGE"]["size"]>0) {
                    $img = $this->request->data["Album"]["UPLOAD_IMAGE"];
                    unset($this->request->data["Album"]["UPLOAD_IMAGE"]);
                }

                if ($this->Album->save($this->request->data)) {

                    $lastid = $this->Album->getLastInsertId();

                    if(is_array($img) && $img["size"]>0) {

                        $extension = $img['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname = strtotime(date('Y-m-d H:i:s')).$lastid.'.'.$ext[1];
                        move_uploaded_file($img["tmp_name"],$path.$fname);

                        $im = file_get_contents($path.$fname);
                        //$imdata = base64_encode($im);

                        $this->Album->id = $lastid;

                        $this->Album->saveField("COVER_IMAGE",$fname);
                        //$this->Album->saveField("BASE_CODE",$imdata);
                    }

                    $this->Session->setFlash('Album Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'certification'));
                }
            } else {
                $this->Session->setFlash('Album Not Added Please Try Again!', 'message_bad');
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

        $this->Album->id = $id;
        if (empty($this->Album->id)) {
            $this->Session->setFlash('Invalid Album !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->Album->Validation()) {
                $img = '';
                if(isset($this->request->data["Album"]["UPLOAD_IMAGE"]["size"]) && $this->request->data["Album"]["UPLOAD_IMAGE"]["size"]>0) {
                    $img = $this->request->data["Album"]["UPLOAD_IMAGE"];
                    unset($this->request->data["Album"]["UPLOAD_IMAGE"]);
                }

                if ($this->Album->save($this->request->data)) {
                    if(is_array($img) && $img["size"]>0) {

                        $extension = $img['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname = strtotime(date('Y-m-d H:i:s')).$id.'.'.$ext[1];
                        move_uploaded_file($img["tmp_name"],$path.$fname);

                        $im = file_get_contents($path.$fname);
                        //$imdata = base64_encode($im);

                        $this->Album->id = $id;

                        $AlbumData = $this->Album->find('first', array(
                            'contain' => array(),
                            'conditions' => array('ALBUM_ID' => $id)
                        ));

                        $fileName = $AlbumData['Album']['COVER_IMAGE'];

                        if($fileName != '')
                        {
                            $this->General->delete_file("/files/upload_document/".$fileName);
                        }

                        $this->Album->saveField("COVER_IMAGE",$fname);
                        //$this->Album->saveField("BASE_CODE",$imdata);
                    }

                    $this->Session->setFlash('Album Updated Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Album Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Album Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $Album = $this->Album->find('first', array(
                'contain' => array(),
                'conditions' => array('ALBUM_ID' => $id)
            ));
            if(empty($Album)) {
                $this->Session->setFlash('Invalid Album !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $Album;
        }

        $classes = $this->Album->AcademicClass->GetAcademicClasses();
        $this->set('classes', $classes);
    }
    
    public function admin_edit_school($id = null)
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'school'));
        }
		
		if($Session_data["ROLE_ID"]!=ADMIN_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}

        $this->Album->id = $id;
        if (empty($this->Album->id)) {
            $this->Session->setFlash('Invalid Album !', 'message_bad');
            $this->redirect(array('action' => 'school'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->Album->Validation()) {
                $img = '';
                if(isset($this->request->data["Album"]["UPLOAD_IMAGE"]["size"]) && $this->request->data["Album"]["UPLOAD_IMAGE"]["size"]>0) {
                    $img = $this->request->data["Album"]["UPLOAD_IMAGE"];
                    unset($this->request->data["Album"]["UPLOAD_IMAGE"]);
                }

                if ($this->Album->save($this->request->data)) {
                    if(is_array($img) && $img["size"]>0) {

                        $extension = $img['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname = strtotime(date('Y-m-d H:i:s')).$id.'.'.$ext[1];
                        move_uploaded_file($img["tmp_name"],$path.$fname);

                        $im = file_get_contents($path.$fname);
                        //$imdata = base64_encode($im);

                        $this->Album->id = $id;

                        $AlbumData = $this->Album->find('first', array(
                            'contain' => array(),
                            'conditions' => array('ALBUM_ID' => $id)
                        ));

                        $fileName = $AlbumData['Album']['COVER_IMAGE'];

                        if($fileName != '')
                        {
                            $this->General->delete_file("/files/upload_document/".$fileName);
                        }

                        $this->Album->saveField("COVER_IMAGE",$fname);
                        //$this->Album->saveField("BASE_CODE",$imdata);
                    }

                    $this->Session->setFlash('Album Updated Successfully!', 'message_good');
                    $this->redirect(array('action' => 'school'));
                } else {
                    $this->Session->setFlash('Album Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Album Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $Album = $this->Album->find('first', array(
                'contain' => array(),
                'conditions' => array('ALBUM_ID' => $id)
            ));
            if(empty($Album)) {
                $this->Session->setFlash('Invalid Album !', 'message_bad');
                $this->redirect(array('action' => 'school'));
            }
            $this->request->data = $Album;
        }

    }
    
    public function admin_edit_certification($id = null)
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'certification'));
        }
		
		if($Session_data["ROLE_ID"]!=ADMIN_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}

        $this->Album->id = $id;
        if (empty($this->Album->id)) {
            $this->Session->setFlash('Invalid Album !', 'message_bad');
            $this->redirect(array('action' => 'certification'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->Album->Validation()) {
                $img = '';
                if(isset($this->request->data["Album"]["UPLOAD_IMAGE"]["size"]) && $this->request->data["Album"]["UPLOAD_IMAGE"]["size"]>0) {
                    $img = $this->request->data["Album"]["UPLOAD_IMAGE"];
                    unset($this->request->data["Album"]["UPLOAD_IMAGE"]);
                }

                if ($this->Album->save($this->request->data)) {
                    if(is_array($img) && $img["size"]>0) {

                        $extension = $img['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname = strtotime(date('Y-m-d H:i:s')).$id.'.'.$ext[1];
                        move_uploaded_file($img["tmp_name"],$path.$fname);

                        $im = file_get_contents($path.$fname);
                        //$imdata = base64_encode($im);

                        $this->Album->id = $id;

                        $AlbumData = $this->Album->find('first', array(
                            'contain' => array(),
                            'conditions' => array('ALBUM_ID' => $id)
                        ));

                        $fileName = $AlbumData['Album']['COVER_IMAGE'];

                        if($fileName != '')
                        {
                            $this->General->delete_file("/files/upload_document/".$fileName);
                        }

                        $this->Album->saveField("COVER_IMAGE",$fname);
                        //$this->Album->saveField("BASE_CODE",$imdata);
                    }

                    $this->Session->setFlash('Album Updated Successfully!', 'message_good');
                    $this->redirect(array('action' => 'certification'));
                } else {
                    $this->Session->setFlash('Album Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Album Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $Album = $this->Album->find('first', array(
                'contain' => array(),
                'conditions' => array('ALBUM_ID' => $id)
            ));
            if(empty($Album)) {
                $this->Session->setFlash('Invalid Album !', 'message_bad');
                $this->redirect(array('action' => 'certification'));
            }
            $this->request->data = $Album;
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
		
        $AlbumData = $this->Album->find('first', array(
            'contain' => array(),
            'conditions' => array('ALBUM_ID' => $Id)
        ));

        $fileName = $AlbumData['Album']['COVER_IMAGE'];
        
        if (!empty($Id)) {
            try {
                if ($this->Album->delete($Id)) {

                    $this->General->delete_file("/files/upload_document/".$fileName);

                    $this->Session->setFlash('Album is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid Album.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
    }
    
    public function admin_delete_school($Id = null)
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
		
        $AlbumData = $this->Album->find('first', array(
            'contain' => array(),
            'conditions' => array('ALBUM_ID' => $Id)
        ));

        $fileName = $AlbumData['Album']['COVER_IMAGE'];
        
        if (!empty($Id)) {
            try {
                if ($this->Album->delete($Id)) {

                    $this->General->delete_file("/files/upload_document/".$fileName);

                    $this->Session->setFlash('Album is successfully deleted', 'message_good');
                    $this->redirect(array('action' => 'school'));
                } else {
                    $this->redirect(array('action' => 'school'));
                    $this->Session->setFlash('Record was not deleted. Unknown error.', 'message_bad');
                }
            } catch (Exception $e) {
                $this->Session->setFlash("Delete failed. {$e->getMessage()}", 'message_bad');
                $this->redirect(array('action' => 'school'));
            }
            $this->redirect(array('action' => 'school'));
        } else {
            $this->Session->setFlash('Invalid Album.', 'message_bad');
            $this->redirect(array('action' => 'school'));
        }
    }
    
    public function admin_delete_certification($Id = null)
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
		
        $AlbumData = $this->Album->find('first', array(
            'contain' => array(),
            'conditions' => array('ALBUM_ID' => $Id)
        ));

        $fileName = $AlbumData['Album']['COVER_IMAGE'];

        if (!empty($Id)) {
            try {
                if ($this->Album->delete($Id)) {

                    $this->General->delete_file("/files/upload_document/".$fileName);

                    $this->Session->setFlash('Album is successfully deleted', 'message_good');
                    $this->redirect(array('action' => 'certification'));
                } else {
                    $this->redirect(array('action' => 'certification'));
                    $this->Session->setFlash('Record was not deleted. Unknown error.', 'message_bad');
                }
            } catch (Exception $e) {
                $this->Session->setFlash("Delete failed. {$e->getMessage()}", 'message_bad');
                $this->redirect(array('action' => 'certification'));
            }
            $this->redirect(array('action' => 'certification'));
        } else {
            $this->Session->setFlash('Invalid Album.', 'message_bad');
            $this->redirect(array('action' => 'certification'));
        }
    }
    
    public function admin_gallery($id = null)
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
		
        $this->Album->id = $id;
        if (!$this->Album->exists()) {
            $this->Session->setFlash('Invalid Album', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
        $this->set('ALBUM_ID', $id);
          
        if (!empty($_FILES)) {
          $path_root = "/files/" . UPLOAD_SCHOOL_GALLERY_PHOTO;	
            $this->Upload->do_upload($path_root, 'file');
            //pr($this->Upload->results['urls']); exit;
            // save uploaded items in db
            
            if (!empty($this->Upload->results['urls'])) {
                // loop through files
                 

                foreach ($this->Upload->results['urls'] as $k => $v) {
                   $new_data['Gallery'] = array();
                    $this->Album->Gallery->create();
                    
                     $im = file_get_contents(WWW_ROOT.$v);
                     //$imdata = base64_encode($im);
                    $new_data['Gallery'] = array(
                        'ALBUM_ID' => $id,
                        'IMAGE_URL' => str_replace($path_root,'',$v),
                        //'BASE_CODE'=>$imdata
                        
                    );
                    $this->Album->Gallery->save($new_data);
                }
                // create resized version
                foreach ($this->Upload->results['urls'] as $k => $v) {
                    // resize image
                    $this->Upload->resize_image($v, $this->cache_width);
                }
            }
            // check for file upload errors
            if (!empty($this->Upload->errors) || empty($this->Upload->results['urls'])) {
                //pr($this->Upload->errors);die;
                // set flash
                $this->Session->setFlash('Upload errors occured or items need to be uploaded.', 'message_bad');
                // save errors in session
                $this->Session->write('upload_errors', $this->Upload->errors);
                $this->redirect(array('action' => "gallery/{$id}"));
            } else {
                $this->Session->setFlash('Gallery images uploaded successfully', 'message_good');
                $this->redirect(array('action' => "gallery/{$id}"));
            }
        }
        $image_data = $this->Album->Gallery->find('all', array(
            'fields' => array('GALLERY_ID', 'ALBUM_ID','IMAGE_URL'),
            'conditions' => array('ALBUM_ID' => $id),
            'recursive' => -1
        ));
        $this->set('image_data', $image_data);
    }

    public function admin_delete_gallery_image($Id = null)
    {
		$Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		if($Session_data["ROLE_ID"]!=ADMIN_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}
		
        if ($this->request->is('ajax')) {
            $this->autoRender = false;
            if (!empty($Id)) {
                $data = $this->Album->Gallery->find('first', array(
                    'contain' => array(),
                    'conditions' => array('Gallery.GALLERY_ID' => $Id)));
                if ($this->Album->Gallery->delete($Id, false)) {
                    if ($data['Gallery']['IMAGE_URL']) {
                        $this->General->delete_file($data['Gallery']['IMAGE_URL']);
                    }
                    echo "1";
                } else {
                    echo "0";
                }
            } else {
                $this->redirect(array('action' => 'index'));
            }
        }
    }
    
    public function App_AlbumList()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $conditions = array();
        $status = false;

        $AlbumType = 3;
        
	 $conditions[] = array('ALBUM_TYPE' => $AlbumType, 'Album.STATUS' => 1);

        if(isset($AlbumType) && !empty($AlbumType))
        {
            if(isset($AlbumType) && $AlbumType == CLASS_ALBUM)
            {
                $classId = $this->request->data['CLASS_ID'];
                $conditions[] = array('ALBUM_TYPE' => $AlbumType,'Album.CLASS_ID' => $classId, 'Album.STATUS' => 1);
            }
            if(isset($AlbumType) && $AlbumType == SCHOOL_GALLAERY_ALBUM)
            {
                $conditions[] = array('ALBUM_TYPE' => $AlbumType, 'Album.STATUS' => 1);
            }
            if(isset($AlbumType) && $AlbumType == CERTIFICATION_ALBUM)
            {
                $conditions[] = array('ALBUM_TYPE' => $AlbumType, 'Album.STATUS' => 1);
            }
            
            $AlbumData = $this->Album->find('all', array(
                'conditions' => $conditions,
               
            ));
            
            if(is_array($AlbumData)) 
            {
		foreach($AlbumData as $k=>$data)  
		{  
			$AlbumData[$k]["Album"]["GALLERY_COUNT"] = sizeof($data["Gallery"]);
		}
	    } 

            $Album = Set::extract('/Album/.', $AlbumData);

            if(!empty($Album))
            {
                $message = 'Available Album';
                $status = true;
                $data = $Album;
            }
            else
            {
                $message = 'No Data Found';
                $status = false;
                $data = '';
            }
        }
        else
        {
            $message = 'No Data Found';
            $status = false;
            $data = '';
        }
        
        $result_array = array(
            'status' => $status,
            'message' => $message,
            'data' => $data
        );

        echo json_encode($result_array); die;

    }
    
    public function App_AlbumDetails()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;

        $albumId = $this->request->data['ALBUM_ID'];

        if(!empty($albumId))
        {
            $this->Gallery = ClassRegistry::init('Gallery');

            $TempData = $this->Gallery->find('all', array(
                'contain' => array(),
                'conditions' => array('ALBUM_ID' => $albumId)
            ));

            $Data = Set::extract('/Gallery/.', $TempData);

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