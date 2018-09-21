<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{
    public function index(){
        return $this->render('index.html.twig');
    }
    // public function index()
    // {
    //     $number = random_int(0, 100);

    //     return new Response(
    //         '<html><body>Lucky number: '.$number.'</body></html>'
    //     );
    // }

    // public function hello($name)
    // {
    //     //return new response();
    //     return $this->render('hello.html.php', array('name'=>$name));
    // }

    // public function test(){
    //     $dummyData = array('Banana', 'Apple', 'Orange', 'Ananas', 'Cherry');
    //     return $this->render('test.html.php', array('data' => $dummyData));
    // }

    // public function twig(){
    //     $dummyData = array('Banana', 'Apple', 'Orange', 'Ananas', 'Cherry');
    //     return $this->render('twigdemo.html.twig', array('data' => $dummyData));
    // }
}


