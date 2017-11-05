<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/30
 * Time: 14:28
 * Description：用来和mysql交互数据，学习事务等...
 */
namespace app\controllers;
use app\models\Documents;
use app\models\Student;
use yii\base\Controller;

class MysqlController extends Controller
{
    public function actionIndex(){
        $stime=microtime(true);
        $stu = new Student();
        $res = $stu->find()
            ->select(['id','name','major'])
            ->where(['id' => 1000000])
            ->one();
        
//        $docu = new Documents();
//        $id = 2;
//        $res = $docu->findOne($id);
        $etime=microtime(true);//获取程序执行结束的时间
        $total=$etime-$stime;  //计算差值
        var_dump( $res );
        echo $total."  秒";
    }
    public function actionTest(){

        echo "121";
    }
    // 生成百万数据
    public function actionMillion(){
        ini_set('max_execution_time', '0');
        set_time_limit(0);
        $res_data = [];
        $data_len = 1000000;
        $course_arr = [1,2,3,4,5];
        $department_arr = [1,2,3,4];
        for ( $i = 0; $i < $data_len; $i++ ){
            $sql = "INSERT INTO student (course_id,department_id,NAME,brith,major)VALUES("
                .$course_arr[ rand( 0, 4 ) ].","
                .$department_arr[ rand( 0, 3 ) ].","
                ."'xm_".rand( 0, 10 )
                ."','1996-05-25','zy_".rand(0,10)
                ."');\r\n";
            array_push( $res_data, $sql );
        }
        // 存入文件 追加方式
        file_put_contents( "G:/millionsql.sql", $res_data, FILE_APPEND );
    }
}