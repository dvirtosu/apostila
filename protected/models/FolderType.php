<?php

/** 
 * This is the model class for table "sys_folders_types". 
 * 
 * The followings are the available columns in table 'sys_folders_types': 
 * @property string $id
 * @property string $code
 * @property string $create_user
 * @property string $create_time
 * @property string $update_user
 * @property string $update_time
 */ 
class FolderType extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return FolderType the static model class
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
		return 'sys_folders_types';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array( 
                    array('code, create_user, create_time', 'required'),
                    array('code', 'length', 'max'=>50),
                    array('create_user, update_user', 'length', 'max'=>20),
                    array('update_time', 'safe'),
                    // The following rule is used by search(). 
                    // Please remove those attributes that should not be searched. 
                    array('id, code, create_user, create_time, update_user, update_time', 'safe', 'on'=>'search'), 
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
			'folders' => array(self::HAS_MANY, 'Folder', 'type_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'code' => 'Code',
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
		$criteria->compare('code',$this->code,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
