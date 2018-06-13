<?php
// app/Controller/LibraryBulkBookRequestsController.php


class LibraryBulkBookRequestController extends AppController
{
    var $name = 'LibraryBulkBookRequest';

    public function beforeFilter()
    {
        parent::beforeFilter();

        // $this->Auth->allow('App_LibraryBulkBookRequestTypes');

        if(isset($this->Security) &&  ($this->RequestHandler->isAjax() || $this->RequestHandler->isPost())){
            $this->Security->validatePost = false;
            $this->Security->enabled = false;
            $this->Security->csrfCheck = false;
        }
    }

    public function admin_index()
    {
        $this->layout = 'admin_form_layout';
        $this->LibraryBulkBookRequest->recursive = 0;
        $this->paginate = array(
            'conditions' => '',
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'LibraryBulkBookRequest.created ASC'
        );
		// PR($this->paginate('LibraryBulkBookRequest'));
		// die;
        $this->set('LibraryBulkBookRequest', $this->paginate('LibraryBulkBookRequest'));
    }


  public function admin_import() {
        $this->layout = 'admin_form_layout';
       
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->LibraryBulkBookRequest->set($this->request->data);
        
                $file = array();
                if(isset($this->request->data["LibraryBulkBookRequest"]["IMPORT"])) {
                    $file = $this->request->data["LibraryBulkBookRequest"]["IMPORT"];
                }
                $name = time().'.'.substr(strrchr($this->request->data['LibraryBulkBookRequest']['IMPORT']["name"], '.'), 1);
                move_uploaded_file($this->request->data['LibraryBulkBookRequest']['IMPORT']["tmp_name"], WWW_ROOT . "/files/" . UPLOAD_STUDENT_EXCEL . $name);
                $this->request->data['LibraryBulkBookRequest']['IMPORT'] = "/files/" .  UPLOAD_STUDENT_EXCEL . $name;
					
                try {
                    $data = $this->ExcelReader->loadExcelFile(WWW_ROOT. "/files/" .  UPLOAD_STUDENT_EXCEL . $name);
				
					
                } catch (Exception $e) {
                    $this->Session->setFlash('Excel not uploaded properly please try again!', 'message_bad');
                    $this->redirect($this->referer());
                }
				
				unset($data[0]);
				//PR($data);
				
				
				foreach($data as $key=>$rows){
					// $name = $rows[0];
					// echo $name;
					
				
					$bookdata = array(
							'BOOK_NAME' => $rows[0],
							'PUBLISHER'=> $rows[1],
							'AUTHOR'=> $rows[2],
							'QUANTITY'=> $rows[3],
							'DATE'=>$rows[4]
					);
					
					
					 $this->LibraryBulkBookRequest->create();
                     $this->LibraryBulkBookRequest->save($bookdata);
					
				}
				
            $this->Session->setFlash('Excel uploaded!', 'message_good');
			
			
		}
	}

	 public function admin_download()
    {
		//$this->Uploaddocument = ClassRegistry::init('Uploaddocument');
		
		// $Uploaddocument = $this->Uploaddocument->find('first', array(
                // 'contain' => array(),
                // 'conditions' => array('INQUIRY_ID'=>$id)
            // ));
		// $doc =  $Uploaddocument['Uploaddocument']['DOC_NAME'];
		
		$abc =  SITE_URL . 'files/download_excel/DB_Library.xlsx';
		$this->redirect($abc);
		//die;
		
	}	
}
