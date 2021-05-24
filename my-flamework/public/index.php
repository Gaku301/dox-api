<?php
/**
 * 全てのリクエストは必ずこのファイルを経由する.
 */
if (empty($_SERVER['REQUEST_URI'])) {
    exit;
}

// URLをスラッシュで分解
$parse_uri_array = explode('/', $_SERVER['REQUEST_URI']);
// 最後の文字を取り出す
$last_uri = end($parse_uri_array);
// クエリ文字列を外す
$called = substr($last_uri, 0, strcspn($last_uri, '?'));

// app/controller/配下に同名のPHPファイルがないか探す
if (file_exists('../app/controller/'.$called.'.php')) {
    // 該当ファイルをインクルードし、コントローラーをインスタンス化する
    include '../app/controller/'.$called.'.php';
    $class = 'app\contoller\\'.$called;
    $class_obj = new $class();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // POSTであれば、コントローラーのpostメソッドを呼び出す
        $response = $class_obj->post();
    } else {
        // それ以外は空で返す
        $response = [];
    }

    // Origin null is not allowed by Access-Control-Allow-Origin.とかのエラー回避の為、ヘッダー付与
    header('Access-Control-Allow-Ofigin: *');
    // json形式で値を返す
    echo json_encode($response);
} else {
    // 該当ファイルがなければエラーを返す
    header('HTTP/1.0 404 Not Found');
    exit;
}
