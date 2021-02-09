<?php

namespace app\models;

use phpDocumentor\Reflection\Types\Parent_;
use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property int|null $parent_id
 * @property string|null $name
 * @property string|null $created
 * @property string|null $modified
 *
 * @property Category $parent
 * @property Category[] $categories
 * @property Company[] $companies
 * @property CompanyCategory[] $companyCategories
 */
class Category extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id'], 'integer'],
            [['created', 'modified'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['parent_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'name' => 'Name',
            'created' => 'Created',
            'modified' => 'Modified',
        ];
    }

    /**
     * Gets query for [[Parent]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Category::className(), ['id' => 'parent_id']);
    }

    /**
     * Gets query for [[Categories]].
     *
     * @return \yii\db\ActiveQuery
     */

    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['parent_id' => 'id']);
    }

    /**
     * Gets query for [[Companies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompanies()
    {
        return $this->hasMany(Company::className(), ['category' => 'id']);
    }

    /**
     * Gets query for [[CompanyCategories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompanyCategories()
    {
        return $this->hasMany(CompanyCategory::className(), ['category' => 'id']);
    }

    public function getAllCategories($parent_id = 1, $exclude = '', $space = '', $categories=''){
        if($parent_id == 1){
            $space = '';
            $categories = array();
        }else{
            $space .='- ';
        }

        $model = Category::findAll([
            'parent_id' => $parent_id,
        ]);
        if(!empty($model)){
            foreach ($model as $key) {
                if($key->id == $exclude) continue;
                $categories[] = array('id'=>$key->id, 'name'=>$space.$key->name);
                $categories = $this->getCategories($key->id, $exclude, $space, $categories);
            }
        }

        return $categories;
    }

    public  function  categoryTree($parent_id = 0, $sub_mark = '')
    {
        $hkl = (new \yii\db\Query())
            ->select(['id','parent_id','name'])
            ->from('category')
            ->where(['parent_id'=>$parent_id])
            ->orderBy(['name'=>SORT_ASC])
            ->all();
        foreach ($hkl as $temp){
            echo '<option value="'.$temp['id'].'">'.$sub_mark.$temp['name'].'</option>';
            Category::categoryTree($temp['id'], $sub_mark . '---');
        }


        return $hkl;

    }






}
