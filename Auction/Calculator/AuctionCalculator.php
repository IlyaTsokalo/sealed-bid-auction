<?php

namespace Auction\Calculator;

use Auction\Validator\AuctionValidatorInterface;
use Bid\Bid;
use Bid\BidInterface;

class AuctionCalculator implements AuctionCalculatorInterface
{
    public function __construct(protected AuctionValidatorInterface $auctionValidator)
    {

    }

    /**
     * @param int $reservePrice
     * @param BidInterface[] $bids
     *
     * @return \Bid\BidInterface|null
     */
    public function calculateWinningBid(int $reservePrice, array $bids): ?BidInterface
    {
        $highestBid = null;
        $highestAlternativeBid = null;

        foreach ($bids as $bid) {
            if (!$this->auctionValidator->isBidValid($bid, $reservePrice)) {
                continue;
            }

            if ($highestBid === null || $bid->getAmount() > $highestBid->getAmount()) {
                if ($highestBid && $this->isDifferentBuyer($highestBid, $bid)) {
                    $highestAlternativeBid = $highestBid;
                }
                $highestBid = $bid;
                continue;
            }

            if ($this->canBeAlternativeBid($highestAlternativeBid, $highestBid, $bid)) {
                $highestAlternativeBid = $bid;
            }
        }

        if ($highestBid === null || $highestAlternativeBid?->getAmount() === null) {
            return null;
        }

        return new Bid($highestBid->getBuyer(), $highestAlternativeBid->getAmount());
    }

    private function canBeAlternativeBid(?BidInterface $highestAlternativeBid, BidInterface $highestBid, BidInterface $currentBid): bool
    {
        $isDifferentBuyer = $this->isDifferentBuyer($highestBid, $currentBid);
        $isHigherAmount = is_null($highestAlternativeBid) || $currentBid->getAmount() > $highestAlternativeBid->getAmount();

        return $isDifferentBuyer && $isHigherAmount;
    }

    private function isDifferentBuyer(BidInterface $highestBid, BidInterface $currentBid): bool
    {
        return $highestBid->getBuyer()->getId() !== $currentBid->getBuyer()->getId();
    }
}
