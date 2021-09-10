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
     * @param array $parameters
     *
     * @return HandlerInterface
     */
    public function setParameters(array $parameters): HandlerInterface;

    /**
     * @return MonologHandlerInterface
     */
    public function process(): MonologHandlerInterface;

}