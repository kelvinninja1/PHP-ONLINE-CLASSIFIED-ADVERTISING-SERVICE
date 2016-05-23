<?php
namespace App\controllers;
use App\lib\ContactForm;
use App\lib\Controller;
use App\lib\Router;
use App\lib\Session;
use App\models\Message;

class MessagesController extends Controller
{
    public function __construct($data=array())
    {
        parent::__construct($data);
        $this->model=new Message();
    }
    public function view()
    {
        $this->data['message']=$this->model->getUserMessageById((int)$this->getParams()[0])[0];
        (Session::get('id')==(int)$this->data['message']['from_id'] OR Session::get('id')==(int)$this->data['message']['to_id']) ? null: Router::redirect(PRELINK);
        $contactform = new ContactForm($_POST, $this->model,$this->data['message']['ad_id'],$this->data['message']['title'],Session::get('id'),Session::get('id')==$this->data['message']['to_id']?$this->data['message']['from_id']:$this->data['message']['to_id']);
    }

}