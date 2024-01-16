<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Adj Number</th>
            <th>Part</th>
            <th>Part Desc</th>
            <th>UOM</th>
            <th>Qty</th>
            <th>LOT</th>
            <th>Exp Date</th>
            <th>Warehouse</th>
            <th>Bin</th>
            <th>Type</th>
            <th>User</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($adjStock as $i)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $i->id_adjStock }}</td>
                <td>{{ $i->inventory->part->kd_parts }}</td>
                <td>{{ $i->inventory->part->nama }}</td>
                <td>{{ $i->inventory->part->uom->nama }}</td>
                <td>{{ $i->qty }}</td>
                <td>{{ $i->inventory->lot->kd_lots }}</td>
                <td>{{ $i->inventory->lot->exp }}</td>
                <td>{{ $i->inventory->warehouse->nama }}</td>
                <td>{{ $i->inventory->bin->customer->nama }}</td>
                <td>{{ $i->status }}</td>
                <td>{{ $i->user->username }}</td>
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
