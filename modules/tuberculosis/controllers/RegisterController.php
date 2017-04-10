<?php

namespace app\modules\tuberculosis\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\web\Response;  /* ajaxValidation  */
use yii\widgets\ActiveForm; /*  ajaxValidation  */
use yii\helpers\Json;

use app\modules\tuberculosis\models\TbInfo;
use app\modules\tuberculosis\models\TbInfoSearch;
use app\modules\tuberculosis\models\TbClinical;
use app\modules\tuberculosis\models\Subdistrict;
use app\modules\tuberculosis\models\Villa;


/**
 * RegisterController implements the CRUD actions for TbInfo model.
 */
class RegisterController extends Controller
{
  public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all TbInfo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TbInfoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TbInfo model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TbInfo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $modelInfo = new TbInfo();
        $modelClinical = new TbClinical();
        if (Yii::$app->request->isAjax && $modelInfo->load(Yii::$app->request->post())) {
             Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($modelInfo);
        }
         if (Yii::$app->request->isAjax && $modelClinical->load(Yii::$app->request->post())) {
             Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($modelClinical);
        }
        if($modelInfo->load(Yii::$app->request->post()) &&
           $modelClinical->load(Yii::$app->request->post()) &&
           Model::validateMultiple([$modelInfo,$modelClinical]))
        {
            $data = Yii::$app->request->post();
             $modelInfo->HMAIN = '10727';
            $modelInfo->DATE_REG = date('Y-m-d', strtotime($data['TbInfo']['DATE_REG']));
            $modelClinical->MDTDATE = date('Y-m-d', strtotime($data['TbClinical']['MDTDATE']));
            $modelInfo->VILLAGE_ID=$data['TbInfo']['VILLA'];
            
            if($modelInfo->validate()){
                $modelInfo->save();
                $modelClinical->TBNUMBER=$modelInfo->TBNUMBER;
                $modelClinical->save();
                $tbno=(substr($modelClinical->TBNUMBER,2,4)*1).'/'.substr($modelClinical->TBNUMBER,0,2);
                $date_start=$modelClinical->MDTDATE;
                $hno=$modelInfo->HNO;
//                $village_id=$modelInfo->VILLA;
                $village_id=(substr($modelInfo->VILLA,6,2)*1);
                $villagename = $modelInfo->getVillageName();
                $tambon = $modelInfo->getSubdistName();
                $pcu = $modelInfo->getHospcode();
                $message= "แจ้งขึ้นทะเบียนผู้ป่วยใหม่                   TB Number   ".$tbno." วันที่เริ่มกินยา ".$date_start."  บ้านเลขที่   ".$hno." หมู่ ".$village_id." - ".$villagename." ตำบล ".$tambon." หน่วยบริการ ".$pcu;
                
//                echo $message;die;
                $res = $this->notify_message($message);  // call Line API                   
            }
            return $this->redirect(['view', 'id' => $modelInfo->TBNUMBER]);
        } else {
            return $this->render('create', [
                'modelInfo' => $modelInfo,
                'modelClinical'=>$modelClinical
            ]);
        }
    }

    /**
     * Updates an existing TbInfo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $modelInfo = $this->findModel($id);
        $modelClinical = $this->findModelClinical($modelInfo->TBNUMBER);
//        \yii\helpers\VarDumper::dump($modelClinical,10,true);die;
         if (Yii::$app->request->isAjax && $modelInfo->load(Yii::$app->request->post())) {
             Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($modelInfo);
        }
         if (Yii::$app->request->isAjax && $modelClinical->load(Yii::$app->request->post())) {
             Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($modelClinical);
        }                
        
        if (
        $modelInfo->load(Yii::$app->request->post()) &&
        $modelClinical->load(Yii::$app->request->post()) &&
        Model::validateMultiple([$modelInfo,$modelClinical])
        ) {
//            $modelInfo->DATE_REG = date('Y-m-d', strtotime($data['TbInfo']['DATE_REG']));
            if($modelClinical->save()){
              $modelInfo->save();
            }
            return $this->redirect(['view', 'id' => $modelInfo->TBNUMBER]);
        } else {
            return $this->render('update', [
              'modelInfo' => $modelInfo,
              'modelClinical'=>$modelClinical
            ]);
        }
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TbInfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return TbInfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if(Yii::$app->user->can('admin') || Yii::$app->user->can('manager')){
          $model = TbInfo::findOne($id);
            
        }  elseif(Yii::$app->user->can('member')) {            
            $model = TbInfo::find()->joinWith('villa')->where(['=', 'HOSPCODE','07714'])->andWhere(['=', 'TBNUMBER',$id])->one();
        }
        if ($model !== null) {
            return $model;
        }else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

//        if (($model = TbInfo::findOne($id)) !== null) {
//            
//            return $model;
//        } else {
//            throw new NotFoundHttpException('The requested page does not exist.');
//        }
    }
    protected function findModelClinical($id)
    {
        if (($model = TbClinical::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
       /* ---------------------------------------------   DepDrop ----------------------------------------  */

