<table>
    <thead>
        <tr>
            <th>DO</th>
            <th>Warehouse</th>
            <th>Bin</th>
            <th>PO</th>
            <th>Ship To</th>
            <th>Ship Date</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($deliveryOrder as $do)
            <tr>
                <td>{{ $do->id_deliveryOrder }}</td>
                <td>{{ $do->salesOrder->warehouse->nama }}</td>
                <td>{{ $do->salesOrder->bin->customer->nama }}</td>
                <td>{{ $do->salesOrder->po }}</td>
                <td>{{ $do->salesOrder->customer->nama }}</td>
                <td>{{ $do->tanggal }}</td>
                <td>{{ $do->status }}</td>
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
