<?php

/**
 * This is the model class for table "dt_birth_certificates_version".
 *
 * The followings are the available columns in table 'dt_birth_certificates_version':
 * @property string $id
 * @property string $instance_id
 * @property string $file
 * @property string $file_format_id
 * @property string $update_user
 * @property string $update_time
 */
class BirthCertificatesVersion extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return BirthCertificatesVersion the static model class
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
		return 'dt_birth_certificates_version';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('instance_id, file, file_format_id, update_user, update_time', 'required'),
			array('instance_id, file_format_id, update_user', 'length', 'max'=>20),
			array('file', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, instance_id, file, file_format_id, update_user, update_time', 'safe', 'on'=>'search'),
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
			'fileFormat' => array(self::BELONGS_TO, 'FileFormat', 'file_format_id'),
                        'updateUser' => array(self::BELONGS_TO, 'User', 'update_user'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'instance_id' => 'Instance',
			'file' => 'File',
			'file_format_id' => 'File Format',
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
        
                $criteria->compare('instance_id',$this->instance_id);

                return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                    'pagination' => array('pageSize' => 10),
                ));
	}
}