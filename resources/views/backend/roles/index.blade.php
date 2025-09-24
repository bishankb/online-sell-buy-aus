@extends('layouts.backend')

@section('title')
  Roles
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
          <div class="card-header"><h3 class="card-title">Roles Table</h3></div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered table-striped">
              <thead>
                @can('add_roles')
                  <div class="add-item">
                    <a class="btn btn-light add-button" href="{{route('roles.create')}}"><i class="fa fa-plus" aria-hidden="true"></i></a>
                  </div>
                @endcan
                <tr>
                  <th>#</th>
                  <th>Display Name</th>
                  <th>Identifier</th>
                  @if(auth()->user()->can('edit_roles') || auth()->user()->can('delete_roles'))
                    <th class="text-center">Actions</th>
                  @endif
                </tr>
              </thead>
              <tbody>
                @forelse($roles as $role)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{ $role->display_name }}</td>
                      <td>{{ $role->name }}</td>

                      @if(auth()->user()->can('edit_roles') || auth()->user()->can('delete_roles'))
                        <td class="text-center">
                          @can('edit_roles')
                            <a class="btn btn-primary btn-sm action-button" href="{{ route('roles.edit', $role->id) }}" data-tooltip="Edit"><i class="fa fa fa-edit"></i></a>
                          @endcan
                          @can('delete_roles')
                              <button class="btn btn-danger btn-sm action-button" data-bs-toggle="modal" data-bs-target="#delete-modal{{$role->id}}"><i class="fa fa-trash"></i></button>
                          @endcan
                        </td>
                      @endif
                    </tr>
                  @empty
                    <tr class="text-center">
                      <td colspan="4">No data available in table</td>
                    </tr>
                  @endforelse
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
          <div class="card-footer clearfix d-flex justify-content-center">
              {{ $roles->links('vendor.pagination.bootstrap-4') }}
          </div>
        </div>
      </div>
    <!--end::Row-->
    </div>
    @foreach($roles as $role)
      <form action="{{ route('roles.destroy', $role->id) }}" class="pull-xs-right5 card-link" method="POST">
        {{ csrf_field() }}
        {{method_field('DELETE')}}
        <div class="modal fade" id="delete-modal{{$role->id}}" tabindex="-1" aria-hidden="true">
          @include('backend.partials.delete-modal')
        </div>
      </form>
    @endforeach
    <!--end::Container-->
  </div>
@endsection