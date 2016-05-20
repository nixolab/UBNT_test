<?php

namespace Ubnt\Html;

use Ubnt\Html\Core\Element;

/**
 * Class Form
 */
class Form extends Element
{
    /**
     * @var string HTML element name
     */
    protected $_name = 'form';

    /**
     * Form constructor
     *
     * @param string $action    Form action
     * @param string $method    Form method
     * @param array $attributes Form attributes
     */
    public function __construct ($action, $method = 'POST', array $attributes = [])
    {
        $attributes['action'] = $action;
        $attributes['method'] = $method;

        $this->setAttributes($attributes);
    }

    /**
     * Static constructor alias
     *
     * @param string $action    Form action
     * @param string $method    Form method
     * @param array $attributes Form attributes
     * @return Form
     */
    public static function create ($action, $method = 'POST', array $attributes = [])
    {
        return new static($action, $method, $attributes);
    }
}