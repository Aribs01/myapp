<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\PollingUnit;

/* @var $this yii\web\View */
/* @var $model Array */

$this->title = 'Results';
$this->params['breadcrumbs'][] = ['label' => 'Lgas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="lga-view">

    

    <h1><?= Html::encode($this->title) ?></h1>

    <?php foreach($model as $party=>$vote):?>
        <div class="row d-flex">
            <div class="col-2"><?php echo $party;?></div>
            <div class="col-10"><?php echo $vote;?></div>
        </div>
    <?php endforeach;?>

    

</div>
