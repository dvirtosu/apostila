<?php

class ManagementController extends Controller
{
    public $layout = '//layouts/management';
    
    public function actionIndex()
    {
        $this->render('index');
    }
    
    public function actionGetUnimplementedEnvironment()
    {
        //$scope = $_POST['scope'];
        //echo 'Empty - ' . $scope;
        echo 'Empty';
    }
}
