<?php

class CategoriesController extends Controller
{
    public function __construct($data=array())
    {
        parent::__construct($data);
        $this->model=new Category();
    }
    public function index()
    {
        $this->data['categories']= $this->model->getCategories();


    }

    public function getlist()
    {
        /*if(($_SERVER['REQUEST_URI']==PRELINK.'categories/getlist/')AND !empty($_POST['search']) )
        App::getRouter()->redirect($_SERVER['REQUEST_URI'].$_POST['search']."/");*/
//        echo "<pre>";
//        die(var_dump($this->model->allAds()));
        $this->data['regions']=$this->model->getRegions();
//        die(var_dump($this->model->getRegion(1)));
        $this->data['categories']=$this->model->getCategories();
        $this->data['ads']=$this->model->getAds();
        $this->data['pagination']=$this->model->getPagination();
    }

    public function show()
    {
        $this->data['categories']=$this->model->getCategories();
        $this->data['ad']=$this->model->getAdByAdID($this->model->extractId($this->params[0]));
        $this->data['other_ads']=$this->model->getAds( $this->data['ad']['id_user']);
        $contactform = new ContactForm($_POST, $this->model,$this->data['ad']['id'],$this->data['ad']['title'],Session::get('id'),$this->data['ad']['id_user']);
    }

    public function edit()
    {
        $this->data['ad']=$this->model->getAdByAdID($this->model->extractId($this->params[0]));
        if($this->data['ad']['id_user']!=Session::get('id') OR Session::get('role'!='2')OR Session::get('role'!='1'))Router::redirect (PRELINK);
        $this->data['categories']=$this->model->getCategories();
        $this->data['regions']=$this->model->getRegions();
        $this->data['user']=$this->model->userInfo($this->data['ad']['id_user']);
        $form=new AdForm($_POST,$this->model,$this->data['ad']);

    }
    public function archive()
    {
        Session::get('username') ?: Router::redirect(PRELINK . 'users/login');
        $this->data['ad']=$this->model->getAdByAdID((int)$this->params[0]);
        if($this->data['ad']['id_user']!=Session::get('id') OR Session::get('role'!='2')OR Session::get('role'!='1'))Router::redirect (PRELINK);
        if (isset($this->params[0])) {
            $result = $this->model->deactivateAd($this->data['ad']['id'], $this->data['ad']['id_user']);
            if ($result) {
                Session::setFlash('Объявление было перемещено в архив');

            } else {
                Session::setErrorFlash('Ошибка');
            }
        }else
            Router::redirect(PRELINK);
        Router::redirect(PRELINK."users/current");
    }


    public function add_new_ad()
    {
        Session::get('username') ?  : Router::redirect(PRELINK . 'users/login');
        $form=new AdForm($_POST,$this->model);
        $this->data['regions']=$this->model->getRegions();
        $this->data['categories']=$this->model->getCategories();
        $this->data['user']=$this->model->userInfo(Session::get('id'));
//        var_dump($_POST);

    }
    

   /* public function admin_edit()
    {
        if($_POST){
            $id=isset($_POST['id'])?$_POST['id']:null;
            $result=$this->model->save($_POST,$id);
            if($result){
                Session::setFlash('Page was saved');

            }else{
                Session::setFlash('Error.');
            }
            Router::redirect(PRELINK."admin/pages/");
        }
        if(isset($this->params[0])){
            $this->data['page']=$this->model->getById($this->params[0]);
        }else{
            Session::setFlash('Wrong page ID');
            Router::redirect(PRELINK.'admin/pages/');


        }
    }

    public function admin_add()
    {
        if($_POST){
            $result=$this->model->save($_POST);
            if($result){
                Session::setFlash('Page was saved');

            }else{
                Session::setFlash('Error.');
            }
            Router::redirect(PRELINK.'admin/pages/');
        }
    }

    public function admin_delete()
    {
        if(isset($this->params[0])){
            $result=$this->model->delete($this->params[0]);
            if($result){
                Session::setFlash('Page was deleted');

            }else{
                Session::setFlash('Error.');
            }
        }
        Router::redirect(PRELINK.'admin/pages/');
    }*/
}