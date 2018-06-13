<?php
App::uses('Component', 'Controller');
class GeneralComponent extends Component
{
    public $showMsg;
    public $components = array('Session', 'SwiftMailer');

    function  GetServiceName($data = array())
    {
        $string = '';
        if(!empty($data))
        {
            foreach($data as $result)
            {
                $string .= $result['Service']['name'].', ';
            }
            $string = rtrim($string, ', ');
        }
        return $string;
    }
    function generate_password($length = 6){
        $chars = '0123456789';

        $str = '';
        $max = strlen($chars) - 1;

        for ($i=0; $i < $length; $i++)
            $str .= $chars[mt_rand(0, $max)];

        return $str;
    }

    function generate_report($data = null, $dates)
    {
        $date = date("d-M-Y");
        $path = WWW_ROOT . "/files/ca_icon.png";
        $symbol_path = WWW_ROOT . "/files/inr_symbol.png";
        $logo = '<img src="'.$path.'" width="100"/>';
        $currency_symbol = '<img src="'.$symbol_path.'" width="6" style="padding-top:4px;" />&nbsp;';
        $tcurrency_symbol = '<img src="'.$symbol_path.'" width="10" style="padding-top:6px;"/>&nbsp;';
        $random_num = rand (100000,999999);
        $data_string = '';
        $grand_total = 0;
        $i = 1;
        foreach($data as $key=>$result)
        {
            $desc = strip_tags($result['description']);
            $total = number_format($result['total'],2);
            $grand_total += $result['total'];
            $result_date = date("d-m-Y", strtotime($result['date']));
            $cat_name = $result['category_name'];

            $data_string .= "<tr>
            <td width='50'><small class='extra'>{$i}</small></td>
            <td width='55%'><small class='extra'>{$desc}</small></td>
            <td width='15%' class='right'><small class='extra'>{$currency_symbol}{$total}</small></td>
            <td width='15%'><small class='extra'>{$result_date}</small></td>
            <td width='15%' class='right'><small class='extra'>{$cat_name}</small></td>
            </tr>";
            $i++;
        }
        $grand_total = number_format($grand_total,2);
        $html = <<<EOF
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Your Receipt Report For {$logo}</title>
<style type="text/css">
body { background-color: #fff; color: #333; font-family: DejaVu Serif, Helvetica, Times-Roman; font-size: 12px; margin: 0; padding: 0 }
table { font-size: 65%; width: 100%; border-collapse: separate; border-spacing: 2px }
th, td { position: relative; text-align: left; border-radius: .25em; border-style: solid; border-width: 1px; padding: .5em }
th { background: #EEE; border-color: #BBB }
td { border-color: #DDD }
h1 { font: bold 100% sans-serif; letter-spacing: .5em; text-align: center; text-transform: uppercase }
table.inventory { clear: both; width: 100% }
table.inventory th, table.payments th { font-weight: 700; text-align: center }
table.inventory td:nth-child(1) { width: 52% }
table.payments { padding-top: 20px }
table.balance th, table.balance td { width: 50% }
.green { background-color: #D5EEBE; color: #689340 }
.blue { background-color: #D0EBFB; color: #4995B1 }
.red { background-color: #FAD0D0; color: #AF4C4C }
.yellow { background-color: #FFC; color: #BBB840 }
#aside { padding-top: 30px; font-size: 65% }
small { font-size: 11px !important; line-height: 11px !important; }
.inventory th span.heading { font-size: 13px !important; line-height: 13px !important; }
#aside h1 { border: none; border-bottom-style: solid; border-color: #999; border-width: 0 0 1px; margin: 0 0 1em }
table.inventory td.right { text-align: right; width: 12% }
table.payments td.right, table.balance td { text-align: right }
#footer { position: fixed; bottom: 0px; left: 0px; right: 0px; height: 100px; text-align: center; border-top: 2px solid #eee; font-size: 65%; padding-top: 5px }
</style>
</head>
<body>
<table border="0">
  <tr>
    <td style="width: 60%;" valign="top">{$logo}</td>
    <td valign="top" style="width:40%;text-align: right"><h4 style="margin:0px;padding:0px;font-size: 12px;">Report ID: #CA-RP{$random_num}</h4>
      <h4 style="margin:0px;padding:0px;font-size: 12px;">{$dates}</h4></td>
  </tr>
</table>
<div style="background-color:#ddd;height:1px">&nbsp;</div>
<div style="height:20px"></div>
<table class="inventory">
  <thead>
    <tr>
      <th><span>Receipts List</span></th>
    </tr>
  </thead>
    </tbody>
</table>
<table class="inventory">
  <thead>
    <tr>
      <th><span class="heading">SR. NO.</span></th>
      <th><span class="heading">Title</span></th>
      <th><span class="heading">Amount</span></th>
      <th><span class="heading">Date</span></th>
      <th><span class="heading">Category</span></th>
    </tr>
  </thead>
  <tbody>
        {$data_string}
  </tbody>
</table>
<table class="balance">
  <tr>
    <th><span>Total</span></th>
    <td>{$tcurrency_symbol}<span>{$grand_total}</span></td>
  </tr>
</table>
<div id="aside">
  <h1><span>Additional Notes</span></h1>
  <div>
    <p><small class="extra">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</small></p>
  </div>
</div>
</body>
</html>
EOF;

        return $html;
    }

    public function shoot_email($data = null, $template_name)
    {
        $mailing_list = array(urldecode($data['email_id']));
        $mg_api = 'key-74be9f4872781161d12408795f411673';
        $mg_version = 'api.mailgun.net/v2/';
        $mg_domain = "sandbox0b14f0410b2a4555920843d785a10b10.mailgun.org";
        $mg_from_email = "support@ncsc.co.in";
        $mg_reply_to_email = "support@ncsc.co.in";
        $mg_message_url = "https://".$mg_version.$mg_domain."/messages";
        $subject = '';
        $body = '';
        if($template_name == 'register') {
            $subject = 'Thanks for registering in '.ADMIN_EMAIL_NAME;
            $message = '<div align="center">
                          <table cellspacing="5" cellpadding="5" border="0" width="600" style="background: none repeat scroll 0% 0% rgb(244, 244, 244); border: 1px solid rgb(102, 102, 102);">
                            <tbody>
                              <tr>
                                <th style="background-color: rgb(204, 204, 204);">Welcome [NAME]! Thanks for registering.</th>
                              </tr>
                              <tr>
                                <td valign="top" style="text-align: left;">Hello,<br />
                                   <br />
                                   You\'re now a member of [WEBSITE_NAME].<br />
                                   Here are your login details. Please keep them in a safe place:<br />
                                   <br />
                                   User id: <strong>[EMAIL]</strong><br />
                                   Password: <strong>[PASSWORD]</strong><hr />
                                   </td>
                              </tr>
                              <tr>
                                <td style="text-align: left;"><em>Thanks,<br />
                                     [WEBSITE_NAME]<br />
                                     </em></td>
                              </tr>
                            </tbody>
                          </table></div>';

            $body = str_replace(
                array('[NAME]', '[EMAIL]', '[PASSWORD]', '[WEBSITE_NAME]'),
                array($data['first_name']. ' ' .$data['last_name'],
                    urldecode($data['email_id']), $data['password'], ADMIN_EMAIL_NAME), $message);
        } elseif($template_name == 'forgot_email') {
            $subject = 'Your password is reset!';
            $message = '<div align="center">
                          <table cellspacing="5" cellpadding="5" border="0" width="600" style="background: none repeat scroll 0% 0% rgb(244, 244, 244); border: 1px solid rgb(102, 102, 102);">
                            <tbody>
                              <tr>
                                <th style="background-color: rgb(204, 204, 204);">Password successfully reset</th>
                              </tr>
                              <tr>
                                <td valign="top" style="text-align: left;">
                                   Dear user <strong>[EMAIL]</strong>,<br />
                                   Your password has been reset. Your new password is <strong>[PASSWORD]</strong>
                                </td>
                              </tr>
                              <tr>
                                <td style="text-align: left;"><em>Thanks,<br />
                                     [WEBSITE_NAME]<br />
                                     </em></td>
                              </tr>
                            </tbody>
                          </table></div>';

            $body = str_replace(
                array('[EMAIL]', '[PASSWORD]', '[WEBSITE_NAME]'),
                array(urldecode($data['EMAIL_ID']), $data['PASSWORD'], ADMIN_EMAIL_NAME), $message);
        }

        foreach($mailing_list as $key=>$email_id) {
            $postArr = array(
                'from'      => 'Nivida <' . 'ecom@nividaweb.com' . '>',
                'to'        => $email_id,
                'h:Reply-To'=>  ' <' . $mg_reply_to_email . '>',
                'subject'   => $subject,
                'html'      => $body,
                //  'attachment[1]' => '@C:\Users\admin\Desktop\1-24-2015 11-16-46 AM.jpg',
                //	'attachment[2]' => '@C:\Users\admin\Desktop\seo.jpg'
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

            if(!empty($postArr['attachments']))
            {
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: multipart/form-data"));
            }

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
            $res = json_decode($result,TRUE);
        }
        return true;
    }

	public function shoot_forgot_email($data = null, $template_name)
    {
        $mailing_list = array(urldecode($data['EMAIL_ID']));
        $mg_api = 'key-74be9f4872781161d12408795f411673';
        $mg_version = 'api.mailgun.net/v2/';
        $mg_domain = "sandbox0b14f0410b2a4555920843d785a10b10.mailgun.org";
        $mg_from_email = "support@ncsc.co.in";
        $mg_reply_to_email = "support@ncsc.co.in";
        $mg_message_url = "https://".$mg_version.$mg_domain."/messages";
        $subject = '';
        $body = '';
        if($template_name == 'register') {
            $subject = 'Thanks for registering in '.ADMIN_EMAIL_NAME;
            $message = '<div align="center">
                          <table cellspacing="5" cellpadding="5" border="0" width="600" style="background: none repeat scroll 0% 0% rgb(244, 244, 244); border: 1px solid rgb(102, 102, 102);">
                            <tbody>
                              <tr>
                                <th style="background-color: rgb(204, 204, 204);">Welcome [NAME]! Thanks for registering.</th>
                              </tr>
                              <tr>
                                <td valign="top" style="text-align: left;">Hello,<br />
                                   <br />
                                   You\'re now a member of [WEBSITE_NAME].<br />
                                   Here are your login details. Please keep them in a safe place:<br />
                                   <br />
                                   User id: <strong>[EMAIL]</strong><br />
                                   Password: <strong>[PASSWORD]</strong><hr />
                                   </td>
                              </tr>
                              <tr>
                                <td style="text-align: left;"><em>Thanks,<br />
                                     [WEBSITE_NAME]<br />
                                     </em></td>
                              </tr>
                            </tbody>
                          </table></div>';

            $body = str_replace(
                array('[NAME]', '[EMAIL]', '[PASSWORD]', '[WEBSITE_NAME]'),
                array($data['first_name']. ' ' .$data['last_name'],
                    urldecode($data['EMAIL_ID']), $data['PASSWORD'], ADMIN_EMAIL_NAME), $message);
        } elseif($template_name == 'forgot_email') {
            $subject = 'Your password is reset!';
            $message = '<div align="center">
                          <table cellspacing="5" cellpadding="5" border="0" width="600" style="background: none repeat scroll 0% 0% rgb(244, 244, 244); border: 1px solid rgb(102, 102, 102);">
                            <tbody>
                              <tr>
                                <th style="background-color: rgb(204, 204, 204);">Password successfully reset</th>
                              </tr>
                              <tr>
                                <td valign="top" style="text-align: left;">
                                   Dear User <strong>[EMAIL]</strong>,<br />
                                   Your password has been reset. Your new password is <strong>[PASSWORD]</strong>
                                </td>
                              </tr>
                              <tr>
                                <td style="text-align: left;"><em>Thanks,<br />
                                     [WEBSITE_NAME]<br />
                                     </em></td>
                              </tr>
                            </tbody>
                          </table></div>';

            $body = str_replace(
                array('[EMAIL]', '[PASSWORD]', '[WEBSITE_NAME]'),
                array(urldecode($data['EMAIL_ID']), $data['PASSWORD'], ADMIN_EMAIL_NAME), $message);
        }

        foreach($mailing_list as $key=>$email_id) {
            $postArr = array(
                'from'      => 'Nivida <' . 'ecom@nividaweb.com' . '>',
                'to'        => $email_id,
                'h:Reply-To'=>  ' <' . $mg_reply_to_email . '>',
                'subject'   => $subject,
                'html'      => $body,
                //  'attachment[1]' => '@C:\Users\admin\Desktop\1-24-2015 11-16-46 AM.jpg',
                //	'attachment[2]' => '@C:\Users\admin\Desktop\seo.jpg'
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

            if(!empty($postArr['attachments']))
            {
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: multipart/form-data"));
            }

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
            $res = json_decode($result,TRUE);
        }
        return true;
    }

    function getLastQuery()
    {
        $dbo = ConnectionManager::getDataSource('default');
        $logs = $dbo->getLog();
        $lastLog = end($logs['log']);
        return $lastLog['query'];
    }

    public function shoot_report($data = null, $download_link, $dates, $email_id)
    {
        $mailing_list = $email_id;
        $mg_api = 'key-74be9f4872781161d12408795f411673';
        $mg_version = 'api.mailgun.net/v2/';
        $mg_domain = "sandbox0b14f0410b2a4555920843d785a10b10.mailgun.org";
        $mg_from_email = "ecom@nividaweb.com";
        $mg_reply_to_email = "ecom@nividaweb.com";
        $mg_message_url = "https://".$mg_version.$mg_domain."/messages";
        $subject = '';
        $body = '';
        $subject = 'CA Bridge '.$dates;
        $message = '<div align="center">
                          <table cellspacing="5" cellpadding="5" border="0" width="600" style="background: none repeat scroll 0% 0% rgb(244, 244, 244); border: 1px solid rgb(102, 102, 102);">
                            <tbody>
                              <tr>
                                <th style="background-color: rgb(204, 204, 204);">CA Bridge Report</th>
                              </tr>
                              <tr>
                                <td valign="top" style="text-align: left;">
                                   Dear <strong>[NAME]</strong>,<br />
                                   Please click on below download link for your Receipts</strong><br/><br/>
                                   <a href="[DOWNLOAD]" target="_blank">Download</a>
                                </td>
                              </tr>
                              <tr>
                                <td style="text-align: left;"><em>Thanks,<br />
                                     [WEBSITE_NAME]<br />
                                     </em></td>
                              </tr>
                            </tbody>
                          </table></div>';

        $body = str_replace(
            array('[NAME]', '[DOWNLOAD]', '[WEBSITE_NAME]'),
            array($data['full_name'], $download_link, APP_NAME), $message);

        $postArr = array(
            'from'      => 'Nivida <' . 'ecom@nividaweb.com' . '>',
            'to'        => $mailing_list,
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
        $res = json_decode($result,TRUE);

        return true;
    }

    public function MessageNotification($id = null)
    {
        $MsgCount = 0;
        if($id !=0 && $id !='') {
            $this->MessageState = ClassRegistry::init('MessageState');
            $MsgCount = $this->MessageState->find('count', array(
                'conditions' => array('is_deleted' => 0, 'receiver_id' => $id, 'status' => 1),
                'recursive' => -1
            ));
        }
        return $MsgCount;
    }

    public function Find_Days($start_date, $days)
    {
        $now = time(); // or your date as well
        $your_date = strtotime($start_date);
        $datediff = $now - $your_date;
        $days_left = floor($datediff/(60*60*24));
        if($days >= $days_left)
        {
            return false;
        }
        return true;
    }

    public function ConvertClock24($time = null)
    {
        $time_array = explode(' ', $time);
        if($time_array[1] === 'PM')
        {
            $final_time = explode(':', $time_array[0]);
            $final_time[0] = $final_time[0]+12;
            $final_time = implode(':', $final_time);
        }
        else {
            $final_time = $time_array[0];
        }
        return $final_time;
    }
    public function persist($duration = '2 weeks')
    {
        App::import("Model", "User");
        $userModel = new User;
        $token = $userModel->authsomePersist($this->getUserId(), $duration);
        $token = $token . ':' . $duration;
        return $this->Cookie->write(
            'hospital',
            $token,
            true, // encrypt = true
            $duration
        );
    }

    public function msgStatus($msgs)
    {
        $this->showMsg = "<div class=\"msgError\">" . "<ul class=\"error\">";
        foreach ($msgs as $msg) {
            $this->showMsg .= "<li>" . $msg . "</li>\n";
        }
        $this->showMsg .= "</ul></div>";

        return $this->showMsg;
    }

    public function msgOk($msg, $url = null, $fader = true, $altholder = false)
    {
        $this->showMsg = "<div class=\"msgOk\">" . $msg . "</div>";
        if ($fader == true) {
            if ($url != '') {
                $this->showMsg .= "<script type=\"text/javascript\">
		  // <![CDATA[
			setTimeout(function() {
			  $(\".msgOk\").customFadeOut(\"slow\",
			  function() {
				$(\".msgOk\").remove();
			  });
			},
			1000);
	       $('#email_avail').hide();
           $('#email_not_avail').show();
        window.setTimeout(function(){
        window.location.href = \"{$url}\";
        }, 2000);

		  // ]]>
		  </script>";
            } else {
                $this->showMsg .= "<script type=\"text/javascript\">
		  // <![CDATA[
			setTimeout(function() {
			  $(\".msgOk\").customFadeOut(\"slow\",
			  function() {
				$(\".msgOk\").remove();
			  });
			},
			2000);
		  // ]]>
		  </script>";
            }
        }
        print ($altholder) ? '<div id="alt-msgholder">' . $this->showMsg . '</div>' : $this->showMsg;
    }

    /**
     * msgInfo()
     *
     * @param mixed $msg
     * @param bool $fader
     * @param bool $altholder
     * @return
     */
    public function msgInfo($msg, $fader = true, $altholder = false)
    {
        $this->showMsg = "<div class=\"msgInfo\">" . $msg . "</div>";
        if ($fader == true)
            $this->showMsg .= "<script type=\"text/javascript\">
		  // <![CDATA[
			setTimeout(function() {
			  $(\".msgInfo\").customFadeOut(\"slow\",
			  function() {
				$(\".msgInfo\").remove();
			  });
			},
			4000);
			$( 'form' ).each(function(){
            this.reset();
            });
            $('#email_avail').hide();
            $('#email_not_avail').show();
		  // ]]>
		  </script>";

        print ($altholder) ? '<div id="alt-msgholder">' . $this->showMsg . '</div>' : $this->showMsg;
    }

    /**
     * Core::msgAlert()
     *
     * @param mixed $msg
     * @param bool $fader
     * @param bool $altholder
     * @return
     */
    public function msgAlert($msg, $url = null,$fader = true, $altholder = false)
    {
        $this->showMsg = "<div class=\"msgAlert\">" . $msg . "</div>";
        if ($fader == true) {
            if ($url != '') {

                $this->showMsg .= "<script type=\"text/javascript\">
		  // <![CDATA[
			setTimeout(function() {
			  $(\".msgAlert\").customFadeOut(\"slow\",
			  function() {
				$(\".msgAlert\").remove();
			  });
			},
			4000);
		window.setTimeout(function(){
        window.location.href = \"{$url}\";
        }, 2000);
		  // ]]>
		  </script>";
            } else {
                $this->showMsg .= "<script type=\"text/javascript\">
		  // <![CDATA[
			setTimeout(function() {
			  $(\".msgAlert\").customFadeOut(\"slow\",
			  function() {
				$(\".msgAlert\").remove();
			  });
			},
			4000);
		  // ]]>
		  </script>";
            }
        }
        print ($altholder) ? '<div id="alt-msgholder">' . $this->showMsg . '</div>' : $this->showMsg;
    }

    // Add Http:// in URL if not exists

    function addhttp($url)
    {
        if (false === strpos($url, '://')) {
            $url = 'http://' . $url;
        }
        return $url;
    }

    public function RoomTypeFilterRemove($args = null, $id = null)
    {
        $str_url_room_type = explode('&', $args);
        $array_index_room_type = $this->array_search_partial($str_url_room_type, 'room_type');
        if ($array_index_room_type != '') {
            $str = explode('=', $str_url_room_type[$array_index_room_type]);
            $final_string = explode(',', $str[1]);
            foreach ($final_string as $key => $value) {
                if ($value == $id) {
                    unset($final_string[$key]);
                }
            }
            if (count($final_string) == 0) {
                unset($str_url_room_type[$array_index_room_type]);
            } else {
                $str_new = 'room_type=' . $str_new = implode(',', $final_string);
                $str_url_room_type[$array_index_room_type] = $str_new;
            }
            $NewString = implode('&', $str_url_room_type);
        } else {
            $NewString = $args;
        }
        return $NewString;
    }

    public function array_search_partial($arr, $keyword)
    {
        foreach ($arr as $index => $string) {
            if (strpos($string, $keyword) !== FALSE)
                return $index;
        }
    }

    public function RemoveFilterType($args = null, $type = null)
    {
        $str_url_room_type = explode('&', $args);
        $array_index_room_type = $this->array_search_partial($str_url_room_type, $type);
        if ($array_index_room_type != '') {
            unset($str_url_room_type[$array_index_room_type]);
        }
        $filter_remove = implode('&', $str_url_room_type);
        return $filter_remove;
    }

    function stringToSlug($str) {
        // turn into slug
        $str = Inflector::slug($str);
        // to lowercase
        $str = strtolower($str);
        return $str;
    }

    public function encrypt($data) {
        if ($data !== '') {
            return base64_encode(mcrypt_encrypt(Configure::read('Cryptable.cipher'), Configure::read('Cryptable.key'), $data, 'cbc', Configure::read('Cryptable.iv')));
        } else {
            return '';
        }
    }

    // deletes a file

    public function decrypt($data, $data2 = null) {
        if (is_object($data)) {
            unset($data);
            $data = $data2;
        }

        if ($data != '') {
            return trim(mcrypt_decrypt(Configure::read('Cryptable.cipher'), Configure::read('Cryptable.key'), base64_decode($data), 'cbc', Configure::read('Cryptable.iv')));
        } else {
            return '';
        }
    }

    public function delete_file($file)
    {
        // init
        $url = '';

        // if passed full absolute url
        // if passed a full absolute folder
        if (file_exists($file)) {
            $url = $file;
        }

        // add root to folder
        if (file_exists(WWW_ROOT . $file)) {
            $url = WWW_ROOT . $file;
        }

        //echo $url;
        //echo 'here';

        // valid url
        if ($url != '' && file_exists($url)) {
            @unlink($url);
        }
    }

    /**
     * cleanOut()
     *
     * @param mixed $text
     * @return
     */
    public function cleanOut($text)
    {
        $text = strtr($text, array('\r\n' => "", '\r' => "", '\n' => ""));
        $text = html_entity_decode($text, ENT_QUOTES, 'UTF-8');
        $text = str_replace('<br>', '<br />', $text);
        return stripslashes($text);
    }

    public function sanitize($string, $trim = false, $int = false, $str = false)
    {
        $string = filter_var($string, FILTER_SANITIZE_STRING);
        $string = trim($string);
        $string = stripslashes($string);
        $string = strip_tags($string);
        $string = str_replace(array('‘', '’', '“', '”'), array("'", "'", '"', '"'), $string);

        if ($trim)
            $string = substr($string, 0, $trim);
        if ($int)
            $string = preg_replace("/[^0-9\s]/", "", $string);
        if ($str)
            $string = preg_replace("/[^a-zA-Z\s]/", "", $string);

        return $string;
    }

    public function shortens_string_by_words($str, $number)
    {
        $array_str = explode(" ", $str);
        if (isset($array_str[$number])) {
            return implode(" ", array_slice($array_str, 0, $number));
        }
        return $str;
    }

    public function GetGeoLocation($hid = null)
    {
        $LatLong = array();
        if(!empty($hid)) {
            App::import('Model', 'Hospital');
            $this->Hospital = new Hospital;
            $hospital_address_result = $this->Hospital->find('first', array(
                'contain' => array('AreaMaster', 'CityMaster', 'StateMaster', 'CountryMaster'),
                'fields' => array('name', 'pincode'),
                'conditions' => array('Hospital.id'=> $hid)
            ));
            $name = $hospital_address_result['Hospital']['name'];
            $country_name = $hospital_address_result['CountryMaster']['name'];
            if(!empty($hospital_address_result)) {
                if(stripos($hospital_address_result['Hospital']['name'], 'Hospital') == false) {
                    $name = $name . ' Hospital';
                }
                $address = $name . ' ' . $hospital_address_result['AreaMaster']['name'] . ' ' . $hospital_address_result['CityMaster']['name'] . ' ' . $hospital_address_result['StateMaster']['name'] . ' ' . $hospital_address_result['CountryMaster']['name'] . ' ' . $hospital_address_result['Hospital']['pincode'];

                $location = urlencode($address);
                $url = "http://maps.google.com/maps/api/geocode/json?address=$location&sensor=false&region=$country_name";
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                $response = curl_exec($ch);
                curl_close($ch);
                $response_a = json_decode($response);
                $LatLong[] = $response_a->results[0]->geometry->location->lat;
                $LatLong[] = $response_a->results[0]->geometry->location->lng;
            }
        }
        return $LatLong;
    }

    public function first_letter_capitalized($text = null)
    {
        $result = '';
        $sentence_text = ucwords(strtolower($text));
        $result = preg_replace('#[.-][a-z]#e', 'strtoupper(\'$0\')', $sentence_text);
        return $result;
    }

    public function CALL_GOOGLE_API($service_url)
    {

        $curl = curl_init($service_url);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //IMP if the url has https and you don't want to verify source certificate
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        $curl_response = curl_exec($curl);

        $result['EXE'] = curl_exec($curl);
        $result['INF'] = curl_getinfo($curl);
        $result['ERR'] = curl_error($curl);

        $response = json_decode($curl_response, true);
        curl_close($curl);

        return $response;
    }


    public function Send_GCM($MSG = null, $Device_ID = null, $MSG_TYPE = null)
    {
        //$GOOGLE_API_KEY = "AIzaSyBgsKQlkozfpThIjAaugLPGZaukeEoJgeU"; // Place your Google API Key
		$GOOGLE_API_KEY = "AIzaSyB6uZ03558nrsozKfkJqcJzpC1ZGjAEbgY"; // Place your Google API Key

        /* Getting Devices */
        $gcmRegIds = array(0 => $Device_ID);
        // $getdevices = $this->_model->getdevices();


        /* End of Getting Devices */

        // Message to be sent
        // $message = "Test";
        $gcmmessage = array(
            'message' => $MSG
//            'Booking_Type' => $MSG_TYPE
        );
        // Set POST variables
        $url = 'https://android.googleapis.com/gcm/send';

        $fields = array(
            'registration_ids' => $gcmRegIds,
            'data' => $gcmmessage,
        );

        $headers = array(
            'Authorization: key=' . $GOOGLE_API_KEY,
            'Content-Type: application/json'
        );

        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt( $ch, CURLOPT_URL, $url );

        curl_setopt( $ch, CURLOPT_POST, true );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

        curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );

        // Execute post
        $result = curl_exec($ch);

        // Close connection
        curl_close($ch);

        /*echo $result;*/
        $finalresult = json_decode($result, true);

        return $finalresult['success'];
    }

    public function datefordb($date) {
		return date('Y-m-d',strtotime(str_replace("/",'-',$date)));
	}
	public function excel_datefordb($date) {
		return date('Y-m-d',strtotime(str_replace(",",'-',$date)));
	}
	public function dbfordate($date) {
		return date('d/m/Y',strtotime($date));
	}
        
        public function dateforkey($date) {
		return date('dmY',strtotime($date));
	}	

}