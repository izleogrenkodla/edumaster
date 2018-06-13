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
                    <li class="btn-group">
                        <button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
                            <span>Actions</span><i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li>
                                <a href="<?php echo Router::url(array('controller' => 'Album', 'action' => 'index')) ?>">View All Albums</a>
                            </li>
                            <li>
                                <a href="<?php echo Router::url(array('controller' => 'Album', 'action' => 'add')) ?>">Add New Album</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="#">Home</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="#">Certification Album</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="#">Edit Certification Album</a>
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
                            <span aria-hidden="true" class="icon-user"></span>&nbsp; Edit Certification Album
                        </div>
                        <div class="tools">
                            <a href="javascript:void(0);" class="collapse">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <?php echo $this->Form->create('Album', array('class' => 'form-horizontal add', 'id' => 'Roles','type' => 'file')); ?>
                        <?php echo $this->Form->input("ALBUM_ID", array('type' => 'hidden', 'label' => false, 'div' => false)) ?>
                        <?php echo $this->Form->input("ALBUM_TYPE", array('type' => 'hidden', 'value' =>3, 'label' => false, 'div' => false)) ?>
                        <div class="form-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Album Name<span class="required">
										* </span>
                                        </label>
                                        <div class="col-md-9 tooltips">
                                            <?php echo $this->Form->input('ALBUM_NAME', array('type' => 'text', 'label' => FALSE_VALUE,
                                                'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control')); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Album Cover Photo</label>
                                        <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                             data-html='true' data-original-title="Upload Profile Photo">
                                            <?php echo $this->Form->input('UPLOAD_IMAGE', array('type' => 'file', 'label' => FALSE_VALUE,
                                                'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control')); ?>
                                        </div>
                                    </div>

                                    <?php
                                    if($this->request->data["Album"]["COVER_IMAGE"]!='') {
                                        $img = $this->request->data["Album"]["COVER_IMAGE"];
                                        $path = SITE_URL . 'files/upload_document/'.$img;
                                        ?>
                                        <div style="float:right;width:500px;">
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
                                                    <input type="radio" name="data[Album][STATUS]" value="1" <?php echo $this->request->data['Album']['STATUS'] == 1 ? "checked" : ""; ?>/>
                                                    Active </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="data[Album][STATUS]" value="0" <?php echo $this->request->data['Album']['STATUS'] == 0 ? "checked" : ""; ?>/>
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