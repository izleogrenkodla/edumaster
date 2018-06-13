<?php
/**
 * Requests collector.
 *
 *  This file collects requests if:
 *	- no mod_rewrite is available or .htaccess files are not supported
 *  - requires App.baseUrl to be uncommented in app/Config/core.php
 *	- app/webroot is not set as a document root.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

/**
 *  Get CakePHP's root directory
 */
define('APP_DIR', 'app');
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));
define('WEBROOT_DIR', 'webroot');
define('WWW_ROOT', ROOT . DS . APP_DIR . DS . WEBROOT_DIR . DS);

/**
 * This only needs to be changed if the "cake" directory is located
 * outside of the distributed structure.
 * Full path to the directory containing "cake". Do not add trailing directory separator
 */
if (!defined('CAKE_CORE_INCLUDE_PATH')) {
	define('CAKE_CORE_INCLUDE_PATH', ROOT . DS . 'lib');
}

//require APP_DIR . DS . WEBROOT_DIR . DS . 'index.php';


$link = mysql_connect('localhost','root','admin'); 
if (!$link) { 
	die('Could not connect to MySQL: ' . mysql_error()); 
} 

// make foo the current db
$db_selected = mysql_select_db('samrat_edumaster', $link);
if (!$db_selected) {
    die ('Can\'t use foo : ' . mysql_error());
}

$sql = 'SELECT *
        FROM school';
$retval = mysql_query( $sql, $link );
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}
while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
{
    /*echo "School ID :{$row['SCHOOL_ID']}  <br> ".
         "Title: {$row['SCHOOL_NAME']} <br> ".
		 "Tagline: {$row['SCHOOL_TAGLINE']} <br> ".
         "Logo: {$row['LOGO_IMAGE']} <br> ".
         "Address : {$row['ADDRESS']} <br> ".
		 "Address Image: {$row['ADDRESS_IMAGE']} <br> ".
		 "Brochure: {$row['BROCHURE']} <br> ".
		 "Phone No: {$row['PHONE_NO']} <br> ".
		 "Mobile No: {$row['MOBILE_NO']} <br> ".
		 "Fax: {$row['FAX']} <br> ".
		 "Email: {$row['EMAIL']} <br> ".
		 "Website URL: {$row['WEBSITE_URL']} <br> ".
		 "Status: {$row['STATUS']} <br> ".
         "--------------------------------<br>";*/
         
      $SCHOOL_NAME=$row['SCHOOL_NAME'];
      $SCHOOL_TAGLINE=$row['SCHOOL_TAGLINE'];
		  $SCHOOL_LOGO_IMAGE=$row['LOGO_IMAGE'];
      $SCHOOL_ADDRESS=$row['ADDRESS'];   
      $ADDRESS_IMAGE=$row['ADDRESS_IMAGE'];
      $BROCHURE=$row['BROCHURE'];
		  $PHONE_NO=$row['PHONE_NO'];
		  $MOBILE_NO=$row['MOBILE_NO'];
      $FAX=$row['FAX'];
      $EMAIL=$row['EMAIL'];
      $WEBSITE_URL=$row['WEBSITE_URL'];
      $STATUS=$row['STATUS'];
		 		 
} 

//echo 'Connection OK';
mysql_close($link); 

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head runat="server">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />



    <title><?php echo $SCHOOL_NAME; ?></title>

	<script src="js/jquery-2.1.3.min.js" type="text/javascript"></script>
    <script src="js/modernizr.mi.js" type="text/javascript"></script>
    <script src="js/jquery.min.js"  type="text/javascript" ></script>
    <script src="js/modernizr.js"type="text/javascript" ></script>
    <script src="js/template.js" type="text/javascript" ></script>

    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
      <link href="css/in-style-back1.css" rel="stylesheet" type="text/css" />
      <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
      <link href="css/Copy.css" rel="stylesheet" type="text/css" />
      <link href="css/animations.css" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" href="fonts/font-gurukulsindia.min.css">

    

