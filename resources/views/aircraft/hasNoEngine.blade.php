<div class="row">
  <label class="form-group col-sm-2">Engine {{ $name }}</label>
  <div class="form-group col-sm-10 btn-group">
    <form class="form-inline" method="POST" action="{{ route('engine.installAircraft') }}">
      {{ csrf_field() }}
      <div class="input-group input-group-sm">

        <input type="text" class="form-control" 
        style="text-transform:uppercase"
        id="serial_number"
        name="serial_number"
        placeholder="{{ $engineType->type }}"
        required>
        <span class="input-group-btn">
          <button type="submit" class="btn btn-primary" name="action" value="install" onclick="buildinput(this.form)">Install</button>
          <button type="submit" class="btn btn-info" name="action" value="create" onclick="buildinput(this.form)">Create &amp; install</button>
        </span>
      </div>
      <input type="hidden" id="engine_type_id" name="engine_type_id" value="{{ $engineType->id }}">
      <input type="hidden" id="engine_type_name" name="engine_type_name" value="{{ $engineType->type }}">
      <input type="hidden" id="identification" name="identification">
      <input type="hidden" id="aircraft_id" name="aircraft_id" value="{{ $aircraft->id }}">
      <input type="hidden" id="aircraft_position" name="aircraft_position" value="{{ $position }}">
    </form>
  </div>
</div>
