<?php

/**
 * This is the model class for table "documentType".
 *
 * The followings are the available columns in table 'documentType':
 * @property integer $id
 * @property string $title
 * @property string $route
 * @property string $instanceModelName
 * @property integer $categoryId
 *
 * The followings are the available model relations:
 * @property Document[] $documents
 * @property DocumentCategory $category
 * @property Folder[] $folders
 */
class DocumentType extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DocumentType the static model class
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
		return 'sys_documents_types';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, instanceModelName, categoryId', 'required'),
			array('categoryId', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>256),
			array('route, instanceModelName', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, route, instanceModelName, categoryId', 'safe', 'on'=>'search'),
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
			'documents' => array(self::HAS_MANY, 'Document', 'type_id'),
			'category' => array(self::BELONGS_TO, 'DocumentCategory', 'categoryId'),
			'folders' => array(self::HAS_MANY, 'Folder', 'documenttype_id'),
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
			'route' => 'Route',
			'instanceModelName' => 'Instance Model Name',
			'categoryId' => 'Category',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('route',$this->route,true);
		$criteria->compare('instanceModelName',$this->instanceModelName,true);
		$criteria->compare('categoryId',$this->categoryId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
