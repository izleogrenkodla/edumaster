<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN STYLE CUSTOMIZER -->
        <?php // echo $this->element('theme_customizer'); ?>
        <!-- END STYLE CUSTOMIZER -->
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <ul class="page-breadcrumb breadcrumb">
                    <!--<li class="btn-group">
                        <button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
                            <span>Actions</span><i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li>
                                <a href="<?php echo Router::url(array('controller' => 'School', 'action' => 'index')) ?>">View All School</a>
                            </li>
                            <li>
                                <a href="<?php echo Router::url(array('controller' => 'School', 'action' => 'add')) ?>">Add New School</a>
                            </li>
                        </ul>
                    </li>-->
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="#">Home</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="#">School</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="#">Edit School</a>
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
                            <span aria-hidden="true" class="icon-user"></span>&nbsp; Edit School Information
                        </div>
                        <div class="tools">
                            <a href="javascript:void(0);" class="collapse">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <?php echo $this->Form->create('School', array('class' => 'form-horizontal add', 'id' => 'Roles','type' => 'file')); ?>
                        <?php echo $this->Form->input("SCHOOL_ID", array('type' => 'hidden', 'label' => false, 'div' => false)) ?>
                        <div class="form-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">School Name<span class="required">
										* </span>
                                        </label>
                                        <div class="col-md-9 tooltips">
                                            <?php echo $this->Form->input('SCHOOL_NAME', array('type' => 'text', 'label' => FALSE_VALUE,
                                                'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control','Placeholder' => 'Example :- XYZ')); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">School Tag Line<span class="required">
										* </span>
                                        </label>
                                        <div class="col-md-9 tooltips">
                                            <?php echo $this->Form->input('SCHOOL_TAGLINE', array('type' => 'text', 'label' => FALSE_VALUE,
                                                'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control','Placeholder' => 'Example :- High School')); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Upload Logo</label>
                                        <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                             data-html='true' data-original-title="Upload Profile Photo">
                                            <?php echo $this->Form->input('UPLOAD_LOGO', array('type' => 'file', 'label' => FALSE_VALUE,
                                                'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control')); ?>
<?php echo $this->General->uploadfilenotes(); ?>
                                        </div>
                                    </div>

                                    <?php
                                    if(isset($this->request->data["School"]["LOGO_IMAGE"]) && $this->request->data["School"]["LOGO_IMAGE"]!='') {
                                        $img = $this->request->data["School"]["LOGO_IMAGE"];
                                        $path = SITE_URL . 'files/upload_document/'.$img;
                                        ?>
                                        <div style="float:left;width:500px;">
                                            <img src="<?php echo $path ?>"  width="100" />
                                        </div>
                                    <?php } ?>

                                </div>



                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Upload Brochure</label>
                                        <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                             data-html='true' data-original-title="Upload Profile Photo">
                                            <?php echo $this->Form->input('UPLOAD_BROCHURE', array('type' => 'file', 'label' => FALSE_VALUE,
                                                'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control')); ?>
                                             <strong>Allowed Size in kb</strong>: 1048576, <strong>Allowed Extentions</strong>: pdf
                                        </div>
                                    </div>

                                    <?php
                                    if(isset($this->request->data["School"]["BROCHURE"]) && $this->request->data["School"]["BROCHURE"]!='') {
                                        $pdf = $this->request->data["School"]["BROCHURE"];
                                        $target = SITE_URL . 'files/upload_document/'.$pdf;
                                        $path = SITE_URL . 'files/upload_document/PDF.png';
                                        ?>
                                        <div style="float:left;width:500px;">
                                            <a href="<?php echo $target ?>" target="_blank"><img src="<?php echo $path ?>"  width="100" /></a>
                                        </div>
                                    <?php } ?>

                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Address<span class="required">
										* </span>
                                        </label>
                                        <div class="col-md-9 tooltips">
                                            <?php echo $this->Form->input('ADDRESS', array('type' => 'textarea',
                                                'label' => FALSE_VALUE,
                                                'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control')); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Upload Map Image</label>
                                        <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                             data-html='true' data-original-title="Upload Profile Photo">
                                            <?php echo $this->Form->input('UPLOAD_MAP', array('type' => 'file', 'label' => FALSE_VALUE,
                                                'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control')); ?>
