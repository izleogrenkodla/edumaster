<?php
/**
 * Created by JetBrains PhpStorm.
 * User: proses
 * Date: 1/1/14
 * Time: 7:44 PM
 * To change this template use File | Settings | File Templates.
 */
class GeneralHelper extends AppHelper
{
    public $helpers = array('Session');

    public function GetPriceRange($args = null)
    {
        $str = explode('&', $args);
        foreach ($str as $key => $parameter) {
            if (strpos($parameter, 'room_price_range') !== false) {
                $range = explode('=', $str[$key]);
                $range = explode('-', $range[1]);
            }
        }
        return $range;
    }

    public function GetFeesRange($args = null)
    {
        $str = explode('&', $args);
        foreach ($str as $key => $parameter) {
            if (strpos($parameter, 'fees_range') !== false) {
                $range = explode('=', $str[$key]);
                $range = explode('-', $range[1]);
            }
        }
        return $range;
    }

    public function AddLocation($args = null)
    {
        $str = explode('&', $args);
        $range = '';
        foreach ($str as $key => $parameter) {
            if (strpos($parameter, 'location') !== false) {
                $range = $str[$key];
            }
        }
        return $range;
    }

    public function RoomTypeFilter($args = null, $id = null)
    {
        $final_string = array();
        $str = explode('=', $args);
        $final_string = explode(',', $str[1]);
        $final_string_temp = explode(',', $str[1]);
        $str_new = implode(',', $final_string);
        if (in_array($id, $final_string_temp)) {
            $multiple_type = 'room_type=' . $str_new;
        } else {
            $multiple_type = 'room_type=' . $str_new . ',' . $id;
        }
        return $multiple_type;
    }

    public function DaysOfWeek($args = null, $day = null) {
        $str = explode('&', $args);
        $array_index_doctor_availability = $this->array_search_partial($str, 'doctor_availability');
        if($array_index_doctor_availability != '') {
            $doctor_availability = explode('=', $str[$array_index_doctor_availability]);
            $doctor_availability[1] = $day;
            $doctor_availability_new = implode('=',$doctor_availability);
            $str[$array_index_doctor_availability] = $doctor_availability_new;
            $NewUrl = implode('&',$str);
        } else {
            array_push($str, 'doctor_availability=' . $day);
            $NewUrl = implode('&',$str);
        }
        echo "search?{$NewUrl}";
    }

    public function addhttp($url)
    {
        if (false === strpos($url, '://')) {
            $url = 'http://' . $url;
        }
        return $url;
    }

    public function GetHospital($DoctorToHospital = null) {

        # get a list of sort columns and their data to pass to array_multisort
        $sort = array();
        foreach($DoctorToHospital as $k=>$v) {
            $sort['name'][$k] = $v['Hospital']['name'];
        }
        array_multisort($sort['name'], SORT_ASC,$DoctorToHospital);
        $str = "<option value='0'>Select Hospital</option>";
        foreach ($DoctorToHospital as $Hospital) {
            $str .= "<option value=".$Hospital['hospital_id'].">".$Hospital['Hospital']['name']."</option>";
        }
        echo $str;
    }

    public function GetDayName($day = null)
    {
        $day_array = array('1' => 'Mon','2' => 'Tue','3' => 'Wed','4' => 'Thu','5' => 'Fri','6' => 'Sat','7' => 'Sun');
        echo $day_array[$day];
    }

    public function GetTime($StartTime=null, $EndTime=null)
    {
        $StartTime = date('h:i A', strtotime($StartTime));
        $EndTime = date('h:i A', strtotime($EndTime));

        echo $StartTime .' To '.$EndTime;
    }

    public function GetDob()
    {
        $day = "<option value='0' selected='selected'>Day</option>";
        $month = "<option value='0' selected='selected'>Month</option>
        	    <option value='1'>JAN</option>
				<option value='2'>FEB</option>
				<option value='3'>MAR</option>
				<option value='4'>APR</option>
				<option value='5'>MAY</option>
				<option value='6'>JUN</option>
				<option value='7'>JUL</option>
				<option value='8'>AUG</option>
				<option value='9'>SEP</option>
				<option value='10'>OCT</option>
				<option value='11'>NOV</option>
				<option value='12'>DEC</option>";
        $year = "<option value='0' selected='selected'>Year</option>";
        for($i = 1; $i <= 31; $i++) {
            $day .= "<option value='".$i."'>$i</option>";
        }
        for($i = date('Y'); $i >= 1900; $i--) {
            $year .= "<option value='".$i."'>$i</option>";
        }
    return "<li class='form-line'>
                    <label class='form-label-left'>
                        <span class='form-required'>*</span> Date Of Birth :
                    </label>
                    <div class='form-input'>
                        <select name='data[User][day]' id='UserDay' class='input-xlarge country-code'>".$day."</select>
                    </div>
                    <div class='form-input'>
                        <select name='data[User][month]' id='UserDay' class='input-xlarge country-code'>".$month."</select>
                    </div>
                    <div class='form-input'>
                        <select name='data[User][year]' id='UserDay' class='input-xlarge country-code'>".$year."</select>
                    </div>
                </li>";
    }

