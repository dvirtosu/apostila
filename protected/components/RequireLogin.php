<?php

class RequireLogin extends CBehavior
{
    public function attach($owner)
    {
        $owner->attachEventHandler('onBeginRequest', array($this, 'handleBeginRequest'));
    }
    
    public function handleBeginRequest($event)
    {
        if (Yii::app()->user->isGuest && !in_array(Yii::app()->request->pathinfo, array('site/login'))) 
        {
            Yii::app()->user->loginRequired();
        }
    }
}
