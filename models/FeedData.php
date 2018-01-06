<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "feed_data".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $map
 * @property int $location_id
 * @property string $created
 * @property string $provider
 * @property string $link
 *
 * @property Location $location
 */
class FeedData extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'feed_data';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'map', 'location_id', 'provider', 'link'], 'required'],
            [['location_id'], 'integer'],
            [['created'], 'safe'],
            [['name', 'description', 'map', 'provider', 'link'], 'string', 'max' => 255],
            [['location_id'], 'exist', 'skipOnError' => true, 'targetClass' => Location::className(), 'targetAttribute' => ['location_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'map' => 'Map',
            'location_id' => 'Location ID',
            'created' => 'Created',
            'provider' => 'Provider',
            'link' => 'Link',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocation()
    {
        return $this->hasOne(Location::className(), ['id' => 'location_id']);
    }
}
