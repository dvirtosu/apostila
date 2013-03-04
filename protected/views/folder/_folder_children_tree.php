<ul class="list<?php echo ' ' . $state ?>">
    <?php foreach($tree as $id=>$node): ?>
        <li class="item" data-folder-id="<?php echo $id ?>">
            <div class="title">
                <?php $state = $node['isOpened'] ? 'opened' : 'closed' ?>
                <?php if (count($node['children'])): ?>
                    <div class="hitarea <?php echo $state ?>"></div>
                <?php endif; ?>
                <div class="icon">
                    <?php $this->renderPartial('_folder_icon', array('folder' => $node['parent'])) ?>
                </div>
                <div class="label">
                    <a href="<?php echo Yii::app()->createUrl('folder/view', array('id'=>$id)) ?>">
                        <?php echo $node['parent']->title ?>
                    </a>
                </div>
            </div>
            <div class="clear"></div>
            <?php if (count($node['children'])): ?>
                <?php $this->renderPartial('_folder_children_tree', array('tree'=>$node['children'], 'state'=>$state)) ?>
            <?php endif; ?>
        </li>
    <?php endforeach; ?>
</ul>
