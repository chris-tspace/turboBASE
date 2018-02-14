<div class="row">
  <div class="col-md-12">
    <ul class="timeline">
      @foreach($posts as $post)
        @php
          $currentDate = \Carbon\Carbon::parse($post->date);
          $currentDate->hour = 0;
          $currentDate->minute = 0;
          $currentDate->second = 0;
        @endphp
        @if ($loop->index == 0)
          @php
            $previousDate = $currentDate;
          @endphp
        @endif
        @if (($loop->index == 0) || ($currentDate->diffInDays($previousDate) != 0))
          @php
            $previousDate = $currentDate;
          @endphp
          <li class="time-label">
            <span class="bg-red">
              {{ $currentDate->format('d-M-Y') }}
            </span>
          </li>
            @endif
            <li>
              @switch($post->type)
                @case('1') {{-- 1:user_comment --}}
                <i class="fa fa-comment bg-aqua"></i>
                @break

                @case('2') {{-- 2:engine_install --}}
                <i class="fa fa-arrow-circle-down bg-blue"></i>
                @break

                @case('3') {{-- 3:engine_remove --}}
                <i class="fa fa-arrow-circle-up bg-yellow"></i>
                @break
              @endswitch
              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> {{ $post->updated_at->diffForHumans() }} by <a href="#">{{ $post->user->username }}</a></span>

                <h3 class="timeline-header">
                  @switch($post->type)
                    @case('1') {{-- 1:user_comment --}}
                    <a href="#">{{ $post->user->username }}</a> posted the message
                    @if ($post->aircraft_id != null)
                    &nbsp;on <a href="{{ route('aircraft.show', ['id' => $post->aircraft->id]) }}">{{ $post->aircraft->name() }}</a>
                    @endif
                    @if ($post->engine_id != null)
                    &nbsp;on <a href="{{ route('engine.show', ['id' => $post->engine_id]) }}">{{ $post->engine->engineType->type }} - {{ $post->engine->serial_number }}</a>
                    @endif
                    @break

                    @case('2') {{-- 2:engine_install --}}
                    Engine <a href="{{ route('engine.show', ['id' => $post->engine_id]) }}">{{ $post->engine->engineType->type }} - {{ $post->engine->serial_number }}</a>&nbsp;
                    installed on&nbsp;
                    @if ($post->aircraft_position != 5)
                      {{ $post->enginePositionName() }} side of
                    @endif
                    <a href="{{ route('aircraft.show', ['id' => $post->aircraft->id]) }}">{{ $post->aircraft->name() }}</a>
                    @break

                    @case('3') {{-- 3:engine_remove --}}
                    Engine <a href="{{ route('engine.show', ['id' => $post->engine_id]) }}">{{ $post->engine->engineType->type }} - {{ $post->engine->serial_number }}</a>&nbsp;
                    removed from&nbsp;
                    @if ($post->aircraft_position != 5)
                      {{ $post->enginePositionName() }} side of
                    @endif
                    <a href="{{ route('aircraft.show', ['id' => $post->aircraft->id]) }}">{{ $post->aircraft->name() }}</a>
                    @break
                  @endswitch
                </h3>
                @if ($post->body != null)
                <div class="timeline-body">
                  {!! str_replace("\r","<br>", $post->body) !!}
                </div>
                @endif

                @switch($post->type)
                @case('1') {{-- 1:user_comment --}}
                <div class="timeline-footer">
                  @if ($post->user_id == Auth::id())
                    <div>
                      <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#editPost{{$loop->index}}">Edit</button>
                      <div class="modal fade" id="editPost{{$loop->index}}" tabindex="-1" role="dialog" aria-labelledby="editPost{{$loop->index}}" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                              </button>
                              <h4 class="modal-title">Edit post</h4>
                            </div>
                            <form  class="form-horizontal" role="form" method="POST" action="{{ route('post.update', ['id' => $post->id]) }}">
                              {{ csrf_field() }}
                              {{ method_field('PATCH') }}
                              <div class="modal-body">
                                <input type="hidden" name="user_id" id="user_id" value="{{Auth::id()}}">
                                <input type="hidden" name="aircraft_id" id="aircraft_id" value="{{$post->aircraft_id}}">
                                <input type="hidden" name="engine_id" id="engine_id" value="{{$post->engine_id}}">
                                <input type="hidden" name="aircraft_position" id="aircraft_position" value="{{$post->aircraft_position}}">
                                <input type="hidden" name="type" id="type" value="{{$post->type}}">
                                <div class="form-group">
                                  <div class="col-sm-12">
                                    <textarea
                                      name="body"
                                      id="body"
                                      style="resize: vertical;"
                                      class="form-control"
                                      rows="3"
                                      autofocus>{{$post->body}}</textarea>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="date" class="col-sm-3 control-label">Post date</label>
                                  <div class="col-sm-9">
                                    <input type="text"
                                    id="date"
                                    name="date"
                                    class="form-control"
                                    value="{{ $post->date }}">
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="action" value="edit">Ok</button>
                                <button type="submit" class="btn btn-danger" name="action" value="delete" onclick="return confirm('DELETE - Are you sure?')">Delete</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  @else
                    <div>
                      <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#addComment{{$loop->index}}">Comment</button>
                      <div class="modal fade" id="addComment{{$loop->index}}" tabindex="-1" role="dialog" aria-labelledby="addComment{{$loop->index}}" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                              </button>
                              <h4 class="modal-title">Add comment</h4>
                            </div>
                            <form  class="form-horizontal" role="form" method="POST" action="{{ route('comment.store') }}">
                              {{ csrf_field() }}
                              <div class="modal-body">
                                <input type="hidden" name="user_id" id="user_id" value="{{Auth::id()}}">
                                <input type="hidden" name="post_id" id="post_id" value="{{$post->id}}">
                                <div class="form-group">
                                  <div class="col-sm-12">
                                    <textarea
                                      name="body"
                                      id="body"
                                      style="resize: vertical;"
                                      class="form-control"
                                      rows="3"
                                      placeholder="Your comment..."
                                      autofocus></textarea>
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Ok</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  @endif
                </div>
                @php
                  $comments = $post->comments->sortBy('created_at')->reverse();
                  $looppost = $loop->index;
                @endphp
                @foreach($comments as $comment)
                <li>
                  <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> {{ $post->updated_at->diffForHumans() }} by <a href="#">{{ $comment->user->username }}</a></span>
                  <h3 class="timeline-header">
                    <a href="#">{{ $comment->user->username }}</a> posted the comment
                  </h3>
                  @if ($post->body != null)
                  <div class="timeline-body">
                    {!! str_replace("\r","<br>", $comment->body) !!}
                  </div>
                  @endif
                  @if ($comment->user_id == Auth::id())
                    <div class="timeline-footer">
                      <div>
                        <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#editComment{{$looppost}}-{{$loop->index}}">Edit</button>
                        <div class="modal fade" id="editComment{{$looppost}}-{{$loop->index}}" tabindex="-1" role="dialog" aria-labelledby="editComment{{$looppost}}-{{$loop->index}}" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">
                                  <span aria-hidden="true">&times;</span>
                                  <span class="sr-only">Close</span>
                                </button>
                                <h4 class="modal-title">Edit post</h4>
                              </div>
                              <form  class="form-horizontal" role="form" method="POST" action="{{ route('comment.update', ['id' => $comment->id]) }}">
                                {{ csrf_field() }}
                                {{ method_field('PATCH') }}
                                <div class="modal-body">
                                  <input type="hidden" name="user_id" id="user_id" value="{{Auth::id()}}">
                                  <input type="hidden" name="post_id" id="post_id" value="{{$comment->post_id}}">
                                  <div class="form-group">
                                    <div class="col-sm-12">
                                      <textarea
                                        name="body"
                                        id="body"
                                        style="resize: vertical;"
                                        class="form-control"
                                        rows="3"
                                        autofocus>{{$comment->body}}</textarea>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary" name="action" value="edit">Ok</button>
                                  <button type="submit" class="btn btn-danger" name="action" value="delete" onclick="return confirm('DELETE - Are you sure?')">Delete</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  @endif
                @endforeach
                @break

                @case('2') {{-- 2:engine_install --}}
                @case('3') {{-- 3:engine_remove --}}
                <div class="timeline-footer">
                  <div>
                    <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#editPost{{$loop->index}}">Edit</button>
                    <div class="modal fade" id="editPost{{$loop->index}}" tabindex="-1" role="dialog" aria-labelledby="editPost{{$loop->index}}" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">
                              <span aria-hidden="true">&times;</span>
                              <span class="sr-only">Close</span>
                            </button>
                            @switch($post->type)
                              @case('2') {{-- 2:engine_install --}}
                              <h4 class="modal-title">Edit engine install</h4>
                              @break
                              @case('3') {{-- 3:engine_remove --}}
                              <h4 class="modal-title">Edit engine removal</h4>
                              @break
                            @endswitch
                          </div>
                          <form  class="form-horizontal" role="form" method="POST" action="{{ route('post.update', ['id' => $post->id]) }}">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            <div class="modal-body">
                              <input type="hidden" name="user_id" id="user_id" value="{{Auth::id()}}">
                              <input type="hidden" name="aircraft_id" id="aircraft_id" value="{{$post->aircraft_id}}">
                              <input type="hidden" name="engine_id" id="engine_id" value="{{$post->engine_id}}">
                              <input type="hidden" name="aircraft_position" id="aircraft_position" value="{{$post->aircraft_position}}">
                              <input type="hidden" name="type" id="type" value="{{$post->type}}">
                              <input type="hidden" name="body" id="body" value="{{$post->body}}">
                              <div class="form-group">
                                @switch($post->type)
                                  @case('2') {{-- 2:engine_install --}}
                                  <label for="date" class="col-sm-3 control-label">Installation date</label>
                                  @break
                                  @case('3') {{-- 3:engine_remove --}}
                                  <label for="date" class="col-sm-3 control-label">Removal date</label>
                                  @break
                                @endswitch
                                <div class="col-sm-9">
                                  <input type="text"
                                  id="date"
                                  name="date"
                                  class="form-control"
                                  value="{{ $post->date }}"
                                  autofocus>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary" name="action" value="edit">Ok</button>
                              <button type="submit" class="btn btn-danger" name="action" value="delete" onclick="return confirm('DELETE - Are you sure?')">Delete</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @break

                @endswitch
              </div>
            </li>
          @endforeach
          <li>
        <i class="fa fa-clock-o bg-gray"></i>
      </li>
    </ul>
  </div>
</div>