</head>

  <body class="background-fixed" style="background:url(\image/gdg.png); background-attachment:fixed;  background-position:fixed; background-size:contain;">
      
	 

      <header style=" //height: 0;" class="header fixed clearfix col-xs-12">

        <div class="col-sm-3 col-xs-12" align="left">
			 <a href="http://192.168.2.10:501/edusystem_samrat/user_list.php"> <img src="http://192.168.2.10:501/edusystem_samrat/app/webroot/files/upload_document/<?php echo $SCHOOL_LOGO_IMAGE; ?>" width="124" height="124" />
			</a></div>
				<div class="name-shools">
				<h4 style="display:none;"><?php echo $SCHOOL_TAGLINE; ?></h4>
				<h1 style="font-weight:bold; text-align:center; color:#476186; //position:fixed; float:left; //border-bottom:4px solid #00bdff; padding:4px 0;"><?php echo $SCHOOL_NAME; ?></h1>
				<!--<div class="" style=""><img src="\image/banner-gdg.jpg"></div>-->
				<h4 style="display:none;"><?php echo $SCHOOL_TAGLINE; ?></h4>


			  </div>
		</header>

	   <script>
          $(document).ready(function () {
          var touch = $('#resp-menu');
          var menu = $('.menu');

          $(touch).on('click', function (e) {
          e.preventDefault();
          menu.slideToggle();
          });

          $(window).resize(function () {
          var w = $(window).width();
          if (w > 767 && menu.is(':hidden')) {
          menu.removeAttr('style');
          }
          });

          });
        </script>
        <script type="text/javascript">

          var _gaq = _gaq || [];
          _gaq.push(['_setAccount', 'UA-36251023-1']);
          _gaq.push(['_setDomainName', 'jqueryscript.net']);
          _gaq.push(['_trackPageview']);

          (function () {
          var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
          ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
          var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
          })();

        </script>

      





      <div class="page-infoe" align="center">

        <div class="back-page-infoe" style="padding-top:30px;">



          <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

          <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	 <style>
  .modal-dialog {
    margin: 7% auto;
    width: 70% !important;
}
  </style>	  



          <div class="" style="background:rgba(255, 255, 255, 0.8); width:100%; height:auto; float:left; padding:20px;">

            <div class="col-xs-12">
              <div class="box-home">
                <div class="fa fa-envelope-o scaver"></div>
                <div style="padding:10px;">E-MAIL</div>
              </div>
              <div class="box-home">
                <div class="fa fa-comments-o scaver"></div>
                <div style="padding:10px;">CHAT</div>
              </div>
              <div class="box-home">
                <div class="fa fa-star-half-o scaver"></div>
                <div style="padding:10px;">RATE THIS</div>
              </div>
              <div class="box-home">
                <div class="fa fa-share-alt scaver"></div>
                <div style="padding:10px;">SHARE</div>
              </div>


            </div>

            <div class="tabs-box-main col-xs-12 col-sm-12" style="background:#476186;">
              <ul class=" may-menu nav-tabs" style="border:none; padding:0;">
                <li class="active font-back-tion">
                  <a href="#menu1">HOME</a>
                </li>
                <li class=" font-back-tion">
                  <a href="#menu2">FACILITIES</a>
                </li>
                <li class=" font-back-tion">
                  <a href="#menu3"> ADMISSION</a>
                </li>
                <li class=" font-back-tion">
                  <a href="#menu4">GALLERY</a>
                </li>
                <li class=" font-back-tion">
                  <a href="#menu5">NEWS & UPDATES</a>
                </li>
                <li class=" font-back-tion">
                  <a href="#menu6">CAREER</a>
                </li>
                <li class=" font-back-tion">
                  <a href="#menu7">CONTACT US</a>
                </li>
              </ul>
            </div>

            <form id="Form1" style="margin:20px 0 !important; width:100%; background:#fff; padding:35px; border:3px solid #476186; float:left;"  name="form1" ma runat="server" method="post">
              <div class="tabs-box-main col-xs-12">
                <div class="tab-content">
                  <div id="menu1" class="tab-pane fade in active">
                    <h3 style="text-align:left;font-size:36px; font-weight:bold; margin-bottom:40px;">Welcome to <?php echo $SCHOOL_NAME; ?></h3>
                    <div class="col-xs-12 col-sm-5">
                      <div class="img-box-main">
                        <img src="http://192.168.2.10:501/edusystem_samrat/app/webroot/files/upload_document/<?php echo $SCHOOL_LOGO_IMAGE; ?>" width="100%" height="100%" />
                      </div>
                    </div>
                    <div class="text-box-home col-xs-12 col-sm-7">
					<p class="text-p">Samrat Vidyalaya managed by SHRI Saurashtra Sadvichar Education Trust was established in the year 2001 with few students.</p>
					  <p class="text-p">The vision which was visualized by the Trustees and educationist Shri Chhaganbhai Diyora have transformed to reality with great hard work and dedication. It has grown bigger and better since then. Today thousands of students are learning and growing under its shades.</p>
                      <p class="text-p">As the new century begins our singular challenge is to prepare our students for leadership roles in a rapidly changing and developing world. The education of the individual, in addition to promoting his own innate abilities, would attempt to develop in him a sense of responsibility for his fellowmen in place of the glorification of power and success in our present society</p>	
                    </div>


                  </div>
                  <div id="menu2" class="tab-pane fade">
                    <div id="effect-3" class="effects clearfix">


                      <div class="img wi-stop">
                        <img src="image/back2.gif" width="100%" alt="">
                          <div class="overlay" style="background:rgba(0,0,0,0.7);">
                            <h5 style="color:#FFF;letter-spacing: 1.5px; line-height: 41px;  padding-top: 45px;">Transportation</h5>
                          </div>

                        </div>
						<div class="img wi-stop">
                        <img src="image/back1.gif" width="100%" alt="">
                          <div class="overlay" style="background:rgba(0,0,0,0.7);">
                            <h5 style="color:#FFF;letter-spacing: 1.5px; line-height: 41px;  padding-top: 45px;">Events</h5>
                          </div>

                        </div>

                      <script>
                        $(document).ready(function () {
                        if (Modernizr.touch) {
                        // show the close overlay button
                        $(".close-overlay").removeClass("hidden");
                        // handle the adding of hover class when clicked
                        $(".img").click(function (e) {
                        if (!$(this).hasClass("hover")) {
                        $(this).addClass("hover");
                        }
                        });
                        // handle the closing of the overlay
                        $(".close-overlay").click(function (e) {
                        e.preventDefault();
                        e.stopPropagation();
                        if ($(this).closest(".img").hasClass("hover")) {
                        $(this).closest(".img").removeClass("hover");
                        }
                        });
                        } else {
                        // handle the mouseenter functionality
                        $(".img").mouseenter(function () {
                        $(this).addClass("hover");
                        })
                        // handle the mouseleave functionality
                        .mouseleave(function () {
                        $(this).removeClass("hover");
                        });
                        }
                        });
                      </script>
                    </div>
                    
                  </div>


                  <div id="menu3" class="tab-pane fade">
                    <div class="bond-menu-three">


                      <h1 style=" color: #999; margin-bottom: 36px; width:90%; margin-top: 0; padding: 0 !important;text-align: left;width: 96%;">Admission Inquiry Form </h1>

                      <div style="text-align:left; margin:10px 0 5px 0;">Standard</div>
                      <select style="width:100%; height:40px; border:1px solid #999;">
                      </select>
                      <asp:ScriptManager ID="ScriptManager1" runat="server"></asp:ScriptManager>
                      <div style="text-align:left; margin:10px 0 5px 0;">Child Name</div>
                      <input style="width:100%; height:40px; border:1px solid #999;">
                        </asp:TextBox>

                        <div style="text-align:left; margin:10px 0 5px 0;">Date of birth</div>
                        <input style="width:100%; height:40px; border:1px solid #999;" />
                        <ajaxToolkit:CalendarExtender ID="CalendarExtender1" runat="server" TargetControlID="txtDOB" />


                        <div style="text-align:left; margin:10px 0 5px 0;">Father's name</div>
                        <input style="width:100%; height:40px; border:1px solid #999;" />

                        <div style="text-align:left; margin:10px 0 5px 0;">Contact No</div>
                        <input style="width:100%; height:40px; border:1px solid #999;" />

                        <div style="text-align:left; margin:10px 0 5px 0;">Email</div>
                        <input style="width:100%; height:40px; border:1px solid #999;" />

                        <div style="text-align:left; margin:10px 0 5px 0;">Address</div>
                        <input style="width:100%; height:40px; border:1px solid #999;" />

                        <div style="text-align:left; margin:10px 0 5px 0;">Discription</div>
                        <input style="width:100%; height:40px; border:1px solid #999;" />

                        <button class="butio" type="submit"  Text="Submit" >Submit</button>
                      </div>
                  </div>

                  
				  <div id="menu4" class="tab-pane fade">
                    <div class="bot-with ban-sado" style="margin-right:6px;">
                      <h3 class="ban-sado" style="background:#24323C;color:#fff; font-weight:bold;">photo gallery</h3>
                      <div class="ban-sado bod-to" data-toggle="modal" data-target="#bhumit" style="height: 224px; width: 100%; overflow: hidden; margin: 10px 0px; padding: 0px ! important; border: 10px solid rgb(255, 255, 255);">
                        <img src="image/child1.jpg" width="100%" height="100%" />
                      </div>
					  <div class="modal fade" id="bhumit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    
