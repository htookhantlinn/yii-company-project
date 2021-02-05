<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_activity".
 *
 * @property int $id
 * @property int|null $user
 * @property int|null $company
 * @property string|null $modified
 * @property string|null $created
 * @property string|null $action
 */
class UserActivity extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_activity';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user', 'company'], 'integer'],
            [['modified', 'created'], 'safe'],
            [['action'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user' => 'User',
            'company' => 'Company',
            'modified' => 'Modified',
            'created' => 'Created',
            'action' => 'Action',
        ];
    }
}