//public function actionGetDistrict() {
//        $out = [];
//        if (isset($_POST['depdrop_parents'])) {
//            $parents = $_POST['depdrop_parents'];
//            if ($parents != null) {
//                $province_id = $parents[0];
//                $out = $this->getDistrict($province_id);
//                echo Json::encode(['output' => $out, 'selected' => '']);
//                return;
//            }
//        }
//        echo Json::encode(['output' => '', 'selected' => '']);
//    }
//
//    protected function getDistrict($id) {
//        $datas = District::find()->where(['PROVINCE_ID' => $id])->all();
//        return $this->MapData($datas, 'AMPHUR_ID', 'AMPHUR_NAME');
//    }

    public function actionGetSubdistrict() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $ids = $_POST['depdrop_parents'];
//            $province_id = empty($ids[0]) ? null : $ids[0];
            $district_id = empty($ids[0]) ? null : $ids[0];
            if ($district_id != null) {
                $data = $this->getSubdistrict($district_id);
                echo Json::encode(['output' => $data, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    protected function getSubdistrict($id) {
        $datas = Subdistrict::find()->where(['AMPHUR_ID' => $id])->all();
        return $this->MapData($datas, 'DISTRICT_ID', 'DISTRICT_NAME');
    }

    public function actionGetVilla() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $ids = $_POST['depdrop_parents'];
//            $province_id = empty($ids[0]) ? null : $ids[0];
            $district_id = empty($ids[0]) ? null : $ids[0];
            $subistrict_id = empty($ids[1]) ? null : $ids[1];


//             echo $province_id.'---'.$district_id;die;
            if ($subistrict_id != null) {
                $data = $this->getVilla($subistrict_id);
                echo Json::encode(['output' => $data, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    protected function getVilla($id) {
        $datas = Villa::find()->where(['SUBDIST_ID' => $id])->all();
        return $this->MapData($datas, 'VILLAGE_ID', 'VILLAGE_NAME');
    }

    protected function MapData($datas, $fieldId, $fieldName) {
        $obj = [];
        foreach ($datas as $key => $value) {
            array_push($obj, ['id' => $value->{$fieldId}, 'name' => $value->{$fieldName}]);
        }
        return $obj;
    }

    /* ---------------------------------------------  end DepDrop ----------------------------------------  */

     public function notify_message($message) {  // Line Bot
        $line_api = 'https://notify-api.line.me/api/notify';
//        echo strip_tags("Hello <b><i>world!</i></b><br>goodbye","<b>");die;
        $line_token = 'liNTafsvVfBvbjP8LEJQMvVe1G8lEKbVWBIr5zfCT2P';
        $queryData = array('message' => $message);
        $queryData = http_build_query($queryData, '', '&');
        $headerOptions = array('http' => array('method' => 'POST', 'header' => "Content-Type: application/x-www-form-urlencoded\r\n" . "Authorization: Bearer " . $line_token . "\r\n" . "Content-Length: " . strlen($queryData) . "\r\n", 'content' => $queryData));
        $context = stream_context_create($headerOptions);
        $result = file_get_contents($line_api, FALSE, $context);
        $res = json_decode($result);
        return $res;
    }
}
