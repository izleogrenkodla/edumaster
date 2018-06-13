<?php
// app/Controller/UsersController.php
class VacancyController extends AppController
{
    var $name = 'Vacancy'; 
 
    public function beforeFilter() 
    {
        parent::beforeFilter();

        $this->Auth->allow('App_SaveVacancy');
 
        if(isset($this->Security) &&  ($this->RequestHandler->isAjax() || $this->RequestHandler->isPost())){
            $this->Security->validatePost = false;
            $this->Security->enabled = false;
            $this->Security->csrfCheck = false;
        }
    }

    public function admin_index()
    {
        $this->layout = 'admin_form_layout';
        $this->Vacancy->recursive = 0;
        $this->paginate = array(
           // 'conditions' => array("Vacancy.STATUS"=>1),
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'Vacancy.created DESC'
        );

        $this->set('Vacancy', $this->paginate('Vacancy'));
    }

   
    public function admin_view($id = null)
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        $this->Vacancy->id = $id;
        if (empty($this->Vacancy->id)) {
            $this->Session->setFlash('Invalid Vacancy !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }


            $Vacancy = $this->Vacancy->find('first', array(
                'contain' => array(),
                'conditions' => array('Vacancy.V_ID' => $id)
            ));
            if(empty($Vacancy)) {
                $this->Session->setFlash('Invalid Vacancy !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $Vacancy;
    }

	public function App_SaveVacancy() {
		 $this->layout = 'ajax';
			$this->autoRender = false;
			$message = '';
			$result_array = array();
			$status = false;
			if(!empty($this->request->data['data_set'][0]))
			{
                        $data = json_decode($this->request->data['data_set'], true);
                        $data_new['Vacancy'] = $data[0];                       
			unset($this->request->data['data_set']);
			unset($this->request->data['data_set']);
			$this->Vacancy->set($data_new);
			$this->Vacancy->create();
			if($this->Vacancy->save($data_new)) { 
				$last_id = $this->Vacancy->getInsertId();				
				if(is_array($_FILES["RESULT"]) && !empty($_FILES["RESULT"])) {
					$file = $_FILES["RESULT"];
					// $ext = explode(".",strtolower($file["name"]));
					if($file["size"]>0) { 
						$fname = time().'.'.substr(strrchr($file["name"], '.'), 1);
						$filepath = 'upload_vacancy/';
						if(move_uploaded_file($file["tmp_name"],UPLOADURL.$filepath.$fname)) { 
							$this->Vacancy->id = $last_id;
							$this->Vacancy->saveField("RESUME",SITE_URL.'files/'.$filepath.$fname);
							$message = 'Saved successfully';
							$status = true;
						}	
					} else {
						$message = 'File not selected';
						$status = false;
					}					
				}
			}
			else
			{
				$message = 'Could not save, Please try again.';
				$status = false;
			}
			
			$result_array = array(
				'status' => $status,
				'message' => $message,
			);
			
		}
        else
        {
            $message = 'Opps something wrong!';
            $status = false;

            $result_array = array(
                'status' => $status,
                'message' => $message
            );

        }
	
			echo json_encode($result_array); die;

	}
}