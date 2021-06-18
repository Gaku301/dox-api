<?php

namespace app\controller;

require_once dirname(__FILE__).'/../../vendor/autoload.php';

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/*
 * ベースとなるコントローラー
 * (共通処理等を記載する)
 */
class controller
{
    private $name = 'controller';

    protected function __construct()
    {
        // コントローラーを直接呼ばれてもnewできないように
    }

    // ログ出力
    public function logging($message, string $file_name = 'app.log')
    {
        $Logger = new Logger('logger');
        $Logger->pushHandler(new StreamHandler(__DIR__.'/../../logs/'.$file_name, Logger::INFO));
        $Logger->info($message);
    }
}
