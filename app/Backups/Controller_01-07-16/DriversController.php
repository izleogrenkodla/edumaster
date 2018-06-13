<?php
class DriversController extends AppController
{
    var $name = 'Drivers';
    var $cache_dir = 'img/cache';
    var $cache_width = 400;
    public $msgs = array();

    public function beforeFilter()
    {
        parent::beforeFilter();

        $this->Auth->allow('App_Login','App_UserEdit','App_GetStudentsByRole','App_GetTeachersByRole','App_GetUserInfoByRole','App_GetUserShortInfo');

        //Here, we disable the Security component for Ajax requests.
        if (isset($this->Security) && ($this->RequestHandler->isAjax() || $this->RequestHandler->isPost())) {
            $this->Security->validatePost = false;
            $this->Security->enabled = false;
            $this->Security->csrfCheck = false;
        }
    }

    public function admin_index()
    {
        $this->layout = 'admin_form_layout';
        $this->paginate = array(
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'Driver.FIRST_NAME ASC'
        );

        $this->set('drivers', $this->paginate('Driver'));
    }

    public function admin_add()
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->redirect(array('action' => 'login'));
        }
        if ($this->request->is('post')) {
            $this->Driver->set($this->request->data);
            if ($this->Driver->Validation()) {
                $this->Driver->create();

                $img = '';
                if(isset($this->request->data["Driver"]["UPLOAD_IMAGE"]["size"]) && $this->request->data["Driver"]["UPLOAD_IMAGE"]["size"] >0) {
                    $img = $this->request->data["Driver"]["UPLOAD_IMAGE"];
                    unset($this->request->data["Driver"]["UPLOAD_IMAGE"]);
                }

                if ($this->Driver->save($this->request->data)) {

                    $lastid = $this->Driver->getLastInsertId();

                    if(is_array($img) && $img["size"]>0) {

                        $extension = $img['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname = strtotime(date('Y-m-d H:i:s')).$lastid.'.'.$ext[1];
                        move_uploaded_file($img["tmp_name"],$path.$fname);

                        $im = file_get_contents($path.$fname);
                        $imdata = base64_encode($im);

                        $this->Driver->id = $lastid;

                        $this->Driver->saveField("IMAGE_URL",$fname);
                        $this->Driver->saveField("BASE_CODE",$imdata);

                    }

                    $this->Session->setFlash('Driver Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
                else {
                    $this->Session->setFlash('Driver Not Added Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Driver Not Added Please Try Again!', 'message_bad');
            }
        }
    }

    public function admin_edit($id = null)
    {
        $this->layout = 'admin_form_layout';
        $this->Driver->id = $id;
        if (empty($this->Driver->id)) {
            $this->Session->setFlash('Invalid Driver !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Driver->Validation()) {
                $img = '';
                if(isset($this->request->data["Driver"]["UPLOAD_IMAGE"]["size"]) && $this->request->data["User"]["UPLOAD_IMAGE"]["size"] >0) {
                    $img = $this->request->data["Driver"]["UPLOAD_IMAGE"];
                    unset($this->request->data["Driver"]["UPLOAD_IMAGE"]);
                }

                if ($this->Driver->save($this->request->data)) {

                    $this->Driver->id = $id;

                    $UserData = $this->Driver->find('first', array(
                        'contain' => array(),
                        'conditions' => array('DRIVER_ID' => $id)
                    ));

                    if(is_array($img) && $img["size"]>0) {

                        $extension = $img['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname = strtotime(date('Y-m-d H:i:s')).$id.'.'.$ext[1];
                        move_uploaded_file($img["tmp_name"],$path.$fname);

                        $im = file_get_contents($path.$fname);
                        $imdata = base64_encode($im);

                        $fileName = $UserData['Driver']['IMAGE_URL'];

                        if($fileName != '')
                        {
                            $this->General->delete_file("/files/upload_document/".$fileName);
                        }

                        $this->User->saveField("IMAGE_URL",$fname);
                        $this->User->saveField("BASE_CODE",$imdata);
                    }

                    $this->Session->setFlash('Driver Updated Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Driver Not Added Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Driver Not Added Please Try Again!', 'message_bad');
            }
        } else {
            $user = $this->Driver->read(null, $id);

            if (empty($user)) {
                $this->Session->setFlash('Invalid Driver !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $user;
        }
    }

    public function admin_delete($Id = null)
    {
        $this->layout = 'admin_form_layout';
        if (!empty($Id)) {
            if ($this->Driver->delete($Id, false)) {
                $this->Session->setFlash('Driver is successfully deleted', 'message_good');
            }
            $this->redirect(array('action' => 'index'));
        } else {
            $this->Session->setFlash('Invalid Driver', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }

}