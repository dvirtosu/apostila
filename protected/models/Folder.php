<?php

/** 
 * This is the model class for table "sys_folders". 
 * 
 * The followings are the available columns in table 'sys_folders': 
 * @property string $id
 * @property string $parent_id
 * @property string $route_id
 * @property string $title
 * @property string $folder_type_id
 * @property string $content_type_id
 * @property string $search_criteria
 * @property string $document_type_id
 * @property string $create_user
 * @property string $create_time
 * @property string $update_user
 * @property string $update_time
 */ 
class Folder extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Folder the static model class
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
		return 'sys_folders';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, folder_type_id, content_type_id, create_user, create_time', 'required'),
                        array('parent_id, route_id, folder_type_id, content_type_id, document_type_id, create_user, update_user', 'length', 'max'=>20),
                        array('title', 'length', 'max'=>150),
                        array('search_criteria', 'length', 'max'=>255),
                        array('update_time', 'safe'),
                        // The following rule is used by search(). 
                        // Please remove those attributes that should not be searched. 
                        array('id, parent_id, route_id, title, folder_type_id, content_type_id, search_criteria, document_type_id, create_user, create_time, update_user, update_time', 'safe', 'on'=>'search'),
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
			'parent' => array(self::BELONGS_TO, 'Folder', 'parent_id'),
			'folders' => array(self::HAS_MANY, 'Folder', 'parent_id'),
			'type' => array(self::BELONGS_TO, 'FolderType', 'type_id'),
			'contentType' => array(self::BELONGS_TO, 'FoldercontentType', 'content_type_id'),
			'documentType' => array(self::BELONGS_TO, 'DocumentType', 'document_type_id'),
			'createUser' => array(self::BELONGS_TO, 'User', 'create_user'),
			'updateUser' => array(self::BELONGS_TO, 'User', 'update_user'),
			'folderContents' => array(self::HAS_MANY, 'FolderContent', 'folder_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array( 
                    'id' => 'ID',
                    'parent_id' => 'Parent',
                    'route_id' => 'Route',
                    'title' => 'Title',
                    'folder_type_id' => 'Folder Type',
                    'content_type_id' => 'Content Type',
                    'search_criteria' => 'Search Criteria',
                    'document_type_id' => 'Document Type',
                    'create_user' => 'Create User',
                    'create_time' => 'Create Time',
                    'update_user' => 'Update User',
                    'update_time' => 'Update Time',
                ); 
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('route_id',$this->route_id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('folder_type_id',$this->type_id);
		$criteria->compare('content_type_id',$this->content_type_id);
		$criteria->compare('search_criteria',$this->search_criteria,true);
		$criteria->compare('document_type_id',$this->document_type_id);
		$criteria->compare('create_user',$this->create_user);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_user',$this->update_user);
		$criteria->compare('update_time',$this->update_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    private function getChildren($folders, $parentId, $selectedFolderId)
    {
        $result = array();
        
        foreach ($folders as $id=>$folder)
        {
            if ($folder->parent_id == $parentId)
            {
                $children = $this->getChildren($folders, $folder->id, $selectedFolderId);
                $isOpened = false;
                if ($selectedFolderId == $folder->id)
                {
                    $isOpened = true;
                }
                else
                {
                    foreach ($children as $child)
                    {
                        if ($child['isOpened'])
                        {
                            $isOpened = true;
                            break;
                        }
                    }
                }
                
                $result[$folder->id] = array(
                    'parent'=> $folder,
                    'children' => $children,
                    'isOpened' => $isOpened,
                );
            }
        }
            
        return $result;
    }
    
    public function getTree($folderId)
    {
        $folders = self::model()->findAll();
        $tree = $this->getChildren($folders, null, $folderId);

        return $tree;
    }
}
