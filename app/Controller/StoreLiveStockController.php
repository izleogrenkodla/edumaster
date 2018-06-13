<?php
// app/Controller/UsersController.php


class StoreLiveStockController extends AppController
{
    var $name = 'StoreLiveStock';

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
        $this->StoreLiveStock->recursive = 0;
        $this->paginate = array(
            'conditions' => '',
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'StoreLiveStock.created ASC'
        );
		
        $this->set('StoreLiveStock', $this->paginate('StoreLiveStock'));
    }

   
}
