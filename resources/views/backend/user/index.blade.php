@extends('layouts.backend')

@section('title')
  User
@endsection

@section('content')
  <!--begin::Container-->
  <div class="container-fluid">
    <div class="alert alert-success" id="status-change-alert">
      Status Changed Sucessfully.
    </div>
    <!--begin::Row-->
    <div class="row">
      <div class="col-md-11">
        <div class="card mb-4">
          <div class="card-header"><h3 class="card-title">Users Table</h3></div>
          <!-- /.card-header -->
          <div class="card-body">
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
                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                      @if(request('status') != null)
                        {{ request('status') }}
                      @else
                        Filter by Status
                      @endif
                    </button>
                    <ul class="dropdown-menu scrollable-menu">
                        <li>
                            <a class="dropdown-item" href="{{ route('users.index') }}">
                                All
                            </a>
                        </li>
                        <li>
                          <a class="dropdown-item" href="{{ route('users.index', ['filter_by' => 'status', 'status' => 'Active']) }}">
                            Active
                          </a>
                        </li>
                        <li>
                          <a class="dropdown-item" href="{{ route('users.index', ['filter_by' => 'status', 'status' => 'Inactive']) }}">
                            Inactive
                          </a>
                        </li>
                    </ul>
                  </div>

                  <div class="dropdown inline">
                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                      @if(request('deleted-items') != null)
                        {{ request('deleted-items') }}
                      @else
                        Filter by Deleted Items
                      @endif
                    </button>
                    <ul class="dropdown-menu scrollable-menu">
                        <li>
                            <a class="dropdown-item" href="{{ route('users.index') }}">
                              Without Deleted
                            </a>
                        </li>
                        <li>
                          <a class="dropdown-item" href="{{ route('users.index', ['filter_by' => 'deleted-items', 'deleted-items' => 'Only Deleted']) }}">
                            Only Deleted
                          </a>
                        </li>
                        <li>
                          <a class="dropdown-item" href="{{ route('users.index', ['filter_by' => 'deleted-items', 'deleted-items' => 'All']) }}">
                            All
                          </a>
                        </li>
                    </ul>
                  </div>

                  <div class="dropdown inline">
                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                      @if(request('city') != null)
                        {{ request('city') }}
                      @else
                        Filter by Cities
                      @endif
                    </button>
                    <ul class="dropdown-menu scrollable-menu">
                        <li>
                            <a class="dropdown-item" href="{{ route('users.index') }}">
                             All
                            </a>
                        </li>
                        @foreach($cities as $city)
                          <li>
                            <a class="dropdown-item" href="{{ route('users.index', ['filter_by' => 'city', 'city' => $city->name ]) }}">
                              {{ $city->name }}
                            </a>
                          </li>
                        @endforeach
                    </ul>
                  </div>

                  <div class="dropdown inline">
                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                      @if(request('role') != null)
                        {{ request('role') }}
                      @else
                        Filter by Roles
                      @endif
                      <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu scrollable-menu">
                        <li>
                            <a class="dropdown-item" href="{{ route('users.index') }}">
                             All
                            </a>
                        </li>
                        @foreach($roles as $role)
                          <li>
                            <a class="dropdown-item" href="{{ route('users.index', ['filter_by' => 'role', 'role' => $role->name ]) }}">
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
                           <input type="checkbox" class="change-status" data-user-id="{{ $user->id }}" {{ $user->active ? 'checked' : '' }}>
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
                            <a class="btn btn-primary btn-sm action-button" href="{{ route('users.edit', $user->id) }}" data-tooltip="Edit"><i class="fa fa fa-edit"></i></a>
                          @endcan
                          @can('delete_users')
                            @if($user->deleted_at == null)
                              <button class="btn btn-danger btn-sm action-button" data-bs-toggle="modal" data-bs-target="#delete-modal{{$user->id}}"><i class="fa fa-trash"></i></button>
                            @else
                              <button class="btn btn-primary btn-sm action-button" data-bs-toggle="modal" data-bs-target="#restore-modal{{$user->id}}"><i class="fa fa-recycle"></i></button>
                              
                              <button class="btn btn-danger btn-sm action-button" data-bs-toggle="modal" data-bs-target="#force-delete-modal{{$user->id}}"><i class="fa fa-trash" style="color: red"></i></button>
                            @endif
                          @endcan
                        </td>
                      @endif
                    </tr>
                  @empty
                    <tr class="text-center">
                      <td colspan="8">No data available in table</td>
                    </tr>
                  @endforelse
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
          <div class="card-footer clearfix d-flex justify-content-center">
              {{ $users->links('vendor.pagination.bootstrap-4') }}
          </div>
        </div>
      </div>
    <!--end::Row-->
    </div>
    @foreach($users as $user)
      <form action="{{ route('users.destroy', $user->id) }}" class="pull-xs-right5 card-link" method="POST">
        {{ csrf_field() }}
        {{method_field('DELETE')}}
        <div class="modal fade" id="delete-modal{{$user->id}}" tabindex="-1" aria-hidden="true">
          @include('backend.partials.delete-modal')
        </div>
      </form>

      <form action="{{ route('users.restore', $user->id) }}" class="pull-xs-right5 card-link" method="POST">
        {{ csrf_field() }}
        <div class="modal fade" id="restore-modal{{$user->id}}" tabindex="-1" aria-hidden="true">
          @include('backend.partials.restore-modal')
        </div>
      </form>

      <form action="{{ route('users.forceDestroy', $user->id) }}" class="pull-xs-right5 card-link" method="POST">
        {{ csrf_field() }}
        {{method_field('DELETE')}}
        <div class="modal fade" id="force-delete-modal{{$user->id}}" tabindex="-1" aria-hidden="true">
          @include('backend.partials.force-delete-modal')
        </div>
      </form>
    @endforeach
    <!--end::Container-->
  </div>
@endsection

@section('backend-script')
  <script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function() {
        // Set CSRF token for all AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // On checkbox change
        $('.change-status').on('change', function () {
            let userId = $(this).data('user-id');
            let status = $(this).is(':checked') ? 1 : 0;

            $.ajax({
                url: `users/change-status/${userId}`,
                method: 'POST',
                data: {
                    status: status
                },
                success: function (response) {
                    if (response.success) {
                        $('#status-change-alert').fadeIn().delay(2000).fadeOut();
                    } else {
                        alert('Update failed.');
                    }
                },
                error: function (xhr) {
                    alert('Error: ' + xhr.status + ' - ' + xhr.responseText);
                }
            });
        });
    });
  </script>
@endsection