<?php
// app/Controller/UsersController.php
class AdmissionFormsController extends AppController
{
    var $name = 'AdmissionForms';

    public function beforeFilter()
    {
        parent::beforeFilter();

        $this->Auth->allow('App_GetAdmissionForms','App_GetDownloadForms');

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
            'Contain' => array('AcademicClass','Medium'),
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'AdmissionForm.CLASS_ID DESC'
        );

        $this->set('forms', $this->paginate('AdmissionForm'));
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
            $this->AdmissionForm->set($this->request->data);

            if ($this->AdmissionForm->Validation()) {
                $this->AdmissionForm->create();
                $pdf = '';
                if($this->request->data["AdmissionForm"]["UPLOAD_PDF"]["size"]>0) {
                    $pdf = $this->request->data["AdmissionForm"]["UPLOAD_PDF"];
                    unset($this->request->data["AdmissionForm"]["UPLOAD_PDF"]);
                }

                if ($this->AdmissionForm->save($this->request->data)) {
                    if(is_array($pdf) && $pdf["size"]>0) {
                        $lastid = $this->AdmissionForm->getLastInsertId();
                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname = strtotime(date('Y-m-d H:i:s')).$lastid.'.pdf';
                        move_uploaded_file($pdf["tmp_name"],$path.$fname);
                        $this->AdmissionForm->id = $lastid;
                        $this->AdmissionForm->saveField("PDF",$fname);
                    }
                    $this->Session->setFlash('Admission Form Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
            } else {
                $this->Session->setFlash('Admission Form Not Added Please Try Again!', 'message_bad');
            }
        }

        $classes = $this->AdmissionForm->AcademicClass->GetAcademicClasses();
        $this->set('classes', $classes);
        
        $formTypes = $this->AdmissionForm->FormType->GetFormTypes();
        $this->set('formTypes', $formTypes);

        $mediums = $this->AdmissionForm->Medium->GetMedium();
        $this->set('mediums', $mediums);
    }
    
    public function admin_edit($id = null)
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        $this->AdmissionForm->id = $id;
        if (empty($this->AdmissionForm->id)) {
            $this->Session->setFlash('Invalid Admission Form !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->AdmissionForm->Validation()) {
                $pdf = '';
                if($this->request->data["AdmissionForm"]["UPLOAD_PDF"]["size"]>0) {
                    $pdf = $this->request->data["AdmissionForm"]["UPLOAD_PDF"];
                    unset($this->request->data["AdmissionForm"]["UPLOAD_PDF"]);
                }

                if ($this->AdmissionForm->save($this->request->data)) {

                    if(is_array($pdf) && $pdf["size"]>0) {
                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname = strtotime(date('Y-m-d H:i:s')).$id.'.pdf';
                        move_uploaded_file($pdf["tmp_name"],$path.$fname);
                        $this->AdmissionForm->id = $id;
                        
                        $FormData = $this->AdmissionForm->find('first', array(
                            'contain' => array(),
                            'conditions' => array('FORM_ID' => $id)
                        ));

                        $fileName = $FormData['AdmissionForm']['PDF'];

                        if($fileName != '')
                        {
                            $this->General->delete_file("/files/upload_document/".$fileName);
                        }

                        $this->AdmissionForm->saveField("PDF",$fname);
                    }

                    $this->Session->setFlash('Admission Form Updated Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Admission Form Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Admission Form Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $AdmissionForm = $this->AdmissionForm->find('first', array(
                'contain' => array(),
                'conditions' => array('FORM_ID' => $id)
            ));
            if(empty($AdmissionForm)) {
                $this->Session->setFlash('Invalid Admission Form !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $AdmissionForm;
        }

        $classes = $this->AdmissionForm->AcademicClass->GetAcademicClasses();
        $this->set('classes', $classes);
        
        $formTypes = $this->AdmissionForm->FormType->GetFormTypes();
        $this->set('formTypes', $formTypes);

        $mediums = $this->AdmissionForm->Medium->GetMedium();
        $this->set('mediums', $mediums);
    }

    public function admin_delete($Id = null)
    {
        $FormData = $this->AdmissionForm->find('first', array(
            'contain' => array(),
            'conditions' => array('FORM_ID' => $Id)
        ));

        $fileName = $FormData['AdmissionForm']['PDF'];

        $this->layout = 'admin_form_layout';
        if (!empty($Id)) {
            try {
                if ($this->AdmissionForm->delete($Id)) {

                    $this->General->delete_file("/files/upload_document/".$fileName);

                    $this->Session->setFlash('Admission Form is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid Admission Form.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }

    public function App_GetAdmissionForms()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;

        $FormData = $this->AdmissionForm->find('all', array(
            'fields' => array(),
            'conditions' => array('AdmissionForm.STATUS' => 1, 'FORM_TYPE_ID' => 1),
            'contain' => array('AcademicClass','Medium'),
            'order' => 'AcademicClass.CLASS_NAME ASC' 
        ));

        if(!empty($FormData))
        {
            $message = 'Available Forms';
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
            'data' => $FormData
        );

        echo json_encode($result_array); die;

    }
    public function App_GetDownloadForms()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;

        $classId = $this->request->data['CLASS_ID'];
        
        $FormData = $this->AdmissionForm->find('all', array(
            'fields' => array(),
            'conditions' => array('AdmissionForm.STATUS' => 1, 'AdmissionForm.CLASS_ID' => $classId, 'FORM_TYPE_ID !=' => 1),
            'contain' => array('AcademicClass','Medium'),
            'order' => 'AcademicClass.CLASS_NAME ASC' 
        ));


        if(!empty($FormData))
        {
            $message = 'Available Forms';
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
            'data' => $FormData
        );

        echo json_encode($result_array); die;

    }
}