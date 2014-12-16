<?php
namespace Luxifer\Model;

use JMS\Serializer\Annotation as Serializer;

/**
 * @Serializer\ExclusionPolicy("none")
 * @author Florent Viel <luxifer666@gmail.com>
 */
class Currency
{
    /**
     * @Serializer\Type("string")
     */
    protected $symbol;

    /**
     * @Serializer\Type("string")
     */
    protected $name;

    /**
     * @Serializer\Type("string")
     */
    protected $symbolNative;

    /**
     * @Serializer\Type("integer")
     */
    protected $decimalDigits;

    /**
     * @Serializer\Type("integer")
     */
    protected $rounding;

    /**
     * @Serializer\Type("string")
     */
    protected $code;

    /**
     * @Serializer\Type("string")
     */
    protected $namePlural;

    public function getSymbol()
    {
        return $this->symbol;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function getSymbolNative()
    {
        return $this->symbolNative;
    }

    public function format($field)
    {
        if (!property_exists($this, $field)) {
            throw new \UnexpectedValueException(sprintf('Field "%s" does not exist.', $field));
        }

        return $this->$field;
    }
}
