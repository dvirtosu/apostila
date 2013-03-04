<?php

class FolderController extends Controller
{
    public $layout = '//layouts/folder';
    
    public function actionView()
    {
        if ( ! isset($_GET['id']))
        {
            throw new CHttpException(404);
        }
        
        $folderId = $_GET['id'];
        
        $folder = Folder::model()->findByPk($folderId);
        
        $dataProvider = Document::model()->searchInFolder($folder);
        
        Yii::app()->params['current_folder_id'] = $folderId;
        
        $this->render('view', array(
            'folder'        => $folder,
            'folderContent' => $dataProvider->getData(),
            'pagination'    => $dataProvider->getPagination(),
        ));
    }

    public function actionGetFoldersTreeEnvironment()
    {
        $folderId = $_POST['folderId'];
        $tree = Folder::model()->getTree($folderId);
        $this->renderPartial('_folders_tree', array('tree' => $tree));
    }
    
    public function actionGetUnimplementedEnvironment()
    {
        //$scope = $_POST['scope'];
        //echo 'Empty - ' . $scope;
        echo 'Empty';
    }
    
    public function actionAddObjects()
    {
        $folderId = $_POST['folderId'];
        $selectedObjectsIds = $_POST['selectedObjectsIds'];
        
        if ($folderId && $selectedObjectsIds)
        {
            $folder = Folder::model()->findByPk($_POST['folderId']);
            $selectedObjectsIds = array_unique($selectedObjectsIds);
            
            if ($folder && $folder->content_type_id == 3 && !empty($folder->route_id))
            {
                foreach ($selectedObjectsIds as $id)
                {
                    $folderContent = new FolderContent();
                    $folderContent->folder_id = $folder->id;
                    $folderContent->document_id = $id;
                    $folderContent->save();
                }
            }
        }
    }
}
