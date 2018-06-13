<?php
// app/Controller/UsersController.php
class GroupController extends AppController
{
    var $name = 'Group';

    public function beforeFilter()
    {
        parent::beforeFilter();

        $this->Auth->allow('');

        if(isset($this->Security) &&  ($this->RequestHandler->isAjax() || $this->RequestHandler->isPost())){
            $this->Security->validatePost = false;
            $this->Security->enabled = false;
            $this->Security->csrfCheck = false;
        }
    }

    public function admin_index()
    {
		
		 $classes = $this->Group->AcademicClass->GetAcademicClasses();
		 $this->set('classes', $classes);
	
		 $subjects = $this->Group->Subject->GetSubjects();
		 $this->set('subjects', $subjects);
		
        $this->layout = 'admin_form_layout';
       // $this->group->recursive = 0;
        $this->paginate = array(
            'conditions' => array('Group.STATUS'=>1),
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'Group.CLASS_ID ASC'
        );

        $this->set('Group', $this->paginate('Group'));
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
		       $this->Group->set($this->request->data);
                if ($this->Group->Validation()) {
               // $this->Group->create();
                if(isset($this->request->data["selected_user"]) && is_array($this->request->data["selected_user"]) && sizeof($this->request->data["selected_user"])>0) {
                    $this->request->data['Group']['USER_ID'] = $Session_data['ID'];
                    if ($this->request->data) {
                       
                        $lists = $this->request->data["selected_user"];
                        foreach($lists as $key => $sub)
                        {
							$sub_id = $sub;
                            $XrefData['Group'] = array(
                                'CLASS_ID' => $this->request->data['Group']['Class_ID'],
                                'SUBJECT_ID' => $sub_id,
                                'GROUP_NAME' => $this->request->data['Group']['GROUP_NAME'],
								'STATUS' => $this->request->data['Group']['STATUS'],
                                'created_by' => $Session_data['ID'],
                                'created_ip' => (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0',
                            );
							
                            $this->Group->create();
							
                            $this->Group->save($XrefData);
						 }

                        $this->Session->setFlash('Group Added Successfully!', 'message_good');
                        $this->redirect(array('action' => 'index'));
                    }
                }else{
                    $this->Session->setFlash('Group could not proceed, Please select atleast one user.', 'message_bad');
                }

            } else {
                $this->Session->setFlash('Notice Class Not Added Please Try Again!', 'message_bad');
            }
        
			}
		
		 $classes = $this->Group->AcademicClass->GetAcademicClasses();
         $this->set('classes', $classes);
		
	}
	
	public function admin_delete($Id = null)
    {
        $this->layout = 'admin_form_layout';
        if (!empty($Id)) {
            try {
                if ($this->Group->delete($Id)) {
                    $this->Session->setFlash('Group is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid Group.', 'message_bad');
            $this->redirect(array('action' => 'index'));
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

        $this->Group->id = $id;
        if (empty($this->Group->id)) {
            $this->Session->setFlash('Invalid Group !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->Group->Validation()) {
                if ($this->Group->save($this->request->data)) {
                    $this->Session->setFlash('Group Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Group Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Group Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $Group = $this->Group->find('first', array(
                'contain' => array(),
                'conditions' => array('GROUP_ID' => $id)
            ));
            if(empty($Group)) {
                $this->Session->setFlash('Invalid Group !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $Group;
        }
		
			 $classes = $this->Group->AcademicClass->GetAcademicClasses();
			 $this->set('classes', $classes);
	
			$subjects = $this->Group->Subject->GetSubjects();
			$this->set('subjects', $subjects);
		 
		 
    }
	    public function admin_getsubject () {

        if ($this->request->is('post') || $this->request->is('ajax')) {
            $Session_data = $this->Session->read('Auth.Admin');
            $this->autoRender = false;
            $this->layout = 'ajax';
            $this->Subjects = ClassRegistry::init('Subjects');
            $users = array();
            $conditions = array();
            $conditions['Subjects.CLASS_ID'] = $this->request->data["Group"]["Class_ID"];

            $users =$this->Subjects->find('all',array(
                'conditions'=>$conditions,
            ));
			 
            $return = array();
            if(sizeof($users)>0) {
                $return['status'] = "success";
                $html = '<ul>';
                foreach($users as $k=>$value) {
                    $html.='<li><input type="checkbox" name=selected_user[] value="'.$value["Subjects"]["SUBJECT_ID"].'">'.$value["Subjects"]["TITLE"].'</li>';
                }
                $html.='</ul>';
                $return['lists'] = $html;
            }else{
                $return['status'] = "failed";
            }
            echo json_encode($return);die;
        }
    }
	
}
?>