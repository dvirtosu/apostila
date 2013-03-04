<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo Html::cssUrl('form.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo Html::cssUrl('login.css') ?>" />
        <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
    </head>
    <body>
        <div id="layout">
            <?php echo $content; ?>
        </div>
    </body>
</html>
