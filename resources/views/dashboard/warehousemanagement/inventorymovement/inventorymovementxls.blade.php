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
            <th>Transaction</th>
            <th>Doc Number</th>
            <th>Transaction Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($inventorymovement as $imovement)
            <tr>
                <td>{{ $imovement->inventory->part->kd_parts }}</td>
                <td>{{ $imovement->inventory->part->nama }}</td>
                <td>{{ $imovement->inventory->part->category->division->nick }}</td>
                <td>{{ $imovement->inventory->part->category->nama }}</td>
                <td>{{ $imovement->inventory->part->uom->nama }}</td>
                <td>{{ $imovement->qty }}</td>
                <td>{{ $imovement->inventory->lot->kd_lots }}</td>
                <td>{{ $imovement->inventory->lot->exp }}</td>
                <td>{{ $imovement->inventory->warehouse->nama }}</td>
                <td>{{ $imovement->inventory->bin->id_bins }}</td>
                <td>{{ $imovement->from }}</td>
                <td>{{ $imovement->doc }}</td>
                <td>{{ $imovement->created_at->format('d-m-Y') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
