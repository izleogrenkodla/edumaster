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
                                <a href="<?php echo Router::url(array('controller' => 'PagesContent', 'action' => 'index')) ?>">View All Content</a>
                            </li>
                            <li>
                                <a href="<?php echo Router::url(array('controller' => 'PagesContent', 'action' => 'add')) ?>">Add New Content</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="#">Home</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="#">Content</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="#">Edit Content</a>
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
                            <span aria-hidden="true" class="icon-user"></span>&nbsp; Edit Content
                        </div>
                        <div class="tools">
                            <a href="javascript:void(0);" class="collapse">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <?php echo $this->Form->create('PagesContent', array('class' => 'form-horizontal add', 'id' => 'Roles','type' => 'file')); ?>
                        <?php echo $this->Form->input("CONTENT_ID", array('type' => 'hidden', 'label' => false, 'div' => false)) ?>
                        <div class="form-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Category<span class="required">
										* </span>
                                        </label>
                                        <div class="col-md-9 tooltips">
                                            <?php
                                            echo $this->Form->input('PAGE_NAME_ID', array('options' => $pagenames, 'default' => '', 'class' => 'form-control select2me', 'label' => FALSE_VALUE,
                                                'div' => FALSE_VALUE));
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Upload Content Photo <span class="required">
										* </span></label>
                                        <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                             data-html='true' data-original-title="Upload Profile Photo">
                                            <?php echo $this->Form->input('UPLOAD_IMAGE', array('type' => 'file', 'label' => FALSE_VALUE,
                                                'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control')); ?>
											<?php echo $this->General->uploadfilenotes(); ?>
											<?php
											if($this->request->data["PagesContent"]["CONTENT_IMAGE"]!='') {
												$img = $this->request->data["PagesContent"]["CONTENT_IMAGE"];
												$path = SITE_URL . 'files/upload_document/'.$img;
												?>
												<div class="preview_container">
													<img src="<?php echo $path ?>" />
												</div>
											<?php } ?>	
				
                                        </div>
                                    </div>
                                </div>

                                <?php /*
                                if($this->request->data["PagesContent"]["CONTENT_IMAGE"]!='') {
                                    $img = $this->request->data["PagesContent"]["CONTENT_IMAGE"];
                                    $path = SITE_URL . 'files/upload_document/'.$img;
                                    ?>
                                    <div style="float:right;width:500px;">
                                        <img src="<?php echo $path ?>"  width="100" />
                                    </div>
                                <?php }*/ ?>


                            </div>

                            <div class="row">

                                <div class="col-md-12">
                            <div class="form-group">
                                
                                <div class="col-md-12 tooltips">
                                    <?php echo $this->Form->input('CONTENT_DESC', array('type' => 'textarea',
                                        'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'ckeditor form-control', 'data-error-container' => '#editor2_error')); ?>
                                </div>
                            </div>
                        </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Status</label>
                                        <div class="col-md-9 tooltips">
                                            <div class="radio-list">
                                                <label class="radio-inline">
                                                    <input type="radio" name="data[PagesContent][STATUS]" value="1" <?php echo $this->request->data['PagesContent']['STATUS'] == 1 ? "checked" : ""; ?>/>
                                                    Active </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="data[PagesContent][STATUS]" value="0" <?php echo $this->request->data['PagesContent']['STATUS'] == 0 ? "checked" : ""; ?>/>
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