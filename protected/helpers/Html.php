<?php

class Html extends CHtml
{
    /**
     * Makes the given URL relative to the /image directory
     */
    public static function imageUrl($url) {
        return Yii::app()->baseUrl . '/images/' . $url;
    }
    
    /**
     * Makes the given URL relative to the /css directory
     */
    public static function cssUrl($url) {
        return Yii::app()->baseUrl . '/css/' . $url;
    }
    
    /**
     * Makes the given URL relative to the /js directory
     */
    public static function jsUrl($url) {
        return Yii::app()->baseUrl . '/js/' . $url;
    }
}
