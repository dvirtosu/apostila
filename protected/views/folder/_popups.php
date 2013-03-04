<div id="popups-content" style="display:none;">
    <div id="new-document-content">
        <div class="form" id="document-form" style="width:500px;height:200px;">
        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'document-form',
            'enableAjaxValidation'=>false,
            'action'=>Yii::app()->createUrl('document/create'),
            'htmlOptions' => array('enctype' => 'multipart/form-data'),
        )); ?>

            <p class="note">Fields with <span class="required">*</span> are required.</p>

            <?php echo $form->errorSummary($model); ?>

            <div class="row">
               <?php 
                    echo $form->labelEx($model,'file');
                    echo $form->fileField($model, 'file');
                    echo $form->error($model, 'file');
               ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model,'categoryId'); ?>
                <?php echo $form->dropDownList(
                    $model, 'categoryId', CHtml::listData(DocumentCategory::model()->findAll(), 'id', 'title'), 
                    array(
                        'prompt' => '-Select Document Category-',
                        'onchange' => CHtml::ajax(
                            array(
                                'type' => 'POST',
                                'url' => Controller::createUrl('document/categoriesOptions'),
                                'update' => '#' . CHtml::activeId($model, 'type_id')
                            )
                        )
                    )); ?>
                <?php echo $form->error($model,'categoryId'); ?>
            </div>
         
            <div class="row">
                <?php echo $form->labelEx($model, 'type_id'); ?>
                <?php echo $form->dropDownList(
                    $model, 'type_id', CHtml::listData(DocumentType::model()->findAll(), 'id', 'title'), 
                    array(
                        'prompt' => '-Select Document Type-',
                    )); ?>
                <?php echo $form->error($model,'type_id'); ?>
            </div>

            <div class="row buttons">
                <?php echo CHtml::submitButton('Create'); ?>
                <input type="button" value="cancel" />
            </div>

        <?php $this->endWidget(); ?>

        </div><!-- form -->
    </div>
    <div id="new-version-content">
        <div class="form" id="version-form" style="width:500px;height:200px;">
        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'version-form',
            'enableAjaxValidation'=>false,
            'htmlOptions' => array('enctype' => 'multipart/form-data'),
            'action'=>Yii::app()->createUrl('document/version'),
        )); ?>

            <p class="note">Fields with <span class="required">*</span> are required.</p>

            <?php echo $form->errorSummary($model); ?>
         
            <div class="row">
                <?php echo $form->hiddenField($model,'id'); ?>
            </div>
            
            <div class="row">
               <?php 
                    echo $form->labelEx($model,'file');
                    echo $form->fileField($model, 'file');
                    echo $form->error($model, 'file');
               ?>
            </div>

            <div class="row buttons">
                <?php echo CHtml::submitButton('Add new version'); ?>
            </div>

        <?php $this->endWidget(); ?>
        </div><!-- form -->
    </div>
</div>
