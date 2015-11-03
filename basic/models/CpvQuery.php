<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Cpv]].
 *
 * @see Cpv
 */
class CpvQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Cpv[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Cpv|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}