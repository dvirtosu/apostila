<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class CustomCHtml extends CHtml
{
    public static function activeLabelEx($model,$attribute,$htmlOptions=array())
    {
        if (isset($htmlOptions['optional']) && $htmlOptions['optional']) {
            if (isset($htmlOptions['label']) && $htmlOptions['label']) {
                $htmlOptions['label'] .= $htmlOptions['optional'];
            } else {
                $htmlOptions['label'] = $htmlOptions['optional'];
            }
        }

        return parent::activeLabelEx($model,$attribute,$htmlOptions);
    }
}
?>
