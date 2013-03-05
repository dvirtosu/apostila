<div style="margin-top:15px;margin-left:20px;border:1px solid #A59E9B;width:600px;height:520px;background-color:#F0F0E7;">
    <form method="POST" id="edit-card-form" style="padding:10px;">
        <input type="hidden" name="redirect" id="c-redirect" value="0" />
        <?php $form=$this->beginWidget('CActiveForm', array( 
            'id'=>'edit-card-form"', 
            'enableAjaxValidation'=>false, 
        )); ?>

            <?php echo $form->errorSummary($model); ?>
            <table border="0">
                <tr>
                    <td colspan = "4" align="center">
                        <p class="note">Fields with <span class="required">*</span> are required.</p> 
                    </td>
                </tr>
                <tr>
                    <td colspan = "4">
                        </br>
                    </td>
                </tr>
                <tr>
                    <td>                        
                            <?php echo $form->labelEx($model,'idnp'); ?>
                    </td>
                    <td>
                            <?php echo $form->textField($model,'idnp',array('size'=>20,'maxlength'=>20)); ?>
                            <?php echo $form->error($model,'idnp'); ?>
                    </td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                            <?php echo $form->labelEx($model,'name'); ?>
                    </td>
                    <td colspan = "3">
                            <?php echo $form->textField($model,'name',array('size'=>66,'maxlength'=>150)); ?>
                            <?php echo $form->error($model,'name'); ?>
                    </td>
                </tr>
                <tr>
                    <td> 
                        <?php echo $form->labelEx($model,'surname'); ?>
                    </td>
                    <td colspan = "3">
                        <?php echo $form->textField($model,'surname',array('size'=>66,'maxlength'=>150)); ?>
                        <?php echo $form->error($model,'surname'); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo $form->labelEx($model,'sex'); ?>
                    </td>
                    <td>
                        <?php echo $form->textField($model,'sex',array('size'=>1,'maxlength'=>1)); ?>
                        <?php echo $form->error($model,'sex'); ?>
                    </td>
                    <td>
                        <?php echo $form->labelEx($model,'birth_date'); ?>
                    </td>
                    <td>
                        <?php echo $form->textField($model,'birth_date'); ?>
                        <?php echo $form->error($model,'birth_date'); ?>
                    </td>
                </tr>
                <tr>
                    <td colspan = "4">
                        </br>
                    </td>
                </tr>                
                <tr>
                    <td>
                        <?php echo $form->labelEx($model,'birth_cities_id'); ?>
                    </td>
                    <td colspan = "3">
                        <?php echo $form->textField($model,'birth_cities_id',array('size'=>66,'maxlength'=>66)); ?>
                        <?php echo $form->error($model,'birth_cities_id'); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo $form->labelEx($model,'birth_countries_id'); ?>
                    </td>
                    <td colspan = "3">
                        <?php echo $form->textField($model,'birth_countries_id',array('size'=>66,'maxlength'=>66)); ?>
                        <?php echo $form->error($model,'birth_countries_id'); ?>
                    </td>                    
                </tr>
                <tr>
                    <td colspan = "4">
                        </br>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo $form->labelEx($model,'idnp_dad'); ?>
                    </td>
                    <td>
                        <?php echo $form->textField($model,'idnp_dad',array('size'=>20,'maxlength'=>20)); ?>
                        <?php echo $form->error($model,'idnp_dad'); ?>
                    </td>
                    <td>
                        <?php echo $form->labelEx($model,'nationality_dad_id'); ?>
                    </td>
                    <td>
                        <?php echo $form->textField($model,'nationality_dad_id',array('size'=>20,'maxlength'=>20)); ?>
                        <?php echo $form->error($model,'nationality_dad_id'); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo $form->labelEx($model,'name_surname_dad'); ?>
                    </td>
                    <td colspan = "3">
                        <?php echo $form->textField($model,'name_surname_dad',array('size'=>66,'maxlength'=>200)); ?>
                        <?php echo $form->error($model,'name_surname_dad'); ?>
                    </td>
                </tr>
                <tr>
                    <td colspan = "4">
                        </br>
                    </td>
                </tr>                
                <tr>
                    <td>
                        <?php echo $form->labelEx($model,'idnp_mom'); ?>
                    </td>
                    <td>
                        <?php echo $form->textField($model,'idnp_mom',array('size'=>20,'maxlength'=>20)); ?>
                        <?php echo $form->error($model,'idnp_mom'); ?>
                    </td>
                    <td>
                       <?php echo $form->labelEx($model,'nationality_mom_id'); ?> 
                    </td>
                    <td>
                        <?php echo $form->textField($model,'nationality_mom_id',array('size'=>20,'maxlength'=>20)); ?>
                        <?php echo $form->error($model,'nationality_mom_id'); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo $form->labelEx($model,'name_surname_mom'); ?>
                    </td>
                    <td colspan = "3">
                        <?php echo $form->textField($model,'name_surname_mom',array('size'=>66,'maxlength'=>200)); ?>
                        <?php echo $form->error($model,'name_surname_mom'); ?>
                    </td>
                </tr>
                <tr>
                    <td colspan = "4">
                        </br>
                    </td>
                </tr>                
                <tr>
                    <td>
                        <?php echo $form->labelEx($model,'act_number'); ?>
                    </td>
                    <td>
                        <?php echo $form->textField($model,'act_number',array('size'=>20,'maxlength'=>20)); ?>
                        <?php echo $form->error($model,'act_number'); ?>
                    </td>
                    <td>
                        <?php echo $form->labelEx($model,'registration_date'); ?>
                    </td>
                    <td>
                        <?php echo $form->textField($model,'registration_date'); ?>
                        <?php echo $form->error($model,'registration_date'); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo $form->labelEx($model,'registration_osc_office_id'); ?>
                    </td>
                    <td colspan = "3">
                        <?php echo $form->textField($model,'registration_osc_office_id',array('size'=>66,'maxlength'=>65)); ?>
                        <?php echo $form->error($model,'registration_osc_office_id'); ?>
                    </td>
                </tr>
                <tr>
                    <td colspan = "4">
                        </br>
                    </td>
                </tr>                
                <tr>
                    <td>
                        <?php echo $form->labelEx($model,'date_of_issue'); ?>
                    </td>
                    <td>
                        <?php echo $form->textField($model,'date_of_issue'); ?>
                        <?php echo $form->error($model,'date_of_issue'); ?>
                    </td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        <?php echo $form->labelEx($model,'office_issue_id'); ?>
                    </td>
                    <td colspan = "3">
                        <?php echo $form->textField($model,'office_issue_id',array('size'=>66,'maxlength'=>65)); ?>
                        <?php echo $form->error($model,'office_issue_id'); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo $form->labelEx($model,'osc_public_official_id'); ?>
                    </td>
                    <td colspan = "3">
                        <?php echo $form->textField($model,'osc_public_official_id',array('size'=>66,'maxlength'=>65)); ?>
                        <?php echo $form->error($model,'osc_public_official_id'); ?>
                    </td>
                </tr>
                <tr>
                    <td colspan = "4">
                        </br>
                    </td>
                </tr>                
                <tr>
                    <td>
                        <?php echo $form->labelEx($model,'certificate_series'); ?>
                    </td>
                    <td>
                        <?php echo $form->textField($model,'certificate_series',array('size'=>10,'maxlength'=>10)); ?>
                        <?php echo $form->error($model,'certificate_series'); ?>
                    </td>
                    <td>
                        <?php echo $form->labelEx($model,'certificate_number'); ?>
                    </td>
                    <td>
                        <?php echo $form->textField($model,'certificate_number',array('size'=>20,'maxlength'=>20)); ?>
                        <?php echo $form->error($model,'certificate_number'); ?>
                    </td>
                </tr>
            </table>
        <?php $this->endWidget(); ?>
    </form>
</div>
