<?php
// app/Controller/CategorysController.php
class CompanyProfilesController extends AppController
{
    var $name = 'CompanyProfiles';
    public function beforeFilter()
    {
        parent::beforeFilter();
        if (isset($this->Security) && ($this->RequestHandler->isAjax() || $this->RequestHandler->isPost())) {
            $this->Security->validatePost = false;
            $this->Security->enabled = false;
            $this->Security->csrfCheck = false;
        }
        $this->Auth->allow('add', 'index', 'edit');
    }

    function add()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $status = false;
        $profile_id = '';
        $message_response = '';
       if(!empty($this->request->data))
       {
       if(!empty($this->request->data['image_url'])) {
           $this->request->data['image_code'] = $this->request->data['image_url'];
       }
        $this->CompanyProfile->set($this->request->data);
           $this->CompanyProfile->create();
           if($this->CompanyProfile->save($this->request->data))
           {
            $profile_id = $this->CompanyProfile->getInsertID();

                   if(!empty($this->request->data['image_url'])) {
                       $this->request->data['image_code'] = $this->request->data['image_url'];
                       $img_code = $this->request->data['image_url'];
                       $img = str_replace('data:image/png;base64,', '', $img_code);
                       $img = str_replace(' ', '+', $img);
                       $img_data = base64_decode($img);
                       $file = "files/" . UPLOAD_DOCUMENT."image_".rand('99999', '99999999').time().".png";
                       file_put_contents($file, $img_data);
                       $this->CompanyProfile->id = $profile_id;
                       $this->CompanyProfile->savefield('image_url', $file);
                   }

            $status = true;
            $message_response = 'Company Profile added successfully';
           } else {
            $message_response= 'Company Profile not added please try again';
           }
       } else {
           $message_response = 'Company Profile not added please try again';
       }
        $response = array(
            'status' => $status,
            'message' => $message_response,
            'profile_id' => $profile_id,
        );
        echo json_encode($response); die;
    }


    public function index() {
        $conditions = array();
        if(!empty($this->request->data['user_id']))
        {
        $conditions[]  = array('CompanyProfile.user_id' => $this->request->data['user_id']);
        }
        if(isset($this->request->data['company_name']) && !empty($this->request->data['company_name'])) {
            $conditions[] = array('CompanyProfile.company_name LIKE' => '%'.$this->request->data['company_name'].'%');
        }

        $CompanyProfile = $this->CompanyProfile->find('all', array(
            'conditions' => $conditions
        ));
       $CompanyProfile = Set::extract('/CompanyProfile/.', $CompanyProfile);
        echo '{"CompanyProfile":'.json_encode($CompanyProfile).'}'; die;
    }

    public function view($id) {
        $CompanyProfile = $this->CompanyProfile->findById($id);
        $this->set(array(
            'CompanyProfile' => $CompanyProfile,
            '_serialize' => array('CompanyProfile')
        ));
    }

    public function edit() {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $status = false;
        $profile_id = '';
        $message_response='';
        $img_data = '';
        if(!empty($this->request->data['image_url'])) {
            $this->request->data['image_code'] = $this->request->data['image_url'];
            $img_code = $this->request->data['image_url'];
            $img = str_replace('data:image/png;base64,', '', $img_code);
            $img = str_replace(' ', '+', $img);
            $img_data = base64_decode($img);
            $file = "files/" . UPLOAD_DOCUMENT."image_".rand('99999', '99999999').time().".png";
            file_put_contents($file, $img_data);
            $this->request->data['image_url'] = $file;
        }

        $this->CompanyProfile->id = $this->request->data['company_id'];
        if ($this->CompanyProfile->save($this->request->data)) {
            $this->request->data['image_url'] = $img_data;
            $status = true;
            $message_response = 'Saved';
        } else {
            $message_response = 'Error';
        }
        $response = array(
            'status' => $status,
            'message' => $message_response,
            'data' => $this->request->data,
            'profile_id' => $profile_id,
        );
        echo json_encode($response); die;
    }

    public function delete($id) {
        $status = false;
        $profile_id = '';
        $message_response='';
        if ($this->request->is('post') || $this->request->is('put')) {
        if ($this->CompanyProfile->delete($id)) {
            $status = true;
            $message_response = "Company Profile deleted successfully";
        } else {
            $message_response = "Company Profile not deleted please try again";;
        }

        $response = array(
            'status' => $status,
            'message' => $message_response,
            'profile_id' => $profile_id,
        );
        echo json_encode($response); die;
        }
    }
}