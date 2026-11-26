<?php

namespace App\Filament\Resources\HotelShares\Pages;

use App\Filament\Resources\HotelShares\HotelShareResource;
use Filament\Resources\Pages\ListRecords;

class ListHotelShares extends ListRecords
{
    protected static string $resource = HotelShareResource::class;

    public function getSubheading(): ?string
    {
        return 'Price per share and the most shares one booking may contain. A hotel can only be booked once it has both and is on sale.';
    }
}
