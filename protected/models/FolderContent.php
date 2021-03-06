<?php

/** 
 * This is the model class for table "sys_folders_contents". 
 * 
 * The followings are the available columns in table 'sys_folders_contents': 
 * @property string $id
 * @property string $folder_id
 * @property string $document_id
 * @property string $create_user
 * @property string $create_time
 * @property string $update_user
 * @property string $update_time
 */ 
class FolderContent extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return FolderContent the static model class
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
		return 'sys_folders_contents';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('folder_id, document_id', 'required'),
			array('folder_id, document_id', 'numerical', 'integerOnly'=>true),
                        array('document_id+folder_id', 'application.extensions.UniqueMultiColumnValidator'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, folder_id, document_id', 'safe', 'on'=>'search'),
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
			'folder' => array(self::BELONGS_TO, 'Folder', 'folder_id'),
			'document' => array(self::BELONGS_TO, 'Document', 'document_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'folder_id' => 'Folder',
			'document_id' => 'Document',
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
		$criteria->compare('folderId',$this->folderId);
		$criteria->compare('documentId',$this->documentId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
