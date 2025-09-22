@extends('layouts.backend')

@section('title')
  City
@endsection

@section('content')
  <!--begin::Container-->
  <div class="container-fluid">
    <!--begin::Row-->
    <div class="row">
      <div class="col-md-11">
        <div class="card mb-4">
          <div class="card-header"><h3 class="card-title">Cities Table</h3></div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered table-striped">
              <thead>
                @can('add_cities')
                  <div class="add-item">
                    <a class="btn btn-light add-button" href="{{route('cities.create')}}"><i class="fa fa-plus" aria-hidden="true"></i></a>
                  </div>
                @endcan
                <div class="search">
                  <form>
                    <div class="input-group input-group-sm">
                      <input type="text" name="search-item" value="{{ request('search-item') }}" class="form-control pull-right" placeholder="Search">
                      <div class="input-group-btn">
                        <button type="submit" class="btn btn-light"><i class="fa fa-search"></i></button>
                      </div>
                    </div>
                  </form>
                </div>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Order</th>
                  @if(auth()->user()->can('edit_cities') || auth()->user()->can('delete_cities'))
                    <th class="text-center">Actions</th>
                  @endif
                </tr>
              </thead>
              <tbody>
                @forelse($cities as $city)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$city->name}}</td>
                    <td>{{$city->order}}</td>
                    @if(auth()->user()->can('edit_cities') || auth()->user()->can('delete_cities'))
                      <td class="text-center">
                        @can('edit_cities')
                          <a class="btn btn-primary btn-sm action-button" href="{{ route('cities.edit', $city->id) }}" data-tooltip="Edit"><i class="fa fa fa-edit"></i></a>
                        @endcan
                        @can('delete_cities')                       
                          <button type="button" class="btn btn-danger btn-sm action-button" data-bs-toggle="modal" data-bs-target="#delete-modal{{$city->id}}"><i class="fa fa-trash"></i></button>
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
              {{ $cities->links('vendor.pagination.bootstrap-4') }}
          </div>
        </div>
      </div>
    <!--end::Row-->
    </div>
    @foreach($cities as $city)
      <form action="{{ route('cities.destroy', $city->id) }}" class="pull-xs-right5 card-link" method="POST">
        @csrf
         @method('DELETE')
        <div class="modal fade" id="delete-modal{{$city->id}}" tabindex="-1" aria-hidden="true">
          @include('backend.partials.delete-modal')
        </div>
      </form>
    @endforeach
    <!--end::Container-->
  </div>
@endsection
