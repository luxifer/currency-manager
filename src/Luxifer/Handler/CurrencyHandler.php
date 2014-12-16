<?php
namespace Luxifer\Handler;

use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\GraphNavigator;
use JMS\Serializer\VisitorInterface;
use JMS\Serializer\JsonDeserializationVisitor;
use JMS\Serializer\Context;
use Luxifer\Manager\CurrencyManager;
use Luxifer\Model\Currency;

/**
 * @author Florent Viel <luxifer666@gmail.com>
 */
class CurrencyHandler implements SubscribingHandlerInterface
{
    protected $currencyManager;
    protected $defaultField;

    public static function getSubscribingMethods()
    {
        return [
            [
                'format'    => 'json',
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'type'      => 'Currency',
                'method'    => 'deserializeCurrencyFromJson',
            ],
            [
                'format'    => 'json',
                'direction' => GraphNavigator::DIRECTION_SERIALIZATION,
                'type'      => 'Currency',
                'method'    => 'serializeCurrencyToJson',
            ],
        ];
    }

    public function __construct(CurrencyManager $currencyManager, $defaultField = 'code')
    {
        $this->currencyManager = $currencyManager;
        $this->defaultField = $defaultField;
    }

    public function deserializeCurrencyFromJson(JsonDeserializationVisitor $visitor, $data, array $type)
    {
        if (null === $data) {
            return null;
        }

        $field = $this->getField($type);

        return $this->currencyManager->getCurrencyBy($field, (string) $data);
    }

    public function serializeCurrencyToJson(VisitorInterface $visitor, Currency $currency, array $type, Context $context)
    {
        return $visitor->visitString($date->format($this->getField($type)), $type, $context);
    }

    private function getField($type)
    {
        return isset($type['params'][0]) ? $type['params'][0] : $this->defaultField;
    }
}
