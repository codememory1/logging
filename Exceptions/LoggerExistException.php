<?php

namespace Codememory\Components\Logging\Exceptions;

use JetBrains\PhpStorm\Pure;

/**
 * Class LoggerExistException
 *
 * @package Codememory\Components\Logging\Exceptions
 *
 * @author  Codememory
 */
class LoggerExistException extends AbstractLoggerException
{

    /**
     * @param string $loggerName
     */
    #[Pure]
    public function __construct(string $loggerName)
    {

        parent::__construct($loggerName, sprintf('A logger named %s already exists.', $loggerName));

    }

}