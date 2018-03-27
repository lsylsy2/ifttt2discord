<?php
include_once('config.php');

function general_filtrated($payload) {
    global $config;
    if (!isset($payload->setting->content_filter)) { // 使用过滤器名称
        echo "content_filter not find!";
        syslog(LOG_WARNING,"content_filter not find!".json_encode($payload));
        exit;
    }
    $content_filter=$payload->setting->content_filter;
    if (!isset($config['CONTENT_FILTER'][$content_filter])) {
        echo "content_filter error!";
        syslog(LOG_WARNING,"content_filter error!".json_encode($payload).$content_filter.json_encode($config['CONTENT_FILTER']));
        exit;
    }

    if (!isset($payload->data->text)) { // 校验数据存在
        echo "text not find!";
        syslog(LOG_WARNING,"text not find!".json_encode($payload));
        exit;
    }
    if (!isset($payload->data->url)) {
        echo "url not find!";
        syslog(LOG_WARNING,"url not find!".json_encode($payload));
        exit;
    }

    $text=$payload->data->text;

    $content_filter_pass_keyword = false;
    foreach($config['CONTENT_FILTER'][$content_filter] as $filter_keyword) {
        if (strpos($text,$filter_keyword)!==FALSE) {
            $content_filter_pass_keyword = $filter_keyword;
            break;
        }
    }
    if ($content_filter_pass_keyword==false) {
        echo "content_filter_pass_keyword failed!";
        syslog(LOG_WARNING,"content_filter_pass_keyword failed!".json_encode($payload));
        exit;
    }

    $result=array();

    if (!isset($payload->data->title)) {
        echo "title not find!";
        syslog(LOG_WARNING,"title not find!".json_encode($payload));
        exit;
    }
    $result['content'] = $payload->data->title."\n";

    if (isset($payload->data->from)) {
        $result['content'] .= "From: ".$payload->data->from."\n";
    }
    if (isset($payload->data->created_at)) {
        $result['content'] .= "Time: ".$payload->data->created_at."\n";
    }
    $result['content'] .= "Keyword: $content_filter_pass_keyword\n".
                         $payload->data->url;
    return json_encode($result);
}

function twitter_filtrated($payload) {
    global $config;
    if (!isset($payload->setting->content_filter)) { // 使用过滤器名称
        echo "content_filter not find!";
        syslog(LOG_WARNING,"content_filter not find!".json_encode($payload));
        exit;
    }
    $content_filter=$payload->setting->content_filter;
    if (!isset($config['CONTENT_FILTER'][$content_filter])) {
        echo "content_filter error!";
        syslog(LOG_WARNING,"content_filter error!".json_encode($payload).$content_filter.json_encode($config['CONTENT_FILTER']));
        exit;
    }

    if (!isset($payload->data->text)) { // 校验数据存在
        echo "text not find!";
        syslog(LOG_WARNING,"text not find!".json_encode($payload));
        exit;
    }
    if (!isset($payload->data->username)) {
        echo "username not find!";
        syslog(LOG_WARNING,"username not find!".json_encode($payload));
        exit;
    }
    if (!isset($payload->data->link_to_tweet)) {
        echo "link_to_tweet not find!";
        syslog(LOG_WARNING,"link_to_tweet not find!".json_encode($payload));
        exit;
    }
    if (!isset($payload->data->created_at)) {
        echo "created_at not find!";
        syslog(LOG_WARNING,"created_at not find!".json_encode($payload));
        exit;
    }

    $text=$payload->data->text;

    $content_filter_pass_keyword = false;
    foreach($config['CONTENT_FILTER'][$content_filter] as $filter_keyword) {
        if (strpos($text,$filter_keyword)!==FALSE) {
            $content_filter_pass_keyword = $filter_keyword;
            break;
        }
    }
    if ($content_filter_pass_keyword==false) {
        echo "content_filter_pass_keyword failed!";
        syslog(LOG_WARNING,"content_filter_pass_keyword failed!".json_encode($payload));
        exit;
    }

    $result=array();
    $result['content'] = "**「ツイート」**\n".
                         "From: ".$payload->data->username."\n".
                         "Time: ".$payload->data->created_at."\n".
                         "Keyword: $content_filter_pass_keyword\n".
                         $payload->data->link_to_tweet;
    return json_encode($result);
}

