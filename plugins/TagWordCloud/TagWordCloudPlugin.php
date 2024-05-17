<?php

require_once __DIR__ . '/helpers/functions.php';

class TagWordCloudPlugin extends Omeka_Plugin_AbstractPlugin {
    protected $_hooks = [
        'public_head',
    ];
    public function hookPublicHead()
    {
        queue_js_file('vendor/echarts.min');
        queue_js_file('vendor/echarts-wordcloud.min');
        queue_js_file('tag_word_cloud');
        queue_css_file('tag_word_cloud');
    }

    public function hookUninstall() {
        $this->_uninstallOptions();
    }

}