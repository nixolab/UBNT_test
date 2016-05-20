<?php

namespace Ubnt\Html\Core;

use \Ubnt\Html\Exception\ChildException;

/**
 * Class Element
 */
abstract class Element
{
    /**
     * @var string HTML element name
     */
    protected $_name;

    /**
     * @var array HTML element attributes
     */
    protected $_attributes = [];

    /**
     * @var bool Flag, is HTML element is self closing
     */
    protected $_isSelfClose = FALSE;

    /**
     * @var array HTML element children
     */
    protected $_children = [];

    /**
     * Element constructor
     *
     * @param array $attributes HTML element attributes
     */
    public function __construct (array $attributes = [])
    {
        $this->setAttributes($attributes);
    }

    /**
     * Magic method to simplify rendering of HTML element
     *
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }

    /**
     * Static constructor alias
     *
     * @param array $attributes HTML element attributes
     * @return static
     */
    public static function create (array $attributes = [])
    {
        return new static($attributes);
    }

    /**
     * Get attribute value of HTML element
     *
     * @param string $attrName Attribute name
     * @return mixed|FALSE
     */
    public function getAttribute ($attrName)
    {
        if (isset($this->_attributes[$attrName])) {
            return $this->_attributes[$attrName];
        } else {
            return FALSE;
        }
    }

    /**
     * Set attribute of HTML element
     *
     * @param string $attrName Attribute name
     * @param mixed $attrValue Attribute value
     * @return $this
     */
    public function setAttribute ($attrName, $attrValue)
    {
        $this->_attributes[$attrName] = $attrValue;
        return $this;
    }

    /**
     * Set attributes of HTML element
     *
     * @param array $attributes Array of attributes
     * @return $this
     */
    public function setAttributes (array $attributes)
    {
        foreach ($attributes as $attrName => $attrValue) {
            $this->setAttribute($attrName, $attrValue);
        }

        return $this;
    }

    /**
     * Remove attribute of HTML element
     *
     * @param string $attrName Attribute name
     * @return $this
     */
    public function removeAttribute ($attrName)
    {
        unset($this->_attributes[$attrName]);
        return $this;
    }

    /**
     * Add class to HTML element
     *
     * @param string $className Class name
     * @return $this
     */
    public function addClass ($className)
    {
        $class = $this->getAttribute('class');
        if ($class === FALSE) {
            $classArr = [];
        } else {
            $classArr = explode(' ', $class);
        }

        if ( ! in_array($className, $classArr)) {
            $classArr[] = $className;
            $this->setAttribute('class', implode(' ', $classArr));
        }

        return $this;
    }

    /**
     * Remove class from HTML element
     *
     * @param string $className Class name
     * @return $this
     */
    public function removeClass ($className)
    {
        $class = $this->getAttribute('class');
        if ($class !== FALSE) {

            $classArr = explode(' ', $class);

            $classIndex = array_search($className, $classArr);
            if ($classIndex !== FALSE) {
                unset($classArr[$classIndex]);

                if (count($classArr) == 0) {
                    $this->removeAttribute('class');
                } else {
                    $this->setAttribute('class', implode(' ', $classArr));
                }
            }
        }

        return $this;
    }

    /**
     * Set CSS property of HTML element
     *
     * @param string $propName CSS property name
     * @param mixed $propValue CSS property value
     * @return $this
     */
    public function addStyle ($propName, $propValue)
    {
        $style = $this->getAttribute('style');
        if ($style === FALSE) {
            $styleArr = [];
        } else {
            $style = explode(';', $style);

            $styleArr = [];
            foreach ($style as $prop) {
                list($_propName, $_propValue) = explode(':', $prop);
                $styleArr[$_propName] = $_propValue;
            }
        }

        $styleArr[$propName] = $propValue;

        $style = trim(implode(';', array_map(function ($_propName, $_propValue) {
            return $_propName . ':' . $_propValue;
        }, array_keys($styleArr), $styleArr)));

        $this->setAttribute('style', $style);

        return $this;
    }

