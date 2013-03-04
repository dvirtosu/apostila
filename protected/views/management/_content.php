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
            <?php $this->renderPartial('_toolbar') ?>
        </div>
        <?php $this->renderPartial('_tools') ?>
    </div>
</div>
