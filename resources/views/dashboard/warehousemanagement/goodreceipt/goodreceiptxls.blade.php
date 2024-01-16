<table>
    <thead>
        <tr>
            <th>GR Number</th>
            <th>Date</th>
            <th>PO Number</th>
            <th>Principals</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($goodreceipts as $goodreceipt)
            <tr>
                <td>{{ $goodreceipt->id_goodreceipt }}</td>
                <td>{{ $goodreceipt->tanggal }}</td>
                <td>{{ $goodreceipt->purchaseOrder->id_purchaseorder }}</td>
                <td>{{ $goodreceipt->purchaseOrder->principal->nama }}
            <tr>
        @endforeach
        <tr>
            <td>Dicetak oleh:</td>
            <td>
                {{ auth()->user()->username }}
            </td>
        </tr>
    </tbody>
</table>
