<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HelperVersion
 *
 * @author Virtuosu
 */

class HelperVersion {
    //put your code here
    
    private static function moveName($model,$oldName)
    {
        $user = Yii::app()->user;
        
        $dt =$model->type->instanceModelName.'Version';  //LetterVersion;
        $version = new $dt;
        $version->instanceId = $model->instanceId;
        $version->file_format_id = $model->file_format_id;
        $version->file = $oldName;
        $version->updateUserId = $user->getId();
        $version->update_time = new CDbExpression('NOW()');
        $version->save();
    }
    
    public static function add($model,$oldName)
    {
        HelperVersion::moveName($model,$oldName);
        
        $extension = pathinfo($model->file->name, PATHINFO_EXTENSION);
        $fileName = uniqid() . '.' . $extension;
        $model->file->saveAs(Yii::app()->basePath . '/data/files/' . $fileName);
                
        $file_format_id = HelpersStorage::Getfile_format_idByExtension($extension);
        
        $model->updateByPk($model->id, array('file_format_id'=>$file_format_id, 'file'=>$fileName, 'checkOutUserId'=>null));
    }
}

?>
