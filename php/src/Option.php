<?php

namespace Ubnt\Html;

use Ubnt\Html\Core\Element;

/**
 * Class Option
 */
class Option extends Element
{
    /**
     * @var string HTML element name
     */
    protected $_name = 'option';

    /**
     * Option constructor
     *
     * @param mixed $value      Option value
     * @param mixed $text       Option text
     * @param bool $isSelected  Flag, is option selected
     * @param array $attributes Option attributes
     */
    public function __construct ($value = '', $text = '', $isSelected = FALSE, array $attributes = [])
    {
        $attributes['value'] = $value;
        if ($isSelected === TRUE) {
            $attributes['selected'] = TRUE;
        }

        $this->setAttributes($attributes);

        if ($text) {
            $this->addChild($text);
        }
    }

    /**
     * Static constructor alias
     *
     * @param mixed $value      Option value
     * @param mixed $text       Option text
     * @param bool $isSelected  Flag, is option selected
     * @param array $attributes Option attributes
     * @return Option
     */
    public static function create ($value = '', $text = '', $isSelected = FALSE, array $attributes = [])
    {
        return new static($value, $text, $isSelected, $attributes);
    }
}