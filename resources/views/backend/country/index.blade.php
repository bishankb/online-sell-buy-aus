@extends('layouts.backend')

@section('title')
  Country
@endsection

@section('content')
  <!--begin::Container-->
  <div class="container-fluid">
    <!--begin::Row-->
    <div class="row">
      <div class="col-md-11">
        <div class="card mb-4">
          <div class="card-header"><h3 class="card-title">Countries Table</h3></div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered table-striped">
              <thead>
                @can('add_countries')
                  <div class="add-item">
                    <a class="btn btn-light add-button" href="{{route('countries.create')}}"><i class="fa fa-plus" aria-hidden="true"></i></a>
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
                  @if(auth()->user()->can('edit_countries') || auth()->user()->can('delete_countries'))
                    <th class="text-center">Actions</th>
                  @endif
                </tr>
              </thead>
              <tbody>
                @forelse($countries as $country)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$country->name}}</td>
                    <td>{{$country->order}}</td>
                    @if(auth()->user()->can('edit_countries') || auth()->user()->can('delete_countries'))
                      <td class="text-center">
                        @can('edit_countries')
                          <a class="btn btn-primary btn-sm action-button" href="{{ route('countries.edit', $country->id) }}" data-tooltip="Edit"><i class="fa fa fa-edit"></i></a>
                        @endcan
                        @can('delete_countries')                       
                          <button type="button" class="btn btn-danger btn-sm action-button" data-bs-toggle="modal" data-bs-target="#delete-modal{{$country->id}}"><i class="fa fa-trash"></i></button>
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
              {{ $countries->links('vendor.pagination.bootstrap-4') }}
          </div>
        </div>
      </div>
    <!--end::Row-->
    </div>
    @foreach($countries as $country)
      <form action="{{ route('countries.destroy', $country->id) }}" class="pull-xs-right5 card-link" method="POST">
        @csrf
         @method('DELETE')
        <div class="modal fade" id="delete-modal{{$country->id}}" tabindex="-1" aria-hidden="true">
          @include('backend.partials.delete-modal')
        </div>
      </form>
    @endforeach
    <!--end::Container-->
  </div>
@endsection
