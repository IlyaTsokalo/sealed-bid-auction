<?php

namespace Auction\Calculator;

use Bid\BidInterface;

interface AuctionCalculatorInterface
{
    public function calculateWinningBid(int $reservePrice, array $bids): ?BidInterface;
}
