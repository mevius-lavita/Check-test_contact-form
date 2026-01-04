<table>
    <thead>
        <tr>
            @foreach ($headings as $heading)
                <th>{{ $heading }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $contact)
            <tr>
                <td>{{ $contact->first_name }} {{ $contact->last_name }}</td>
                <td>
                    @if ($contact->gender == 1) 男性
                    @elseif ($contact->gender == 2) 女性
                    @else その他
                    @endif
                </td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->tel }}</td>
                <td>{{ $contact->address }}</td>
                <td>{{ $contact->building }}</td>
                <td>{{ $contact->category->content }}</td>
                <td>{{ $contact->detail }}</td>
            </tr>
        @endforeach
    </tbody>
</table>