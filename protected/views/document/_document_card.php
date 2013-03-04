<div style="margin-top:15px;margin-left:20px;border:1px solid #A59E9B;width:584px;height:378px;">
    <form method="POST" id="edit-card-form" style="padding:10px;">
        <input type="hidden" name="redirect" id="c-redirect" value="0" />
        <div>
            <label style="width:400px;">Message</label>
            <input type="text" value="<?php echo $model->message ?>" name="<?php echo get_class($model) ?>[message]" style="border:1px solid #aaa;" />
        </div>
    </form>
</div>
