<?php
class UsersController extends AppController
{
    var $name = 'Users';
    var $cache_dir = 'img/cache';
    var $cache_width = 400;
    public $msgs = array();

    public function beforeFilter()
    {
        parent::beforeFilter();

        $this->Auth->allow( 'App_Login','update_GCM','App_UserEdit','App_GetStudentsByRole','App_GetTeachersByRole','App_GetUserInfoByRole','App_GetUserShortInfo', 'App_forgot_password');

        //Here, we disable the Security component for Ajax requests.
        if (isset($this->Security) && ($this->RequestHandler->isAjax() || $this->RequestHandler->isPost())) {
            $this->Security->validatePost = false;
            $this->Security->enabled = false;
            $this->Security->csrfCheck = false;
        }
    }

    public function admin_dashboard()
    {
        $this->layout = 'admin_dashboard';
        $Session_data = $this->Session->read('Auth.Admin');
        if (empty($Session_data)) {
            $this->redirect(array('action' => 'login'));
        }

        $this->School = ClassRegistry::init('School');
        $school = $this->School->find('first',array(
            'ID'=>1,
        ));
        if(sizeof($school)==0) {
            $this->redirect(array('action' => 'login'));
        }

        $this->set('profile',$school);
        $user_menus = array();

        switch($Session_data['ROLE_ID']) {
            case ADMIN_ID:
                $user_menus = array(
				"profile"=>array(
                        "name"=>"1",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"profile")),
                        "bgcolor"=>"my_profile",
                    ),
					"security"=>array(
                        "name"=>"2",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"security",
                    ),
					"FRONT_OFFICE"=>array(
                        "name"=>"3",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"FRONT_OFFICE",
                    ),
					"transports"=>array(
                        "name"=>"4",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"transports",
                    ),
					"exam_result"=>array(
                        "name"=>"5",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"exam_result",
                    ),
					"CANTEEN"=>array(
                        "name"=>"6",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"CANTEEN",
                    ),
					"HOSTEL"=>array(
                        "name"=>"7",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"HOSTEL",
                    ),
					"STORE_PURCHASE"=>array(
                        "name"=>"8",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"STORE_PURCHASE",
                    ),
					"UTILITY_HELP"=>array(
                        "name"=>"9",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"UTILITY_HELP",
                    ),
					"DOWNLOAD"=>array(
                        "name"=>"10",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"DOWNLOAD",
                    ),
					"GALLERY"=>array(
                        "name"=>"11",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"GALLERY",
                    ),
					"ACADEMIC_HISTORY"=>array(
                        "name"=>"12",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"ACADEMIC_HISTORY",
                    ),
					"MAILER"=>array(
                        "name"=>"13",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"MAILER",
                    ),
					"NEWS_UPDATE"=>array(
                        "name"=>"14",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"NEWS_UPDATE",
                    ),
					"TIK_TALK"=>array(
                        "name"=>"15",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"TIK_TALK",
                    ),
					"admission_section"=>array(
                        "name"=>"16",
                        "icon"=>'<i class="fa icon-users"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"admission_section")),
                        "bgcolor"=>"admission_section"
                    ),
					"hr_section"=>array(
                        "name"=>"17",
                        "icon"=>'<i class="fa icon-users"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"hr_section")),
                        "bgcolor"=>"hr_section"
                    ),
					"teacher_section"=>array(
                        "name"=>"18",
                        "icon"=>'<i class="fa icon-users"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"teacher_section")),
                        "bgcolor"=>"teacher_section"
                    ),
					"account_section"=>array(
                        "name"=>"19",
                        "icon"=>'<i class="fa icon-users"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"account_section")),
                        "bgcolor"=>"account_section"
                    ),
					"manage_lib"=>array(
                        "name"=>"20",
                        "icon"=>'<i class="fa icon-docs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"library_section")),
                        "bgcolor"=>"library"
                    ),
					"supervisor"=>array(
                        "name"=>"21",
                        "icon"=>'<i class="fa icon-user-follow"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"superviser_section")),
                        "bgcolor"=>"supervisor_section"
                    ),
                    "studentsection"=>array(
                        "name"=>"22",
                        "icon"=>'<i class="fa icon-user-follow"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"student_section")),
                        "bgcolor"=>"student_section"
                    ),
					"general_setting"=>array(
                        "name"=>"23",
                        "icon"=>'<i class="fa icon-pointer"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"general_setting")),
                        "bgcolor"=>"general_setting"
                    ),	
					"SMS"=>array(
                        "name"=>"24",
                        "icon"=>'<i class="fa icon-pointer"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"sms")),
                        "bgcolor"=>"SMS"
                    ),
					"REMARKS"=>array(
                        "name"=>"25",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"REMARKS",
                    ),					
					"guest_page"=>array(
                        "name"=>"26",
                        "icon"=>'<i class="fa icon-pointer"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"guest")),
                        "bgcolor"=>"guest_page"
                    )
                );
                break;
            case TEACHER_ID:
                $user_menus = array(
                    "profile"=>array(
                        "name"=>"1",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"profile")),
                        "bgcolor"=>"my_profile",
                    ),
					"DOWNLOAD"=>array(
                        "name"=>"9",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"DOWNLOAD",
                    ),
					"REMARKS"=>array(
                        "name"=>"3",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"REMARKS",
                    ),
					"GALLERY"=>array(
                        "name"=>"4",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"GALLERY",
                    ),
					"ACADEMIC_HISTORY"=>array(
                        "name"=>"5",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"ACADEMIC_HISTORY",
                    ),
					"MAILER"=>array(
                        "name"=>"6",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"MAILER",
                    ),
					"NEWS_UPDATE"=>array(
                        "name"=>"7",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"NEWS_UPDATE",
                    ),
					"TIK_TALK"=>array(
                        "name"=>"8",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"TIK_TALK",
                    ),
					"IDCARD"=>array(
                        "name"=>"2",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"IDCARD",
                    ),
					"manage_lib"=>array(
                        "name"=>"10",
                        "icon"=>'<i class="fa icon-docs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"library_section")),
                        "bgcolor"=>"library"
                    ),
                    "studentsection"=>array(
                        "name"=>"11",
                        "icon"=>'<i class="fa icon-user-follow"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"students")),
                        "bgcolor"=>"student_section"
                    ),
                    "my_document"=>array(
                        "name"=>"12",
                        "icon"=>'<i class="fa icon-docs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"documents")),
                        "bgcolor"=>"my_document",
                    ),
                    "my_ebook"=>array(
                        "name"=>"13",
                        "icon"=>'<i class="fa icon-book-open"></i>',
                        "url"=>Router::url(array("controller"=>"EBook")),
                        "bgcolor"=>"ebook"
                    ),

                    "noticeboard"=>array(
                        "name"=>"14",
                        "icon"=>'<i class="fa icon-bell"></i>',
                        "url"=>Router::url(array("controller"=>"NoticeBoard")),
                        "bgcolor"=>"notice_board"
                    ),
                    "manage_events"=>array(
                        "name"=>"15",
                        "icon"=>'<i class="fa icon-calendar"></i>',
                        "url"=>Router::url(array("controller"=>"Events")),
                        "bgcolor"=>"events"
                    ),
                    "supervisor"=>array(
                        "name"=>"16",
                        "icon"=>'<i class="fa icon-user-follow"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"supervisors")),
                        "bgcolor"=>"supervisor_section"
                    ),
                    "teacher_section"=>array(
                        "name"=>"17",
                        "icon"=>'<i class="fa icon-users"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"teachers")),
                        "bgcolor"=>"teacher_section"
                    ),
                    "leave_application"=>array(
                        "name"=>"18",
                        "icon"=>'<i class="fa icon-envelope-letter"></i>',
                        "url"=>Router::url(array("controller"=>"leaveApplications")),
                        "bgcolor"=>"leave_application"
                    ),
                    "user_suggestion"=>array( 
                        "name"=>"19",
                        "icon"=>'<i class="fa icon-bubbles"></i>',
                        "url"=>Router::url(array("controller"=>"suggestions")),
                        "bgcolor"=>"user_suggestion"
                    ),
                    "TeacherTimeTables"=>array(
                        "name"=>"20",
                        "icon"=>'<i class="fa icon-speedometer"></i>',
                        "url"=>Router::url(array("controller"=>"TeacherTimeTables")),
                        "bgcolor"=>"assign_time_table"
                    ),
                    "attendance"=>array(
                        "name"=>"21",
                        "icon"=>'<i class="fa icon-bar-chart"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"attendance_listing")),
                        "bgcolor"=>"attendance"
                    ),
                    "classwork"=>array(
                        "name"=>"22",
                        "icon"=>'<i class="fa icon-note"></i>',
                        "url"=>Router::url(array("controller"=>"Classwork")),
                        "bgcolor"=>"class_work"
                    ),

                    "homework"=>array(
                        "name"=>"23",
                        "icon"=>'<i class="fa icon-note"></i>',
                        "url"=>Router::url(array("controller"=>"Homeworks")),
                        "bgcolor"=>"home_work"
                    ),
                    "student_ledger"=>array(
                        "name"=>"24",
                        "icon"=>'<i class="fa icon-speedometer"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"student_ledger")),
                        "bgcolor"=>"student_ledger"
                    ),
                    "transportation"=>array(
                        "name"=>"25",
                        "icon"=>'<i class="fa icon-pointer"></i>',
                        "url"=>Router::url(array("controller"=>"Transports","action"=>"graphic")),
                        "bgcolor"=>"transports"
                    ),
                    "examination"=>array(
                        "name"=>"26",
                        "icon"=>'<i class="fa icon-calendar"></i>',
                        "url"=>Router::url(array("controller"=>"Exams","action"=>"list")),
                        "bgcolor"=>"exam_schedule"
                    ),
                    "examination_list"=>array(
                        "name"=>"27",
                        "icon"=>'<i class="fa icon-calendar"></i>',
                        "url"=>Router::url(array("controller"=>"Exams")),
                        "bgcolor"=>"exam_list"
                    ),
                    "examination_result"=>array(
                        "name"=>"28",
                        "icon"=>'<i class="fa icon-trophy"></i>',
                        "url"=>Router::url(array("controller"=>"Results")),
                        "bgcolor"=>"exam_result"
                    ),
                );
                break;
            case SUPERVISOR_ID:
                $user_menus = array(
			    	"profile"=>array(
                        "name"=>"1",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"my_profile",
                    ),
			    	"manage_lib"=>array(
                        "name"=>"20",
                        "icon"=>'<i class="fa icon-docs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"library_section")),
                        "bgcolor"=>"library"
                    ),
					"teacher_section"=>array(
                        "name"=>"18",
                        "icon"=>'<i class="fa icon-users"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"teacher_section")),
                        "bgcolor"=>"teacher_section"
                    ),
					 "examination_result"=>array(
                        "name"=>"28",
                        "icon"=>'<i class="fa icon-trophy"></i>',
                        "url"=>Router::url(array("controller"=>"Results")),
                        "bgcolor"=>"exam_result"
                    ),
					 "user_suggestion"=>array( 
                        "name"=>"19",
                        "icon"=>'<i class="fa icon-bubbles"></i>',
                        "url"=>Router::url(array("controller"=>"suggestions")),
                        "bgcolor"=>"user_suggestion"
                    ),
					  "noticeboard"=>array(
                        "name"=>"14",
                        "icon"=>'<i class="fa icon-bell"></i>',
                        "url"=>Router::url(array("controller"=>"NoticeBoard")),
                        "bgcolor"=>"notice_board"
                    ),
					 "attendance"=>array(
                        "name"=>"21",
                        "icon"=>'<i class="fa icon-bar-chart"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"attendance"
                    ),
					 "TeacherTimeTables"=>array(
                        "name"=>"4",
                        "icon"=>'<i class="fa icon-speedometer"></i>',
                        "url"=>Router::url(array("controller"=>"TeacherTimeTables")),
                        "bgcolor"=>"assign_time_table"
                    ),
					"DAILY_DIARY"=>array(
                        "name"=>"9",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"DAILY_DIARY",
                    ),
					"my_ebook"=>array(
                        "name"=>"13",
                        "icon"=>'<i class="fa icon-book-open"></i>',
                        "url"=>Router::url(array("controller"=>"EBook")),
                        "bgcolor"=>"ebook"
                    ),
					"DOWNLOAD"=>array(
                        "name"=>"9",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"DOWNLOAD",
                    ),
					  "leave_application"=>array(
                        "name"=>"18",
                        "icon"=>'<i class="fa icon-envelope-letter"></i>',
                        "url"=>Router::url(array("controller"=>"leaveApplications")),
                        "bgcolor"=>"leave_application"
                    ),
					"REMARKS"=>array(
                        "name"=>"3",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"REMARKS",
                    ),
					"GALLERY"=>array(
                        "name"=>"4",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"GALLERY",
                    ),
					"ACADEMIC_HISTORY"=>array(
                        "name"=>"5",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"ACADEMIC_HISTORY",
                    ),
					"MAILER"=>array(
                        "name"=>"6",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"MAILER",
                    ),
					"NEWS_UPDATE"=>array(
                        "name"=>"7",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"NEWS_UPDATE",
                    ),
					"TIK_TALK"=>array(
                        "name"=>"8",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"TIK_TALK",
                    ),
					"IDCARD"=>array(
                        "name"=>"2",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"IDCARD",
                    ),
					"CANTEEN"=>array(
                        "name"=>"6",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"CANTEEN",
                    ),
					"transports"=>array(
                        "name"=>"4",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"transports",
                    ),
					 "studentsection"=>array(
                        "name"=>"11",
                        "icon"=>'<i class="fa icon-user-follow"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"students")),
                        "bgcolor"=>"student_section"
                    ),
					"HOSTEL"=>array(
                        "name"=>"7",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"HOSTEL",
                    ),
				
                    "examination"=>array(
                        "name"=>"1",
                        "icon"=>'<i class="fa icon-calendar"></i>',
                        "url"=>Router::url(array("controller"=>"Exams")),
                        "bgcolor"=>"exam_schedule"
                    ),
					"manage_exam_type"=>array(
                        "name"=>"2",
                        "icon"=>'<i class="fa icon-note"></i>',
                        "url"=>Router::url(array("controller"=>"ExamTypes")),
                        "bgcolor"=>"exam_type"
                    ),
					"manage_holiday"=>array(
                        "name"=>"3",
                        "icon"=>'<i class="fa icon-calendar"></i>',
                        "url"=>Router::url(array("controller"=>"Holidays")),
                        "bgcolor"=>"holiday"
                    ),
					"manage_events"=>array(
                        "name"=>"4",
                        "icon"=>'<i class="fa icon-calendar"></i>',
                        "url"=>Router::url(array("controller"=>"Events")),
                        "bgcolor"=>"events"
                    ),
					"manage_imports"=>array(
                        "name"=>"5",
                        "icon"=>'<i class="fa icon-calendar"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"import")),
                        "bgcolor"=>"imports"
                    ),
					"mnanage_subject"=>array(
                        "name"=>"6",
                        "icon"=>'<i class="fa icon-tag"></i>',
                        "url"=>Router::url(array("controller"=>"Subjects")),
                        "bgcolor"=>"subject"
                    ),
					"manage_transport"=>array(
                        "name"=>"7",
                        "icon"=>'<i class="fa icon-pointer"></i>',
                        "url"=>Router::url(array("controller"=>"Transports")),
                        "bgcolor"=>"transports"
                    ),
					"general_setting"=>array(
                        "name"=>"8",
                        "icon"=>'<i class="fa icon-pointer"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"general_setting")),
                        "bgcolor"=>"general_setting"
                    ),
					"admission_form"=>array(
                        "name"=>"9",
                        "icon"=>'<i class="fa icon-users"></i>',
                        "url"=>Router::url(array("controller"=>"AdmissionForms")),
                        "bgcolor"=>"admission_forms"
                    ),
                    "admission_section"=>array(
                        "name"=>"10",
                        "icon"=>'<i class="fa icon-info"></i>',
                        "url"=>Router::url(array("controller"=>"AppAdmission")),
                        "bgcolor"=>"admission_section"
                    ),
                );
                break;
            case ACCOUNT_ID:
                $user_menus = array(
				    "manage_fees"=>array(
                        "name"=>"3",
                        "icon"=>'<i class="fa icon-briefcase"></i>',
                        "url"=>Router::url(array("controller"=>"Fees")),
                        "bgcolor"=>"fee"
                    ),
					"fee_type"=>array(
                        "name"=>"4",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"FeeTypes")),
                        "bgcolor"=>"fee_type",
                    ),
					"payment_terms"=>array(
                        "name"=>"5",
                        "icon"=>'<i class="fa icon-direction"></i>',
                        "url"=>Router::url(array("controller"=>"PaymentTypes")),
                        "bgcolor"=>"payment_term"
                    ),
					"student_ledger"=>array(
                        "name"=>"6",
                        "icon"=>'<i class="fa icon-speedometer"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"student_ledger")),
                        "bgcolor"=>"student_ledger"
                    ),
					"profile"=>array(
                        "name"=>"1",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"profile")),
                        "bgcolor"=>"my_profile",
                    ),
					"security"=>array(
                        "name"=>"7",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"security",
                    ),
					"FRONT_OFFICE"=>array(
                        "name"=>"8",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"FRONT_OFFICE",
                    ),
					"teacher_section"=>array(
                        "name"=>"9",
                        "icon"=>'<i class="fa icon-users"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"teacher_section")),
                        "bgcolor"=>"teacher_section"
                    ),
					"supervisor"=>array(
                        "name"=>"10",
                        "icon"=>'<i class="fa icon-user-follow"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"superviser_section")),
                        "bgcolor"=>"supervisor_section"
                    ),
                    "studentsection"=>array(
                        "name"=>"11",
                        "icon"=>'<i class="fa icon-user-follow"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"student_section")),
                        "bgcolor"=>"student_section"
                    ),"hr_section"=>array(
                        "name"=>"12",
                        "icon"=>'<i class="fa icon-users"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"hr_section")),
                        "bgcolor"=>"hr_section"
                    ),
					"manage_lib"=>array(
                        "name"=>"13",
                        "icon"=>'<i class="fa icon-docs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"library_section")),
                        "bgcolor"=>"library"
                    ),
					  "transportation"=>array(
                        "name"=>"14",
                        "icon"=>'<i class="fa icon-pointer"></i>',
                        "url"=>Router::url(array("controller"=>"Transports","action"=>"graphic")),
                        "bgcolor"=>"transports"
                    ),
					"CANTEEN"=>array(
                        "name"=>"15",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"CANTEEN",
                    ),
					"HOSTEL"=>array(
                        "name"=>"16",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"HOSTEL",
                    ),
					"STORE_PURCHASE"=>array(
                        "name"=>"17",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"STORE_PURCHASE",
                    ),
					"UTILITY_HELP"=>array(
                        "name"=>"18",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"UTILITY_HELP",
                    ),
					"DOWNLOAD"=>array(
                        "name"=>"19",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"DOWNLOAD",
                    ),
					 "leave_application"=>array(
                        "name"=>"20",
                        "icon"=>'<i class="fa icon-envelope-letter"></i>',
                        "url"=>Router::url(array("controller"=>"leaveApplications")),
                        "bgcolor"=>"leave_application"
                    ),
                    "user_suggestion"=>array( 
                        "name"=>"21",
                        "icon"=>'<i class="fa icon-bubbles"></i>',
                        "url"=>Router::url(array("controller"=>"suggestions")),
                        "bgcolor"=>"user_suggestion"
                    ),
					"IDCARD"=>array(
                        "name"=>"2",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"IDCARD",
                    ),
					 "noticeboard"=>array(
                        "name"=>"23",
                        "icon"=>'<i class="fa icon-bell"></i>',
                        "url"=>Router::url(array("controller"=>"NoticeBoard")),
                        "bgcolor"=>"notice_board"
                    ),
                    "manage_events"=>array(
                        "name"=>"24",
                        "icon"=>'<i class="fa icon-calendar"></i>',
                        "url"=>Router::url(array("controller"=>"Events")),
                        "bgcolor"=>"events"
                    ),
					   "attendance"=>array(
                        "name"=>"25",
                        "icon"=>'<i class="fa icon-bar-chart"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"attendance"
                    ),
					"REMARKS"=>array(
                        "name"=>"26",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"REMARKS",
                    ),
					 "my_ebook"=>array(
                        "name"=>"27",
                        "icon"=>'<i class="fa icon-book-open"></i>',
                        "url"=>Router::url(array("controller"=>"EBook")),
                        "bgcolor"=>"ebook"
                    ),
					"GALLERY"=>array(
                        "name"=>"28",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"GALLERY",
                    ),
					"ACADEMIC_HISTORY"=>array(
                        "name"=>"29",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"ACADEMIC_HISTORY",
                    ),
					"MAILER"=>array(
                        "name"=>"30",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"MAILER",
                    ),
					"SMS"=>array(
                        "name"=>"31",
                        "icon"=>'<i class="fa icon-pointer"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"sms")),
                        "bgcolor"=>"SMS"
                    ),
					"TIK_TALK"=>array(
                        "name"=>"32",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"TIK_TALK",
                    ),
					"NEWS_UPDATE"=>array(
                        "name"=>"33",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"NEWS_UPDATE",
                    ),
                );
                break;
            case HR_ID:
                $user_menus = array(
                    "profile"=>array(
                        "name"=>"1",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"School","action"=>"profile")),
                        "bgcolor"=>"my_profile",
                    ),
					"IDCARD"=>array(
                        "name"=>"2",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"IDCARD",
                    ),
					"ACADEMIC_HISTORY"=>array(
                        "name"=>"5",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"ACADEMIC_HISTORY",
                    ),
					"NEWS_UPDATE"=>array(
                        "name"=>"7",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"NEWS_UPDATE",
                    ),
					"TIK_TALK"=>array(
                        "name"=>"8",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"TIK_TALK",
                    ),
					"MAILER"=>array(
                        "name"=>"13",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"MAILER",
                    ),
					"SMS"=>array(
                        "name"=>"24",
                        "icon"=>'<i class="fa icon-pointer"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"sms")),
                        "bgcolor"=>"SMS"
                    ),
                    "leave_application"=>array(
                        "name"=>"3",
                        "icon"=>'<i class="fa icon-envelope-letter"></i>',
                        "url"=>Router::url(array("controller"=>"leaveApplications")),
                        "bgcolor"=>"leave_application"
                    ),
                    "manage_events"=>array(
                        "name"=>"3",
                        "icon"=>'<i class="fa icon-calendar"></i>',
                        "url"=>Router::url(array("controller"=>"Events")),
                        "bgcolor"=>"events"
                    ),
                    "TeacherTimeTables"=>array(
                        "name"=>"4",
                        "icon"=>'<i class="fa icon-speedometer"></i>',
                        "url"=>Router::url(array("controller"=>"TeacherTimeTables")),
                        "bgcolor"=>"assign_time_table"
                    ),
                    "attendance"=>array(
                        "name"=>"5",
                        "icon"=>'<i class="fa icon-bar-chart"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"attendance_listing")),
                        "bgcolor"=>"attendance"
                    ),
                    "noticeboard"=>array(
                        "name"=>"6",
                        "icon"=>'<i class="fa icon-bell"></i>',
                        "url"=>Router::url(array("controller"=>"NoticeBoard")),
                        "bgcolor"=>"notice_board"
                    ),
					"user_suggestion"=>array(
                        "name"=>"7",
                        "icon"=>'<i class="fa icon-bubbles"></i>',
                        "url"=>Router::url(array("controller"=>"suggestions")),
                        "bgcolor"=>"user_suggestion"
                    ),
					"vacancy"=>array(
                        "name"=>"8",
                        "icon"=>'<i class="fa icon-speedometer"></i>',
                        "url"=>Router::url(array("controller"=>"Vacancy")),
                        "bgcolor"=>"vacancy"
                    ),
					"manage_imports"=>array(
                        "name"=>"9",
                        "icon"=>'<i class="fa icon-calendar"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"import")),
                        "bgcolor"=>"imports"
                    ),
					"security"=>array(
                        "name"=>"7",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"security",
                    ),
					"FRONT_OFFICE"=>array(
                        "name"=>"8",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"FRONT_OFFICE",
                    ),
					"teacher_section"=>array(
                        "name"=>"9",
                        "icon"=>'<i class="fa icon-users"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"teacher_section")),
                        "bgcolor"=>"teacher_section"
                    ),
					"supervisor"=>array(
                        "name"=>"10",
                        "icon"=>'<i class="fa icon-user-follow"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"superviser_section")),
                        "bgcolor"=>"supervisor_section"
                    ),
                   "manage_lib"=>array(
                        "name"=>"13",
                        "icon"=>'<i class="fa icon-docs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"library_section")),
                        "bgcolor"=>"library"
                    ),
					  "transportation"=>array(
                        "name"=>"14",
                        "icon"=>'<i class="fa icon-pointer"></i>',
                        "url"=>Router::url(array("controller"=>"Transports","action"=>"graphic")),
                        "bgcolor"=>"transports"
                    ),
					 "account_section"=>array(
                        "name"=>"14",
                        "icon"=>'<i class="fa icon-pointer"></i>',
                        "url"=>Router::url(array("controller"=>"Transports","action"=>"")),
                        "bgcolor"=>"account_section"
                    ),
					
					"CANTEEN"=>array(
                        "name"=>"15",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"CANTEEN",
                    ),
					"HOSTEL"=>array(
                        "name"=>"16",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"HOSTEL",
                    ),
					"STORE_PURCHASE"=>array(
                        "name"=>"17",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"STORE_PURCHASE",
                    ),
					"UTILITY_HELP"=>array(
                        "name"=>"18",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"UTILITY_HELP",
                    ),
					"DOWNLOAD"=>array(
                        "name"=>"19",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"DOWNLOAD",
                    ),
					"user_suggestion"=>array( 
                        "name"=>"21",
                        "icon"=>'<i class="fa icon-bubbles"></i>',
                        "url"=>Router::url(array("controller"=>"suggestions")),
                        "bgcolor"=>"user_suggestion"
                    ),
					 "noticeboard"=>array(
                        "name"=>"23",
                        "icon"=>'<i class="fa icon-bell"></i>',
                        "url"=>Router::url(array("controller"=>"NoticeBoard")),
                        "bgcolor"=>"notice_board"
                    ),
                    "manage_events"=>array(
                        "name"=>"24",
                        "icon"=>'<i class="fa icon-calendar"></i>',
                        "url"=>Router::url(array("controller"=>"Events")),
                        "bgcolor"=>"events"
                    ),
					"attendance"=>array(
                        "name"=>"25",
                        "icon"=>'<i class="fa icon-bar-chart"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"attendance"
                    ),
					 "my_ebook"=>array(
                        "name"=>"27",
                        "icon"=>'<i class="fa icon-book-open"></i>',
                        "url"=>Router::url(array("controller"=>"EBook")),
                        "bgcolor"=>"ebook"
                    ),
					"DAILY_DIARY"=>array(
                        "name"=>"9",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"DAILY_DIARY",
                    ),
					"REMARKS"=>array(
                        "name"=>"26",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"REMARKS",
                    ),
					"GALLERY"=>array(
                        "name"=>"4",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"GALLERY",
                    ),
                );
                break;
            case STUDENT_ID:
                $user_menus = array(
                    "my_profile"=>array(
                        "name"=>"1",
                        "icon"=>'<i class="fa icon-user-follow"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"profile")),
                        "bgcolor"=>"my_profile",
                    ),
					"IDCARD"=>array(
                        "name"=>"2",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"IDCARD",
                    ),
					"CANTEEN"=>array(
                        "name"=>"3",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"CANTEEN",
                    ),
					"HOSTEL"=>array(
                        "name"=>"4",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"HOSTEL",
                    ),
					"NEWS_UPDATE"=>array(
                        "name"=>"5",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"NEWS_UPDATE",
                    ),
					"user_suggestion"=>array(
                        "name"=>"6",
                        "icon"=>'<i class="fa icon-bubbles"></i>',
                        "url"=>Router::url(array("controller"=>"suggestions")),
                        "bgcolor"=>"user_suggestion"
                    ),
					"DOWNLOAD"=>array(
                        "name"=>"7",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"DOWNLOAD",
                    ),
					"REMARKS"=>array(
                        "name"=>"8",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"REMARKS",
                    ),
					"GALLERY"=>array(
                        "name"=>"9",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"GALLERY",
                    ),
					"ACADEMIC_HISTORY"=>array(
                        "name"=>"10",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"ACADEMIC_HISTORY",
                    ),
					"TIK_TALK"=>array(
                        "name"=>"11",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"TIK_TALK",
                    ),
                    "my_document"=>array(
                        "name"=>"12",
                        "icon"=>'<i class="fa icon-docs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"documents")),
                        "bgcolor"=>"my_document",
                    ),
                    "my_fees"=>array(
                        "name"=>"13",
                        "icon"=>'<i class="fa icon-briefcase"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"fees")),
                        "bgcolor"=>"fee"
                    ),
                    "my_classmates"=>array(
                        "name"=>"14",
                        "icon"=>'<i class="fa icon-users"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"students")),
                        "bgcolor"=>"classmates"
                    ),
                    "my_teachers"=>array(
                        "name"=>"15",
                        "icon"=>'<i class="fa icon-users"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"teachers")),
                        "bgcolor"=>"teacher_section"
                    ),
                    "my_attendance"=>array(
                        "name"=>"16",
                        "icon"=>'<i class="fa icon-bar-chart"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"attendance_listing")),
                        "bgcolor"=>"attendance"
                    ),
                    "my_timetable"=>array(
                        "name"=>"17",
                        "icon"=>'<i class="fa icon-speedometer"></i>',
                        "url"=>Router::url(array("controller"=>"TeacherTimeTables","action"=>"index")),
                        "bgcolor"=>"assign_time_table"
                    ),
                    "classwork"=>array(
                        "name"=>"18",
                        "icon"=>'<i class="fa icon-note"></i>',
                        "url"=>Router::url(array("controller"=>"Classwork")),
                        "bgcolor"=>"class_work"
                    ),
                    "my_homework"=>array(
                        "name"=>"19",
                        "icon"=>'<i class="fa icon-book-open"></i>',
                        "url"=>Router::url(array("controller"=>"Homeworks","action"=>"index")),
                        "bgcolor"=>"home_work"
                    ),
                    "my_circulars"=>array(
                        "name"=>"20",
                        "icon"=>'<i class="fa icon-bell"></i>',
                        "url"=>Router::url(array("controller"=>"NoticeBoard","action"=>"teachers")),
                        "bgcolor"=>"circular"
                    ),
                    "communication"=>array(
                        "name"=>"21",
                        "icon"=>'<i class="fa icon-bubbles"></i>',
                        "url"=>Router::url(array("controller"=>"suggestions")),
                        "bgcolor"=>"communication"
                    ),
                    "leave_application"=>array(
                        "name"=>"22",
                        "icon"=>'<i class="fa icon-envelope-letter"></i>',
                        "url"=>Router::url(array("controller"=>"leaveApplications")),
                        "bgcolor"=>"leave_application"
                    ),
                    "transportation"=>array(
                        "name"=>"23",
                        "icon"=>'<i class="fa icon-pointer"></i>',
                        "url"=>Router::url(array("controller"=>"Transports","action"=>"graphic")),
                        "bgcolor"=>"transports"
                    ),
					"manage_lib"=>array(
                        "name"=>"24",
                        "icon"=>'<i class="fa icon-docs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"library_section")),
                        "bgcolor"=>"library"
                    ),
					"supervisor"=>array(
                        "name"=>"25",
                        "icon"=>'<i class="fa icon-user-follow"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"superviser_section")),
                        "bgcolor"=>"supervisor_section"
                    ),
                    "my_ebook"=>array(
                        "name"=>"26",
                        "icon"=>'<i class="fa icon-book-open"></i>',
                        "url"=>Router::url(array("controller"=>"EBook")),
                        "bgcolor"=>"ebook"
                    ),
                    "manage_events"=>array(
                        "name"=>"27",
                        "icon"=>'<i class="fa icon-calendar"></i>',
                        "url"=>Router::url(array("controller"=>"Events")),
                        "bgcolor"=>"events"
                    ),
                    "my_gallery"=>array(
                        "name"=>"27",
                        "icon"=>'<i class="fa icon-picture"></i>',
                        "url"=>Router::url(array("controller"=>"Album","action"=>"index")),
                        "bgcolor"=>"album"
                    ),
                    "my_school_gallery"=>array(
                        "name"=>"28",
                        "icon"=>'<i class="fa icon-picture"></i>',
                        "url"=>Router::url(array("controller"=>"Album","action"=>"school")),
                        "bgcolor"=>"school_gallery"
                    ),
                    "examination"=>array(
                        "name"=>"29",
                        "icon"=>'<i class="fa icon-calendar"></i>',
                        "url"=>Router::url(array("controller"=>"Exams","action"=>"list")),
                        "bgcolor"=>"exam_schedule"
                    ),
                    "examination_result"=>array(
                        "name"=>"30",
                        "icon"=>'<i class="fa icon-trophy"></i>',
                        "url"=>Router::url(array("controller"=>"Results")),
                        "bgcolor"=>"exam_result"
                    ),
                );
                break;
			 case LIBRARY_ID:
			  $user_menus = array(
			 	"profile"=>array(
                        "name"=>"1",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Library","action"=>"")),
                        "bgcolor"=>"my_profile",
                    ),
					"IDCARD"=>array(
                        "name"=>"2",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"IDCARD",
                    ),
					 "noticeboard"=>array(
                        "name"=>"14",
                        "icon"=>'<i class="fa icon-bell"></i>',
                        "url"=>Router::url(array("controller"=>"NoticeBoard")),
                        "bgcolor"=>"notice_board"
                    ),
					 "attendance"=>array(
                        "name"=>"21",
                        "icon"=>'<i class="fa icon-bar-chart"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"attendance_listing")),
                        "bgcolor"=>"attendance"
                    ),
					"security"=>array(
                        "name"=>"2",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"security",
                    ),
					"FRONT_OFFICE"=>array(
                        "name"=>"3",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"FRONT_OFFICE",
                    ),
					"DAILY_DIARY"=>array(
                        "name"=>"9",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"DAILY_DIARY",
                    ),
						"DOWNLOAD"=>array(
                        "name"=>"9",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"DOWNLOAD",
                    ),
					"REMARKS"=>array(
                        "name"=>"3",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"REMARKS",
                    ),
					"my_ebook"=>array(
                        "name"=>"13",
                        "icon"=>'<i class="fa icon-book-open"></i>',
                        "url"=>Router::url(array("controller"=>"EBook")),
                        "bgcolor"=>"ebook"
                    ),
					"GALLERY"=>array(
                        "name"=>"4",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"GALLERY",
                    ),
					 "leave_application"=>array(
                        "name"=>"18",
                        "icon"=>'<i class="fa icon-envelope-letter"></i>',
                        "url"=>Router::url(array("controller"=>"leaveApplications")),
                        "bgcolor"=>"leave_application"
                    ),
					"manage_events"=>array(
                        "name"=>"4",
                        "icon"=>'<i class="fa icon-calendar"></i>',
                        "url"=>Router::url(array("controller"=>"Events")),
                        "bgcolor"=>"events"
                    ),
					"ACADEMIC_HISTORY"=>array(
                        "name"=>"5",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"ACADEMIC_HISTORY",
                    ),
					"SMS"=>array(
                        "name"=>"31",
                        "icon"=>'<i class="fa icon-pointer"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"sms")),
                        "bgcolor"=>"SMS"
                    ),
					"MAILER"=>array(
                        "name"=>"6",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"MAILER",
                    ),
					"TIK_TALK"=>array(
                        "name"=>"32",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"TIK_TALK",
                    ),
					"NEWS_UPDATE"=>array(
                        "name"=>"33",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"NEWS_UPDATE",
                    ),
					"teacher_section"=>array(
                        "name"=>"18",
                        "icon"=>'<i class="fa icon-users"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"teacher_section")),
                        "bgcolor"=>"teacher_section"
                    ),
					"supervisor"=>array(
                        "name"=>"21",
                        "icon"=>'<i class="fa icon-user-follow"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"superviser_section")),
                        "bgcolor"=>"supervisor_section"
                    ),
                    "studentsection"=>array(
                        "name"=>"22",
                        "icon"=>'<i class="fa icon-user-follow"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"student_section")),
                        "bgcolor"=>"student_section"
                    ),
					"hr_section"=>array(
                        "name"=>"17",
                        "icon"=>'<i class="fa icon-users"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"hr_section")),
                        "bgcolor"=>"hr_section"
                    ),
					"account_section"=>array(
                        "name"=>"19",
                        "icon"=>'<i class="fa icon-users"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"account_section")),
                        "bgcolor"=>"account_section"
                    ),
					"transports"=>array(
                        "name"=>"4",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"transports",
                    ),
					"CANTEEN"=>array(
                        "name"=>"6",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"CANTEEN",
                    ),
					"HOSTEL"=>array(
                        "name"=>"7",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"HOSTEL",
                    ),
					"STORE_PURCHASE"=>array(
                        "name"=>"8",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"STORE_PURCHASE",
                    ),
					"UTILITY_HELP"=>array(
                        "name"=>"9",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"UTILITY_HELP",
                    ),
					  "user_suggestion"=>array( 
                        "name"=>"19",
                        "icon"=>'<i class="fa icon-bubbles"></i>',
                        "url"=>Router::url(array("controller"=>"suggestions")),
                        "bgcolor"=>"user_suggestion"
                    ),
					"manage_lib"=>array(
                        "name"=>"3",
                        "icon"=>'<i class="fa icon-docs"></i>',
                        "url"=>Router::url(array("controller"=>"Library")),
                        "bgcolor"=>"library"
                    ),
					"book_master"=>array(
                        "name"=>"4",
                        "icon"=>'<i class="fa icon-docs"></i>',
                        "url"=>Router::url(array("controller"=>"Books")),
                        "bgcolor"=>"book_master"
                    ),
					"back_dashboard"=>array(
                        "name"=>"3",
                        "icon"=>'<i class="fa icon-trophy"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"dashboard")),
                        "bgcolor"=>"back_dashboard"
                    )
                );	 
			   break;
			    case TRANSPORTATION_ID:
			  $user_menus = array(
				 	"profile"=>array(
                        "name"=>"1",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Library","action"=>"")),
                        "bgcolor"=>"my_profile",
                    ),	  
					"FRONT_OFFICE"=>array(
                        "name"=>"3",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"FRONT_OFFICE",
                    ),
					"teacher_section"=>array(
                        "name"=>"18",
                        "icon"=>'<i class="fa icon-users"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"teacher_section")),
                        "bgcolor"=>"teacher_section"
                    ),
					"supervisor"=>array(
                        "name"=>"21",
                        "icon"=>'<i class="fa icon-user-follow"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"superviser_section")),
                        "bgcolor"=>"supervisor_section"
                    ),
					 "studentsection"=>array(
                        "name"=>"22",
                        "icon"=>'<i class="fa icon-user-follow"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"student_section")),
                        "bgcolor"=>"student_section"
                    ),
					"hr_section"=>array(
                        "name"=>"17",
                        "icon"=>'<i class="fa icon-users"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"hr_section")),
                        "bgcolor"=>"hr_section"
                    ),
					"manage_lib"=>array(
                        "name"=>"20",
                        "icon"=>'<i class="fa icon-docs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"library_section")),
                        "bgcolor"=>"library"
                    ),
					"account_section"=>array(
                        "name"=>"19",
                        "icon"=>'<i class="fa icon-users"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"account_section")),
                        "bgcolor"=>"account_section"
                    ),"STORE_PURCHASE"=>array(
                        "name"=>"17",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"STORE_PURCHASE",
                    ),
					"UTILITY_HELP"=>array(
                        "name"=>"18",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"UTILITY_HELP",
                    ),
					  "user_suggestion"=>array( 
                        "name"=>"21",
                        "icon"=>'<i class="fa icon-bubbles"></i>',
                        "url"=>Router::url(array("controller"=>"suggestions")),
                        "bgcolor"=>"user_suggestion"
                    ),
					 "driver_profile"=>array( 
                        "name"=>"21",
                        "icon"=>'<i class="fa icon-bubbles"></i>',
                        "url"=>Router::url(array("controller"=>"suggestions")),
                        "bgcolor"=>"driver_profile"
                    ),
					 "vehicle_profile"=>array( 
                        "name"=>"21",
                        "icon"=>'<i class="fa icon-bubbles"></i>',
                        "url"=>Router::url(array("controller"=>"suggestions")),
                        "bgcolor"=>"vehicle_profile"
                    ),
					"IDCARD"=>array(
                        "name"=>"2",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"IDCARD",
                    ),
					 "noticeboard"=>array(
                        "name"=>"23",
                        "icon"=>'<i class="fa icon-bell"></i>',
                        "url"=>Router::url(array("controller"=>"NoticeBoard")),
                        "bgcolor"=>"notice_board"
                    ),
					 "manage_events"=>array(
                        "name"=>"24",
                        "icon"=>'<i class="fa icon-calendar"></i>',
                        "url"=>Router::url(array("controller"=>"Events")),
                        "bgcolor"=>"events"
                    ),
					   "attendance"=>array(
                        "name"=>"25",
                        "icon"=>'<i class="fa icon-bar-chart"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"attendance"
                    ),
					"REMARKS"=>array(
                        "name"=>"26",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"REMARKS",
                    ),
					 "my_ebook"=>array(
                        "name"=>"27",
                        "icon"=>'<i class="fa icon-book-open"></i>',
                        "url"=>Router::url(array("controller"=>"EBook")),
                        "bgcolor"=>"ebook"
                    ),
					"DOWNLOAD"=>array(
                        "name"=>"19",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"DOWNLOAD",
                    ),
					"GALLERY"=>array(
                        "name"=>"4",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"GALLERY",
                    ),
					"ACADEMIC_HISTORY"=>array(
                        "name"=>"5",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"ACADEMIC_HISTORY",
                    ),
					"MAILER"=>array(
                        "name"=>"6",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"MAILER",
                    ),
					 "leave_application"=>array(
                        "name"=>"18",
                        "icon"=>'<i class="fa icon-envelope-letter"></i>',
                        "url"=>Router::url(array("controller"=>"leaveApplications")),
                        "bgcolor"=>"leave_application"
                    ),
					"SMS"=>array(
                        "name"=>"31",
                        "icon"=>'<i class="fa icon-pointer"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"sms")),
                        "bgcolor"=>"SMS"
                    ),
					"TIK_TALK"=>array(
                        "name"=>"32",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"TIK_TALK",
                    ),
					"NEWS_UPDATE"=>array(
                        "name"=>"33",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"NEWS_UPDATE",
                    ),
		
	        	);
				break;
				 case STORE_ID:
			  $user_menus = array(
			  "profile"=>array(
                        "name"=>"1",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Library","action"=>"")),
                        "bgcolor"=>"my_profile",
                    ),	  
					"IDCARD"=>array(
                        "name"=>"2",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"IDCARD",
                    ),
					"security"=>array(
                        "name"=>"2",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"security",
                    ),
					"FRONT_OFFICE"=>array(
                        "name"=>"3",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"FRONT_OFFICE",
                    ),
					"teacher_section"=>array(
                        "name"=>"18",
                        "icon"=>'<i class="fa icon-users"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"teacher_section")),
                        "bgcolor"=>"teacher_section"
                    ),
					 "studentsection"=>array(
                        "name"=>"22",
                        "icon"=>'<i class="fa icon-user-follow"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"student_section")),
                        "bgcolor"=>"student_section"
                    ),
					"supervisor"=>array(
                        "name"=>"21",
                        "icon"=>'<i class="fa icon-user-follow"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"superviser_section")),
                        "bgcolor"=>"supervisor_section"
                    ),
					"hr_section"=>array(
                        "name"=>"17",
                        "icon"=>'<i class="fa icon-users"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"hr_section")),
                        "bgcolor"=>"hr_section"
                    ),
					"manage_lib"=>array(
                        "name"=>"20",
                        "icon"=>'<i class="fa icon-docs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"library_section")),
                        "bgcolor"=>"library"
                    ),
					"transports"=>array(
                        "name"=>"4",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"transports",
                    ),
					"account_section"=>array(
                        "name"=>"19",
                        "icon"=>'<i class="fa icon-users"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"account_section")),
                        "bgcolor"=>"account_section"
                    ),
					"CANTEEN"=>array(
                        "name"=>"6",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"CANTEEN",
                    ),
					"HOSTEL"=>array(
                        "name"=>"7",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"HOSTEL",
                    ),
					"UTILITY_HELP"=>array(
                        "name"=>"18",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"UTILITY_HELP",
                    ),
					  "user_suggestion"=>array( 
                        "name"=>"21",
                        "icon"=>'<i class="fa icon-bubbles"></i>',
                        "url"=>Router::url(array("controller"=>"suggestions")),
                        "bgcolor"=>"user_suggestion"
                    ),
					"noticeboard"=>array(
                        "name"=>"23",
                        "icon"=>'<i class="fa icon-bell"></i>',
                        "url"=>Router::url(array("controller"=>"NoticeBoard")),
                        "bgcolor"=>"notice_board"
                    ),
					"attendance"=>array(
                        "name"=>"25",
                        "icon"=>'<i class="fa icon-bar-chart"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"attendance"
                    ),
					"REMARKS"=>array(
                        "name"=>"26",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"REMARKS",
                    ),
					 "my_ebook"=>array(
                        "name"=>"27",
                        "icon"=>'<i class="fa icon-book-open"></i>',
                        "url"=>Router::url(array("controller"=>"EBook")),
                        "bgcolor"=>"ebook"
                    ),
					"GALLERY"=>array(
                        "name"=>"28",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"GALLERY",
                    ),
					"DOWNLOAD"=>array(
                        "name"=>"19",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"DOWNLOAD",
                    ),
					 "manage_events"=>array(
                        "name"=>"2",
                        "icon"=>'<i class="fa icon-calendar"></i>',
                        "url"=>Router::url(array("controller"=>"Events")),
                        "bgcolor"=>"events"
                    ),
					"ACADEMIC_HISTORY"=>array(
                        "name"=>"29",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"ACADEMIC_HISTORY",
                    ),
					 "leave_application"=>array(
                        "name"=>"20",
                        "icon"=>'<i class="fa icon-envelope-letter"></i>',
                        "url"=>Router::url(array("controller"=>"leaveApplications")),
                        "bgcolor"=>"leave_application"
                    ),
					"MAILER"=>array(
                        "name"=>"30",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"MAILER",
                    ),
					"SMS"=>array(
                        "name"=>"31",
                        "icon"=>'<i class="fa icon-pointer"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"sms")),
                        "bgcolor"=>"SMS"
                    ),
					"TIK_TALK"=>array(
                        "name"=>"32",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"TIK_TALK",
                    ),
					"NEWS_UPDATE"=>array(
                        "name"=>"33",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"NEWS_UPDATE",
                    ),
			  );
			break;
			case HOSTEL_ID:
                $user_menus = array(
				  "profile"=>array(
                        "name"=>"1",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"School","action"=>"profile")),
                        "bgcolor"=>"my_profile",
                    ),
					"IDCARD"=>array(
                        "name"=>"2",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"IDCARD",
                    ),
					"security"=>array(
                        "name"=>"7",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"security",
                    ),
					"FRONT_OFFICE"=>array(
                        "name"=>"8",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"FRONT_OFFICE",
                    ),
					"teacher_section"=>array(
                        "name"=>"18",
                        "icon"=>'<i class="fa icon-users"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"teacher_section")),
                        "bgcolor"=>"teacher_section"
                    ),
					 "studentsection"=>array(
                        "name"=>"22",
                        "icon"=>'<i class="fa icon-user-follow"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"student_section")),
                        "bgcolor"=>"student_section"
                    ),
					"supervisor"=>array(
                        "name"=>"21",
                        "icon"=>'<i class="fa icon-user-follow"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"superviser_section")),
                        "bgcolor"=>"supervisor_section"
                    ),
					"hr_section"=>array(
                        "name"=>"17",
                        "icon"=>'<i class="fa icon-users"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"hr_section")),
                        "bgcolor"=>"hr_section"
                    ),
					"manage_lib"=>array(
                        "name"=>"20",
                        "icon"=>'<i class="fa icon-docs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"library_section")),
                        "bgcolor"=>"library"
                    ),
					"transports"=>array(
                        "name"=>"4",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"transports",
                    ),
					"account_section"=>array(
                        "name"=>"19",
                        "icon"=>'<i class="fa icon-users"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"account_section")),
                        "bgcolor"=>"account_section"
                    ),
					"CANTEEN"=>array(
                        "name"=>"6",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"CANTEEN",
                    ),
					"HOSTEL"=>array(
                        "name"=>"7",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"HOSTEL",
                    ),
					"UTILITY_HELP"=>array(
                        "name"=>"18",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"UTILITY_HELP",
                    ),
					  "user_suggestion"=>array( 
                        "name"=>"21",
                        "icon"=>'<i class="fa icon-bubbles"></i>',
                        "url"=>Router::url(array("controller"=>"suggestions")),
                        "bgcolor"=>"user_suggestion"
                    ),
					"noticeboard"=>array(
                        "name"=>"23",
                        "icon"=>'<i class="fa icon-bell"></i>',
                        "url"=>Router::url(array("controller"=>"NoticeBoard")),
                        "bgcolor"=>"notice_board"
                    ),
					"attendance"=>array(
                        "name"=>"25",
                        "icon"=>'<i class="fa icon-bar-chart"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"attendance"
                    ),
					"REMARKS"=>array(
                        "name"=>"26",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"REMARKS",
                    ),
					 "my_ebook"=>array(
                        "name"=>"27",
                        "icon"=>'<i class="fa icon-book-open"></i>',
                        "url"=>Router::url(array("controller"=>"EBook")),
                        "bgcolor"=>"ebook"
                    ),
					"GALLERY"=>array(
                        "name"=>"28",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"GALLERY",
                    ),
					"DOWNLOAD"=>array(
                        "name"=>"19",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"DOWNLOAD",
                    ),
					"STORE_PURCHASE"=>array(
                        "name"=>"8",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"STORE_PURCHASE",
                    ),
					"manage_events"=>array(
                        "name"=>"2",
                        "icon"=>'<i class="fa icon-calendar"></i>',
                        "url"=>Router::url(array("controller"=>"Events")),
                        "bgcolor"=>"events"
                    ),
					"ACADEMIC_HISTORY"=>array(
                        "name"=>"29",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"ACADEMIC_HISTORY",
                    ),
					 "leave_application"=>array(
                        "name"=>"20",
                        "icon"=>'<i class="fa icon-envelope-letter"></i>',
                        "url"=>Router::url(array("controller"=>"leaveApplications")),
                        "bgcolor"=>"leave_application"
                    ),
					"MAILER"=>array(
                        "name"=>"30",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"MAILER",
                    ),
					"SMS"=>array(
                        "name"=>"31",
                        "icon"=>'<i class="fa icon-pointer"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"sms")),
                        "bgcolor"=>"SMS"
                    ),
					"TIK_TALK"=>array(
                        "name"=>"32",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"TIK_TALK",
                    ),
					"NEWS_UPDATE"=>array(
                        "name"=>"33",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"NEWS_UPDATE",
                    ),
				);
		    break;
				case CANTEEN_ID:
                $user_menus = array(
				 "profile"=>array(
                        "name"=>"1",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Library","action"=>"")),
                        "bgcolor"=>"my_profile",
                    ),	  
					"IDCARD"=>array(
                        "name"=>"2",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"IDCARD",
                    ),
					"security"=>array(
                        "name"=>"2",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"security",
                    ),
					"FRONT_OFFICE"=>array(
                        "name"=>"3",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"FRONT_OFFICE",
                    ),
					 "studentsection"=>array(
                        "name"=>"22",
                        "icon"=>'<i class="fa icon-user-follow"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"student_section")),
                        "bgcolor"=>"student_section"
                    ),
					"supervisor"=>array(
                        "name"=>"21",
                        "icon"=>'<i class="fa icon-user-follow"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"superviser_section")),
                        "bgcolor"=>"supervisor_section"
                    ),
					"hr_section"=>array(
                        "name"=>"17",
                        "icon"=>'<i class="fa icon-users"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"hr_section")),
                        "bgcolor"=>"hr_section"
                    ),
					"account_section"=>array(
                        "name"=>"19",
                        "icon"=>'<i class="fa icon-users"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"account_section")),
                        "bgcolor"=>"account_section"
                    ),"HOSTEL"=>array(
                        "name"=>"7",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"HOSTEL",
                    ),
					"UTILITY_HELP"=>array(
                        "name"=>"18",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"UTILITY_HELP",
                    ),
					"STORE_PURCHASE"=>array(
                        "name"=>"8",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"STORE_PURCHASE",
                    ),
					 "user_suggestion"=>array( 
                        "name"=>"21",
                        "icon"=>'<i class="fa icon-bubbles"></i>',
                        "url"=>Router::url(array("controller"=>"suggestions")),
                        "bgcolor"=>"user_suggestion"
                    ),
					"noticeboard"=>array(
                        "name"=>"23",
                        "icon"=>'<i class="fa icon-bell"></i>',
                        "url"=>Router::url(array("controller"=>"NoticeBoard")),
                        "bgcolor"=>"notice_board"
                    ),
					"attendance"=>array(
                        "name"=>"25",
                        "icon"=>'<i class="fa icon-bar-chart"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"attendance"
                    ),
					 "TeacherTimeTables"=>array(
                        "name"=>"3",
                        "icon"=>'<i class="fa icon-speedometer"></i>',
                        "url"=>Router::url(array("controller"=>"TeacherTimeTables")),
                        "bgcolor"=>"assign_time_table"
                    ),
					"REMARKS"=>array(
                        "name"=>"26",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"REMARKS",
                    ),
					 "my_ebook"=>array(
                        "name"=>"27",
                        "icon"=>'<i class="fa icon-book-open"></i>',
                        "url"=>Router::url(array("controller"=>"EBook")),
                        "bgcolor"=>"ebook"
                    ),
					"GALLERY"=>array(
                        "name"=>"28",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"GALLERY",
                    ),
					"DOWNLOAD"=>array(
                        "name"=>"19",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"DOWNLOAD",
                    ),
					 "manage_events"=>array(
                        "name"=>"2",
                        "icon"=>'<i class="fa icon-calendar"></i>',
                        "url"=>Router::url(array("controller"=>"Events")),
                        "bgcolor"=>"events"
                    ),
					"ACADEMIC_HISTORY"=>array(
                        "name"=>"29",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"ACADEMIC_HISTORY",
                    ),
					 "leave_application"=>array(
                        "name"=>"20",
                        "icon"=>'<i class="fa icon-envelope-letter"></i>',
                        "url"=>Router::url(array("controller"=>"leaveApplications")),
                        "bgcolor"=>"leave_application"
                    ),
					"MAILER"=>array(
                        "name"=>"30",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"MAILER",
                    ),
					"SMS"=>array(
                        "name"=>"31",
                        "icon"=>'<i class="fa icon-pointer"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"sms")),
                        "bgcolor"=>"SMS"
                    ),
					"TIK_TALK"=>array(
                        "name"=>"32",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"TIK_TALK",
                    ),
					"NEWS_UPDATE"=>array(
                        "name"=>"33",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"NEWS_UPDATE",
                    ),
				);
			break;
			case FRONT_ID:
                $user_menus = array(
				"profile"=>array(
                        "name"=>"1",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Library","action"=>"")),
                        "bgcolor"=>"my_profile",
                    ),	  
					"IDCARD"=>array(
                        "name"=>"2",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"IDCARD",
                    ),
					"security"=>array(
                        "name"=>"2",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"security",
                    ),
					"FRONT_OFFICE"=>array(
                        "name"=>"3",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"FRONT_OFFICE",
                    ),
					"teacher_section"=>array(
                        "name"=>"18",
                        "icon"=>'<i class="fa icon-users"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"teacher_section")),
                        "bgcolor"=>"teacher_section"
                    ),
					 "studentsection"=>array(
                        "name"=>"22",
                        "icon"=>'<i class="fa icon-user-follow"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"student_section")),
                        "bgcolor"=>"student_section"
                    ),
					"supervisor"=>array(
                        "name"=>"21",
                        "icon"=>'<i class="fa icon-user-follow"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"superviser_section")),
                        "bgcolor"=>"supervisor_section"
                    ),
					"hr_section"=>array(
                        "name"=>"17",
                        "icon"=>'<i class="fa icon-users"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"hr_section")),
                        "bgcolor"=>"hr_section"
                    ),
					"manage_lib"=>array(
                        "name"=>"20",
                        "icon"=>'<i class="fa icon-docs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"library_section")),
                        "bgcolor"=>"library"
                    ),
					"transports"=>array(
                        "name"=>"4",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"transports",
                    ),
					"account_section"=>array(
                        "name"=>"19",
                        "icon"=>'<i class="fa icon-users"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"account_section")),
                        "bgcolor"=>"account_section"
                    ),
					 "examination_result"=>array(
                        "name"=>"18",
                        "icon"=>'<i class="fa icon-trophy"></i>',
                        "url"=>Router::url(array("controller"=>"Results")),
                        "bgcolor"=>"exam_result"
                    ),
					"CANTEEN"=>array(
                        "name"=>"6",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"CANTEEN",
                    ),
					"HOSTEL"=>array(
                        "name"=>"7",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"HOSTEL",
                    ),
					"UTILITY_HELP"=>array(
                        "name"=>"18",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"UTILITY_HELP",
                    ),
                    "STORE_PURCHASE"=>array(
                        "name"=>"8",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"STORE_PURCHASE",
                    ),

					  "user_suggestion"=>array( 
                        "name"=>"21",
                        "icon"=>'<i class="fa icon-bubbles"></i>',
                        "url"=>Router::url(array("controller"=>"suggestions")),
                        "bgcolor"=>"user_suggestion"
                    ),
					"noticeboard"=>array(
                        "name"=>"23",
                        "icon"=>'<i class="fa icon-bell"></i>',
                        "url"=>Router::url(array("controller"=>"NoticeBoard")),
                        "bgcolor"=>"notice_board"
                    ),
					"attendance"=>array(
                        "name"=>"25",
                        "icon"=>'<i class="fa icon-bar-chart"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"attendance"
                    ),
					"REMARKS"=>array(
                        "name"=>"26",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"REMARKS",
                    ),
					 "TeacherTimeTables"=>array(
                        "name"=>"3",
                        "icon"=>'<i class="fa icon-speedometer"></i>',
                        "url"=>Router::url(array("controller"=>"TeacherTimeTables")),
                        "bgcolor"=>"assign_time_table"
                    ),
					 "my_ebook"=>array(
                        "name"=>"27",
                        "icon"=>'<i class="fa icon-book-open"></i>',
                        "url"=>Router::url(array("controller"=>"EBook")),
                        "bgcolor"=>"ebook"
                    ),
					"GALLERY"=>array(
                        "name"=>"28",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"GALLERY",
                    ),
					"DOWNLOAD"=>array(
                        "name"=>"19",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"DOWNLOAD",
                    ),
					 "manage_events"=>array(
                        "name"=>"2",
                        "icon"=>'<i class="fa icon-calendar"></i>',
                        "url"=>Router::url(array("controller"=>"Events")),
                        "bgcolor"=>"events"
                    ),
					"ACADEMIC_HISTORY"=>array(
                        "name"=>"29",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"ACADEMIC_HISTORY",
                    ),
					 "leave_application"=>array(
                        "name"=>"20",
                        "icon"=>'<i class="fa icon-envelope-letter"></i>',
                        "url"=>Router::url(array("controller"=>"leaveApplications")),
                        "bgcolor"=>"leave_application"
                    ),
					"MAILER"=>array(
                        "name"=>"30",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"MAILER",
                    ),
					"SMS"=>array(
                        "name"=>"31",
                        "icon"=>'<i class="fa icon-pointer"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"sms")),
                        "bgcolor"=>"SMS"
                    ),
					"TIK_TALK"=>array(
                        "name"=>"32",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"TIK_TALK",
                    ),
					"NEWS_UPDATE"=>array(
                        "name"=>"33",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"NEWS_UPDATE",
                    ),
				
				);
			break;
			case SECURITY_ID:
                $user_menus = array(
				"profile"=>array(
                        "name"=>"1",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Library","action"=>"")),
                        "bgcolor"=>"my_profile",
                    ),	  
					"IDCARD"=>array(
                        "name"=>"2",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"IDCARD",
                    ),
					"security"=>array(
                        "name"=>"2",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"security",
                    ),
					"FRONT_OFFICE"=>array(
                        "name"=>"3",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"FRONT_OFFICE",
                    ),
					"teacher_section"=>array(
                        "name"=>"18",
                        "icon"=>'<i class="fa icon-users"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"teacher_section")),
                        "bgcolor"=>"teacher_section"
                    ),
					 "studentsection"=>array(
                        "name"=>"22",
                        "icon"=>'<i class="fa icon-user-follow"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"student_section")),
                        "bgcolor"=>"student_section"
                    ),
					"supervisor"=>array(
                        "name"=>"21",
                        "icon"=>'<i class="fa icon-user-follow"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"superviser_section")),
                        "bgcolor"=>"supervisor_section"
                    ),
					"hr_section"=>array(
                        "name"=>"17",
                        "icon"=>'<i class="fa icon-users"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"hr_section")),
                        "bgcolor"=>"hr_section"
                    ),
					"manage_lib"=>array(
                        "name"=>"20",
                        "icon"=>'<i class="fa icon-docs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"library_section")),
                        "bgcolor"=>"library"
                    ),
					"transports"=>array(
                        "name"=>"4",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"transports",
                    ),
					"account_section"=>array(
                        "name"=>"19",
                        "icon"=>'<i class="fa icon-users"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"account_section")),
                        "bgcolor"=>"account_section"
                    ),
					"CANTEEN"=>array(
                        "name"=>"6",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"CANTEEN",
                    ),
					"HOSTEL"=>array(
                        "name"=>"7",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"HOSTEL",
                    ),
					"UTILITY_HELP"=>array(
                        "name"=>"18",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"UTILITY_HELP",
                    ),
                    "STORE_PURCHASE"=>array(
                        "name"=>"8",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"STORE_PURCHASE",
                    ),

					  "user_suggestion"=>array( 
                        "name"=>"21",
                        "icon"=>'<i class="fa icon-bubbles"></i>',
                        "url"=>Router::url(array("controller"=>"suggestions")),
                        "bgcolor"=>"user_suggestion"
                    ),
					"noticeboard"=>array(
                        "name"=>"23",
                        "icon"=>'<i class="fa icon-bell"></i>',
                        "url"=>Router::url(array("controller"=>"NoticeBoard")),
                        "bgcolor"=>"notice_board"
                    ),
					"attendance"=>array(
                        "name"=>"25",
                        "icon"=>'<i class="fa icon-bar-chart"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"attendance"
                    ),
					"REMARKS"=>array(
                        "name"=>"26",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"REMARKS",
                    ),
					 "TeacherTimeTables"=>array(
                        "name"=>"3",
                        "icon"=>'<i class="fa icon-speedometer"></i>',
                        "url"=>Router::url(array("controller"=>"TeacherTimeTables")),
                        "bgcolor"=>"assign_time_table"
                    ),
					"GALLERY"=>array(
                        "name"=>"28",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"GALLERY",
                    ),
					"DOWNLOAD"=>array(
                        "name"=>"19",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"DOWNLOAD",
                    ),
					 "manage_events"=>array(
                        "name"=>"2",
                        "icon"=>'<i class="fa icon-calendar"></i>',
                        "url"=>Router::url(array("controller"=>"Events")),
                        "bgcolor"=>"events"
                    ),
					"ACADEMIC_HISTORY"=>array(
                        "name"=>"29",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"ACADEMIC_HISTORY",
                    ),
					 "leave_application"=>array(
                        "name"=>"20",
                        "icon"=>'<i class="fa icon-envelope-letter"></i>',
                        "url"=>Router::url(array("controller"=>"leaveApplications")),
                        "bgcolor"=>"leave_application"
                    ),
					"MAILER"=>array(
                        "name"=>"30",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"MAILER",
                    ),
					"SMS"=>array(
                        "name"=>"31",
                        "icon"=>'<i class="fa icon-pointer"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"sms")),
                        "bgcolor"=>"SMS"
                    ),
					"TIK_TALK"=>array(
                        "name"=>"32",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"TIK_TALK",
                    ),
					"NEWS_UPDATE"=>array(
                        "name"=>"33",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"NEWS_UPDATE",
                    ),
				);
			break;
			
        }

                    // for profile
        $user_info = $this->User->find('first',array(
            'conditions'=>array(
                'User.ID'=>$Session_data['ID']
            )
        ));
        $this->set('user_info',$user_info);

        // end of profile

        // for circular
        $this->NoticeBoardXref =  ClassRegistry::init('NoticeBoardXref');
        $notice_board = $this->NoticeBoardXref->find('all',array(
            'contain'=>array("UserFrom","NoticeBoard"),
            'conditions'=>array(
                'TO_ID'=>$Session_data['ID'],
            ),
            'order'=>'NoticeBoardXref.ID desc',
            'limit'=> 4
        ));
        $this->set('notice_board',$notice_board);


        $this->set('user_menus',$user_menus);

        // for homework
        $this->Homework =  ClassRegistry::init('Homework');
        $conditions = array();
        $contain = array();
        switch($Session_data["ROLE_ID"]) {
            case TEACHER_ID:
                $conditions = array(
                    'Homework.CLASS_ID' => $Session_data['CLASS_ID'],
                );

                break;
            case STUDENT_ID:
                $conditions = array(
                    'Homework.CLASS_ID' => $Session_data['CLASS_ID'],
                );
                $start_date = date("Y-m-01");
                $end_date = date("Y-m-t");
                $class_id = $Session_data["CLASS_ID"];
                $this->Attendance = ClassRegistry::init('Attendance');
                // present students
                $lists = array();
                $lists =  $this->Attendance->find('all',array(
                    'contain'=>array('User'),
                    'conditions'=>array(
                        'Attendance.ATTENDANCE_DATE between ? and ?' => array($start_date, $end_date),
                        'User.CLASS_ID'=>$class_id,
                        'User.STATUS'=>1,
                        'Attendance.ID'=>$Session_data['ID'],
                        'Attendance.AVAILABILITY'=>'P'

                    ),
                ));
                $presents = array();
                foreach($lists as $list) {
                    if(isset($list["Attendance"]["ATTENDANCE_DATE"])) {
                        if(!in_array($presents,array($list["Attendance"]["ATTENDANCE_DATE"]))) {
                            $presents[$this->General->dateforkey($list["Attendance"]["ATTENDANCE_DATE"])][] = $list["User"]["ID"];
                        }
                    }
                }

                // absent student
                $absentlists = array();
                $absentlists =  $this->Attendance->find('all',array(
                    'contain'=>array('User'),
                    'conditions'=>array(
                        'Attendance.ATTENDANCE_DATE between ? and ?' => array($start_date, $end_date),
                        'User.CLASS_ID'=>$class_id,
                        'User.STATUS'=>1,
                        'Attendance.ID'=>$Session_data['ID'],
                        'Attendance.AVAILABILITY'=>'A'
                    ),
                ));

                $absents = array();
                foreach($absentlists as $absentlist) {
                    if(isset($absentlist["Attendance"]["ATTENDANCE_DATE"])) {
                        if(!in_array($absents,array($absentlist["Attendance"]["ATTENDANCE_DATE"]))) {
                            $absents[$this->General->dateforkey($absentlist["Attendance"]["ATTENDANCE_DATE"])][] = $absentlist["User"]["ID"];
                        }
                    }
                }

                $totalPresent = 0;
                $totalAbsents = 0;

                if(is_array($presents) && sizeof($presents)) {
                    foreach($presents as $pk=>$pp) {

                        $totalPresent = $totalPresent + count($pp);
                    }
                }
                if(is_array($absents) && sizeof($absents)) {
                    foreach($absents as $ak=>$zz) {
                        $totalAbsents = $totalAbsents + count($zz);
                    }
                }

                $this->set('TotalPresent',$totalPresent);
                $this->set('TotalAbsent',$totalAbsents);
                break;
        }


        $hw_list = $this->Homework->find('all',array(
            //'contain'=>array($contain),
            'conditions' => $conditions,
            'limit' => 5,
            'order' => 'Homework.HW_ID DESC'
        ));

        $this->set('hw_list',$hw_list);
    }
	public function admin_sms()
	{
		$this->layout = 'admin_dashboard';
        $Session_data = $this->Session->read('Auth.Admin');
        if (empty($Session_data)) {
            $this->redirect(array('action' => 'login'));
        }

        $this->School = ClassRegistry::init('School');
        $school = $this->School->find('first',array(
            'ID'=>1,
        ));
        if(sizeof($school)==0) {
            $this->redirect(array('action' => 'login'));
        }

        $this->set('profile',$school);
        $user_menus = array();

        switch($Session_data['ROLE_ID']) {
            case ADMIN_ID:
                $user_menus = array(
					"send_sms"=>array(
                        "name"=>"0",
                        "icon"=>'<i class="fa icon-users"></i>',
                        "url"=>Router::url(array("controller"=>"Survey","action"=>"")),
                        "bgcolor"=>"account_section_new"
                    ),
                 	"survey_data"=>array(
                        "name"=>"1",
                        "icon"=>'<i class="fa icon-briefcase"></i>',
                        "url"=>Router::url(array("controller"=>"Survey")),
                        "bgcolor"=>"fee"
                    ),
				);
                break;
        }

                    // for profile
        $user_info = $this->User->find('first',array(
            'conditions'=>array(
                'User.ID'=>$Session_data['ID']
            )
        ));
        $this->set('user_info',$user_info);

        // end of profile

        // for circular
        $this->NoticeBoardXref =  ClassRegistry::init('NoticeBoardXref');
        $notice_board = $this->NoticeBoardXref->find('all',array(
            'contain'=>array("UserFrom","NoticeBoard"),
            'conditions'=>array(
                'TO_ID'=>$Session_data['ID'],
            ),
            'order'=>'NoticeBoardXref.ID desc',
            'limit'=>4
        ));
        $this->set('notice_board',$notice_board);


        $this->set('user_menus',$user_menus);

     
        
        $this->set('hw_list',$hw_list);
    }
	
	public function add_survey_data(){
		
	  $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('post')) {
            $this->sms->set($this->request->data);
            
                $this->Book->create();
                if ($this->sms->save($this->request->data)) {
                    $this->Session->setFlash('Data Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
                } else {
             	   $this->Session->setFlash('Data Not Added Please Try Again!', 'message_bad');
                }
        
		
		$categories = $this->Book->Category->GetCategories();
		$this->set('categories',$categories);	
	}
	
	
    public function admin_general_setting()
    {
        $this->layout = 'admin_dashboard';
        $Session_data = $this->Session->read('Auth.Admin');
        if (empty($Session_data)) {
            $this->redirect(array('action' => 'login'));
        }

        $this->School = ClassRegistry::init('School');
        $school = $this->School->find('first',array(
            'ID'=>1,
        ));
        if(sizeof($school)==0) {
            $this->redirect(array('action' => 'login'));
        }

        $this->set('profile',$school);
        $user_menus = array();

        switch($Session_data['ROLE_ID']) {
            case ADMIN_ID:
                $user_menus = array(
                     "blood_group"=>array(
                        "name"=>"1",
                        "icon"=>'<i class="fa icon-chemistry"></i>',
                        "url"=>Router::url(array("controller"=>"BloodGroups")),
                        "bgcolor"=>"blood_group"
                    ),
					"manage_cast_category"=>array(
                        "name"=>"2",
                        "icon"=>'<i class="fa icon-badge"></i>',
                        "url"=>Router::url(array("controller"=>"CastCategories")),
                        "bgcolor"=>"cast_category"
                    ),
					"manage_category"=>array(
                        "name"=>"3",
                        "icon"=>'<i class="fa icon-badge"></i>',
                        "url"=>Router::url(array("controller"=>"Categories")),
                        "bgcolor"=>"category"
                    ),
					"manage_city"=>array(
                        "name"=>"4",
                        "icon"=>'<i class="fa icon-home"></i>',
                        "url"=>Router::url(array("controller"=>"City")),
                        "bgcolor"=>"city"
                    ),
					"medium_section"=>array(
                        "name"=>"5",
                        "icon"=>'<i class="fa icon-tag"></i>',
                        "url"=>Router::url(array("controller"=>"Medium")),
                        "bgcolor"=>"medium_section"
                    ),
					"manage_content"=>array(
                        "name"=>"6",
                        "icon"=>'<i class="fa icon-book-open"></i>',
                        "url"=>Router::url(array("controller"=>"PagesContent")),
                        "bgcolor"=>"page_content"
                    ),
					"manage_page_name"=>array(
                        "name"=>"7",
                        "icon"=>'<i class="fa icon-docs"></i>',
                        "url"=>Router::url(array("controller"=>"PageNames")),
                        "bgcolor"=>"page_name"
                    ),
					"role"=>array(
                        "name"=>"8",
                        "icon"=>'<i class="fa fa-user"></i>',
                        "url"=>Router::url(array("controller"=>"Roles")),
                        "bgcolor"=>"roles",
                    ),
					"school_edit"=>array(
                        "name"=>"9",
                        "icon"=>'<i class="fa icon-trophy"></i>',
                        "url"=>Router::url(array("controller"=>"School","action"=>"edit",1)),
                        "bgcolor"=>"school"
                    ),
					"back_dashboard"=>array(
                        "name"=>"10",
                        "icon"=>'<i class="fa icon-trophy"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"dashboard")),
                        "bgcolor"=>"back_dashboard"
                    )
                );
                break;
		case SUPERVISOR_ID:
                $user_menus = array(
                     "blood_group"=>array(
                        "name"=>"1",
                        "icon"=>'<i class="fa icon-chemistry"></i>',
                        "url"=>Router::url(array("controller"=>"BloodGroups")),
                        "bgcolor"=>"blood_group"
                    ),
					"manage_cast_category"=>array(
                        "name"=>"2",
                        "icon"=>'<i class="fa icon-badge"></i>',
                        "url"=>Router::url(array("controller"=>"CastCategories")),
                        "bgcolor"=>"cast_category"
                    ),
					"manage_category"=>array(
                        "name"=>"3",
                        "icon"=>'<i class="fa icon-badge"></i>',
                        "url"=>Router::url(array("controller"=>"Categories")),
                        "bgcolor"=>"category"
                    ),
					"manage_city"=>array(
                        "name"=>"4",
                        "icon"=>'<i class="fa icon-home"></i>',
                        "url"=>Router::url(array("controller"=>"City")),
                        "bgcolor"=>"city"
                    ),
					"medium_section"=>array(
                        "name"=>"5",
                        "icon"=>'<i class="fa icon-tag"></i>',
                        "url"=>Router::url(array("controller"=>"Medium")),
                        "bgcolor"=>"medium_section"
                    ),
					"manage_content"=>array(
                        "name"=>"6",
                        "icon"=>'<i class="fa icon-book-open"></i>',
                        "url"=>Router::url(array("controller"=>"PagesContent")),
                        "bgcolor"=>"page_content"
                    ),
					"manage_page_name"=>array(
                        "name"=>"7",
                        "icon"=>'<i class="fa icon-docs"></i>',
                        "url"=>Router::url(array("controller"=>"PageNames")),
                        "bgcolor"=>"page_name"
                    ),
					"role"=>array(
                        "name"=>"8",
                        "icon"=>'<i class="fa fa-user"></i>',
                        "url"=>Router::url(array("controller"=>"Roles")),
                        "bgcolor"=>"roles",
                    ),
					"school_edit"=>array(
                        "name"=>"9",
                        "icon"=>'<i class="fa icon-trophy"></i>',
                        "url"=>Router::url(array("controller"=>"School","action"=>"edit",1)),
                        "bgcolor"=>"school"
                    ),
					"back_dashboard"=>array(
                        "name"=>"10",
                        "icon"=>'<i class="fa icon-trophy"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"dashboard")),
                        "bgcolor"=>"back_dashboard"
                    )
                );
                break;
        }

                    // for profile
        $user_info = $this->User->find('first',array(
            'conditions'=>array(
                'User.ID'=>$Session_data['ID']
            )
        ));
        $this->set('user_info',$user_info);

        // end of profile

        // for circular
        $this->NoticeBoardXref =  ClassRegistry::init('NoticeBoardXref');
        $notice_board = $this->NoticeBoardXref->find('all',array(
            'contain'=>array("UserFrom","NoticeBoard"),
            'conditions'=>array(
                'TO_ID'=>$Session_data['ID'],
            ),
            'order'=>'NoticeBoardXref.ID desc',
            'limit'=>4
        ));
        $this->set('notice_board',$notice_board);


        $this->set('user_menus',$user_menus);

        // for homework
        $this->Homework =  ClassRegistry::init('Homework');
        $conditions = array();
        $contain = array();
        switch($Session_data["ROLE_ID"]) {
            case TEACHER_ID:
                $conditions = array(
                    'Homework.CLASS_ID' => $Session_data['CLASS_ID'],
                );

                break;
            case STUDENT_ID:
                $conditions = array(
                    'Homework.CLASS_ID' => $Session_data['CLASS_ID'],
                );
                $start_date = date("Y-m-01");
                $end_date = date("Y-m-t");
                $class_id = $Session_data["CLASS_ID"];
                $this->Attendance = ClassRegistry::init('Attendance');
                // present students
                $lists = array();
                $lists =  $this->Attendance->find('all',array(
                    'contain'=>array('User'),
                    'conditions'=>array(
                        'Attendance.ATTENDANCE_DATE between ? and ?' => array($start_date, $end_date),
                        'User.CLASS_ID'=>$class_id,
                        'User.STATUS'=>1,
                        'Attendance.ID'=>$Session_data['ID'],
                        'Attendance.AVAILABILITY'=>'P'

                    ),
                ));
                $presents = array();
                foreach($lists as $list) {
                    if(isset($list["Attendance"]["ATTENDANCE_DATE"])) {
                        if(!in_array($presents,array($list["Attendance"]["ATTENDANCE_DATE"]))) {
                            $presents[$this->General->dateforkey($list["Attendance"]["ATTENDANCE_DATE"])][] = $list["User"]["ID"];
                        }
                    }
                }

                // absent student
                $absentlists = array();
                $absentlists =  $this->Attendance->find('all',array(
                    'contain'=>array('User'),
                    'conditions'=>array(
                        'Attendance.ATTENDANCE_DATE between ? and ?' => array($start_date, $end_date),
                        'User.CLASS_ID'=>$class_id,
                        'User.STATUS'=>1,
                        'Attendance.ID'=>$Session_data['ID'],
                        'Attendance.AVAILABILITY'=>'A'
                    ),
                ));

                $absents = array();
                foreach($absentlists as $absentlist) {
                    if(isset($absentlist["Attendance"]["ATTENDANCE_DATE"])) {
                        if(!in_array($absents,array($absentlist["Attendance"]["ATTENDANCE_DATE"]))) {
                            $absents[$this->General->dateforkey($absentlist["Attendance"]["ATTENDANCE_DATE"])][] = $absentlist["User"]["ID"];
                        }
                    }
                }

                $totalPresent = 0;
                $totalAbsents = 0;

                if(is_array($presents) && sizeof($presents)) {
                    foreach($presents as $pk=>$pp) {

                        $totalPresent = $totalPresent + count($pp);
                    }
                }
                if(is_array($absents) && sizeof($absents)) {
                    foreach($absents as $ak=>$zz) {
                        $totalAbsents = $totalAbsents + count($zz);
                    }
                }

                $this->set('TotalPresent',$totalPresent);
                $this->set('TotalAbsent',$totalAbsents);
                break;
        }


        $hw_list = $this->Homework->find('all',array(
            //'contain'=>array($contain),
            'conditions' => $conditions,
            'limit' => 5,
            'order' => 'Homework.HW_ID DESC'
        ));

        $this->set('hw_list',$hw_list);
    }
	
	public function admin_guest()
    {
        $this->layout = 'admin_dashboard';
        $Session_data = $this->Session->read('Auth.Admin');
        if (empty($Session_data)) {
            $this->redirect(array('action' => 'login'));
        }

        $this->School = ClassRegistry::init('School');
        $school = $this->School->find('first',array(
            'ID'=>1,
        ));
        if(sizeof($school)==0) {
            $this->redirect(array('action' => 'login'));
        }

        $this->set('profile',$school);
        $user_menus = array();

        switch($Session_data['ROLE_ID']) {
            case ADMIN_ID:
                $user_menus = array(
                    "school_profile"=>array(
                        "name"=>"1",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"School","action"=>"view",1)),
                        "bgcolor"=>"school_profile",
                    ),
					"manage_content"=>array(
                        "name"=>"2",
                        "icon"=>'<i class="fa icon-book-open"></i>',
                        "url"=>Router::url(array("controller"=>"PagesContent")),
                        "bgcolor"=>"page_content"
                    ),
					"school_gallery"=>array(
                        "name"=>"3",
                        "icon"=>'<i class="fa icon-picture"></i>',
                        "url"=>Router::url(array("controller"=>"Album","action"=>"school")),
                        "bgcolor"=>"school_gallery"
                    ), 
					"admission_inquiry"=>array(
                        "name"=>"4",
                        "icon"=>'<i class="fa icon-info"></i>',
                        "url"=>Router::url(array("controller"=>"AppAdmission")),
                        "bgcolor"=>"admission_inquiry"
                    ),
					"manage_certification"=>array(
                        "name"=>"5",
                        "icon"=>'<i class="fa icon-graduation"></i>',
                        "url"=>Router::url(array("controller"=>"Album","action"=>"")),
                        "bgcolor"=>"certification"
                    ),
					"broucher"=>array(
                        "name"=>"6",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"School","action"=>"view",1)),
                        "bgcolor"=>"broucher",
                    ),
					"manage_achievements"=>array(
                        "name"=>"7",
                        "icon"=>'<i class="fa icon-trophy"></i>',
                        "url"=>Router::url(array("controller"=>"Achievements")),
                        "bgcolor"=>"achievements"
                    ),
					"manage_testimonials"=>array(
                        "name"=>"8",
                        "icon"=>'<i class="fa icon-speech"></i>',
                        "url"=>Router::url(array("controller"=>"Testimonials")),
                        "bgcolor"=>"testimonial"
                    ),
					"vacancy"=>array(
                        "name"=>"9",
                        "icon"=>'<i class="fa icon-speedometer"></i>',
                        "url"=>Router::url(array("controller"=>"Vacancy")),
                        "bgcolor"=>"vacancy"
                    ),
					"back_dashboard"=>array(
                        "name"=>"10",
                        "icon"=>'<i class="fa icon-trophy"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"dashboard")),
                        "bgcolor"=>"back_dashboard"
                    )
                );
                break;
        }

                    // for profile
        $user_info = $this->User->find('first',array(
            'conditions'=>array(
                'User.ID'=>$Session_data['ID']
            )
        ));
        $this->set('user_info',$user_info);

        // end of profile

        // for circular
        $this->NoticeBoardXref =  ClassRegistry::init('NoticeBoardXref');
        $notice_board = $this->NoticeBoardXref->find('all',array(
            'contain'=>array("UserFrom","NoticeBoard"),
            'conditions'=>array(
                'TO_ID'=>$Session_data['ID'],
            ),
            'order'=>'NoticeBoardXref.ID desc',
            'limit'=>4
        ));
        $this->set('notice_board',$notice_board);


        $this->set('user_menus',$user_menus);

        // for homework
        $this->Homework =  ClassRegistry::init('Homework');
        $conditions = array();
        $contain = array();
        switch($Session_data["ROLE_ID"]) {
            case TEACHER_ID:
                $conditions = array(
                    'Homework.CLASS_ID' => $Session_data['CLASS_ID'],
                );

                break;
            case STUDENT_ID:
                $conditions = array(
                    'Homework.CLASS_ID' => $Session_data['CLASS_ID'],
                );
                $start_date = date("Y-m-01");
                $end_date = date("Y-m-t");
                $class_id = $Session_data["CLASS_ID"];
                $this->Attendance = ClassRegistry::init('Attendance');
                // present students
                $lists = array();
                $lists =  $this->Attendance->find('all',array(
                    'contain'=>array('User'),
                    'conditions'=>array(
                        'Attendance.ATTENDANCE_DATE between ? and ?' => array($start_date, $end_date),
                        'User.CLASS_ID'=>$class_id,
                        'User.STATUS'=>1,
                        'Attendance.ID'=>$Session_data['ID'],
                        'Attendance.AVAILABILITY'=>'P'

                    ),
                ));
                $presents = array();
                foreach($lists as $list) {
                    if(isset($list["Attendance"]["ATTENDANCE_DATE"])) {
                        if(!in_array($presents,array($list["Attendance"]["ATTENDANCE_DATE"]))) {
                            $presents[$this->General->dateforkey($list["Attendance"]["ATTENDANCE_DATE"])][] = $list["User"]["ID"];
                        }
                    }
                }

                // absent student
                $absentlists = array();
                $absentlists =  $this->Attendance->find('all',array(
                    'contain'=>array('User'),
                    'conditions'=>array(
                        'Attendance.ATTENDANCE_DATE between ? and ?' => array($start_date, $end_date),
                        'User.CLASS_ID'=>$class_id,
                        'User.STATUS'=>1,
                        'Attendance.ID'=>$Session_data['ID'],
                        'Attendance.AVAILABILITY'=>'A'
                    ),
                ));

                $absents = array();
                foreach($absentlists as $absentlist) {
                    if(isset($absentlist["Attendance"]["ATTENDANCE_DATE"])) {
                        if(!in_array($absents,array($absentlist["Attendance"]["ATTENDANCE_DATE"]))) {
                            $absents[$this->General->dateforkey($absentlist["Attendance"]["ATTENDANCE_DATE"])][] = $absentlist["User"]["ID"];
                        }
                    }
                }

                $totalPresent = 0;
                $totalAbsents = 0;

                if(is_array($presents) && sizeof($presents)) {
                    foreach($presents as $pk=>$pp) {

                        $totalPresent = $totalPresent + count($pp);
                    }
                }
                if(is_array($absents) && sizeof($absents)) {
                    foreach($absents as $ak=>$zz) {
                        $totalAbsents = $totalAbsents + count($zz);
                    }
                }

                $this->set('TotalPresent',$totalPresent);
                $this->set('TotalAbsent',$totalAbsents);
                break;
        }


        $hw_list = $this->Homework->find('all',array(
            //'contain'=>array($contain),
            'conditions' => $conditions,
            'limit' => 5,
            'order' => 'Homework.HW_ID DESC'
        ));

        $this->set('hw_list',$hw_list);
    }
	
	public function admin_account_section()
    {
        $this->layout = 'admin_dashboard';
        $Session_data = $this->Session->read('Auth.Admin');
        if (empty($Session_data)) {
            $this->redirect(array('action' => 'login'));
        }

        $this->School = ClassRegistry::init('School');
        $school = $this->School->find('first',array(
            'ID'=>1,
        ));
        if(sizeof($school)==0) {
            $this->redirect(array('action' => 'login'));
        }

        $this->set('profile',$school);
        $user_menus = array();

        switch($Session_data['ROLE_ID']) {
            case ADMIN_ID:
                $user_menus = array(
					"account_section"=>array(
                        "name"=>"0",
                        "icon"=>'<i class="fa icon-users"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"account")),
                        "bgcolor"=>"account_section_new"
                    ),
                 	"manage_fees"=>array(
                        "name"=>"1",
                        "icon"=>'<i class="fa icon-briefcase"></i>',
                        "url"=>Router::url(array("controller"=>"Fees")),
                        "bgcolor"=>"fee"
                    ),
					"fee_type"=>array(
                        "name"=>"2",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"FeeTypes")),
                        "bgcolor"=>"fee_type",
                    ),
					"payment_terms"=>array(
                        "name"=>"3",
                        "icon"=>'<i class="fa icon-direction"></i>',
                        "url"=>Router::url(array("controller"=>"PaymentTypes")),
                        "bgcolor"=>"payment_term"
                    ),
					"student_ledger"=>array(
                        "name"=>"4",
                        "icon"=>'<i class="fa icon-speedometer"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"student_ledger")),
                        "bgcolor"=>"student_ledger"
                    ),
					"back_dashboard"=>array(
                        "name"=>"5",
                        "icon"=>'<i class="fa icon-trophy"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"dashboard")),
                        "bgcolor"=>"back_dashboard"
                    )
                );
                break;
        }

                    // for profile
        $user_info = $this->User->find('first',array(
            'conditions'=>array(
                'User.ID'=>$Session_data['ID']
            )
        ));
        $this->set('user_info',$user_info);

        // end of profile

        // for circular
        $this->NoticeBoardXref =  ClassRegistry::init('NoticeBoardXref');
        $notice_board = $this->NoticeBoardXref->find('all',array(
            'contain'=>array("UserFrom","NoticeBoard"),
            'conditions'=>array(
                'TO_ID'=>$Session_data['ID'],
            ),
            'order'=>'NoticeBoardXref.ID desc',
            'limit'=>4
        ));
        $this->set('notice_board',$notice_board);


        $this->set('user_menus',$user_menus);

        // for homework
        $this->Homework =  ClassRegistry::init('Homework');
        $conditions = array();
        $contain = array();
        switch($Session_data["ROLE_ID"]) {
            case TEACHER_ID:
                $conditions = array(
                    'Homework.CLASS_ID' => $Session_data['CLASS_ID'],
                );

                break;
            case STUDENT_ID:
                $conditions = array(
                    'Homework.CLASS_ID' => $Session_data['CLASS_ID'],
                );
                $start_date = date("Y-m-01");
                $end_date = date("Y-m-t");
                $class_id = $Session_data["CLASS_ID"];
                $this->Attendance = ClassRegistry::init('Attendance');
                // present students
                $lists = array();
                $lists =  $this->Attendance->find('all',array(
                    'contain'=>array('User'),
                    'conditions'=>array(
                        'Attendance.ATTENDANCE_DATE between ? and ?' => array($start_date, $end_date),
                        'User.CLASS_ID'=>$class_id,
                        'User.STATUS'=>1,
                        'Attendance.ID'=>$Session_data['ID'],
                        'Attendance.AVAILABILITY'=>'P'

                    ),
                ));
                $presents = array();
                foreach($lists as $list) {
                    if(isset($list["Attendance"]["ATTENDANCE_DATE"])) {
                        if(!in_array($presents,array($list["Attendance"]["ATTENDANCE_DATE"]))) {
                            $presents[$this->General->dateforkey($list["Attendance"]["ATTENDANCE_DATE"])][] = $list["User"]["ID"];
                        }
                    }
                }

                // absent student
                $absentlists = array();
                $absentlists =  $this->Attendance->find('all',array(
                    'contain'=>array('User'),
                    'conditions'=>array(
                        'Attendance.ATTENDANCE_DATE between ? and ?' => array($start_date, $end_date),
                        'User.CLASS_ID'=>$class_id,
                        'User.STATUS'=>1,
                        'Attendance.ID'=>$Session_data['ID'],
                        'Attendance.AVAILABILITY'=>'A'
                    ),
                ));

                $absents = array();
                foreach($absentlists as $absentlist) {
                    if(isset($absentlist["Attendance"]["ATTENDANCE_DATE"])) {
                        if(!in_array($absents,array($absentlist["Attendance"]["ATTENDANCE_DATE"]))) {
                            $absents[$this->General->dateforkey($absentlist["Attendance"]["ATTENDANCE_DATE"])][] = $absentlist["User"]["ID"];
                        }
                    }
                }

                $totalPresent = 0;
                $totalAbsents = 0;

                if(is_array($presents) && sizeof($presents)) {
                    foreach($presents as $pk=>$pp) {

                        $totalPresent = $totalPresent + count($pp);
                    }
                }
                if(is_array($absents) && sizeof($absents)) {
                    foreach($absents as $ak=>$zz) {
                        $totalAbsents = $totalAbsents + count($zz);
                    }
                }

                $this->set('TotalPresent',$totalPresent);
                $this->set('TotalAbsent',$totalAbsents);
                break;
        }


        $hw_list = $this->Homework->find('all',array(
            //'contain'=>array($contain),
            'conditions' => $conditions,
            'limit' => 5,
            'order' => 'Homework.HW_ID DESC'
        ));

        $this->set('hw_list',$hw_list);
    }

	public function admin_library_section()
    {
        $this->layout = 'admin_dashboard';
        $Session_data = $this->Session->read('Auth.Admin');
        if (empty($Session_data)) {
            $this->redirect(array('action' => 'login'));
        }

        $this->School = ClassRegistry::init('School');
        $school = $this->School->find('first',array(
            'ID'=>1,
        ));
        if(sizeof($school)==0) {
            $this->redirect(array('action' => 'login'));
        }

        $this->set('profile',$school);
        $user_menus = array();

        switch($Session_data['ROLE_ID']) {
            case ADMIN_ID:
                $user_menus = array(
                 	 	"profile"=>array(
                        "name"=>"1",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Library","action"=>"add")),
                        "bgcolor"=>"my_profile",
                    ),
					"security"=>array(
                        "name"=>"2",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"security",
                    ),
					"FRONT_OFFICE"=>array(
                        "name"=>"3",
                        "icon"=>'<i class="fa fa-cogs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"")),
                        "bgcolor"=>"FRONT_OFFICE",
                    ),
					"manage_lib"=>array(
                        "name"=>"1",
                        "icon"=>'<i class="fa icon-docs"></i>',
                        "url"=>Router::url(array("controller"=>"Library")),
                        "bgcolor"=>"library"
                    ),
					"book_master"=>array(
                        "name"=>"2",
                        "icon"=>'<i class="fa icon-docs"></i>',
                        "url"=>Router::url(array("controller"=>"Books")),
                        "bgcolor"=>"book_master"
                    ),
					"back_dashboard"=>array(
                        "name"=>"3",
                        "icon"=>'<i class="fa icon-trophy"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"dashboard")),
                        "bgcolor"=>"back_dashboard"
                    )
                );
                break;
        }

                    // for profile
        $user_info = $this->User->find('first',array(
            'conditions'=>array(
                'User.ID'=>$Session_data['ID']
            )
        ));
        $this->set('user_info',$user_info);

        // end of profile

        // for circular
        $this->NoticeBoardXref =  ClassRegistry::init('NoticeBoardXref');
        $notice_board = $this->NoticeBoardXref->find('all',array(
            'contain'=>array("UserFrom","NoticeBoard"),
            'conditions'=>array(
                'TO_ID'=>$Session_data['ID'],
            ),
            'order'=>'NoticeBoardXref.ID desc',
            'limit'=>4
        ));
        $this->set('notice_board',$notice_board);


        $this->set('user_menus',$user_menus);

        // for homework
        $this->Homework =  ClassRegistry::init('Homework');
        $conditions = array();
        $contain = array();
        switch($Session_data["ROLE_ID"]) {
            case TEACHER_ID:
                $conditions = array(
                    'Homework.CLASS_ID' => $Session_data['CLASS_ID'],
                );

                break;
            case STUDENT_ID:
                $conditions = array(
                    'Homework.CLASS_ID' => $Session_data['CLASS_ID'],
                );
                $start_date = date("Y-m-01");
                $end_date = date("Y-m-t");
                $class_id = $Session_data["CLASS_ID"];
                $this->Attendance = ClassRegistry::init('Attendance');
                // present students
                $lists = array();
                $lists =  $this->Attendance->find('all',array(
                    'contain'=>array('User'),
                    'conditions'=>array(
                        'Attendance.ATTENDANCE_DATE between ? and ?' => array($start_date, $end_date),
                        'User.CLASS_ID'=>$class_id,
                        'User.STATUS'=>1,
                        'Attendance.ID'=>$Session_data['ID'],
                        'Attendance.AVAILABILITY'=>'P'

                    ),
                ));
                $presents = array();
                foreach($lists as $list) {
                    if(isset($list["Attendance"]["ATTENDANCE_DATE"])) {
                        if(!in_array($presents,array($list["Attendance"]["ATTENDANCE_DATE"]))) {
                            $presents[$this->General->dateforkey($list["Attendance"]["ATTENDANCE_DATE"])][] = $list["User"]["ID"];
                        }
                    }
                }

                // absent student
                $absentlists = array();
                $absentlists =  $this->Attendance->find('all',array(
                    'contain'=>array('User'),
                    'conditions'=>array(
                        'Attendance.ATTENDANCE_DATE between ? and ?' => array($start_date, $end_date),
                        'User.CLASS_ID'=>$class_id,
                        'User.STATUS'=>1,
                        'Attendance.ID'=>$Session_data['ID'],
                        'Attendance.AVAILABILITY'=>'A'
                    ),
                ));

                $absents = array();
                foreach($absentlists as $absentlist) {
                    if(isset($absentlist["Attendance"]["ATTENDANCE_DATE"])) {
                        if(!in_array($absents,array($absentlist["Attendance"]["ATTENDANCE_DATE"]))) {
                            $absents[$this->General->dateforkey($absentlist["Attendance"]["ATTENDANCE_DATE"])][] = $absentlist["User"]["ID"];
                        }
                    }
                }

                $totalPresent = 0;
                $totalAbsents = 0;

                if(is_array($presents) && sizeof($presents)) {
                    foreach($presents as $pk=>$pp) {

                        $totalPresent = $totalPresent + count($pp);
                    }
                }
                if(is_array($absents) && sizeof($absents)) {
                    foreach($absents as $ak=>$zz) {
                        $totalAbsents = $totalAbsents + count($zz);
                    }
                }

                $this->set('TotalPresent',$totalPresent);
                $this->set('TotalAbsent',$totalAbsents);
                break;
        }


        $hw_list = $this->Homework->find('all',array(
            //'contain'=>array($contain),
            'conditions' => $conditions,
            'limit' => 5,
            'order' => 'Homework.HW_ID DESC'
        ));

        $this->set('hw_list',$hw_list);
    }

	public function admin_hr_section()
    {
        $this->layout = 'admin_dashboard';
        $Session_data = $this->Session->read('Auth.Admin');
        if (empty($Session_data)) {
            $this->redirect(array('action' => 'login'));
        }

        $this->School = ClassRegistry::init('School');
        $school = $this->School->find('first',array(
            'ID'=>1,
        ));
        if(sizeof($school)==0) {
            $this->redirect(array('action' => 'login'));
        }

        $this->set('profile',$school);
        $user_menus = array();

        switch($Session_data['ROLE_ID']) {
            case ADMIN_ID:
                $user_menus = array(             
                    "leave_application"=>array(
                        "name"=>"1",
                        "icon"=>'<i class="fa icon-envelope-letter"></i>',
                        "url"=>Router::url(array("controller"=>"leaveApplications")),
                        "bgcolor"=>"leave_application"
                    ),
                    "manage_events"=>array(
                        "name"=>"2",
                        "icon"=>'<i class="fa icon-calendar"></i>',
                        "url"=>Router::url(array("controller"=>"Events")),
                        "bgcolor"=>"events"
                    ),
                    "TeacherTimeTables"=>array(
                        "name"=>"3",
                        "icon"=>'<i class="fa icon-speedometer"></i>',
                        "url"=>Router::url(array("controller"=>"TeacherTimeTables")),
                        "bgcolor"=>"assign_time_table"
                    ),
                    "attendance"=>array(
                        "name"=>"4",
                        "icon"=>'<i class="fa icon-bar-chart"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"attendance_listing")),
                        "bgcolor"=>"attendance"
                    ),
                    "noticeboard"=>array(
                        "name"=>"5",
                        "icon"=>'<i class="fa icon-bell"></i>',
                        "url"=>Router::url(array("controller"=>"NoticeBoard")),
                        "bgcolor"=>"notice_board"
                    ),
					"user_suggestion"=>array(
                        "name"=>"6",
                        "icon"=>'<i class="fa icon-bubbles"></i>',
                        "url"=>Router::url(array("controller"=>"suggestions")),
                        "bgcolor"=>"user_suggestion"
                    ),
					"vacancy"=>array(
                        "name"=>"7",
                        "icon"=>'<i class="fa icon-speedometer"></i>',
                        "url"=>Router::url(array("controller"=>"Vacancy")),
                        "bgcolor"=>"vacancy"
                    ),
					"manage_imports"=>array(
                        "name"=>"8",
                        "icon"=>'<i class="fa icon-calendar"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"import")),
                        "bgcolor"=>"imports"
                    ),
					"back_dashboard"=>array(
                        "name"=>"9",
                        "icon"=>'<i class="fa icon-trophy"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"dashboard")),
                        "bgcolor"=>"back_dashboard"
                    )
                );
                break;
        }

                    // for profile
        $user_info = $this->User->find('first',array(
            'conditions'=>array(
                'User.ID'=>$Session_data['ID']
            )
        ));
        $this->set('user_info',$user_info);

        // end of profile

        // for circular
        $this->NoticeBoardXref =  ClassRegistry::init('NoticeBoardXref');
        $notice_board = $this->NoticeBoardXref->find('all',array(
            'contain'=>array("UserFrom","NoticeBoard"),
            'conditions'=>array(
                'TO_ID'=>$Session_data['ID'],
            ),
            'order'=>'NoticeBoardXref.ID desc',
            'limit'=>4
        ));
        $this->set('notice_board',$notice_board);


        $this->set('user_menus',$user_menus);

        // for homework
        $this->Homework =  ClassRegistry::init('Homework');
        $conditions = array();
        $contain = array();
        switch($Session_data["ROLE_ID"]) {
            case TEACHER_ID:
                $conditions = array(
                    'Homework.CLASS_ID' => $Session_data['CLASS_ID'],
                );

                break;
            case STUDENT_ID:
                $conditions = array(
                    'Homework.CLASS_ID' => $Session_data['CLASS_ID'],
                );
                $start_date = date("Y-m-01");
                $end_date = date("Y-m-t");
                $class_id = $Session_data["CLASS_ID"];
                $this->Attendance = ClassRegistry::init('Attendance');
                // present students
                $lists = array();
                $lists =  $this->Attendance->find('all',array(
                    'contain'=>array('User'),
                    'conditions'=>array(
                        'Attendance.ATTENDANCE_DATE between ? and ?' => array($start_date, $end_date),
                        'User.CLASS_ID'=>$class_id,
                        'User.STATUS'=>1,
                        'Attendance.ID'=>$Session_data['ID'],
                        'Attendance.AVAILABILITY'=>'P'

                    ),
                ));
                $presents = array();
                foreach($lists as $list) {
                    if(isset($list["Attendance"]["ATTENDANCE_DATE"])) {
                        if(!in_array($presents,array($list["Attendance"]["ATTENDANCE_DATE"]))) {
                            $presents[$this->General->dateforkey($list["Attendance"]["ATTENDANCE_DATE"])][] = $list["User"]["ID"];
                        }
                    }
                }

                // absent student
                $absentlists = array();
                $absentlists =  $this->Attendance->find('all',array(
                    'contain'=>array('User'),
                    'conditions'=>array(
                        'Attendance.ATTENDANCE_DATE between ? and ?' => array($start_date, $end_date),
                        'User.CLASS_ID'=>$class_id,
                        'User.STATUS'=>1,
                        'Attendance.ID'=>$Session_data['ID'],
                        'Attendance.AVAILABILITY'=>'A'
                    ),
                ));

                $absents = array();
                foreach($absentlists as $absentlist) {
                    if(isset($absentlist["Attendance"]["ATTENDANCE_DATE"])) {
                        if(!in_array($absents,array($absentlist["Attendance"]["ATTENDANCE_DATE"]))) {
                            $absents[$this->General->dateforkey($absentlist["Attendance"]["ATTENDANCE_DATE"])][] = $absentlist["User"]["ID"];
                        }
                    }
                }

                $totalPresent = 0;
                $totalAbsents = 0;

                if(is_array($presents) && sizeof($presents)) {
                    foreach($presents as $pk=>$pp) {

                        $totalPresent = $totalPresent + count($pp);
                    }
                }
                if(is_array($absents) && sizeof($absents)) {
                    foreach($absents as $ak=>$zz) {
                        $totalAbsents = $totalAbsents + count($zz);
                    }
                }

                $this->set('TotalPresent',$totalPresent);
                $this->set('TotalAbsent',$totalAbsents);
                break;
        }


        $hw_list = $this->Homework->find('all',array(
            //'contain'=>array($contain),
            'conditions' => $conditions,
            'limit' => 5,
            'order' => 'Homework.HW_ID DESC'
        ));

        $this->set('hw_list',$hw_list);
    }
	
	public function admin_teacher_section()
    {
        $this->layout = 'admin_dashboard';
        $Session_data = $this->Session->read('Auth.Admin');
        if (empty($Session_data)) {
            $this->redirect(array('action' => 'login'));
        }

        $this->School = ClassRegistry::init('School');
        $school = $this->School->find('first',array(
            'ID'=>1,
        ));
        if(sizeof($school)==0) {
            $this->redirect(array('action' => 'login'));
        }

        $this->set('profile',$school);
        $user_menus = array();

        switch($Session_data['ROLE_ID']) {
            case ADMIN_ID:
                $user_menus = array(             
                   "studentsection"=>array(
                        "name"=>"1",
                        "icon"=>'<i class="fa icon-user-follow"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"students")),
                        "bgcolor"=>"student_section"
                    ),
                    "my_document"=>array(
                        "name"=>"2",
                        "icon"=>'<i class="fa icon-docs"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"documents")),
                        "bgcolor"=>"my_document",
                    ),
                    "my_ebook"=>array(
                        "name"=>"3",
                        "icon"=>'<i class="fa icon-book-open"></i>',
                        "url"=>Router::url(array("controller"=>"EBook")),
                        "bgcolor"=>"ebook"
                    ),

                    "noticeboard"=>array(
                        "name"=>"4",
                        "icon"=>'<i class="fa icon-bell"></i>',
                        "url"=>Router::url(array("controller"=>"NoticeBoard")),
                        "bgcolor"=>"notice_board"
                    ),
                    "manage_events"=>array(
                        "name"=>"5",
                        "icon"=>'<i class="fa icon-calendar"></i>',
                        "url"=>Router::url(array("controller"=>"Events")),
                        "bgcolor"=>"events"
                    ),
                    "supervisor"=>array(
                        "name"=>"6",
                        "icon"=>'<i class="fa icon-user-follow"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"supervisors")),
                        "bgcolor"=>"supervisor_section"
                    ),
                    "teacher_section"=>array(
                        "name"=>"7",
                        "icon"=>'<i class="fa icon-users"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"teachers")),
                        "bgcolor"=>"teacher_section"
                    ),
                    "leave_application"=>array(
                        "name"=>"8",
                        "icon"=>'<i class="fa icon-envelope-letter"></i>',
                        "url"=>Router::url(array("controller"=>"leaveApplications")),
                        "bgcolor"=>"leave_application"
                    ),
                    "user_suggestion"=>array(
                        "name"=>"9",
                        "icon"=>'<i class="fa icon-bubbles"></i>',
                        "url"=>Router::url(array("controller"=>"suggestions")),
                        "bgcolor"=>"user_suggestion"
                    ),
                    "TeacherTimeTables"=>array(
                        "name"=>"10",
                        "icon"=>'<i class="fa icon-speedometer"></i>',
                        "url"=>Router::url(array("controller"=>"TeacherTimeTables")),
                        "bgcolor"=>"assign_time_table"
                    ),
                    "attendance"=>array(
                        "name"=>"11",
                        "icon"=>'<i class="fa icon-bar-chart"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"attendance_listing")),
                        "bgcolor"=>"attendance"
                    ),
                    "classwork"=>array(
                        "name"=>"12",
                        "icon"=>'<i class="fa icon-note"></i>',
                        "url"=>Router::url(array("controller"=>"Classwork")),
                        "bgcolor"=>"class_work"
                    ),

                    "homework"=>array(
                        "name"=>"13",
                        "icon"=>'<i class="fa icon-note"></i>',
                        "url"=>Router::url(array("controller"=>"Homeworks")),
                        "bgcolor"=>"home_work"
                    ),
                    "student_ledger"=>array(
                        "name"=>"14",
                        "icon"=>'<i class="fa icon-speedometer"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"student_ledger")),
                        "bgcolor"=>"student_ledger"
                    ),
                    "transportation"=>array(
                        "name"=>"15",
                        "icon"=>'<i class="fa icon-pointer"></i>',
                        "url"=>Router::url(array("controller"=>"Transports","action"=>"graphic")),
                        "bgcolor"=>"transports"
                    ),
                    "examination"=>array(
                        "name"=>"16",
                        "icon"=>'<i class="fa icon-calendar"></i>',
                        "url"=>Router::url(array("controller"=>"Exams","action"=>"list")),
                        "bgcolor"=>"exam_schedule"
                    ),
                    "examination_list"=>array(
                        "name"=>"17",
                        "icon"=>'<i class="fa icon-calendar"></i>',
                        "url"=>Router::url(array("controller"=>"Exams")),
                        "bgcolor"=>"exam_list"
                    ),
                    "examination_result"=>array(
                        "name"=>"18",
                        "icon"=>'<i class="fa icon-trophy"></i>',
                        "url"=>Router::url(array("controller"=>"Results")),
                        "bgcolor"=>"exam_result"
                    ),
					"back_dashboard"=>array(
                        "name"=>"19",
                        "icon"=>'<i class="fa icon-trophy"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"dashboard")),
                        "bgcolor"=>"back_dashboard"
                    )
                );
                break;
        }

        // for profile
        $user_info = $this->User->find('first',array(
            'conditions'=>array(
                'User.ID'=>$Session_data['ID']
            )
        ));
        $this->set('user_info',$user_info);

        // end of profile

        // for circular
        $this->NoticeBoardXref =  ClassRegistry::init('NoticeBoardXref');
        $notice_board = $this->NoticeBoardXref->find('all',array(
            'contain'=>array("UserFrom","NoticeBoard"),
            'conditions'=>array(
                'TO_ID'=>$Session_data['ID'],
            ),
            'order'=>'NoticeBoardXref.ID desc',
            'limit'=>4
        ));
        $this->set('notice_board',$notice_board);


        $this->set('user_menus',$user_menus);

        // for homework
        $this->Homework =  ClassRegistry::init('Homework');
        $conditions = array();
        $contain = array();
        switch($Session_data["ROLE_ID"]) {
            case TEACHER_ID:
                $conditions = array(
                    'Homework.CLASS_ID' => $Session_data['CLASS_ID'],
                );

                break;
            case STUDENT_ID:
                $conditions = array(
                    'Homework.CLASS_ID' => $Session_data['CLASS_ID'],
                );
                $start_date = date("Y-m-01");
                $end_date = date("Y-m-t");
                $class_id = $Session_data["CLASS_ID"];
                $this->Attendance = ClassRegistry::init('Attendance');
                // present students
                $lists = array();
                $lists =  $this->Attendance->find('all',array(
                    'contain'=>array('User'),
                    'conditions'=>array(
                        'Attendance.ATTENDANCE_DATE between ? and ?' => array($start_date, $end_date),
                        'User.CLASS_ID'=>$class_id,
                        'User.STATUS'=>1,
                        'Attendance.ID'=>$Session_data['ID'],
                        'Attendance.AVAILABILITY'=>'P'

                    ),
                ));
                $presents = array();
                foreach($lists as $list) {
                    if(isset($list["Attendance"]["ATTENDANCE_DATE"])) {
                        if(!in_array($presents,array($list["Attendance"]["ATTENDANCE_DATE"]))) {
                            $presents[$this->General->dateforkey($list["Attendance"]["ATTENDANCE_DATE"])][] = $list["User"]["ID"];
                        }
                    }
                }

                // absent student
                $absentlists = array();
                $absentlists =  $this->Attendance->find('all',array(
                    'contain'=>array('User'),
                    'conditions'=>array(
                        'Attendance.ATTENDANCE_DATE between ? and ?' => array($start_date, $end_date),
                        'User.CLASS_ID'=>$class_id,
                        'User.STATUS'=>1,
                        'Attendance.ID'=>$Session_data['ID'],
                        'Attendance.AVAILABILITY'=>'A'
                    ),
                ));

                $absents = array();
                foreach($absentlists as $absentlist) {
                    if(isset($absentlist["Attendance"]["ATTENDANCE_DATE"])) {
                        if(!in_array($absents,array($absentlist["Attendance"]["ATTENDANCE_DATE"]))) {
                            $absents[$this->General->dateforkey($absentlist["Attendance"]["ATTENDANCE_DATE"])][] = $absentlist["User"]["ID"];
                        }
                    }
                }

                $totalPresent = 0;
                $totalAbsents = 0;

                if(is_array($presents) && sizeof($presents)) {
                    foreach($presents as $pk=>$pp) {

                        $totalPresent = $totalPresent + count($pp);
                    }
                }
                if(is_array($absents) && sizeof($absents)) {
                    foreach($absents as $ak=>$zz) {
                        $totalAbsents = $totalAbsents + count($zz);
                    }
                }

                $this->set('TotalPresent',$totalPresent);
                $this->set('TotalAbsent',$totalAbsents);
                break;
        }


        $hw_list = $this->Homework->find('all',array(
            //'contain'=>array($contain),
            'conditions' => $conditions,
            'limit' => 5,
            'order' => 'Homework.HW_ID DESC'
        ));

        $this->set('hw_list',$hw_list);
    }
	
	public function admin_superviser_section()
    {
        $this->layout = 'admin_dashboard';
        $Session_data = $this->Session->read('Auth.Admin');
        if (empty($Session_data)) {
            $this->redirect(array('action' => 'login'));
        }

        $this->School = ClassRegistry::init('School');
        $school = $this->School->find('first',array(
            'ID'=>1,
        ));
        if(sizeof($school)==0) {
            $this->redirect(array('action' => 'login'));
        }

        $this->set('profile',$school);
        $user_menus = array();

        switch($Session_data['ROLE_ID']) {
            case ADMIN_ID:
                $user_menus = array(
					 "examination"=>array(
                        "name"=>"1",
                        "icon"=>'<i class="fa icon-calendar"></i>',
                        "url"=>Router::url(array("controller"=>"Exams")),
                        "bgcolor"=>"exam_schedule"
                    ),
					"manage_exam_type"=>array(
                        "name"=>"2",
                        "icon"=>'<i class="fa icon-note"></i>',
                        "url"=>Router::url(array("controller"=>"ExamTypes")),
                        "bgcolor"=>"exam_type"
                    ),
					"manage_holiday"=>array(
                        "name"=>"3",
                        "icon"=>'<i class="fa icon-calendar"></i>',
                        "url"=>Router::url(array("controller"=>"Holidays")),
                        "bgcolor"=>"holiday"
                    ),
					"manage_events"=>array(
                        "name"=>"4",
                        "icon"=>'<i class="fa icon-calendar"></i>',
                        "url"=>Router::url(array("controller"=>"Events")),
                        "bgcolor"=>"events"
                    ),
					"manage_imports"=>array(
                        "name"=>"5",
                        "icon"=>'<i class="fa icon-calendar"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"import")),
                        "bgcolor"=>"imports"
                    ),
					"mnanage_subject"=>array(
                        "name"=>"6",
                        "icon"=>'<i class="fa icon-tag"></i>',
                        "url"=>Router::url(array("controller"=>"Subjects")),
                        "bgcolor"=>"subject"
                    ),
					"manage_transport"=>array(
                        "name"=>"7",
                        "icon"=>'<i class="fa icon-pointer"></i>',
                        "url"=>Router::url(array("controller"=>"Transports")),
                        "bgcolor"=>"transports"
                    ),
					"general_setting"=>array(
                        "name"=>"8",
                        "icon"=>'<i class="fa icon-pointer"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"general_setting")),
                        "bgcolor"=>"general_setting"
                    ),
					"admission_form"=>array(
                        "name"=>"9",
                        "icon"=>'<i class="fa icon-users"></i>',
                        "url"=>Router::url(array("controller"=>"AdmissionForms")),
                        "bgcolor"=>"admission_forms"
                    ),
                    "admission_inquiry"=>array(
                        "name"=>"10",
                        "icon"=>'<i class="fa icon-info"></i>',
                        "url"=>Router::url(array("controller"=>"AppAdmission")),
                        "bgcolor"=>"admission_inquiry"
                    ),               
					"back_dashboard"=>array(
                        "name"=>"11",
                        "icon"=>'<i class="fa icon-trophy"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"dashboard")),
                        "bgcolor"=>"back_dashboard"
                    )
                );
                break;
        }

                    // for profile
        $user_info = $this->User->find('first',array(
            'conditions'=>array(
                'User.ID'=>$Session_data['ID']
            )
        ));
        $this->set('user_info',$user_info);

        // end of profile

        // for circular
        $this->NoticeBoardXref =  ClassRegistry::init('NoticeBoardXref');
        $notice_board = $this->NoticeBoardXref->find('all',array(
            'contain'=>array("UserFrom","NoticeBoard"),
            'conditions'=>array(
                'TO_ID'=>$Session_data['ID'],
            ),
            'order'=>'NoticeBoardXref.ID desc',
            'limit'=>4
        ));
        $this->set('notice_board',$notice_board);


        $this->set('user_menus',$user_menus);

        // for homework
        $this->Homework =  ClassRegistry::init('Homework');
        $conditions = array();
        $contain = array();
        switch($Session_data["ROLE_ID"]) {
            case TEACHER_ID:
                $conditions = array(
                    'Homework.CLASS_ID' => $Session_data['CLASS_ID'],
                );

                break;
            case STUDENT_ID:
                $conditions = array(
                    'Homework.CLASS_ID' => $Session_data['CLASS_ID'],
                );
                $start_date = date("Y-m-01");
                $end_date = date("Y-m-t");
                $class_id = $Session_data["CLASS_ID"];
                $this->Attendance = ClassRegistry::init('Attendance');
                // present students
                $lists = array();
                $lists =  $this->Attendance->find('all',array(
                    'contain'=>array('User'),
                    'conditions'=>array(
                        'Attendance.ATTENDANCE_DATE between ? and ?' => array($start_date, $end_date),
                        'User.CLASS_ID'=>$class_id,
                        'User.STATUS'=>1,
                        'Attendance.ID'=>$Session_data['ID'],
                        'Attendance.AVAILABILITY'=>'P'

                    ),
                ));
                $presents = array();
                foreach($lists as $list) {
                    if(isset($list["Attendance"]["ATTENDANCE_DATE"])) {
                        if(!in_array($presents,array($list["Attendance"]["ATTENDANCE_DATE"]))) {
                            $presents[$this->General->dateforkey($list["Attendance"]["ATTENDANCE_DATE"])][] = $list["User"]["ID"];
                        }
                    }
                }

                // absent student
                $absentlists = array();
                $absentlists =  $this->Attendance->find('all',array(
                    'contain'=>array('User'),
                    'conditions'=>array(
                        'Attendance.ATTENDANCE_DATE between ? and ?' => array($start_date, $end_date),
                        'User.CLASS_ID'=>$class_id,
                        'User.STATUS'=>1,
                        'Attendance.ID'=>$Session_data['ID'],
                        'Attendance.AVAILABILITY'=>'A'
                    ),
                ));

                $absents = array();
                foreach($absentlists as $absentlist) {
                    if(isset($absentlist["Attendance"]["ATTENDANCE_DATE"])) {
                        if(!in_array($absents,array($absentlist["Attendance"]["ATTENDANCE_DATE"]))) {
                            $absents[$this->General->dateforkey($absentlist["Attendance"]["ATTENDANCE_DATE"])][] = $absentlist["User"]["ID"];
                        }
                    }
                }

                $totalPresent = 0;
                $totalAbsents = 0;

                if(is_array($presents) && sizeof($presents)) {
                    foreach($presents as $pk=>$pp) {

                        $totalPresent = $totalPresent + count($pp);
                    }
                }
                if(is_array($absents) && sizeof($absents)) {
                    foreach($absents as $ak=>$zz) {
                        $totalAbsents = $totalAbsents + count($zz);
                    }
                }

                $this->set('TotalPresent',$totalPresent);
                $this->set('TotalAbsent',$totalAbsents);
                break;
        }


        $hw_list = $this->Homework->find('all',array(
            //'contain'=>array($contain),
            'conditions' => $conditions,
            'limit' => 5,
            'order' => 'Homework.HW_ID DESC'
        ));

        $this->set('hw_list',$hw_list);
    }
	
	public function admin_admission_section()
	{
		
		        $this->layout = 'admin_dashboard';
        $Session_data = $this->Session->read('Auth.Admin');
        if (empty($Session_data)) {
            $this->redirect(array('action' => 'login'));
        }

        $this->School = ClassRegistry::init('School');
        $school = $this->School->find('first',array(
            'ID'=>1,
        ));
        if(sizeof($school)==0) {
            $this->redirect(array('action' => 'login'));
        }

        $this->set('profile',$school);
        $user_menus = array();

        switch($Session_data['ROLE_ID']) {
            case ADMIN_ID:
                $user_menus = array(
                   
					"my_document"=>array(
                        "name"=>"3",
                        "icon"=>'<i class="fa icon-docs"></i>',
                        "url"=>Router::url(array("controller"=>"Document")),
                        "bgcolor"=>"my_document",
                    ),
					"admission_inquiry"=>array(
                        "name"=>"4",
                        "icon"=>'<i class="fa icon-info"></i>',
                        "url"=>Router::url(array("controller"=>"AppAdmission")),
                        "bgcolor"=>"admission_inquiry"
                    ),
					
                );
                break;
        }

                    // for profile
        $user_info = $this->User->find('first',array(
            'conditions'=>array(
                'User.ID'=>$Session_data['ID']
            )
        ));
        $this->set('user_info',$user_info);

        // end of profile

        // for circular
        $this->NoticeBoardXref =  ClassRegistry::init('NoticeBoardXref');
        $notice_board = $this->NoticeBoardXref->find('all',array(
            'contain'=>array("UserFrom","NoticeBoard"),
            'conditions'=>array(
                'TO_ID'=>$Session_data['ID'],
            ),
            'order'=>'NoticeBoardXref.ID desc',
            'limit'=>4
        ));
        $this->set('notice_board',$notice_board);


        $this->set('user_menus',$user_menus);

	}
	
	
	public function admin_student_section()
    {
        $this->layout = 'admin_dashboard';
        $Session_data = $this->Session->read('Auth.Admin');
        if (empty($Session_data)) {
            $this->redirect(array('action' => 'login'));
        }

        $this->School = ClassRegistry::init('School');
        $school = $this->School->find('first',array(
            'ID'=>1,
        ));
        if(sizeof($school)==0) {
            $this->redirect(array('action' => 'login'));
        }

        $this->set('profile',$school);
        $user_menus = array();

        switch($Session_data['ROLE_ID']) {
            case ADMIN_ID:
                $user_menus = array(
					"admission_inquiry"=>array(
                        "name"=>"1",
                        "icon"=>'<i class="fa icon-info"></i>',
                        "url"=>Router::url(array("controller"=>"AppAdmission")),
                        "bgcolor"=>"admission_inquiry"
                    ),
					"admission_form"=>array(
                        "name"=>"2",
                        "icon"=>'<i class="fa icon-users"></i>',
                        "url"=>Router::url(array("controller"=>"AdmissionForms")),
                        "bgcolor"=>"admission_forms"
                    ),
				    "admission_section"=>array(
                        "name"=>"3",
                        "icon"=>'<i class="fa icon-user-follow"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"students")),
                        "bgcolor"=>"admission_section"
                    ),
					"my_fees"=>array(
                        "name"=>"4",
                        "icon"=>'<i class="fa icon-briefcase"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"fees")),
                        "bgcolor"=>"fee"
                    ),           
					"back_dashboard"=>array(
                        "name"=>"5",
                        "icon"=>'<i class="fa icon-trophy"></i>',
                        "url"=>Router::url(array("controller"=>"Users","action"=>"dashboard")),
                        "bgcolor"=>"back_dashboard"
                    )
                );
                break;
        }

                    // for profile
        $user_info = $this->User->find('first',array(
            'conditions'=>array(
                'User.ID'=>$Session_data['ID']
            )
        ));
        $this->set('user_info',$user_info);

        // end of profile

        // for circular
        $this->NoticeBoardXref =  ClassRegistry::init('NoticeBoardXref');
        $notice_board = $this->NoticeBoardXref->find('all',array(
            'contain'=>array("UserFrom","NoticeBoard"),
            'conditions'=>array(
                'TO_ID'=>$Session_data['ID'],
            ),
            'order'=>'NoticeBoardXref.ID desc',
            'limit'=>4
        ));
        $this->set('notice_board',$notice_board);


        $this->set('user_menus',$user_menus);

        // for homework
        $this->Homework =  ClassRegistry::init('Homework');
        $conditions = array();
        $contain = array();
        switch($Session_data["ROLE_ID"]) {
            case TEACHER_ID:
                $conditions = array(
                    'Homework.CLASS_ID' => $Session_data['CLASS_ID'],
                );

                break;
            case STUDENT_ID:
                $conditions = array(
                    'Homework.CLASS_ID' => $Session_data['CLASS_ID'],
                );
                $start_date = date("Y-m-01");
                $end_date = date("Y-m-t");
                $class_id = $Session_data["CLASS_ID"];
                $this->Attendance = ClassRegistry::init('Attendance');
                // present students
                $lists = array();
                $lists =  $this->Attendance->find('all',array(
                    'contain'=>array('User'),
                    'conditions'=>array(
                        'Attendance.ATTENDANCE_DATE between ? and ?' => array($start_date, $end_date),
                        'User.CLASS_ID'=>$class_id,
                        'User.STATUS'=>1,
                        'Attendance.ID'=>$Session_data['ID'],
                        'Attendance.AVAILABILITY'=>'P'

                    ),
                ));
                $presents = array();
                foreach($lists as $list) {
                    if(isset($list["Attendance"]["ATTENDANCE_DATE"])) {
                        if(!in_array($presents,array($list["Attendance"]["ATTENDANCE_DATE"]))) {
                            $presents[$this->General->dateforkey($list["Attendance"]["ATTENDANCE_DATE"])][] = $list["User"]["ID"];
                        }
                    }
                }

                // absent student
                $absentlists = array();
                $absentlists =  $this->Attendance->find('all',array(
                    'contain'=>array('User'),
                    'conditions'=>array(
                        'Attendance.ATTENDANCE_DATE between ? and ?' => array($start_date, $end_date),
                        'User.CLASS_ID'=>$class_id,
                        'User.STATUS'=>1,
                        'Attendance.ID'=>$Session_data['ID'],
                        'Attendance.AVAILABILITY'=>'A'
                    ),
                ));

                $absents = array();
                foreach($absentlists as $absentlist) {
                    if(isset($absentlist["Attendance"]["ATTENDANCE_DATE"])) {
                        if(!in_array($absents,array($absentlist["Attendance"]["ATTENDANCE_DATE"]))) {
                            $absents[$this->General->dateforkey($absentlist["Attendance"]["ATTENDANCE_DATE"])][] = $absentlist["User"]["ID"];
                        }
                    }
                }

                $totalPresent = 0;
                $totalAbsents = 0;

                if(is_array($presents) && sizeof($presents)) {
                    foreach($presents as $pk=>$pp) {

                        $totalPresent = $totalPresent + count($pp);
                    }
                }
                if(is_array($absents) && sizeof($absents)) {
                    foreach($absents as $ak=>$zz) {
                        $totalAbsents = $totalAbsents + count($zz);
                    }
                }

                $this->set('TotalPresent',$totalPresent);
                $this->set('TotalAbsent',$totalAbsents);
                break;
        }


        $hw_list = $this->Homework->find('all',array(
            //'contain'=>array($contain),
            'conditions' => $conditions,
            'limit' => 5,
            'order' => 'Homework.HW_ID DESC'
        ));

        $this->set('hw_list',$hw_list);
    }
	
	public function generate_fees($UserId,$ClassId) 
	{
	$j = array();
	 $this->LedgerXref = ClassRegistry::init('LedgerXref');
	 $this->Fee = ClassRegistry::init('Fee');
		$Fees = $this->Fee->find('all', array(
            'conditions' => array('Fee.CLASS_ID' => $ClassId, 'Fee.STATUS' => 1),
            'contain' => array('FeeType'),
        ));
		
		foreach($Fees as $key => $val)
        {

            $feeType = $val['Fee']['FEE_TYPE'];
            $feeAmount =  $val['Fee']['FEE'];
			$conditions = array('LedgerXref.USER_ID' => $UserId,'LedgerXref.FEES_TYPE'=>$feeType, 'LedgerXref.STATUS' => 1);
            $PaidFees = $this->LedgerXref->find('all', array(
                'contain' => array('FeeType','User'),
                'conditions' => $conditions
            ));

            if(isset($PaidFees) && sizeof($PaidFees)>0)
            {

               foreach($PaidFees as $paidkey=>$paidvalue ) {
                       $balance = (int)$val["Fee"]["FEE"] - (int)$paidvalue["LedgerXref"]["AMOUNT"];
                       $j[] = array("RECEIVE_AMOUNT"=>$paidvalue["LedgerXref"]["AMOUNT"],'PENDING'=>$balance,'TOTAL_FEE'=>$val["Fee"]["FEE"],"FEE"=>$paidvalue["FeeType"]["TITLE"],"FEE_TYPE"=>$paidvalue["LedgerXref"]["FEES_TYPE"],'RECEIVE_DATE'=>$this->General->datefordb($paidvalue["LedgerXref"]["created"]));
               }
            }
			
			
            if(!$this->in_array_r($j, 'FEE_TYPE', $val["Fee"]["FEE_TYPE"])) {
             
               $j[] = array("RECEIVE_AMOUNT"=>0,'TOTAL_FEE'=>$val["Fee"]["FEE"],'PENDING'=>$val["Fee"]["FEE"],"FEE"=>$val["FeeType"]["TITLE"],"FEE_TYPE"=>$val["Fee"]["FEE_TYPE"]) ;

            }
		}	
		return $j;	
	
	}// end of functions
    
	public function admin_GetstudentbyClass()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;
        $class_id = '';

        if($this->request->is("ajax")) {
            $class = $this->User->getStudentsByClass($this->request->data["User"]["CLASS_ID"]);
            if(is_array($class) && sizeof($class)) {
               $html = '';
			   $class[''] = "ALL STUDENT";
			   foreach($class as $k=>$val) { 
			   	$html.='<option value='.$k.'>'.$val.'</option>';
			   }
			    echo json_encode(array("status"=>"success","msg"=>$html));
            }else{
                echo json_encode(array("status"=>"error","msg"=>"Not mention"));
            }
        }

        die;

    }

    public function admin_fees() {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        $this->Fee = ClassRegistry::init('Fee');
        $fees = $this->Fee->find('all',array(
            'conditions'=>array(
                'Fee.CLASS_ID'=>$Session_data["CLASS_ID"],
                'Fee.STATUS'=>1,
            ),
        ));

        // for paid
        $UserId = $Session_data["ID"];
        $this->LedgerXref = ClassRegistry::init('LedgerXref');
        $paid_fees = $this->LedgerXref->find('all', array(
            'conditions' => array('USER_ID' => $UserId, 'LedgerXref.STATUS' => 1),
            'contain' => array('PaymentType','FeeType')
        ));

        // end paid

        // for unpaid
        $ClassId = $Session_data["CLASS_ID"];;
        $UserId = $Session_data["ID"];

        $this->LedgerXref = ClassRegistry::init('LedgerXref');

        $j = array();

        foreach($fees as $key => $val)
        {
            $feeType = $val['Fee']['FEE_TYPE'];
            $feeAmount =  $val['Fee']['FEE'];

            $PaidFees = $this->LedgerXref->find('all', array(
                'contain' => array('FeeType'),
                'conditions' => array('LedgerXref.USER_ID' => $UserId,'LedgerXref.FEES_TYPE'=>$val["Fee"]["FEE_TYPE"], 'LedgerXref.STATUS' => 1)

            ));
            if(isset($PaidFees) && sizeof($PaidFees))
            {
                foreach($PaidFees as $paidkey=>$paidvalue ) {
                    $balance = (int)$val["Fee"]["FEE"] - (int)$paidvalue["LedgerXref"]["AMOUNT"];
                    $j[] = array("AMOUNT"=>"$balance","FEE"=>$paidvalue["FeeType"]["TITLE"],"FEE_TYPE"=>$paidvalue["LedgerXref"]["FEES_TYPE"]);
                }
            }


            if(!$this->in_array_r($j, 'FEE_TYPE', $val["Fee"]["FEE_TYPE"])) {

                $j[] = array("AMOUNT"=>$val["Fee"]["FEE"],"FEE"=>$val["FeeType"]["TITLE"],"FEE_TYPE"=>$val["Fee"]["FEE_TYPE"]) ;

            }
        }


        $total = 0;
        foreach($j as $kk=>$t) {
            $total = $total+$t["AMOUNT"];
        }
        $j["total"] = $total;
        // end unpaid


        $this->set('paid_fees',$paid_fees);
        $this->set('fees',$fees);
        $this->set('unpaid',$j);

    }// end of function

    public function admin_index()
    {
        $this->redirect(array('action' => 'dashboard'));
        $this->layout = 'admin_form_layout';
        $this->paginate = array(
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'User.FIRST_NAME ASC'
        );

        $this->set('users', $this->paginate('User'));
    }

    public function admin_documents()
    {
        $this->layout = 'admin_form_layout';

        $sessionData = $this->Session->read('Auth.Admin');

        $roleID = $sessionData['ROLE_ID'];

        $userId = $sessionData['ID'];

        $user_data = $this->User->find('first',array(
            'contain' => array(),
            'conditions' => array('ID' => $userId),
            'fields' => array('BIRTH_CERTIFICATION','ADDRESS_PROOF','TRANSFER_CERTIFICATION','LC')
        ));

        $this->set('userData', $user_data);

        switch ($roleID) {
            case TEACHER_ID:
                $this->render('admin_teacher_document');
                break;
            case STUDENT_ID:
                $this->render('admin_student_document');
                break;
            case ACCOUNT_ID:
                $this->render('admin_account_document');
                break;
            case SUPERVISOR_ID:
                $this->render('admin_supervisor_document');
                break;
            case HR_ID:
                $this->render('admin_hr_document');
                break;
            case ADMIN_ID:
                $this->render('admin_admin_document');
                break;
            default:
                $this->render('admin_student_document');
        }
    }

    public function admin_profile()
    {
        $sessionData = $this->Session->read('Auth.Admin');

        $this->layout = 'admin_form_layout';

        $this->User->id = $sessionData['ID'];

        $roleID = $sessionData['ROLE_ID'];

        $user = $this->User->read(null, $sessionData['ID']);

        $this->set('user', $user);

        switch ($roleID) {
            case TEACHER_ID:
                $this->render('admin_teacher_profile');
                break;
            case STUDENT_ID:
                $this->render('admin_student_profile');
                break;
            case ACCOUNT_ID:
                $this->render('admin_account_profile');
                break;
            case SUPERVISOR_ID:
                $this->render('admin_supervisor_profile');
                break;
            case HR_ID:
                $this->render('admin_hr_profile');
                break;
            case ADMIN_ID:
                $this->render('admin_profile');
                break;
            default:
                $this->render('admin_add_student');
        }

    }

    public function admin_students()
    {
        $Session = $this->Session->read('Auth.Admin');
        $conditions = array();

        switch($Session["ROLE_ID"]) {
            case STUDENT_ID:
                $conditions['User.ROLE_ID']=STUDENT_ID;
                $conditions['User.CLASS_ID']=$Session["CLASS_ID"];
                break;
            case TEACHER_ID:
                $conditions['User.ROLE_ID']=STUDENT_ID;
                $conditions['User.CLASS_ID']=$Session["CLASS_ID"];
                break;
            default:
                $conditions['ROLE_ID']=STUDENT_ID;
                break;
        }
        if(isset($this->params->query["CLS"])) {
            $conditions["User.CLASS_ID"] = $this->params->query["CLS"];
            $this->request->data["User"]["CLS"] = $this->params->query["CLS"];
        }

        if(isset($this->params->query["data"]["User"]) && is_array($this->params->query["data"]["User"])) {
            $post = $this->params->query["data"]["User"];
            if(isset($post["first_name"]) && $post["first_name"]!='') {
                $conditions['User.FIRST_NAME LIKE'] = '%'.$post["first_name"].'%';
            }
            if(isset($post["last_name"]) && $post["last_name"]!='') {
                $conditions['User.LAST_NAME LIKE'] = '%'.$post["last_name"].'%';
            }
            if(isset($post["email"]) && $post["email"]!='') {
                $conditions['User.EMAIL_ID'] = $post["email"];
            }
            if(isset($post["mobile_no"]) && $post["mobile_no"]!='') {
                $conditions['User.MOBILE_NO'] = $post["mobile_no"];
            }
            if((isset($post["from_date"]) && $post["from_date"]!='') && (isset($post["to_date"]) && $post["to_date"]!='') ) {
                $conditions['User.created BETWEEN ? AND ?'] = array($this->General->datefordb($post["from_date"]),$this->General->datefordb($post["to_date"]));
            }
        }

        $this->layout = 'admin_form_layout';
       $students = $this->User->find('all',array(
            'limit' => PAGINATION_LIMIT_ADMIN,
            'contain' => array('AcademicClass','Medium','BloodGroup','City'),
            'conditions' => $conditions,
            'order' => 'User.FIRST_NAME ASC'
        ));

if(sizeof($students)>0) {
		$this->Session->write('Filter_Students',$students);
		}

        $this->set('users', $students);
        $classes = $this->User->AcademicClass->GetAcademicClasses();
        $this->set('classes', $classes);
    }

    public function admin_supervisors()
    {

        $Session = $this->Session->read('Auth.Admin');
        $conditions = array();

        switch($Session["ROLE_ID"]) {
            case TEACHER_ID:
                $conditions['User.CLASS_ID']=$Session["CLASS_ID"];
                break;
        }
        $conditions['ROLE_ID']=SUPERVISOR_ID;
        $this->layout = 'admin_form_layout';
        $this->paginate = array(
            'limit' => PAGINATION_LIMIT_ADMIN,
            'contain' => array('AcademicClass'),
            'conditions' => $conditions,
            'order' => 'User.FIRST_NAME ASC'
        );

        $this->set('users', $this->paginate('User'));
    }

    public function admin_teachers()
    {
        $Session = $this->Session->read('Auth.Admin');
        $conditions = array();
        switch($Session["ROLE_ID"]) {
            case STUDENT_ID:
                $conditions['User.CLASS_ID']=$Session["CLASS_ID"];
                $conditions['ROLE_ID']=TEACHER_ID;
                break;
            default:
                $conditions['ROLE_ID']=TEACHER_ID;
                break;
        }

        if(isset($this->params->query["data"]["User"]) && is_array($this->params->query["data"]["User"])) {
            $post = $this->params->query["data"]["User"];
            if(isset($post["first_name"]) && $post["first_name"]!='') {
                $conditions['User.FIRST_NAME LIKE'] = '%'.$post["first_name"].'%';
            }
            if(isset($post["last_name"]) && $post["last_name"]!='') {
                $conditions['User.LAST_NAME LIKE'] = '%'.$post["last_name"].'%';
            }
            if(isset($post["email"]) && $post["email"]!='') {
                $conditions['User.EMAIL_ID'] = $post["email"];
            }
            if(isset($post["mobile_no"]) && $post["mobile_no"]!='') {
                $conditions['User.MOBILE_NO'] = $post["mobile_no"];
            }
            if((isset($post["from_date"]) && $post["from_date"]!='') && (isset($post["to_date"]) && $post["to_date"]!='') ) {
                $conditions['User.created BETWEEN ? AND ?'] = array($this->General->datefordb($post["from_date"]),$this->General->datefordb($post["to_date"]));
            }
        }

        $this->layout = 'admin_form_layout';
       $teachers = $this->User->find('all',array(
            'limit' => PAGINATION_LIMIT_ADMIN,
            'contain' => array('AcademicClass'),
            'conditions' => $conditions,
            'order' => 'User.FIRST_NAME ASC'
        ));
	if(sizeof($teachers)>0) {
			$this->Session->write('Filter_Teachers',$teachers);
		}
        $this->set('users', $teachers);
    }

    public function admin_hr()
    {
        $Session = $this->Session->read('Auth.Admin');
        $conditions = array();
        switch($Session["ROLE_ID"]) {
            case HR_ID:
                $conditions['User.ID']=$Session["ID"];
                break;
        }
        $conditions['User.ROLE_ID'] = HR_ID;
        $this->layout = 'admin_form_layout';
        $this->paginate = array(
            'limit' => PAGINATION_LIMIT_ADMIN,
            'contain' => array('AcademicClass'),
            'conditions' => $conditions,
            'order' => 'User.FIRST_NAME ASC'
        );

        $this->set('users', $this->paginate('User'));
    }

    public function admin_add_hr()
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->redirect(array('action' => 'login'));
        }
        if ($this->request->is('post')) {
            $this->User->set($this->request->data);
            if ($this->User->Validation()) {
                $this->User->create();

                $img = '';
                if(isset($this->request->data["User"]["UPLOAD_IMAGE"]["size"]) && $this->request->data["User"]["UPLOAD_IMAGE"]["size"]>0) {
                    $img = $this->request->data["User"]["UPLOAD_IMAGE"];
                    unset($this->request->data["User"]["UPLOAD_IMAGE"]);
                }

                $address = '';
                if(isset($this->request->data["User"]["UPLOAD_ADDRESS"]["size"]) && $this->request->data["User"]["UPLOAD_ADDRESS"]["size"] >0) {
                    $address = $this->request->data["User"]["UPLOAD_ADDRESS"];
                    unset($this->request->data["User"]["UPLOAD_ADDRESS"]);
                }

                $this->request->data['User']['ROLE_ID'] = HR_ID;

                if ($this->User->save($this->request->data)) {

                    $lastid = $this->User->getLastInsertId();

                    $total_user = $this->User->find('count',array(
                        'contain' => array()
                    ));

                    $user_data = $this->User->find('first',array(
                        'contain' => array(),
                        'conditions' => array('ID' => $lastid),
                        'fields' => array('FIRST_NAME')
                    ));

                    $name_letter = $user_data['User']['FIRST_NAME'];

                    $FIRSTLETTER = substr($name_letter, 0, 3);

                    $a = ($total_user+1).rand(0, 99);
                    $username = str_pad($a, 4, '0', STR_PAD_LEFT);
                    $ids = $this->checkUniqueId($username, $total_user);
                    if($ids != 0)
                    {
                        $username = $ids;
                    }

                    $USERNAME = strtoupper($FIRSTLETTER).$username;
                    $this->request->data['User']['USERNAME'] = $USERNAME;
                    $this->send_mail($this->request->data['User']);


                    $this->User->id = $lastid;

                    $this->User->saveField("USERNAME",$USERNAME);

                    if(is_array($img) && $img["size"]>0) {

                        $extension = $img['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname = strtotime(date('Y-m-d H:i:s')).$lastid.'.'.$ext[1];
                        move_uploaded_file($img["tmp_name"],$path.$fname);

                        $im = file_get_contents($path.$fname);
                        $imdata = base64_encode($im);

                        $this->User->id = $lastid;

                        $this->User->saveField("IMAGE_URL",$fname);
                        $this->User->saveField("BASE_CODE",$imdata);
                    }

                    if(is_array($address) && $address["size"]>0) {

                        $extension = $address['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname = 'AP'.strtotime(date('Y-m-d H:i:s')).$lastid.'.'.$ext[1];
                        move_uploaded_file($address["tmp_name"],$path.$fname);

                        $im = file_get_contents($path.$fname);
                        $imdata = base64_encode($im);

                        $this->User->id = $lastid;

                        $this->User->saveField("ADDRESS_PROOF",$fname);
                    }

                    $this->Session->setFlash('HR Added Successfully!', 'message_good');
                    $this->redirect(array('controller'=>"Users",'action' => 'hr'));
                }
                else {
                    $this->Session->setFlash('HR Not Added Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('HR Not Added Please Try Again!', 'message_bad');
            }
        }

        $transport = $this->User->Transport->GetTransport();
        $this->set('transport', $transport);

        $bloodgroups = $this->User->BloodGroup->GetBloodGroups();
        $this->set('bloodgroups', $bloodgroups);

        $country = $this->User->Country->GetCountries();
        $this->set('country', $country);

        $state = $this->User->State->GetStates();
        $this->set('state', $state);

        $cities = $this->User->City->GetCity();
        $this->set('cities', $cities);
    }

    public function admin_edit_hr($id = null)
    {
        $this->layout = 'admin_form_layout';
        $this->User->id = $id;
        if (empty($this->User->id)) {
            $this->Session->setFlash('Invalid user !', 'message_bad');
            $this->redirect(array('action' => 'students'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->Validation()) {
                if (empty($this->request->data['User']['PASSWORD'])) {
                    unset($this->request->data['User']['PASSWORD']);
                }
                $img = '';
                if(isset($this->request->data["User"]["UPLOAD_IMAGE"]["size"]) && $this->request->data["User"]["UPLOAD_IMAGE"]["size"]>0) {
                    $img = $this->request->data["User"]["UPLOAD_IMAGE"];
                    unset($this->request->data["User"]["UPLOAD_IMAGE"]);
                }

                $address = '';
                if(isset($this->request->data["User"]["UPLOAD_ADDRESS"]["size"]) && $this->request->data["User"]["UPLOAD_ADDRESS"]["size"] >0) {
                    $address = $this->request->data["User"]["UPLOAD_ADDRESS"];
                    unset($this->request->data["User"]["UPLOAD_ADDRESS"]);
                }

                if ($this->User->save($this->request->data)) {

                    $UserData = $this->User->find('first', array(
                        'contain' => array(),
                        'conditions' => array('ID' => $id)
                    ));

                    if(is_array($img) && $img["size"]>0) {

                        $extension = $img['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname = strtotime(date('Y-m-d H:i:s')).$id.'.'.$ext[1];
                        move_uploaded_file($img["tmp_name"],$path.$fname);

                        $im = file_get_contents($path.$fname);
                        $imdata = base64_encode($im);

                        $this->User->id = $id;

                        $fileName = $UserData['User']['IMAGE_URL'];

                        if($fileName != '')
                        {
                            $this->General->delete_file("/files/upload_document/".$fileName);
                        }

                        $this->User->saveField("IMAGE_URL",$fname);
                        $this->User->saveField("BASE_CODE",$imdata);
                    }

                    if(is_array($address) && $address["size"]>0) {

                        $extension = $address['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname = 'AP'.strtotime(date('Y-m-d H:i:s')).$id.'.'.$ext[1];
                        move_uploaded_file($address["tmp_name"],$path.$fname);

                        $im = file_get_contents($path.$fname);
                        $imdata = base64_encode($im);


                        $fileName = $UserData['User']['ADDRESS_PROOF'];

                        if($fileName != '')
                        {
                            $this->General->delete_file("/files/upload_document/".$fileName);
                        }

                        $this->User->saveField("ADDRESS_PROOF",$fname);
                    }

                    if ($this->request->data['User']['ID'] === $this->Session->read('Auth.Admin.ID')) {
                        $this->Session->write('Auth.Admin', $this->request->data['User']);
                    }
                    $this->Session->setFlash('HR Updated Successfully!', 'message_good');
                    $this->redirect(array('action' => 'hr'));
                } else {
                    $this->Session->setFlash('HR Not Added Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('HR Not Added Please Try Again!', 'message_bad');
            }
        } else {
            $user = $this->User->read(null, $id);

            if (empty($user)) {
                $this->Session->setFlash('Invalid user !', 'message_bad');
                $this->redirect(array('action' => 'hr'));
            }
            $this->request->data = $user;
            unset($this->request->data['User']['PASSWORD']);
        }

        $transport = $this->User->Transport->GetTransport();
        $this->set('transport', $transport);

        $bloodgroups = $this->User->BloodGroup->GetBloodGroups();
        $this->set('bloodgroups', $bloodgroups);

        $country = $this->User->Country->GetCountries();
        $this->set('country', $country);

        $state = $this->User->State->GetStates();
        $this->set('state', $state);

        $cities = $this->User->City->GetCity();
        $this->set('cities', $cities);

    }

    public function admin_view_hr($id = null)
    {
        $this->layout = 'admin_form_layout';
        $this->User->id = $id;

        if (empty($this->User->id)) {

            $this->Session->setFlash('Invalid user !', 'message_bad');
            $this->redirect(array('action' => 'index'));

        }

        $user = $this->User->read(null, $id);

        if (empty($user)) {
            $this->Session->setFlash('Invalid user !', 'message_bad');
            $this->redirect(array('action' => 'teachers'));
        }
        $this->request->data = $user;




        $bloodgroups = $this->User->BloodGroup->GetBloodGroups();
        $this->set('bloodgroups', $bloodgroups);



        $country = $this->User->Country->GetCountries();
        $this->set('country', $country);

        $state = $this->User->State->GetStates();
        $this->set('state', $state);

        $cities = $this->User->City->GetCity();
        $this->set('cities', $cities);

    }

    public function checkUniqueId($id = null, $no_user)
    {
        $total_User = $this->User->find('count',array(
            'contain' => array(),
            'conditions' => array('User.USERNAME' =>$id),
        ));

        if($total_User == 0)
        {
            return $id;

        } else {
            $a = $no_user.rand(0, 99);
            $username = str_pad($a, 4, '0', STR_PAD_LEFT);
            $new_id = $this->checkUniqueId($username, $no_user);
            return $new_id;
        }
    }

    public function admin_add_student()
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->redirect(array('action' => 'login'));
        }
        if ($this->request->is('post')) {
            $this->User->set($this->request->data);
            if ($this->User->Validation()) {
                $this->User->create();

                $amount = '';
                if(isset($this->request->data["User"]["AMOUNT"]) && $this->request->data["User"]["AMOUNT"] != '') {
                    $amount = $this->request->data["User"]["AMOUNT"];
                    unset($this->request->data["User"]["AMOUNT"]);
                }

                $img = '';
                if(isset($this->request->data["User"]["UPLOAD_IMAGE"]["size"]) && $this->request->data["User"]["UPLOAD_IMAGE"]["size"] >0) {
                    $img = $this->request->data["User"]["UPLOAD_IMAGE"];
                    unset($this->request->data["User"]["UPLOAD_IMAGE"]);
                }

                $birth = '';
                if(isset($this->request->data["User"]["UPLOAD_BIRTH"]["size"]) && $this->request->data["User"]["UPLOAD_BIRTH"]["size"] >0) {
                    $birth = $this->request->data["User"]["UPLOAD_BIRTH"];
                    unset($this->request->data["User"]["UPLOAD_BIRTH"]);
                }

                $address = '';
                if(isset($this->request->data["User"]["UPLOAD_ADDRESS"]["size"]) && $this->request->data["User"]["UPLOAD_ADDRESS"]["size"] >0) {
                    $address = $this->request->data["User"]["UPLOAD_ADDRESS"];
                    unset($this->request->data["User"]["UPLOAD_ADDRESS"]);
                }

                $transfer = '';
                if(isset($this->request->data["User"]["UPLOAD_TRANSFER"]["size"]) && $this->request->data["User"]["UPLOAD_TRANSFER"]["size"] >0) {
                    $transfer = $this->request->data["User"]["UPLOAD_TRANSFER"];
                    unset($this->request->data["User"]["UPLOAD_TRANSFER"]);
                }

                $lc = '';
                if(isset($this->request->data["User"]["UPLOAD_LC"]["size"]) && $this->request->data["User"]["UPLOAD_LC"]["size"] >0) {
                    $lc = $this->request->data["User"]["UPLOAD_LC"];
                    unset($this->request->data["User"]["UPLOAD_LC"]);
                }

                $this->request->data['User']['ROLE_ID'] = STUDENT_ID;

                if ($this->User->save($this->request->data)) {



                    $lastid = $this->User->getLastInsertId();

                    $total_user = $this->User->find('count',array(
                        'contain' => array()
                    ));

                    $user_data = $this->User->find('first',array(
                        'contain' => array('AcademicClass'),
                        'conditions' => array('ID' => $lastid),
                        'fields' => array('FIRST_NAME','CLASS_ID')
                    ));

                    $clName = $user_data['AcademicClass']['CLASS_NAME'];

                    $USERNAME = $this->GenerateStudentCode($first_name,$clName,$total_user);

                    $this->request->data['User']['USERNAME'] = $USERNAME;
                    $this->send_mail($this->request->data['User']);

                    $this->User->id = $lastid;

                    $this->User->saveField("USERNAME",$USERNAME);
                    $this->User->saveField("GR_NO",$USERNAME);
                    $this->User->saveField("UNIQUE_ID_NO",$uniqueId);

                    if(is_array($img) && $img["size"]>0) {

                        $extension = $img['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname = strtotime(date('Y-m-d H:i:s')).$lastid.'.'.$ext[1];
                        move_uploaded_file($img["tmp_name"],$path.$fname);

                        $im = file_get_contents($path.$fname);
                        $imdata = base64_encode($im);

                        $this->User->id = $lastid;

                        $this->User->saveField("IMAGE_URL",$fname);
                        $this->User->saveField("BASE_CODE",$imdata);

                    }

                    if(is_array($birth) && $birth["size"]>0) {

                        $extension = $birth['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname = 'BC'.strtotime(date('Y-m-d H:i:s')).$lastid.'.'.$ext[1];
                        move_uploaded_file($birth["tmp_name"],$path.$fname);

                        $im = file_get_contents($path.$fname);
                        $imdata = base64_encode($im);

                        $this->User->id = $lastid;

                        $this->User->saveField("BIRTH_CERTIFICATION",$fname);
                    }

                    if(is_array($address) && $address["size"]>0) {

                        $extension = $address['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname = 'AP'.strtotime(date('Y-m-d H:i:s')).$lastid.'.'.$ext[1];
                        move_uploaded_file($address["tmp_name"],$path.$fname);

                        $im = file_get_contents($path.$fname);
                        $imdata = base64_encode($im);

                        $this->User->id = $lastid;

                        $this->User->saveField("ADDRESS_PROOF",$fname);
                    }

                    if(is_array($transfer) && $transfer["size"]>0) {

                        $extension = $transfer['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname = 'TC'.strtotime(date('Y-m-d H:i:s')).$lastid.'.'.$ext[1];
                        move_uploaded_file($transfer["tmp_name"],$path.$fname);

                        $im = file_get_contents($path.$fname);
                        $imdata = base64_encode($im);

                        $this->User->id = $lastid;

                        $this->User->saveField("TRANSFER_CERTIFICATION",$fname);
                    }

                    if(is_array($lc) && $lc["size"]>0) {

                        $extension = $lc['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname = 'LC'.strtotime(date('Y-m-d H:i:s')).$lastid.'.'.$ext[1];
                        move_uploaded_file($lc["tmp_name"],$path.$fname);

                        $im = file_get_contents($path.$fname);
                        $imdata = base64_encode($im);

                        $this->User->id = $lastid;

                        $this->User->saveField("LC",$fname);
                    }

                    $this->LedgerXref = ClassRegistry::init('LedgerXref');

                    //$admissionFee = isset($this->request->data["User"]["AMOUNT"])?$this->request->data["User"]["AMOUNT"]:'';

                    $FeeArr['LedgerXref'] = array(
                        'ROLE_ID' => STUDENT_ID,
                        'USER_ID' => $lastid,
                        'FEES_TYPE' => ADMISSION_FEE,
                        'PAYMENT_TERM' => PAYMENT_TYPE,
                        //'AMOUNT' => $amount
                    );

                    $this->LedgerXref->create();
                    $this->LedgerXref->save($FeeArr);
					
					
					/*$first = $this->request->data['FIRST_NAME'];
					$middle = $this->request->data['MIDDLE_NAME'];
					$last = $this->request->data['LAST_NAME'];
					$name = $first.' '.$middle.' '.$last;
					$contact = $this->request->data['MOBILE_NO'];
					$mail = $this->request->data['EMAIL_ID'];
					$class = $this->request->data['CLASS_ID'];
					$ser=1;
					
					$smsArr['sms'] = array(
                        'class' => $name,
                        'name' => $name,
                        'contact_no' => $contact,
                        'mail' => $mail,
                        'source' => $ser
                    );

                   // $this->sms->create();
                    $this->sms->save($smsArr);*/
					

                    $this->Session->setFlash('User Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'students'));
                }
                else {
                    $this->Session->setFlash('User Not Added Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('User Not Added Please Try Again!', 'message_bad');
            }
        }
        $classes = $this->User->AcademicClass->GetAcademicClasses();
        $this->set('classes', $classes);

        $bloodgroups = $this->User->BloodGroup->GetBloodGroups();
        $this->set('bloodgroups', $bloodgroups);

        $mediums = $this->User->Medium->GetMedium();
        $this->set('medium', $mediums);

        $CastCategories = $this->User->CastCategory->GetCastCategories();
        $this->set('CastCategories', $CastCategories);

        $transport = $this->User->Transport->GetTransport();
        $this->set('transport', $transport);

        $country = $this->User->Country->GetCountries();
        $this->set('country', $country);

        $state = $this->User->State->GetStates();
        $this->set('state', $state);

        $cities = $this->User->City->GetCity();
        $this->set('cities', $cities);
    }

    public function admin_edit_student($id = null)
    {
        $this->layout = 'admin_form_layout';
        $this->User->id = $id;
        if (empty($this->User->id)) {
            $this->Session->setFlash('Invalid user !', 'message_bad');
            $this->redirect(array('action' => 'students'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->Validation()) {
                if (empty($this->request->data['User']['PASSWORD'])) {
                    unset($this->request->data['User']['PASSWORD']);
                }
                $img = '';
                if(isset($this->request->data["User"]["UPLOAD_IMAGE"]["size"]) && $this->request->data["User"]["UPLOAD_IMAGE"]["size"] >0) {
                    $img = $this->request->data["User"]["UPLOAD_IMAGE"];
                    unset($this->request->data["User"]["UPLOAD_IMAGE"]);
                }

                $birth = '';
                if(isset($this->request->data["User"]["UPLOAD_BIRTH"]["size"]) && $this->request->data["User"]["UPLOAD_BIRTH"]["size"] >0) {
                    $birth = $this->request->data["User"]["UPLOAD_BIRTH"];
                    unset($this->request->data["User"]["UPLOAD_BIRTH"]);
                }

                $address = '';
                if(isset($this->request->data["User"]["UPLOAD_ADDRESS"]["size"]) && $this->request->data["User"]["UPLOAD_ADDRESS"]["size"] >0) {
                    $address = $this->request->data["User"]["UPLOAD_ADDRESS"];
                    unset($this->request->data["User"]["UPLOAD_ADDRESS"]);
                }

                $transfer = '';
                if(isset($this->request->data["User"]["UPLOAD_TRANSFER"]["size"]) && $this->request->data["User"]["UPLOAD_TRANSFER"]["size"] >0) {
                    $transfer = $this->request->data["User"]["UPLOAD_TRANSFER"];
                    unset($this->request->data["User"]["UPLOAD_TRANSFER"]);
                }

                $lc = '';
                if(isset($this->request->data["User"]["UPLOAD_LC"]["size"]) && $this->request->data["User"]["UPLOAD_LC"]["size"] >0) {
                    $lc = $this->request->data["User"]["UPLOAD_LC"];
                    unset($this->request->data["User"]["UPLOAD_LC"]);
                }

                if ($this->User->save($this->request->data)) {

                    $this->User->id = $id;

                    $UserData = $this->User->find('first', array(
                        'contain' => array(),
                        'conditions' => array('ID' => $id)
                    ));

                    if(is_array($img) && $img["size"]>0) {

                        $extension = $img['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname = strtotime(date('Y-m-d H:i:s')).$id.'.'.$ext[1];
                        move_uploaded_file($img["tmp_name"],$path.$fname);

                        $im = file_get_contents($path.$fname);
                        $imdata = base64_encode($im);

                        $fileName = $UserData['User']['IMAGE_URL'];

                        if($fileName != '')
                        {
                            $this->General->delete_file("/files/upload_document/".$fileName);
                        }

                        $this->User->saveField("IMAGE_URL",$fname);
                        $this->User->saveField("BASE_CODE",$imdata);
                    }

                    if(is_array($birth) && $birth["size"]>0) {

                        $extension = $birth['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname = 'BC'.strtotime(date('Y-m-d H:i:s')).$id.'.'.$ext[1];
                        move_uploaded_file($birth["tmp_name"],$path.$fname);

                        $im = file_get_contents($path.$fname);
                        $imdata = base64_encode($im);

                        $fileName = $UserData['User']['BIRTH_CERTIFICATION'];

                        if($fileName != '')
                        {
                            $this->General->delete_file("/files/upload_document/".$fileName);
                        }

                        $this->User->saveField("BIRTH_CERTIFICATION",$fname);
                    }

                    if(is_array($address) && $address["size"]>0) {

                        $extension = $address['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname = 'AP'.strtotime(date('Y-m-d H:i:s')).$id.'.'.$ext[1];
                        move_uploaded_file($address["tmp_name"],$path.$fname);

                        $im = file_get_contents($path.$fname);
                        $imdata = base64_encode($im);

                        $fileName = $UserData['User']['ADDRESS_PROOF'];

                        if($fileName != '')
                        {
                            $this->General->delete_file("/files/upload_document/".$fileName);
                        }

                        $this->User->saveField("ADDRESS_PROOF",$fname);
                    }

                    if(is_array($transfer) && $transfer["size"]>0) {

                        $extension = $transfer['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname = 'TC'.strtotime(date('Y-m-d H:i:s')).$id.'.'.$ext[1];
                        move_uploaded_file($transfer["tmp_name"],$path.$fname);

                        $im = file_get_contents($path.$fname);
                        $imdata = base64_encode($im);

                        $fileName = $UserData['User']['TRANSFER_CERTIFICATION'];

                        if($fileName != '')
                        {
                            $this->General->delete_file("/files/upload_document/".$fileName);
                        }

                        $this->User->saveField("TRANSFER_CERTIFICATION",$fname);
                    }

                    if(is_array($lc) && $lc["size"]>0) {

                        $extension = $lc['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname = 'LC'.strtotime(date('Y-m-d H:i:s')).$id.'.'.$ext[1];
                        move_uploaded_file($lc["tmp_name"],$path.$fname);

                        $im = file_get_contents($path.$fname);
                        $imdata = base64_encode($im);

                        $fileName = $UserData['User']['TRANSFER_CERTIFICATION'];

                        if($fileName != '')
                        {
                            $this->General->delete_file("/files/upload_document/".$fileName);
                        }

                        $this->User->saveField("LC",$fname);
                    }

                    if ($this->request->data['User']['ID'] === $this->Session->read('Auth.Admin.ID')) {
                        $this->Session->write('Auth.Admin', $this->request->data['User']);
                    }
                    $this->Session->setFlash('User Updated Successfully!', 'message_good');
                    $this->redirect(array('action' => 'students'));
                } else {
                    $this->Session->setFlash('User Not Added Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('User Not Added Please Try Again!', 'message_bad');
            }
        } else {
            $user = $this->User->read(null, $id);

            if (empty($user)) {
                $this->Session->setFlash('Invalid user !', 'message_bad');
                $this->redirect(array('action' => 'students'));
            }
            $this->request->data = $user;
            unset($this->request->data['User']['PASSWORD']);
        }

        $classes = $this->User->AcademicClass->GetAcademicClasses();
        $this->set('classes', $classes);

        $bloodgroups = $this->User->BloodGroup->GetBloodGroups();
        $this->set('bloodgroups', $bloodgroups);

        $mediums = $this->User->Medium->GetMedium();
        $this->set('medium', $mediums);

        $CastCategories = $this->User->CastCategory->GetCastCategories();
        $this->set('CastCategories', $CastCategories);

        $transport = $this->User->Transport->GetTransport();
        $this->set('transport', $transport);

        $country = $this->User->Country->GetCountries();
        $this->set('country', $country);

        $state = $this->User->State->GetStates();
        $this->set('state', $state);

        $cities = $this->User->City->GetCity();
        $this->set('cities', $cities);

    }

    public function admin_view_student($id = null)
    {
        $this->layout = 'admin_form_layout';
        $this->User->id = $id;

        if (empty($this->User->id)) {

            $this->Session->setFlash('Invalid user !', 'message_bad');
            $this->redirect(array('action' => 'students'));

        }

        $user = $this->User->read(null, $id);

        if (empty($user)) {
            $this->Session->setFlash('Invalid user !', 'message_bad');
            $this->redirect(array('action' => 'students'));
        }
        $this->request->data = $user;

        $this->Attendance = ClassRegistry::init('Attendance');
        $attendances =  $this->Attendance->find('all',array(
            "conditions"=>array(
                'Attendance.ID'=>$user['User']["ID"],
                'Attendance.STATUS'=>1
            )
        ));
        $st_attendance = array();
        if(is_array($attendances) && sizeof($attendances)) {
            foreach($attendances as $attendance) {
                $st_attendance[] = array(
                    "id"=>$attendance["Attendance"]["ATTENDANCE_ID"],
                    "title"=>strtolower($attendance["Attendance"]["AVAILABILITY"])=='a'?ABSENT_TEXT:'',
                    "start"=>$attendance["Attendance"]["ATTENDANCE_DATE"],
                    "backgroundColor"=>strtolower($attendance["Attendance"]["AVAILABILITY"])=='a'?ABSENT_COLOR:'');
            }
        }// end of functionis

        $this->Holiday = ClassRegistry::init('Holiday');
        $Holidays = $this->Holiday->find('all',array(
            'conditions'=>array(
                'STATUS'=>1
            )
        ));
        if(is_array($Holidays) && sizeof($Holidays)) {
            foreach($Holidays as $Holiday) {
                $st_attendance[] = array(
                    "id"=>$Holiday["Holiday"]["HOLIDAY_ID"],
                    "title"=>$Holiday["Holiday"]["TITLE"],
                    "description"=>$Holiday["Holiday"]["DESCRIPTION"],
                    "start"=>$Holiday["Holiday"]["START_DATE"],
                    "end"=>$Holiday["Holiday"]["END_DATE"],
                    "backgroundColor"=>HOLIDAY_COLOR);
            }
        }// end of functionis


        $this->set('st_attendance',$st_attendance);

        $classes = $this->User->AcademicClass->GetAcademicClasses();
        $this->set('classes', $classes);

        $bloodgroups = $this->User->BloodGroup->GetBloodGroups();
        $this->set('bloodgroups', $bloodgroups);

        $mediums = $this->User->Medium->GetMedium();
        $this->set('medium', $mediums);

        $country = $this->User->Country->GetCountries();
        $this->set('country', $country);

        $state = $this->User->State->GetStates();
        $this->set('state', $state);

        $cities = $this->User->City->GetCity();
        $this->set('cities', $cities);

    }

    public function admin_add_supervisor()
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->redirect(array('action' => 'login'));
        }
        if ($this->request->is('post')) {
            $this->User->set($this->request->data);
            if ($this->User->Validation()) {
                $this->User->create();

                $img = '';
                if(isset($this->request->data["User"]["UPLOAD_IMAGE"]["size"]) && $this->request->data["User"]["UPLOAD_IMAGE"]["size"]>0) {
                    $img = $this->request->data["User"]["UPLOAD_IMAGE"];
                    unset($this->request->data["User"]["UPLOAD_IMAGE"]);
                }

                $address = '';
                if(isset($this->request->data["User"]["UPLOAD_ADDRESS"]["size"]) && $this->request->data["User"]["UPLOAD_ADDRESS"]["size"] >0) {
                    $address = $this->request->data["User"]["UPLOAD_ADDRESS"];
                    unset($this->request->data["User"]["UPLOAD_ADDRESS"]);
                }

                $this->request->data['User']['ROLE_ID'] = SUPERVISOR_ID;

                if ($this->User->save($this->request->data)) {

                    $lastid = $this->User->getLastInsertId();

                    $total_user = $this->User->find('count',array(
                        'contain' => array()
                    ));

                    $user_data = $this->User->find('first',array(
                        'contain' => array(),
                        'conditions' => array('ID' => $lastid),
                        'fields' => array('FIRST_NAME')
                    ));

                    $name_letter = $user_data['User']['FIRST_NAME'];

                    $FIRSTLETTER = substr($name_letter, 0, 3);

                    $a = ($total_user+1).rand(0, 99);
                    $username = str_pad($a, 4, '0', STR_PAD_LEFT);
                    $ids = $this->checkUniqueId($username, $total_user);
                    if($ids != 0)
                    {
                        $username = $ids;
                    }

                    $USERNAME = strtoupper($FIRSTLETTER).$username;
                    $this->request->data['User']['USERNAME'] = $USERNAME;
                    $this->send_mail($this->request->data['User']);

                    $this->User->id = $lastid;

                    $this->User->saveField("USERNAME",$USERNAME);

                    if(is_array($img) && $img["size"]>0) {

                        $extension = $img['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname = strtotime(date('Y-m-d H:i:s')).$lastid.'.'.$ext[1];
                        move_uploaded_file($img["tmp_name"],$path.$fname);

                        $im = file_get_contents($path.$fname);
                        $imdata = base64_encode($im);

                        $this->User->id = $lastid;

                        $this->User->saveField("IMAGE_URL",$fname);
                        $this->User->saveField("BASE_CODE",$imdata);
                    }

                    if(is_array($address) && $address["size"]>0) {

                        $extension = $address['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname = 'AP'.strtotime(date('Y-m-d H:i:s')).$lastid.'.'.$ext[1];
                        move_uploaded_file($address["tmp_name"],$path.$fname);

                        $im = file_get_contents($path.$fname);
                        $imdata = base64_encode($im);

                        $this->User->id = $lastid;

                        $this->User->saveField("ADDRESS_PROOF",$fname);
                    }

                    $this->Session->setFlash('Supervisor Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'supervisors'));
                }
                else {
                    $this->Session->setFlash('Supervisor Not Added Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Supervisor Not Added Please Try Again!', 'message_bad');
            }
        }
        $classes = $this->User->AcademicClass->GetAcademicClasses();
        $this->set('classes', $classes);

        $bloodgroups = $this->User->BloodGroup->GetBloodGroups();
        $this->set('bloodgroups', $bloodgroups);

        $mediums = $this->User->Medium->GetMedium();
        $this->set('medium', $mediums);

        $transport = $this->User->Transport->GetTransport();
        $this->set('transport', $transport);

        $country = $this->User->Country->GetCountries();
        $this->set('country', $country);

        $state = $this->User->State->GetStates();
        $this->set('state', $state);

        $cities = $this->User->City->GetCity();
        $this->set('cities', $cities);
    }

    public function admin_edit_supervisor($id = null)
    {
        $this->layout = 'admin_form_layout';
        $this->User->id = $id;
        if (empty($this->User->id)) {
            $this->Session->setFlash('Invalid Supervisor !', 'message_bad');
            $this->redirect(array('action' => 'supervisors'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->Validation()) {
                if (empty($this->request->data['User']['PASSWORD'])) {
                    unset($this->request->data['User']['PASSWORD']);
                }
                $img = '';
                if(isset($this->request->data["User"]["UPLOAD_IMAGE"]["size"]) && $this->request->data["User"]["UPLOAD_IMAGE"]["size"]>0) {
                    $img = $this->request->data["User"]["UPLOAD_IMAGE"];
                    unset($this->request->data["User"]["UPLOAD_IMAGE"]);
                }

                $address = '';
                if(isset($this->request->data["User"]["UPLOAD_ADDRESS"]["size"]) && $this->request->data["User"]["UPLOAD_ADDRESS"]["size"] >0) {
                    $address = $this->request->data["User"]["UPLOAD_ADDRESS"];
                    unset($this->request->data["User"]["UPLOAD_ADDRESS"]);
                }

                if ($this->User->save($this->request->data)) {

                    $UserData = $this->User->find('first', array(
                        'contain' => array(),
                        'conditions' => array('ID' => $id)
                    ));

                    if(is_array($img) && $img["size"]>0) {

                        $extension = $img['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname = strtotime(date('Y-m-d H:i:s')).$id.'.'.$ext[1];
                        move_uploaded_file($img["tmp_name"],$path.$fname);

                        $im = file_get_contents($path.$fname);
                        $imdata = base64_encode($im);

                        $this->User->id = $id;

                        $fileName = $UserData['User']['IMAGE_URL'];

                        if($fileName != '')
                        {
                            $this->General->delete_file("/files/upload_document/".$fileName);
                        }

                        $this->User->saveField("IMAGE_URL",$fname);
                        $this->User->saveField("BASE_CODE",$imdata);
                    }

                    if(is_array($address) && $address["size"]>0) {

                        $extension = $address['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname = 'AP'.strtotime(date('Y-m-d H:i:s')).$id.'.'.$ext[1];
                        move_uploaded_file($address["tmp_name"],$path.$fname);

                        $im = file_get_contents($path.$fname);
                        $imdata = base64_encode($im);

                        $fileName = $UserData['User']['ADDRESS_PROOF'];

                        if($fileName != '')
                        {
                            $this->General->delete_file("/files/upload_document/".$fileName);
                        }

                        $this->User->saveField("ADDRESS_PROOF",$fname);
                    }

                    if ($this->request->data['User']['ID'] === $this->Session->read('Auth.Admin.ID')) {
                        $this->Session->write('Auth.Admin', $this->request->data['User']);
                    }
                    $this->Session->setFlash('Supervisor Updated Successfully!', 'message_good');
                    $this->redirect(array('action' => 'supervisors'));
                } else {
                    $this->Session->setFlash('Supervisor Not Added Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Supervisor Not Added Please Try Again!', 'message_bad');
            }
        } else {
            $user = $this->User->read(null, $id);

            if (empty($user)) {
                $this->Session->setFlash('Invalid Supervisor !', 'message_bad');
                $this->redirect(array('action' => 'supervisors'));
            }
            $this->request->data = $user;
            unset($this->request->data['User']['PASSWORD']);
        }

        $classes = $this->User->AcademicClass->GetAcademicClasses();
        $this->set('classes', $classes);

        $bloodgroups = $this->User->BloodGroup->GetBloodGroups();
        $this->set('bloodgroups', $bloodgroups);

        $mediums = $this->User->Medium->GetMedium();
        $this->set('medium', $mediums);

        $transport = $this->User->Transport->GetTransport();
        $this->set('transport', $transport);

        $country = $this->User->Country->GetCountries();
        $this->set('country', $country);

        $state = $this->User->State->GetStates();
        $this->set('state', $state);

        $cities = $this->User->City->GetCity();
        $this->set('cities', $cities);

    }

    public function admin_view_supervisor($id = null)
    {
        $this->layout = 'admin_form_layout';
        $this->User->id = $id;

        if (empty($this->User->id)) {

            $this->Session->setFlash('Invalid supervisor !', 'message_bad');
            $this->redirect(array('action' => 'supervisors'));

        }

        $user = $this->User->read(null, $id);

        if (empty($user)) {
            $this->Session->setFlash('Invalid supervisor !', 'message_bad');
            $this->redirect(array('action' => 'supervisors'));
        }
        $this->request->data = $user;



        $classes = $this->User->AcademicClass->GetAcademicClasses();
        $this->set('classes', $classes);

        $bloodgroups = $this->User->BloodGroup->GetBloodGroups();
        $this->set('bloodgroups', $bloodgroups);

        $mediums = $this->User->Medium->GetMedium();
        $this->set('medium', $mediums);

        $country = $this->User->Country->GetCountries();
        $this->set('country', $country);

        $state = $this->User->State->GetStates();
        $this->set('state', $state);

        $cities = $this->User->City->GetCity();
        $this->set('cities', $cities);

    }

    public function admin_add_teacher()
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->redirect(array('action' => 'login'));
        }
        if ($this->request->is('post')) {
            $this->User->set($this->request->data);
            if ($this->User->Validation()) {
                $this->User->create();

                $img = '';
                if(isset($this->request->data["User"]["UPLOAD_IMAGE"]["size"]) && $this->request->data["User"]["UPLOAD_IMAGE"]["size"]>0) {
                    $img = $this->request->data["User"]["UPLOAD_IMAGE"];
                    unset($this->request->data["User"]["UPLOAD_IMAGE"]);
                }
                $address = '';
                if(isset($this->request->data["User"]["UPLOAD_ADDRESS"]["size"]) && $this->request->data["User"]["UPLOAD_ADDRESS"]["size"] >0) {
                    $address = $this->request->data["User"]["UPLOAD_ADDRESS"];
                    unset($this->request->data["User"]["UPLOAD_ADDRESS"]);
                }

                $this->request->data['User']['ROLE_ID'] = TEACHER_ID;

                if ($this->User->save($this->request->data)) {

                    $lastid = $this->User->getLastInsertId();

                    $total_user = $this->User->find('count',array(
                        'contain' => array()
                    ));

                    $user_data = $this->User->find('first',array(
                        'contain' => array(),
                        'conditions' => array('ID' => $lastid),
                        'fields' => array('FIRST_NAME')
                    ));

                    $USERNAME = $this->GenerateTeacherUser($user_data['User']['FIRST_NAME'],$total_user);

                    $this->request->data['User']['USERNAME'] = $USERNAME;
                    $this->send_mail($this->request->data['User']);

                    $this->User->id = $lastid;

                    $this->User->saveField("USERNAME",$USERNAME);

                    if(is_array($img) && $img["size"]>0) {

                        $extension = $img['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname = strtotime(date('Y-m-d H:i:s')).$lastid.'.'.$ext[1];
                        move_uploaded_file($img["tmp_name"],$path.$fname);

                        $im = file_get_contents($path.$fname);
                        $imdata = base64_encode($im);

                        $this->User->id = $lastid;

                        $this->User->saveField("IMAGE_URL",$fname);
                        $this->User->saveField("BASE_CODE",$imdata);
                    }

                    if(is_array($address) && $address["size"]>0) {

                        $extension = $address['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname = 'AP'.strtotime(date('Y-m-d H:i:s')).$lastid.'.'.$ext[1];
                        move_uploaded_file($address["tmp_name"],$path.$fname);

                        $im = file_get_contents($path.$fname);
                        $imdata = base64_encode($im);

                        $this->User->id = $lastid;

                        $this->User->saveField("ADDRESS_PROOF",$fname);
                    }

                    $this->Session->setFlash('Teacher Added Successfully!', 'message_good');
                    $this->redirect(array('controller'=>"Users",'action' => 'teachers'));
                }
                else {
                    $this->Session->setFlash('Teacher Not Added Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Teacher Not Added Please Try Again!', 'message_bad');
            }
        }
        $classes = $this->User->AcademicClass->GetAcademicClasses();
        $this->set('classes', $classes);

        $bloodgroups = $this->User->BloodGroup->GetBloodGroups();
        $this->set('bloodgroups', $bloodgroups);

        $mediums = $this->User->Medium->GetMedium();
        $this->set('medium', $mediums);

        $subjects = $this->User->Subject->GetSubjects();
        $this->set('subjects', $subjects);

        $transport = $this->User->Transport->GetTransport();
        $this->set('transport', $transport);

        $country = $this->User->Country->GetCountries();
        $this->set('country', $country);

        $state = $this->User->State->GetStates();
        $this->set('state', $state);

        $cities = $this->User->City->GetCity();
        $this->set('cities', $cities);
    }

    public function admin_edit_teacher($id = null)
    {
        $this->layout = 'admin_form_layout';
        $this->User->id = $id;
        if (empty($this->User->id)) {
            $this->Session->setFlash('Invalid user !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->Validation()) {
                if (empty($this->request->data['User']['PASSWORD'])) {
                    unset($this->request->data['User']['PASSWORD']);
                }
                $img = '';
                if(isset($this->request->data["User"]["UPLOAD_IMAGE"]["size"]) && $this->request->data["User"]["UPLOAD_IMAGE"]["size"]>0) {
                    $img = $this->request->data["User"]["UPLOAD_IMAGE"];
                    unset($this->request->data["User"]["UPLOAD_IMAGE"]);
                }
                $address = '';
                if(isset($this->request->data["User"]["UPLOAD_ADDRESS"]["size"]) && $this->request->data["User"]["UPLOAD_ADDRESS"]["size"] >0) {
                    $address = $this->request->data["User"]["UPLOAD_ADDRESS"];
                    unset($this->request->data["User"]["UPLOAD_ADDRESS"]);
                }

                if ($this->User->save($this->request->data)) {

                    $UserData = $this->User->find('first', array(
                        'contain' => array(),
                        'conditions' => array('ID' => $id)
                    ));

                    if(is_array($img) && $img["size"]>0) {

                        $extension = $img['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname = strtotime(date('Y-m-d H:i:s')).$id.'.'.$ext[1];
                        move_uploaded_file($img["tmp_name"],$path.$fname);

                        $im = file_get_contents($path.$fname);
                        $imdata = base64_encode($im);

                        $this->User->id = $id;

                        $fileName = $UserData['User']['IMAGE_URL'];

                        if($fileName != '')
                        {
                            $this->General->delete_file("/files/upload_document/".$fileName);
                        }

                        $this->User->saveField("IMAGE_URL",$fname);
                        $this->User->saveField("BASE_CODE",$imdata);
                    }

                    if(is_array($address) && $address["size"]>0) {

                        $extension = $address['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname = 'AP'.strtotime(date('Y-m-d H:i:s')).$id.'.'.$ext[1];
                        move_uploaded_file($address["tmp_name"],$path.$fname);

                        $im = file_get_contents($path.$fname);
                        $imdata = base64_encode($im);

                        $fileName = $UserData['User']['ADDRESS_PROOF'];

                        if($fileName != '')
                        {
                            $this->General->delete_file("/files/upload_document/".$fileName);
                        }

                        $this->User->saveField("ADDRESS_PROOF",$fname);
                    }

                    if ($this->request->data['User']['ID'] === $this->Session->read('Auth.Admin.ID')) {
                        $this->Session->write('Auth.Admin', $this->request->data['User']);
                    }
                    $this->Session->setFlash('Teacher Updated Successfully!', 'message_good');
                    $this->redirect(array('controller'=>"Users",'action' => 'teachers'));
                } else {
                    $this->Session->setFlash('Teacher Not Added Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Teacher Not Added Please Try Again!', 'message_bad');
            }
        } else {
            $user = $this->User->read(null, $id);

            if (empty($user)) {
                $this->Session->setFlash('Invalid user !', 'message_bad');
                $this->redirect(array('action' => 'teachers'));
            }
            $this->request->data = $user;
            unset($this->request->data['User']['PASSWORD']);
        }

        $classes = $this->User->AcademicClass->GetAcademicClasses();
        $this->set('classes', $classes);

        $bloodgroups = $this->User->BloodGroup->GetBloodGroups();
        $this->set('bloodgroups', $bloodgroups);

        $mediums = $this->User->Medium->GetMedium();
        $this->set('medium', $mediums);

        $subjects = $this->User->Subject->GetSubjects();
        $this->set('subjects', $subjects);

        $transport = $this->User->Transport->GetTransport();
        $this->set('transport', $transport);

        $country = $this->User->Country->GetCountries();
        $this->set('country', $country);

        $state = $this->User->State->GetStates();
        $this->set('state', $state);

        $cities = $this->User->City->GetCity();
        $this->set('cities', $cities);

    }

    public function admin_view_teacher($id = null)
    {
        $this->layout = 'admin_form_layout';
        $this->User->id = $id;

        if (empty($this->User->id)) {

            $this->Session->setFlash('Invalid user !', 'message_bad');
            $this->redirect(array('action' => 'index'));

        }

        $user = $this->User->read(null, $id);

        if (empty($user)) {
            $this->Session->setFlash('Invalid user !', 'message_bad');
            $this->redirect(array('action' => 'teachers'));
        }
        $this->request->data = $user;



        $classes = $this->User->AcademicClass->GetAcademicClasses();
        $this->set('classes', $classes);

        $bloodgroups = $this->User->BloodGroup->GetBloodGroups();
        $this->set('bloodgroups', $bloodgroups);

        $mediums = $this->User->Medium->GetMedium();
        $this->set('medium', $mediums);

        $country = $this->User->Country->GetCountries();
        $this->set('country', $country);

        $state = $this->User->State->GetStates();
        $this->set('state', $state);

        $cities = $this->User->City->GetCity();
        $this->set('cities', $cities);

    }

    public function admin_add()
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');



        if (empty($Session_data)) {
            $this->redirect(array('action' => 'login'));
        }
        if ($this->request->is('post')) {
            $this->request->data['User']['ROLE_ID'];
            $this->User->set($this->request->data);
            if ($this->User->Validation()) {
                $this->User->create();
                if ($this->User->save($this->request->data)) {



                    $this->Session->setFlash('User Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
                else {
                    $this->Session->setFlash('User Not Added Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('User Not Added Please Try Again!', 'message_bad');
            }
        }
        $roles = $this->User->Role->GetRoles();
        $this->set('user_roles', $roles);

        $mediums = $this->User->Medium->GetMedium();
        $this->set('medium', $mediums);

        $country = $this->User->Country->GetCountries();
        $this->set('country', $country);

        $state = $this->User->State->GetStates();
        $this->set('state', $state);
    }

    public function admin_edit($id = null)
    {
        $this->layout = 'admin_form_layout';
        $this->User->id = $id;
        if (empty($this->User->id)) {
            $this->Session->setFlash('Invalid user !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		  

        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->Validation()) {


                if (empty($this->request->data['User']['PASSWORD'])) {
                    unset($this->request->data['User']['PASSWORD']);
                }
				$img = '';
				  if(isset($this->request->data["User"]["UPLOAD_IMAGE"]["size"]) && $this->request->data["User"]["UPLOAD_IMAGE"]["size"]>0) {
				   $img = $this->request->data["User"]["UPLOAD_IMAGE"];
				  unset($this->request->data["User"]["UPLOAD_IMAGE"]);
	}
                
				
				 if(is_array($img) && $img["size"]>0) {

                        $extension = $img['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname = strtotime(date('Y-m-d H:i:s')).$id.'.'.$ext[1];
                        move_uploaded_file($img["tmp_name"],$path.$fname);

                        $im = file_get_contents($path.$fname);
                        $imdata = base64_encode($im);

                        $this->User->id = $id;

                        $fileName = $UserData['User']['IMAGE_URL'];

                        if($fileName != '')
                        {
                            $this->General->delete_file("/files/upload_document/".$fileName);
                        }

                        $this->User->saveField("IMAGE_URL",$fname);
                        $this->User->saveField("BASE_CODE",$imdata);
                    }
				
                if ($this->User->save($this->request->data)) {

                    if ($this->request->data['User']['ID'] === $this->Session->read('Auth.Admin.ID')) {
                        $this->Session->write('Auth.Admin', $this->request->data['User']);
                    }
                    $this->Session->setFlash('User Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('User Not Added Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('User Not Added Please Try Again!', 'message_bad');
            }
        } else {
            $user = $this->User->read(null, $id);

            if (empty($user)) {
                $this->Session->setFlash('Invalid user !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $user;
            unset($this->request->data['User']['PASSWORD']);
        }

        $roles = $this->User->Role->GetRoles();
        $this->set('user_roles', $roles);

        $mediums = $this->User->Medium->GetMedium();
        $this->set('medium', $mediums);

        $country = $this->User->Country->GetCountries();
        $this->set('country', $country);

        $state = $this->User->State->GetStates();
        $this->set('state', $state);

    }

    public function admin_delete($Id = null)
    {
        $this->layout = 'admin_form_layout';
        if (!empty($Id)) {
            if ($this->User->delete($Id, false)) {
                $this->Session->setFlash('User is successfully deleted', 'message_good');
            }
            $this->redirect(array('action' => 'index'));
        } else {
            $this->Session->setFlash('Invalid user', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }

    public function admin_delete_student($Id = null)
    {
        $StudentData = $this->User->find('first', array(
            'contain' => array(),
            'conditions' => array('ID' => $Id)
        ));

        $profile = $StudentData['User']['IMAGE_URL'];
        $birth = $StudentData['User']['BIRTH_CERTIFICATION'];
        $address = $StudentData['User']['ADDRESS_PROOF'];
        $transfer = $StudentData['User']['TRANSFER_CERTIFICATION'];
        $lc = $StudentData['User']['LC'];

        $this->layout = 'admin_form_layout';
        if (!empty($Id)) {
            if ($this->User->delete($Id, false)) {

                if(isset($profile) && !empty($profile))
                {
                    $this->General->delete_file("/files/upload_document/".$profile);
                }
                if(isset($birth) && !empty($birth))
                {
                    $this->General->delete_file("/files/upload_document/".$birth);
                }
                if(isset($address) && !empty($address))
                {
                    $this->General->delete_file("/files/upload_document/".$address);
                }
                if(isset($transfer) && !empty($transfer))
                {
                    $this->General->delete_file("/files/upload_document/".$transfer);
                }
                if(isset($lc) && !empty($lc))
                {
                    $this->General->delete_file("/files/upload_document/".$lc);
                }

                $this->Session->setFlash('User is successfully deleted', 'message_good');
            }
            $this->redirect(array('action' => 'students'));
        } else {
            $this->Session->setFlash('Invalid user', 'message_bad');
            $this->redirect(array('action' => 'students'));
        }

    }

    public function admin_delete_hr($Id = null)
    {
        $hrData = $this->User->find('first', array(
            'contain' => array(),
            'conditions' => array('ID' => $Id)
        ));

        $profile = $hrData['User']['IMAGE_URL'];
        $address = $hrData['User']['ADDRESS_PROOF'];

        $this->layout = 'admin_form_layout';
        if (!empty($Id)) {
            if ($this->User->delete($Id, false)) {

                if(isset($profile) && !empty($profile))
                {
                    $this->General->delete_file("/files/upload_document/".$profile);
                }

                if(isset($address) && !empty($address))
                {
                    $this->General->delete_file("/files/upload_document/".$address);
                }

                $this->Session->setFlash('User is successfully deleted', 'message_good');
            }
            $this->redirect(array('action' => 'hr'));
        } else {
            $this->Session->setFlash('Invalid user', 'message_bad');
            $this->redirect(array('action' => 'hr'));
        }

    }

    public function admin_delete_teacher($Id = null)
    {

        $TeacherData = $this->User->find('first', array(
            'contain' => array(),
            'conditions' => array('ID' => $Id)
        ));

        $profile = $TeacherData['User']['IMAGE_URL'];
        $address = $TeacherData['User']['ADDRESS_PROOF'];


        $this->layout = 'admin_form_layout';
        if (!empty($Id)) {
            if ($this->User->delete($Id, false)) {
                if(isset($profile) && !empty($profile))
                {
                    $this->General->delete_file("/files/upload_document/".$profile);
                }
                if(isset($address) && !empty($address))
                {
                    $this->General->delete_file("/files/upload_document/".$address);
                }

                $this->Session->setFlash('User is successfully deleted', 'message_good');
            }
            $this->redirect(array('action' => 'teachers'));
        } else {
            $this->Session->setFlash('Invalid user', 'message_bad');
            $this->redirect(array('action' => 'teachers'));
        }

    }

    public function admin_delete_supervisor($Id = null)
    {
        $SupervisorData = $this->User->find('first', array(
            'contain' => array(),
            'conditions' => array('ID' => $Id)
        ));

        $profile = $SupervisorData['User']['IMAGE_URL'];

        $address = $SupervisorData['User']['ADDRESS_PROOF'];


        $this->layout = 'admin_form_layout';
        if (!empty($Id)) {
            if ($this->User->delete($Id, false)) {
                if(isset($profile) && !empty($profile))
                {
                    $this->General->delete_file("/files/upload_document/".$profile);
                }

                if(isset($address) && !empty($address))
                {
                    $this->General->delete_file("/files/upload_document/".$address);
                }

                $this->Session->setFlash('User is successfully deleted', 'message_good');
            }
            $this->redirect(array('action' => 'supervisors'));
        } else {
            $this->Session->setFlash('Invalid user', 'message_bad');
            $this->redirect(array('action' => 'supervisors'));
        }

    }

    public function admin_logout()
    {
        $this->layout = 'admin_layout';
        $this->Session->setFlash('You have successfully logout', 'message_good');
        session_destroy();
        $this->redirect($this->Auth->logout());
    }

    public function admin_login()
    {

        $this->layout = 'admin_login_layout';
        $Session_data = $this->Session->read('Auth.Admin');
        if (!empty($Session_data)) {
            $this->Session->setFlash('Invalid User !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
        if ($this->request->is('post')) {
            if ($this->User->Login_Validation()) {

                $record = $this->User->find('first', array('conditions' => array('User.USERNAME' =>
                    $this->request->data['User']['USERNAME'],
                    'User.STATUS' => 1,
                    'User.ROLE_ID =' => $this->request->data['User']['ROLE_ID'],
                    'User.PASSWORD' => Security::hash($this->request->data['User']['PASSWORD'], null, true)),
                    'recursive' => -1));


                $result_array = array();
                if (isset($record['User'])) {
                    $result_array = $record['User'];
                }
                if ($this->Auth->login($result_array)) {

                    $this->Session->setFlash('You have successfully logged in', 'message_good');
                    $this->redirect($this->Auth->redirect());
                    switch(strtolower($result_array["ROLE_ID"])) {
                        case STUDENT_ID:
                            $this->redirect(array("controller"=>"Users","action"=>"view_student",$result_array["ID"]));
                            break;
                        case TEACHER_ID:
                            $this->redirect(array("controller"=>"Users","action"=>"view_teacher",$result_array["ID"]));
                            break;
                        case HR_ID:
                            $this->redirect(array("controller"=>"Users","action"=>"view_hr",$result_array["ID"]));
                            break;
                        case ACCOUNT_ID:
                            $this->redirect(array("controller"=>"Users","action"=>"view_account",$result_array["ID"]));
                            break;
					  case LIBRARY_ID:
                            $this->redirect(array("controller"=>"Users","action"=>"view_account",$result_array["ID"]));
                            break;
				       case TRANSPORTATION_ID:
                            $this->redirect(array("controller"=>"Users","action"=>"view_account",$result_array["ID"]));
                            break;
						case STORE_ID:
                            $this->redirect(array("controller"=>"Users","action"=>"view_account",$result_array["ID"]));
                            break;
						case HOSTEL_ID:
                            $this->redirect(array("controller"=>"Users","action"=>"view_account",$result_array["ID"]));
                            break;
						case CANTEEN_ID:
                            $this->redirect(array("controller"=>"Users","action"=>"view_account",$result_array["ID"]));
                            break;
						case FRONT_ID:
                            $this->redirect(array("controller"=>"Users","action"=>"view_account",$result_array["ID"]));
                            break;
						case SECURITY_ID:
                            $this->redirect(array("controller"=>"Users","action"=>"view_account",$result_array["ID"]));
                            break;
                    }

                } else {
                    $this->Session->setFlash('Invalid username or password, try again', 'message_bad');
                    $this->redirect($this->Auth->redirect());
                }
            } else {
                $this->Session->setFlash('Invalid username or password, try again', 'message_bad');
            }
        }

        $roles = $this->User->Role->GetRoles();
        $this->set('roles', $roles);
    }

    public function admin_reset()
    {
        $this->layout = 'admin_login_layout';
        $Session_data = $this->Session->read('Auth.Admin');
        if (!empty($Session_data)) {
            $this->redirect(array('action' => 'index'));
        }
        if(isset($this->request->params['pass'][0])) {
            if ($this->request->is('post')) {
                $this->User->set($this->request->data);
                if ($this->User->ResetValidation()) {
                    $conditions = array(
                        'User.tokenhash' => $this->request->params['pass'][0],
                        'User.status' => 1
                    );
                    $result = $this->User->find('first', array(
                        'fields' => array('ID'),
                        'conditions' => $conditions
                    ));
                    if (!empty($result)) {
                        $this->User->id = $result['User']['ID'];
                        $this->User->savefield('tokenhash', '');
                        $this->User->savefield('password', $this->request->data['User']['PASSWORD']);
                        $this->Session->setFlash('Your Password Reset Successfully', 'message_good');
                        $this->redirect(array('action' => 'login'));

                    } else {
                        $this->Session->setFlash('Invalid User Id', 'message_bad');
                        $this->redirect(array('action' => 'forgot_password'));
                    }
                } else {
                    $this->Session->setFlash('Please Enter Valid Password', 'message_bad');
                }
            }
        } else {
            $this->Session->setFlash('Invalid User Id', 'message_bad');
            $this->redirect(array('action' => 'forgot_password'));
        }
    }

    public function admin_GetAdmissionFeeByClass()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;
        $class_id = '';

        if(isset($this->request->data['User']['CLASS_ID'])) {
            $class_id = $this->request->data['User']['CLASS_ID'];
        }

        $conditions = array();
        if ($class_id != 0) {
            $conditions = array(
                'CLASS_ID' => $class_id,
                'PAYMENT_TERM' => PAYMENT_TYPE,
                'FEE_TYPE' => ADMISSION_FEE,

            );
        }
        $model = ClassRegistry::init('Fee');
        $FeeByClass = $model->find('first', array(
            'conditions' => $conditions,
            'fields' => array('FEE'),
            'recursive' => -1
        ));

        if (isset($FeeByClass['Fee']))
        {
            echo $FeeByClass['Fee']['FEE'];
            die;
        }
    }

    public function admin_account()
    {
        $Session = $this->Session->read('Auth.Admin');
        $conditions = array();
        switch($Session["ROLE_ID"]) {
            case ACCOUNT_ID:
                $conditions['User.ID']=$Session["ID"];
                break;
        }
        $conditions['User.ROLE_ID'] = ACCOUNT_ID;
        $this->layout = 'admin_form_layout';
        $this->paginate = array(
            'limit' => PAGINATION_LIMIT_ADMIN,
            'contain' => array('AcademicClass'),
            'conditions' => $conditions,
            'order' => 'User.FIRST_NAME ASC'
        );

        $this->set('users', $this->paginate('User'));
    }

    public function admin_add_account()
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->redirect(array('action' => 'login'));
        }
        if ($this->request->is('post')) {
            $this->User->set($this->request->data);
            if ($this->User->Validation()) {
                $this->User->create();

                $img = '';
                if(isset($this->request->data["User"]["UPLOAD_IMAGE"]["size"]) && $this->request->data["User"]["UPLOAD_IMAGE"]["size"]>0) {
                    $img = $this->request->data["User"]["UPLOAD_IMAGE"];
                    unset($this->request->data["User"]["UPLOAD_IMAGE"]);
                }

                $address = '';
                if(isset($this->request->data["User"]["UPLOAD_ADDRESS"]["size"]) && $this->request->data["User"]["UPLOAD_ADDRESS"]["size"] >0) {
                    $address = $this->request->data["User"]["UPLOAD_ADDRESS"];
                    unset($this->request->data["User"]["UPLOAD_ADDRESS"]);
                }

                $this->request->data['User']['ROLE_ID'] = ACCOUNT_ID;

                if ($this->User->save($this->request->data)) {

                    $lastid = $this->User->getLastInsertId();

                    $total_user = $this->User->find('count',array(
                        'contain' => array()
                    ));

                    $user_data = $this->User->find('first',array(
                        'contain' => array(),
                        'conditions' => array('ID' => $lastid),
                        'fields' => array('FIRST_NAME')
                    ));

                    $name_letter = $user_data['User']['FIRST_NAME'];

                    $FIRSTLETTER = substr($name_letter, 0, 3);

                    $a = ($total_user+1).rand(0, 99);
                    $username = str_pad($a, 4, '0', STR_PAD_LEFT);
                    $ids = $this->checkUniqueId($username, $total_user);
                    if($ids != 0)
                    {
                        $username = $ids;
                    }

                    $USERNAME = strtoupper($FIRSTLETTER).$username;
                    $this->request->data['User']['USERNAME'] = $USERNAME;
                    $this->send_mail($this->request->data['User']);


                    $this->User->id = $lastid;

                    $this->User->saveField("USERNAME",$USERNAME);

                    if(is_array($img) && $img["size"]>0) {

                        $extension = $img['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname = strtotime(date('Y-m-d H:i:s')).$lastid.'.'.$ext[1];
                        move_uploaded_file($img["tmp_name"],$path.$fname);

                        $im = file_get_contents($path.$fname);
                        $imdata = base64_encode($im);

                        $this->User->id = $lastid;

                        $this->User->saveField("IMAGE_URL",$fname);
                        $this->User->saveField("BASE_CODE",$imdata);
                    }

                    if(is_array($address) && $address["size"]>0) {

                        $extension = $address['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname = 'AP'.strtotime(date('Y-m-d H:i:s')).$lastid.'.'.$ext[1];
                        move_uploaded_file($address["tmp_name"],$path.$fname);

                        $im = file_get_contents($path.$fname);
                        $imdata = base64_encode($im);

                        $this->User->id = $lastid;

                        $this->User->saveField("ADDRESS_PROOF",$fname);
                    }

                    $this->Session->setFlash('Account Added Successfully!', 'message_good');
                    $this->redirect(array('controller'=>"Users",'action' => 'account'));
                }
                else {
                    $this->Session->setFlash('Account Not Added Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Account Not Added Please Try Again!', 'message_bad');
            }
        }

        $transport = $this->User->Transport->GetTransport();
        $this->set('transport', $transport);

        $bloodgroups = $this->User->BloodGroup->GetBloodGroups();
        $this->set('bloodgroups', $bloodgroups);

        $country = $this->User->Country->GetCountries();
        $this->set('country', $country);

        $state = $this->User->State->GetStates();
        $this->set('state', $state);

        $cities = $this->User->City->GetCity();
        $this->set('cities', $cities);
    }

    public function admin_edit_account($id = null)
    {
        $this->layout = 'admin_form_layout';
        $this->User->id = $id;
        if (empty($this->User->id)) {
            $this->Session->setFlash('Invalid user !', 'message_bad');
            $this->redirect(array('action' => 'students'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->Validation()) {
                if (empty($this->request->data['User']['PASSWORD'])) {
                    unset($this->request->data['User']['PASSWORD']);
                }
                $img = '';
                if(isset($this->request->data["User"]["UPLOAD_IMAGE"]["size"]) && $this->request->data["User"]["UPLOAD_IMAGE"]["size"]>0) {
                    $img = $this->request->data["User"]["UPLOAD_IMAGE"];
                    unset($this->request->data["User"]["UPLOAD_IMAGE"]);
                }

                $address = '';
                if(isset($this->request->data["User"]["UPLOAD_ADDRESS"]["size"]) && $this->request->data["User"]["UPLOAD_ADDRESS"]["size"] >0) {
                    $address = $this->request->data["User"]["UPLOAD_ADDRESS"];
                    unset($this->request->data["User"]["UPLOAD_ADDRESS"]);
                }

                if ($this->User->save($this->request->data)) {

                    $UserData = $this->User->find('first', array(
                        'contain' => array(),
                        'conditions' => array('ID' => $id)
                    ));

                    if(is_array($img) && $img["size"]>0) {

                        $extension = $img['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname = strtotime(date('Y-m-d H:i:s')).$id.'.'.$ext[1];
                        move_uploaded_file($img["tmp_name"],$path.$fname);

                        $im = file_get_contents($path.$fname);
                        $imdata = base64_encode($im);

                        $this->User->id = $id;

                        $fileName = $UserData['User']['IMAGE_URL'];

                        if($fileName != '')
                        {
                            $this->General->delete_file("/files/upload_document/".$fileName);
                        }

                        $this->User->saveField("IMAGE_URL",$fname);
                        $this->User->saveField("BASE_CODE",$imdata);
                    }

                    if(is_array($address) && $address["size"]>0) {

                        $extension = $address['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname = 'AP'.strtotime(date('Y-m-d H:i:s')).$id.'.'.$ext[1];
                        move_uploaded_file($address["tmp_name"],$path.$fname);

                        $im = file_get_contents($path.$fname);
                        $imdata = base64_encode($im);

                        $fileName = $UserData['User']['ADDRESS_PROOF'];

                        if($fileName != '')
                        {
                            $this->General->delete_file("/files/upload_document/".$fileName);
                        }

                        $this->User->saveField("ADDRESS_PROOF",$fname);
                    }

                    if ($this->request->data['User']['ID'] === $this->Session->read('Auth.Admin.ID')) {
                        $this->Session->write('Auth.Admin', $this->request->data['User']);
                    }
                    $this->Session->setFlash('Account Updated Successfully!', 'message_good');
                    $this->redirect(array('action' => 'account'));
                } else {
                    $this->Session->setFlash('Account Not Added Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Account Not Added Please Try Again!', 'message_bad');
            }
        } else {
            $user = $this->User->read(null, $id);

            if (empty($user)) {
                $this->Session->setFlash('Invalid user !', 'message_bad');
                $this->redirect(array('action' => 'account'));
            }
            $this->request->data = $user;
            unset($this->request->data['User']['PASSWORD']);
        }

        $transport = $this->User->Transport->GetTransport();
        $this->set('transport', $transport);

        $bloodgroups = $this->User->BloodGroup->GetBloodGroups();
        $this->set('bloodgroups', $bloodgroups);

        $country = $this->User->Country->GetCountries();
        $this->set('country', $country);

        $state = $this->User->State->GetStates();
        $this->set('state', $state);

        $cities = $this->User->City->GetCity();
        $this->set('cities', $cities);

    }

    public function admin_view_account($id = null)
    {
        $this->layout = 'admin_form_layout';
        $this->User->id = $id;

        if (empty($this->User->id)) {

            $this->Session->setFlash('Invalid user !', 'message_bad');
            $this->redirect(array('action' => 'index'));

        }

        $user = $this->User->read(null, $id);

        if (empty($user)) {
            $this->Session->setFlash('Invalid user !', 'message_bad');
            $this->redirect(array('action' => 'teachers'));
        }
        $this->request->data = $user;

        $bloodgroups = $this->User->BloodGroup->GetBloodGroups();
        $this->set('bloodgroups', $bloodgroups);

        $country = $this->User->Country->GetCountries();
        $this->set('country', $country);

        $state = $this->User->State->GetStates();
        $this->set('state', $state);

        $cities = $this->User->City->GetCity();
        $this->set('cities', $cities);

    }

    public function admin_delete_account($Id = null)
    {
        $AccountData = $this->User->find('first', array(
            'contain' => array(),
            'conditions' => array('ID' => $Id)
        ));

        $profile = $AccountData['User']['IMAGE_URL'];
        $address = $AccountData['User']['ADDRESS_PROOF'];

        $this->layout = 'admin_form_layout';
        if (!empty($Id)) {
            if ($this->User->delete($Id, false)) {
                if(isset($profile) && !empty($profile))
                {
                    $this->General->delete_file("/files/upload_document/".$profile);
                }
                if(isset($address) && !empty($address))
                {
                    $this->General->delete_file("/files/upload_document/".$address);
                }
                $this->Session->setFlash('Account is successfully deleted', 'message_good');
            }
            $this->redirect(array('action' => 'account'));
        } else {
            $this->Session->setFlash('Invalid user', 'message_bad');
            $this->redirect(array('action' => 'account'));
        }

    }

    public function admin_GetFeeByTerms()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;
        $class_id = '';

        if($this->request->is("ajax")) {
            $this->Fee = ClassRegistry::init('Fee');
            $feeamount = $this->Fee->find('first',array(
                'conditions'=>array(
                    'Fee.CLASS_ID'=>$this->request->data["User"]["CLASS_ID"],
                    'Fee.FEE_TYPE'=>$this->request->data["User"]["FEES_TYPE"],
                    'Fee.PAYMENT_TERM'=>$this->request->data["User"]["PAYMENT_TERM"],
                    'Fee.STATUS'=>1,
                )
            ));
            if(is_array($feeamount) && sizeof($feeamount)) {
                echo json_encode(array("status"=>"success","msg"=>number_format($feeamount["Fee"]["FEE"],2)));
            }else{
                echo json_encode(array("status"=>"error","msg"=>"Not mention"));
            }
        }

        die;

    }

    public function admin_view_student_ledger($id = null)
    {
        $this->layout = 'admin_form_layout';
        $this->User->id = $id;
        $Session = $this->Session->read('Auth.Admin');
        if (empty($this->User->id)) {
            $this->Session->setFlash('Invalid user !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        $user = $this->User->read(null, $id);

        if (empty($user)) {
            $this->Session->setFlash('Invalid user !', 'message_bad');
            $this->redirect(array('action' => 'teachers'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->User->set($this->request->data);
            if ($this->User->ledger_validation()) {
                $this->LedgerXref = ClassRegistry::init('LedgerXref');
                $this->LedgerXref->create();
                $this->request->data["LedgerXref"] = $this->request->data["User"];
                $this->request->data["LedgerXref"]["ROLE_ID"]= STUDENT_ID;
                $this->request->data["LedgerXref"]["USER_ID"] = $id;
                if($this->LedgerXref->save($this->request->data)) {

                    $FeeDetails = $this->LedgerXref->find('first',array(
                        'conditions'=>array(
                            'LedgerXref.FEES_TYPE'=>$this->request->data["LedgerXref"]["FEES_TYPE"],
                            'LedgerXref.USER_ID'=>$this->request->data["LedgerXref"]["USER_ID"],
                            'LedgerXref.STATUS'=>1
                        ),
                        'contains'=> array('User','FeeType'),
                        'order'=> 'LEDGER_ID DESC'
                    ));

                    $deviceId = $FeeDetails['User']['DEVICE_ID'];
                    $fullName = $FeeDetails['User']['FIRST_NAME'].' '.$FeeDetails['User']['LAST_NAME'];
                    $feeType = $FeeDetails['FeeType']['TITLE'];
                    $amount = $FeeDetails['LedgerXref']['AMOUNT'];

                    $msg = '';
                    $msg = 'Dear '.$fullName.' your '.$feeType.' of Rs.'.$amount.' has been credited in your school account';

                    $this->General->Send_GCM($msg, $deviceId, 1);

                    $this->Session->setFlash('Student Receipt has been saved successfully.', 'message_good');
                    $this->redirect(array("action"=>"student_ledger"));
                }
            }else{
                $this->Session->setFlash('Fee could not save. Please try again', 'message_bad');
            }
        }

        $this->LedgerXref = ClassRegistry::init('LedgerXref');
        $ledger = $this->LedgerXref->find("all",array(

            'conditions'=>array(
                'USER_ID'=>$user["User"]["ID"]
            ),
        ));

        $this->request->data = $user;
        $this->set('ledgers',$ledger);
        $bloodgroups = $this->User->BloodGroup->GetBloodGroups();
        $this->set('bloodgroups', $bloodgroups);

        $country = $this->User->Country->GetCountries();
        $this->set('country', $country);

        $state = $this->User->State->GetStates();
        $this->set('state', $state);

        $cities = $this->User->City->GetCity();
        $this->set('cities', $cities);

        $this->Fee = ClassRegistry::init('Fee');
        $feeamount = $this->Fee->find('all',array(
            'conditions'=>array(
                'Fee.CLASS_ID'=>$user["User"]["CLASS_ID"],
                'Fee.STATUS'=>1,
                'Fee.FEE_TYPE'=>array(ADMISSION_FEE,ACADEMIC_FEE),
            )
        ));


        if(is_array($feeamount) && sizeof($feeamount)) {
            foreach($feeamount as $k=>$amt) {
                if($amt["Fee"]["FEE_TYPE"] == ADMISSION_FEE) {
                    $this->set('admission_fees',$amt["Fee"]["FEE"]);
                }
                if($amt["Fee"]["FEE_TYPE"] == ACADEMIC_FEE) {
                    $this->set('academic_fees',$amt["Fee"]["FEE"]);
                }
            }
        }

        $this->PaymentType = ClassRegistry::init('PaymentType');
        $payment_terms = $this->PaymentType->getPaymentTerms();

        $this->FeeType = ClassRegistry::init('FeeType');
        $FeeType = $this->FeeType->getFeeTypeForAccounts();

        $this->set('payment_terms',$payment_terms);
        $this->set('fees_types',$FeeType);
        $this->set('CLASS_ID',$user["User"]["CLASS_ID"]);
    }

     public function admin_student_ledger()
    {

        $Session = $this->Session->read('Auth.Admin');
        $conditions = array();

        switch($Session["ROLE_ID"]) {
            case ACCOUNT_ID:
                $conditions['User.ROLE_ID']=STUDENT_ID;
                break;
            case TEACHER_ID:
                $conditions['User.CLASS_ID']=$Session["CLASS_ID"];
                $conditions['User.ROLE_ID']=STUDENT_ID;
                break;
            case STUDENT_ID:
                $conditions['User.ROLE_ID']=STUDENT_ID;
                $conditions['User.ID']=$Session["ID"];
                break;
        }
		$conditions['User.ROLE_ID'] = STUDENT_ID;
        
		$student_conditions["User.ROLE_ID"] = STUDENT_ID;
		if(isset($this->params->query["data"]["User"])) {
			
      	$conditions["User.CLASS_ID"] = $this->params->query["data"]["User"]["CLASS_ID"];
        $message = '';
        $result_array = array();
        $status = false;

        $ClassId = $this->params->query["data"]["User"]['CLASS_ID'];
 	$UserId = (isset($this->params->query["data"]["User"]['USER_ID']) && $this->params->query["data"]["User"]['USER_ID']>0)?$this->params->query["data"]["User"]['USER_ID']:0;
		
	        $this->User = ClassRegistry::init('User');
			$student_conditions[] = array();
			$student_conditions["User.CLASS_ID"] = $ClassId;
			$student_conditions["User.ROLE_ID"] = STUDENT_ID;
			if($UserId >0) {
				$student_conditions["User.ID"] = $UserId;
			}	
			

			$all_students = $this->User->find('all',array(
			'contain'=>array("AcademicClass"),	
			'fields'=>array("User.ID","User.CLASS_ID","User.FIRST_NAME","User.MIDDLE_NAME","User.LAST_NAME","AcademicClass.CLASS_NAME"),
			'conditions'=>$student_conditions,			
		));
		

       
		   $student_ledger = array();
		  
			foreach($all_students as $as) { 
				 $student_ledger[$as["User"]["ID"]] = $this->generate_fees($as["User"]["ID"],$as["User"]["CLASS_ID"]);
			}
			$student_ledger["Students"] = $all_students;
			$student_ledger["report_type"] = $this->params->query["data"]["User"]["STATUS"];
			$this->Session->write("Fee_filtered",$student_ledger);
			

			$selected_students = $this->User->getStudentsByClass($this->params->query["data"]["User"]['CLASS_ID']);
			$selected_students[''] ='All Students';
			$this->set('selected_students',$selected_students);
		}
		
		 $this->LedgerXref = ClassRegistry::init('LedgerXref');
        $this->layout = 'admin_form_layout';
       $users =  $this->LedgerXref->find('all',array(
            'contain' => array('User'=>array('AcademicClass')),
            'conditions' => $student_conditions,
            'order' => 'User.FIRST_NAME ASC'
        ));

        $this->set('users', $users);

        $classes = $this->User->AcademicClass->GetAcademicClasses();
        $this->set('classes', $classes);
		
		$students = array();
		if(isset($this->params->query["data"]["Fee"]["CLASS_ID"])) {
	        
			$students = $this->User->getStudentsByClass($this->params->query["data"]["Fee"]["CLASS_ID"]);
			
		}else{
		$students[''] = "ALL Student";
		$this->set('selected_students',$students);
		}
		$fee_status = array('0'=>"Both",'1'=>"Pending",'2'=>"Received");
		$this->set('fee_status',$fee_status);


    }

    public function admin_attendance_listing()
    {
        $Session = $this->Session->read('Auth.Admin');
        $this->layout = 'admin_form_layout';
        $conditions = array();

        switch($Session["ROLE_ID"]) {
            case STUDENT_ID:
                $conditions['User.ROLE_ID']=STUDENT_ID;
                $conditions['User.CLASS_ID']=$Session["CLASS_ID"];
                break;
            case TEACHER_ID:
            case HR_ID:
                $conditions['User.ROLE_ID']=STUDENT_ID;
                $conditions['User.CLASS_ID']=$Session["CLASS_ID"];
                break;
        }
        $start_date = '';
        $end_date = '';
        if ($this->request->is('post')) {
            $this->User->set($this->request->data);
            if($this->User->attendance_listing_validate()) {

                $start_date = $this->General->datefordb($this->request->data["User"]["START_DATE"]);
                $end_date = $this->General->datefordb($this->request->data["User"]["END_DATE"]);

                if(in_array($Session["ROLE_ID"],array(STUDENT_ID,TEACHER_ID)))
                {
                    $class_id = $Session["CLASS_ID"];
                }
                else
                {
                    $class_id = $this->request->data["User"]["CLASS_ID"];
                }

                $this->Attendance = ClassRegistry::init('Attendance');

                // present students
                $lists = array();
                $lists =  $this->Attendance->find('all',array(
                    'contain'=>array('User'=>"AcademicClass"),
                    'conditions'=>array(
                        'Attendance.ATTENDANCE_DATE between ? and ?' => array($start_date, $end_date),
                        'User.CLASS_ID'=>$class_id,
                        'User.STATUS'=>1,
                        'Attendance.AVAILABILITY'=>'P'
                    ),
                ));
                $presents = array();
                foreach($lists as $list) {
                    if(isset($list["Attendance"]["ATTENDANCE_DATE"])) {
                        if(!in_array($presents,array($list["Attendance"]["ATTENDANCE_DATE"]))) {
                            $presents[$this->General->dateforkey($list["Attendance"]["ATTENDANCE_DATE"])][] = $list["User"]["ID"];
                        }
                    }
                }

                // absent student
                $absentlists = array();
                $absentlists =  $this->Attendance->find('all',array(
                    'contain'=>array('User'=>"AcademicClass"),
                    'conditions'=>array(
                        'Attendance.ATTENDANCE_DATE between ? and ?' => array($start_date, $end_date),
                        'User.CLASS_ID'=>$class_id,
                        'User.STATUS'=>1,
                        'Attendance.AVAILABILITY'=>'A'
                    ),
                ));

                $absents = array();
                foreach($absentlists as $absentlist) {
                    if(isset($absentlist["Attendance"]["ATTENDANCE_DATE"])) {
                        if(!in_array($absents,array($absentlist["Attendance"]["ATTENDANCE_DATE"]))) {
                            $absents[$this->General->dateforkey($absentlist["Attendance"]["ATTENDANCE_DATE"])][] = $absentlist["User"]["ID"];
                        }
                    }
                }

                $totalPresent = 0;
                $totalAbsents = 0;
$session_data = array();
				$session_data["presentlists"] = $lists;
				$session_data["absentlists"] = $absentlists;
            	$this->Session->write('Attendance_session',$session_data);
                if(is_array($presents) && sizeof($presents)) {
                    foreach($presents as $pk=>$pp) {

                        $totalPresent = $totalPresent + count($pp);
                    }
                }
                if(is_array($absents) && sizeof($absents)) {

                    foreach($absents as $ak=>$zz) {
                        $totalAbsents = $totalAbsents + count($zz);
                    }
                }

                $this->set('TotalPresent',$totalPresent);
                $this->set('TotalAbsent',$totalAbsents);

            }else{
                $this->Session->setFlash('You have not selected all required fields. Please fill required fields.', 'message_bad');

            }

        }

        $classes = $this->User->AcademicClass->GetAcademicClasses();
        $this->set('classes', $classes);

    }

    public function GenerateStudentCode($firstname='',$clName='',$total_user) {

        $className = str_replace(' ', '', $clName);
        $c = rand(0, 99);

        $uniqueId = $className.str_pad($c, 3, '0', STR_PAD_LEFT);

        $name_letter = $firstname;

        $FIRSTLETTER = substr($name_letter, 0, 3);

        $a = ($total_user+1).rand(0, 99);
        $username = str_pad($a, 4, '0', STR_PAD_LEFT);
        $ids = $this->checkUniqueId($username, $total_user);

        if($ids != 0)
        {
            $username = $ids;
        }

        $USERNAME = strtoupper($FIRSTLETTER).$username;

        return $USERNAME;
    }

    public function GenerateTeacherUser($name_letter,$total_user) {
        $FIRSTLETTER = substr($name_letter, 0, 3);
        $a = ($total_user+1).rand(0, 99);
        $username = str_pad($a, 4, '0', STR_PAD_LEFT);
        $ids = $this->checkUniqueId($username, $total_user);
        if($ids != 0)
        {
            $username = $ids;
        }

        return strtoupper($FIRSTLETTER).$username;

    }

    public function admin_import() {
        $this->layout = 'admin_form_layout';
        $this->AcademicClass = ClassRegistry::init('AcademicClass');
        $this->Role = ClassRegistry::init('Role');

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->User->set($this->request->data);
            if ($this->User->file_validate()) {
                $file = array();
                if(isset($this->request->data["User"]["IMPORT"])) {
                    $file = $this->request->data["User"]["IMPORT"];
                }
                $name = time().'.'.substr(strrchr($this->request->data['User']['IMPORT']["name"], '.'), 1);
                move_uploaded_file($this->request->data['User']['IMPORT']["tmp_name"], WWW_ROOT . "/files/" . UPLOAD_STUDENT_EXCEL . $name);
                $this->request->data['User']['IMPORT'] = "/files/" .  UPLOAD_STUDENT_EXCEL . $name;

                try {
                    $data = $this->ExcelReader->loadExcelFile(WWW_ROOT. "/files/" .  UPLOAD_STUDENT_EXCEL . $name);
                } catch (Exception $e) {
                    $this->Session->setFlash('Excel not uploaded properly please try again!', 'message_bad');
                    $this->redirect($this->referer());
                }

                if(!empty($data))
                {
                    $tmp_class = $this->AcademicClass->GetAcademicClasses();
                    $classes = array();
                    foreach($tmp_class as $clsk=>$clsv) {
                        $classes[$clsk] = strtolower(preg_replace('/\s+/', '', $clsv));
                    }

                    $this->Medium = ClassRegistry::init('Medium');
                    $tmp_medium = $this->Medium->GetMedium();
                    $medium = array();
                    foreach($tmp_medium as $mdmk=>$mdmv) {
                        $medium[$mdmk] = strtolower(preg_replace('/\s+/', '', $mdmv));
                    }

                    $this->City = ClassRegistry::init('City');
                    $tmp_cities = $this->City->GetCity();
                    $cities = array();
                    foreach($tmp_cities as $cityk=>$cityv) {
                        $cities[$cityk] = strtolower(preg_replace('/\s+/', '', $cityv));
                    }

                    $this->Subject = ClassRegistry::init('Subject');
                    $tmp_subjects = $this->Subject->GetSubjects();
                    $subjects = array();
                    foreach($tmp_subjects as $subjectk=>$subjectv) {
                        $subjects[$subjectk] = strtolower(preg_replace('/\s+/', '', $subjectv));
                    }

                    $pm_id = '';
                    foreach($data as $key=>$rows)
                    {
                        if($key != 0) {
                            if($rows[0]!='') {

                                $class_id = '';
                                $medium_id = '';
                                $city_id= '';
                                $subject_id = '';

                                $total_user = $this->User->find('count',array(
                                    'contain' => array()
                                ));

                                $email = '';

                                switch($this->request->data["User"]["ROLE_ID"]) {
                                    case STUDENT_ID:
                                        if(isset($rows[17]) && !empty($rows[17])) {
                                            $class_id = array_search(strtolower(preg_replace('/\s+/', '', $rows[17])), $classes);;
                                        }

                                        if(isset($rows[18]) && !empty($rows[18])) {
                                            $medium_id = array_search(strtolower(preg_replace('/\s+/', '', $rows[18])), $medium);;
                                        }

                                        $username = $this->GenerateStudentCode($rows[0],$tmp_class[$class_id],$total_user);
                                        if(isset($rows[22]) && !empty($rows[22])) {
                                            $city_id = array_search(strtolower(preg_replace('/\s+/', '', $rows[22])), $cities);
                                        }

                                        $email = $rows[19];
                                        $user_data['User'] = array(
                                            'ROLE_ID' => STUDENT_ID,
                                            'FIRST_NAME' => $rows[0],
                                            'MIDDLE_NAME' => $rows[1],
                                            'LAST_NAME' => $rows[2],
                                            'GENDER' => $rows[3],
                                            'DOB' => $this->General->datefordb($rows[4]),
                                            'BIRTH_PLACE' => $rows[5],
                                            'AGE' => $rows[6],
                                            'FATHER_NAME' => $rows[7],
                                            'FATHER_OCCUPATION' => $rows[8],
                                            'MOTHER_NAME' => $rows[9],
                                            'MOTHER_OCCUPATION' => $rows[10],
                                            'NATIONAL_LANGUAGE' => $rows[12],
                                            'RELIGION' => $rows[13],
                                            'MOTHER_TONGUE' => $rows[14],
                                            'CAST' => $rows[15],
                                            'SUB_CAST' => $rows[16],
                                            'CLASS_ID' => $class_id,
                                            'MEDIUM_ID' => $medium_id,
                                            'EMAIL_ID' => $rows[19],
                                            'CONTACT_NO' => $rows[20],
                                            'MOBILE_NO' => $rows[21],
                                            'COUNTRY_ID' => 1,
                                            'STATE_ID' => 1,
                                            'CITY_ID' => $city_id,
                                            'PINCODE' => $rows[23],
                                            'ADDRESS' => $rows[24],
                                            'SIBLING_NAME' => $rows[25],
                                            'SIBLING_STANDARD' =>$rows[26],
                                            'LAST_SCHOOL_NAME' => $rows[27],
                                            'USERNAME'=> $username,
                                            'PASSWORD'=>$rows[11]

                                        );
                                        break;
                                    case TEACHER_ID:
                                        $email = $rows[9];

                                        if(isset($rows[7]) && !empty($rows[7])) {
                                            $class_id = array_search(strtolower(preg_replace('/\s+/', '', $rows[7])), $classes);;
                                        }
                                        if(isset($rows[8]) && !empty($rows[8])) {
                                            $medium_id = array_search(strtolower(preg_replace('/\s+/', '', $rows[8])), $medium);;
                                        }

                                        $username = $this->GenerateTeacherUser($rows[0],$total_user);

                                        if(isset($rows[15]) && !empty($rows[15])) {
                                            $city_id = array_search(strtolower(preg_replace('/\s+/', '', $rows[15])), $cities);
                                        }
                                        if(isset($rows[10]) && !empty($rows[10])) {
                                            $subject_id = array_search(strtolower(preg_replace('/\s+/', '', $rows[10])), $subjects);
                                        }

                                        $user_data['User'] = array(
                                            'ROLE_ID' => TEACHER_ID,
                                            'FIRST_NAME' => $rows[0],
                                            'MIDDLE_NAME' => $rows[1],
                                            'LAST_NAME' => $rows[2],
                                            'GENDER' => $rows[3],
                                            'DOB' => $this->General->datefordb($rows[4]),
                                            'DOJ' => $this->General->datefordb($rows[12]),
                                            'AGE' => $rows[5],
                                            'CLASS_ID' => $class_id,
                                            'MEDIUM_ID' => $medium_id,
                                            'EMAIL_ID' => $rows[9],
                                            'SUBJECT_ID' => $subject_id,
                                            'CONTACT_NO' => $rows[13],
                                            'MOBILE_NO' => $rows[14],
                                            'COUNTRY_ID' => 1,
                                            'STATE_ID' => 1,
                                            'CITY_ID' => $city_id,
                                            'PINCODE' => $rows[16],
                                            'ADDRESS' => $rows[17],
                                            'USERNAME'=> $username,
                                            'PASSWORD'=>$rows[6],

                                        );

                                        break;

                                }

                               // $count_email = $this->User->find('count',array(
                                 //   'conditions' => array('EMAIL_ID'=>$email)
                                //));

                              //  if($count_email==0) {
                                    $this->User->create();
                                    $this->User->save($user_data);
                             //   }

                            }
                        }

                    }
                    $this->Session->setFlash('You have successfully import users', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Error occurred in import Users', 'message_bad');
                    $this->redirect(array('action' => 'index'));
                }
            }
        }

        $roles = $this->Role->GetRoles();
        $allowed = array(0,STUDENT_ID,TEACHER_ID);
        if(is_array($roles) && sizeof($roles)) {
            foreach($roles as $rk=>$role) {
                if(!in_array($rk,$allowed)) {
                    unset($roles[$rk]);
                }
            }
        }
        $this->set('roles',$roles);

    }

    public function App_Login()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;
        $user_id = '';
        if ($this->request->is('post')) {

            $record = $this->User->find('first',
                array('conditions' => array('User.USERNAME' => $this->request->data['USERNAME'],
                    'User.PASSWORD' => Security::hash($this->request->data['PASSWORD'], null, true),
                    'User.ROLE_ID' => $this->request->data['ROLE_ID']),
                    'User.STATUS' => 1,
                    'contain' => array('AcademicClass','Role','CastCategory','Transport','Medium','Country','State','City','BloodGroup','Subject')));

            //pr($record);die;

            if (isset($record['User'])) {
                $result_array = $record;
                $user_id = $record['User']['ID'];
                $status = true;
                $message = "You have successfully logged in";
            } else {
                $message = 'Invalid Username and Password please try again';
            }
        }
        $response = array(
            'status' => $status,
            'message' => $message,
            'data' => $result_array,
            'user_id' => $user_id,
        );
        echo json_encode($response); die;
    }

    public function App_UserEdit()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;

        $userId = $this->request->data['ID'];

        if(!empty($this->request->data) && $userId != '')
        {

            foreach($this->request->data as $key=>$fields)
            {
                if(strtotime($fields))
                {
                    $this->request->data['User'][$key] = date('Y-m-d', strtotime($fields));
                }
                else
                {
                    $this->request->data['User'][$key] = $fields;
                }
                $this->User->id = $userId;
                $this->User->save($this->request->data);
            }

            if(!empty($this->request->data['BASE_CODE'])) {
                $img_code = $this->request->data['BASE_CODE'];

                $img = str_replace('data:image/png;base64,', '', $img_code);
                $img = str_replace(' ', '+', $img);
                $img_data = base64_decode($img);
                $file = "files/" . UPLOAD_DOCUMENT."image_".rand('99999', '99999999').time().".png";
                file_put_contents($file, $img_data);
                $this->User->id = $userId;

                $UserData = $this->User->find('first', array(
                    'contain' => array(),
                    'conditions' => array('ID' => $userId)
                ));

                $fileName = $UserData['User']['IMAGE_URL'];

                if($fileName != '')
                {
                    $this->General->delete_file("/files/upload_document/".$fileName);
                }

                $this->User->savefield('IMAGE_URL', $file);
            }

            $message = 'Your Profile is update Successfully';
            $status = true;

        }
        else
        {
            $message = 'Opps Something wrong!';
            $status = false;
        }
        $response = array(
            'status' => $status,
            'message' => $message
        );
        echo json_encode($response); die;
    }

    public function App_GetStudentsByRole()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;

        $userRoleId = $this->request->data['ROLE_ID'];
        $classId = $this->request->data['CLASS_ID'];

        $condition = array();

        if(isset($userRoleId) && $userRoleId == TEACHER_ID)
        {
            $condition = array('ROLE_ID' => STUDENT_ID, 'CLASS_ID' => $classId);
            $message = 'Your Teacher(s) Data ';
        }
        if(isset($userRoleId) && $userRoleId == STUDENT_ID)
        {
            $condition = array('ROLE_ID' => STUDENT_ID, 'CLASS_ID' => $classId);
            $message = 'Your Classmate(s) Data ';
        }

        $TempData = $this->User->find('all', array(
            'fields' => array('ID','FIRST_NAME','MIDDLE_NAME','LAST_NAME','BASE_CODE'),
            'contain' => array(),
            'conditions' => $condition
        ));

        $Data = Set::extract('/User/.', $TempData);

        if(!empty($Data))
        {
            $status = true;
        }
        else
        {
            $status = false;
        }
        $response = array(
            'status' => $status,
            'message' => $message,
            'data' => $Data
        );
        echo json_encode($response); die;
    }

    public function App_GetTeachersByRole()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;

        $userRoleId = $this->request->data['ROLE_ID'];
        $classId = $this->request->data['CLASS_ID'];

        $condition = array();

        if(isset($userRoleId) && $userRoleId == TEACHER_ID)
        {
            $condition = array('ROLE_ID' => TEACHER_ID);
            $message = 'Your Teacher(s) Data ';
        }
        if(isset($userRoleId) && $userRoleId == STUDENT_ID)
        {
            $condition = array('ROLE_ID' => TEACHER_ID, 'CLASS_ID' => $classId);
            $message = 'Your Classmate(s) Data ';
        }

        $TempData = $this->User->find('all', array(
            'fields' => array('ID','FIRST_NAME','MIDDLE_NAME','LAST_NAME','BASE_CODE'),
            'contain' => array(),
            'conditions' => $condition
        ));

        $Data = Set::extract('/User/.', $TempData);

        if(!empty($Data))
        {
            $status = true;
        }
        else
        {
            $status = false;
        }
        $response = array(
            'status' => $status,
            'message' => $message,
            'data' => $Data
        );
        echo json_encode($response); die;
    }

    public function App_GetUserInfoByRole()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;

        $userId = $this->request->data['ID'];
        $userRoleId = $this->request->data['ROLE_ID'];

        $field = array();

        if(isset($userId) && !empty($userId))
        {
            if(isset($userRoleId) && $userRoleId == TEACHER_ID)
            {
                $field = array('ID','ROLE_ID','FIRST_NAME','MIDDLE_NAME','LAST_NAME','GENDER','DOB','CLASS_ID','JOINING_DATE','MEDIUM_ID','EMAIL_ID','CONTACT_NO','MOBILE_NO','COUNTRY_ID','STATE_ID','CITY_ID','PINCODE','BLOOD_GROUP_ID','ADDRESS','MARITAL_STATUS','QUALIFICATION','SUBJECT_ID','BASE_CODE');
            }
            if(isset($userRoleId) && $userRoleId == STUDENT_ID)
            {
                $field = array('ID','ROLE_ID','FIRST_NAME','MIDDLE_NAME','LAST_NAME','GENDER','DOB','FATHER_NAME','MOTHER_NAME','GR_NO','CLASS_ID','MEDIUM_ID','EMAIL_ID','CONTACT_NO','MOBILE_NO','COUNTRY_ID','BLOOD_GROUP_ID','STATE_ID','CITY_ID','PINCODE','ADDRESS','BASE_CODE');
            }
        }

        $TempData = $this->User->find('first', array(
            'fields' => $field,
            'contain' => array('Role','Medium','AcademicClass','Country','State','City','BloodGroup','Subject'),
            'conditions' => array('User.ID' => $userId)
        ));

        //$Data = Set::extract('/User/.', $TempData);

        if(!empty($TempData))
        {
            $status = true;
        }
        else
        {
            $status = false;
        }
        $response = array(
            'status' => $status,
            'message' => $message,
            'data' => $TempData
        );
        echo json_encode($response); die;
    }

    public function send_mail($post=array()) {
        $mailing_list = $post['EMAIL_ID'];
        $mg_api = 'key-74be9f4872781161d12408795f411673';
        $mg_version = 'api.mailgun.net/v2/';
        $mg_domain = "sandbox0b14f0410b2a4555920843d785a10b10.mailgun.org";
        $mg_from_email = ADMIN_EMAIL;
        $mg_reply_to_email = ADMIN_EMAIL;
        $mg_message_url = "https://".$mg_version.$mg_domain."/messages";

        $this->Roles = ClassRegistry::init('Role');

        $roles = $this->Roles->GetRoles();

        $role_name = '';
        if(isset($post['ROLE_ID']) && $post['ROLE_ID']>0) {
            $role_name = $roles[$post['ROLE_ID']];
        }

        /////////////////////////////////////

        $message = '<div align="center">
                          <table cellspacing="5" cellpadding="5" border="0" width="600" style="background: none repeat scroll 0% 0% rgb(244, 244, 244); border: 1px solid rgb(102, 102, 102);">
                            <tbody>
                              <tr>
                                <th style="background-color: rgb(204, 204, 204);">Welcome to [WEBSITE_NAME] Thanks for Registering.</th>
                              </tr>
                              <tr>
                                <td valign="top" style="text-align: left;">
                                   <br />
                                   Hello <strong>[FULL_NAME] </strong>,<br />
                                   <br />
                                   You\'ve successfully registered with [WEBSITE_NAME] <br />Here are your Login Details. Please keep them safe.<br />
                                   <br />
                                   Username: <strong>[USERID]</strong><br />
                                   Password: <strong>[PASSWORD]</strong><br />
								   Select Type: <strong>[ROLE_TYPE]</strong><br />
								   
								   <br />
                                   You can login your account by clicking on below link <br />
                                   <a href="[LINK]">Login details </a>
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
            array('[FULL_NAME]', '[USERID]', '[PASSWORD]', '[LINK]', '[URL]', '[WEBSITE_NAME]','[ROLE_TYPE]'),
            array($post['FIRST_NAME'].' '.$post['MIDDLE_NAME'].' '.$post['LAST_NAME'],                            $post['USERNAME'],$post['PASSWORD'],SITE_URL, SITE_URL, WEBSITE_NAME,$role_name), $message);



        $subject = 'Thanks for Registering '.WEBSITE_NAME;

        $postArr = array(
            'from'      => WEBSITE_NAME.' <' . $mg_from_email . '>',
            'to'        => $post['EMAIL_ID'],
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

    }// end of mail

    function in_array_r($array, $field, $find){
        foreach($array as $item){
            if($item[$field] == $find) return true;
        }
        return false;
    }

    public function App_GetUserShortInfo()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;

        $classId = $this->request->data['CLASS_ID'];
        $userRoleId = $this->request->data['ROLE_ID'];

        $field = array();

        if(!empty($classId) && !empty($userRoleId))
        {
            $TempData = $this->User->find('all', array(
                'fields' => array('ID','UNIQUE_ID_NO','FIRST_NAME','MIDDLE_NAME','LAST_NAME'),
                'contain' => array(),
                'conditions' => array('ROLE_ID' => $userRoleId, 'CLASS_ID' => $classId)
            ));

            if(!empty($TempData))
            {
                $status = true;
                $message = 'Available Users';
            }
            else
            {
                $status = false;
                $message = 'No data Available';
            }

            $response = array(
                'status' => $status,
                'message' => $message,
                'data' => $TempData
            );

            echo json_encode($response); die;
        }
        else
        {
            $status = false;
            $message = 'No data Available';

            $response = array(
                'status' => $status,
                'message' => $message,
            );

            echo json_encode($response); die;
        }

    }

    public function update_GCM() {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $status = false;
        if($this->request->is('post') || $this->request->is('put')) {

            $this->User->id = $this->request->data['ID'];
            $this->request->data['User']['DEVICE_ID'] = $this->request->data['DEVICE_ID'];
            if($this->User->save($this->request->data)) {
                $status = true;
            } else {
                $status = false;
            }
        }

        $response = array(
            'status' => $status,
        );

        $this->General->Send_GCM($this->request->data['DEVICE_ID']);
        echo json_encode($response); die;
    }

    public function admin_export_teacher() 
    {
        App::import('Vendor', 'Export', array('file' => 'Export' . DS . '/excel_xml.php'));
        $xls = new Excel_XML('UTF-8', false, 'Applicant Report');

        $report_column = array('First name','Middle Name', 'Last Name', 'Username','Email-ID', 'Class', 'Mobile');
        $lists = $this->Session->read('Filter_Teachers');
        $i = 0;
        foreach($lists as $list) {
            $teachers[0] = $report_column;
            $teachers[$i+1]  = array(
                $list["User"]["FIRST_NAME"],
                $list["User"]["MIDDLE_NAME"],
                $list["User"]["LAST_NAME"],
                $list["User"]["USERNAME"],
                $list["User"]["EMAIL_ID"],
                $list["AcademicClass"]["CLASS_NAME"],
                $list["User"]["MOBILE_NO"],
            );
            $i++;
        }

        $xls->addArray($teachers);
        $xls->generateXML('Teachers_'.date('d-m-Y'));
        $this->Session->delete('Filter_Teachers');
        die;

    }

    public function admin_export_student() 
    {
        App::import('Vendor', 'Export', array('file' => 'Export' . DS . '/excel_xml.php'));
        $xls = new Excel_XML('UTF-8', false, 'Applicant Report');

        $report_column = array('First name','Middle Name',
            'Last Name', 'Username','Email-ID',
            'Class','Medium','Father Name','Mother Name',
            'Blood Group','Date of Birth','Gender','City','Address','Mobile');
        $session_var = 'Filter_Students';
        $lists = $this->Session->read($session_var);
        $i = 0;

        foreach($lists as $list) {
            $students[0] = $report_column;
            $students[$i+1]  = array(
                $list["User"]["FIRST_NAME"],
                $list["User"]["MIDDLE_NAME"],
                $list["User"]["LAST_NAME"],
                $list["User"]["USERNAME"],
                $list["User"]["EMAIL_ID"],
                $list["AcademicClass"]["CLASS_NAME"],
                $list["Medium"]["MEDIUM_NAME"],
                $list["User"]["FATHER_NAME"],
                $list["User"]["MOTHER_NAME"],
                $list["BloodGroup"]["BLOOD_GROUP_NAME"],
                $list["User"]["DOB"],
                $list["User"]["GENDER"],
                $list["City"]["CITY_NAME"],
                $list["User"]["ADDRESS"],
                $list["User"]["MOBILE_NO"],
            );
            $i++;
        }

        $xls->addArray($students);
        $xls->generateXML('Students_'.date('d-m-Y'));
        $this->Session->delete($session_var);
        die;

    }

    public function admin_export_fees() 
    {

        App::import('Vendor', 'Export', array('file' => 'Export' . DS . '/excel_xml.php'));
        $xls = new Excel_XML('UTF-8', false, 'Applicant Report');


        $report_column = array('First name','Middle Name',
            'Last Name', 'Class','Fee Type','Amount','Receive Amount','Pending');
        $session_var = 'Fee_filtered';
        $fees = $this->Session->read($session_var);
        $student = $fees["Students"];
        $fees["Students"] = '';
        $report_type = $fees["report_type"];


        $all[0] = $report_column;
        $j=0;

        foreach($student as $list) {
            foreach($fees as $fkey=>$fvalue) {
                if($fkey==$list['User']["ID"]) {
                    foreach($fvalue as $finalk=>$finalval) { $j++;
                        //echo $report_type;die;
                        switch($report_type) {
                            case 0:
                                $all[$j]  = array(
                                    $list["User"]["FIRST_NAME"],
                                    $list["User"]["MIDDLE_NAME"],
                                    $list["User"]["LAST_NAME"],
                                    $list["AcademicClass"]["CLASS_NAME"],
                                    $finalval["FEE"],
                                    number_format($finalval["TOTAL_FEE"],2),
                                    number_format($finalval["RECEIVE_AMOUNT"],2),
                                    number_format($finalval["PENDING"],2),
                                );

                                break;
                            case 1:
                                if((int)$finalval["PENDING"]>0) {
                                    $all[$j]  = array(
                                        $list["User"]["FIRST_NAME"],
                                        $list["User"]["MIDDLE_NAME"],
                                        $list["User"]["LAST_NAME"],
                                        $list["AcademicClass"]["CLASS_NAME"],
                                        $finalval["FEE"],
                                        number_format($finalval["TOTAL_FEE"],2),
                                        number_format($finalval["RECEIVE_AMOUNT"],2),
                                        number_format($finalval["PENDING"],2),
                                    );
                                }

                                break;
                            case 2:
                                if((int)$finalval["RECEIVE_AMOUNT"]>0) {
                                    $all[$j]  = array(
                                        $list["User"]["FIRST_NAME"],
                                        $list["User"]["MIDDLE_NAME"],
                                        $list["User"]["LAST_NAME"],
                                        $list["AcademicClass"]["CLASS_NAME"],
                                        $finalval["FEE"],
                                        number_format($finalval["TOTAL_FEE"],2),
                                        number_format($finalval["RECEIVE_AMOUNT"],2),
                                        number_format($finalval["PENDING"],2),
                                    );
                                }
                                break;
                        }

                    }
                }
            }
        }

        $xls->addArray($all);
        $xls->generateXML('fee_list_'.date('d-m-Y'));
        //$this->Session->delete($session_var);
        die;


    }// end of functions

    public function admin_attendance_export() 
    {
        App::import('Vendor', 'Export', array('file' => 'Export' . DS . '/excel_xml.php'));
        $xls = new Excel_XML('UTF-8', false, 'Applicant Report');


        $report_column = array('First name','Middle Name',
            'Last Name', 'Attendance Date','Availability','Class Name');
        $session_var = 'Attendance_session';
        $attendace = $this->Session->read($session_var);
        //pr($attendace);die;
        $i = 0;
        $presents = $attendace["presentlists"];

        foreach($presents as $list) {
            $attendance[0] = $report_column;
            $attendance[$i+1]  = array(
                $list["User"]["FIRST_NAME"],
                $list["User"]["MIDDLE_NAME"],
                $list["User"]["LAST_NAME"],
                $list["Attendance"]["ATTENDANCE_DATE"],
                strtolower($list["Attendance"]["AVAILABILITY"])=='p'?PRESENT_TEXT:'',
                $list["User"]["AcademicClass"]["CLASS_NAME"],
            );
            $i++;
        }

        $absents = $attendace["absentlists"];
        foreach($absents as $alist) {
            $attendance[0] = $report_column;
            $attendance[$i+1]  = array(
                $alist["User"]["FIRST_NAME"],
                $alist["User"]["MIDDLE_NAME"],
                $alist["User"]["LAST_NAME"],
                $alist["Attendance"]["ATTENDANCE_DATE"],
                strtolower($alist["Attendance"]["AVAILABILITY"])=='a'?ABSENT_TEXT:'',
                $list["User"]["AcademicClass"]["CLASS_NAME"],
            );
            $i++;
        }

        $xls->addArray($attendance);
        $xls->generateXML('attendance_'.date('d-m-Y'));
        $this->Session->delete($session_var);
        die;




    }// end of functions
	
	    public function App_forgot_password() {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $status = false;
        if($this->request->is('post') || $this->request->is('put')) {
            if(isset($this->request->data['EMAIL_ID']) && !empty($this->request->data['EMAIL_ID'])) {
                $record = $this->User->find('first', array('conditions' => array('User.EMAIL_ID' =>
                    $this->request->data['EMAIL_ID'],
                ),
                    'fields' => array('User.ID', 'User.EMAIL_ID'),
                    'recursive' => -1));
                if(!empty($record)) {
                    $password = $this->General->generate_password(6);
                   // $hash_password = Security::hash($password, null, true);
                    $this->User->id = $record['User']['ID'];
                    if($this->User->savefield('password', $password)) {
                        $data = array(
                            'EMAIL_ID' => $record['User']['EMAIL_ID'],
                            'PASSWORD' => $password
                        );
                        $this->General->shoot_forgot_email($data, 'forgot_email');                        
                        $status = true;
                        $message = 'Please check your email id for new password';
                    } else {
                        $message = 'Password not reset please try again';
                    }
                } else {
                    $message = 'Email ID not found please enter correct one';
                }
            }
        }

        $response = array(
            'status' => $status,
            'message' => $message,
        );
        echo json_encode($response); die;
    }

	public function admin_forgot_password() {
        $this->layout = 'admin_login_layout';        
        $message = '';
        $status = false;
        if($this->request->is('post') || $this->request->is('put')) {
            if(isset($this->request->data['EMAIL_ID']) && !empty($this->request->data['EMAIL_ID'])) {
                $record = $this->User->find('first', array('conditions' => array('User.EMAIL_ID' =>
                    $this->request->data['EMAIL_ID'],
                ),
                    'fields' => array('User.ID', 'User.EMAIL_ID'),
                    'recursive' => -1));
                if(!empty($record)) {
                    $password = $this->General->generate_password(6);
                   // $hash_password = Security::hash($password, null, true);
                    $this->User->id = $record['User']['ID'];
                    if($this->User->savefield('password', $password)) {
                        $data = array(
                            'EMAIL_ID' => $record['User']['EMAIL_ID'],
                            'PASSWORD' => $password
                        );
                        $this->General->shoot_forgot_email($data, 'forgot_email');                        
                        $status = true;
                        $message = 'Please check your email id for new password';
                    } else {
                        $message = 'Password not reset please try again';
                    }
                } else {
                    $message = 'Email ID not found please enter correct one';
                }
            }
        }

    }
}