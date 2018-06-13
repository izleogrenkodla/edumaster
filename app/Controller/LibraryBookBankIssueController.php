<?php
// app/Controller/UsersController.php


class LibraryBookBankIssueController extends AppController
{
    var $name = 'LibraryBookBankIssue';

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

    public function admin_index($id = null)
    {
		$this->checkBooks();
		$condtions = array();
		if(isset($this->request->data["LibraryBookBankIssue"]["CLASS_ID"]) && ($this->request->data["LibraryBookBankIssue"]["CLASS_ID"])>0)
		{ 
			
			
			$class =$this->request->data["LibraryBookBankIssue"]["CLASS_ID"];
			$conditions = array('LibraryBookBankIssue.CLASS_ID' => $class);
			
			
		}
		
			
		$rdata = $this->LibraryBookBankIssue->find('first',array(
            'contain' => array(),
            'conditions' => array('LibraryBookBankIssue.USER_ID' =>$id),
        ));
		
		if((isset($id)) && ($id)>0)
			{
				$conditions['LibraryBookBankIssue.USER_ID'] = $id;
				//$conditions['LibraryBookBankIssue.ROLE_ID'] = $rdata['LibraryBookBankIssue']['ROLE_ID'];
			}
		
		
		
        $this->layout = 'admin_form_layout';
        $this->LibraryBookBankIssue->recursive = 0;
        $this->paginate = array(
            'conditions' => $conditions,
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'LibraryBookBankIssue.created ASC'
        );
		
		// PR($this->paginate('LibraryBookBankIssue'));
		// die;
		$this->loadModel('AcademicClass');
		$AcademicClass = $this->AcademicClass->GetAcademicClasses();
		$this->set('class',$AcademicClass);
        

        $this->set('LibraryBookBankIssue', $this->paginate('LibraryBookBankIssue'));
    }

   public function admin_add()
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

