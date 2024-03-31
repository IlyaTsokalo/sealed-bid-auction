<?php

namespace Bid;

use Buyer\BuyerInterface;

interface BidInterface
{
    public function setId(): void;

    public function getId(): int;

    public function getAmount(): int;

    public function getBuyer(): BuyerInterface;
}
