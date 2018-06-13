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
								<li>
									<i class="fa fa-home"></i>
									<a href="#">Home</a>
									<i class="fa fa-angle-right"></i>
								</li>
								<li>
									<a href="#">Admission</a>
									<i class="fa fa-angle-right"></i>
								</li>
								<li>
									<a href="#">Admission Vacancy</a>
								</li>
							</ul>
							<!-- END PAGE TITLE & BREADCRUMB-->
							<?php echo $this->Session->flash(); ?>
							<?php echo $this->Session->flash('auth'); ?>
						</div>
					</div>
					<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->

<div class="row">
<div class="col-md-12">
<!-- BEGIN EXAMPLE TABLE PORTLET-->
<div class="portlet box blue-madison">
			<div class="portlet-title">
				<div class="caption">
					<span aria-hidden="true" class="icon-users"></span>  View Admission Vacancy
				</div>
			</div>
<div class="portlet-body form">
	<div class="form-body">
			<?php echo $this->Form->create("AdmissionVacancy",array("type"=>"get")) ?>
					<?php /* ?>
					<div class="row">
						<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Filter by Class</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
                                   <?php echo $this->Form->input('CLS', array('options' => $classes,
                                        'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control select2me' )); ?>	
										
                                </div>
                            </div>
                        </div>
						<div class="col-md-6">
                        
                                <button type="submit"  class="btn bg-blue-chambray">Search</button> OR
                                <a href="<?php echo Router::url(array("action"=>"index")); ?>">RESET</a>
                                
                           
                        </div>
					</div>
					<?php */ ?>
					<div class="row">
						<div class="col-lg-6 col-md-7 col-sm-7 col-xs-12">
							<div class="form-group no_marbtm">
								<label class="control-label col-md-3">Filter by Class</label>
								<div class="col-md-9" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
								   <?php echo $this->Form->input('CLS', array('options' => $classes,
										'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control select2me' )); ?>	
										
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-5 col-sm-5 col-xs-12">
							<div class="btn_block">
								<button type="submit" class="btn bg-blue-chambray">Search</button>
								<button type="reset" class="btn bg-blue-chambray" onclick="window.location='<?php echo Router::url(array("action"=>"index")); ?>'">Reset</button>
							</div>
						</div>
					</div>
			</form>

<?php if(in_array($authUser["ROLE_ID"],array(SUPERVISOR_ID))) { ?>
<!--<div class="table-toolbar">
        <div class="btn-group">
            <a href="<?php echo Router::url(array('controller' => 'AdmissionVacancy','action' => 'add')) ?>" class="btn
        green bg-green"> ADD NEW <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>-->
	<a href="<?php echo Router::url(array('controller' => 'AdmissionVacancy','action' => 'add')) ?>" class="btn
        green bg-green add_btn"> ADD NEW <i class="fa fa-plus"></i>
	</a>
	<?php } ?>

			<table class="table table-striped table-bordered table-hover" id="user_table">
			<thead>
			<tr role="row" class="heading">
				<th style="width: 100px;">
					Sr. No.
				</th>
				<th>
					Class Name
				</th>
				<th>
					Number Admission Vacancy
				</th>
				<th>
					Form Fee
				</th>
				<th style="width: 200px;">
					Status
				</th>
				<?php if(in_array($authUser["ROLE_ID"],array(SUPERVISOR_ID))) { ?>
				<th style="width: 200px;">
					Action
				</th>
				<?php } ?>
			</tr>
			</thead>
			<tbody>
			<?php if(count($AdmissionVacancy) > 0):
				$i = 1;
				?>
				<?php foreach($AdmissionVacancy as $AV) { ?>
					<tr>
						<td class="text-center"><?php echo $i; ?></td>
						  <td class="text-center"><?php echo $AV['AcademicClass']['CLASS_NAME']; ?></td>
						<td class="text-center"><?php echo $AV['AdmissionVacancy']['NUM_VACANCY']; ?></td>
							
							<td align="center"><?php echo $AV['AdmissionVacancy']['FORM_FEE']; ?></td>
						<td class="text-center">
							<?php if($AV['AdmissionVacancy']['STATUS']) { ?>
								Active
							<?php } else { ?>
								Inactive
							<?php } ?>
						</td>
						<?php if(in_array($authUser["ROLE_ID"],array(SUPERVISOR_ID))) { ?>
						<td class="text-center">
							<a href="<?php echo Router::url(array('controller' => 'AdmissionVacancy',
								'action' => 'edit', $AV['AdmissionVacancy']['ADM_VAC_ID'],
							))?>" class="tooltips btn" data-placement="top" data-toggle="tooltip" title="Edit">
								<i class="fa fa-pencil"></i></a>
							
								<a href="javascript::void(0);" onclick="remove_record('<?php echo Router::url(array('controller' => 'AdmissionVacancy','action' => 'delete', $AV['AdmissionVacancy']['ADM_VAC_ID']))?>')" class="tooltips btn" data-placement="top" data-toggle="tooltip" title="Delete">
									<i class="fa fa-trash-o"></i></a>
							
						</td>
						<?php } ?>
					</tr>
				<?php $i++; } ?>
			<?php endif; ?>
			</tbody>
			</table>
			
	</div>
</div>
</div>
<!-- END EXAMPLE TABLE PORTLET-->
</div>
</div>
<!-- END PAGE CONTENT-->
</div>
</div>
<script>
function remove_record(x) {
	if(confirm("Are you sure want to remove this ?")) { 
		window.location.href = x;
	}
}
</script>