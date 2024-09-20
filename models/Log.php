<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "log".
 *
 * @property int $id
 * @property int $deeplink_id
 * @property string|null $ip
 *
 * @property Deeplink $deeplink
 */
class Log extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['deeplink_id'], 'required'],
            [['deeplink_id'], 'integer'],
            [['ip'], 'string', 'max' => 255],
            [['deeplink_id'], 'exist', 'skipOnError' => true, 'targetClass' => Deeplink::class, 'targetAttribute' => ['deeplink_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'deeplink_id' => Yii::t('app', 'Deeplink ID'),
            'ip' => Yii::t('app', 'Ip'),
        ];
    }

    /**
     * Gets query for [[Deeplink]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDeeplink()
    {
        return $this->hasOne(Deeplink::class, ['id' => 'deeplink_id']);
    }

    public static function create(int $deeplinkId, string $ip)
    {
        $log = new self();
        $log->deeplink_id = $deeplinkId;
        $log->ip = $ip;
        $log->save(false);
    }
}
