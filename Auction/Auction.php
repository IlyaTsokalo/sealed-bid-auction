<?php

namespace Auction;


use Auction\Calculator\AuctionCalculatorInterface;
use Auction\Notifier\AuctionNotifierInterface;
use Auction\Validator\AuctionValidatorInterface;
use Bid\Bid;
use Bid\BidInterface;
use Buyer\BuyerInterface;

class Auction implements AuctionInterface
{
    /**
     * @var BidInterface[]
     */
    private array $bids = [];

    public function __construct(
        protected int                        $reservePrice,
        protected AuctionNotifierInterface   $auctionNotifier,
        protected AuctionValidatorInterface  $auctionValidator,
        protected AuctionCalculatorInterface $auctionCalculator
    )
    {
        $this->auctionNotifier->startAuction();
    }

    public function makeBid(BuyerInterface $buyer, int $amount): void
    {
        $this->bids[] = new Bid($buyer, $amount);
    }

    public function finishAuction(): ?BidInterface
    {
        echo AuctionConstantsEnum::AUCTION_FINISHED;

        $winningBid = $this->auctionCalculator->calculateWinningBid($this->reservePrice, $this->bids);

        if (!$winningBid) {
            echo AuctionConstantsEnum::NO_WINNING_BID;
            return null;
        }

        $this->auctionNotifier->AnnounceWinningBid($winningBid);

        return $winningBid;
    }
}
