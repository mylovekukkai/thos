<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;
use frontend\assets\MaterialAsset;
/* @var $this \yii\web\View */
/* @var $content string */

//AppAsset::register($this);
MaterialAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => 'โรงพยาบาลพยัคฆภูมิพิสัย',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            $report_mnu_itms[] = ['label' => 'รายงานกายภาพบำบัด', 'url' => ['physical/index']];
            $report_mnu_itms[] = ['label' => 'รายงานแพทย์แผนไทย', 'url' => ['planthai/index']];
            $report_mnu_itms[] = ['label' => 'รายงานทันตกรรม', 'url' => ['dentistry/index']];
            $menuItems = [
                ['label' => 'หนัาหลัก', 'url' => ['/site/index']],
                ['label' => 'รายงาน',
                    'items' => $report_mnu_itms
                ],
            ];
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'ลงทะเบียน', 'url' => ['/site/signup']];
                $menuItems[] = ['label' => 'เข้าใช้งาน', 'url' => ['/site/login']];
            } else {
                $menuItems[] = [
                    'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end();
        ?>

        <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
        <p class="pull-left">&copy; โรงพยาบาลพยัคฆภูมิพิสัย <?= date('Y') ?></p>
        <p class="pull-right">BY IT CENTER</p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
