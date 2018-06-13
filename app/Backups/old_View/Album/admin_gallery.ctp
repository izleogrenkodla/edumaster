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
                        <a href="#">Album</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="#">Add Album</a>
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
                            <span aria-hidden="true" class="icon-user"></span>&nbsp; Add Album
                        </div>
                        <div class="tools">
                            <a href="javascript:void(0);" class="collapse">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <?php echo $this->Form->create('Gallery', array('class' => 'form-horizontal add', 'id' => 'Roles','type' => 'file')); ?>
                        <div class="form-body">

                            <div class="row-fluid">
                                <div class="span12">
                                    <div class="box box-bordered">
                                        <div class="box-content nopadding custom_border">
                                            <div class="box-content nopadding">
                                                <div class="plupload"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="box-content nopadding">
                                            <?php if (!empty($image_data)) { ?>
                                                <ul class="gallery gallery-dynamic">
                                                    <?php foreach ($image_data as $images) { ?>
                                                        <li id="<?php echo $images['Gallery']['GALLERY_ID']; ?>" class="mupload">
                                                            <a href="#">
                                                                <img src="<?php echo SUB_DIRECTORY . '/app/webroot/files/'.UPLOAD_SCHOOL_GALLERY_PHOTO
                                                                    . $images['Gallery']['IMAGE_URL']?>" alt="" height="200">
                                                            </a>

                                                            <div class="extras">
                                                                <div class="extras-inner">
                                                                    <a href="<?php echo SUB_DIRECTORY . '/app/webroot/'.UPLOAD_SCHOOL_GALLERY_PHOTO
                                                                        . $images['Gallery']['IMAGE_URL']?>" class='colorbox-image'
                                                                       rel="group-1"><i class="icon-search"></i></a>
                                                                    <a href="#" class='del-gallery-pic'><i class="icon-trash"></i></a>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            <?php
                                            } else {
                                                echo "<center><br />No images available in gallery</center>";
                                            } ?>
                                        </div>
                                    </div>

                                </div>


                            </div>

                            <!--/row-->
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

<script type="text/javascript">
    // <![CDATA[
    $(document).ready(function () {
// PlUpload
        var gallery_id = '<?php echo $ALBUM_ID; ?>';
        if ($('.plupload').length > 0) {
            $(".plupload").each(function () {
                var $el = $(this);
                $el.pluploadQueue({
                    runtimes: 'html5,gears,flash,silverlight,browserplus',
                    url: REQUEST_URL + 'Album/gallery/' + gallery_id,
                    max_file_size: '10mb',
                    //chunk_size: '1mb',
                    unique_names: true,
                    // resize : {width : 320, height : 240, quality : 90},
                    filters: [
                        {title: "Image files", extensions: "jpg,gif,png,bmp,TTF,PNG,jpeg"}
                        // {title : "Zip files", extensions : "zip"}
                    ],
                    flash_swf_url: 'plugins/plupload/plupload.flash.swf',
                    silverlight_xap_url: 'plugins/plupload/plupload.silverlight.xap',

                    // Post init events, bound after the internal events
                    init: {
                        Refresh: function (up) {
                            // Called when upload shim is moved
                            //  log('[Refresh]');
                        },
                        StateChanged: function (up) {
                            // Called when the state of the queue is changed
                            up.state == plupload.STARTED ? "STARTED" : "STOPPED";
                            if (up.state == 1) {
                                $(".hide-flash-good").html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><strong>Success!</strong> The School Gallery has been saved</div>');
                                $('html, body').animate({ scrollTop: 0 }, 600);
                                $('.hide-flash-good').css('display', 'block').animate({opacity: 1.0}, 1000).fadeOut(function () {
                                    
                                });
                                window.location.reload();
                            }
                            // log('[StateChanged]', up.state == plupload.STARTED ? "STARTED" : "STOPPED");
                        },
                        /*
                         QueueChanged: function(up) {
                         // Called when the files in queue are changed by adding/removing files
                         log('[QueueChanged]');
                         },

                         UploadProgress: function(up, file) {
                         // Called while a file is being uploaded
                         log('[UploadProgress]', 'File:', file, "Total:", up.total);
                         },

                         FilesAdded: function(up, files) {
                         // Callced when files are added to queue
                         log('[FilesAdded]');

                         plupload.each(files, function(file) {
                         log('  File:', file);
                         });
                         },

                         FilesRemoved: function(up, files) {
                         // Called when files where removed from queue
                         log('[FilesRemoved]');

                         plupload.each(files, function(file) {
                         log('  File:', file);
                         });
                         },

                         FileUploaded: function(up, file, info) {
                         // Called when a file has finished uploading
                         // log('[FileUploaded] File:', file, "Info:", info);
                         log("OK");

                         },

                         ChunkUploaded: function(up, file, info) {
                         // Called when a file chunk has finished uploading
                         log('[ChunkUploaded] File:', file, "Info:", info);
                         },
                         */
                        Error: function (up, args) {
                            // Called when a error has occured
                            // log('[error] ', args);
                            $(".hide-flash-bad").html('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><strong>Warning!</strong> The School Gallery could not be saved. Please, try again.</div>');
                            $('html, body').animate({ scrollTop: 0 }, 600);
                            $('.hide-flash-bad').css('display', 'block').animate({opacity: 1.0}, 1000).fadeOut(function () {
                                 window.location.reload();
                            });
                        }
                    }
                });
                $(".plupload_header").remove();
                var upload = $el.pluploadQueue();
                if ($el.hasClass("pl-sidebar")) {
                    $(".plupload_filelist_header,.plupload_progress_bar,.plupload_start").remove();
                    $(".plupload_droptext").html("<span>Drop files to upload</span>");
                    $(".plupload_progress").remove();
                    $(".plupload_add").text("Or click here...");
                    upload.bind('FilesAdded', function (up, files) {
                        setTimeout(function () {
                            up.start();
                        }, 500);
                    });
                    upload.bind("QueueChanged", function (up) {
                        $(".plupload_droptext").html("<span>Drop files to upload</span>");
                    });
                    upload.bind("StateChanged", function (up) {
                        $(".plupload_upload_status").remove();
                        $(".plupload_buttons").show();
                    });
                } else {
                    $(".plupload_progress_container").addClass("progress").addClass('progress-striped');
                    $(".plupload_progress_bar").addClass("bar");
                    $(".plupload_button").each(function () {
                        if ($(this).hasClass("plupload_add")) {
                            $(this).attr("class", 'btn pl_add btn-primary').html("<i class='icon-plus-sign'></i> " + $(this).html());
                        } else {
                            $(this).attr("class", 'btn pl_start btn-success').html("<i class='icon-cloud-upload'></i> " + $(this).html());
                        }
                    });
                }
            });
        }

        $(".del-gallery-pic").click(function (e) {
            e.preventDefault();
            var $el = $(this);
            var $parent = $el.parents("li");
            var image_id = $parent.attr('id');
            if (image_id != '') {
                $.ajax({
                    type: "post",
                    url: REQUEST_URL + "Album/delete_gallery_image/" + image_id,
                    cache: false,
                    success: function (res) {
                        if (res == 1) {
                            $(".hide-flash-bad").hide();
                            $(".hide-flash-good").html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><strong>Success!</strong> The Gallery images has been deleted</div>');
                            $('html, body').animate({ scrollTop: 0 }, 600);
                            $(".hide-flash-good").show().animate({opacity: 1.0}, 1000).fadeOut(function () {
                                window.location.reload();
                            });
                        } else {
                            $(".hide-flash-good").hide();
                            $(".hide-flash-bad").html('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><strong>Warning!</strong> The Gallery image could not be deleted please try again</div>');
                            $('html, body').animate({ scrollTop: 0 }, 600);
                            $(".hide-flash-bad").show().animate({opacity: 1.0}, 1000).fadeOut(function () {
                                window.location.reload();
                            });
                        }
                    }
                });
            }
            $parent.fadeOut(400, function () {
                $parent.remove();
            });
        });

    });
    // ]]>
</script>