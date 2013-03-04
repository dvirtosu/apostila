<?php
/* @var $folder Folder */
?>
<?php if ($folder->content_type_id == 1): ?>
    <img src="<?php echo Html::imageUrl('icons/16/inbox-folder.png') ?>" />
<?php elseif ($folder->content_type_id == 2): ?>
    <img src="<?php echo Html::imageUrl('icons/16/outbox-folder.png') ?>" />
<?php else: ?>
    <img src="<?php echo Html::imageUrl('icons/16/ordinary-folder.png') ?>" />
<?php endif; ?>
