<?php
/* @var $document */
?>
<div id="layout">
    <?php $this->renderPartial('/document/_header', array('document' => $document)) ?>
    <?php $this->renderPartial('/document/_content', array('document' => $document)) ?>
    <?php $this->renderPartial('/folder/_popups', array('model' => new Document)) ?>
</div>
