<table>
    <tr>
        <th>No</th>
        <th>Invoice Number</th>
        <th>Date</th>
        <th>Bill to</th>
        <th>Amount</th>
        <th>PO Number</th>
        <th>DO Number</th>
    </tr>
    @foreach ($invoice as $invoice)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $invoice->id_invoice }}</td>
            <td>{{ $invoice->deliveryOrder->tanggal }}</td>
            <td>{{ $invoice->deliveryOrder->salesOrder->customer->nama }}</td>
            <td>{{ number_format($invoice->deliveryOrder->salesOrder->gtotal, 2, ',', '.') }}
            <td>{{ $invoice->deliveryOrder->salesOrder->po }}</td>
            <td>{{ $invoice->deliveryOrder->id_deliveryOrder }}</td>
        </tr>
    @endforeach
</table>
