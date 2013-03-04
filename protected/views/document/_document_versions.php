<div style="padding:10px 20px;">
<div class="objects-list">
    <?php if ( ! $dataArray): ?>
        no versions
    <?php else: ?>
        <?php $counter = 0; ?>
        <?php foreach ($dataArray as $data): ?>
        <?php $counter++; ?>
        <div class="item" data-version-id="<?php echo $data->id ?>">
            <div class="context-menu">
                <div>
                    <img src="<?php echo Html::imageUrl('icons/context-menu.png') ?>" />
                </div>
            </div>
            <div class="icon">
                <img src="<?php echo Html::imageUrl($data->fileFormat->icon) ?>" />
            </div>
            <div class="content">
                <div class="title">
                    <a href="<?php echo Yii::app()->createUrl($route."/versionpreview", array("id"=>$data->id)) ?>">
                        Versiunea #<?php echo $data->id ?>
                    </a>
                </div>
                <div class="body">
                    <div class="info">
                        <span>Autor: <?php echo $data->updateUser->username ?></span>
                    </div>
                    <div class="actions">
                        <a href="#" class="mark-unread">Marchează ca necitit</a>
                        <img src="<?php echo Html::imageUrl('icons/16/delete-links.png') ?>" />
                        <a href="#" class="delete-version">Şterge versiune</a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
</div>
