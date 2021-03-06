<!--<link href="/edusystem\app\webroot\css\edu-main-style.css" rel="stylesheet" type="text/css" />
<link href="/edusystem\app\webroot\css\bootstrap.min" rel="stylesheet" type="text/css" />-->
<link href="<?php echo AWR_CSS_URL; ?>css/edu-main-style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo AWR_CSS_URL; ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />




<!-- BEGIN DASHBOARD STATS -->
        <?php echo $this->Session->flash(); ?>
        
        
         <div class="main-boxs">
            	<div class="left-boxs">
                	    <div class="home-boxas">
 						<div class="flip">SCHOOL INFORMATION<span class="glyphicon glyphicon-menu-down" style="margin-left:10px;" aria-hidden="true"></span></div>

                         <div class="tools">
                <a href="javascript:void(0);" class="collapse">
                </a>
            </div>
						<div  class="panel" align="center" style="display:block;">
                        		<?php if($profile["School"]["LOGO_IMAGE"]!='') {  ?>
							<img src="<?php echo DOWNLOADURL.UPLOAD_DOCUMENT.$profile["School"]["LOGO_IMAGE"]; ?>" height="112" />
						<?php } ?>
                                    <div align="center">
                                    <h1><?php echo $profile["School"]["SCHOOL_NAME"]==''?NOTMENTIONED:$profile["School"]["SCHOOL_NAME"]; ?></h1>					
					<p><span class="fa fa-phone">&nbsp;</span> <?php echo $profile["School"]["MOBILE_NO"]==''?NOTMENTIONED:$profile["School"]["MOBILE_NO"]; ?></p>
					<span>Website: <?php 	echo $profile["School"]["WEBSITE_URL"]==''?NOTMENTIONED:'<a href="http://'.$profile["School"]["WEBSITE_URL"].'" target="_blank">'.$profile["School"]["WEBSITE_URL"].'</a>'; ?> </span>
                        </div>
                        </div>
                    </div>
                    
                        <div class="home-boxas">
 						<div class="bh">MY PROFILE<span class="glyphicon glyphicon-menu-down" style="margin-left:10px;" aria-hidden="true"></span></div>
						<div  class="hb col-xs-12" align="center" style="display:block;">
                        		<div class="col-md-8">
							
                            	<strong>Full Name</strong>
						<address>
							<?php echo $user_info["User"]["FIRST_NAME"].' &nbsp;'.$user_info["User"]["MIDDLE_NAME"].'&nbsp;'.$user_info["User"]["LAST_NAME"]; ?>
						</address>

												<?php if(in_array($user_info["User"]["ROLE_ID"],array(TEACHER_ID,STUDENT_ID))) { ?>
						<strong>Class</strong>
						<address>
							<?php echo $user_info["AcademicClass"]["CLASS_NAME"]; ?>
						</address>
						<strong>Medium</strong>
						<address>
							<?php echo $user_info["Medium"]["MEDIUM_NAME"]; ?>
						</address>
						<?php } ?>
						<strong>Date of Birth</strong>
						<address>
							<?php 
							echo $user_info["User"]["DOB"]; ?>
						</address>
							</div>
							<div class="col-md-4" style="padding:0 !important;">
								<?php if($user_info["User"]["IMAGE_URL"]!='') {  ?>
							<img style="min-height:130px;" src="<?php echo DOWNLOADURL.UPLOAD_DOCUMENT.$user_info["User"]["IMAGE_URL"]; ?>" width="100%" />
								<?php } ?>
							</div>
				</div>
                	</div>
                        
                        <div class="home-boxas">
 						<div class="lb">CIRCULAR<span class="glyphicon glyphicon-menu-down" style="margin-left:10px;" aria-hidden="true"></span></div>
                        <div class="tools">
                            <a href="javascript:void(0);" class="collapse">
                            </a>
                          </div>
						<div  class="bl" align="center" style="display:block;">
                        
                         <div class="form-body">
					<div class="row">
							<div class="col-md-12">
						<div class="scroller" data-always-visible="1" data-rail-visible="0">
								<?php if(is_array($notice_board) && sizeof($notice_board)>0) {  ?>
								<ul class="feeds">
									<?php foreach($notice_board as $notice) { 
									
										?>
									<li>
										<div class="col1">
											<div class="cont">
												<div class="cont-col1">
													<div class="label label-sm label-info">
														<i class="fa fa-check"></i>
													</div>
												</div>
												<div class="cont-col2">
													<div class="desc">
														  <?php	  echo $notice["NoticeBoard"]["NOTICE_TITLE"]; ?>
														   <span class="label label-sm label-success">
														  
														<br />
														By &nbsp; <?php echo $notice["UserFrom"]["FIRST_NAME"].'&nbsp;'.$notice["UserFrom"]["LAST_NAME"]; ?> </span>
														</span>
													</div>
												</div>
											</div>
										</div>
										<div class="col2">
											<div class="date">
												<a href="<?php echo Router::url(array("controller"=>"NoticeBoard","action"=>"view",$notice["NoticeBoard"]["NOTICE_ID"])) ?>" title="View <?php echo  $notice["NoticeBoard"]["NOTICE_TITLE"]?>"><i  class="fa fa-desktop"></i></a>
											</div>
										</div>
									</li>
									<?php } ?>
								</ul>
								<?php } ?>
							</div>
							</div>
                    <!--/row-->
					</div>
                </div>
                        
                       
                        
                        </div>
                    </div>
       
       <?php if(in_array($authUser["ROLE_ID"],array(STUDENT_ID,TEACHER_ID))) {  ?>
        				<div class="home-boxas">
 						<div class="hw">Homework<span class="glyphicon glyphicon-menu-down" style="margin-left:10px;" aria-hidden="true"></span></div>
						<div  class="hmw" align="center" style="padding: 14px; display:block;">
                        <?php if(is_array($hw_list) && sizeof($hw_list)>0) {  ?>
								<ul class="feeds"  style="overflow:scroll; width:257px; height:283px; float:left;">
									<?php foreach($hw_list as $hw) { ?>
									<li>
										<div class="col1">
											<div class="cont">
												
												<div class="cont-col2">
													<div class="desc">
														Submission:  <?php	 echo $hw["Homework"]["DESCRIPTION"]; ?>
														<br />
														   <span class="label label-sm label-warning">
														<?php echo $this->General->dbfordate($hw["Homework"]["SUBMISSION_DATE"]); ?> </span>
															&nbsp;
														   <span class="label label-sm label-success">
														  
														
														By &nbsp; <?php echo $hw["User"]["FIRST_NAME"].'&nbsp;'.$hw["User"]["LAST_NAME"]; ?> </span>&nbsp;
														<span class="label label-sm label-info">
														
														<?php echo $this->General->getStatusOfStudent($hw["HomeworkXref"]); ?> </span>
													</div>
												</div>
											</div>
										</div>
									</li>
									<?php } ?>
								</ul>
								<br />
									<a class="btn red"  href="<?php  echo Router::url(array("controller"=>"Homeworks","action"=>"index"));?>" title="View all Homeworks">View All</a>
								<?php }else{ ?>
<div><strong>No Homework assigned yet..</strong></div>

<?php } ?>
								
                        </div>
                    </div>
                    
                     <?php if(in_array($authUser["ROLE_ID"],array(STUDENT_ID))) {  ?>
                    
           				<div class="home-boxas">
 						<div class="att">Attendance Chart of <?php echo date("F"); ?> Month<span class="glyphicon glyphicon-menu-down" style="margin-left:10px;" aria-hidden="true"></span></div>
                        <div class="tools">
     						<a href="javascript:void(0);" class="collapse">
	    					</a>
						</div>
						<div  class="attn" align="center" style="display:block;">
                        
                        <div class="form-body">
											<?php $TotalPresent = 0;if($TotalPresent>0 || $TotalAbsent>0) {  ?>
											<div class="row">
											
													<div id="jqChart" style="width: 450px; height: 225px;margin-left:10px;">
							</div>
											</div>
							<?php }else{ ?>
								<div><strong>No Attendance found yet...</strong></div>
							<?php } ?>
                            </div>
                        
                        </div>
                    </div>

					
                                                 
                        
                        <?php } } ?>
					</div>
                     
                    <div class="right-boxs">	
						<div class=" dashboard_tiles" style="margin-left:50px;"  >
							<div class="tiles" >
									<?php 
