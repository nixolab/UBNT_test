<?php

namespace Ubnt\Html;

use Ubnt\Html\Core\SelfCloseElement;

/**
 * Class Input
 */
class Input extends SelfCloseElement
{
    /**
     * @var string HTML element name
     */
    protected $_name = 'input';

    /**
     * Input constructor
     *
     * @param string $type      Input type
     * @param mixed $value      Input value
     * @param array $attributes Input attributes
     */
    public function __construct ($type = 'text', $value = '', array $attributes = [])
    {
        $attributes['type']  = $type;
        $attributes['value'] = $value;

        $this->setAttributes($attributes);
    }

    /**
     * Static constructor alias
     *
     * @param string $type      Input type
     * @param mixed $value      Input value
     * @param array $attributes Input attributes
     * @return Input
     */
    public static function create ($type = 'text', $value = '', array $attributes = [])
    {
        return new static($type, $value, $attributes);
    }
}