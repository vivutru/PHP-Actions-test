<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class HelpersTest extends TestCase
{
    public function testMoneyIsFormattedInJamaicanDollars(): void
    {
        $this->assertSame('J$14,500', jmd(14500));
    }

    public function testKnownTourIsFound(): void
    {
        $tour = find_tour('farm-to-cup');

        $this->assertNotNull($tour);
        $this->assertSame('Farm to Cup Tasting', $tour['name']);
    }

    public function testUnknownTourReturnsNull(): void
    {
        $this->assertNull(find_tour('does-not-exist'));
    }

    public function testBookingTotalMultipliesPriceByGuests(): void
    {
        $tour = find_tour('sunrise-summit');

        $this->assertSame(43500, booking_total($tour, 3));
    }

    public function testEveryTourHasAPositivePrice(): void
    {
        foreach (tours() as $tour) {
            $this->assertGreaterThan(0, $tour['price'], $tour['name'] . ' needs a price');
        }
    }
}
