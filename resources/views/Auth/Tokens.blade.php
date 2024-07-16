@extends('core')

@section('content')
<table border="1">
    <caption>
        Client List
    </caption>
    <thead>
        <tr>
            <th scope="col">client id</th>
            <th scope="col">client secret</th>
            <th scope="col">token</th>
            <th scope="col">expire</th>
        </tr>
    </thead>
    <tbody>
    @foreach($clientList as $client)
        <tr>
            <td>{{ $client['client_id'] }}</td>
            <td>{{ $client['client_secret'] }}</td>
            <td>{{ $client['token'] }}</td>
            <td>{{ $client['expire'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
