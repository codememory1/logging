<?php

namespace Codememory\Components\Logging\Handlers;

use Codememory\Database\Redis\Connections\Connection as RedisConnection;
use Codememory\Database\Redis\Exceptions\IncorrectRedisHostOrPortException;
use Codememory\Database\Redis\Exceptions\IncorrectRedisPasswordOrUsernameException;
use Monolog\Handler\HandlerInterface as MonologHandlerInterface;
use Monolog\Handler\RedisHandler as MonologRedisHandler;
use Redis;

/**
 * Class RedisHandler
 * @package Codememory\Components\Logging\Handlers
 *
 * @author  Codememory
 */
class RedisHandler extends AbstractLoggingHandler
{

    private const DEFAULT_REDIS_KEY = '_cdm-logging';

    /**
     * @inheritDoc
     * @throws IncorrectRedisHostOrPortException
     * @throws IncorrectRedisPasswordOrUsernameException
     */
    public function getHandler(): MonologHandlerInterface
    {

        $redisConnection = new RedisConnection(new Redis());
        $redisConnection->makeConnection();

        $redisKey = $this->loggerData['redisKey'] ?? self::DEFAULT_REDIS_KEY;

        return new MonologRedisHandler($redisConnection->getRedis(), $redisKey, $this->getLevel());

    }


}