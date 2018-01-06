<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "location".
 *
 * @property int $id
 * @property string $name
 *
 * @property FeedData[] $feedDatas
 */
class Location extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'location';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeedDatas()
    {
        return $this->hasMany(FeedData::className(), ['location_id' => 'id']);
    }
}
