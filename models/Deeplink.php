<?php

namespace app\models;

use Da\QrCode\QrCode;
use GuzzleHttp\Exception\ConnectException;
use Yii;
use GuzzleHttp\Client;
use yii\helpers\Url;

/**
 * This is the model class for table "deeplink".
 *
 * @property int $id
 * @property string $url
 * @property string|null $link_id
 * @property int|null $counter
 *
 * @property string $shortLink
 * @property string $qrCode
 */
class Deeplink extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'deeplink';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['url'], 'required'],
            [['counter'], 'integer'],
            [['link_id'], 'string', 'max' => 255],
            ['url', 'url'],
            ['url', 'isUrlReachable'],
        ];
    }

    public function isUrlReachable($attribute)
    {
        $url = trim(trim($this->$attribute, '?'), '/');
        $client = new Client();
        try {
            $result = $client->request('GET', $url);
        } catch (ConnectException $exception) {
            $this->addError($attribute, 'Данный URL не доступен');
            return false;
        }
        $statusCode = $result->getStatusCode();
        if($statusCode < 200 || $statusCode > 299) {
            $this->addError($attribute, 'Данный URL не доступен');
        }
    }

    public function getShortLink(): string
    {
        if(empty($this->link_id)) {
            return '';
        }
        return Url::to("site/short/{$this->link_id}", true);
    }

    public function getQrCode(): string
    {
        $qrCode = (new QrCode($this->shortLink))
            ->setSize(250)
            ->setMargin(5)
            ->setBackgroundColor(51, 153, 255);

        return $qrCode->writeDataUri();
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'url' => Yii::t('app', 'Url'),
            'link_id' => Yii::t('app', 'Link ID'),
            'counter' => Yii::t('app', 'Counter'),
        ];
    }
}
