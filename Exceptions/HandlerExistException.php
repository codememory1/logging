<?php

namespace Codememory\Components\Logging\Exceptions;

use JetBrains\PhpStorm\Pure;

/**
 * Class HandlerExistException
 *
 * @package Codememory\Components\Logging\Exceptions
 *
 * @author  Codememory
 */
class HandlerExistException extends AbstractHandlerException
{

    /**
     * @param string $handlerName
     * @param string $namespace
     */
    #[Pure]
    public function __construct(string $handlerName, string $namespace)
    {

        parent::__construct($handlerName, $namespace, sprintf('A handler named %s by namespace %s already exists', $handlerName, $namespace));

    }

}