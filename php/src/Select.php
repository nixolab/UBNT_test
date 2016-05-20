<?php

namespace Ubnt\Html;

use Ubnt\Html\Core\Element;
use Ubnt\Html\Exception\ChildException;

/**
 * Class Select
 */
class Select extends Element
{
    /**
     * @var string HTML element name
     */
    protected $_name = 'select';

    /**
     * Select constructor
     *
     * @param array $options    Select options
     * @param bool $isMultiple  Flag, is select multiple
     * @param array $attributes Select attributes
     */
    public function __construct (array $options = [], $isMultiple = FALSE, array $attributes = [])
    {
        foreach ($options as $option) {
            $this->addChild($option);
        }

        if ($isMultiple === TRUE) {
            $attributes['multiple'] = TRUE;
        }

        $this->setAttributes($attributes);
    }

    /**
     * Static constructor alias
     *
     * @param array $options    Select options
     * @param bool $isMultiple  Flag, is select multiple
     * @param array $attributes Select attributes
     * @return Select
     */
    public static function create (array $options = [], $isMultiple = FALSE, array $attributes = [])
    {
        return new static($options, $isMultiple, $attributes);
    }

    /**
     * Restrict direct children by only instances of Option
     *
     * @param Option $child        Child element
     * @param int|bool $childIndex Index of child element. If FALSE, child will be appended to the end
     * @return $this
     * @throws ChildException
     */
    public function addChild($child, $childIndex = FALSE)
    {
        if ($child instanceof Option) {
            return parent::addChild($child, $childIndex);
        } else {
            throw new ChildException('Invalid child data type. Should be an instance of Option');
        }
    }
}