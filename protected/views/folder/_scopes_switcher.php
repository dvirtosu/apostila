<div class="scopes-switcher">
    <div class="scopes-box">
        <div class="scopes-list">
            <div class="item selected" data-scope="foldersTree">
                <div>
                    <div><img src="<?php echo Html::imageUrl('icons/actions/folders-tree.png') ?>" /></div>
                    <span>Arborele dosarelor</span>
                    <sup></sup>
                </div>
            </div>
            <div class="item" data-scope="run">
                <div class="offset">
                    <div><img src="<?php echo Html::imageUrl('icons/actions/run.png') ?>" /></div>
                    <span>Porneşte</span>
                    <sup></sup>
                </div>
            </div>
            <div class="item" data-scope="generalSearch">
                <div class="offset">
                    <div><img src="<?php echo Html::imageUrl('icons/actions/general-search.png') ?>" /></div>
                    <span>Căutare generală</span>
                    <sup></sup>
                </div>
            </div>
            <div class="item" data-scope="documentSearch">
                <div class="offset">
                    <div><img src="<?php echo Html::imageUrl('icons/actions/document-search.png') ?>" /></div>
                    <span>Căutarea documentelor</span>
                    <sup></sup>
                </div>
            </div>
            <div class="item last" data-scope="folderSearch">
                <div class="offset">
                    <div><img src="<?php echo Html::imageUrl('icons/actions/folder-search.png') ?>" /></div>
                    <span>Căutarea dosarelor</span>
                    <sup></sup>
                </div>
            </div>
        </div>
    </div>
    <div class="scope-environment">
        <div data-scope="foldersTree" data-status="pending">
            <img src="<?php echo Html::imageUrl('spinner.gif') ?>" />
        </div>
        <div data-scope="run" data-status="pending">
            <img src="<?php echo Html::imageUrl('spinner.gif') ?>" />
        </div>
        <div data-scope="generalSearch" data-status="pending">
            <img src="<?php echo Html::imageUrl('spinner.gif') ?>" />
        </div>
        <div data-scope="documentSearch" data-status="pending">
            <img src="<?php echo Html::imageUrl('spinner.gif') ?>" />
        </div>
        <div data-scope="folderSearch" data-status="pending">
            <img src="<?php echo Html::imageUrl('spinner.gif') ?>" />
        </div>
    </div>
    <div class="clear"></div>
</div>
