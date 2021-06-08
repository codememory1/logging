<?php

namespace Codememory\Components\Logging\Exceptions;

use JetBrains\PhpStorm\Pure;

/**
 * Class HandlerNotImplementInterfaceException
 * @package Codememory\Components\Logging\Exceptions
 *
 * @author  Codememory
 */
class HandlerNotImplementInterfaceException extends LoggingException
{

    /**
     * HandlerNotImplementInterfaceException constructor.
     *
     * @param string $interfaceNamespace
     */
    #[Pure]
    public function __construct(string $interfaceNamespace)
    {

        parent::__construct(sprintf('The logging handler must implement the %s interface', $interfaceNamespace));

    }

}