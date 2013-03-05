<?php

class DocumentController extends Controller
{
    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Document('create');

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Document']))
        {
            $model->attributes = $_POST['Document'];
            $model->file = CUploadedFile::getInstance($model, 'file');
            if($model->save())
            {
                $this->redirect(array($model->type->routes->title.'/create','id'=>$model->id));
            }
        }
                
        die('something wrong');
    }
    
    public function actionCategoriesOptions()
    {
        $categoryId = (int) $_POST['Document']['categoryId'];
        $criteria = new CDbCriteria;
        
        if ($categoryId > 0)
        {
            $criteria->condition='categoryId=:categoryId';
            $criteria->params=array(':categoryId' => $categoryId);
        }
        
        $models = DocumentType::model()->findAll($criteria);
        $data = CHtml::listData($models, 'id', 'title');
        foreach($data as $value=>$name)
        {
            echo CHtml::tag('option',
                   array('value'=>$value), CHtml::encode($name), true);
        }
    }
    
    public function actionDownload()
    {
        $model = Document::model()->findByPk($_GET['id']);
        
        $fileName = $model->file;
        $filePath = Yii::app()->basePath . '/data/files/' . $model->file;
        
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Transfer-Encoding: binary ");
        header("Content-disposition: attachment; filename=" . $fileName);
        echo file_get_contents($filePath);
    }
    
    public function actionCheckout()
    {
        $model = Document::model()->findByPk($_GET['id']);
        $model->checkOutUserId = Yii::app()->user->id;
        $model->save();
        
        $fileName = $model->file;
        $filePath = Yii::app()->basePath . '/data/files/' . $model->file;
        
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Transfer-Encoding: binary ");
        header("Content-disposition: attachment; filename=" . $fileName);
        echo file_get_contents($filePath);
    }
    
    public function actionVersion()
    {
        $model = Document::model()->findByPk($_POST['Document']['id']);
                
        if (isset($_POST['Document']))
        {
            $oldName = $model->file;
            
            $model->attributes = $_POST['Document'];
            $model->file = CUploadedFile::getInstance($model, 'file');
            if($model->save())
            {
                HelperVersion::add($model, $oldName);
                $this->redirect(array($model->type->routes->title.'/update','id'=>$model->instance_id));
            }
        }

        $this->render('addVersion',array(
            'model'=>$model,
        ));
    }
}
