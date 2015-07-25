<?php
use yii\helpers\Html;

$this->title = 'หมวดรายงาน -> รายงานกายภาพบำบัด';
$this->params['breadcrumbs'][] = ['label' => 'รายงานกายภาพบำบัด', 'url' => ['report/index']];
?>
<div class="well">
    <div class="panel-body">
        <h4>หมวดรายงาน -> รายงานกายภาพบำบัด</h4>
        <hr>
        <p>
          <?=Html::a('รายชื่อผู้มารับบริการทางกายภาพบำบัด OPD',['report/report1'])?>
        </p>
        <p>
          <?=Html::a('รายชื่อผู้มารับบริการทางกายภาพบำบัด IPD',['report/report2'])?>
        </p>
        <p>
          <?=Html::a('สถิติงานกายภาพบำบัด OPD',['report/report3'])?>
        </p>
        <p>
          <?=Html::a('สรุปจำนวนคนผู้มารับบริการทางกายภาพบำบัด IPD',['report/report4'])?>
        </p>
        <hr>
    </div>
</div>