<?php
// app/Controller/UsersController.php
class NewsController extends AppController
{
    var $name = 'News';

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
	
	public function admin_index(){
			
		$Session = $this->Session->read('Auth.Admin');
		
		 $this->layout = 'admin_form_layout';
        //$this->News->recursive = 0;
        $this->paginate = array(
            'conditions' => '',
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'News.NEWS_ID ASC'
        );

        $this->set('news', $this->paginate('News'));
	}
	
	public function admin_view($ID=null){
		
		//echo $ID;die;
		 $this->layout = 'admin_form_layout';
        //$this->VehicleExpense->recursive = 0;
        	$news = $this->News->find('first', array(
            'conditions' => array('NEWS_ID' => $ID)
        ));
			
			
			$this->set('news', $news);
		
		
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
            $this->News->set($this->request->data);
            if ($this->News->Validation()) {
                $this->News->create();
				
               
					
					$this->request->data["News"]["START_DATE"] = $this->General->datefordb($this->request->data["News"]["START_DATE"]);
					$this->request->data["News"]["END_DATE"] = $this->General->datefordb($this->request->data["News"]["END_DATE"]);;
						
					$this->request->data['News']['USER_ID'] = $Session_data['ID'];
					$this->News->saveField("created_by",$Session_data['ID']);
					
					$ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
					$this->News->saveField("created_ip",$ip);
					 if ($this->News->save($this->request->data)) {
					
                    $this->Session->setFlash('News Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
                } else {
                $this->Session->setFlash('News Not Added Please Try Again!', 'message_bad');
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

        $this->News->id = $id;
        if (empty($this->News->id)) {
            $this->Session->setFlash('Invalid News !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
			
        if ($this->request->is('put') || $this->request->is('post')) {
			
			$this->request->data['News']['START_DATE'] = $this->General->datefordb($this->request->data['News']['START_DATE']);
            $this->request->data['News']['END_DATE'] = $this->General->datefordb($this->request->data['News']['END_DATE']);

            if ($this->News->Validation()) {
						
					$this->request->data['News']['USER_ID'] = $Session_data['ID'];
					$this->News->saveField("created_by",$Session_data['ID']);
					
					
					
                if ($this->News->save($this->request->data)) {
					
					
                    $this->Session->setFlash('News Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('News Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('News Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $News = $this->News->find('first', array(
                'contain' => array(),
                'conditions' => array('NEWS_ID' => $id)
            ));
            if(empty($News)) {
                $this->Session->setFlash('Invalid News !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
			
			
            $News['News']['START_DATE'] = date('d/m/Y', strtotime(str_replace('-','/',$News['News']['START_DATE'])));
            $News['News']['END_DATE'] = date('d/m/Y', strtotime(str_replace('-','/',$News['News']['END_DATE'])));

			
            $this->request->data = $News;
        }
    }
	
	
	 public function admin_delete($Id = null)
    {
        $this->layout = 'admin_form_layout';
        if (!empty($Id)) {
            try {
                if ($this->News->delete($Id)) {
                    $this->Session->setFlash('News is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid News.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }

    
}