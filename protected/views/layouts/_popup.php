<div id="popup-template" style="display:none">
    <!--[if lt IE 9]><div class="popup__overlay popup__overlay_ie"></div><![endif]-->
    <div class="improved_popup__overlay" >
        <div class="improved_popup">
            <div class="improved_popup_top clearfix">
                <div class="improved_close_popup right">
                    <img src="<?php echo Html::imageUrl('close-popup.png') ?>" alt="" onclick="$('#popup-template').hide();">
                </div>
            </div>
            <div class="template-content"></div>
        </div>
         <!--[if lt IE 9]><div class="popup__valignfix"></div><![endif]-->
    </div>
</div>
