<?php
/* @var $document */
?>
<div id="content">
    <div class="left-column">
        <div class="sidebar-container">
            <?php $this->renderPartial('/document/_scopes_switcher') ?>
        </div>
    </div>
    <div class="right-column">
        <div class="shadow-container"><div class="shadow"></div></div>
        <div class="toolbar-container">
            <?php $this->renderPartial('/document/_toolbar', array('document' => $document)) ?>
        </div>
        <div class="scope-environment">
            <div data-scope="documentCard" data-status="pending">
                <img src="<?php echo Html::imageUrl('spinner.gif') ?>" />
            </div>
            <div data-scope="documentVersions" data-status="pending">
                <img src="<?php echo Html::imageUrl('spinner.gif') ?>" />
            </div>
            <div data-scope="documentRights" data-status="pending">
                <img src="<?php echo Html::imageUrl('spinner.gif') ?>" />
            </div>
            <div data-scope="documentSignInfo" data-status="pending">
                <img src="<?php echo Html::imageUrl('spinner.gif') ?>" />
            </div>
            <div data-scope="documentBounds" data-status="pending">
                <img src="<?php echo Html::imageUrl('spinner.gif') ?>" />
            </div>
            <div data-scope="documentHistory" data-status="pending">
                <img src="<?php echo Html::imageUrl('spinner.gif') ?>" />
            </div>
        </div>
    </div>
</div>
