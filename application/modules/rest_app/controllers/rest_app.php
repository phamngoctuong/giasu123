<?php
/**
 * Created by PhpStorm.
 * User: hungha
 * Date: 5/9/19
 * Time: 17:24
 */
class rest_app extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('site_model_app');
    }

    function index(){
//        echo 'abc';
    }

    function config_json_get(){
        $data = $this->site_model_app->config_json_model();
        $this->response($data,200);
    }

    function list_teacher_outstanding_get(){
        $page = $this->get('page');
        $perpage = $this->get('per_page');
        if (empty($perpage)){
            $perpage=10;
        }
        if(empty($page)){
            $page=0;
        }
        $data = $this->site_model_app->get_list_teacher_outstanding_model($page,$perpage);
        $this->response($data,200);
    }

    function list_top_class_by_money_get(){
        $page = $this->get('page');
        $perpage = $this->get('per_page');
        if (empty($perpage)){
            $perpage=10;
        }
        if(empty($page)){
            $page=0;
        }
        $data = $this->site_model_app->GetTopClassByMoney($page,$perpage);
        $this->response($data, 200);
    }

    function searchteacher()
    {
        $key=$_POST['key'];
        $subject=$_POST['subject'];
        $topic=$_POST['topic'];
        $place=$_POST['place'];
        $type=$_POST['type'];
        $sex=$_POST['sex'];
        if(!empty($_POST)){
            //var_dump($key,$subject,$topic,$place,$type);die();
            $link=base_url()."tim-lop-hoc&key=".$key."&subject=".intval($subject)."&topic=".intval($topic)."&place=".intval($place)."&type=".intval($type)."&sex=".intval($sex)."&class=0";
            $result=['kq'=>true,'data'=>$link];
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
        }else{
            $this->response(null, 404);
        }
    }

    function filter_list_class_get(){
        $keyword = $this->get('keyword');
        $topic = $this->get('topic');
        $subject = $this->get('subject');
        $city = $this->get('city');
        $type = $this->get('type');
        $sex = $this->get('sex');
        $class = $this->get('class');
        $page = $this->get('page');
        $perpage = $this->get('per_page');
        if (empty($perpage)){
            $perpage=20;
        }
        if(empty($page)||intval($page)==0){
            $page=0;
        }else{
            $page=intval($page);
        }
        $data = $this->site_model_app->GetListClassBySearchTotal($keyword,$subject,$topic,$city,$type,$sex,$class,$page,$perpage);
//        var_dump($data);
//        die();
        $this->response($data,200);
    }

    function filter_list_teacher_get(){
        $keyword = $this->get('keyword');
        $topic = $this->get('topic');
        $subject = $this->get('subject');
        $city = $this->get('city');
        $type = $this->get('type');
        $sex = $this->get('sex');
        $class = $this->get('class');
        $order = $this->get('order');
        $page = $this->get('page');
        $perpage = $this->get('per_page');
        if(!isset($order)||empty($order)){
            $order='last';
        }
        if (empty($perpage)){
            $perpage=20;
        }
        if(empty($page)||intval($page)==0){
            $page=0;
        }else{
            $page=intval($page);
        }
        $data = $this->site_model_app->GetListTeacherBySearch($keyword,$subject,$topic,$city,$type,$sex,$order,$page,$perpage);
//        var_dump($data);
//        die();
        $this->response($data,200);
    }

    function users_get()
    {
        //$users = $this->some_model->getSomething( $this->get('limit') );
        $users = array(
            array('id' => 1, 'name' => 'Some Guy', 'email' => 'example1@example.com'),
            array('id' => 2, 'name' => 'Person Face', 'email' => 'example2@example.com'),
            array('id' => 3, 'name' => 'Scotty', 'email' => 'example3@example.com'),
        );

        if($users)
        {
            $this->response($users, 200);
//            var_dump($users);// 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }
}