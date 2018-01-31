    <table class="table" id="table_aircraft">
      <thead>
        <tr>
          <th class="text-left">Type</th>
          <th class="text-left">Serial Number</th>
          <th class="text-left">Manufacturer code</th>
        </tr>
      </thead>
      <tbody>
        @foreach($aircrafts as $item)
        <tr class="item{{$item->id}}">
          <td>{{ $item->aircraftType->name() }}</td>
          <td><a href="{{ route('aircraft.show', ['id' => $item->id]) }}">{{ $item->serial_number }}</a></td>
          <td>{{ $item->manufacturer_code }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
