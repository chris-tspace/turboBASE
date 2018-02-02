<table class="table" id="table_engine">
  <thead>
    <tr>
      <th class="text-left">Type</th>
      <th class="text-left">SN</th>
      <th class="text-left">Aircraft</th>
      <th class="text-left">Position</th>
    </tr>
  </thead>
  <tbody>
    @foreach($engines as $item)
    <tr class="item{{$item->id}}">
      <td>{{ $item->engineType->type }}</td>
      <td><a href="{{ route('engine.show', ['id' => $item->id]) }}">{{ $item->serial_number }}</a></td>
      @if ($item->aircraft)
      <td><a href="{{ route('aircraft.show', ['id' => $item->aircraft->id]) }}">{{ $item->aircraft->manufacturer_code }} - {{ $item->aircraft->aircraftType->type }} ({{ $item->aircraft->serial_number }})</a></td>
      <td>{{ $item->positionName() }}</td>
      @else
      <td></td>
      <td></td>
      @endif
    </tr>
    @endforeach
  </tbody>
</table>
