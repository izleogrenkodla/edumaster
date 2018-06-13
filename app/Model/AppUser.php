<?php
class AppUser extends AppModel
{
    public $name = 'AppUser';
    public $useTable = 'app_user';
    public $primaryKey = 'id';

    public $hasMany = array(
        'EmployeeToService' => array(
            'className' => 'EmployeeToService',
            'fields' => array('service_id'),
            'foreignKey' => 'user_id',
            'dependent' => true
        ),
        'Favourite' => array(
            'className' => 'Favourite',
            'fields' => array('user_id'),
            'foreignKey' => 'user_id',
            'dependent' => true
        ),
    );

   // var $actsAs = array('Acl' => 'requester');
/*
    var $belongsTo = array(
        'Role' => array(
            'fields' => array('id', 'role_name'),
            'foreignKey' => 'role_id'
        ),
    );
*/
    public function beforeSave()
    {
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = Security::hash($this->data[$this->alias]['password'], null, true);
        }
        return true;
    }

/*     public $hasMany = array(
         'UserContribution' => array(
             'className' => 'UserContribution',
             'foreignKey' => 'user_id',
         )
     );*/

    var $validate = array();

    /*
    Login Validation Function
    */
    function Login_Validation()
    {
        $validate1 = array(
            'user_id' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter user id',
                    'last' => true)
            ),
            'email' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter user id',
                    'last' => true)
            ),
            'password' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter last name',
                    'last' => true)
            ),
        );
        $this->validate = $validate1;
        return $this->validates();
    }
    /*
    Registration Validation Function
    */
    function Validation()
    {
        $validate1 = array(
            'email_id' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter email id',
                    'last' => true),
                'mustBeEmail' => array(
                    'rule' => "/^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/",
                    'message' => 'Please enter valid email',
                    'last' => true),
                'uniqueRule' => array(
                    'rule' => 'isUnique',
                    'message' => 'E-mail ID already register',
                    'on' => 'create'
              )
           ),
        );
        $this->validate = $validate1;
        return $this->validates();
    }

    public function verifyOldPass()
    {
          $pwd = $this->find('list', array(
             'fields' => array('password'),
              'conditions' => array('id' => $this->data['User']['id'])
          ));
          $old_pass=AuthComponent::password($this->data[$this->alias]['old_password']);
          return ($pwd[$this->data['User']['id']]===$old_pass);
    }

    public function verifies()
    {
        if(isset($this->data['User']['confirm_password'])) {
        return ($this->data['User']['password'] === $this->data['User']['confirm_password']);
        } else {
        return true;
        }
    }

/*    public function password_strength()
    {
    $password = '';
    //$re = '/^(?=.{6,20}\z)/x';

    $re = '/
    ^                # Anchor to start of string.
    (?=.{6,20}\z)    # Assert the length is from 6 to 20 chars.
    /x';
    if(isset($this->data['User']['password'])) {
        $password = $this->data['User']['password'];
    } elseif($this->data['User']['new_password']) {
        $password = $this->data['User']['new_password'];
    }

    if (preg_match($re, $password)) {
      return true;
    }
      return false;
    }*/

    public function uploadFile( $check )
    {
        $uploadData = array_shift($check);

        if ($uploadData['size'] == 0 || $uploadData['error'] !== 0) {
            return false;
        }

        if($uploadData['size'] == 0 || round($uploadData['size']/1024) > 40920){
            return false;
        }

        return true;
    }

    public function GetUsers()
    {
        $result = $this->find("all", array(
            'contain' => array(),
            'fields' => array('id', 'first_name', 'last_name'),
            'conditions' => array('role !=' => 1),
            'order' => 'User.first_name asc'
        ));
        $user = array();
        $user[0] = 'Select User';
        foreach ($result as $row) {
            $user[$row['User']['id']] = ucwords($row['User']['first_name']. ' ' . $row['User']['last_name']);
        }
        return $user;
    }

    public function GetUserGroupWise($role_id = null)
    {
        $result = $this->find("all", array(
            'contain' => array(),
            'fields' => array('id', 'first_name', 'last_name'),
            'conditions' => array('role_id' => $role_id),
            'order' => 'User.first_name asc'
        ));
        $user = array();
        if($role_id == 11) {
        $user[''] = 'Select Agent';
        } elseif($role_id == 13) {
        $user[''] = 'Select College';
        }
        foreach ($result as $row) {
            $user[$row['User']['id']] = ucwords($row['User']['first_name']. ' ' . $row['User']['last_name']);
        }
        return $user;
    }
}