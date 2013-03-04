<?php
/* @var $folder Folder */
/* @var $folderContent Document[] */
/* @var $pagination CPagination */
?>
<div id="content">
    <div class="left-column">
        <div class="sidebar-container">
            <?php $this->renderPartial('_scopes_switcher') ?>
            <?php $this->renderPartial('_content_extensions') ?>
        </div>
    </div>
    <div class="right-column">
        <div class="shadow-container"><div class="shadow"></div></div>
        <div class="toolbar-container">
            <?php $this->renderPartial('_toolbar', array('folder' => $folder)) ?>
        </div>
        <?php $this->renderPartial('_tools', array('folder' => $folder, 'itemsCount' => $pagination->itemCount)) ?>
        <div class="objects-list-container">
            <?php $this->renderPartial('_objects_list', array('folder' => $folder, 'folderContent' => $folderContent)) ?>
        </div>
        <div class="bottom-container">
            <div class="pagination-container">
                <?php $this->widget('AjaxPager', array(
                    'pages' => $pagination,
                )) ?>
            </div>
            <div class="properties-container">
                <div class="selected-objects-counter"></div>
            </div>
        </div>
    </div>
</div>
