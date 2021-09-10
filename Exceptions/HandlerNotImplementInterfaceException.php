<?php

namespace Codememory\Components\Logging\Exceptions;

use Codememory\Components\Logging\Interfaces\HandlerInterface;
use JetBrains\PhpStorm\Pure;

/**
 * Class HandlerNotImplementInterfaceException
 *
 * @package Codememory\Components\Logging\Exceptions
 *
 * @author  Codememory
 */
class HandlerNotImplementInterfaceException extends AbstractHandlerException
{

    /**
     * @param string $handlerName
     * @param string $namespace
     */
    #[Pure]
    public function __construct(string $handlerName, string $namespace)
    {

        parent::__construct($handlerName, $namespace, sprintf(
            'Handler named %s by namespace %s does not implement %s interface',
            $handlerName,
            $namespace,
            HandlerInterface::class
        ));

    }

}