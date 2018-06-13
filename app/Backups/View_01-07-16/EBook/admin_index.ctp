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
                <a href="#">EBook</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View E-Books</a>
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
        <span aria-hidden="true" class="icon-users"></span>  View All E-Book
    </div>
</div>
<div class="portlet-body">

   <?php if(in_array($authUser["ROLE_ID"],array(ADMIN_ID,TEACHER_ID))) { ?>
    <!--<div class="table-toolbar">
        <div class="btn-group">
            <a href="<?php echo Router::url(array('controller' => 'EBook','action' => 'add')) ?>" class="btn
        green bg-green"> ADD NEW <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>-->
	<a href="<?php echo Router::url(array('controller' => 'EBook','action' => 'add')) ?>" class="btn
        green bg-green"> ADD NEW <i class="fa fa-plus"></i>
	</a>
<?php } ?>	

<table class="table table-striped table-bordered table-hover" id="user_table">
<thead>
<tr role="row" class="heading">
    <th>
        Sr. No.
    </th>
    <th>
        Category Name
    </th>
 <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
    <th>
        Class Name
    </th>
<?php } ?>
    <th>
        Book Name
    </th>
    <th>
        Author Name
    </th>
    <th>
        E-Book
    </th>
    <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
    <th>
        Action
    </th>
    <?php } ?>
</tr>
</thead>
<tbody>
<?php if(count($ebooks) > 0):
    $i = 1;
    ?>
    <?php foreach($ebooks as $ebook) { ?>
        <tr>
            <td class="text-center"><?php echo $i; ?></td>
            <td class="text-center"><?php echo $ebook['Category']['CATEGORY_NAME']; ?></td>
 <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
            <td class="text-center"><?php echo $ebook['AcademicClass']['CLASS_NAME']; ?></td>
<?php } ?>
            <td> <?php echo $ebook['EBook']['BOOK_NAME']; ?></td>
            <td class="text-center"><?php echo $ebook['EBook']['AUTHOR_NAME']; ?></td>
            <td class="text-center"><a href="<?php echo DOWNLOADURL.'upload_document/'.$ebook['EBook']['PDF']; ?>" target="_blank"><img  width="50" src="<?php echo SITE_URL . 'files/upload_document/PDF.png'; ?>" /></a></td>
            <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
            <td class="text-center">
                
			   
			    <a href="<?php echo Router::url(array('controller' => 'EBook',
                    'action' => 'edit', $ebook['EBook']['ID'],
                ))?>" class="tooltips btn" data-toggle="tooltip" title="Edit">
                    <i class="fa fa-pencil"></i></a>

                    <a href="javascript::void(0);" onclick="remove_record('<?php echo Router::url(array('controller' => 'EBook','action' => 'delete', $ebook['EBook']['ID']))?>')" class="tooltips btn" data-toggle="tooltip" title="Delete">
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