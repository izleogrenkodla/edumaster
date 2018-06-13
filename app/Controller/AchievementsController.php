<?php
// app/Controller/UsersController.php
class AchievementsController extends AppController
{
    var $name = 'Achievements';

    public function beforeFilter()
    {
        parent::beforeFilter();

        $this->Auth->allow('App_AchievementsList','App_GetContent');

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
            'order' => 'Achievement.PAGE_TITLE DESC'
        );

        $this->set('achievements', $this->paginate('Achievement'));
    }
    
    public function admin_add()
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		if($Session_data["ROLE_ID"]!=ADMIN_ID && $Session_data["ROLE_ID"]!=SUPERVISOR_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}

        if ($this->request->is('post')) {

            $this->Achievement->set($this->request->data);

            if ($this->Achievement->Validation()) {
                $this->Achievement->create();
                $img = '';
                if($this->request->data["Achievement"]["UPLOAD_IMAGE"]["size"]>0) {
                    $img = $this->request->data["Achievement"]["UPLOAD_IMAGE"];
                    unset($this->request->data["Achievement"]["UPLOAD_IMAGE"]);
                }

                if ($this->Achievement->save($this->request->data)) {

                    $lastid = $this->Achievement->getLastInsertId();

                    if(is_array($img) && $img["size"]>0) {

                        $extension = $img['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname = strtotime(date('Y-m-d H:i:s')).$lastid.'.'.$ext[1];
                        move_uploaded_file($img["tmp_name"],$path.$fname);

                        $im = file_get_contents($path.$fname);
                        //$imdata = base64_encode($im);

                        $this->Achievement->id = $lastid;

                        $this->Achievement->saveField("ACHIEVEMENT_IMAGE",$fname);
                        //$this->Achievement->saveField("BASE_CODE",$imdata);
                    }

                    $this->Session->setFlash('Achievement Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
            } else {
                $this->Session->setFlash('Achievement Not Added Please Try Again!', 'message_bad');
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
		
		if($Session_data["ROLE_ID"]!=ADMIN_ID && $Session_data["ROLE_ID"]!=SUPERVISOR_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}

        $this->Achievement->id = $id;
        if (empty($this->Achievement->id)) {
            $this->Session->setFlash('Invalid Achievement !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->Achievement->Validation()) {
                $img = '';
                if($this->request->data["Achievement"]["UPLOAD_IMAGE"]["size"]>0) {
                    $img = $this->request->data["Achievement"]["UPLOAD_IMAGE"];
                    unset($this->request->data["Achievement"]["UPLOAD_IMAGE"]);
                }

                if ($this->Achievement->save($this->request->data)) {
                    if(is_array($img) && $img["size"]>0) {

                        $extension = $img['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname = strtotime(date('Y-m-d H:i:s')).$id.'.'.$ext[1];
                        move_uploaded_file($img["tmp_name"],$path.$fname);

                        $im = file_get_contents($path.$fname);
                        //$imdata = base64_encode($im);

                        $this->Achievement->id = $id;

                        $ContentData = $this->Achievement->find('first', array(
                            'contain' => array(),
                            'conditions' => array('PAGE_ID' => $id)
                        ));

                        $fileName = $ContentData['Achievement']['ACHIEVEMENT_IMAGE'];

                        if($fileName != '')
                        {
                            $this->General->delete_file("/files/upload_document/".$fileName);
                        }

                        $this->Achievement->saveField("ACHIEVEMENT_IMAGE",$fname);
                        //$this->Achievement->saveField("BASE_CODE",$imdata);
                    }

                    $this->Session->setFlash('Achievement Updated Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Achievement Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Achievement Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $Content = $this->Achievement->find('first', array(
                'contain' => array(),
                'conditions' => array('PAGE_ID' => $id)
            ));
            if(empty($Content)) {
                $this->Session->setFlash('Invalid Achievement !', 'message_bad');
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
		
		if($Session_data["ROLE_ID"]!=ADMIN_ID && $Session_data["ROLE_ID"]!=SUPERVISOR_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}
		
        $ContentData = $this->Achievement->find('first', array(
            'contain' => array(),
            'conditions' => array('PAGE_ID' => $Id)
        ));

        $fileName = $ContentData['Achievement']['ACHIEVEMENT_IMAGE'];

        if (!empty($Id)) {
            try {
                if ($this->Achievement->delete($Id)) {

                    $this->General->delete_file("/files/upload_document/".$fileName);

                    $this->Session->setFlash('Achievement is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid Achievement.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
    }
    
    public function App_AchievementsList()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;

        $AchievementData = $this->Achievement->find('all', array(
            'conditions' => array('STATUS' => 1),
            'fields' => array(),
            'contain' => array()
        ));
        
        if(is_array($AchievementData)) 
        { 
		foreach($AchievementData as $k=>$value)
		{ 
			$AchievementData[$k]["Achievement"]["PAGE_DESC"] = $this->Achievement->limit_words(strip_tags($value["Achievement"]["PAGE_DESC"]),200);
		}
	}

        $Achievement = Set::extract('/Achievement/.', $AchievementData);

        if(!empty($Achievement))
        {
            $message = 'Available Achievement';
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
            'data' => $Achievement
        );

        echo json_encode($result_array); die;

    }

    public function App_GetContent()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;

        $PageId = $this->request->data['PAGE_ID'];

        if(isset($PageId) && !empty($PageId))
        {
            $TempData = $this->Achievement->find('first', array(
                'conditions' => array('PAGE_ID' => $PageId, 'STATUS' => 1)
            ));

            $Data = Set::extract('/Achievement/.', $TempData);

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