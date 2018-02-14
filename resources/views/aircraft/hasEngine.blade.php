<td><span style="vertical-align: middle;">{{ $name }}</span></td>
<td><a role="button" class="btn btn-primary btn-xs" href="{{ route('engine.show', ['id' => $actualEngine->id]) }}">{{ $actualEngine->engineType->type }} - {{ $actualEngine->serial_number }}</a></td>
<td>
  @if ($actualEngine->date != null)
  installed {{ \Carbon\Carbon::parse($actualEngine->date)->format('d-M-Y') }}
  @endif
</td>
<td>
  <button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#removeEngine{{ $name }}">Remove</button>
  <div>
    <div class="modal fade" id="removeEngine{{ $name }}" tabindex="-1" role="dialog" aria-labelledby="removeEngine{{ $name }}" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">
              <span aria-hidden="true">&times;</span>
              <span class="sr-only">Close</span>
            </button>
            <h4 class="modal-title">Engine removal</h4>
          </div>
          <form  class="form-horizontal" role="form" method="POST" action="{{ route('engine.removeAircraft', ['id' => $actualEngine->id]) }}">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <div class="modal-body">
              <div class="form-group">
                <label for="aircraft" class="col-sm-3 control-label">Aircraft</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" 
                  id="aircraft"
                  name="aircraft"
                  value="{{ $aircraft->name() }}"
                  readonly>
                </div>
              </div>
              <div class="form-group">
                <label for="serial_number" class="col-sm-3 control-label">Engine</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" 
                  style="text-transform:uppercase"
                  id="serial_number"
                  name="serial_number"
                  value="{{ $actualEngine->engineType->type }} - {{ $actualEngine->serial_number }}"
                  readonly>
                </div>
              </div>
              <div class="form-group">
                <label for="position" class="col-sm-3 control-label">Position</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" 
                  id="position"
                  name="position"
                  value="{{ $name }}"
                  readonly>
                </div>
              </div>
              <div class="form-group">
                <label for="date" class="col-sm-3 control-label">Removal date</label>
                <div class="col-sm-9">
                  <input type="text"
                  id="date"
                  name="date"
                  class="form-control"
                  value="{{ now()->toDateString() }}"
                  autofocus>
                </div>
              </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Remove engine</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</td>