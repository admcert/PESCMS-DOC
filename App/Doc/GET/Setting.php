<?php

/**
 * PESCMS for PHP 5.4+
 *
 * Copyright (c) 2014 PESCMS (http://www.pescms.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 */

namespace App\Doc\GET;

class Setting extends \Core\Controller\Controller {

    /**
     * 系统设置
     */
    public function action(){
        $option = [];
        foreach(\Model\Content::listContent(['table' => 'option']) as $key => $value){
            if(is_array(json_decode($value['value'], true)) || $value['option_name'] == 'crossdomain' ){
                $option[$value['option_name']] = json_decode($value['value'], true);
            }else{
                $option[$value['option_name']] = $value;
            }
        }
        $this->assign($option);
        $this->assign('title', '系统设置');
        $this->layout();
    }

    public function upgrade(){
        $this->assign('title', '检查更新');
        $this->layout();
    }

}
