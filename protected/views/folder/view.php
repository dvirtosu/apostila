<?php
/* @var $folder Folder */
/* @var $folderContent Document[] */
/* @var $pagination CPagination */
?>
<div id="layout">
    <?php $this->renderPartial('_header', array('folder' => $folder)) ?>
    <?php $this->renderPartial('_content', array('folder' => $folder, 'folderContent' => $folderContent, 'pagination' => $pagination)) ?>
    <?php $this->renderPartial('_popups', array('model' => new Document)) ?>
</div>
