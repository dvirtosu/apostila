<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $username
 * @property string $login
 * @property string $password
 *
 * The followings are the available model relations:
 * @property Document[] $documents
 * @property Document[] $documents1
 * @property Folder[] $folders
 * @property Folder[] $folders1
 */
class User extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return User the static model class
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
        return 'adm_users';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('username, login, password', 'required'),
            array('username, login, password', 'length', 'max'=>128),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, username, login, password', 'safe', 'on'=>'search'),
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
            'documents' => array(self::HAS_MANY, 'Document', 'createUserId'),
            'documents1' => array(self::HAS_MANY, 'Document', 'updateUserId'),
            'folders' => array(self::HAS_MANY, 'Folder', 'createUserId'),
            'folders1' => array(self::HAS_MANY, 'Folder', 'updateUserId'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'username' => 'Username',
            'login' => 'Login',
            'password' => 'Password',
        );
    }

    /**
     * Checks if the given password is correct.
     * @param string the password to be validated
     * @return boolean whether the password is valid
     */
    public function validatePassword($password)
    {
        return ($password === $this->password);
    }
}
