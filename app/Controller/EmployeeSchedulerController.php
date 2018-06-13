<?php
class EmployeeSchedulerController extends AppController
{
    var $name = 'EmployeeScheduler';

    public $components = array('Session');

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('GetEmployeeSchedule', 'booking');
    }



    public function GetEmployeeSchedule() {
        $this->layout = 'ajax';
        $this->autoRender = false;
        if(!empty($this->request->data))
        {
            if(!empty($this->request->data)) {
            $Emp_id = $this->request->data['emp_id'];
            $Date = date('Y-m-d', strtotime($this->request->data['date']));
            $Week_day = $this->request->data['week_day'];
            $this->Booking = ClassRegistry::init('Booking');
            $slots = array();

            $busy_slot = $this->Booking->find('list', array(
                'contain' => array(),
                'conditions' => array('Booking.status' => 1, 'Booking.emp_id' => $Emp_id, 'Booking.date' => $Date),
                'fields' => array('Booking.slot_id')
            ));

            // pr($busy_slot); die;
            $not_avail_slots = '';
            $condition ='';
            if(!empty($busy_slot)) {
            $not_avail_slots = implode(",", $busy_slot);
            $condition = "`id` NOT IN (".$not_avail_slots.") AND ";
            }

             //   pr($not_avail_slots);
            $data = $this->EmployeeScheduler->query("SELECT `id`, `time_start`, `time_end` FROM `weekly_scheduler` WHERE " .$condition." `user_id` = '".$Emp_id."' AND `week_day` = '".$Week_day."' AND `time_start` > (NOW() + INTERVAL 30 MINUTE)
 ORDER BY `weekly_scheduler`.`id` ASC");

           //   pr($data); die;
           $avail_slot = Set::extract('/weekly_scheduler/.', $data);
           echo '{"EmployeeScheduler":'.json_encode($avail_slot).'}'; die;
          }
        }
    }
}
