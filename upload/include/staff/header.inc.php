<?php
header("Content-Type: text/html; charset=UTF-8");
if (!isset($_SERVER['HTTP_X_PJAX'])) { ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html <?php
if (($lang = Internationalization::getCurrentLanguage())
        && ($info = Internationalization::getLanguageInfo($lang))
        && (@$info['direction'] == 'rtl'))
    echo 'dir="rtl" class="rtl"';
?>>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta http-equiv="x-pjax-version" content="<?php echo GIT_VERSION; ?>">
    <title><?php echo ($ost && ($title=$ost->getPageTitle()))?$title:'osTicket :: '.__('Staff Control Panel'); ?></title>
    <!--[if IE]>
    <style type="text/css">
        .tip_shadow { display:block !important; }
    </style>
    <![endif]-->
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/jquery-1.8.3.min.js?19292ad"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/jquery-ui-1.10.3.custom.min.js?19292ad"></script>
    <script type="text/javascript" src="./js/scp.js?19292ad"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/jquery.pjax.js?19292ad"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/filedrop.field.js?19292ad"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/jquery.multiselect.min.js?19292ad"></script>
    <script type="text/javascript" src="./js/tips.js?19292ad"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/redactor.min.js?19292ad"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/redactor-osticket.js?19292ad"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/redactor-fonts.js?19292ad"></script>
    <script type="text/javascript" src="./js/bootstrap-typeahead.js?19292ad"></script>
    <link rel="stylesheet" href="<?php echo ROOT_PATH ?>css/thread.css?19292ad" media="all"/>
    <link rel="stylesheet" href="./css/scp.css?19292ad" media="all"/>
    <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/redactor.css?19292ad" media="screen"/>
    <link rel="stylesheet" href="./css/typeahead.css?19292ad" media="screen"/>
    <link type="text/css" href="<?php echo ROOT_PATH; ?>css/ui-lightness/jquery-ui-1.10.3.custom.min.css?19292ad"
         rel="stylesheet" media="screen" />
     <link type="text/css" rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/font-awesome.min.css?19292ad"/>
    <!--[if IE 7]>
    <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/font-awesome-ie7.min.css?19292ad"/>
    <![endif]-->
    <link type="text/css" rel="stylesheet" href="./css/dropdown.css?19292ad"/>
    <link type="text/css" rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/loadingbar.css?19292ad"/>
    <link type="text/css" rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/rtl.css?19292ad"/>
    <script type="text/javascript" src="./js/jquery.dropdown.js?19292ad"></script>

    <?php
    if($ost && ($headers=$ost->getExtraHeaders())) {
        echo "\n\t".implode("\n\t", $headers)."\n";
    }
    ?>
</head>
<body>
<div id="container">
    <?php
    if($ost->getError())
        echo sprintf('<div id="error_bar">%s</div>', $ost->getError());
    elseif($ost->getWarning())
        echo sprintf('<div id="warning_bar">%s</div>', $ost->getWarning());
    elseif($ost->getNotice())
        echo sprintf('<div id="notice_bar">%s</div>', $ost->getNotice());
    ?>
    <div id="header">
        <p id="info" class="pull-right no-pjax"><?php echo sprintf(__('Welcome, %s.'), '<strong>'.$thisstaff->getFirstName().'</strong>'); ?>
           <?php
            if($thisstaff->isAdmin() && !defined('ADMINPAGE')) { ?>
            | <a href="admin.php" class="no-pjax"><?php echo __('Admin Panel'); ?></a>
            <?php }else{ ?>
            | <a href="index.php" class="no-pjax"><?php echo __('Agent Panel'); ?></a>
            <?php } ?>
            | <a href="profile.php"><?php echo __('My Preferences'); ?></a>
            | <a href="logout.php?auth=<?php echo $ost->getLinkToken(); ?>" class="no-pjax"><?php echo __('Log Out'); ?></a>
        </p>
        <a href="index.php" class="no-pjax" id="logo">
            <span class="valign-helper"></span>
            <img src="logo.php" alt="osTicket &mdash; <?php echo __('Customer Support System'); ?>"/>
        </a>
    </div>
    <div id="pjax-container" class="<?php if ($_POST) echo 'no-pjax'; ?>">
<?php } else {
    header('X-PJAX-Version: ' . GIT_VERSION);
    if ($pjax = $ost->getExtraPjax()) { ?>
    <script type="text/javascript">
    <?php foreach (array_filter($pjax) as $s) echo $s.";"; ?>
    </script>
    <?php }
    foreach ($ost->getExtraHeaders() as $h) {
        if (strpos($h, '<script ') !== false)
            echo $h;
    } ?>
    <title><?php echo ($ost && ($title=$ost->getPageTitle()))?$title:'osTicket :: '.__('Staff Control Panel'); ?></title><?php
} # endif X_PJAX ?>
    <ul id="nav">
<?php include STAFFINC_DIR . "templates/navigation.tmpl.php"; ?>
    </ul>
    <ul id="sub_nav">
<?php include STAFFINC_DIR . "templates/sub-navigation.tmpl.php"; ?>
    </ul>
    <div id="content">
        <?php if($errors['err']) { ?>
            <div id="msg_error"><?php echo $errors['err']; ?></div>
        <?php }elseif($msg) { ?>
            <div id="msg_notice"><?php echo $msg; ?></div>
        <?php }elseif($warn) { ?>
            <div id="msg_warning"><?php echo $warn; ?></div>
        <?php } ?>
