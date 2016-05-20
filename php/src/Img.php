<?php

namespace Ubnt\Html;

use Ubnt\Html\Core\SelfCloseElement;

/**
 * Class Img
 */
class Img extends SelfCloseElement
{
    /**
     * @var string HTML element name
     */
    protected $_name = 'img';

    /**
     * Img constructor
     *
     * @param string $src       Img source
     * @param string $alt       Img alt text
     * @param array $attributes Img attributes
     */
    public function __construct ($src, $alt = '', array $attributes = [])
    {
        $attributes['src'] = $src;
        $attributes['alt'] = $alt;

        $this->setAttributes($attributes);
    }

    /**
     * Static constructor alias
     *
     * @param string $src       Img source
     * @param string $alt       Img alt text
     * @param array $attributes Img attributes
     * @return Img
     */
    public static function create ($src, $alt = '', array $attributes = [])
    {
        return new static($src, $alt, $attributes);
    }
}