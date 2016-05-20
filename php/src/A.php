<?php

namespace Ubnt\Html;

use Ubnt\Html\Core\Element;

/**
 * Class A
 */
class A extends Element
{
    /**
     * @var string HTML element name
     */
    protected $_name = 'a';

    /**
     * A constructor
     *
     * @param string $href      A href
     * @param array $attributes A attributes
     */
    public function __construct ($href = '#', array $attributes = [])
    {
        $attributes['href']  = $href;

        $this->setAttributes($attributes);
    }

    /**
     * Static constructor alias
     *
     * @param string $href      A href
     * @param array $attributes A attributes
     * @return A
     */
    public static function create ($href = '#', array $attributes = [])
    {
        return new static($href, $attributes);
    }
}