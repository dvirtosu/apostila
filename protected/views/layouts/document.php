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
        <link rel="stylesheet" type="text/css" href="<?php echo Html::cssUrl('document.css') ?>" />
        <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
        <script type="text/javascript" src="<?php echo Html::jsUrl('jquery.cookie.js') ?>"></script>
        <script type="text/javascript" src="<?php echo Html::jsUrl('jquery.jgrowl.js') ?>"></script>
        <script type="text/javascript" src="<?php echo Html::jsUrl('jquery.contextmenu.js') ?>"></script>
        <?php $this->renderPartial('/layouts/_js_site_object') ?>
        <script type="text/javascript">
            var CurrentDocument = {
                ID: <?php echo Yii::app()->params['currentDocumentId'] ?>,
                OBJECT_ID: <?php echo Yii::app()->params['currentDocumentObjectId'] ?>,
                ROUTE: '<?php echo Yii::app()->params['currentDocumentRoute'] ?>'
            };
        </script>
        <script type="text/javascript" src="<?php echo Html::jsUrl('common.js') ?>"></script>
        <script type="text/javascript" src="<?php echo Html::jsUrl('document.js') ?>"></script>
    </head>
    <body>
        <?php echo $content ?>
        <?php $this->renderPartial('/layouts/_popup') ?>
        <?php $this->renderPartial('/layouts/_helper_iframe') ?>
    </body>
</html>
