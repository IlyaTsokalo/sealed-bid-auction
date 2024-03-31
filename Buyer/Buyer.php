<?php

namespace Buyer;

class Buyer implements BuyerInterface
{
    public function __construct(protected int $id)
    {
    }

    public function getId(): int
    {
        return $this->id;
    }
}
