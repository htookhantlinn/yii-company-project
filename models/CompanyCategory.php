<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "company_category".
 *
 * @property int $id
 * @property int $company
 * @property int $category
 *
 * @property Category $category0
 * @property Company $company0
 */
class CompanyCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company', 'category'], 'required'],
            [['company', 'category'], 'integer'],
            [['category'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category' => 'id']],
            [['company'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['company' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company' => 'Company',
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
     * Gets query for [[Company0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompany0()
    {
        return $this->hasOne(Company::className(), ['id' => 'company']);
    }
}
