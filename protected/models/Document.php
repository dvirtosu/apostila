<?php

/** 
 * This is the model class for table "sys_documents". 
 * 
 * The followings are the available columns in table 'sys_documents': 
 * @property string $id
 * @property string $title
 * @property string $type_id
 * @property string $file_format_id
 * @property string $instance_id
 * @property string $check_out_user_id
 * @property string $file
 * @property string $create_user_id
 * @property string $create_time
 * @property string $update_user_id
 * @property string $update_time
 */ 
class Document extends CActiveRecord
{
    public $categoryId;
    
    public $file;
    
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Document the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'sys_documents';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('type_id', 'required', 'on'=>'create'),
            array('file','file',
                //'types'=>GetUploadFormat(), //types of files
                //'minSize'=>GetUploadMinSize(), //minimal size of img
                //'maxSize'=>GetUploadMaxSize(), //maximal size of image
                'on' => 'create',
            ),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, title, type_id, file_format_id, instance_id, check_out_user_id, file, create_user_id, create_time, update_user_id, update_time', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'type' => array(self::BELONGS_TO, 'DocumentType', 'type_id'),
            'fileFormat' => array(self::BELONGS_TO, 'FileFormat', 'file_format_id'),
            'createUser' => array(self::BELONGS_TO, 'User', 'create_user_id'),
            'updateUser' => array(self::BELONGS_TO, 'User', 'update_user_id'),
            'folderContents' => array(self::HAS_MANY, 'FolderContent', 'document_id'),
            'letters' => array(self::HAS_MANY, 'Letter', 'document_id'),
            'notices' => array(self::HAS_MANY, 'Notice', 'document_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
         return array( 
            'id' => 'ID',
            'title' => 'Title',
            'type_id' => 'Type',
            'file_format_id' => 'File Format',
            'instance_id' => 'Instance',
            'check_out_user_id' => 'Check Out User',
            'file' => 'File',
            'create_user_id' => 'Create User',
            'create_time' => 'Create Time',
            'update_user_id' => 'Update User',
            'update_time' => 'Update Time',
        );
    }

    /**
     * This is invoked before validation starts.
     * @return boolean whether validation should be executed. Defaults to true.
     * If false is returned, the validation will stop and the model is considered invalid.
     */
    public function beforeValidate()
    {
        if($this->isNewRecord)
        {
            //$this->file = CUploadedFile::getInstance($this, 'file');
        }
        return parent::beforeValidate();
    }
    
    /**
     * This is invoked before the record is saved.
     * @return boolean whether the record should be saved.
     */
    protected function beforeSave()
    {
        if(parent::beforeSave())
        {
            $user = Yii::app()->user;
            
            if($this->isNewRecord)
            {
                $extension = pathinfo($this->file->name, PATHINFO_EXTENSION);
                $fileName = uniqid() . '.' . $extension;
                $this->file->saveAs(Yii::app()->basePath . '/data/files/' . $fileName);
                
                $documentType = DocumentType::model()->findByPk($this->type_id);
                $this->title = $documentType->title . ' ' . rand();
                $this->file_format_id = HelpersStorage::Getfile_format_idByExtension($extension);
                $this->file = $fileName;
                $this->create_user_id = $user->getId();
                $this->create_time = new CDbExpression('NOW()');
            } else
            {
                $this->update_user_id = $user->getId();
                $this->update_time = new CDbExpression('NOW()');
            }
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function searchInFolder(Folder $folder)
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;
        
        switch ($folder->content_type_id)
        {
            case 1: // Model
                $criteria->compare('type_id', $folder->document_type_id);
                break;
            case 2: // Search
                if (empty($folder->search_criteria))
                {
                    $criteria->condition = 'type_id=:type_id';
                }
                else
                {
                    $criteria->condition = $folder->searchCriteria . ' AND type_id=:type_id';
                }
                $criteria->params = array_merge($criteria->params, array(":type_id"=>$folder->documenttype_id));
                break;
            case 3: // Sample
                $criteria->with = array('folderContents'=>array(
                    'on' => 'folderContents.folder_id=' . $folder->id,
                    'together'=>true,
                    'joinType'=>'INNER JOIN',
                ));
                break;
        }
        
        $criteria->compare('id',$this->id);
        $criteria->compare('title',$this->title,true);
        $criteria->compare('file_format_id',$this->file_format_id);
        $criteria->compare('create_user_id',$this->create_user_id);
        $criteria->compare('create_time',$this->create_time,true);
        $criteria->compare('update_user_id',$this->update_user_id);
        $criteria->compare('update_time',$this->update_time,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination' => array('pageSize' => 10),
        ));
    }
    
    public function checkOut($user) 
    {
        if ($this->id) 
        {
            return false;
        }
        
        
        
        return true;
    }
}
