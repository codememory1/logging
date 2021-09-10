<?php

namespace Codememory\Components\Logging\Exceptions;

use JetBrains\PhpStorm\Pure;

/**
 * Class LogLevelNotExistException
 *
 * @package Codememory\Components\Logging\Exceptions
 *
 * @author  Codememory
 */
class LogLevelNotExistException extends AbstractHandlerException
{

    /**
     * @param string $handlerName
     * @param int    $level
     */
    #[Pure]
    public function __construct(string $handlerName, int $level)
    {

        parent::__construct($handlerName, message: sprintf(
            'Unable to add %s handler for log level %s',
            $handlerName,
            $level
        ));

    }

}