    public function return_array_of_numbers($howmany)
    {
        $total[] = array();
        for ($i = 0; $i <= $howmany; $i++) {
            $total[$i] = $i;
        }
        return $total;
    }

    public function return_array_days()
    {
        $total[] = array();
        $total[0] = 'Day';
        for ($i = 1; $i <= 31; $i++) {
            $total[$i] = $i;
        }
        return $total;
    }

    public function return_array_year()
    {
        $total[] = array();
        $total[0] = 'Year';
        for($i = date('Y'); $i >= 1900; $i--) {
            $total[$i] = $i;
        }
        return $total;
    }

    public function array_search_partial($arr, $keyword)
    {
        foreach ($arr as $index => $string) {
            if (strpos($string, $keyword) !== FALSE)
                return $index;
        }
    }

    public function first_letter_capitalized($text = null)
    {
        $result = '';
        $sentence_text = ucwords(strtolower($text));
        $result = preg_replace('#[.-][a-z]#e', 'strtoupper(\'$0\')', $sentence_text);
        return $result;
    }

	public function datefordb($date) {
		return date('Y-m-d',strtotime(str_replace("/",'-',$date)));
	}
	
	public function dbfordate($date) {
		return date('d/m/Y',strtotime($date));
	}

    public function GetRolName($id = null)
    {
        $role_name = 'Registered User';
        if($id != null && $id != 0)
        {
        $role_array = array('1' => 'Administrator', '2' => 'Moderator', '3' => 'Club Member',
            '4' => 'Registered User');
        $role_name  = $role_array[$id];
        }
        return $role_name;
    }

    public function Print_Label($key = null)
    {
        if($key != null)
        {
         return $this->Session->read("Form_label.{$key}.KEY_ALIAS");
        } else {
            return 'Label';
        }
        return 'Label';
    }

    public function Print_Tooltip($key = null)
    {
        if($key != null)
        {
            return $this->Session->read("Form_label.{$key}.TOOL_TIP");
        } else {
            return 'Label';
        }
        return 'Label';
    }

       
   public function uploadfilenotes() { 
   	return "<strong>Allowed Size in kb</strong>: ".ALLOWED_SIZE.', <strong> Allowed Extentions</strong>: '.ALLOWED_EXT;
   }

   public function  uploadfilenotesPDF() { 
   	return "<strong>Allowed Size in kb</strong>: ".ALLOWED_SIZE.', <strong> Allowed Extentions</strong>: pdf';
   }

   public function getStatusOfStudent($array=array()) { 
		$return = '';
			if((isset($array["STUDENT_STATUS"]) && $array["STUDENT_STATUS"]!='') && (isset($array["TEACHER_STATUS"]) && $array["TEACHER_STATUS"]!='')) {
					if($array["STUDENT_STATUS"] === $array["TEACHER_STATUS"]) {
						$return =  'completed';
					}else if($array["STUDENT_STATUS"]==1 && $array["TEACHER_STATUS"]==0){
						$return =  'pending from teacher';
					}else if($array["STUDENT_STATUS"]==0 && $array["TEACHER_STATUS"]==1) {
						$return =  'pending from student';						
					}
			}else{
				return 'pending';
			}
			
	}// end of functions
	
	public function GetResultStatus($id) {
		switch($id) {
			case SUB_COMPARTMENT:
				return 'Compartment';
			break;
			case SUB_FAIL:
				return 'Failed';
			break;
			case SUB_PASS:
				return 'Pass';
			break;
		}
		
	}
	public function getBookStatus($id) {
		switch($id) { 
			case RECEIVED_ID:
				return RECEIVED_BOOK;
			break;
			case ISSUED_ID:
				return ISSUED_BOOK;
			break;
		}
	}// end of functions
      
      public function subval_sort($a,$subkey) {
			foreach($a as $k=>$v) {
				$b[$k] = strtolower($v[$subkey]);
			}
			asort($b);
			foreach($b as $key=>$val) {
				$c[] = $a[$key];
			}
			return $c;
		}  
}