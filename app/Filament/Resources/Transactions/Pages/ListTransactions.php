<?php

namespace App\Filament\Resources\Transactions\Pages;

use App\Filament\Resources\Transactions\TransactionResource;
use App\Services\Admin\TransactionExporter;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Icons\Heroicon;

class ListTransactions extends ListRecords
{
    protected static string $resource = TransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('exportExcel')
                ->label('Export Excel')
                ->icon(Heroicon::OutlinedTableCells)
                ->color('gray')
                ->action(fn () => app(TransactionExporter::class)->xlsx($this->getFilteredSortedTableQuery())),
            Action::make('exportPdf')
                ->label('Export PDF')
                ->icon(Heroicon::OutlinedDocumentText)
                ->color('gray')
                ->action(fn () => app(TransactionExporter::class)->pdf($this->getFilteredSortedTableQuery())),
        ];
    }
}