$user_menus = $this->General->subval_sort($user_menus,'name');
if(is_array($user_menus) && sizeof($user_menus)>0) {  ?>
  <div class="home-boxas">
  
 						<!--<div class="lb">PERSONAL PROFILE<span class="glyphicon glyphicon-menu-down" style="margin-left:10px;" aria-hidden="true"></span></div>-->
                        <div class="lb">PERSONAL PROFILE<span style="margin-left:10px;" aria-hidden="true"></span></div>               
										<?php foreach($user_menus as $key=>$menu) {	?>
											<a href="<?php echo $menu["url"]; ?>">
									<div class="tile <?php echo (isset($menu["bgcolor"]) && $menu["bgcolor"]!="")?$menu["bgcolor"]:"bg-red-sunglo"; ?>">
										<div class="tile-body">
											<?php // echo $menu["icon"] ?>
										</div>
								</div></a>	
										
										<?php } ?>
                           </div>
                           <?php } ?>
                           
                           
                           <?php 
$dep = $this->General->subval_sort($department,'name');
if(is_array($dep) && sizeof($dep)>0) {  ?>
  <div class="home-boxas">
  
  <div class="lb">DEPARTMENTS<span style="margin-left:10px;" aria-hidden="true"></span></div>  
                 
										<?php foreach($dep as $key=>$d) {	?>
											<a href="<?php echo $d["url"]; ?>">
									<div class="tile <?php echo (isset($d["bgcolor"]) && $d["bgcolor"]!="")?$d["bgcolor"]:"bg-red-sunglo"; ?>">
										<div class="tile-body">
											<?php // echo $menu["icon"] ?>
										</div>
								</div></a>	
										
										<?php } ?>
                           </div>
                           <?php } ?>	
                           
                           
                            <?php 
