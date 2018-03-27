<?php
$config=array();
$config['AVAILABLE_TARGET_URL'] = array(
    // SAMPLE 请求链接必须在这个名单内才会被处理
    'https://discordapp.com/api/webhooks/123456789/ABCDEF',
);
$config['CONTENT_FILTER'] = array(
    'ml' => array('ミリオンライブ','#imas_ml','ミリシタ','ミリオン','MILLION',),
    '765' => array('ミリオンライブ','#imas_ml','ミリシタ','ミリオン','MILLION','765PRO','ALLSTARS','ステラステージ',),
    'karaage' => array('#本日の唐揚げ',),
);
