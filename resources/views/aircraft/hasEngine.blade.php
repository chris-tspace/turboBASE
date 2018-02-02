<div class="row">
    <label class="form-group col-sm-2">Engine {{ $name }}</label>
    <div class="form-group col-sm-10 btn-group">
      <form class="form-inline" method="POST" action="{{ route('engine.removeAircraft', ['id' => $actualEngine->id]) }}">
      {{ csrf_field() }}
      {{ method_field('PATCH') }}
      <div class="input-group input-group-sm">
        <input type="text" class="form-control" 
        style="text-transform:uppercase"
        id="serial_number"
        name="serial_number"
        value="{{ $actualEngine->engineType->type }} - {{ $actualEngine->serial_number }}"
        readonly>
        <span class="input-group-btn">
          <a role="button" class="btn btn-primary" href="{{ route('engine.show', ['id' => $actualEngine->id]) }}">View</a>
          <button type="submit" class="btn btn-warning" onclick="return confirm('Are you sure?')">Remove</button>
        </span>
      </div>
    </form>
  </div>
</div>
