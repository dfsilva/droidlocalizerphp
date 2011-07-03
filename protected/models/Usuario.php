<?php

/**
 * This is the model class for table "tb_usuario".
 *
 * The followings are the available columns in table 'tb_usuario':
 * @property integer $id_usuario
 * @property string $email_usuario
 * @property string $senha_usuario
 * @property string $nome_usuario
 * @property integer $id_perfil
 *
 * The followings are the available model relations:
 * @property TbLocalizacao[] $tbLocalizacaos
 * @property TbPerfil $idPerfil
 */
class Usuario extends CActiveRecord {

    public $senha_usuario_repeat;

    /**
     * Returns the static model of the specified AR class.
     * @return Usuario the static model class
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tb_usuario';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('email_usuario, senha_usuario, nome_usuario', 'required'),
            array('id_perfil', 'numerical', 'integerOnly' => true),
            array('email_usuario', 'length', 'max' => 100),
            array('email_usuario', 'email'),
            array('email_usuario', 'unique'),
            array('senha_usuario', 'length', 'max' => 32),
            array('senha_usuario_repeat', 'compare', 'compareAttribute' => 'senha_usuario', 'on' => 'register'),
            array('nome_usuario', 'length', 'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id_usuario, email_usuario, senha_usuario, nome_usuario, id_perfil', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'tbLocalizacaos' => array(self::HAS_MANY, 'TbLocalizacao', 'id_usuario'),
            'idPerfil' => array(self::BELONGS_TO, 'TbPerfil', 'id_perfil'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id_usuario' => Yii::t('mess', 'id'),
            'email_usuario' => Yii::t('mess', 'Email'),
            'senha_usuario' => Yii::t('mess', 'Password'),
            'nome_usuario' => Yii::t('mess', 'Name'),
            'id_perfil' => Yii::t('mess', 'hole'),
            'senha_usuario_repeat' => Yii::t('mess', 'Confirm Password'),
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id_usuario', $this->id_usuario);
        $criteria->compare('email_usuario', $this->email_usuario, true);
        $criteria->compare('senha_usuario', $this->senha_usuario, true);
        $criteria->compare('nome_usuario', $this->nome_usuario, true);
        $criteria->compare('id_perfil', $this->id_perfil);

        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Checks if the given password is correct.
     * @param string the password to be validated
     * @return boolean whether the password is valid
     */
    public function validatePassword($password) {
        return md5($password) === $this->senha_usuario;
    }

    public function beforeSave() {
        $pass = md5($this->senha_usuario);
        $this->senha_usuario = $pass;
        if (!$this->id_perfil) {
            $this->id_perfil = 2;
        }
        return true;
    }

}