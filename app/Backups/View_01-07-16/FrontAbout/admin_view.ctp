<?php 

foreach($front as $f){
    $school = $f['FrontAbout']['SCHOOL_NAME'];
    $cno = $f['FrontAbout']['CONTACT_NO'];
    $email = $f['FrontAbout']['EMAIL'];
    $add = $f['FrontAbout']['ADDRESS'];
    $content = $f['FrontAbout']['CONTENT'];


}
?><div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN STYLE CUSTOMIZER -->
        <?php // echo $this->element('theme_customizer'); ?>
        <!-- END STYLE CUSTOMIZER -->
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="#">Home</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="#">About</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="#">View About</a>
                    </li>
                </ul>
                <?php echo $this->Session->flash(); ?>
                <?php echo $this->Session->flash('auth'); ?>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">

                <div class="portlet box blue-madison">
                    <div class="portlet-title">
                        <div class="caption">
                            <span aria-hidden="true" class="icon-user"></span> View About
                        </div>
                        <div class="tools">
                            <a href="javascript:void(0);" class="collapse">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <?php echo $this->Form->create('FrontAbout', array('class' => 'form-horizontal add', 'id' => 'Roles','type' => 'file')); ?>
                       
                    <div class="form-body" >
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">School Name
                                        </label>
                                        <div class="col-md-9 tooltips">
                                          <?php  echo $school; ?>
                                        </div>
                                        
                                    </div>
                                </div>
							</div>
							
							<div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Logo
                                        </label>
                                        <div class="col-md-9 tooltips">
                                          <?php
													if(isset($f["FrontAbout"]["LOGO"]) && $f["FrontAbout"]["LOGO"]!='') {
														$img = $f["FrontAbout"]["LOGO"];
														$path = SITE_URL . 'files/upload_document/'.$img;
														?>
														<div style="float:left;width:500px;">
															<img src="<?php echo $path ?>"  width="150" height="130" />
														</div>
													<?php } ?>
                                        </div>
                                        
                                    </div>
                                </div>
								
								 <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Photo 1
                                        </label>
                                        <div class="col-md-9 tooltips">
                                         <?php
													if(isset($f["FrontAbout"]["PHOTO1"]) && $f["FrontAbout"]["PHOTO1"]!='') {
														$img = $f["FrontAbout"]["PHOTO1"];
														$path = SITE_URL . 'files/upload_document/'.$img;
														?>
														<div style="float:left;width:500px;">
															<img src="<?php echo $path ?>"  width="150" height="130" />
														</div>
													<?php } ?>
                                        </div>
                                        
                                    </div>
                                </div>
							</div>
							
							<div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Photo 2
                                        </label>
                                        <div class="col-md-9 tooltips">
                                         <?php
													if(isset($f["FrontAbout"]["PHOTO2"]) && $f["FrontAbout"]["PHOTO2"]!='') {
														$img = $f["FrontAbout"]["PHOTO2"];
														$path = SITE_URL . 'files/upload_document/'.$img;
														?>
														<div style="float:left;width:500px;">
															<img src="<?php echo $path ?>"  width="150" height="130" />
														</div>
													<?php } ?>
                                        </div>
                                        
                                    </div>
                                </div>
								
								 <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Photo 3
                                        </label>
                                        <div class="col-md-9 tooltips">
                                         <?php
													if(isset($f["FrontAbout"]["PHOTO3"]) && $f["FrontAbout"]["PHOTO3"]!='') {
														$img = $f["FrontAbout"]["PHOTO3"];
														$path = SITE_URL . 'files/upload_document/'.$img;
														?>
														<div style="float:left;width:500px;">
															<img src="<?php echo $path ?>"  width="150" height="130" />
														</div>
													<?php } ?>
                                        </div>
                                        
                                    </div>
                                </div>
							</div>
						
						
						<div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Content
                                        </label>
                                        <div class="col-md-9 tooltips">
                                          <?php  echo $content; ?>
                                        </div>
                                        
                                    </div>
                                </div>
								 <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Contact No:
                                        </label>
                                        <div class="col-md-9 tooltips">
                                          <?php  echo $cno; ?>
                                        </div>
                                    </div>
                                </div>
                        </div>
                            <div class="row">
								
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Address:
                                        </label>
                                        <div class="col-md-9 tooltips">
                                          <?php echo $add; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Email:
                                        </label>
                                        <div class="col-md-9 tooltips">
                                          <?php echo $email; ?>
                                        </div>
                                    </div>
                                </div>
							</div>
							
						
						<div class="row">
					   <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Facebook Link
                                </label>
                                 <div class="col-md-9 tooltips">
                                    <?php  echo $f['FrontAbout']['FACEBOOK_LINK'];  ?>
                                </div>
                               
                            </div>
                        </div>

                       <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Youtube Link
                                </label>
                               <div class="col-md-9 tooltips">
                                   <?php echo $f['FrontAbout']['YOUTUBE_LINK'];  ?>
                                </div>
                            </div>
                        </div>
					</div>
					
					<div class="row">
					   <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Twitter Link
                                </label>
                                 <div class="col-md-9 tooltips">
                                   <?php echo $f['FrontAbout']['TWITTER_LINK'];?>
                                </div>
                               
                            </div>
                        </div>

                       <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Google <b>+</b>
                                </label>
                               <div class="col-md-9 tooltips">
								<?php echo $f['FrontAbout']['GOOGLE_LINK']; ?>
                                    
                                </div>
                            </div>
                        </div>
					</div>
                        <div class="form-actions fluid">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="button" class="btn default" onclick="window.history.back();">Back</button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                </div>
                            </div>
                        </div>
                        </form>
                        <!-- END FORM-->
                    </div>
                </div>

            </div>
        </div>
        <!-- END PAGE CONTENT-->
    </div>
</div>