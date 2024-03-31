<?php

namespace Auction;

use Auction\Calculator\AuctionCalculator;
use Auction\Notifier\AuctionNotifier;
use Auction\Validator\AuctionValidator;
use Auction\Validator\AuctionValidatorInterface;

class AuctionFactory
{
    public function createAuction(int $reservePrice): AuctionInterface
    {
        $auctionValidator = $this->createAuctionValidator();

        return new Auction(
            $reservePrice,
            (new AuctionNotifier()),
            $auctionValidator,
            (new AuctionCalculator($auctionValidator))
        );
    }

    private function createAuctionValidator(): AuctionValidatorInterface
    {
        return new AuctionValidator();
    }
}
