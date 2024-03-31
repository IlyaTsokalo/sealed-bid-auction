<?php

namespace Auction;

enum AuctionConstantsEnum: string
{
    const AUCTION_STARTED = 'Auction Started' . PHP_EOL;
    const WINNING_BID_ANNOUNCEMENT = 'Winning bid id -> %s with amount %s, won by buyer %s';
    const AUCTION_FINISHED = 'Auction Finished' . PHP_EOL;
    const NO_WINNING_BID = "No winning bid according to the reserve price." . PHP_EOL;
}
