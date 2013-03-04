<?php
/* @var $document */
?>
<div id="header">
    <div class="left-column"></div>
    <div class="right-column">
        <div class="title-container">
            <img src="<?php echo Html::imageUrl('icons/24/pdf.gif') ?>" />
            <span>
                <?php if ($document->id): ?>
                    <?echo get_class($document) . ' #' . $document->id ?>
                <?php else: ?>
                    New <?echo get_class($document) ?>
                <?php endif; ?>
            </span>
        </div>
        <div class="nav-actions right">
            <ul class="h-list">
                <li><a href="<?php echo Yii::app()->createUrl('/') ?>">Înapoi la listă</a></li>
                <li><a href="<?php echo Yii::app()->createUrl('/') ?>">Închide</a></li>
            </ul>
        </div>
    </div>
</div>
