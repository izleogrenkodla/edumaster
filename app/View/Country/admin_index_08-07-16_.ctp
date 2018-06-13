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
                <a href="#">Country</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View All</a>
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
        <span aria-hidden="true" class="icon-users"></span>  View All Countries
    </div>
</div>
<div class="portlet-body">

    <?php
    echo $this->Form->create('User' , array('url' => array('controller' => 'Users', 'action' => 'multiple_delete'
        ) , 'class' => 'form-horizontal',
        )
    );
    ?>
    <input type="hidden" name="data[model]" value="Country">
    <div class="table-toolbar">
        <div class="btn-group">
            <a href="<?php echo Router::url(array('controller' => 'Countries','action' => 'add')) ?>" class="btn
        green bg-green"> ADD NEW <i class="fa fa-plus"></i>
            </a>
            <button type="submit" class="btn red delete_btn" disabled="disabled" onclick="return confirm('Are you sure you want to delete this records?');"><i class="fa
            fa-trash-o"></i>&nbsp;Delete</button>
        </div>
    </div>

<table class="table table-striped table-bordered table-hover" id="user_table">
<thead>
<tr role="row" class="heading">
    <th class="table-checkbox">
        <input type="checkbox" name="check_all" id="check_all" class="group-checkable"
               data-set="#user_table .checkboxes"/>
    </th>
    <th>
        Sr. No.
    </th>
    <th>
        Country Name
    </th>
    <th>
        Country CODE
    </th>
    <th style="width: 185px;">
        Date & Time
    </th>
</tr>
</thead>
<tbody>
<?php if(count($results) > 0): ?>
    <?php foreach($results as $key=>$result) { ?>
        <tr>
            <td>
                <input type="checkbox" name="data[data_id][]" value="<?php echo $result['Country']['id']; ?>" class="checkboxes"/>
            </td>
            <td><?php echo $key+1; ?></td>
            <td> <a href="<?php echo Router::url(array('controller' => 'Countries', 'action' => 'edit', $result['Country']['id'],
                ))?>"><?php echo $result['Country']['name']; ?></a></td>
            <td><?php echo $result['Country']['iso_code_2']; ?></td>
            <td class="text-center">
                <?php echo date('d-m-Y H:i', strtotime($result['Country']['created'])); ?>
   <!--             <a href="<?php /*echo Router::url(array('controller' => 'Countries',
                    'action' => 'edit', $result['Country']['id'],
                ))*/?>" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                   data-original-title="Edit">
                    <i class="fa fa-pencil"></i></a>
                <a href="<?php /*echo Router::url(array('controller' => 'Countries',
                    'action' => 'delete', $result['Country']['id'],
                ))*/?>" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                   data-original-title="Delete">
                    <i class="fa fa-trash-o"></i></a>-->
            </td>
        </tr>
    <?php } ?>
<?php endif; ?>
</tbody>
</table>
</form>
</div>
</div>
<!-- END EXAMPLE TABLE PORTLET-->
</div>
</div>
<!-- END PAGE CONTENT-->
</div>
</div>