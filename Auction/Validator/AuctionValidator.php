<?php

namespace Auction\Validator;

use Bid\BidInterface;

class AuctionValidator implements AuctionValidatorInterface
{
    public function isBidValid(BidInterface $bid, int $reservePrice): bool
    {
        return $bid->getAmount() >= $reservePrice;
    }
}
