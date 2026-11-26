<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Transactions</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 8px; color: #222; }
        h1 { font-size: 13px; margin: 0 0 2px; }
        .meta { color: #666; margin-bottom: 8px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 3px 4px; text-align: left; vertical-align: top; }
        th { background: #f0f0f0; }
        td.num { text-align: right; white-space: nowrap; }
        .total { margin-top: 6px; font-weight: bold; text-align: right; }
    </style>
</head>
<body>
    <h1>Invest Alliance Builders Limited — Transactions</h1>
    <div class="meta">Generated {{ $generatedAt->format('d M Y, h:i A') }} · {{ count($rows) }} {{ \Illuminate\Support\Str::plural('row', count($rows)) }}</div>

    <table>
        <thead>
            <tr>
                @foreach ($headings as $heading)
                    @continue($heading === 'Address')
                    <th>{{ $heading }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @forelse ($rows as $row)
                <tr>
                    @foreach ($row as $i => $value)
                        @continue($headings[$i] === 'Address')
                        @if ($headings[$i] === 'Amount (BDT)')
                            <td class="num">{{ number_format((float) $value, 2) }}</td>
                        @else
                            <td>{{ $value }}</td>
                        @endif
                    @endforeach
                </tr>
            @empty
                <tr><td colspan="{{ count($headings) - 1 }}">No transactions match the current filters.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="total">Paid total: BDT {{ number_format($paidTotal, 2) }}</div>
</body>
</html>
