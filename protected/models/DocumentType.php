<?php

/** 
 * This is the model class for table "sys_documents_types". 
 * 
 * The followings are the available columns in table 'sys_documents_types': 
 * @property string $id
 * @property string $title
 * @property string $route_id
 * @property string $instance_model_name
 * @property string $category_id
 * @property string $create_user
 * @property string $create_time
 * @property string $update_user
 * @property string $update_time
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
                    array('title, route_id, category_id, create_user, create_time', 'required'),
                    array('title, instance_model_name', 'length', 'max'=>100),
                    array('route_id, category_id, create_user, update_user', 'length', 'max'=>20),
                    array('update_time', 'safe'),
                    // The following rule is used by search(). 
                    // Please remove those attributes that should not be searched. 
                    array('id, title, route_id, instance_model_name, category_id, create_user, create_time, update_user, update_time', 'safe', 'on'=>'search'),
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
			'category' => array(self::BELONGS_TO, 'DocumentCategory', 'category_id'),
			'routes' => array(self::BELONGS_TO, 'Routes', 'route_id'),
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
                    'route_id' => 'Route',
                    'instance_model_name' => 'Instance Model Name',
                    'category_id' => 'Category',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('route',$this->route,true);
		$criteria->compare('instanceModelName',$this->instanceModelName,true);
		$criteria->compare('categoryId',$this->categoryId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
