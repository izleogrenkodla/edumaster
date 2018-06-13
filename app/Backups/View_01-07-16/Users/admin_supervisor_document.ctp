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
                <a href="#">Supervisor</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Documents</a>
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
        <span aria-hidden="true" class="icon-user"></span> Supervisor Document
    </div>
    <div class="tools">
        <a href="javascript:void(0);" class="collapse">
        </a>
    </div>
</div>
<div class="portlet-body form">
<!-- BEGIN FORM-->
<?php echo $this->Form->create('User', array('class' => 'form-horizontal add', 'id' => 'Form',
    'type' => 'file')); ?>
<?php echo $this->Form->input("ID", array('type' => 'hidden', 'label' => false, 'div' => false)) ?>
<div class="form-body">
<h3 class="form-section">Documents</h3>


<div class="row">
<div class="col-md-12">
<div class="tabbable tabbable-custom boxless">
<ul class="nav nav-tabs">
    <li class="active">
        <a href="#tab_1" data-toggle="tab">
            General Documents </a>
    </li>
    <li>
        <a href="#tab_2" data-toggle="tab">
            Other Documents </a>
    </li>
</ul>
<div class="tab-content">


<div class="tab-pane active" id="tab_1">
    <!-- BEGIN FILTER -->
    <div class="margin-top-10">

        <div class="row mix-grid">
            
            <div class="col-md-3 col-sm-4 mix category_2">
                <div class="mix-inner">

                    <?php

                    $apimg = $userData['User']['ADDRESS_PROOF'];
                    $appath = SITE_URL . 'files/upload_document/'.$apimg;

                    ?>

                    <img class="img-responsive" src="<?php echo $appath; ?>" alt="">
                    <div class="mix-details">
                        <h4>Address Proof</h4>
                        <a class="mix-link">
                            <i class="fa fa-link"></i>
                        </a>
                        <a class="mix-preview fancybox-button" href="<?php echo $appath; ?>" title="Project Name" data-rel="fancybox-button">
                            <i class="fa fa-search"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            
        </div>
    </div>
    <!-- END FILTER -->
</div>
    <div class="tab-pane" id="tab_2">
        <!-- BEGIN FILTER -->
        <div class="margin-top-10">

            <div class="row mix-grid">
                <div class="col-md-3 col-sm-4 mix category_1">
                    <div class="mix-inner">
                        <img class="img-responsive" src="../../assets/admin/pages/media/works/img1.jpg" alt="">
                        <div class="mix-details">
                            <h4>Cascusamus et iusto odio</h4>
                            <a class="mix-link">
                                <i class="fa fa-link"></i>
                            </a>
                            <a class="mix-preview fancybox-button" href="../../assets/admin/pages/media/works/img2.jpg" title="Project Name" data-rel="fancybox-button">
                                <i class="fa fa-search"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-4 mix category_2">
                    <div class="mix-inner">
                        <img class="img-responsive" src="../../assets/admin/pages/media/works/img2.jpg" alt="">
                        <div class="mix-details">
                            <h4>Cascusamus et iusto accusamus</h4>
                            <a class="mix-link">
                                <i class="fa fa-link"></i>
                            </a>
                            <a class="mix-preview fancybox-button" href="../../assets/admin/pages/media/works/img2.jpg" title="Project Name" data-rel="fancybox-button">
                                <i class="fa fa-search"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-4 mix category_3">
                    <div class="mix-inner">
                        <img class="img-responsive" src="../../assets/admin/pages/media/works/img3.jpg" alt="">
                        <div class="mix-details">
                            <h4>Cascusamus et iusto accusamus</h4>
                            <a class="mix-link">
                                <i class="fa fa-link"></i>
                            </a>
                            <a class="mix-preview fancybox-button" href="../../assets/admin/pages/media/works/img3.jpg" title="Project Name" data-rel="fancybox-button">
                                <i class="fa fa-search"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-4 mix category_1 category_2">
                    <div class="mix-inner">
                        <img class="img-responsive" src="../../assets/admin/pages/media/works/img4.jpg" alt="">
                        <div class="mix-details">
                            <h4>Cascusamus et iusto accusamus</h4>
                            <a class="mix-link">
                                <i class="fa fa-link"></i>
                            </a>
                            <a class="mix-preview fancybox-button" href="../../assets/admin/pages/media/works/img4.jpg" title="Project Name" data-rel="fancybox-button">
                                <i class="fa fa-search"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END FILTER -->
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
                <button type="button" class="btn default"  onclick="window.location.href='<?php echo $this->request->referer(); ?>'">Go Back</button>
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