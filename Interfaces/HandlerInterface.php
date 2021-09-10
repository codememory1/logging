<?php

namespace Codememory\Components\Logging\Interfaces;

use Monolog\Handler\HandlerInterface as MonologHandlerInterface;

/**
 * Interface HandlerInterface
 *
 * @package Codememory\Components\Logging\Interfaces
 *
 * @author  Codememory
 */
interface HandlerInterface
{

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Set parameters to be passed to the handler
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param array $parameters
     *
     * @return HandlerInterface
     */
    public function setParameters(array $parameters): HandlerInterface;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * A handler that should return a finished processing object
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @return MonologHandlerInterface
     */
    public function process(): MonologHandlerInterface;

}