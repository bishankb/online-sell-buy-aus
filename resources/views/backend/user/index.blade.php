@extends('layouts.backend')

@section('title')
  User
@endsection

@section('content')
  <div class="container-fluid">
    <div class="alert alert-success" id="status-change-alert">
      Status Changed Sucessfully.
    </div>
    <div class="row">
      <div class="col-md-11">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Users Table</h3>
          </div>
          <div class="box-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped">
                <thead>
                  @can('add_users')
                    <div class="add-item">
                      <a class="btn btn-default add-button" href="{{route('users.create')}}"><i class="fa fa-plus" aria-hidden="true"></i></a>
                    </div>
                  @endcan
                  <div class="filter">
                    <label>&nbsp Filters: </label>
                    <div class="dropdown inline">
                      <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
                      @if(request('status') != null)
                        {{ request('status') }}
                      @else
                        Filter by Status
                      @endif
                      <span class="caret"></span></button>
                      <ul class="dropdown-menu">
                          <li>
                              <a href="{{ route('users.index') }}">
                                  All
                              </a>
                          </li>
                          <li>
                            <a href="{{ route('users.index', ['filter_by' => 'status', 'status' => 'Active']) }}">
                              Active
                            </a>
                          </li>
                          <li>
                            <a href="{{ route('users.index', ['filter_by' => 'status', 'status' => 'Inactive']) }}">
                              Inactive
                            </a>
                          </li>
                      </ul>
                    </div>

                    <div class="dropdown inline">
                      <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
                      @if(request('deleted-items') != null)
                        {{ request('deleted-items') }}
                      @else
                        Filter by Deleted Items
                      @endif
                      <span class="caret"></span></button>
                      <ul class="dropdown-menu">
                          <li>
                              <a href="{{ route('users.index') }}">
                                Without Deleted
                              </a>
                          </li>
                          <li>
                            <a href="{{ route('users.index', ['filter_by' => 'deleted-items', 'deleted-items' => 'Only Deleted']) }}">
                              Only Deleted
                            </a>
                          </li>
                          <li>
                            <a href="{{ route('users.index', ['filter_by' => 'deleted-items', 'deleted-items' => 'All']) }}">
                              All
                            </a>
                          </li>
                      </ul>
                    </div>

                    <div class="dropdown inline">
                      <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
                        @if(request('city') != null)
                          {{ request('city') }}
                        @else
                          Filter by Cities
                        @endif
                        <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu scrollable-menu">
                          <li>
                              <a href="{{ route('users.index') }}">
                               All
                              </a>
                          </li>
                          @foreach($cities as $city)
                            <li>
                              <a href="{{ route('users.index', ['filter_by' => 'city', 'city' => $city->name ]) }}">
                                {{ $city->name }}
                              </a>
                            </li>
                          @endforeach
                      </ul>
                    </div>

                    <div class="dropdown inline">
                      <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
                        @if(request('role') != null)
                          {{ request('role') }}
                        @else
                          Filter by Roles
                        @endif
                        <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu scrollable-menu">
                          <li>
                              <a href="{{ route('users.index') }}">
                               All
                              </a>
                          </li>
                          @foreach($roles as $role)
                            <li>
                              <a href="{{ route('users.index', ['filter_by' => 'role', 'role' => $role->name ]) }}">
                                {{ $role->display_name }}
                              </a>
                            </li>
                          @endforeach
                      </ul>
                    </div>

                  </div>
                  <div class="search">
                    <form>
                      <div class="input-group input-group-sm">
                        <input type="text" name="search-item" value="{{ request('search-item') }}" class="form-control pull-right" placeholder="Search">
                        <div class="input-group-btn">
                          <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <tr>
                    <th>#</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>City</th>
                    <th>Role</th>
                    <th class="text-center">Active</th>
                    <th>Registered At</th>
                    @if(auth()->user()->can('edit_users') || auth()->user()->can('delete_users'))
                      <th class="text-center">Actions</th>
                    @endif
                  </tr>
                </thead>
                <tbody>
                  @forelse($users as $user)
                    <tr>
                      <td>{{ reversePagination($users, $loop) }}</td>                      
                      <td>{{$user->name}}</td>
                      <td>{{$user->email}}</td>
                      <td>
                        @isset($user->profile)
                          {{$user->profile->city->name}}
                        @endisset
                      </td>
                      <td>
                        @isset($user->role)
                          {{$user->role->display_name}}
                        @endisset
                      </td>
                      @if(auth()->user()->can('edit_users'))
                        <td class="text-center">
                          <label class="switch">
                            <input type="checkbox" class="changeStatus{{$user->id}}" @if($user->active == 1) checked @endif>
                            <span class="slider round"></span>
                          </label>
                        </td>
                      @else
                        <td class="text-center">
                          @if($user->active == 1)
                            <span style="font-size: 12px;" class="label label-success">Active</span>
                          @else
                            <span style="font-size: 12px;" class="label label-danger">Inactive</span>
                          @endif
                        </td>
                      @endif
                      <td>
                        {{$user->created_at->format('d M, Y')}}<br>
                        {{$user->created_at->format('h:m:s a')}}
                      </td>
                      @if(auth()->user()->can('edit_users') || auth()->user()->can('delete_users'))
                        <td class="text-center">
                          @can('edit_users')
                            <a class="btn btn-default btn-sm action-button" href="{{ route('users.edit', $user->id) }}" data-tooltip="Edit"><i class="fa fa fa-edit"></i></a>
                          @endcan
                          @can('delete_users')
                            @if($user->deleted_at == null)
                              <button class="btn btn-default btn-sm action-button" data-toggle="modal" data-target="#delete-modal{{$user->id}}"><i class="fa fa-trash"></i></button>
                            @else
                              <button class="btn btn-default btn-sm action-button" data-toggle="modal" data-target="#restore-modal{{$user->id}}"><i class="fa fa-recycle"></i></button>
                              
                              <button class="btn btn-default btn-sm action-button" data-toggle="modal" data-target="#force-delete-modal{{$user->id}}"><i class="fa fa-trash" style="color: red"></i></button>
                            @endif
                          @endcan
                        </td>
                      @endif
                    </tr>
                  @empty
                    <tr class="text-center">
                      <td colspan="5">No data available in table</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
          <div class="box-footer text-center">
            {{ $users->appends(request()->input())->links() }}
          </div>
        </div>
      </div>
    </div>
    @foreach($users as $user)
      <form action="{{ route('users.destroy', $user->id) }}" class="pull-xs-right5 card-link" method="POST">
        {{ csrf_field() }}
        {{method_field('DELETE')}}
        <div class="modal fade" id="delete-modal{{$user->id}}" role="dialog">
          @include('backend.partials.delete-modal')
        </div>
      </form>

      <form action="{{ route('users.restore', $user->id) }}" class="pull-xs-right5 card-link" method="POST">
        {{ csrf_field() }}
        <div class="modal fade" id="restore-modal{{$user->id}}" role="dialog">
          @include('backend.partials.restore-modal')
        </div>
      </form>

      <form action="{{ route('users.forceDestroy', $user->id) }}" class="pull-xs-right5 card-link" method="POST">
        {{ csrf_field() }}
        {{method_field('DELETE')}}
        <div class="modal fade" id="force-delete-modal{{$user->id}}" role="dialog">
          @include('backend.partials.force-delete-modal')
        </div>
      </form>
    @endforeach
  </div>
@endsection

@section('backend-script')
  <script type="text/javascript">
    $(document).ready(function(){
      @foreach($users as $user)
        $('.changeStatus'+'{{$user->id}}').click(function () {
          var userId = {{$user->id}};
          var val = $(this).prop('checked') == false ? 0 : 1;
          $.ajax({
            type     : "POST",
            headers  : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url      : "{{route('users.changeStatus', '')}}/"+userId,
            data     : {status: val},
            success: function(response){
              if (response.success) {
                $("#status-change-alert").show();
                $('#status-change-alert').delay(3000).fadeOut(1000);
              }
            },
            error: function(response){
              alert("There was some internal error while updating the status.");
              window.location.reload(); 
            },
          });
        });
      @endforeach
    });
  </script>
@endsection