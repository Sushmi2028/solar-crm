<h3>Inventory Report</h3>

<table border="1" width="100%" cellpadding="5">
    <tr>
        <th>Name</th>
        <th>Category</th>
        <th>Stock</th>
        <th>Min</th>
    </tr>

    @foreach($products as $p)
    <tr>
        <td>{{ $p->name }}</td>
        <td>{{ $p->category }}</td>
        <td>{{ $p->stock }}</td>
        <td>{{ $p->min_stock }}</td>
    </tr>
    @endforeach
</table>