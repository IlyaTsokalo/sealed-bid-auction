<?php

namespace Bid;


use Buyer\BuyerInterface;

class Bid implements BidInterface
{
    protected int $id;

    public function __construct(protected BuyerInterface $buyer, protected int $amount)
    {
        $this->setId();
    }

    /**
     * Method is simplified on purpose
     *
     * @return void
     */
    public function setId(): void
    {
        $this->id = random_int(10000, 20000);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getBuyer(): BuyerInterface
    {
        return $this->buyer;
    }
}
