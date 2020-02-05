<?php

namespace App\Logging;

use Monolog\Logger;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Formatter\LineFormatter;

class CreateCustom2Logger
{
    const dateFormat = 'Y/m/d H:i:s';

    /**
     * カスタムMonologインスタンスの生成
     *
     * @param  array  $config
     * @return \Monolog\Logger
     */
    public function __invoke(array $config)
    {
        // monologが理解できるlevel表記に変更
        $level = Logger::toMonologLevel($config['level']);
        //日毎にログを分けたい場合は、 RotatingFileHandlerハンドラーを利用する。
        $hander = new RotatingFileHandler($config['path'], $config['days'], $level); //(ファイルを出力する場所,残すファイルの上限数,ログのレベル)
        // ログのフォーマット指定
        // ここでは指定(null)しないが、1つ目の引数にログのformatを指定することも可能
        $hander->setFormatter(new LineFormatter(null, self::dateFormat, true, true));
        // ログ作成 Custom1はログに表記される
        //newでLoggerクラスをインスタンス化している、インスタンス化する際に識別用の名前を引数に入れる。
        $logger = new Logger('Custom2');
        //pushHandlerメソッドに使用するハンドラーを入力するとチャネルにハンドラーが設定される。
        $logger->pushHandler($hander);
        return $logger;
    }
}
