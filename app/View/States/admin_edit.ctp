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
                        <ul class="dropdown-menu pull-right">
                            <li>
                                <a href="<?php echo Router::url(array('controller' => 'States', 'action' => 'index')) ?>">View All State</a>
                            </li>
                            <li>
                                <a href="<?php echo Router::url(array('controller' => 'States', 'action' => 'add')) ?>">Add New State</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="#">Home</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="#">State</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="#">Edit State</a>
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
                            <span aria-hidden="true" class="icon-user"></span>  Edit State
                        </div>
                        <div class="tools">
                            <a href="javascript:void(0);" class="collapse">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <?php echo $this->Form->create('State', array('class' => 'form-horizontal add')); ?>
                        <div class="form-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Name<span class="required">
										* </span>
                                        </label>
                                        <div class="col-md-9 tooltips">
                                            <?php echo $this->Form->input('STATE_NAME', array('type' => 'text', 'label' => FALSE_VALUE,
                                                'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control')); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Select Country<span class="required">
										* </span>
                                        </label>
                                        <div class="col-md-9 tooltips">
                                            <?php
                                            echo $this->Form->input('COUNTRY_ID', array('options' => $countries, 'default' => '', 'class' => 'form-control select2me', 'label' => FALSE_VALUE,
                                                'div' => FALSE_VALUE));
                                            ?>
                                        </div>
                                    </div>
                                </div>
								
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-3">Status</label>
										<div class="col-md-9">
											<div class="radio-list">
												<label class="radio-inline">
													<input type="radio" name="data[State][STATUS]" value="1" <?php echo $this->request->data['State']['STATUS'] == 1 ? "checked" : ""; ?> />
													Active </label>
												<label class="radio-inline">
													<input type="radio" name="data[State][STATUS]" value="0" <?php echo $this->request->data['State']['STATUS'] == 0 ? "checked" : ""; ?> />
													Inactive </label>
											</div>
										</div>
									</div>
								</div>
								
                            </div>
                        </div>
                        <div class="form-actions fluid">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn bg-blue-chambray">Submit</button>
                                        <?php if($authUser['role_id'] == 1) { ?>
                                                <button type="button" class="btn bg-blue-chambray" onclick="window.location.href='<?php echo Router::url(array('controller' => 'States',
                                                    'action' => 'delete', $this->data['State']['id'],
                                                )); ?>'">Delete</button>
                                            <?php } ?>
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