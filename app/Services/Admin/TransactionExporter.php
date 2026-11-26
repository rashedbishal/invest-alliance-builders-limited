<?php

namespace App\Services\Admin;

use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Builder;
use OpenSpout\Common\Entity\Row;
use OpenSpout\Common\Entity\Style\Style;
use OpenSpout\Writer\XLSX\Writer;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * CMS exports of the Transactions table, honouring whatever search/filters/sort
 * the admin currently has applied.
 */
class TransactionExporter
{
    private const HEADINGS = [
        'Date', 'Transaction ID', 'Name', 'Phone', 'Email', 'Address', 'Gateway', 'Status',
        'Amount (BDT)', 'Charged (PayPal)', 'Shares', 'Invoice', 'Money receipt',
    ];

    public function xlsx(Builder $query): BinaryFileResponse
    {
        $path = tempnam(sys_get_temp_dir(), 'tx').'.xlsx';

        $writer = new Writer;
        $writer->openToFile($path);
        $writer->addRow(Row::fromValues(self::HEADINGS, (new Style)->setFontBold()));

        $this->each($query, function (Transaction $tx) use ($writer) {
            $writer->addRow(Row::fromValues($this->row($tx)));
        });

        $writer->close();

        return response()->download($path, $this->fileName('xlsx'))->deleteFileAfterSend();
    }

    public function pdf(Builder $query): StreamedResponse
    {
        $rows = [];
        $total = 0.0;

        $this->each($query, function (Transaction $tx) use (&$rows, &$total) {
            $rows[] = $this->row($tx);

            if ($tx->isPaid()) {
                $total += (float) $tx->amount;
            }
        });

        $pdf = Pdf::loadView('admin.exports.transactions', [
            'headings' => self::HEADINGS,
            'rows' => $rows,
            'paidTotal' => $total,
            'generatedAt' => now(),
        ])->setPaper('A4', 'landscape');

        return response()->streamDownload(fn () => print ($pdf->output()), $this->fileName('pdf'), [
            'Content-Type' => 'application/pdf',
        ]);
    }

    private function each(Builder $query, callable $callback): void
    {
        // get() (not lazyById) so the admin's chosen sort order is kept.
        (clone $query)->with(['shares', 'invoice'])->get()->each($callback);
    }

    private function row(Transaction $tx): array
    {
        return [
            $tx->created_at?->format('Y-m-d H:i'),
            $tx->transaction_id,
            $tx->name,
            $tx->phone,
            $tx->email,
            $tx->address,
            $tx->gatewayName(),
            $tx->status,
            (float) $tx->amount,
            $tx->gatewayName() === Transaction::GATEWAY_PAYPAL && $tx->currency_amount !== null
                ? number_format((float) $tx->currency_amount, 2).' '.$tx->currency_type
                : null,
            $tx->shares->map(fn ($s) => "{$s->hotel_name} × {$s->quantity}")->implode(', '),
            $tx->invoice_number,
            $tx->invoice?->money_receipt_number,
        ];
    }

    private function fileName(string $extension): string
    {
        return 'transactions-'.now()->format('Y-m-d-His').'.'.$extension;
    }
}
