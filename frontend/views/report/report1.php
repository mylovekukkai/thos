<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use miloschuman\highcharts\Highcharts;

$this->title = 'รายชื่อผู้มารับบริการทางกายภาพบำบัด OPD';
$this->params['breadcrumbs'][] = ['label' => 'รายงานกายภาพบำบัด', 'url' => ['report/index']];
$this->params['breadcrumbs'][]=$this->title;
?>


<div class="well">
    <div class="panel-body">
        <form method="POST">
            เกิดระหว่าง:
            <?php
            echo yii\jui\DatePicker::widget([
                'name' => 'date1',
                'value' => $date1,
                'language' => 'th',
                'dateFormat' => 'yyyy-MM-dd',
                'clientOptions' => [
                    'changeMonth' => true,
                    'changeYear' => true,
                ]

            ]);
            ?>
            ถึง:
            <?php
            echo yii\jui\DatePicker::widget([
                'name' => 'date2',
                'value' => $date2,
                'language' => 'th',
                'dateFormat' => 'yyyy-MM-dd',
                'clientOptions' => [
                    'changeMonth' => true,
                    'changeYear' => true,
                ]
            ]);
            ?>
            <button class='btn btn-danger'>ประมวลผล</button>
        </form>
    </div>
</div>
<a href="#" id="btn_sql">ชุดคำสั่ง</a>
<div id="sql" style="display: none"><?= $sql ?></div>

<?php
if (isset($dataProvider))

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'panel' => [
        'before' => '<h3 class="panel-title"><i class="glyphicon glyphicon-th-large"></i> รายชื่อผู้มารับบริการทางกายภาพบำบัด OPD</h3>',
        'after' => 'ประมวลผล ณ ' . date('Y-m-d H:i:s')
    ],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
            [
                'label'=>'วันที่รับบริการ',
                'attribute'=>'vstdate'
            ],
            [
                'label'=>'HN',
                'attribute'=>'hn',
            ],
            [
                'label'=>'CID',
                'attribute'=>'cid'
            ],
            [
                'label'=>'ชื่อ-สกุล',
                'attribute'=>'ptname'
            ],
            [
                'label'=>'อายุ',
                'attribute'=>'age_y'
            ],
            [
                'label'=>'PDX',
                'attribute'=>'pdx',
            ],
            [
                'label'=>'ICD9',
                'attribute'=>'name1'
            ],
            [
                'label'=>'สิทธิ',
                'attribute'=>'name2'
            ],
            [
                'label'=>'เจ้าหน้าที่',
                'attribute'=>'name3'
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
        

