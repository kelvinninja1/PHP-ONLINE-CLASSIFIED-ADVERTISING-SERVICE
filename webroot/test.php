<?php
class A{
    public $z='test';
    public function __construct()
    {
        echo "yohoho";
    }
}

$a=new A();
$b=$a;
$b->z='test2';
echo $a->z;

