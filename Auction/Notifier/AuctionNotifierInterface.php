<?php

namespace Auction\Notifier;

use Bid\BidInterface;

interface AuctionNotifierInterface
{
    public function startAuction(): void;

    public function announceWinningBid(BidInterface $bid): void;
}
