<?php
class BookingController extends AppController
{
    var $name = 'Booking';

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('add_booking');
    }

    public function add_booking() {
        $this->layout = 'ajax';
        $this->autoRender = false;
        if(!empty($this->request->data))
        {
            $this->request->data['booking'] = array(
                ''
            );
        }
    }
}
