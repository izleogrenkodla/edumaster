<?php
// app/Controller/UsersController.php
class AppUsersController extends AppController
{
    var $name = 'AppUsers';
    var $cache_dir = 'img/cache';
    var $cache_width = 400;
    public $msgs = array();
    //public $components = array();

    public function beforeFilter()
    {
        parent::beforeFilter();

        if (isset($this->Security) && ($this->RequestHandler->isAjax() || $this->RequestHandler->isPost())) {
            $this->Security->validatePost = false;
            $this->Security->enabled = false;
            $this->Security->csrfCheck = false;
        }
        $this->Auth->allow('add', 'login', 'edit', 'view', 'check_email', 'GetServices', 'index', 'GetAllEmployee', 'add_to_favourite', 'check_status_favourite', 'GetAllUsers', 'update_GCM', 'user_favourite');
    }

    function add()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $status = false;
        $user_id = '';
        $message_response='';
        if(!empty($this->request->data))
        {
            $password = $this->request->data['password'];
           // $this->request->data['password'] = Security::hash($this->request->data['password'], null, true);
            if(!empty($this->request->data['image_url'])) {
            $this->request->data['image_code'] = $this->request->data['image_url'];
            }
            $this->request->data['AppUser']['first_name'] = $this->request->data['first_name'];
            $this->request->data['AppUser']['last_name'] = $this->request->data['last_name'];
            $this->request->data['AppUser']['email_id'] = $this->request->data['email_id'];
            $this->request->data['AppUser']['password'] = $this->request->data['password'];
            $this->request->data['AppUser']['phone'] = $this->request->data['phone'];
            $this->request->data['AppUser']['role_id'] = 3;
            $this->AppUser->set($this->request->data);
            if($this->AppUser->validation())
            {
                $this->AppUser->create();
                if($this->AppUser->save($this->request->data))
                {
                    $user_id = $this->AppUser->getInsertID();

                    if(!empty($this->request->data['image_url'])) {
                        $img_code = $this->request->data['image_url'];
                        $img = str_replace('data:image/png;base64,', '', $img_code);
                        $img = str_replace(' ', '+', $img);
                        $img_data = base64_decode($img);
                        $file = "files/" . UPLOAD_DOCUMENT."IMG_".time().".png";
                        file_put_contents($file, $img_data);
                        $this->AppUser->id = $user_id;
                        $this->AppUser->savefield('image_url', $file);
                        $this->AppUser->savefield('base_code', $img_code);
                    }

                    $this->request->data['password'] = $password;
                    if($this->General->shoot_email($this->request->data, 'register'))
                    {
                        $message_response = REG_SUC_MSG;
                    }
                    $status = true;
                } else {
                    $message_response = REG_NOT_SUC_MSG;
                }
            } else {
                $error_list = @call_user_func_array('array_merge', $this->validateErrors($this->AppUser));
                $message_response = $error_list[0];
            }
        } else {
            $message_response = REG_NOT_SUC_MSG;
        }

