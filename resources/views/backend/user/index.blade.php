@extends('layouts.backend')

@section('title')
  User
@endsection

@section('content')
  <div class="container-fluid">
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
                    <div class="add-item">
                      <a class="btn btn-default add-button" href="#"><i class="fa fa-plus" aria-hidden="true"></i></a>
                    </div>
                  <div class="filter">
                    <label>&nbsp Filters: </label>
                    <div class="dropdown inline">
                      <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
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
  </div>
@endsection