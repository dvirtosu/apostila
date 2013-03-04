<?php

/**
 * This is the model class for table "notice".
 *
 * The followings are the available columns in table 'notice':
 * @property integer $id
 * @property integer $documentId
 * @property string $message
 *
 * The followings are the available model relations:
 * @property Document $document
 */
class Notice extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Notice the static model class
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
		return 'dt_notices';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('documentId, message', 'required'),
			array('documentId', 'numerical', 'integerOnly'=>true),
			array('message', 'length', 'max'=>256),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, documentId, message', 'safe', 'on'=>'search'),
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
			'document' => array(self::BELONGS_TO, 'Document', 'documentId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'documentId' => 'Document',
			'message' => 'Message',
		);
	}

	protected function afterSave()
    {
        $document = Document::model()->findByPk($this->documentId);
        $document->instanceId = $this->id;
        
        return $document->save();
    }
}
