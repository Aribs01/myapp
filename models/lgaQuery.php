<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Lga]].
 *
 * @see Lga
 */
class lgaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Lga[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Lga|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
