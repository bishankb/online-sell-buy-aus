@extends('layouts.backend')

@section('title')
  Country
@endsection

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-11">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Countries Table</h3>
          </div>
          <div class="box-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped">
                <thead>
                  @can('add_countries')
                    <div class="add-item">
                      <a class="btn btn-default add-button" href="{{route('countries.create')}}"><i class="fa fa-plus" aria-hidden="true"></i></a>
                    </div>
                  @endcan
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
                            <a class="btn btn-default btn-sm action-button" href="{{ route('countries.edit', $country->id) }}" data-tooltip="Edit"><i class="fa fa fa-edit"></i></a>
                          @endcan
                          @can('delete_countries')
                            <button class="btn btn-default btn-sm action-button" data-toggle="modal" data-target="#delete-modal{{$country->id}}"><i class="fa fa-trash"></i></button>
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
          </div>
          <div class="box-footer text-center">
            {{ $countries->appends(request()->input())->links() }}
          </div>
        </div>
      </div>
    </div>
    @foreach($countries as $country)
      <form action="{{ route('countries.destroy', $country->id) }}" class="pull-xs-right5 card-link" method="POST">
        {{ csrf_field() }}
        {{method_field('DELETE')}}
        <div class="modal fade" id="delete-modal{{$country->id}}" role="dialog">
          @include('backend.partials.delete-modal')
        </div>
      </form>
    @endforeach
  </div>
@endsection