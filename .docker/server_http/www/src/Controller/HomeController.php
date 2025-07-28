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
        if(sizeof($_POST)) {
            if(!empty($_POST['login']) && !empty($_POST['password'])) {
                if($_POST['login'] === 'guest' && $_POST['password'] === 'guest') {
                    if (session_status() === PHP_SESSION_ACTIVE) {
                        session_destroy();
                        session_id(sha1('guest'));
                        session_start();
                    }
                    $_SESSION['user'] =  'guest';
                }
            }
        }

        $status = 0;
        if(session_id() !== sha1('admin') && session_id() !== sha1('guest')) {
            $status = 0;
        } elseif(session_id() === sha1('admin')) {
            $status = 2;
        } else {
            $status = 1;
        }

        return $this->render('home', ['status' => $status, 'flag' => $this->getFlag('DEFAULT_CTF_FLAG')]);
    }
}
