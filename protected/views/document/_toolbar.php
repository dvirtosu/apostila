<?php
/* @var $document */
?>
<div class="toolbar">
    <div class="groupe">
        <?php $exportDisabled = ($document->document && $document->document->checkOutUserId ? ' disabled' : '') ?>
        <div class="item<?php echo $exportDisabled ?>" data-action="documentExport">
            <div>
                <div class="icon"><img src="<?php echo Html::imageUrl('icons/actions/export.png') ?>" /></div>
                <span>Exportă</span>
            </div>
        </div>
        <?php $importDisabled = ($document->document && $document->document->checkOutUserId && $document->document->checkOutUserId == Yii::app()->user->id ? '' : ' disabled') ?>
        <div class="item<?php echo $importDisabled ?>" data-action="documentImport">
            <div>
                <div class="icon"><img src="<?php echo Html::imageUrl('icons/actions/import.png') ?>" /></div>
                <span>Importă</span>
            </div>
        </div>
    </div>
    <div class="separator"></div>
    <div class="groupe">
        <div class="item disabled" data-action="documentLock">
            <div>
                <div class="icon"><img src="<?php echo Html::imageUrl('icons/actions/lock.png') ?>" /></div>
                <span>Blochează</span>
            </div>
        </div>
        <div class="item" data-action="documentSave">
            <div>
                <div class="icon"><img src="<?php echo Html::imageUrl('icons/actions/save.png') ?>" /></div>
                <span>Salvează</span>
            </div>
        </div>
        <div class="item" data-action="documentSaveAndClose">
            <div>
                <div class="icon"><img src="<?php echo Html::imageUrl('icons/actions/save-and-close.png') ?>" /></div>
                <span>Salvează şi<br />închide</span>
            </div>
        </div>
    </div>
    <div class="separator"></div>
    <div class="groupe">
        <div class="item" data-action="documentSign">
            <div>
                <div class="icon"><img src="<?php echo Html::imageUrl('icons/actions/sign.png') ?>" /></div>
                <span>Semnează</span>
            </div>
        </div>
        <div class="item" data-action="documentSendAsAttachment">
            <div>
                <div class="icon"><img src="<?php echo Html::imageUrl('icons/actions/send-as-attachment.png') ?>" /></div>
                <span>Expediază ca<br />ataşament</span>
            </div>
        </div>
    </div>
</div>
