<?php
// app/Controller/UsersController.php
class AttendanceController extends AppController
{
    var $name = 'Attendance';

    public function beforeFilter()
    {
        parent::beforeFilter();

        $this->Auth->allow('App_CheckAttendance','App_AddAttendance','App_AttendanceCount','App_GetAttendance');

        if(isset($this->Security) &&  ($this->RequestHandler->isAjax() || $this->RequestHandler->isPost())){
            $this->Security->validatePost = false;
            $this->Security->enabled = false;
            $this->Security->csrfCheck = false;
        }
    }
    
    public function App_CheckAttendance()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;

        $conditions = array();

        if(!empty($this->request->data))
        {
            $currentDate = $this->request->data['CURRENT_DATE'];

            $conditions = array('ATTENDANCE_DATE' => $currentDate);

            $AttendanceData = $this->Attendance->find('all',array(
                'conditions' => $conditions,
                'fields' => array()
            ));

            if(isset($AttendanceData) && !empty($AttendanceData))
            {
                $message = 'The Attendance has been done for today';
                $status = true;

                $result_array = array(
                    'status' => $status,
                    'message' => $message,
                    'data' => $AttendanceData
                );

            }
            else
            {
                $message = 'The attendance is still pending today';
                $status = false;

                $result_array = array(
                    'status' => $status,
                    'message' => $message,
                );
            }
        }
        else
        {
            $message = 'Opps something wrong!';
            $status = false;

            $result_array = array(
                'status' => $status,
                'message' => $message
            );

        }

