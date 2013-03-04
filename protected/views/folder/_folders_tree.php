<?php

?>
<div class="folders-tree">
    <?php $this->renderPartial('_folder_children_tree', array('tree'=>$tree, 'state'=>'opened')) ?>
</div>
