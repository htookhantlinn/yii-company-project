<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "company".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property string|null $website
 * @property string|null $address
 * @property string|null $ph_no
 * @property int $user
 * @property int $category
 *
 * @property Category $category0
 * @property User $user0
 * @property CompanyCategory[] $companyCategories
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user', 'category'], 'required'],
            [['user', 'category'], 'integer'],
            [['name', 'description', 'website', 'address', 'ph_no'], 'string', 'max' => 255],
            [['category'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category' => 'id']],
            [['user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'website' => 'Website',
            'address' => 'Address',
            'ph_no' => 'Ph No',
            'user' => 'User',
            'category' => 'Category',
        ];
    }

    /**
     * Gets query for [[Category0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory0()
    {
        return $this->hasOne(Category::className(), ['id' => 'category']);
    }

    /**
     * Gets query for [[User0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser0()
    {
        return $this->hasOne(User::className(), ['id' => 'user']);
    }

    /**
     * Gets query for [[CompanyCategories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompanyCategories()
    {
        return $this->hasMany(CompanyCategory::className(), ['company' => 'id']);
    }

    public static function find()
    {
        return new CompanyQuery(get_called_class());
    }
}
