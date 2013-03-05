<?php

/**
 * This is the model class for table "dt_birth_certificates".
 *
 * The followings are the available columns in table 'dt_birth_certificates':
 * @property string $id
 * @property string $document_id
 * @property string $idnp
 * @property string $name
 * @property string $surname
 * @property string $sex
 * @property string $birth_date
 * @property string $birth_cities_id
 * @property string $birth_countries_id
 * @property string $idnp_dad
 * @property string $name_surname_dad
 * @property string $nationality_dad_id
 * @property string $idnp_mom
 * @property string $name_surname_mom
 * @property string $nationality_mom_id
 * @property string $act_number
 * @property string $registration_date
 * @property string $registration_osc_office_id
 * @property string $date_of_issue
 * @property string $office_issue_id
 * @property string $osc_public_official_id
 * @property string $certificate_series
 * @property string $certificate_number
 */
class BirthCertificates extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return BirthCertificates the static model class
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
		return 'dt_birth_certificates';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('document_id, idnp, name, surname, sex, birth_date, birth_cities_id, birth_countries_id, idnp_dad, name_surname_dad, nationality_dad_id, idnp_mom, name_surname_mom, nationality_mom_id, act_number, registration_date, registration_osc_office_id, date_of_issue, office_issue_id, osc_public_official_id, certificate_series, certificate_number', 'required'),
			array('document_id, idnp, birth_cities_id, birth_countries_id, idnp_dad, nationality_dad_id, idnp_mom, nationality_mom_id, act_number, registration_osc_office_id, office_issue_id, osc_public_official_id, certificate_number', 'length', 'max'=>20),
			array('name, surname', 'length', 'max'=>150),
			array('sex', 'length', 'max'=>1),
			array('name_surname_dad, name_surname_mom', 'length', 'max'=>200),
			array('certificate_series', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, document_id, idnp, name, surname, sex, birth_date, birth_cities_id, birth_countries_id, idnp_dad, name_surname_dad, nationality_dad_id, idnp_mom, name_surname_mom, nationality_mom_id, act_number, registration_date, registration_osc_office_id, date_of_issue, office_issue_id, osc_public_official_id, certificate_series, certificate_number', 'safe', 'on'=>'search'),
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
			'document_id' => 'Document',
			'idnp' => 'Idnp',
			'name' => 'Name',
			'surname' => 'Surname',
			'sex' => 'Sex',
			'birth_date' => 'Birth Date',
			'birth_cities_id' => 'Birth Cities',
			'birth_countries_id' => 'Birth Countries',
			'idnp_dad' => 'Idnp Dad',
			'name_surname_dad' => 'Name Surname Dad',
			'nationality_dad_id' => 'Nationality Dad',
			'idnp_mom' => 'Idnp Mom',
			'name_surname_mom' => 'Name Surname Mom',
			'nationality_mom_id' => 'Nationality Mom',
			'act_number' => 'Act Number',
			'registration_date' => 'Registration Date',
			'registration_osc_office_id' => 'Registration Osc Office',
			'date_of_issue' => 'Date Of Issue',
			'office_issue_id' => 'Office Issue',
			'osc_public_official_id' => 'Osc Public Official',
			'certificate_series' => 'Certificate Series',
			'certificate_number' => 'Certificate Number',
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
		$criteria->compare('document_id',$this->document_id,true);
		$criteria->compare('idnp',$this->idnp,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('surname',$this->surname,true);
		$criteria->compare('sex',$this->sex,true);
		$criteria->compare('birth_date',$this->birth_date,true);
		$criteria->compare('birth_cities_id',$this->birth_cities_id,true);
		$criteria->compare('birth_countries_id',$this->birth_countries_id,true);
		$criteria->compare('idnp_dad',$this->idnp_dad,true);
		$criteria->compare('name_surname_dad',$this->name_surname_dad,true);
		$criteria->compare('nationality_dad_id',$this->nationality_dad_id,true);
		$criteria->compare('idnp_mom',$this->idnp_mom,true);
		$criteria->compare('name_surname_mom',$this->name_surname_mom,true);
		$criteria->compare('nationality_mom_id',$this->nationality_mom_id,true);
		$criteria->compare('act_number',$this->act_number,true);
		$criteria->compare('registration_date',$this->registration_date,true);
		$criteria->compare('registration_osc_office_id',$this->registration_osc_office_id,true);
		$criteria->compare('date_of_issue',$this->date_of_issue,true);
		$criteria->compare('office_issue_id',$this->office_issue_id,true);
		$criteria->compare('osc_public_official_id',$this->osc_public_official_id,true);
		$criteria->compare('certificate_series',$this->certificate_series,true);
		$criteria->compare('certificate_number',$this->certificate_number,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        protected function afterSave()
        {
            $document = Document::model()->findByPk($this->document_id);
            $document->instance_id = $this->id;
        
            return $document->save();
        }
}