<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">

    <li data-target="#myCarousel" data-slide-to="1" class="active></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
    <li data-target="#myCarousel" data-slide-to="3"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
   

    <div class="item active">
      <img src="image/child1.jpg" width="100%" hegiht="100%" alt="">
    </div>

    <div class="item">
      <img src="image/child-slide-2.jpg" width="100%" hegiht="100%" alt="">
    </div>

    <div class="item">
      <img src="image/child-slide-3.jpg" width="100%" hegiht="100%" alt="">
    </div>
	 <div class="item">
      <img src="image/child-slide-4.jpg" width="100%" hegiht="100%" alt="">
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
        
      
    
  </div>
</div>
					   <div class="ban-sado bod-to" data-toggle="modal" data-target="#bg" style="height: 224px; width: 100%;  overflow: hidden; margin: 10px 0px; padding: 0px ! important; border: 10px solid rgb(255, 255, 255);">
                        <img src="image/child2.jpg" width="100%" height="100%; " />
                      </div>
	<div class="modal fade" id="bg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    
<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">

    <li data-target="#myCarousel" data-slide-to="1" class="active></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
    <li data-target="#myCarousel" data-slide-to="3"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
   

    <div class="item active">
      <img src="image/child2.jpg" width="100%" hegiht="100%" alt="">
    </div>

    <div class="item">
      <img src="image/child2.jpg" width="100%" hegiht="100%" alt="">
    </div>

    <div class="item">
      <img src="image/child2.jpg" width="100%" hegiht="100%" alt="">
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
        
      
    
  </div>
