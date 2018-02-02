@extends('layouts.master')

@section('content-header')
<h1>
  Engine Types
</h1>
@endsection

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="box box-info">
      <div class="box-body">
          @include('layouts.message')
          <table class="table" cellspacing="0" width="100%" id="table_engineType">
          <thead>
            <tr>
              <th class="text-center">Family</th>
              <th class="text-center">Variant</th>
              <th class="text-center">Type</th>
              <th class="text-center">Engines</th>
            </tr>
          </thead>
          <tbody>
            @foreach($engineTypes as $item)
            <tr class="item{{$item->id}}">
              <td>{{$item->family}}</td>  
              <td>{{$item->variant}}</td>
              <td><a href="{{ route('engineType.show', ['id' => $item->id]) }}">{{$item->type}}</a></td>
              <td>{{ $item->engines->count() }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="box-footer">
        <a href="{{ route('engineType.create') }}">
          <button class="btn btn-primary">
            <span class="glyphicon glyphicon-plus-sign"></span>&nbsp;&nbsp;Create
          </button>
        </a>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script>
  $(document).ready(function() {
    $('#table_engineType').DataTable({
      "columnDefs": [
      { "visible": false, "targets": [0, 1] }
      ],
      "order": [[ 0, 'asc' ], [ 1, 'asc' ]],
      rowGroup: {
        dataSrc: 0,
      }
    } );
  } );
</script>
@endsection