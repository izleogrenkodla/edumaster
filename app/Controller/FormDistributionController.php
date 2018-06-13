<?php
// app/Controller/UsersController.php
class FormDistributionController extends AppController
{
    var $name = 'FormDistribution';

    public function beforeFilter()
    {
        parent::beforeFilter();

        if(isset($this->Security) &&  ($this->RequestHandler->isAjax() || $this->RequestHandler->isPost())){
            $this->Security->validatePost = false;
            $this->Security->enabled = false;
            $this->Security->csrfCheck = false;
        }
    }


     public function admin_index()
    {
        $this->layout = 'admin_form_layout';
        $this->FormDistribution->recursive = 0;
        $this->paginate = array(
            'conditions' => '',
            'limit' => PAGINATION_LIMIT_ADMIN,
        );
       
        $this->set('FormDistribution', $this->paginate('FormDistribution'));
    }


  /*  public function admin_view($id=null){

        $this->layout = 'admin_form_layout';
        $this->FrontAbout->recursive = 0;
        $this->paginate = array(
            'conditions' => array('ABOUT_ID' => $id),
            'limit' => PAGINATION_LIMIT_ADMIN,
        );
       
        $this->set('front', $this->paginate('FrontAbout'));
    }


    public function admin_delete($Id = null)
    {
        $this->layout = 'admin_form_layout';
        if (!empty($Id)) {
            try {
                if ($this->FrontAbout->delete($Id)) {
                    $this->Session->setFlash('About is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid About.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }


      public function admin_edit($id=null){
        
        
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');
     
        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

     
        if ($this->request->is('put') || $this->request->is('post')) {
            
            
            if ($this->FrontAbout->Validation()) {
				
               
				 $logo = '';
                if($this->request->data["FrontAbout"]["LOGO"]["size"]>0) {
                    $logo = $this->request->data["FrontAbout"]["LOGO"];
                    unset($this->request->data["FrontAbout"]["LOGO"]);
                }
				
				 $photo1 = '';
                if($this->request->data["FrontAbout"]["P1"]["size"]>0) {
                    $photo1 = $this->request->data["FrontAbout"]["P1"];
                    unset($this->request->data["FrontAbout"]["P1"]);
                }
				
				 $photo2 = '';
                if($this->request->data["FrontAbout"]["P2"]["size"]>0) {
                    $photo2 = $this->request->data["FrontAbout"]["P2"];
                    unset($this->request->data["FrontAbout"]["P2"]);
                }
				
				 $photo3 = '';
                if($this->request->data["FrontAbout"]["P3"]["size"]>0) {
                    $photo3 = $this->request->data["FrontAbout"]["P3"];
                    unset($this->request->data["FrontAbout"]["P3"]);
                }


				
				
                if ($this->FrontAbout->save($this->request->data)) {
					
					$this->FrontAbout->id = $id;

                    $Data = $this->FrontAbout->find('first', array(
                        'contain' => array(),
                        'conditions' => array('ABOUT_ID' => $id)
                    ));
                    
					if(is_array($logo) && $logo["size"]>0) {

                        $extension = $logo['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname = strtotime(date('Y-m-d H:i:s')).$id.'.'.$ext[1];
                        move_uploaded_file($logo["tmp_name"],$path.$fname);


                        $im = file_get_contents($path.$fname);

                       

                        $fileName1 = $Data['FrontAbout']['LOGO'];

                        if($fileName != '')
                        {
                            $this->General->delete_file("/files/upload_document/".$fileName1);
                        }

                        $this->FrontAbout->saveField("LOGO",$fname);
                        //$this->FrontAbout->saveField("BASE_CODE_LOGO",$imdata);
                    }
					
					if(is_array($photo2) && $photo2["size"]>0) {

                        $extension = $photo2['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname1 = strtotime(date('Y-m-d H:i:s')).$id.'.'.$ext[1];
                        move_uploaded_file($photo2["tmp_name"],$path.$fname1);

                        

                        $im = file_get_contents($path.$fname1);
                       

                        $fileName2 = $Data['FrontAbout']['PHOTO2'];

                        if($fileName != '')
                        {
                            $this->General->delete_file("/files/upload_document/".$fileName2);
                        }

                        $this->FrontAbout->saveField("PHOTO2",$fname1);
                        //$this->FrontAbout->saveField("BASE_CODE_LOGO",$imdata);
                    }
					
					if(is_array($photo1) && $photo1["size"]>0) {

                        $extension = $photo1['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname2 = strtotime(date('Y-m-d H:i:s')).$id.'.'.$ext[1];
                        move_uploaded_file($photo1["tmp_name"],$path.$fname2);

                      

                        $im = file_get_contents($path.$fname2);
                       

                        $fileName3 = $Data['FrontAbout']['PHOTO1'];

                        if($fileName != '')
                        {
                            $this->General->delete_file("/files/upload_document/".$fileName3);
                        }

                        $this->FrontAbout->saveField("PHOTO1",$fname2);
                        //$this->FrontAbout->saveField("BASE_CODE_LOGO",$imdata);
                    }
					
					if(is_array($photo3) && $photo3["size"]>0) {

                        $extension = $photo3['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname3 = strtotime(date('Y-m-d H:i:s')).$id.'.'.$ext[1];
                        move_uploaded_file($photo3["tmp_name"],$path.$fname3);

                        $im = file_get_contents($path.$fname3);
                       
                        

                        $fileName4 = $Data['FrontAbout']['PHOTO3'];

                        if($fileName != '')
                        {
                            $this->General->delete_file("/files/upload_document/".$fileName4);
                        }

                        $this->FrontAbout->saveField("PHOTO3",$fname3);
                        //$this->FrontAbout->saveField("BASE_CODE_LOGO",$imdata);
                    }
					
				
					
                    
                    $this->Session->setFlash('About Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('About  Type Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('About  Type Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $FrontAbout = $this->FrontAbout->find('first', array(
                'contain' => array(),
                'conditions' => array('ABOUT_ID ' => $id)
            ));
            
            //print_r($FrontAbout);die;
            if(empty($FrontAbout)) {
                $this->Session->setFlash('Invalid About  !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            
            
            $this->request->data = $FrontAbout;
            
            }
        }*/

   
   
}