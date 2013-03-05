<?php

/**
 * This is the model class for table "dt_birth_certificates_history".
 *
 * The followings are the available columns in table 'dt_birth_certificates_history':
 * @property string $id
 * @property string $update_user
 * @property string $update_time
 * @property string $action_id
 * @property string $version_id
 * @property string $document_id
 */
class BirthCertificatesHistory extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return BirthCertificatesHistory the static model class
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
		return 'dt_birth_certificates_history';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('update_user, update_time, action_id, version_id, document_id', 'required'),
			array('update_user, action_id, version_id, document_id', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, update_user, update_time, action_id, version_id, document_id', 'safe', 'on'=>'search'),
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
			'action' => array(self::BELONGS_TO, 'Documentaction', 'action_id'),
			'user' => array(self::BELONGS_TO, 'User', 'update_user'),
			'doc' => array(self::BELONGS_TO, 'Document', 'document_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'update_user' => 'Update User',
			'update_time' => 'Update Time',
			'action_id' => 'Action',
			'version_id' => 'Version',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('update_user',$this->update_user,true);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('action_id',$this->action_id,true);
		$criteria->compare('version_id',$this->version_id,true);
		$criteria->compare('document_id',$this->document_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}