        if ($this->request->is('post')) {
            $this->LibraryBookBankIssue->set($this->request->data);
            if ($this->LibraryBookBankIssue->Validation()) {
				
				
				
                $this->LibraryBookBankIssue->create();
                if ($this->LibraryBookBankIssue->save($this->request->data)) {
						
					if($this->request->data["LibraryBookBankIssue"]["ISSUE_DATE"]!= "" ){
					$this->request->data["LibraryBookBankIssue"]["ISSUE_DATE"] = $this->General->datefordb($this->request->data["LibraryBookBankIssue"]["ISSUE_DATE"]);
					$this->LibraryBookBankIssue->saveField("ISSUE_DATE",$this->request->data["LibraryBookBankIssue"]["ISSUE_DATE"]);
					}
					if($this->request->data["LibraryBookBankIssue"]["RETURN_DATE"]!= "" ){
					$this->request->data["LibraryBookBankIssue"]["RETURN_DATE"] = $this->General->datefordb($this->request->data["LibraryBookBankIssue"]["RETURN_DATE"]);
					$this->LibraryBookBankIssue->saveField("RETURN_DATE",$this->request->data["LibraryBookBankIssue"]["RETURN_DATE"]);
					}
					$this->LibraryBookBankIssue->saveField("ISSUE_DATE",$this->request->data["LibraryBookBankIssue"]["ISSUE_DATE"]);
					$this->request->data['LibraryBookBankIssue']['USER_ID'] = $Session_data['ID'];
					$this->LibraryBookBankIssue->saveField("created_by",$Session_data['ID']);
					
					$ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
					$this->LibraryBookBankIssue->saveField("created_ip",$ip);
					$this->LibraryBookBankIssue->saveField("Status",$this->request->data["LibraryBookBankIssue"]["Status"]);
                    $this->Session->setFlash('Library BookBank Issued Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
                } else {
                $this->Session->setFlash('Library BookBank Issued Not Added Please Try Again!', 'message_bad');
                }
        }
		$this->loadModel('AcademicClass');
		$AcademicClass = $this->AcademicClass->GetAcademicClasses();
		
		$this->set('class',$AcademicClass);
		
		$stu[0] = "Select Students";
		$this->set('stu',$stu);
		
    }

    	public function admin_Return($Id = null){
		
		  $LibraryBookBankIssue = $this->LibraryBookBankIssue->find('first', array(
                'contain' => array(),
                'conditions' => array('BOOK_BANK_ISSUE_ID' => $Id)
            ));
			
			$this->loadModel('LibraryBookBank');
			$LibraryBookBankBooks = $this->LibraryBookBank->find('first', array(
                'contain' => array(),
                'conditions' => array('BOOKBANK_ID ' => $LibraryBookBankIssue['LibraryBookBankIssue']['BOOKBANK_ID'])
            ));
			
			$books = $LibraryBookBankBooks['LibraryBookBank']['BOOK_NAME'];
			
		$this->loadModel('LibraryFineMaster');
		 $LibraryFineMaster = $this->LibraryFineMaster->find('first', array(
                'contain' => array(),
                'conditions' => array()
            ));	
			$fine = $LibraryFineMaster['LibraryFineMaster']['BOOK_BANK_FINE'];
			$date = date('Y-m-d');
		
			$date1=date_create($date);
			$date2=date_create($LibraryBookBankIssue['LibraryBookBankIssue']['RETURN_DATE']);
			$diff=date_diff($date1,$date2);
			$pending = $diff->format("%R%a days");
			$days = abs($pending);
			
			
			$bookid = $LibraryBookBankIssue['LibraryBookBankIssue']['BOOK_BANK_ISSUE_ID'];
			$totalfine = abs($pending * $fine);
			
			
			if($pending>=0){
			$this->LibraryBookBankIssue->updateAll(
						array(
							'Status' => "'Returned'",
							
							
						),array('BOOK_BANK_ISSUE_ID '=>$bookid
						)
					);
			}elseif($pending<0){
				$this->loadModel('LibraryFine');
				$this->LibraryFine->saveField('NO_OF_DAYS',$days);
				$this->LibraryFine->saveField('FINE_PER_DAY',$fine);
				$this->LibraryFine->saveField('TOTAL_AMOUNT',$totalfine);
				$this->LibraryFine->saveField('BOOK_ISSUE_ID',$bookid);
				//$this->LibraryFine->saveField('GROUP_ID',$LibraryBookBankIssue['LibraryBookBankIssue']['GROUP_ID']);
				$this->LibraryFine->saveField('BOOK_NAME',$books);
				$this->LibraryFine->saveField('CLASS_ID',$LibraryBookBankIssue['LibraryBookBankIssue']['CLASS_ID']);
				$this->LibraryFine->saveField('USER_ID',$LibraryBookBankIssue['LibraryBookBankIssue']['USER_ID']);
				$this->LibraryFine->saveField('STATUS','Pending');
				$this->LibraryFine->saveField('ISSUETYPE','BOOK BANK');
				
				
				$this->loadModel("LibraryBookBankIssue");
				$this->LibraryBookBankIssue->updateAll(
						array(
							'Status' => "'Pending'",
							
							
						),array('BOOK_BANK_ISSUE_ID '=>$bookid
						)
					);
					
				$this->redirect(array(
						'controller' => 'LibraryFine',
						'action' => '', 
					));
			}
			
			
			
			// $update_quantity = $this->getBooksPlus($LibraryBookBankIssue['LibraryBookBankIssue']['BOOK_ID']);
			 // $this->loadModel('LibraryBook');
					 // $this->LibraryBook->updateAll(
						// array(
							// 'QUANTITY' => $update_quantity,
							
							
						// ),array('BOOK_ID '=>$LibraryBookBankIssue['LibraryBookBankIssue']['BOOK_ID']
						// )
					// );
					
		
		?>
			
			<script>
				
				location.href = document.referrer;
			</script>
		<?php
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
                if ($this->LibraryBookBankIssue->delete($Id)) {
                    $this->Session->setFlash('LibraryBookBankIssue is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid LibraryBookBankIssue.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }
	
	public function admin_getStudent(){
		
	$cid = $this->request->data["cid"];
	
	
	
	$this->loadModel('Users');
	 $this->loadModel('LibraryMember');
		$uid = $this->LibraryMember->find('all',array(
				
            'conditions' => array('LibraryMember.CLASS_ID'=>$cid,
								'LibraryMember.ROLE_ID'=>'5'
							)
            
        ));
		foreach($uid as $uuid){
		$id = $uuid['LibraryMember']['USER_ID'];
		$rrid = $uuid['LibraryMember']['ROLE_ID'];
		}
		
		
	
		if(isset($id)){
		$book = $this->Users->find('all',array(
				
            'conditions' => array('Users.ID'=>$id
							)
            
        ));
		
		
		echo "<select name='data[LibraryBookBankIssue][USER_ID]'  class = 'form-control select2me' 'data-required' => '1'><option value='0'>Select Student</option>";
        foreach($book as $data){
            
			 echo "<option value='" . $data['Users']['ID'] ."'>" . $data['Users']['FIRST_NAME'] ." " .$data['Users']['LAST_NAME']."</option>";
			
        }
		echo "</select>";
		}else{
			echo "No User Found";
		}
		
		die;	
		
	}
	
	public function admin_getBooks(){
		
	$cid = $this->request->data["cid"];
	
	
	
	$this->loadModel('LibraryBookBank');
	 $books = $this->LibraryBookBank->find('all',array(
            
            'conditions' => array('LibraryBookBank.CLASS_ID'=>$cid)
            
        ));
		
		
		//PR($data);die;
		if(sizeof($books)=== 0){
			echo "No Books";
			die;
		}
		
                foreach($books as $value) {
					$vals[] = $value["LibraryBookBank"]["BOOK_NAME"];
					$bbid = $value["LibraryBookBank"]["BOOKBANK_ID"];
					
                   
                    
                }
				
				
				$html = "<b>Books List:</b><br/>";
				$html.= str_replace(',','<br/>',implode(',',$vals));
				$html.= "<input type ='hidden' name='data[LibraryBookBankIssue][BOOKBANK_ID]' value=".$bbid.">";
				echo $html;
				die;
               
		
		echo $html;
		die;
		
	}

	public function getUsersByClassId($data){
		
		$this->loadModel('Users');
		$result = $this->Users->find('all',array(
				
            'conditions' => array('Users.CLASS_ID'=>$data
			),
            

		
            
        ));
		
		
		
		$user = array();
        $user[0] = 'Select User';
        foreach ($result as $row) {
            $user[$row['Users']['ID']] = ucwords($row['Users']['FIRST_NAME']. " " .$row['Users']['LAST_NAME']);
        }
		return $user;
	}
	
	public function getBookBankByBookBankId($data){
		
		$this->loadModel('LibraryBookBank');
	 $books = $this->LibraryBookBank->find('all',array(
            
            'conditions' => array('LibraryBookBank.BOOKBANK_ID'=>$data)
            
        ));
		
		
		//PR($data);die;
		if(sizeof($books)=== 0){
			$html = "No Books";
			return $html;
			
		}
		
                foreach($books as $value) {
					$vals[] = $value["LibraryBookBank"]["BOOK_NAME"];
					$bbid = $value["LibraryBookBank"]["BOOKBANK_ID"];
					
                   
                    
                }
				
				
				$html = "<b>Books List:</b><br/>";
				$html.= str_replace(',','<br/>',implode(',',$vals));
				$html.= "<input type ='hidden' name='data[LibraryBookBankIssue][BOOKBANK_ID]' value=".$bbid.">";
				
		
		return $html;
	}
	
		public function checkBooks(){
					
				$conditions = array('LibraryBookBankIssue.STATUS' =>'Issued');
				$rec = $this->LibraryBookBankIssue->find('all',
				array('conditions' => $conditions,
				));
				$sdate = date('Y-m-d');
						 
				
				
				foreach($rec as $r){
					$bid = $r['LibraryBookBankIssue']['BOOK_BANK_ISSUE_ID'];
						
						$rdate=$r['LibraryBookBankIssue']['RETURN_DATE'];
						
						
						if($sdate > $rdate){
						$this->LibraryBookBankIssue->updateAll(
						array(
							'Status' => "'Pending'",
							
							
						),array('BOOK_BANK_ISSUE_ID '=>$bid
						)
					);
						}
					//echo $diff;
				}
				
		// return $rec;
				
				}
		
}
