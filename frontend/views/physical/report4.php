<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use miloschuman\highcharts\Highcharts;

$this->title = 'รายชื่อผู้มารับบริการทางกายภาพบำบัด IPD';
$this->params['breadcrumbs'][] = ['label' => 'รายงานกายภาพบำบัด', 'url' => ['physical/index']];
$this->params['breadcrumbs'][]=$this->title;
?>

<div class='well'>
    <form method="POST">
        ปีงบประมาณ:
        <div class='row'>

            <div class='col-sm-3'>
               
                <?php
                $list_year = [];
                $selyear = date('Y');
                while($selyear >= 2007 ){
                    $list_year[$selyear]= $selyear+543;
                    $selyear--;
                }
                echo Html::dropDownList('selyear', $selyear, $list_year,[
                    'class' => 'form-control'
                ]);
                ?>
            </div>
            <div class='col-sm-3'>

                <button class='btn btn-danger'>ประมวลผล</button>
            </div>
        </div>
    </form>
</div>

<a href="#" id="btn_sql">ชุดคำสั่ง</a>
<div id="sql" style="display: none"><?= $sql ?></div>



<div class="col-md-12">
    <div class="well">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="glyphicon glyphicon-signal"></i> สรุปจำนวนคนผู้มารับบริการทางกายภาพบำบัด IPD</h3>
        </div>
        <div class="panel-body">
            <?php
            echo Highcharts::widget([
                'options' => [
                    'chart'=>[
                        'type' => 'column'
                    ],
                    'title' => ['text' => 'สรุปจำนวนคนผู้มารับบริการทางกายภาพบำบัด IPD '],
                    'xAxis' => [
                        ['categories' => $mm],
                    ],
                    'yAxis' => [
                        'title' => ['text' => 'จำนวน(คน)/(ครั้ง)'],
                    ],
                    'series' => [
                        ['name' => 'จำนวนคน','data' => $dhn],
                        ['name' => 'จำนวนครั้ง','data' => $hn]
                    ]
                ],
            ]);
            ?>
        </div>
        </div>
</div>



<?php
if (isset($dataProvider))

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'panel' => [
        'before' => '<h3 class="panel-title"><i class="glyphicon glyphicon-th-large"></i> รายชื่อผู้มารับบริการทางกายภาพบำบัด IPD</h3>',
        'after' => 'ประมวลผล ณ ' . date('Y-m-d H:i:s')
    ],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'ปี',
                'attribute' => 'yy'
            ],
            [
                'label' => 'เดือน',
                'attribute' => 'mm'
            ],
            [
                'label' => 'จำนวนคน',
                'attribute' => 'dhn'
            ], 
            [
                'label' => 'จำนวนครั้ง',
                'attribute' => 'hn'
            ],
        ]
    ]);
?>
<?php
$script = <<< JS
$(function(){
    $("label[title='Show all data']").hide();
});
        
$('#btn_sql').on('click', function(e) {
    
   $('#sql').toggle();
});
JS;
$this->registerJs($script);
?>
        

