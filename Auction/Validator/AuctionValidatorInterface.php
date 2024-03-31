<?php

namespace Auction\Validator;

use Bid\BidInterface;

interface AuctionValidatorInterface
{
    public function isBidValid(BidInterface $bid, int $reservePrice): bool;
}
