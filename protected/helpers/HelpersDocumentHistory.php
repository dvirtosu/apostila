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
        
        $history->DataTime = date('Y-m-d h:i:s', time());
        $history->Action_id = DocumentAction::model()->find('Description='."'".'Create'."'")->id;
        $history->doc_id = $id;
        $history->Doc_version = 1;
        $history->User_id = $user->getId();
        if ($history->validate()) 
            $history->save();
    }
    public static function HistoryUpdate($id,$history)
    {
        $user = Yii::app()->user;
        
        $history->DataTime = date('Y-m-d h:i:s', time());
        $history->Action_id = DocumentAction::model()->find('Description='."'".'Update'."'")->id;
        $history->doc_id = $id;
        $history->Doc_version = 1;
        $history->User_id = $user->getId();
        if ($history->validate()) 
            $history->save();
    }
    public static function HistoryMoveToOperativ($id,$history)
    {
        $history->DataTime = date('Y-m-d h:i:s', time());
        $history->Action_id = DocumentAction::model()->find('Description='."'".'MoveToOperativ'."'")->id;
        $history->doc_id = $id;
        $history->Doc_version = 1;
        $history->User_id = Yii::app()->user->id;
        if ($history->validate()) 
            $history->save();
    }
}
?>
