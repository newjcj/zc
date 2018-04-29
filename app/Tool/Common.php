<?php

namespace App\Tool;

class Common {
    //合并一个数组的下面都是obj对像的为一个一维数组
  public static function array_collapse($arr){
      $r=[];
      foreach ($arr as $item) {
          $r[]=$item->id;
        }
        return $r;
  }
}
