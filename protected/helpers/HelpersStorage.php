<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class HelpersStorage
{
    public static function Getfile_format_idByExtension($ext)
    {
        $format =  FileFormat::model()->find('extension=:extension', array(':extension'=>$ext));
        return $format->id;
    }
}

