<?php
/* @var $folder Folder */
/* @var $folderContent Document[] */
?>
<div class="objects-list">
    <?php foreach ($folderContent as $data): ?>
        <div class="item" data-object-id="<?php echo $data->id ?>">
            <div class="context-menu">
                <div>
                    <img src="<?php echo Html::imageUrl('icons/context-menu.png') ?>" />
                </div>
            </div>
            <div class="icon">
                <img src="<?php echo Html::imageUrl($data->fileFormat->icon) ?>" />
                <div class="chk"><input type="checkbox" /></div>
            </div>
            <div class="content">
                <div class="title">
                    <a href="<?php echo Yii::app()->createUrl($data->type->route."/preview", array("id"=>$data->instanceId)) ?>">
                        <?php echo $data->title ?>
                    </a>
                </div>
                <div class="body">
                    <div class="info">
                        <span>Autor: <?php echo $data->createUser->username ?></span>
                    </div>
                    <div class="actions">
                        <img src="<?php echo Html::imageUrl('icons/16/card.gif') ?>" />
                        <a href="<?php echo Yii::app()->createUrl($data->type->route."/update", array("id"=>$data->instanceId)) ?>" class="open-card">
                            Deschide Cartela
                        </a>
                        <a href="#" class="mark-unread">Marchează ca necitit</a>
                        <?php if ($folder->content_type_id == 3): ?>
                            <img src="<?php echo Html::imageUrl('icons/16/delete-links.png') ?>" />
                            <a href="#" class="delete-reference">Şterge referinţă</a>
                        <?php endif; ?>
                        <img src="<?php echo Html::imageUrl('icons/16/copy-links.png') ?>" />
                        <a href="#" class="copy-reference">Copie referinţă</a>
                        <?php if ($data->checkOutUserId): ?>
                            <?php if ($data->checkOutUserId == Yii::app()->user->id): ?>
                                <a href="#" class="checkin">check in</a>
                            <?php endif; ?>
                        <?php else: ?>
                            <a href="#" class="checkout">check out</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="status">
                <div>
                    <img src="<?php echo Html::imageUrl('icons/16/status-box.png') ?>" />
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
