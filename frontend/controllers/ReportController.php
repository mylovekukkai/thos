<?php

namespace frontend\controllers;
use yii;

class ReportController extends \yii\web\Controller
{
    public $enableCsrfValidation = false;
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    //    ---------------------------------------------------------------------------------------------
    
    public function  actionReport1()
    {
        $bdg_date = '2014-09-30';
        $date1 = date('Y-m-d');
        $date2 = date('Y-m-d');
        
        if (Yii::$app->request->isPost) {
            $date1 = $_POST['date1'];
            $date2 = $_POST['date2'];
        }
        $sql = "select pm.vstdate,concat(p.pname,p.fname,' ',p.lname) as ptname
            ,p.cid,pm.hn,v.age_y,v.pdx
            ,pi.icd9,pi.name as name1
            ,v.pttype,pt.`name` as name2,d.name as name3 
            from physic_main pm
            left outer join patient p on p.hn=pm.hn 
            left outer join vn_stat v on v.vn=pm.vn 
            left outer join physic_list pl on pl.vn=pm.vn 
            left outer join physic_items pi on pi.physic_items_id=pl.physic_items_id 
            left outer join doctor d on d.code=pl.doctor 
            left outer join pttype pt on pt.pttype=v.pttype
            where (pm.vstdate BETWEEN '$date1' and '$date2')
            order by pm.vstdate desc";
        
        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([

            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        return $this->render('report1', [
                    'dataProvider' => $dataProvider,
                     'rawData'=>$rawData,
                    'sql' => $sql,
                    'date1' => $date1,
                    'date2' => $date2
        ]);
    }
    
    //    ---------------------------------------------------------------------------------------------
    
    public function  actionReport2()
    {
        $bdg_date = '2014-09-30';
        $date1 = date('Y-m-d');
        $date2 = date('Y-m-d');
        
        if (Yii::$app->request->isPost) {
            $date1 = $_POST['date1'];
            $date2 = $_POST['date2'];
        }
        $sql = "select pm.vstdate,concat(p.pname,p.fname,' ',p.lname) as ptname
            ,p.cid,pm.hn,v.age_y,v.pdx
            ,pi.icd9,pi.name as name1
            ,v.pttype,pt.`name` as name2,d.name as name3
            from physic_main_ipd pm
            left outer join patient p on p.hn=pm.hn
            left outer join an_stat v on v.an=pm.an
            left outer join physic_list_ipd pl on pl.physic_main_ipd_id=pm.physic_main_ipd_id
            left outer join physic_items pi on pi.physic_items_id=pl.physic_items_id
            left outer join doctor d on d.code=pl.doctor
            left outer join pttype pt on pt.pttype=v.pttype
            where (pm.vstdate BETWEEN '$date1' and '$date2')
            order by pm.vstdate desc";
        
        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([

            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        return $this->render('report2', [
                    'dataProvider' => $dataProvider,
                     'rawData'=>$rawData,
                    'sql' => $sql,
                    'date1' => $date1,
                    'date2' => $date2
        ]);
    }
   
    //    ---------------------------------------------------------------------------------------------
    
        public function  actionReport3()
    {
        $bdg_date = '2014-09-30';
        $date1 = date('Y-m-d');
        $date2 = date('Y-m-d');
        
        if (Yii::$app->request->isPost) {
            $date1 = $_POST['date1'];
            $date2 = $_POST['date2'];
        }
        $sql = "select a.vn,a.hn,concat(pt.pname,pt.fname,' ',pt.lname) ptname,pt.cid
            ,thaiage(pt.birthday,a.vstdate) age,a.vstdate
            ,cast(group_concat(distinct if(odx.icd10 regexp '^[A-Z]',odx.icd10,null) order by diagtype,ovst_diag_id) as char(100)) icd10
            ,cast(group_concat(distinct if(odx.icd10 regexp '^[0-9]',odx.icd10,null) order by odx.icd10) as char(100)) icd9cm
            ,cast(group_concat(distinct pi.icd10tm) as char(100)) icd10tm
            ,a.doctor_text doctor
            from physic_main a
            join patient pt on pt.hn=a.hn
            left join ovstdiag odx on a.vn=odx.vn
            left join physic_list pl on pl.vn=a.vn
            left join physic_items pi on pl.physic_items_id=pi.physic_items_id
            where (a.vstdate BETWEEN '$date1' and '$date2')
            group by a.vn
            limit 100";
        
        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([

            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        return $this->render('report2', [
                    'dataProvider' => $dataProvider,
                     'rawData'=>$rawData,
                    'sql' => $sql,
                    'date1' => $date1,
                    'date2' => $date2
        ]);
    }
    
    //    ---------------------------------------------------------------------------------------------
    
    public function  actionReport4()
    {
        $selyear = date('Y');
        
        if (!empty($_POST['selyear'])) {
            $selyear = $_POST['selyear'];
            
        }
        $sql = "select count(distinct pm.hn) as dhn
            ,count(pm.hn) as hn
            ,year(pm.vstdate) as yy
            ,month(pm.vstdate) as mm
            from physic_main_ipd pm
            left outer join patient p on p.hn=pm.hn
            left outer join an_stat v on v.an=pm.an
            left outer join physic_list_ipd pl on pl.physic_main_ipd_id=pm.physic_main_ipd_id
            left outer join physic_items pi on pi.physic_items_id=pl.physic_items_id
            left outer join doctor d on d.code=pl.doctor
            left outer join pttype pt on pt.pttype=v.pttype
            where year(pm.vstdate)='$selyear'
            GROUP BY yy,mm
            ORDER BY yy,mm";
        
        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([

            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        
        for ($i = 0; $i < count($rawData); $i++) {
            if($rawData[$i]['yy']==NULL OR $rawData[$i]['mm']==NULL ){
               $yy[]=0;
               $dhn[]=0;
               $hn[]=0;
               $mm[]=0;
            }else{
                $yy[] = (int)$rawData[$i]['yy'];
                $dhn[] =  (int)($rawData[$i]['dhn']);
                $hn[] =  (int)($rawData[$i]['hn']);
                $mm[] =  (int)($rawData[$i]['mm']); 
            }  
        }
        
        return $this->render('report4', [
                    'dataProvider' => $dataProvider,
                     'rawData'=>$rawData,
                    'sql' => $sql,
                    'selyear' => $selyear,
            
                    'yy' => $yy,
                    'dhn' => $dhn,
                    'hn' => $hn,
                    'mm' => $mm,
                    
        ]);
    }    
    
    //    ---------------------------------------------------------------------------------------------
    
}
