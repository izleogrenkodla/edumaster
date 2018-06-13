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
                        <a href="<?php echo Router::url(array('controller' => 'FrontPhilosophy', 'action' => 'index')) ?>">View Front Philosophy</a>
                    </li>
                    <li>
                        <a href="<?php echo Router::url(array('controller' => 'FrontPhilosophy', 'action' => 'add')) ?>">Add New Front Philosophy</a>
                    </li>
                </ul>
            </li>
            <li>
                <i class="fa fa-home"></i>
                <a href="#">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Front Philosophy</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Front Philosophy</a>
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
                <span aria-hidden="true" class="icon-user"></span>View Front Philosophy
            </div>
            <div class="tools">
                <a href="javascript:void(0);" class="collapse">
                </a>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <?php echo $this->Form->create('FrontPhilosophy', array('class' => 'form-horizontal add', 'id' => 'Roles','type' => 'file')); ?>
                <?php // echo $this->Form->input("ALBUM_TYPE", array('type' => 'hidden', 'value' =>1, 'label' => false, 'div' => false)) ?>
                <div class="form-body">

                    <div class="row">
                     
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Title<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php echo $this->request->data['FrontPhilosophy']['pTitle']  ?>
                                </div>
                            </div>
                        </div>
						
						<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Content 1
                                </label>
                                <div class="col-md-9 tooltips">
                                  <?php echo $this->request->data['FrontPhilosophy']['Content1']  ?>
                                </div>
                            </div>
                        </div>
       
                    </div>
					
					<div class="row">
						<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Content 2
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php echo $this->request->data['FrontPhilosophy']['Content2']  ?>
                                </div>
                            </div>
                        </div>
						<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Content 3
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php echo $this->request->data['FrontPhilosophy']['Content3']  ?>
                                </div>
                            </div>
                        </div>
					</div>

                    <div class="row">
					
						<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-3">Content 4
									</label>
									<div class="col-md-9 tooltips">
										<?php echo $this->request->data['FrontPhilosophy']['Content4']  ?>
									</div>
								</div>
							</div>
						

						 <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Status</label>
                                <div class="col-md-9 tooltips">
                                   <?php 
								   if($this->request->data['FrontPhilosophy']['Status'] == 0)
								   {
									   echo 'Inactive';
								   }else{
									   echo 'Active';
								   }
									
									   ?>
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