<?php echo $this->General->uploadfilenotes(); ?>
                                        </div>
                                    </div>

                                    <?php
                                    if(isset($this->request->data["School"]["ADDRESS_IMAGE"]) && $this->request->data["School"]["ADDRESS_IMAGE"]!='') {
                                        $img = $this->request->data["School"]["ADDRESS_IMAGE"];
                                        $path = SITE_URL . 'files/upload_document/'.$img;
                                        ?>
                                        <div style="float:left;width:500px;">
                                            <img src="<?php echo $path ?>"  width="100" />
                                        </div>
                                    <?php } ?>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Phone No
                                        </label>
                                        <div class="col-md-9 tooltips">
                                            <?php echo $this->Form->input('PHONE_NO', array('type' => 'text', 'label' => FALSE_VALUE,
                                                'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control')); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Mobile No<span class="required">
										* </span>
                                        </label>
                                        <div class="col-md-9 tooltips">
                                            <?php echo $this->Form->input('MOBILE_NO', array('type' => 'text', 'label' => FALSE_VALUE,
                                                'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control','Placeholder' => 'Example :- 9999999999')); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Fax
                                        </label>
                                        <div class="col-md-9 tooltips">
                                            <?php echo $this->Form->input('FAX', array('type' => 'text', 'label' => FALSE_VALUE,
                                                'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control')); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Email<span class="required">
										* </span>
                                        </label>
                                        <div class="col-md-9 tooltips">
                                            <?php echo $this->Form->input('EMAIL', array('type' => 'text', 'label' => FALSE_VALUE,
                                                'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control','Placeholder' => 'xyz11@gmail.com')); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Website Url
                                        </label>
                                        <div class="col-md-9 tooltips">
                                            <?php echo $this->Form->input('WEBSITE_URL', array('type' => 'text', 'label' => FALSE_VALUE,
                                                'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control','Placeholder' => 'www.xyz.com')); ?>
                                        </div>
                                    </div>
                                </div>
                                
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Authority Sign</label>
                                        <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                             data-html='true' data-original-title="Upload Profile Photo">
                                            <?php echo $this->Form->input('AUT_SIGN', array('type' => 'file', 'label' => FALSE_VALUE,
                                                'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control')); ?>
<?php echo $this->General->uploadfilenotes(); ?>
                                        </div>
                                    </div>

                                    <?php
                                    if(isset($this->request->data["School"]["AUT_SIGN"]) && $this->request->data["School"]["AUT_SIGN"]!='') {
                                        $img = $this->request->data["School"]["AUT_SIGN"];
                                        $path = SITE_URL . 'files/upload_document/'.$img;
                                        ?>
                                        <div style="float:left;width:500px;">
                                            <img src="<?php echo $path ?>"  width="100" />
                                        </div>
                                    <?php } ?>

                                </div>
                                
							</div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Status</label>
                                        <div class="col-md-9 tooltips">
                                            <div class="radio-list">
                                                <label class="radio-inline">
                                                    <input type="radio" name="data[School][STATUS]" value="1" <?php echo $this->request->data['School']['STATUS'] == 1 ? "checked" : ""; ?>/>
                                                    Active </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="data[School][STATUS]" value="0" <?php echo $this->request->data['School']['STATUS'] == 0 ? "checked" : ""; ?>/>
                                                    Inactive </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!--/row-->
                        </div>
                        <div class="form-actions fluid">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn bg-blue-chambray">Submit</button>
                                        <button type="button" class="btn default" onclick="window.location.href='<?php echo $this->request->referer(); ?>'">Cancel</button>
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