function twitter_all($payload) {
    global $config;

    if (!isset($payload->data->username)) { // 校验数据存在
        echo "username not find!";
        syslog(LOG_WARNING,"username not find!".json_encode($payload));
        exit;
    }
    if (!isset($payload->data->link_to_tweet)) {
        echo "link_to_tweet not find!";
        syslog(LOG_WARNING,"link_to_tweet not find!".json_encode($payload));
        exit;
    }
    if (!isset($payload->data->created_at)) {
        echo "created_at not find!";
        syslog(LOG_WARNING,"created_at not find!".json_encode($payload));
        exit;
    }

    $result=array();
    $result['content'] = "**「ツイート」**\n".
                         "From: ".$payload->data->username."\n".
                         "Time: ".$payload->data->created_at."\n".
                         $payload->data->link_to_tweet;
    return json_encode($result);
}

function youtube_filtrated($payload) {
    global $config;
    if (!isset($payload->setting->content_filter)) { // 使用过滤器名称
        echo "content_filter not find!";
        syslog(LOG_WARNING,"content_filter not find!".json_encode($payload));
        exit;
    }
    $content_filter=$payload->setting->content_filter;
    if (!isset($config['CONTENT_FILTER'][$content_filter])) {
        echo "content_filter error!";
        syslog(LOG_WARNING,"content_filter error!".json_encode($payload).$content_filter.json_encode($config['CONTENT_FILTER']));
        exit;
    }

    if (!isset($payload->data->created_at)) { // 校验数据存在
        echo "created_at not find!";
        syslog(LOG_WARNING,"created_at not find!".json_encode($payload));
        exit;
    }
    if (!isset($payload->data->title)) {
        echo "title not find!";
        syslog(LOG_WARNING,"title not find!".json_encode($payload));
        exit;
    }
    if (!isset($payload->data->authorname)) {
        echo "authorname not find!";
        syslog(LOG_WARNING,"authorname not find!".json_encode($payload));
        exit;
    }
    if (!isset($payload->data->description)) {
        echo "description not find!";
        syslog(LOG_WARNING,"description not find!".json_encode($payload));
        exit;
    }
    if (!isset($payload->data->url)) {
        echo "url not find!";
        syslog(LOG_WARNING,"url not find!".json_encode($payload));
        exit;
    }

    $text=$payload->data->title.$payload->data->description;

    $content_filter_pass_keyword = false;
    foreach($config['CONTENT_FILTER'][$content_filter] as $filter_keyword) {
        if (strpos($text,$filter_keyword)!==FALSE) {
            $content_filter_pass_keyword = $filter_keyword;
            break;
        }
    }
    if ($content_filter_pass_keyword==false) {
        echo "content_filter_pass_keyword failed!";
        syslog(LOG_WARNING,"content_filter_pass_keyword failed!".json_encode($payload));
        exit;
    }

    $result=array();
    $result['content'] = "**「動画」**\n".
                         "Title: ".$payload->data->title."\n".
                         "From: ".$payload->data->authorname."\n".
                         "Time: ".$payload->data->created_at."\n".
                         "Keyword: $content_filter_pass_keyword\n".
                         $payload->data->url;
    return json_encode($result);
}

$post_body = file_get_contents('php://input');
// var_dump($post_body);
$payload = json_decode($post_body);
if ($payload == NULL) {
    echo "payload not find!";
    syslog(LOG_WARNING,"payload not find!");
    exit;
}
// var_dump($payload);

if (!isset($payload->setting)) { // 设置项
    echo "setting not find!";
    syslog(LOG_WARNING,"setting not find!$post_body");
    exit;
}

if (!isset($payload->data)) { // 数据
    echo "data not find!";
    syslog(LOG_WARNING,"data not find!$post_body");
    exit;
}

if (!isset($payload->setting->target_url)) { // 目标WebHook地址，需在白名单内，起到认证效果
    echo "target_url not find!";
    syslog(LOG_WARNING,"target_url not find!$post_body");
    exit;
}
$target_url = $payload->setting->target_url;
if (!in_array($target_url,$config['AVAILABLE_TARGET_URL'])) {
    echo "target_url error!";
    syslog(LOG_WARNING,"target_url error!$post_body");
    exit;
}

if (!isset($payload->setting->type)) { // 请求类别，由各个函数处理
    echo "type not find!";
    syslog(LOG_WARNING,"type not find!$post_body");
    exit;
}

switch ($payload->setting->type) {
    case "twitter_filtrated":
        $result_json = twitter_filtrated($payload);
        break;
    case "twitter_all":
        $result_json = twitter_all($payload);
        break;
    case "youtube_filtrated":
        $result_json = youtube_filtrated($payload);
        break;
    default:
        echo "type error!";
        syslog(LOG_WARNING,"type error!$post_body");
        exit;
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $target_url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $result_json);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json',
            'Content-Length: '.strlen($result_json)));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result=curl_exec($ch);
curl_close($ch);
syslog(LOG_NOTICE,"webhook request sent! $result_json to $target_url result $result");
