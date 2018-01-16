<table class="table" id="table_aircraft">
    <thead>
      <tr>
        <th class="text-center">Type</th>
        <th class="text-center">Type</th>
        <th class="text-center">Serial Number</th>
        <th class="text-center">Manufacturer code</th>
      </tr>
    </thead>
    <tbody>
      @foreach($aircrafts as $item)
      <tr class="item{{$item->id}}">
        <td>{{ $item->aircraftType->type }}</td>
        <td><a href="{{ route('aircraft.show', ['id' => $item->id]) }}">{{ $item->aircraftType->type }}</a></td>
        <td>{{ $item->serial_number }}</td>
        <td>{{ $item->manufacturer_code }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