$comm = $this->General->subval_sort($com,'name');
if(is_array($comm) && sizeof($comm)>0) {  ?>
  <div class="home-boxas">
  
  <div class="lb">COMMUNICATION<span style="margin-left:10px;" aria-hidden="true"></span></div>  
               
										<?php foreach($com as $key=>$c) {	?>
											<a href="<?php echo $c["url"]; ?>">
									<div class="tile <?php echo (isset($c["bgcolor"]) && $c["bgcolor"]!="")?$c["bgcolor"]:"bg-red-sunglo"; ?>">
										<div class="tile-body">
											<?php // echo $menu["icon"] ?>
										</div>
								</div></a>	
										
										<?php } ?>
                           </div>
                           <?php } ?>	
                           
                             <?php 
$me = $this->General->subval_sort($media,'name');
if(is_array($me) && sizeof($me)>0) {  ?>
  <div class="home-boxas">
  
  <div class="lb">MEDIA<span style="margin-left:10px;" aria-hidden="true"></span></div>  
               
										<?php foreach($me as $key=>$m) {	?>
											<a href="<?php echo $m["url"]; ?>">
									<div class="tile <?php echo (isset($m["bgcolor"]) && $m["bgcolor"]!="")?$m["bgcolor"]:"bg-red-sunglo"; ?>">
										<div class="tile-body">
											<?php // echo $menu["icon"] ?>
										</div>
								</div></a>	
										
										<?php } ?>
                           </div>
                           <?php } ?>	
                          
                           <?php 