        echo json_encode($result_array); die;

    }

    public function App_AddAttendance()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;

        if(!empty($this->request->data['ATTENDANCE_DETAIL_DATA']))
        {

            $data = $this->request->data;

            $attendanceData = json_decode($data['ATTENDANCE_DETAIL_DATA'], true);

            
            foreach($attendanceData as $key=>$array_set)
            {
               
                
                    $array_set['ATTENDANCE_DATE'] = date('Y-m-d');
                    
                    
                    if(strtolower($array_set['AVAILABILITY']) == 'a')
                    {
                        $UserData = $this->Attendance->User->find('first',array(
                            'conditions'=>array(
                                'User.ID'=>$array_set['ID']
                            )
                        ));

                        $deviceId = $UserData['User']['DEVICE_ID'];
                        $fullName = $UserData['User']['FIRST_NAME'].' '.$UserData['User']['LAST_NAME'];
                        $email = $UserData['User']['EMAIL_ID'];
                        $attendanceDate = $this->General->dbfordate($array_set['ATTENDANCE_DATE']);

                        $msg = '';
                        $msg = 'Dear Parents, This is to notify that your child '.$fullName.' is absent on '.$attendanceDate.'. Kindly take a note of it.';

                        $this->General->Send_GCM($msg, $deviceId, 1);

                        $data = array(
                            'FULL_NAME' => $fullName,
                            'EMAIL' => $email,
                            'DATE' => $attendanceDate
                        );

                        $this->send_mail($data);
                    }
                    
             
                $this->Attendance->create();
                
	        $this->Attendance->save(array("Attendance"=>$array_set));
                
            }

            $message = 'Your Attendance is Successfully submitted to HR';
            $status = true;
        }
        else
        {
            $message = 'Opps something wrong!';
            $status = false;
        }

        $result_array = array(
            'status' => $status,
            'message' => $message
        );

        echo json_encode($result_array); die;

    }
    
    public function App_AttendanceCount()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;

        $startDate = $this->request->data['START_DATE'];
        $endDate = $this->request->data['END_DATE'];
        $userId = $this->request->data['ID'];


        if(!empty($startDate) && !empty($endDate) && !empty($userId))
        {

            $conditions[] = array("Attendance.ATTENDANCE_DATE <= " => date('Y-m-d', strtotime($endDate)));
            $conditions[] = array("Attendance.ATTENDANCE_DATE >= " => date('Y-m-d', strtotime($startDate)));
            $conditions[] = array('Attendance.ID' => $userId);
            $conditions[] = array('Attendance.AVAILABILITY' => 'P');

            $PresentCount = $this->Attendance->find('count', array(
                'fields' => array(),
                'conditions' => $conditions,
            ));

            $conditions2[] = array("Attendance.ATTENDANCE_DATE <= " => date('Y-m-d', strtotime($endDate)));
            $conditions2[] = array("Attendance.ATTENDANCE_DATE >= " => date('Y-m-d', strtotime($startDate)));
            $conditions2[] = array('Attendance.ID' => $userId);
            $conditions2[] = array('Attendance.AVAILABILITY' => 'A');

            $ApsentCount = $this->Attendance->find('count', array(
                'fields' => array(),
                'conditions' => $conditions2,
            ));

            $data = array(
                'Present_day' => $PresentCount,
                'Apsent_day' => $ApsentCount,
            );

            $message = 'Your Attendance count';
            $status = true;
        }
        else
        {
            $message = 'Opps something wrong!';
            $status = false;
        }

        $result_array = array(
            'status' => $status,
            'message' => $message,
            'data' => $data
        );

        echo json_encode($result_array); die;

    }
    
    public function App_GetAttendance()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
		$month_conditions = array();
        $status = false;

        $startDate = $this->request->data['START_DATE'];
        $endDate = $this->request->data['END_DATE'];
        $userId = $this->request->data['ID'];


        if(!empty($startDate) && !empty($endDate) && !empty($userId))
        {

			$month_conditions[] = array("Holiday.STATUS" => 1);
			$month_conditions[] = array("MONTH(Holiday.START_DATE)" => date('m', strtotime($startDate)));
            $conditions[] = array("Attendance.ATTENDANCE_DATE <= " => date('Y-m-d', strtotime($endDate)));
            $conditions[] = array("Attendance.ATTENDANCE_DATE >= " => date('Y-m-d', strtotime($startDate)));
            $conditions[] = array('Attendance.ID' => $userId);
            $conditions[] = array('Attendance.AVAILABILITY' => 'P');

            $Present = $this->Attendance->find('all', array(
                'recursive' => '-1',
                'fields' => array('ATTENDANCE_DATE','AVAILABILITY'),
                'conditions' => $conditions,
            ));

            $PresentData = Set::extract('/Attendance/.', $Present);

            $conditions2[] = array("Attendance.ATTENDANCE_DATE <= " => date('Y-m-d', strtotime($endDate)));
            $conditions2[] = array("Attendance.ATTENDANCE_DATE >= " => date('Y-m-d', strtotime($startDate)));
            $conditions2[] = array('Attendance.ID' => $userId);
            $conditions2[] = array('Attendance.AVAILABILITY' => 'A');

            $Apsent = $this->Attendance->find('all', array(
                'recursive' => '-1',
                'fields' => array('ATTENDANCE_DATE','AVAILABILITY'),
                'conditions' => $conditions2,
            ));

            $ApsentData = Set::extract('/Attendance/.', $Apsent);
			$this->Holiday = ClassRegistry::init('Holiday');
			$holiday_data = $this->Holiday->find('all', array(
			'contain' => array(),
			'fields' => array('HOLIDAY_ID','TITLE', 'DESCRIPTION', 'START_DATE', 'END_DATE'),
			'conditions' => $month_conditions		
			));
			
			// pr($holiday_data); die;
			$list_of_holidays = array();
			foreach($holiday_data as $h_data) {			
			    $datetime1 = strtotime($h_data['Holiday']['START_DATE']); // or your date as well
				$datetime2 = strtotime($h_data['Holiday']['END_DATE']);
				$datediff = $datetime2 - $datetime1;
				$total_day = floor($datediff/(60*60*24));
				$total_day = intval($total_day);
				$tlt_day = ($total_day) + (1);
				for($i=1;$i<=$tlt_day;$i++)
				{
					if($i != 1) {
					$k = $i - 1;
					$list_of_holidays[] = array(
					'TITLE' => $h_data['Holiday']['TITLE'],
					'DESCRIPTION' => $h_data['Holiday']['DESCRIPTION'],
					'DATE' => date('d-m-Y', strtotime($h_data['Holiday']['START_DATE']. " + ".$k." days"))					
					);
					} else {
					 $list_of_holidays[] = array(
					'TITLE' => $h_data['Holiday']['TITLE'],
					'DESCRIPTION' => $h_data['Holiday']['DESCRIPTION'],
					'DATE' => date('d-m-Y', strtotime($h_data['Holiday']['START_DATE']))					
					);
					}
				}
			}
			
            $data = array(
                'Present_day' => $PresentData,
                'Apsent_day' => $ApsentData,
				'Holiday' => $list_of_holidays
            );

            $message = 'Your Attendance count';
            $status = true;
        }
        else
        {
            $message = 'Opps something wrong!';
            $status = false;
        }

        $result_array = array(
            'status' => $status,
            'message' => $message,
            'data' => $data
        );

        echo json_encode($result_array); die;

    }
    
    public function send_mail($post=array()) {
        $mg_api = 'key-74be9f4872781161d12408795f411673';
        $mg_version = 'api.mailgun.net/v2/';
        $mg_domain = "sandbox0b14f0410b2a4555920843d785a10b10.mailgun.org";
        $mg_from_email = ADMIN_EMAIL;
        $mg_reply_to_email = ADMIN_EMAIL;
        $mg_message_url = "https://".$mg_version.$mg_domain."/messages";

        $fullName = $post['FULL_NAME'];
        $email = $post['EMAIL'];
        $attendanceDate = $post['DATE'];

        $msg = '';
        $msg = 'Dear Parents, This is to notify that your child '.$fullName.' is absent on '.$attendanceDate.'. Kindly take a note of it.';

        /////////////////////////////////////

        $message = '<div align="center">
                          <table cellspacing="5" cellpadding="5" border="0" width="600" style="background: none repeat scroll 0% 0% rgb(244, 244, 244); border: 1px solid rgb(102, 102, 102);">
                            <tbody>
                              <tr>
                                <th style="background-color: rgb(204, 204, 204);">Attendance Notification [DATE]</th>
                              </tr>
                              <tr>
                                <td valign="top" style="text-align: left;">
                                   <br />
                                   Dear Parents,<br />
                                   <br />
                                   This is to notify that your child [FULL_NAME] is absent on [DATE]. Kindly take a note of it.<br />
                                   <br />
                                    <br /><hr /><br />
                                </td>
                              </tr>
                              <tr>
                                <td style="text-align: left;"><em>Thanks,<br />
                                     [WEBSITE_NAME]<br />
                                     <a href="[URL]">[URL]</a></em></td>
                              </tr>
                            </tbody>
                          </table></div>';

        $body = str_replace(
            array('[FULL_NAME]', '[DATE]', '[URL]', '[WEBSITE_NAME]'),
            array($post['FULL_NAME'], $post['DATE'],SITE_URL, WEBSITE_NAME), $message);



        $subject = 'Attendance Notification '.date('d/m/Y').' '.WEBSITE_NAME;

        $postArr = array(
            'from'      => WEBSITE_NAME.' <' . $mg_from_email . '>',
            'to'        => $email,
            'h:Reply-To'=>  ' <' . $mg_reply_to_email . '>',
            'subject'   => $subject,
            'html'      => $body,
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

        curl_setopt ($ch, CURLOPT_MAXREDIRS, 3);
        curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, false);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_VERBOSE, 0);
        curl_setopt ($ch, CURLOPT_HEADER, 1);
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);

        curl_setopt($ch, CURLOPT_USERPWD, 'api:' . $mg_api);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: multipart/form-data"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($ch, CURLOPT_POST, true);
        //curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_HEADER, false);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_URL, $mg_message_url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postArr);
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result,TRUE);

    }
	

}