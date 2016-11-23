<?php

/**
 * PESCMS for PHP 5.4+
 *
 * Copyright (c) 2014 PESCMS (http://www.pescms.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 */

namespace App\Doc\PUT;

class Setting extends \Core\Controller\Controller {

    public function action() {

        foreach (['upload_img', 'upload_file'] as $value) {
            $data[$value] = json_encode(explode(',', str_replace(["\r\n", "\r", " "], '', $_POST[$value])));
        }

        foreach (['sitetitle', 'login', 'articlereview', 'verify'] as $value) {
            $data[$value] = $this->p($value);
        }

        foreach ($data as $key => $value) {
            $this->db('option')->where('option_name = :option_name')->update(['value' => $value, 'noset' => ['option_name' => $key]]);
        }

        $this->success('保存设置成功!', $this->url(GROUP . '-Setting-action'));
    }

    /**
     * 自动更新
     * @todo 日后在弄
     */
    public function atUpgrade() {

    }

    /**
     * 手动更新
     */
    public function mtUpgrade() {
        $file = $_FILES['zip'];
        if (pathinfo($file['name'])['extension'] != 'zip') {
            $this->error('请导入zip的更新补丁');
        }

        /**
         * 解压出错
         */
        $info = (new \Expand\zip())->unzip($file['tmp_name']);

        $info = $this->actionsql();

        if ($info === true) {
            $info = ['升级完成'];
        }

        $this->assign('info', $info);
        $this->layout('Setting_upgrade_info');
    }

    /**
     * 执行数据库更新
     * @return bool|string
     */
    private function actionsql() {
        $version = \Model\Content::findContent('option', 'version', 'option_name')['value'];

        $ini = PES_PATH . 'Upgrade/actionsql.ini';
        if (!file_exists($ini)) {
            return ['升级配置数据库文件不存在'];
        }

        $ini_array = parse_ini_file($ini, true);

        foreach ($ini_array as $iniversion => $value) {
            if ($iniversion > $version) {
                if (!empty($value['sql'])) {
                    foreach ($value['sql'] as $sql) {
                        $this->db()->query($sql);
                    }
                }

                $this->db('option')->where('option_name = :option_name')->update([
                    'value' => $iniversion,
                    'noset' => [
                        'option_name' => 'version'
                    ]
                ]);
                $version = $iniversion;
            }
        }
        //移除升级的配置文件
        unlink($ini);

        return true;

    }

}
