<?php

namespace Ubnt\Html\Core;

use \Ubnt\Html\Exception\ChildException;

/**
 * Class SelfCloseElement
 */
abstract class SelfCloseElement extends Element
{
    /**
     * @var bool Flag, is HTML element is self closing
     */
    protected $_isSelfClose = TRUE;

    /**
     * Forbid adding child to self closing HTML element
     *
     * @throws ChildException
     */
    final public function addChild ()
    {
        throw new ChildException('Trying to add child to self closing HTML element');
    }

    /**
     * Forbid removing child from self closing HTML element
     *
     * @throws ChildException
     */
    final public function removeChild ()
    {
        throw new ChildException('Trying to remove child from self closing HTML element');
    }
}