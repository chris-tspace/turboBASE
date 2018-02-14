<td><span style="vertical-align: middle;">{{ $name }}</span></td>
<td>NONE</td>
<td>
  @if ($actualEngineRemovalPost->date != null)
  removed {{ \Carbon\Carbon::parse($actualEngineRemovalPost->date)->format('d-M-Y') }}
  @endif
</td>
<td>
  <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#installEngine{{ $name }}">Install</button>
  <div>
    <div class="modal fade" id="installEngine{{ $name }}" tabindex="-1" role="dialog" aria-labelledby="installEngine{{ $name }}" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">
              <span aria-hidden="true">&times;</span>
              <span class="sr-only">Close</span>
            </button>
            <h4 class="modal-title">Install removal</h4>
          </div>
          <form  class="form-horizontal" role="form" method="POST" action="{{ route('engine.installAircraft') }}">
            {{ csrf_field() }}
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
                  placeholder="{{ $engineType->type }}"
                  required>
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
                <label for="date" class="col-sm-3 control-label">Installation date</label>
                <div class="col-sm-9">
                  <input type="text"
                  id="date"
                  name="date"
                  class="form-control"
                  value="{{ now()->toDateString() }}"
                  autofocus>
                </div>
              </div>
              <div class="form-group">
                <input type="hidden" id="engine_type_id" name="engine_type_id" value="{{ $engineType->id }}">
                <input type="hidden" id="engine_type_name" name="engine_type_name" value="{{ $engineType->type }}">
                <input type="hidden" id="identification" name="identification">
                <input type="hidden" id="aircraft_id" name="aircraft_id" value="{{ $aircraft->id }}">
                <input type="hidden" id="aircraft_position" name="aircraft_position" value="{{ $position }}">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" name="action" value="install" onclick="buildinput(this.form)">Install</button>
              <button type="submit" class="btn btn-info" name="action" value="create" onclick="buildinput(this.form)">Create &amp; install</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</td>