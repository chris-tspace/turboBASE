<table class="table" id="table_engine">
    <thead>
      <tr>
        <th class="text-center">Type</th>
        <th class="text-center">Type</th>
        <th class="text-center">Serial Number</th>
      </tr>
    </thead>
    <tbody>
      @foreach($engines as $item)
      <tr class="item{{$item->id}}">
        <td>{{ $item->engineType->type }}</td>
        <td><a href="{{ route('engine.show', ['id' => $item->id]) }}">{{ $item->engineType->type }}</a></td>
        <td>{{ $item->serial_number }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
