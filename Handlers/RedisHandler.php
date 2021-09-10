<?php

namespace Codememory\Components\Logging\Handlers;

use Codememory\Database\Redis\Connections\Connection;
use Codememory\Database\Redis\Exceptions\IncorrectRedisHostOrPortException;
use Codememory\Database\Redis\Exceptions\IncorrectRedisPasswordOrUsernameException;
use Monolog\Handler\HandlerInterface as MonologHandlerInterface;
use Monolog\Handler\RedisHandler as MonologRedisHandler;
use Redis;

/**
 * Class RedisHandler
 *
 * @package Codememory\Components\Logging\Handlers
 *
 * @author  Codememory
 */
class RedisHandler extends AbstractHandler
{

    private const DEFAULT_REDIS_KEY = '__cdm-log';

    /**
     * @inheritDoc
     * @throws IncorrectRedisHostOrPortException
     * @throws IncorrectRedisPasswordOrUsernameException
     */
    public function process(): MonologHandlerInterface
    {

        $connection = new Connection(new Redis());
        $connection->makeConnection();

        $redisKey = $this->parameters['key'] ?? self::DEFAULT_REDIS_KEY;

        return new MonologRedisHandler($connection->getRedis(), $redisKey, $this->forLevel);

    }

}