<table>
    <thead>
        <tr>
            <th>Part</th>
            <th>Part Desc</th>
            <th>Division</th>
            <th>Category</th>
            <th>UOM</th>
            <th>Qty</th>
            <th>LOT</th>
            <th>Exp Date</th>
            <th>Warehouse</th>
            <th>Bin</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($inventories as $inventory)
            <tr>
                <td>{{ $inventory->part->kd_parts }}</td>
                <td>{{ $inventory->part->nama }}</td>
                <td>{{ $inventory->part->category->division->nick }}</td>
                <td>{{ $inventory->part->category->nama }}</td>
                <td>{{ $inventory->part->uom->nama }}</td>
                <td>{{ $inventory->qty }}</td>
                <td>{{ $inventory->lot->kd_lots }}</td>
                <td>{{ $inventory->lot->exp }}</td>
                <td>{{ $inventory->warehouse->id_warehouses }}</td>
                <td>{{ $inventory->bin->id_bins }}</td>
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
