<?php
// app/Controller/UsersController.php
class AdmissionVacancyController extends AppController
{
    var $name = 'AdmissionVacancy';
	
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
		 
		if(isset($this->params->query["CLS"])) {
            $conditions["AdmissionVacancy.CLASS_ID"] = $this->params->query["CLS"];
            $this->request->data["AdmissionVacancy"]["CLS"] = $this->params->query["CLS"];
        }
        $this->layout = 'admin_form_layout';
        $this->AdmissionVacancy->recursive = 0;
        $this->paginate = array(
            'conditions' =>  $conditions,
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'AdmissionVacancy.CLASS_ID ASC'
        );

        $this->set('AdmissionVacancy', $this->paginate('AdmissionVacancy'));
		
		$classes = $this->AdmissionVacancy->AcademicClass->GetAcademicClasses();
        $this->set('classes', $classes);
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
            $this->AdmissionVacancy->set($this->request->data);
            if ($this->AdmissionVacancy->Validation()) {
                $this->AdmissionVacancy->create();
                if ($this->AdmissionVacancy->save($this->request->data)) {
					 
					$this->request->data['Uploaddocument']['USER_ID'] = $Session_data['ID'];
					$this->AdmissionVacancy->saveField("created_by",$Session_data['ID']);
					
					$ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
					$this->AdmissionVacancy->saveField("created_ip",$ip);
					
                    $this->Session->setFlash('Admission Vacancy Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
            } else {
                $this->Session->setFlash('Admission Vacancy Not Added Please Try Again!', 'message_bad');
            }
        }

        $classes = $this->AdmissionVacancy->AcademicClass->GetAcademicClasses();
        $this->set('classes', $classes);


    }

    public function admin_edit($id = null)
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        $this->AdmissionVacancy->id = $id;
        if (empty($this->AdmissionVacancy->id)) {
            $this->Session->setFlash('Invalid Admission Vacancy !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->AdmissionVacancy->Validation()) {
                if ($this->AdmissionVacancy->save($this->request->data)) {
                    $this->Session->setFlash('Admission Vacancy Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Admission Vacancy Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Admission Vacancy Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $AdmissionVacancy = $this->AdmissionVacancy->find('first', array(
                'contain' => array(),
                'conditions' => array('ADM_VAC_ID' => $id)
            ));
            if(empty($AdmissionVacancy)) {
                $this->Session->setFlash('Invalid Admission Vacancy !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $AdmissionVacancy;
        }

       $classes = $this->AdmissionVacancy->AcademicClass->GetAcademicClasses();
        $this->set('classes', $classes);
    }

    public function admin_delete($Id = null)
    {
        $this->layout = 'admin_form_layout';
        if (!empty($Id)) {
            try {
                if ($this->AdmissionVacancy->delete($Id)) {
                    $this->Session->setFlash('Admission Vacancy is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid Admission Vacancy.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }
	
	 public function admin_export_vacancy() 
    {
        App::import('Vendor', 'Export', array('file' => 'Export' . DS . '/excel_xml.php'));
        $xls = new Excel_XML('UTF-8', false, 'Applicant Report');

        $report_column = array('Class Name','Number Of Vacancy',);
        $session_var = 'Filter_AdmissionVacancy';
        $lists = $this->Session->read($session_var);
        $i = 0;

        foreach($lists as $list) {
            $students[0] = $report_column;
            $students[$i+1]  = array(
                 $list["AcademicClass"]["CLASS_NAME"],
                $list["AdmissionVacancy"]["NUM_VACANCY"],
            );
            $i++;
        }

        $xls->addArray($students);
        $xls->generateXML('AdmissionVacancy_'.date('d-m-Y'));
        $this->Session->delete($session_var);
        die;

    }


}
?>