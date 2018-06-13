<div class="page-content-wrapper">
<div class="page-content">
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
                <a href="#">State</a>
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
        <span aria-hidden="true" class="icon-users"></span>  View All State
    </div>
</div>
<div class="portlet-body">

    <?php
    echo $this->Form->create('User' , array('url' => array('controller' => 'Users', 'action' => 'multiple_delete'
        ) , 'class' => 'form-horizontal',
        )
    );
    ?>
    <input type="hidden" name="data[model]" value="State">
    <div class="table-toolbar">
        <div class="btn-group">
            <a href="<?php echo Router::url(array('controller' => 'States','action' => 'add')) ?>" class="btn
        green bg-green"> ADD NEW <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>

<table class="table table-striped table-bordered table-hover">
<thead>
<tr role="row" class="heading">
    <th>
        Sr. No.
    </th>
    <th>
        Name
    </th>
    <th>
        Country Name
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
            <td><?php echo $key+1; ?></td>
            <td><a href="<?php echo Router::url(array('controller' => 'States',
                    'action' => 'edit', $result['State']['id'],
                ))?>"><?php echo  $this->General->first_letter_capitalized
                    ($result['State']['name']); ?></a></td>
            <td><?php echo  $this->General->first_letter_capitalized
                    ($result['Country']['name']); ?></td>

            <td class="text-center">
                <?php echo date('d-m-Y H:i', strtotime($result['State']['created'])); ?>
      <!--          <a href="<?php /*echo Router::url(array('controller' => 'States',
                    'action' => 'edit', $result['State']['id'],
                ))*/?>" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                   data-original-title="Edit">
                    <i class="fa fa-edit"></i></a>
                <a href="<?php /*echo Router::url(array('controller' => 'States',
                    'action' => 'delete', $result['State']['id'],
                ))*/?>" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                   data-original-title="Delete">
                    <i class="fa fa-trash-o"></i></a>-->
            </td>
        </tr>
    <?php } ?>
<?php endif; ?>
</tbody>
</table>

    <div class="dataTables_paginate paging_full_numbers" id="DataTables_Table_8_paginate">
        <div class="paging">
            <?php echo $this->paginator->prev(__('Previous', true), array(), null, array('class' => 'disabled')); ?>
            <?php echo $this->paginator->numbers(); ?>
            <?php echo $this->paginator->next(__('Next', true), array(), null, array('class' => 'disabled')); ?>
        </div>
    </div>
    <div class="dataTables_info" id="DataTables_Table_8_info"><?php
        echo $this->Paginator->counter(array(
            'format' => 'Showing <span>%start%</span> to <span>%end%</span> of <span>%count%</span> entries'));
        ?>
    </div>

</div>
</div>
<!-- END EXAMPLE TABLE PORTLET-->
</div>
</div>
<!-- END PAGE CONTENT-->
</div>
</div>