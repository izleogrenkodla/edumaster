<?php
class BookingMasterController extends AppController
{
    var $name = 'BookingMaster';

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('add_booking', 'get_booking_data', 'alter_booking');
    }

    public function alter_booking()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        if(!empty($this->request->data))
        {
            if(isset($this->request->data['booking_id'])) {
                $conditions[] = array('BookingMaster.id' => $this->request->data['booking_id']);
            }

            if(isset($this->request->data['is_confirmed'])) {
                $this->request->data['BookingMaster']['is_confirmed'] = $this->request->data['is_confirmed'];
            }

            if(isset($this->request->data['reject_comment'])) {
                $this->request->data['BookingMaster']['reject_comment'] = strip_tags($this->request->data['reject_comment']);
                $message = $this->request->data['BookingMaster']['reject_comment'];
            }

            $this->BookingMaster->id = $this->request->data['booking_id'];
            if($this->BookingMaster->save($this->request->data))
            {

                $Booking_Data = $this->BookingMaster->find('first', array(
                    'contain' => array('Customer'),
                    'fields' => array('BookingMaster.order_id', 'Customer.first_name', 'Customer.last_name', 'Customer.gcm'),
                    'conditions' => array('BookingMaster.id' => $this->request->data['booking_id']),
                ));

                $this->AppUser = ClassRegistry::init('AppUser');

                $Admin_User = $this->AppUser->find('first', array(
                    'contain' => array(),
                    'fields' => array('gcm'),
                    'conditions' => array('AppUser.role_id' => 1),
                ));

                $Customer_Name = $Booking_Data['Customer']['first_name'].' '.$Booking_Data['Customer']['last_name'];

                if(isset($this->request->data['is_confirmed']) && $this->request->data['is_confirmed'] == 2) {
                    $Admin_GCM_MESSAGE = $Customer_Name. " has cancelled an appointment for Order #ID ".$Booking_Data['BookingMaster']['order_id']." at ".date('d-m-y')." on ".date('h:i:s a', time()). " Message: ".$message;
                    $USER_GCM_MESSAGE = "You have cancelled an appointment For order id ".$Booking_Data['BookingMaster']['order_id']." at ".date('d-m-y')." on ".date('h:i:s a', time()). " Message: ".$message;

                    $this->General->Send_GCM($Admin_GCM_MESSAGE, $Admin_User['AppUser']['gcm'],1);
                    $this->General->Send_GCM($USER_GCM_MESSAGE, $Booking_Data['Customer']['gcm'],1);

                } elseif(isset($this->request->data['is_confirmed']) && $this->request->data['is_confirmed'] == 1)
                {

                }


                echo '{"status":"true"}'; die;
            } else {
                echo '{"status":"false"}'; die;
            }
        }
    }

    public function get_booking_data() {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $conditions = array();
        if(!empty($this->request->data))
        {
            if(isset($this->request->data['today']) && !empty($this->request->data['today'])) {
                $conditions[] = array('DATE(BookingMaster.date)' => date('Y-m-d', strtotime($this->request->data['today'])));
            }
            if(isset($this->request->data['past']) && !empty($this->request->data['past'])) {
                $conditions[] = array('DATE(BookingMaster.date) <' => date('Y-m-d', strtotime($this->request->data['past'])));
            }
            if(isset($this->request->data['up_coming']) && !empty($this->request->data['up_coming'])) {
                $conditions[] = array('DATE(BookingMaster.date) >' => date('Y-m-d', strtotime($this->request->data['up_coming'])));
            }
            if(isset($this->request->data['confirm'])) {
            $conditions[] = array('BookingMaster.is_confirmed' => $this->request->data['confirm']);
            }
            if(isset($this->request->data['user_id']))
            {
                $conditions[] = array('BookingMaster.user_id' => $this->request->data['user_id']);
            }
            if(isset($this->request->data['emp_id']))
            {
                $conditions[] = array('BookingMaster.emp_id' => $this->request->data['emp_id']);
            }
            if(isset($this->request->data['current']))
            {
                $conditions[] = array('DATE(BookingMaster.date) >=' => date('Y-m-d', strtotime($this->request->data['current'])));
            }
            $order_data = $this->BookingMaster->find('all', array(
                'contain' => array('Customer', 'Employee'),
                'conditions' => $conditions
            ));
            $this->Service = ClassRegistry::init('Service');
            foreach($order_data as $key=>$data)
            {
                $services_list = '';
                $services_id = explode(',', $data['BookingMaster']['saloon_services']);

                $services = $this->Service->find('all', array(
                    'contain' => array(),
                    'fields' => array('name'),
                    'conditions' => array('Service.id' => $services_id),
                ));

                foreach($services as $result)
                {
                    $services_list .= $result['Service']['name'].',';
                }
                $services_list = rtrim($services_list, ',');
                $order_data[$key]['BookingMaster']['services'] = $services_list;
                $order_data[$key]['BookingMaster']['customer_name'] = $data['Customer']['first_name'].' '.$data['Customer']['last_name'];
                $order_data[$key]['BookingMaster']['employee_name'] = $data['Employee']['first_name'].' '.$data['Employee']['last_name'];
                if($data['BookingMaster']['status'])
                {
                    $order_data[$key]['BookingMaster']['status'] = '1';
                } else {
                    $order_data[$key]['BookingMaster']['status'] = '0';
                }
                if($data['BookingMaster']['is_confirmed'])
                {
                    $order_data[$key]['BookingMaster']['is_confirmed'] = '1';
                } else {
                    $order_data[$key]['BookingMaster']['is_confirmed'] = '0';
                }
            }

            $order_data = Set::extract('/BookingMaster/.', $order_data);
             echo '{"Bookings":'.json_encode($order_data).'}'; die;
        }
    }

    public function add_booking() {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $saloon_services = '';
        if(!empty($this->request->data))
        {
            $services = json_decode($this->request->data['saloon_services'], true);
            $time_slots = json_decode($this->request->data['time_slot'], true);
            $Emp_id = $this->request->data['emp_id'];
            $Date = date('Y-m-d', strtotime($this->request->data['date']));
            $slot_busy = true;
            foreach($time_slots as $slot_id)
            {
            $busy_slot = $this->BookingMaster->Booking->find('list', array(
                'contain' => array(),
                'conditions' => array('Booking.status' => 1, 'Booking.emp_id' => $Emp_id, 'Booking.date' => $Date,
                'Booking.slot_id' => $slot_id['id']),
                'fields' => array('Booking.slot_id')
            ));
            if(!empty($busy_slot))
            {
                $slot_busy = false;
            }
            }
            if($slot_busy) {
            if(!empty($services))
            {
                foreach($services as $result)
                {
                    $saloon_services .= trim($result['id']).',';
                }
                $saloon_services = rtrim($saloon_services, ',');
            }
            $total_booking = $this->BookingMaster->find('count', array(
                'conditions' => array('BookingMaster.status' => 1)
            ));
            $order_id = date('ymd', strtotime($this->request->data['date']));
            $order_id = $order_id.str_pad($total_booking+1, 6, '0', STR_PAD_LEFT);

            $this->request->data['BookingMaster'] = array(
                'order_id' => $order_id,
                'user_id' => $this->request->data['user_id'],
                'emp_id' => $this->request->data['emp_id'],
                'date' => date('Y-m-d', strtotime($this->request->data['date'])),
                'email_id' => $this->request->data['email_id'],
                'phone' => $this->request->data['phone'],
                'comment' => strip_tags($this->request->data['comment']),
                'week_day' => $this->request->data['week_day'],
                'saloon_services' => $saloon_services,
                'status' => 1
            );
            if ($this->BookingMaster->save($this->request->data)) {
                $Booking_id = $this->BookingMaster->getInsertId();
                if(!empty($Booking_id))
                {
                    $this->EmployeeScheduler = ClassRegistry::init('EmployeeScheduler');

                    foreach($time_slots as $data)
                    {
                        $Time_Slot_ID = $this->EmployeeScheduler->find('first', array(
                            'contain' => array(),
                            'fields' => array('id', 'time_start', 'time_end'),
                            'conditions' => array('EmployeeScheduler.id' => $data['id']),
                        ));

                        $Booking_slot_data['Booking'] = array(
                        'booking_id' => $Booking_id,
                        'emp_id' => $this->request->data['emp_id'],
                        'user_id' => $this->request->data['user_id'],
                        'date' => date('Y-m-d', strtotime($this->request->data['date'])),
                        'start_time' => $Time_Slot_ID['EmployeeScheduler']['time_start'],
                        'end_time' => $Time_Slot_ID['EmployeeScheduler']['time_end'],
                        'status' => 1,
                        'slot_id' => $Time_Slot_ID['EmployeeScheduler']['id'],
                        );
                        $this->BookingMaster->Booking->save($Booking_slot_data);
                    }
                    $response = array(
                        'status' => true,
                        'booked_id' => $order_id,
                        'message' => 'Thank You! Your booking is registered successfully.',
                    );
                    $this->AppUser = ClassRegistry::init('AppUser');
                    $User_name = $this->AppUser->find('first', array(
                        'contain' => array(),
                        'fields' => array('first_name', 'last_name', 'gcm'),
                        'conditions' => array('AppUser.id' => $this->request->data['user_id']),
                    ));

                    $emp_name = $this->AppUser->find('first', array(
                        'contain' => array(),
                        'fields' => array('first_name', 'last_name', 'gcm'),
                        'conditions' => array('AppUser.id' => $this->request->data['emp_id']),
                    ));

                    $Admin_User = $this->AppUser->find('first', array(
                        'contain' => array(),
                        'fields' => array('gcm'),
                        'conditions' => array('AppUser.role_id' => 1),
                    ));

                    $Customer_Name = $User_name['AppUser']['first_name'].' '.$User_name['AppUser']['last_name'];
                    $Emp_Name = $emp_name['AppUser']['first_name'].' '.$emp_name['AppUser']['last_name'];

                    $Emp_GCM_MESSAGE = $Customer_Name. " has booked an appointment with ".$order_id." at ".date('d-m-y')." on ".date('h:i:s a', time()). " For You";

                    $Admin_GCM_MESSAGE = $Customer_Name. " has booked an appointment with ".$order_id." at ".date('d-m-y')." on ".date('h:i:s a', time()). " For ".$Emp_Name;

                    $USER_GCM_MESSAGE = "You have booked an appointment with ".$order_id." at ".date('d-m-y')." on ".date('h:i:s a', time()). " For ".$Emp_Name;

                    // Send MSG TO USer
                    $this->General->Send_GCM($Emp_GCM_MESSAGE, $emp_name['AppUser']['gcm'], 1);
                    // Send GCM MSG TO Admin
                    $this->General->Send_GCM($Admin_GCM_MESSAGE, $Admin_User['AppUser']['gcm'], 1);

                    $this->General->Send_GCM($USER_GCM_MESSAGE, $User_name['AppUser']['gcm'], 1);

                    echo json_encode($response); die;
                }
            }
          } else {
                $response = array(
                    'status' => false,
                    'message' => 'Sorry! Time slot already booked, Please select another',
                );
                echo json_encode($response); die;
          }
        } else {
            $response = array(
                'status' => false,
                'message' => 'Something wrong please try again!',
            );
            echo json_encode($response); die;
        }
    }
}
