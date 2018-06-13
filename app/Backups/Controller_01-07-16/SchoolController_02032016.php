<?php
// app/Controller/UsersController.php
class SchoolController extends AppController
{
    var $name = 'School';

    public function beforeFilter()
    {
        parent::beforeFilter();

        $this->Auth->allow('App_SchoolDetails');

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
            //'Contain' => array('Role','AcademicClass'),
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'School.SCHOOL_NAME DESC'
        );
        
        /*$this->Event->virtualFields = array(
			    'EVENT_START' => "DATE_FORMAT(EVENT_START,'%d/%m/%Y')",
			    'EVENT_END' => "DATE_FORMAT(EVENT_END,'%d/%m/%Y')"
		        );*/

        $this->set('schools', $this->paginate('School'));
    }
    
    public function admin_view($id = null)
    {
        $this->layout = 'admin_form_layout';
        $this->School->id = $id;

        if (empty($this->School->id)) {

            $this->Session->setFlash('Invalid School !', 'message_bad');
            $this->redirect(array('action' => 'index'));

        }

        $school = $this->School->read(null, $id);

        if (empty($school)) {
            $this->Session->setFlash('Invalid user !', 'message_bad');
            $this->redirect(array('action' => 'teachers'));
        }
        $this->request->data = $school;

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

           $this->School->set($this->request->data);

            if ($this->School->Validation()) {
                $this->School->create();
                $logo = '';
                if($this->request->data["School"]["UPLOAD_LOGO"]["size"]>0) {
                    $logo = $this->request->data["School"]["UPLOAD_LOGO"];
                    unset($this->request->data["School"]["UPLOAD_LOGO"]);
                }

                $map = '';
                if($this->request->data["School"]["UPLOAD_MAP"]["size"]>0) {
                    $map = $this->request->data["School"]["UPLOAD_MAP"];
                    unset($this->request->data["School"]["UPLOAD_MAP"]);
                }

                $pdf = '';
                if($this->request->data["School"]["UPLOAD_BROCHURE"]["size"]>0) {
                    $pdf = $this->request->data["School"]["UPLOAD_BROCHURE"];
                    unset($this->request->data["School"]["UPLOAD_BROCHURE"]);
                }

                if ($this->School->save($this->request->data)) {

                    $lastid = $this->School->getLastInsertId();

                    if(is_array($logo) && $logo["size"]>0) {

                        $extension = $logo['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname = strtotime(date('Y-m-d H:i:s')).$lastid.'.'.$ext[1];
                        move_uploaded_file($logo["tmp_name"],$path.$fname);

                        $im = file_get_contents($path.$fname);
                        $imdata = base64_encode($im);

                        $this->School->id = $lastid;

                        $this->School->saveField("LOGO_IMAGE",$fname);
                        $this->School->saveField("BASE_CODE_LOGO",$imdata);
                    }

                    if(is_array($map) && $map["size"]>0) {

                        $extension = $map['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname = strtotime(date('Y-m-d H:i:s')).$lastid.'.'.$ext[1];
                        move_uploaded_file($map["tmp_name"],$path.$fname);

                        $im = file_get_contents($path.$fname);
                        $imdata = base64_encode($im);

                        $this->School->id = $lastid;

                        $this->School->saveField("ADDRESS_IMAGE",$fname);
                        $this->School->saveField("BASE_CODE_ADDRESS",$imdata);
                    }

                    if(is_array($pdf) && $pdf["size"]>0) {
                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname = strtotime(date('Y-m-d H:i:s')).$lastid.'.pdf';
                        move_uploaded_file($pdf["tmp_name"],$path.$fname);
                        $this->School->id = $lastid;
                        $this->School->saveField("BROCHURE",$fname);
                    }

                    $this->Session->setFlash('School Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
            } else
            {
                $this->Session->setFlash('School Not Added Please Try Again!', 'message_bad');
            }
        }

        /*$classes = $this->Event->AcademicClass->GetAcademicClasses();
        $this->set('classes', $classes);*/
    }
    
    public function admin_edit($id = null)
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        $this->School->id = $id;
        if (empty($this->School->id)) {
            $this->Session->setFlash('Invalid School !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->School->Validation()) {
                $logo = '';
                if($this->request->data["School"]["UPLOAD_LOGO"]["size"]>0) {
                    $logo = $this->request->data["School"]["UPLOAD_LOGO"];
                    unset($this->request->data["School"]["UPLOAD_LOGO"]);
                }

                $map = '';
                if($this->request->data["School"]["UPLOAD_MAP"]["size"]>0) {
                    $map = $this->request->data["School"]["UPLOAD_MAP"];
                    unset($this->request->data["School"]["UPLOAD_MAP"]);
                }

                $pdf = '';
                if($this->request->data["School"]["UPLOAD_BROCHURE"]["size"]>0) {
                    $pdf = $this->request->data["School"]["UPLOAD_BROCHURE"];
                    unset($this->request->data["School"]["UPLOAD_BROCHURE"]);
                }

                if ($this->School->save($this->request->data)) {

                    $this->School->id = $id;

                    $SchoolData = $this->School->find('first', array(
                        'contain' => array(),
                        'conditions' => array('SCHOOL_ID' => $id)
                    ));

                    if(is_array($logo) && $logo["size"]>0) {

                        $extension = $logo['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname = strtotime(date('Y-m-d H:i:s')).$id.'.'.$ext[1];
                        move_uploaded_file($logo["tmp_name"],$path.$fname);

                        $im = file_get_contents($path.$fname);
                        $imdata = base64_encode($im);

                        $fileName = $SchoolData['School']['LOGO_IMAGE'];

                        if($fileName != '')
                        {
                            $this->General->delete_file("/files/upload_document/".$fileName);
                        }

                        $this->School->saveField("LOGO_IMAGE",$fname);
                        $this->School->saveField("BASE_CODE_LOGO",$imdata);
                    }

                    if(is_array($map) && $map["size"]>0) {

                        $extension = $map['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname = strtotime(date('Y-m-d H:i:s')).$id.'.'.$ext[1];
                        move_uploaded_file($map["tmp_name"],$path.$fname);

                        $im = file_get_contents($path.$fname);
                        $imdata = base64_encode($im);

                        $fileName = $SchoolData['School']['ADDRESS_IMAGE'];

                        if($fileName != '')
                        {
                            $this->General->delete_file("/files/upload_document/".$fileName);
                        }

                        $this->School->saveField("ADDRESS_IMAGE",$fname);
                        $this->School->saveField("BASE_CODE_ADDRESS",$imdata);
                    }


                    if(is_array($pdf) && $pdf["size"]>0) {
                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname = strtotime(date('Y-m-d H:i:s')).$id.'.pdf';
                        move_uploaded_file($pdf["tmp_name"],$path.$fname);
                        $this->School->id = $id;
                        $fileName = $SchoolData['School']['BROCHURE'];

                        if($fileName != '')
                        {
                            $this->General->delete_file("/files/upload_document/".$fileName);
                        }

                        $this->School->saveField("BROCHURE",$fname);
                    }

                    $this->Session->setFlash('School Updated Successfully!', 'message_good');
                    $this->redirect(array('action' => 'view/'.$id.''));
                } else {
                    $this->Session->setFlash('School Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('School Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $School = $this->School->find('first', array(
                'contain' => array(),
                'conditions' => array('SCHOOL_ID' => $id)
            ));


            if(empty($School)) {
                $this->Session->setFlash('Invalid School !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }

            $this->request->data = $School;
        }

       /* $classes = $this->Event->AcademicClass->GetAcademicClasses();
        $this->set('classes', $classes);*/
    }
    
    public function admin_delete($Id = null)
    {
        $SchoolData = $this->School->find('first', array(
            'contain' => array(),
            'conditions' => array('SCHOOL_ID' => $Id)
        ));

        $Logo = $SchoolData['School']['LOGO_IMAGE'];
        $AddressImg = $SchoolData['School']['ADDRESS_IMAGE'];
        $Brochure = $SchoolData['School']['BROCHURE'];

        $this->layout = 'admin_form_layout';
        if (!empty($Id)) {
            try {
                if ($this->School->delete($Id)) {

                    $this->General->delete_file("/files/upload_document/".$Logo);
                    $this->General->delete_file("/files/upload_document/".$AddressImg);
                    $this->General->delete_file("/files/upload_document/".$Brochure);

                    $this->Session->setFlash('School is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid School.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
    }
    
    public function App_SchoolDetails()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;

        $schoolId = $this->request->data['SCHOOL_ID'];


        if(!empty($schoolId))
        {
            $TempData = $this->School->find('first', array(
                'contain' => array(),
                'conditions' => array('SCHOOL_ID' => $schoolId,'STATUS' => 1)
            ));

            $Data = Set::extract('/School/.', $TempData);

            if(!empty($Data))
            {
                $message = 'School Details!';
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