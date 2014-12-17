<?php
namespace Luxifer\Manager;

use JMS\Serializer\SerializerInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

/**
 * @author Florent Viel <luxifer666@gmail.com>
 */
class CurrencyManager
{
    protected $serializer;
    protected $currencies;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
        $data = file_get_contents(__DIR__.'/../../../data/currencies.json');
        $decoded = $this->serializer->deserialize($data, 'array<string, Luxifer\Model\Currency>', 'json');
        $this->currencies = new ArrayCollection($decoded);
    }

    public function getCurrencyBy($field, $value)
    {
        $criteria = Criteria::create();
        $criteria->where(Criteria::expr()->eq($field, $value));

        $filtered = $this->currencies->matching($criteria);

        if ($filtered->count()) {
            return $filtered->first();
        }

        return false;
    }
}
