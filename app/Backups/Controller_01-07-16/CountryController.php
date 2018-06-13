<?php
// app/Controller/UsersController.php
class CountryController extends AppController
{
    var $name = 'Country';

    public function beforeFilter()
    {
        parent::beforeFilter();

        $this->Auth->allow('App_GetCountries');

        if(isset($this->Security) &&  ($this->RequestHandler->isAjax() || $this->RequestHandler->isPost())){
            $this->Security->validatePost = false;
            $this->Security->enabled = false;
            $this->Security->csrfCheck = false;
        }
    }

    public function App_GetCountries()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;

        $Country = $this->Country->find('all', array(
            'fields' => array('COUNTRY_ID','COUNTRY_NAME'),
            'conditions' => array('STATUS' => 1),
            'contain' => array()
        ));

        $Countries = Set::extract('/Country/.', $Country);

        if(!empty($Countries))
        {
            $message = 'Countries Found';
            $status = true;
        }
        else
        {
            $message = 'No Data Found';
            $status = false;
        }

        $result_array = array(
            'status' => $status,
            'message' => $message,
            'data' => $Countries
        );

        echo json_encode($result_array); die;

    }
}
