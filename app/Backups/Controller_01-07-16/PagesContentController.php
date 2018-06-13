<?php
// app/Controller/UsersController.php
class PagesContentController extends AppController
{
    var $name = 'PagesContent';

    public function beforeFilter()
    {
        parent::beforeFilter();

        $this->Auth->allow('App_GetContent');

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
            'Contain' => array('PageName'),
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'PagesContent.created DESC'
        );

        $this->set('pagescontent', $this->paginate('PagesContent'));
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

            $this->PagesContent->set($this->request->data);

            if ($this->PagesContent->Validation()) {
                $this->PagesContent->create();
                $img = '';
                if($this->request->data["PagesContent"]["UPLOAD_IMAGE"]["size"]>0) {
                    $img = $this->request->data["PagesContent"]["UPLOAD_IMAGE"];
                    unset($this->request->data["PagesContent"]["UPLOAD_IMAGE"]);
                }

                if ($this->PagesContent->save($this->request->data)) {

                    $lastid = $this->PagesContent->getLastInsertId();

                    if(is_array($img) && $img["size"]>0) {

                        $extension = $img['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname = strtotime(date('Y-m-d H:i:s')).$lastid.'.'.$ext[1];
                        move_uploaded_file($img["tmp_name"],$path.$fname);

                        $im = file_get_contents($path.$fname);
                        $imdata = base64_encode($im);

                        $this->PagesContent->id = $lastid;

                        $this->PagesContent->saveField("CONTENT_IMAGE",$fname);
                        $this->PagesContent->saveField("BASE_CODE",$imdata);
                    }

                    $this->Session->setFlash('Page Content Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
            } else {
                $this->Session->setFlash('Page Content Not Added Please Try Again!', 'message_bad');
            }
        }

        $pagenames = $this->PagesContent->PageName->GetPageNames();
        $this->set('pagenames', $pagenames);
    }
    
    public function admin_edit($id = null)
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        $this->PagesContent->id = $id;
        if (empty($this->PagesContent->id)) {
            $this->Session->setFlash('Invalid Page Content !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->PagesContent->Validation()) {
                $img = '';
                if($this->request->data["PagesContent"]["UPLOAD_IMAGE"]["size"]>0) {
                    $img = $this->request->data["PagesContent"]["UPLOAD_IMAGE"];
                    unset($this->request->data["PagesContent"]["UPLOAD_IMAGE"]);
                }

                if ($this->PagesContent->save($this->request->data)) {
                    if(is_array($img) && $img["size"]>0) {

                        $extension = $img['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname = strtotime(date('Y-m-d H:i:s')).$id.'.'.$ext[1];
                        move_uploaded_file($img["tmp_name"],$path.$fname);

                        $im = file_get_contents($path.$fname);
                        $imdata = base64_encode($im);

                        $this->PagesContent->id = $id;

                        $ContentData = $this->PagesContent->find('first', array(
                            'contain' => array(),
                            'conditions' => array('CONTENT_ID' => $id)
                        ));

                        $fileName = $ContentData['PagesContent']['CONTENT_IMAGE'];

                        if($fileName != '')
                        {
                            $this->General->delete_file("/files/upload_document/".$fileName);
                        }

                        $this->PagesContent->saveField("CONTENT_IMAGE",$fname);
                        $this->PagesContent->saveField("BASE_CODE",$imdata);
                    }

                    $this->Session->setFlash('Pages Content Updated Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Pages Content Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Pages Content Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $Content = $this->PagesContent->find('first', array(
                'contain' => array(),
                'conditions' => array('CONTENT_ID' => $id)
            ));
            if(empty($Content)) {
                $this->Session->setFlash('Invalid Blog !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $Content;
        }

        $pagenames = $this->PagesContent->PageName->GetPageNames();
        $this->set('pagenames', $pagenames);
    }
    
    public function admin_delete($Id = null)
    {
        $ContentData = $this->PagesContent->find('first', array(
            'contain' => array(),
            'conditions' => array('CONTENT_ID' => $Id)
        ));

        $fileName = $ContentData['PagesContent']['CONTENT_IMAGE'];

        $this->layout = 'admin_form_layout';
        if (!empty($Id)) {
            try {
                if ($this->PagesContent->delete($Id)) {

                    $this->General->delete_file("/files/upload_document/".$fileName);

                    $this->Session->setFlash('Page Content is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid Page Content.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
    }
    
    public function App_GetContent()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;

        $PageId = $this->request->data['PAGE_NAME_ID'];

        if(isset($PageId) && !empty($PageId))
        {
            $TempData = $this->PagesContent->find('first', array(
                //'contain' => array('PageName'),
                'conditions' => array('PagesContent.PAGE_NAME_ID' => $PageId)
            ));

            $Data = Set::extract('/PagesContent/.', $TempData);

            if(!empty($Data))
            {
                $message = 'Content Details!';
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