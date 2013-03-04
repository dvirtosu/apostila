<div class="content-extensions">
    <div class="item">
        <a href="<?php echo $this->createUrl('folder/view', array('id'=>FolderHelper::DEFAULT_FOLDER_ID)) ?>">
            <div class="icon">
                <img src="<?php echo Html::imageUrl('icons/24/home.png') ?>" />
            </div>
            <div class="title">Versiunea Basic</div>
            <div class="clear"></div>
        </a>
    </div>
    <div class="item">
        <a href="<?php echo $this->createUrl('/management') ?>">
            <div class="icon">
                <img src="<?php echo Html::imageUrl('icons/24/home.png') ?>" />
            </div>
            <div class="title">Versiunea Management</div>
            <div class="clear"></div>
        </a>
    </div>
</div>
