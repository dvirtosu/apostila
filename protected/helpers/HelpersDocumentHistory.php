<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
 class HelpersDocumentHistory
 {
    public static function HistoryCreate($id,$history)
    {
        $user = Yii::app()->user;
        
        $history->update_time = date('Y-m-d h:i:s', time());
        $history->action_id = DocumentAction::model()->find('Description='."'".'Create'."'")->id;
        $history->document_id = $id;
        $history->version_id = 1;
        $history->update_user = $user->getId();
        if ($history->validate()) 
            $history->save();
    }
    public static function HistoryUpdate($id,$history)
    {
        $user = Yii::app()->user;
        
        $history->update_time = date('Y-m-d h:i:s', time());
        $history->action_id = DocumentAction::model()->find('Description='."'".'Update'."'")->id;
        $history->document_id = $id;
        $history->version_id = 1;
        $history->update_user = $user->getId();
        if ($history->validate()) 
            $history->save();
    }
    public static function HistoryMoveToOperativ($id,$history)
    {
        $history->update_time = date('Y-m-d h:i:s', time());
        $history->action_id = DocumentAction::model()->find('Description='."'".'MoveToOperativ'."'")->id;
        $history->document_id = $id;
        $history->version_id = 1;
        $history->update_user = Yii::app()->user->id;
        if ($history->validate()) 
            $history->save();
    }
}
?>
