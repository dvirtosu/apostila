<?php
/* @var $folder Folder */
/* @var $itemsCount int */
?>
<div class="tools">
    <div class="list">
        <input type="checkbox" class="select" />
        <div class="copy" title="Copy">
            <img src="<?php echo Html::imageUrl('icons/16/copy-links.png') ?>" />
        </div>
        <div class="paste" title="Paste">
            <img src="<?php echo Html::imageUrl('icons/16/paste-links.png') ?>" />
        </div>
        <div class="delete" title="Delete">
            <img src="<?php echo Html::imageUrl('icons/16/delete-links.png') ?>" />
        </div>
        <div class="filter">
            <input type="text" value="Filtrare" />
        </div>
        <div class="count">
            <img src="<?php echo Html::imageUrl('icons/16/list.png') ?>" />
            <span><?php echo $itemsCount ?></span>
        </div>
    </div>
</div>
