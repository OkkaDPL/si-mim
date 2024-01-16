<table>
    <tr>
        <th>No</th>
        <th>Full name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Status</th>
    </tr>
    @foreach ($cp as $cp)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $cp->fname }} {{ $cp->lname }}</td>
            <td>{{ $cp->email }}</td>
            <td>{{ $cp->tlp }}</td>
            <td>{{ $cp->status }}</td>
        </tr>
    @endforeach
    <tr>
        <td>
            <a>Dicetak oleh: {{ auth()->user()->username }}</a>
        </td>
    </tr>
</table>
