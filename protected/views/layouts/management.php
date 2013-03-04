<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo Html::cssUrl('jquery.jgrowl.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo Html::cssUrl('jquery.contextmenu.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo Html::cssUrl('form.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo Html::cssUrl('common.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo Html::cssUrl('layout.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo Html::cssUrl('elements.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo Html::cssUrl('management.css') ?>" />
        <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
        <script type="text/javascript" src="<?php echo Html::jsUrl('jquery.cookie.js') ?>"></script>
        <script type="text/javascript" src="<?php echo Html::jsUrl('jquery.jgrowl.js') ?>"></script>
        <script type="text/javascript" src="<?php echo Html::jsUrl('jquery.contextmenu.js') ?>"></script>
        <?php $this->renderPartial('/layouts/_js_site_object') ?>
        <script type="text/javascript">
            var CurrentManagement = {
                
            };
        </script>
        <script type="text/javascript" src="<?php echo Html::jsUrl('common.js') ?>"></script>
        <script type="text/javascript" src="<?php echo Html::jsUrl('management.js') ?>"></script>
    </head>
    <body>
        <?php echo $content ?>
    </body>
</html>