</div>

                    </div>
                    <div class="bot-with ban-sado" style="margin-left:6px;">
                      <h3 class="ban-sado" style="background:#24323C;color:#fff; font-weight:bold;">video gallery</h3>
                      <div class="ban-sado bod-to"style="height: 224px; width: 100%; overflow: hidden; margin: 10px 0px; padding: 0px ! important; border: 10px solid rgb(255, 255, 255);">
                        <video src="image/video1.mp4" height="100%" width="100%" type="video/mp4"/ preload="auto" controls></video>
                      </div>

                      <div class="ban-sado bod-to" style="height: 224px; width: 100%; overflow: hidden; margin: 10px 0px; padding: 0px ! important; border: 10px solid rgb(255, 255, 255);;">
                        <video src="image/video2.mp4" height="100%" width="100%" type="video/mp4"/ preload="auto" controls></video>
                      </div>

                    </div>
                  </div>

                  <div id="menu5" style="text-align:left;" class="tab-pane fade">
                    <h3>News & Updates</h3>
                    <p>1. Exam Schedule will be provided soon.</p>
					<p>2. Sports Events will be started soon.</p>
					<p>3. Picnic Details will be provided soon.</p>
                  </div>

                  <div id="menu6" class="tab-pane fade">

                    <div class="bot-with ban-sado" style="margin-right:12px;">
                      <h3 class="ban-sado" style="background:#24323C;color:#fff; font-weight:bold;">Available Vacancies</h3>
                      <div style="overflow:scroll; text-align: left; width:100%; height:500px; float:left;">

                        <h3>Post : </h3>
                        <h4>catagory : </h4>
                        <h4>Qualification :</h4>
                        <h4>Details :</h4>

                      </div>
                    </div>

                    <div class="bot-with ban-sado" style="margin-left:12px;">
                      <h3 class="ban-sado" style="background:#24323C;color:#fff; font-weight:bold;">Career</h3>
                      <div style="text-align:left; margin:10px 0 5px 0;">Apply For</div>
                      <input  style="width:100%; height:40px; border:1px solid #999;" />


                      <div style="text-align:left; margin:10px 0 5px 0;">Name</div>
                      <input  style="width:100%; height:40px; border:1px solid #999;" />

                      <div style="text-align:left; margin:10px 0 5px 0;">Contact No</div>
                      <input  style="width:100%; height:40px; border:1px solid #999;" />

                      <div style="text-align:left; margin:10px 0 5px 0;">Email</div>
                      <input  style="width:100%; height:40px; border:1px solid #999;" />

                      <div style="text-align:left; margin:10px 0 5px 0;">Discription*</div>
                      <input  style="width:100%; height:40px; border:1px solid #999;" />

                      <div style="text-align:left; margin:10px 0 5px 0;">Resume</div>
                      <input  style="width:100%; height:40px; border:1px solid #999;" />

                      <button type="button" class="butio" Text="Submit">Submit</button>
                    </div>
                  </div>

                  <div id="menu7"  class="tab-pane fade">
                    <h1 style="color:#000; text-align:left;">Contact Us</h1>

                    <h5 style="color:#000; text-align:left;">Name : <?php echo $SCHOOL_NAME;?></h5>
                    <h5 style="color:#000; text-align:left;">Address : <?php echo $SCHOOL_ADDRESS;?></h5>
                    <h5 style="color:#000; text-align:left;">Email : <?php echo $EMAIL;?></h5>
                    <h5 style="color:#000; text-align:left;">Mobile : <?php echo $MOBILE_NO;?></h5>

                  </div>
                </div>


              </div>
            </form>

            <script>
              $(document).ready(function () {
              $(".nav-tabs a").click(function () {
              $(this).tab('show');
              });
              $('.nav-tabs a').on('shown.bs.tab', function (event) {
              var x = $(event.target).text();         // active tab
              var y = $(event.relatedTarget).text();  // previous tab
              $(".act span").text(x);
              $(".prev span").text(y);
              });
              });
            </script>
          </div>
        </div>


        <div class="foot-home-lab" style="width:100%; background:#000; float:left; color:#ffff; margin:30px 0;padding:15px;">
          <div class="container">
            <div class="col-xs-12 col-sm-6">
              <div class="school-name"><?php echo $SCHOOL_NAME;?></div>
              <div class="school-adre">
                <i class="fa fa-map-marker" style="float:left; font-size:24px; color:#9908CF; margin:0 10px 0 15px;"></i>
                <div class="col-xs-8"><?php echo $SCHOOL_ADDRESS;?></div>
              </div>
            </div>
            <div class="col-xs-6" style="border-left:2px solid #9908cf">
              <div class="col-xs-12 col-sm-6" style="margin-top:20px;">
                <img src="image/easybzeelogo.png" width="100%" height="100%" class="col-xs-9" />
               
              </div>
              <div class="col-xs-12 col-sm-6" style="margin-top:20px;">
               
                <img src="image/edu master logo.png" width="100%" height="100%" class="col-xs-9" />
              </div>

            </div>
          </div>
        </div>




      </div>


	  

    </body>
</html>

