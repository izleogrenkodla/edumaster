<?php
// app/Controller/UsersController.php


class LibraryBookBankController extends AppController
{
    var $name = 'LibraryBookBank';

    public function beforeFilter()
    {
        parent::beforeFilter();

        // $this->Auth->allow('App_UserTypes');

        if(isset($this->Security) &&  ($this->RequestHandler->isAjax() || $this->RequestHandler->isPost())){
            $this->Security->validatePost = false;
            $this->Security->enabled = false;
            $this->Security->csrfCheck = false;
        }
    }

    public function admin_index()
    {
         $this->layout = 'admin_form_layout';
        $this->LibraryBookBank->recursive = 0;
        $this->paginate = array(
            'conditions' => '',
            'limit' => PAGINATION_LIMIT_ADMIN,
            
        );
		
		
		$data = $this->paginate('LibraryBookBank');
		
		
        $this->set('LibraryBookBank', $data);
    }

   public function admin_add()
    {	
		// PR($_POST);die;
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		if($Session_data["ROLE_ID"]!=LIBRARY_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}

        if ($this->request->is('post')) {
            $this->LibraryBookBank->set($this->request->data);
            if ($this->LibraryBookBank->Validation()) {
                $this->LibraryBookBank->create();
				
				$class_id = $this->request->data['LibraryBookBank']['CLASS_ID'];
				$conditions = array('LibraryBookBank.CLASS_ID' => $class_id);
				$count = $this->LibraryBookBank->find('count',array(
									'conditions' => $conditions
										)
				);
				if($count == 1){
					$this->Session->setFlash('Library Book Bank For This Class Has Been Already Added!', 'message_bad');
				}
                elseif ($this->LibraryBookBank->save($this->request->data)) {
					
					
					$books = implode(',',$this->request->data['selected_books']);
					$book_name = preg_replace('/[0-9]+/', '', $books);
					
					preg_match_all('!\d+!', $books, $matches);
					
					$book_id = implode(",",$matches[0]);
					
					// $token = strtok($books,",");
					// while ($token !== false)
					// {
					// echo "$token";
					// $token = strtok(",");
					// echo $token;
					// }
					
					
					$this->LibraryBookBank->saveField('BOOK_ID',$book_id);
					$this->LibraryBookBank->saveField('BOOK_NAME',$book_name);
					$this->request->data['StudentRegistration']['USER_ID'] = $Session_data['ID'];
					$this->LibraryBookBank->saveField("created_by",$Session_data['ID']);
					
					$ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
					$this->LibraryBookBank->saveField("created_ip",$ip);
					
                    $this->Session->setFlash('Library Book Bank Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
                } else {
                $this->Session->setFlash('Library Book Bank Not Added Please Try Again!', 'message_bad');
                }
        }
		
		$this->loadModel('AcademicClass');
		$AcademicClass = $this->AcademicClass->GetAcademicClasses();
		
		$this->set('class',$AcademicClass);
		
		
    }

    public function admin_edit($id = null)
     {		
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		if($Session_data["ROLE_ID"]!=LIBRARY_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}

        $this->LibraryBookBank->id = $id;
        if (empty($this->LibraryBookBank->id)) {
            $this->Session->setFlash('Invalid LibraryBookBank !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->LibraryBookBank->Validation()) {
                if ($this->LibraryBookBank->save($this->request->data)) {
					
								$books = implode(',',$this->request->data['selected_books']);
					$book_name = preg_replace('/[0-9]+/', '', $books);
					
					preg_match_all('!\d+!', $books, $matches);
					
					$book_id = implode(",",$matches[0]);
					
					// $token = strtok($books,",");
					// while ($token !== false)
					// {
					// echo "$token";
					// $token = strtok(",");
					// echo $token;
					// }
					
					
					$this->LibraryBookBank->saveField('BOOK_ID',$book_id);
					$this->LibraryBookBank->saveField('BOOK_NAME',$book_name);
						
                    $this->Session->setFlash('LibraryBookBank Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('LibraryBookBank Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('LibraryBookBank Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $LibraryBookBank = $this->LibraryBookBank->find('first', array(
                'contain' => array(),
                'conditions' => array('BookBank_ID' => $id)
            ));
            if(empty($LibraryBookBank)) {
                $this->Session->setFlash('Invalid LibraryBookBank !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $LibraryBookBank;
        }
			
			
		
		
		
		$this->loadModel('AcademicClass');
		$AcademicClass = $this->AcademicClass->GetAcademicClasses();
		$this->set('class',$AcademicClass);
		$checkbox = $this->getBooksId($LibraryBookBank['LibraryBookBank']['CLASS_ID'],$LibraryBookBank['LibraryBookBank']['BOOK_ID']);
		$this->set('checkbox',$checkbox);

    }

    public function admin_delete($Id = null)
    {
        $this->layout = 'admin_form_layout';
		
		$Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		if($Session_data["ROLE_ID"]!=LIBRARY_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}
		
        if (!empty($Id)) {
            try {
                if ($this->LibraryBookBank->delete($Id)) {
                    $this->Session->setFlash('LibraryBookBank is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid LibraryBookBank.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }

	public function getBooksId($data,$id){
		
		$this->loadModel('LibraryBook');
		
		 $d = explode(",",$data);
		 $id = explode(',',$id);
		
		$books = $this->LibraryBook->find('all',array(
				
            'conditions' => array('LibraryBook.CLASS_ID'=>$d)
            
        ));
		
		
		
		 $html = '<ul>';
                foreach($books as $k=>$value) {
					
					// if(in_array($value['LibraryBook']['BOOK_ID'], $id)){
					// $checked = "checked='checked'";
					// }else{
						// $checked = "checked=''";
					// }
					
					
					
					$checked = (in_array($value['LibraryBook']['BOOK_ID'], $id) ? "checked='checked'" : '');
					
					//return $checked;
					//$checked = $value["LibraryBook"]["BOOK_ID"] == $d ? "checked=" 
                    $html.='<li><input type="checkbox" name=selected_books[] value="'.$value["LibraryBook"]["BOOK_ID"]."".$value["LibraryBook"]["BOOK_NAME"].'" '.$checked .'>'." ".$value["LibraryBook"]["BOOK_NAME"].'</li>';
                    $html.='<li style="opacity:0;><input type="checkbox" name=selected_books_id[] value="'.$value["LibraryBook"]["BOOK_ID"].'">'." ".$value["LibraryBook"]["BOOK_NAME"].'</li>';
                }
                $html.='</ul>';
		
		return $html;
	}
	
	public function admin_getBooks(){
		
		$this->loadModel('LibraryBook');
		$cid = $this->request->data["cid"];
	
		
		
		$books = $this->LibraryBook->find('all',array(
				
            'conditions' => array('LibraryBook.CLASS_ID'=>$cid)

            
        ));
		if(sizeof($books)=== 0){
			echo "No Books";
			die;
		}
		 $html = '<ul>';
                foreach($books as $k=>$value) {
                    $html.='<li><input type="checkbox" name=selected_books[] value="'.$value["LibraryBook"]["BOOK_ID"]."".$value["LibraryBook"]["BOOK_NAME"].'">'." ".$value["LibraryBook"]["BOOK_NAME"].'</li>';
                    $html.='<li style="opacity:0;><input type="checkbox" name=selected_books_id[] value="'.$value["LibraryBook"]["BOOK_ID"].'">'." ".$value["LibraryBook"]["BOOK_NAME"].'</li>';
                }
                $html.='</ul>';
		
		echo $html;
		die;
	}
	

		
}
