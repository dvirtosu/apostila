<?php

class LetterController extends Controller
{
    public $layout = '//layouts/document';
    
    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate($id)
    {
        $documentId = $_GET['id'];
        $model = new Letter('create');

        Yii::app()->params['currentDocumentId']       = 0;
        Yii::app()->params['currentDocumentObjectId'] = 0;
        Yii::app()->params['currentDocumentRoute']    = 'letter';

        if(isset($_POST['Letter']))
        {
            $model->attributes = $_POST['Letter'];
            $model->documentId = $documentId;
            if($model->save())
            {
                HelpersDocumentHistory::HistoryCreate($model->documentId, new Letterhistory());
                
                if (isset($_POST['redirect']) && intval($_POST['redirect']))
                {
                    $this->redirect(Yii::app()->createUrl('/'));
                }
                else
                {
                    $this->redirect(array('update', 'id'=>$model->id));
                }
            }
        }

        $this->render('create', array(
            'document' => $model,
        ));
    }
    
    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $letter = Letter::model()->findByPk($id);

        Yii::app()->params['currentDocumentId']       = $letter->id;
        Yii::app()->params['currentDocumentObjectId'] = $letter->document->id;
        Yii::app()->params['currentDocumentRoute']    = $letter->document->type->route;
        
        if(isset($_POST['Letter']))
        {
            $letter->attributes = $_POST['Letter'];
            if($letter->save())
            {
                HelpersDocumentHistory::HistoryUpdate($letter->documentId, new Letterhistory());
                
                if (isset($_POST['redirect']) && intval($_POST['redirect']))
                {
                    $this->redirect(Yii::app()->createUrl('/'));
                }
                else
                {
                    $this->redirect(array('update', 'id'=>$letter->id));
                }
            }
        }
        

        $this->render('update', array(
            'document' => $letter,
        ));
    }
    
    public function actionPreview($id)
    {
        $model = Letter::model()->findByPk($id);
        
        header("Content-type: " . $model->document->fileFormat->contentType);
        readfile(Yii::app()->basePath . '/data/files/' . $model->document->file);
    }
    
    public function actionVersionPreview($id)
    {
        $model = LetterVersion::model()->findByPk($id);

        header("Content-type: " . $model->fileFormat->contentType);
        readfile(Yii::app()->basePath . '/data/files/' . $model->file);
    }
    
    public function actionDownloadVersion()
    {
        $model = LetterVersion::model()->findByPk($_GET['id']);
        
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
    
    public function actionRemoveVersion()
    {
        $result = LetterVersion::model()->deleteByPk($_GET['id']);
        
        return ($result ? '1': '0');
    }
    
    public function actionGetDocumentCard()
    {
        $id = $_POST['documentId'];
        
        if ($id)
        {
            $model = Letter::model()->findByPk($id);
        }
        else
        {
            $model = new Letter;
            $model->message = '';
        }
        
        $this->renderPartial('/document/_document_card', array('model' => $model));
    }
    
    public function actionGetDocumentVersions()
    {
        $id = $_POST['documentId'];
        $letter = Letter::model()->findByPk($id);
        
        $model = new LetterVersion;
        $model->instanceId = $id;
        $dataProvider = $model->search();
        $dataArray = $dataProvider->getData();
        
        $this->renderPartial('/document/_document_versions', array(
            'dataArray' => $dataArray, 
            'route' => $letter->document->type->route,
        ));
    }
    
    public function actionGetDocumentHistory()
    {
        $id = $_POST['documentId'];
        
        $instanceObj = Letter::model()->findByPk($id);
        $model = new Letterhistory;
        $model->doc_id = $instanceObj->documentId;
        $dataProvider = $model->search();
        $dataArray = $dataProvider->getData();
        
        $this->renderPartial('/document/_document_history', array('dataArray' => $dataArray));
    }
    
    public function actionGetUnimplementedEnvironment()
    {
        echo 'Empty';
    }
}
