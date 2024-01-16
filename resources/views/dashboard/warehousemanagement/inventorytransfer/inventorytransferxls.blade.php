<table>
    <thead>
        <tr>
            <th>ID Inventory Transfer</th>
            <th>From</th>
            <th>To</th>
            <th>Shipdate</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($inventorytransfer as $inventorytransfer)
            <tr>
                <td>{{ $inventorytransfer->id_inventoryTransfer }}</td>
                <td>{{ $inventorytransfer->fromBin->customer->nama }}</td>
                <td>{{ $inventorytransfer->toBin->customer->nama }}</td>
                <td>{{ $inventorytransfer->shipdate }}</td>
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
