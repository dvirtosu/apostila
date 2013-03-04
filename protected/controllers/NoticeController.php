<?php

class NoticeController extends Controller
{
    public $layout = '//layouts/document';
    
    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate($id)
    {
        $documentId = $_GET['id'];
        $model = new Notice('create');

        Yii::app()->params['currentDocumentId']       = 0;
        Yii::app()->params['currentDocumentObjectId'] = 0;
        Yii::app()->params['currentDocumentRoute']    = 'notice';

        if(isset($_POST['Notice']))
        {
            $model->attributes = $_POST['Notice'];
            $model->documentId = $documentId;
            if($model->save())
            {
                HelpersDocumentHistory::HistoryCreate($model->documentId, new Noticehistory());
                
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
        $notice = Notice::model()->findByPk($id);

        Yii::app()->params['currentDocumentId']       = $notice->id;
        Yii::app()->params['currentDocumentObjectId'] = $notice->document->id;
        Yii::app()->params['currentDocumentRoute']    = $notice->document->type->route;
        
        if(isset($_POST['Notice']))
        {
            $notice->attributes = $_POST['Notice'];
            if($notice->save())
            {
                HelpersDocumentHistory::HistoryUpdate($notice->documentId, new Noticehistory());
                
                if (isset($_POST['redirect']) && intval($_POST['redirect']))
                {
                    $this->redirect(Yii::app()->createUrl('/'));
                }
                else
                {
                    $this->redirect(array('update', 'id'=>$notice->id));
                }
            }
        }
        

        $this->render('update', array(
            'document' => $notice,
        ));
    }
    
    public function actionPreview($id)
    {
        $model = Notice::model()->findByPk($id);
        
        header("Content-type: " . $model->document->fileFormat->contentType);
        readfile(Yii::app()->basePath . '/data/files/' . $model->document->file);
    }
    
    public function actionVersionPreview($id)
    {
        $model = NoticeVersion::model()->findByPk($id);

        header("Content-type: " . $model->fileFormat->contentType);
        readfile(Yii::app()->basePath . '/data/files/' . $model->file);
    }
    
    public function actionDownloadVersion()
    {
        $model = NoticeVersion::model()->findByPk($_GET['id']);
        
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
        $result = NoticeVersion::model()->deleteByPk($_GET['id']);
        
        return ($result ? '1': '0');
    }
    
    public function actionGetDocumentCard()
    {
        $id = $_POST['documentId'];
        
        if ($id)
        {
            $model = Notice::model()->findByPk($id);
        }
        else
        {
            $model = new Notice;
            $model->message = '';
        }
        
        $this->renderPartial('/document/_document_card', array('model' => $model));
    }
    
    public function actionGetDocumentVersions()
    {
        $id = $_POST['documentId'];
        $notice = Notice::model()->findByPk($id);
        
        $model = new NoticeVersion;
        $model->instanceId = $id;
        $dataProvider = $model->search();
        $dataArray = $dataProvider->getData();
        
        $this->renderPartial('/document/_document_versions', array(
            'dataArray' => $dataArray, 
            'route' => $notice->document->type->route,
        ));
    }
    
    public function actionGetDocumentHistory()
    {
        $id = $_POST['documentId'];
        
        $instanceObj = Notice::model()->findByPk($id);
        $model = new Noticehistory;
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
