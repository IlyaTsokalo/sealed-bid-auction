<?php

namespace Auction;

use Bid\BidInterface;
use Buyer\BuyerInterface;

interface AuctionInterface
{
    public function finishAuction(): ?BidInterface;

    public function makeBid(BuyerInterface $buyer, int $amount): void;
}