$gen = $this->General->subval_sort($general,'name');

if(is_array($gen) && sizeof($gen)>0) {   ?>


  <div class="home-boxas">
  
  <div class="lb">GENERAL SETTINGS<span style="margin-left:10px;" aria-hidden="true"></span></div>  
               
										<?php foreach($gen as $key=>$g) {	?>
											<a href="<?php echo $g["url"]; ?>">
									<div class="tile <?php echo (isset($g["bgcolor"]) && $g["bgcolor"]!="")?$g["bgcolor"]:"bg-red-sunglo"; ?>">
										<div class="tile-body">
											<?php // echo $menu["icon"] ?>
										</div>
								</div></a>	
										
										<?php } ?>
                           </div>
                           <?php } ?>
                           
                             <?php 
$oth = $this->General->subval_sort($other,'name');

if(is_array($oth) && sizeof($oth)>0) {  ?>
  <div class="home-boxas">
  
  <div class="lb">OTHERS<span style="margin-left:10px;" aria-hidden="true"></span></div>  
               
										<?php foreach($oth as $key=>$o) {	?>
											<a href="<?php echo $o["url"]; ?>">
									<div class="tile <?php echo (isset($o["bgcolor"]) && $o["bgcolor"]!="")?$o["bgcolor"]:"bg-red-sunglo"; ?>">
										<div class="tile-body">
											<?php // echo $menu["icon"] ?>
										</div>
								</div></a>	
										
										<?php } ?>
                           </div>
                           <?php } ?>		

                           
                         
								</div>
							</div>
                            </div>
                     
                      </div>		
						
	
   
</div>
<script>

  $(document).ready(function(){
  if($(".dashboard_tiles").length>0) {
  $(".dashboard_tiles").animate({
  right: "50",
  },1000);
  }

  <?php if(in_array($authUser["ROLE_ID"],array(STUDENT_ID,TEACHER_ID))) {  ?>

  <?php if($TotalPresent>0 || $TotalAbsent>0) {  ?>
  var background = {
  type: 'linearGradient',
  x0: 0,
  y0: 0,
  x1: 0,
  y1: 1,
  colorStops: [{ offset: 0, color: '#fff' },
  { offset: 1, color: 'white' }]
  };

  $('#jqChart').jqChart({
  title: { text: '' },
  legend: { title: 'Students' },
  border: { strokeStyle: '#fff' },
  background: background,
  animation: { duration: 1 },
  shadows: {
  enabled: false
  },
  series: [
  {
  type: 'pie',
  fillStyles: ['<?php echo PRESENT_COLOR; ?>', '<?php echo ABSENT_COLOR; ?>' ],
  labels: {
  stringFormat: '%.1f%%',
  valueType: 'percentage',
  font: '15px sans-serif',
  fillStyle: 'white'
  },
  explodedRadius: 10,
  explodedSlices: [5],
  data: [['<?php echo PRESENT_TEXT  ?>', '<?php echo $TotalPresent; ?>'], ['<?php echo ABSENT_TEXT  ?>', '<?php echo $TotalAbsent; ?>']]
  }
  ]
  });

  <?php } } ?>
  });
</script>
<script>


$(document).ready(function(){
    $(".flip").click(function(){
        $(".panel").slideToggle("slow");
    });
});
$(document).ready(function(){
    $(".hw").click(function(){
        $(".hmw").slideToggle("slow");
    });
});

$(document).ready(function(){
    $(".bh").click(function(){
        $(".hb").slideToggle("slow");
    });
});
$(document).ready(function(){
    $(".lb").click(function(){
        $(".bl").slideToggle("slow");
    });
});
$(document).ready(function(){
    $(".att").click(function(){
        $(".attn").slideToggle("slow");
    });
});

</script>