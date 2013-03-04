<?php
/* @var $folder Folder */
?>
<div id="header">
    <div class="left-column">
        <a href="<?php echo $this->createUrl('site/logout') ?>">logout</a>
    </div>
    <div class="right-column">
        <div class="title-container">
            <?php $this->renderPartial('_folder_icon', array('folder' => $folder)) ?>
            <span><?php echo $folder->title ?></span>
        </div>
    </div>
</div>
