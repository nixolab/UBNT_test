<?php

namespace Ubnt\Html;

use Ubnt\Html\Core\SelfCloseElement;

/**
 * Class Link
 */
class Link extends SelfCloseElement
{
    /**
     * @var string HTML element name
     */
    protected $_name = 'link';

    /**
     * Input constructor
     *
     * @param string $href      Link href
     * @param string $rel       Link rel
     * @param array $attributes Link attributes
     */
    public function __construct ($href, $rel = 'stylesheet', array $attributes = [])
    {
        $attributes['href']  = $href;
        $attributes['rel']   = $rel;

        $this->setAttributes($attributes);
    }

    /**
     * Static constructor alias
     *
     * @param string $href      Link href
     * @param string $rel       Link rel
     * @param array $attributes Link attributes
     * @return Link
     */
    public static function create ($href, $rel = 'stylesheet', array $attributes = [])
    {
        return new static($href, $rel, $attributes);
    }
}