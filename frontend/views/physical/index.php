<?php
use yii\helpers\Html;

$this->title = 'หมวดรายงาน -> รายงานกายภาพบำบัด';
$this->params['breadcrumbs'][] = ['label' => 'รายงานกายภาพบำบัด', 'url' => ['physical/index']];
?>
<div class="well">
    <div class="panel-body">
        <h4>หมวดรายงาน -> รายงานกายภาพบำบัด</h4>
        <hr>
        <p>
          <?=Html::a('รายชื่อผู้มารับบริการทางกายภาพบำบัด OPD',['physical/report1'])?>
        </p>
        <p>
          <?=Html::a('รายชื่อผู้มารับบริการทางกายภาพบำบัด IPD',['physical/report2'])?>
        </p>
        <p>
          <?=Html::a('สถิติงานกายภาพบำบัด OPD',['physical/report3'])?>
        </p>
        <p>
          <?=Html::a('สรุปจำนวนคนผู้มารับบริการทางกายภาพบำบัด IPD',['physical/report4'])?>
        </p>
        <hr>
    </div>
</div>