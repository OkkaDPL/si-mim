<table>
    <thead>
        <tr>
            <th>PO Number</th>
            <th>Date</th>
            <th>Exp Date</th>
            <th>Principals</th>
            <th>Amount</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($purchaseorder as $purchaseorder)
            <tr>
                <td>{{ $purchaseorder->id_purchaseorder }}</td>
                <td>{{ $purchaseorder->tglCreate }}</td>
                <td>{{ $purchaseorder->tglExp }}</td>
                <td>{{ $purchaseorder->principal->nama }}</td>
                <td>{{ number_format($purchaseorder->gtotal, 2, '.', ',') }}
                <td>{{ $purchaseorder->status }}</td>
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