    /**
     * Remove CSS property of HTML element
     *
     * @param string $propName CSS property name
     * @return $this
     */
    public function removeStyle ($propName)
    {
        $style = $this->getAttribute('style');
        if ($style !== FALSE) {

            $style = explode(';', $style);

            $styleArr = [];
            foreach ($style as $prop) {
                list($_propName, $_propValue) = explode(':', $prop);
                $styleArr[$_propName] = $_propValue;
            }

            if (isset($styleArr[$propName])) {
                unset($styleArr[$propName]);

                if (count($styleArr) == 0) {
                    $this->removeAttribute('style');
                } else {
                    $style = trim(implode(';', array_map(function ($_propName, $_propValue) {
                        return $_propName . ':' . $_propValue;
                    }, array_keys($styleArr), $styleArr)));

                    $this->setAttribute('style', $style);
                }
            }
        }

        return $this;
    }

    /**
     * Get child of HTML element by specified index
     *
     * @param int $childIndex Index of child element
     * @return mixed
     * @throws ChildException
     */
    public function getChild ($childIndex)
    {
        if (isset($this->_children[$childIndex])) {
            return $this->_children[$childIndex];
        } else {
            throw new ChildException('Trying to access unexisting child');
        }
    }

    /**
     * Get children of HTML element
     *
     * @return array
     */
    public function getChildren()
    {
        return $this->_children;
    }

    /**
     * Get children count of HTML element
     *
     * @return array
     */
    public function getChildrenCount()
    {
        return count($this->_children);
    }

    /**
     * Add child to HTML element
     * Child element should be an instance of Element, string or numeric
     *
     * @param mixed $child         Child element
     * @param int|bool $childIndex Index of child element. If FALSE, child will be appended to the end
     * @return $this
     * @throws ChildException
     */
    public function addChild ($child, $childIndex = FALSE)
    {
        if ($child instanceof Element || is_string($child) || is_numeric($child)) {

            if ($childIndex === FALSE || $childIndex < 0 || $childIndex >= count($this->_children)) {
                $this->_children[] = $child;
            } else {
                $this->_children = array_merge(
                    array_slice($this->_children, 0, $childIndex),
                    [$child],
                    array_slice($this->_children, $childIndex)
                );
            }
        } else {
            throw new ChildException('Invalid child data type');
        }

        return $this;
    }

    /**
     * Add children to HTML element
     * Children elements should be instances of Element, string or numeric
     *
     * @param array $children Array of child elements
     * @return $this
     * @throws ChildException
     */
    public function addChildren(array $children)
    {
        foreach ($children as $child) {
            $this->addChild($child);
        }

        return $this;
    }

    /**
     * Remove child of HTML element by specified index
     *
     * @param $childIndex Index of child element
     * @return $this
     */
    public function removeChild ($childIndex)
    {
        if (isset($this->_children[$childIndex])) {
            unset($this->_children[$childIndex]);
            $this->_children = array_values($this->_children);
        }

        return $this;
    }

    /**
     * Render HTML element and all its children
     *
     * @return string
     */
    public function render ()
    {
        $renderedElement = '';

        // Open tag

        $renderedElement .= '<' . $this->_name;

        foreach ($this->_attributes as $attrName => $attrValue) {
            $renderedElement .= ' ' . $attrName;
            if ($attrValue !== TRUE) {
                $renderedElement .=  '="' . htmlspecialchars($attrValue) . '"';
            }
        }

        $renderedElement .= '>';

        // Tag's children, if exist

        foreach ($this->_children as $child) {
            if ($child instanceof Element) {
                $renderedElement .= $child->render();
            } else {
                $renderedElement .= htmlspecialchars($child);
            }
        }

        // Close tag, if the element is not self closing

        if (!$this->_isSelfClose) {
            $renderedElement .= '</' . $this->_name . '>';
        }

        return $renderedElement;
    }
}