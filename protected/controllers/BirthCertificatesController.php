<?php

class BirthCertificatesController extends Controller
{
    
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout = '//layouts/document';

	/**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate($id)
    {
        $documentId = $_GET['id'];
        $model = new BirthCertificates('create');

        Yii::app()->params['currentDocumentId']       = 0;
        Yii::app()->params['currentDocumentObjectId'] = 0;
        Yii::app()->params['currentDocumentRoute']    = 'birthCertificates';

        if(isset($_POST['BirthCertificates']))
        {
            $model->attributes = $_POST['BirthCertificates'];
            $model->document_id = $documentId;
            if($model->save())
            {
                HelpersDocumentHistory::HistoryCreate($model->document_id, new BirthCertificatesHistory());
                
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
        $birthCertificates = BirthCertificates::model()->findByPk($id);

        Yii::app()->params['currentDocumentId']       = $birthCertificates->id;
        Yii::app()->params['currentDocumentObjectId'] = $birthCertificates->document->id;
        Yii::app()->params['currentDocumentRoute']    = $birthCertificates->document->type->routes->title;
        
        if(isset($_POST['BirthCertificates']))
        {
            $birthCertificates->attributes = $_POST['BirthCertificates'];
            if($birthCertificates->save())
            {
                HelpersDocumentHistory::HistoryUpdate($birthCertificates->document_id, new BirthCertificatesHistory());
                
                if (isset($_POST['redirect']) && intval($_POST['redirect']))
                {
                    $this->redirect(Yii::app()->createUrl('/'));
                }
                else
                {
                    $this->redirect(array('update', 'id'=>$birthCertificates->id));
                }
            }
        }
        

        $this->render('update', array(
            'document' => $birthCertificates,
        ));
    }
    
    public function actionPreview($id)
    {
        $model = BirthCertificates::model()->findByPk($id);
        
        header("Content-type: " . $model->document->fileFormat->content_type_id);
        readfile(Yii::app()->basePath . '/data/files/' . $model->document->file);
    }
    
    public function actionVersionPreview($id)
    {
        $model = BirthCertificatesVersion::model()->findByPk($id);

        header("Content-type: " . $model->fileFormat->content_type_id);
        readfile(Yii::app()->basePath . '/data/files/' . $model->file);
    }
    
    public function actionDownloadVersion()
    {
        $model = BirthCertificatesVersion::model()->findByPk($_GET['id']);
        
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
        $result = BirthCertificatesVersion::model()->deleteByPk($_GET['id']);
        
        return ($result ? '1': '0');
    }
    
    public function actionGetDocumentCard()
    {
        $id = $_POST['document_id'];
        
        if ($id)
        {
            $model = BirthCertificates::model()->findByPk($id);
        }
        else
        {
            $model = new BirthCertificates;
            
        }
        
        $this->renderPartial('/birthCertificates/_document_card', array('model' => $model));
    }
    
    public function actionGetDocumentVersions()
    {
        $id = $_POST['document_id'];
        $model_dt = BirthCertificates::model()->findByPk($id);
        
        $model = new BirthCertificatesVersion;
        $model->instance_id = $id;
        $dataProvider = $model->search();
        $dataArray = $dataProvider->getData();
        
        $this->renderPartial('/document/_document_versions', array(
            'dataArray' => $dataArray, 
            'route' => $model_dt->document->type->routes->title,
        ));
    }
    
    public function actionGetDocumentHistory()
    {
        $id = $_POST['document_id'];
        
        $instanceObj = BirthCertificates::model()->findByPk($id);
        $model = new BirthCertificatesHistory;
        $model->doc_id = $instanceObj->document_id;
        $dataProvider = $model->search();
        $dataArray = $dataProvider->getData();
        
        $this->renderPartial('/document/_document_history', array('dataArray' => $dataArray));
    }
    
    public function actionGetUnimplementedEnvironment()
    {
        echo 'Empty';
    }
}
