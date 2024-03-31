<?php

namespace Unit;

use Auction\AuctionFactory;
use Auction\AuctionInterface;
use Buyer\Buyer;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class AuctionTest extends TestCase
{
    #[DataProvider('auctionDataProvider')]
    public function testAuction(array $bids, ?int $expectedWinningAmount): void
    {
        $auctionFactory = new AuctionFactory();
        $auction = $auctionFactory->createAuction(100);

        $this->simulateBidding($auction, $bids);
        $winningBid = $auction->finishAuction();

        $this->assertEquals($expectedWinningAmount, $winningBid?->getAmount(), 'Expected winning amount equals to actual winning bid amount');
    }

    public static function auctionDataProvider(): array
    {
        return [
            'Default behavior' => [
                [
                    ['buyerId' => 1, 'amount' => 110],
                    ['buyerId' => 1, 'amount' => 130],
                    ['buyerId' => 3, 'amount' => 123],
                    ['buyerId' => 4, 'amount' => 105],
                    ['buyerId' => 4, 'amount' => 115],
                    ['buyerId' => 4, 'amount' => 90],
                    ['buyerId' => 5, 'amount' => 132],
                    ['buyerId' => 5, 'amount' => 135],
                    ['buyerId' => 5, 'amount' => 140],
                ],
                130
            ],
            'No winning bid behavior' => [
                [
                    ['buyerId' => 1, 'amount' => 98],
                    ['buyerId' => 1, 'amount' => 99],
                    ['buyerId' => 3, 'amount' => 123],
                ],
                null
            ],
        ];
    }

    private function simulateBidding(AuctionInterface $auction, array $bids): void
    {
        $buyers = [];
        foreach ($bids as $bidData) {
            $buyerId = $bidData['buyerId'];
            if (!isset($buyers[$buyerId])) {
                $buyers[$buyerId] = new Buyer($buyerId);
            }
            $auction->makeBid($buyers[$buyerId], $bidData['amount']);
        }
        $auction->finishAuction();
    }
}
