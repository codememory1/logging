<?php

namespace Codememory\Components\Logging\Exceptions;

use JetBrains\PhpStorm\Pure;

/**
 * Class HandlerNotExistException
 *
 * @package Codememory\Components\Logging\Exceptions
 *
 * @author  Codememory
 */
class HandlerNotExistException extends AbstractHandlerException
{

    /**
     * @param string $handlerName
     */
    #[Pure]
    public function __construct(string $handlerName)
    {

        parent::__construct($handlerName, message: sprintf('Handler named %ы does not exist', $handlerName));

    }

}