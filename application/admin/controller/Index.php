<?php
namespace app\admin\controller;
use think\Controller;
use phpmailer\Phpmailer;
use phpmailer\Smtp; 
class Index extends Base
{
    public function index()
    {
/*   if(!empty($this->account)){ */
            return $this->fetch();
/*   }else{
      return  $this->redirect('login/logout');
  } */
  }
}
