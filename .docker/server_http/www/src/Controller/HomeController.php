<?php
 
namespace App\Controller;

use App\Entity\User;

use App\Service\Level0;
use Yoop\AbstractController;
use App\Service\ControlLevel;

class HomeController extends AbstractController
{
    public function print() 
    {
        return $this->render('home');
    }
}
