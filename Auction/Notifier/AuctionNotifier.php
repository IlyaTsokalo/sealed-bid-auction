<?php

namespace Auction\Notifier;

use Auction\AuctionConstantsEnum;
use Bid\BidInterface;

class AuctionNotifier implements AuctionNotifierInterface
{
    public function startAuction(): void
    {
        echo AuctionConstantsEnum::AUCTION_STARTED;
    }

    public function announceWinningBid(BidInterface $bid): void
    {
        echo sprintf(AuctionConstantsEnum::WINNING_BID_ANNOUNCEMENT,
                $bid->getId(),
                $bid->getAmount(),
                $bid->getBuyer()->getId()) . PHP_EOL;
    }
}
