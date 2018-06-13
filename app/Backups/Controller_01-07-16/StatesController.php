<?php
// app/Controller/UsersController.php
class StatesController extends AppController
{
    var $name = 'States';

    public function beforeFilter()
    {
        parent::beforeFilter();

        $this->Auth->allow('App_GetStates');

        if(isset($this->Security) &&  ($this->RequestHandler->isAjax() || $this->RequestHandler->isPost())){
            $this->Security->validatePost = false;
            $this->Security->enabled = false;
            $this->Security->csrfCheck = false;
        }
    }

    public function App_GetStates()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;

        $State = $this->State->find('all', array(
            'fields' => array('STATE_ID','STATE_NAME'),
            'conditions' => array('STATUS' => 1),
            'contain' => array()
        ));

        $States = Set::extract('/State/.', $State);

        if(!empty($States))
        {
            $message = 'States Found';
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
            'data' => $States
        );

        echo json_encode($result_array); die;

    }
}
