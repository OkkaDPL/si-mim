<table>
    <thead>
        <tr>
            <th>SO Number</th>
            <th>Date</th>
            <th>Customers</th>
            <th>Amount</th>
            <th>Sales Person</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($salesOrders as $salesOrder)
            <tr>
                <td>{{ $salesOrder->id_salesOrder }}</td>
                <td>{{ $salesOrder->tanggal }}</td>
                <td>{{ $salesOrder->customer->nama }}</td>
                <td>{{ number_format($salesOrder->gtotal, 2, '.', ',') }}
                <td>{{ $salesOrder->employee->nama }}</td>
                <td>{{ $salesOrder->status }}</td>
            </tr>
        @endforeach
        <tr>
            <td>Dicetak oleh:</td>
            <td>
                {{ auth()->user()->username }}
            </td>
        </tr>
    </tbody>
</table>