        $response = array(
            'status' => $status,
            'message' => $message_response,
            'user_id' => $user_id,
        );
        echo json_encode($response); die;
    }

     function add_to_favourite()
     {
            $this->layout = 'ajax';
            $this->autoRender = false;
            $status = false;
            $message_response='';
            if(!empty($this->request->data))
            {
            $status = true;
            $result_id = $this->AppUser->Favourite->find('first', array(
                'fields' => array('Favourite.id'),
                'conditions' => array('Favourite.user_id' => $this->request->data['user_id'], 'Favourite.app_user_id' => $this->request->data['app_user_id'])
            ));

            if($this->request->data['status'] == 1 && empty($result_id)) {
                    $data['Favourite'] = array(
                        'user_id' => $this->request->data['user_id'],
                        'app_user_id' => $this->request->data['app_user_id'],
                    );
                    $this->AppUser->Favourite->create();
                    $this->AppUser->Favourite->save($data);
                    $message_response = "You have successfully add to favourite this employee";
            } elseif($this->request->data['status'] == 0 && !empty($result_id)) {
                $this->AppUser->Favourite->delete($result_id['Favourite']['id']);
                $message_response = "You have successfully unfavourite this employee";
            }
            $response = array(
                'status' => $status,
                'message' => $message_response,
            );
            echo json_encode($response); die;
        }
     }

    function user_favourite()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $status = false;
        $message_response='';
        if(!empty($this->request->data))
        {

            $status = true;
            $result = $this->AppUser->Favourite->find('all', array(
                'contain' => array('AppUser' => array('EmployeeToService' => array(
                'Service'))),
                //'fields' => array('Favourite.app_user_id', 'Employee.*'),
                'conditions' => array('Favourite.user_id' => $this->request->data['user_id']),
            ));

            if(!empty($result)) {
            $data = array();
            foreach($result as $employee)
            {
                $service_name = '';
                foreach($employee['AppUser']['EmployeeToService'] as $services)
                {
                    $service_name .= $services['Service']['name'].',';
                }
                $service_name = rtrim($service_name, ',');
                $data[] = array(
                    'employee_id' => $employee['AppUser']['id'],
                    'first_name' => $employee['AppUser']['first_name'],
                    'last_name' => $employee['AppUser']['last_name'],
                    'bio' => $employee['AppUser']['bio'],
                    'email_id' => $employee['AppUser']['email_id'],
                    'image_url' => $employee['AppUser']['image_url'],
                    'service_name' => $service_name
                );
            }
            echo '{"Employees":'.json_encode($data).'}'; die;
            } else {
            echo '{"status":"false"}'; die;
            }
        }
    }

    function check_status_favourite()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $status = false;
        $message_response='';
        if(!empty($this->request->data))
        {
            $result_id = $this->AppUser->Favourite->find('first', array(
                'fields' => array('Favourite.id'),
                'conditions' => array('Favourite.user_id' => $this->request->data['user_id'], 'Favourite.app_user_id' => $this->request->data['app_user_id'])
            ));

            if(!empty($result_id)) {
                $status = true;
            }
        }
        $response = array(
            'status' => $status,
        );
        echo json_encode($response); die;
    }

    public function check_email()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $status = false;
        if ($this->request->is('post')) {
            //   echo  Security::hash($this->request->data['password'], null, true);
            $record = $this->AppUser->find('count', array('conditions' => array('AppUser.email_id' =>
                $this->request->data['email_id']),
                'recursive' => -1));
            //  echo 'SQL: '.$this->General->getLastQuery(); die;
            if (($record > 0)) {
                $status = true;
            } else {
                $status = false;
            }
        }
        $response = array(
            'status' => $status,
        );
        echo json_encode($response); die;
    }

    public function login()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;
        $user_id = '';
        if ($this->request->is('post')) {
         //   echo  Security::hash($this->request->data['password'], null, true);
            $record = $this->AppUser->find('first', array(
                'conditions' => array('AppUser.email_id' => $this->request->data['email_id'],
                'AppUser.password' => Security::hash($this->request->data['password'], null, true)),
                'recursive' => -1));
                //  echo 'SQL: '.$this->General->getLastQuery(); die;

            if (isset($record['AppUser'])) {
                $result_array = $record['AppUser'];
                $user_id = $record['AppUser']['id'];
                $status = true;
                $message = "You have successfully logged in";
            } else {
                $message = 'Invalid email and password please try again';
            }
        }
        $response = array(
            'status' => $status,
            'message' => $message,
            'data' => $result_array,
            'user_id' => $user_id,

        );
        echo json_encode($response); die;
    }

    public function index() {
        $users = array();
        $users[0] = array(
            'id' => '0',
            'first_name' => 'Any One',
            'last_name' => 'Any One',
        );

       /* $this->AppUser->virtualFields = array(
            'created' => "DATE_FORMAT(created,'%d/%m/%Y %h:%i %p')"
        );
       */
        $data = $this->AppUser->find('all', array(
            'contain' => array(),
            'conditions' => array('AppUser.status' => 1, 'AppUser.role_id' => 2),
            'fields' => array('id', 'first_name', 'last_name')
        ));
        // pr($data);
        foreach($data as $key=>$result)
        {
            $users[$key+1] = array(
                'id' => $result['AppUser']['id'],
                'first_name' => $result['AppUser']['first_name'],
                'last_name' => $result['AppUser']['last_name']
            );
        }

       // $users = Set::extract('/AppUser/.', $users);
        echo '{"AppUsers":'.json_encode($users).'}'; die;
    }

    public function GetServices() {

        if(isset($this->request->data['user_id']) && $this->request->data['user_id'] != 0 && !isset($this->request->data['detail_service']))
        {
        $services = $this->AppUser->EmployeeToService->find('all', array(
            'contain' => array('Service'),
            'conditions' => array('EmployeeToService.user_id' => $this->request->data['user_id'], 'Service.status' => 1),
            'fields' => array('Service.id', 'Service.name')
        ));
        }
        else if(isset($this->request->data['user_id']) && $this->request->data['user_id'] != 0 && isset($this->request->data['detail_service']))
        {
        $services = $this->AppUser->EmployeeToService->find('all', array(
            'contain' => array('Service'),
            'conditions' => array('EmployeeToService.user_id' => $this->request->data['user_id'], 'Service.status' => 1),
            'fields' => array('Service.id', 'Service.name', 'Service.description', 'Service.image_url', 'Service.tot', 'Service.cost')
        ));
        }
        else {
            $services = $this->AppUser->EmployeeToService->Service->find('all', array(
                'conditions' => array('Service.status' => 1),
                'fields' => array('Service.id', 'Service.name')
            ));
        }
        $services = Set::extract('/Service/.', $services);
        echo '{"Services":'.json_encode($services).'}'; die;
    }

    public function GetAllEmployee() {
        $refine_array_result = array();
        $employee = $this->AppUser->find('all', array(
            'contain' => array('EmployeeToService' => array(
                'Service' => array('fields' => array(
                'Service.name'
                ))
            )),
            'conditions' => array('AppUser.role_id' => 2),
            'fields' => array('AppUser.id', 'AppUser.first_name', 'AppUser.last_name', 'AppUser.bio', 'AppUser.email_id', 'AppUser.image_url')
        ));
        foreach($employee as $key=>$result)
        {
            $refine_array_result[] = array(
              'employee_id' => $result['AppUser']['id'],
              'first_name' => $result['AppUser']['first_name'],
              'last_name' => $result['AppUser']['last_name'],
              'bio' => $result['AppUser']['bio'],
              'email_id' => $result['AppUser']['email_id'],
              'image_url' => $result['AppUser']['image_url'],
              'service_name' => $this->General->GetServiceName($result['EmployeeToService']),
            );
        }
        echo '{"Employees":'.json_encode($refine_array_result).'}'; die;
    }

    public function GetAllUsers() {
        $refine_array_result = array();
        $conditions = array();
        if(isset($this->request->data['role_id']) && !empty($this->request->data['role_id']))
        {
            $conditions[] = array('AppUser.role_id' => $this->request->data['role_id']);
        }
        if(isset($this->request->data['first_name']) && !empty($this->request->data['first_name']))
        {
            $conditions[] = array('AppUser.first_name LIKE ' => '%'.$this->request->data['first_name'].'%');
        }

        if(isset($this->request->data['last_name']) && !empty($this->request->data['last_name']))
        {
            $conditions[] = array('AppUser.last_name LIKE' => '%'.$this->request->data['last_name'].'%');
        }

        if(isset($this->request->data['email_id']) && !empty($this->request->data['email_id']))
        {
            $conditions[] = array('AppUser.email_id LIKE' => '%'.$this->request->data['email_id'].'%');
        }

        if(isset($this->request->data['phone']) && !empty($this->request->data['phone']))
        {
            $conditions[] = array('AppUser.phone LIKE' => '%'.$this->request->data['phone'].'%');
        }

        $employee = $this->AppUser->find('all', array(
            'contain' => array(),
            'conditions' => $conditions,
            'fields' => array('AppUser.id', 'AppUser.first_name', 'AppUser.last_name', 'AppUser.bio', 'AppUser.email_id', 'AppUser.image_url', 'AppUser.phone')
        ));

        $employee = Set::extract('/AppUser/.', $employee);
        echo '{"Users":'.json_encode($employee).'}'; die;
    }

    public function GetAllFavEmployee() {
        $employee = $this->AppUser->find('all', array(
            'contain' => array('Favourite' => array(
                'AppUser' => array('fields' => array(
                'AppUser.first_name', 'AppUser.last_name'
                ))
            )),
            'conditions' => array('AppUser.role_id' => 2),
            'fields' => array('AppUser.id')
        ));
        $refine_array_result = array();
        foreach($employee as $key=>$result)
        {
            $refine_array_result[] = array(
              'employee_id' => $result['AppUser']['id']
            );
        }

        echo '{"Employees":'.json_encode($refine_array_result).'}'; die;
    }

    public function view($id) {
        $user = $this->AppUser->findById($id);
        echo json_encode($user); die;
    }

    public function edit() {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $app_user_id = '';
        $result_array = array();
        $status = false;
        if($this->request->is('post') || $this->request->is('put')) {
            $this->request->data['AppUser']['email_id'] = urldecode($this->request->data['email_id']);
            if(isset($this->request->data['AppUser']['password']) && !empty($this->request->data['password'])) {
               // $this->request->data['password'] = Security::hash($this->request->data['password'], null, true);
            } else {
                unset($this->request->data['password']);
            }

            $this->request->data['AppUser']['first_name'] = $this->request->data['first_name'];
            $this->request->data['AppUser']['last_name'] = $this->request->data['last_name'];
        //    $this->request->data['AppUser']['email_id'] = $this->request->data['email_id'];
            $this->request->data['AppUser']['phone'] = $this->request->data['phone'];

            if(!empty($this->request->data['image_url'])) {
                $this->request->data['AppUser']['base_code'] = $this->request->data['image_url'];
                $img_code = $this->request->data['image_url'];
                $img = str_replace('data:image/png;base64,', '', $img_code);
                $img = str_replace(' ', '+', $img);
                $img_data = base64_decode($img);
                $file = "files/" . UPLOAD_DOCUMENT."image_".rand('99999', '99999999').time().".png";
                file_put_contents($file, $img_data);
                $this->request->data['AppUser']['image_url'] = $file;
                // $this->AppUser->savefield('base_code', $this->request->data['AppUser']['image_code']);
            } else {
                $this->request->data['AppUser']['image_url'] = '';
                $this->request->data['AppUser']['base_code'] = '';
            }

            $this->AppUser->id = $this->request->data['user_id'];
            $app_user_id = $this->request->data['user_id'];
            $result_array = $this->request->data;

            if($this->AppUser->save($this->request->data)) {
                $status = true;
                $message = 'You have successfully updated your profile';
            } else {
                $message = 'Your profile not updated successfully';
            }
        }

        $response = array(
            'status' => $status,
          //  'data' => $result_array,
            'user_id' => $app_user_id,
            'message' => $message,
        );
        echo json_encode($response); die;
    }

    public function update_GCM() {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $status = false;
        if($this->request->is('post') || $this->request->is('put')) {

            $this->AppUser->id = $this->request->data['user_id'];
            $this->request->data['AppUser']['gcm'] = $this->request->data['device_id'];
            if($this->AppUser->save($this->request->data)) {
                $status = true;
            } else {
                $status = false;
            }
        }

        $response = array(
            'status' => $status,
        );

        $this->General->Send_GCM($this->request->data['device_id']); die;

        echo json_encode($response); die;
    }

    public function delete($id) {
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->AppUser->delete($id)) {
                $message = USER_DELETED;
            } else {
                $message = USER_NOT_DELETED;
            }
            $this->set(array(
                'message' => $message,
                '_serialize' => array('message')
            ));
        }
    }

    public function forgot_password() {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $status = false;
        if($this->request->is('post') || $this->request->is('put')) {
            if(isset($this->request->data['email_id']) && !empty($this->request->data['email_id'])) {
                $record = $this->AppUser->find('first', array('conditions' => array('AppUser.email_id' =>
                    $this->request->data['email_id'],
                ),
                    'fields' => array('AppUser.id', 'AppUser.email_id'),
                    'recursive' => -1));
                if(!empty($record)) {
                    $password = $this->General->generate_password(6);
                   // $hash_password = Security::hash($password, null, true);
                    $this->AppUser->id = $record['AppUser']['id'];
                    if($this->AppUser->savefield('password', $password)) {
                        $data = array(
                            'email_id' => $record['AppUser']['email_id'],
                            'password' => $password
                        );
                        $this->General->shoot_email($data, 'forgot_email');
                        $status = true;
                        $message = 'Please check your email id for new password';
                    } else {
                        $message = 'Password not reset please try again';
                    }
                } else {
                    $message = 'Email-id not found please enter correct one';
                }
            }
        }

        $response = array(
            'status' => $status,
            'message' => $message,
        );
        echo json_encode($response); die;
    }


    public function admin_employee_index()
    {
        $this->layout = 'admin_form_layout';
        $this->paginate = array(
            'limit' => PAGINATION_LIMIT_ADMIN,
            'conditions' => array('role_id' => 2),
            'order' => 'AppUser.first_name ASC'
        );
        $this->set('AppUsers', $this->paginate('AppUser'));
    }

    public function admin_employee_add()
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->redirect(array('action' => 'login'));
        }
        if ($this->request->is('post')) {
            $this->request->data['User']['role_id'];
            $this->User->set($this->request->data);
            if ($this->User->Validation()) {
                $this->User->create();
                if ($this->User->save($this->request->data)) {

                    if ($this->request->data['User']['IsUpload']) {
                        // get last insert id
                        $id = $this->User->getInsertID();
                        // upload any files
                        $this->Upload->do_upload("/files/" . UPLOAD_AVATARS);
                        // pr($this->Upload->results['urls']); exit;
                        // save uploaded items in db
                        if (!empty($this->Upload->results['urls'])) {
                            // loop through files
                            foreach ($this->Upload->results['urls'] as $k => $v) {
                                $this->User->id = $id;
                                $this->User->savefield('image_url', $v);
                            }
                            // create resized version
                            foreach ($this->Upload->results['urls'] as $k => $v) {
                                // resize image
                                $this->Upload->resize_image($v, $this->cache_width);
                            }
                        }


                        // check for file upload errors
                        if (!empty($this->Upload->errors) || empty($this->Upload->results['urls'])) {
                            // set flash
                            $this->Session->setFlash('Upload errors occurred or items need to be uploaded.', 'message_bad');
                            // save errors in session
                            $this->Session->write('upload_errors', $this->Upload->errors);
                            $this->redirect(array('action' => "edit/{$id}"));
                        } else {
                            $this->Session->setFlash('The user has been saved', 'message_good');
                            $this->redirect(array('action' => 'index'));
                        }
                    }

                    $this->Session->setFlash('User Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
                else {
                    $this->Session->setFlash('User Not Added Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('User Not Added Please Try Again!', 'message_bad');
            }
        }
    }

    public function admin_edit($id = null)
    {
        $this->layout = 'admin_form_layout';
        $this->User->id = $id;
        if (empty($this->User->id)) {
            $this->Session->setFlash('Invalid user !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->Validation()) {

                // pr($this->request->data); die;
                if (isset($this->request->data['User']['IsDelete']) && $this->request->data['User']['IsDelete'] == 1) {
                    $this->User->id = $id;
                    $this->User->savefield('image_url', '');
                    $this->General->delete_file($this->request->data['User']['old_image']);
                }

                if ($this->request->data['User']['IsUpload']) {
                    // upload any files
                    $this->Upload->do_upload("/files/" . UPLOAD_AVATARS);
                    // pr($this->Upload->results['urls']); exit;
                    // save uploaded items in db
                    if (!empty($this->Upload->results['urls'])) {
                        // loop through files
                        foreach ($this->Upload->results['urls'] as $k => $v) {
                            $this->User->id = $id;
                            $this->User->savefield('image_url', $v);
                        }
                        $this->General->delete_file($this->request->data['User']['old_image']);
                        // create resized version
                        foreach ($this->Upload->results['urls'] as $k => $v) {
                            // resize image
                            $this->Upload->resize_image($v, $this->cache_width);
                        }
                    }

                    // check for file upload errors
                    if (!empty($this->Upload->errors) || empty($this->Upload->results['urls'])) {
                        // set flash
                        $this->Session->setFlash('Upload errors occurred or items need to be uploaded.', 'message_bad');
                        // save errors in session
                        $this->Session->write('upload_errors', $this->Upload->errors);
                        $this->redirect(array('action' => "edit/{$id}"));
                    }
                }
                if (empty($this->request->data['User']['password'])) {
                    unset($this->request->data['User']['password']);
                }
                //pr($this->request->data); die;
                if ($this->User->save($this->request->data)) {

                    if ($this->request->data['User']['id'] === $this->Session->read('Auth.Admin.id')) {
                        $this->Session->write('Auth.Admin', $this->request->data['User']);
                    }
                    $this->Session->setFlash('User Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('User Not Added Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('User Not Added Please Try Again!', 'message_bad');
            }
        } else {
            $user = $this->User->read(null, $id);

            if (empty($user)) {
                $this->Session->setFlash('Invalid user !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $user;
            unset($this->request->data['User']['password']);
        }
    }

    public function admin_delete($Id = null)
    {
        $this->layout = 'admin_form_layout';
        if (!empty($Id)) {
            if ($this->User->delete($Id, false)) {
                $this->Session->setFlash('User is successfully deleted', 'message_good');
            }
            $this->redirect(array('action' => 'index'));
        } else {
            $this->Session->setFlash('Invalid user', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }

}