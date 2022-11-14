<?php

namespace Dwes\ProyectoVideoClub\Util;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Psr\Log\LoggerInterface;

class LogFactory
{
    public static function getLogger(string $canal = "videoclub") : LoggerInterface
    {
        $log = new Logger($canal);
        $log->pushHandler(new StreamHandler("logs/videoclub.log", Logger::DEBUG));

        return $log;
    }
}
