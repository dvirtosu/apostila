<?php

/**
 * This is the model class for table "sys_noticehistory".
 *
 * The followings are the available columns in table 'sys_noticehistory':
 * @property integer $Id
 * @property string $DataTime
 * @property integer $Action_id
 * @property integer $User_id
 * @property integer $Doc_version
 * @property integer $doc_id
 */
class Noticehistory extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Noticehistory the static model class
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
		return 'dt_notice_history';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('DataTime, Action_id, User_id, Doc_version, doc_id', 'required'),
			array('Action_id, User_id, Doc_version, doc_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, DataTime, Action_id, User_id, Doc_version, doc_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'action' => array(self::BELONGS_TO, 'Documentaction', 'Action_id'),
			'user' => array(self::BELONGS_TO, 'AdmUsers', 'User_id'),
			'doc' => array(self::BELONGS_TO, 'Documents', 'doc_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'DataTime' => 'Data Time',
			'Action_id' => 'Action',
			'User_id' => 'User',
			'Doc_version' => 'Doc Version',
			'doc_id' => 'Doc',
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

		$criteria->compare('Id',$this->Id);
		$criteria->compare('DataTime',$this->DataTime,true);
		$criteria->compare('Action_id',$this->Action_id);
		$criteria->compare('User_id',$this->User_id);
		$criteria->compare('Doc_version',$this->Doc_version);
		$criteria->compare('doc_id',$this->doc_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}