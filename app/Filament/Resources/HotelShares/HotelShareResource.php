<?php

namespace App\Filament\Resources\HotelShares;

use App\Filament\Resources\HotelShares\Pages\ListHotelShares;
use App\Models\HotelShare;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Price per share and max shares per booking for each hotel (replaces the old
 * HOTEL_JANA_* .env keys). The hotels themselves are fixed in config/shares.php.
 */
class HotelShareResource extends Resource
{
    protected static ?string $model = HotelShare::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingOffice2;

    protected static ?string $navigationLabel = 'Hotel prices';

    protected static ?string $modelLabel = 'hotel price';

    protected static ?int $navigationSort = 4;

    /** Only hotels that exist in config/shares.php. */
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->whereIn('key', array_keys((array) config('shares.hotels')));
    }

    public static function getNavigationBadge(): ?string
    {
        $notBookable = static::getEloquentQuery()->get()->reject->isBookable()->count();

        return $notBookable > 0 ? (string) $notBookable : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'danger';
    }

    public static function getNavigationBadgeTooltip(): ?string
    {
        return 'Hotels customers cannot book right now';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->columns(1)->components([
            TextInput::make('price')
                ->label('Price per share (BDT)')
                ->required()
                ->numeric()
                ->minValue(1)
                ->maxValue(9_999_999_999)
                ->prefix('BDT'),
            TextInput::make('max_per_booking')
                ->label('Max shares per booking')
                ->required()
                ->integer()
                ->minValue(1)
                ->maxValue(4_000_000_000),
            Toggle::make('is_active')
                ->label('On sale')
                ->helperText('Off hides this hotel from the booking form.'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->paginated(false)
            ->defaultSort('id')
            ->columns([
                TextColumn::make('name')->label('Hotel')->state(fn (HotelShare $record) => $record->name()),
                TextColumn::make('price')->label('Price per share')->money('BDT', locale: 'en')->placeholder('Not set'),
                TextColumn::make('max_per_booking')->label('Max per booking')->numeric()->placeholder('Not set'),
                IconColumn::make('is_active')->label('On sale')->boolean(),
                TextColumn::make('bookable')
                    ->label('Customers can book')
                    ->state(fn (HotelShare $record) => $record->isBookable() ? 'Yes' : ($record->is_active ? 'No: set price and max' : 'No: switched off'))
                    ->badge()
                    ->color(fn (HotelShare $record) => $record->isBookable() ? 'success' : 'danger'),
                TextColumn::make('updated_at')->label('Last changed')->dateTime('d M Y, h:i A'),
            ])
            ->recordActions([
                EditAction::make()
                    ->modalHeading(fn (HotelShare $record) => 'Edit '.$record->name())
                    ->modalDescription('New prices apply to bookings started after you save. Payments already started, and bank transfers already booked, keep the price they were booked at.'),
                Action::make('history')
                    ->label('History')
                    ->icon(Heroicon::OutlinedClock)
                    ->color('gray')
                    ->modalHeading(fn (HotelShare $record) => $record->name().': change history')
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Close')
                    ->schema([
                        RepeatableEntry::make('history')
                            ->hiddenLabel()
                            ->placeholder('No changes yet.')
                            ->schema([
                                TextEntry::make('created_at')->label('When')->dateTime('d M Y, h:i A'),
                                TextEntry::make('changed_by')->label('By'),
                                TextEntry::make('diff')
                                    ->label('Changed')
                                    ->listWithLineBreaks()
                                    ->state(fn ($record) => self::describeChanges($record->diff)),
                            ])
                            ->columns(3),
                    ]),
            ]);
    }

    /** @return list<string> */
    public static function describeChanges(array $changes): array
    {
        $labels = ['price' => 'Price', 'max_per_booking' => 'Max per booking', 'is_active' => 'On sale'];

        return collect($changes)->map(function (array $change, string $field) use ($labels) {
            $format = fn ($value) => match (true) {
                $value === null => 'not set',
                $field === 'is_active' => $value ? 'yes' : 'no',
                $field === 'price' => 'BDT '.number_format((float) $value, 2),
                default => number_format((float) $value),
            };

            return ($labels[$field] ?? $field).': '.$format($change['old']).' → '.$format($change['new']);
        })->values()->all();
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => ListHotelShares::route('/'),
        ];
    }
}
