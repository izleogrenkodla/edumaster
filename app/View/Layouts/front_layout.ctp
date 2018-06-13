<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Welcome to <?php echo WEBSITE_NAME; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="Identifier-URL" content="<?php echo SITE_URL; ?>"/>
    <meta name="keywords" content="<?php // echo $meta_keywords ?>"/>
    <meta name="description" content="<?php // echo $meta_description ?>"/>
    <?php echo $this->element('front_top_assets'); ?>
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no, user-scalable=0;" />
</head>

<body>
<?php echo $this->element('front_header_block'); ?>
<!-- start mainwrapper -->
<div id="mainwrapper">
    <div class="container">
        <!-- start maincontent -->
        <?php echo $this->fetch('content'); ?>
        <!-- end maincontent -->
        <?php echo $this->element('front_sidebar'); ?>
        <!-- end sidebar -->
    </div>
</div>
<?php // echo $this->element('sql_dump'); ?>
<!-- scripts_for_layout -->
<?php echo $scripts_for_layout; ?>
<?php echo $this->element('front_footer_block'); ?>
<!-- Js writeBuffer -->
<?php
if (class_exists('JsHelper') && method_exists($this->Js, 'writeBuffer'))
    echo $this->Js->writeBuffer();
// Writes cached scripts
?>
</body>
</html>
