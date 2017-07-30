<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "bill_of_lading".
 *
 * @property integer $id
 * @property string $city_from
 * @property string $city_to
 * @property string $recipient
 * @property integer $status_id
 * @property integer $created_at
 * @property integer $updated_at
 */
class BillOfLading extends \yii\db\ActiveRecord
{
    public static $statusArr = [
        1=>'Ожидает отправки',
        2=>'Доставлено',
        3=>'В пути',
        4=>'Принят на склад',
        5=>'Возвращен',
    ];

    public function behaviors()
    {
        return [
            'TimestampBehavior' => [
                'class' => TimestampBehavior::className(),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bill_of_lading';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status_id','city_from', 'city_to', 'recipient'],'required'],
            [['status_id', 'created_at', 'updated_at'], 'integer'],
            [['city_from', 'city_to', 'recipient'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'city_from' => 'Откуда',
            'city_to' => 'Куда',
            'recipient' => 'Получатель',
            'status_id' => 'Статус',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
        ];
    }
}
