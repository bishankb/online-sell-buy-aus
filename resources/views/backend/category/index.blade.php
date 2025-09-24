@extends('layouts.backend')

@section('title')
  Category
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
          <div class="card-header"><h3 class="card-title">Categories Table</h3></div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered table-striped">
              <thead>
                @can('add_categories')
                  <div class="add-item">
                    <a class="btn btn-light add-button" href="{{route('categories.create')}}"><i class="fa fa-plus" aria-hidden="true"></i></a>
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
                            <a class="dropdown-item" href="{{ route('categories.index') }}">
                                All
                            </a>
                        </li>
                        <li>
                          <a class="dropdown-item" href="{{ route('categories.index', ['filter_by' => 'status', 'status' => 'Active']) }}">
                            Active
                          </a>
                        </li>
                        <li>
                          <a class="dropdown-item" href="{{ route('categories.index', ['filter_by' => 'status', 'status' => 'Inactive']) }}">
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
                            <a class="dropdown-item" href="{{ route('categories.index') }}">
                              Without Deleted
                            </a>
                        </li>
                        <li>
                          <a class="dropdown-item" href="{{ route('categories.index', ['filter_by' => 'deleted-items', 'deleted-items' => 'Only Deleted']) }}">
                            Only Deleted
                          </a>
                        </li>
                        <li>
                          <a class="dropdown-item" href="{{ route('categories.index', ['filter_by' => 'deleted-items', 'deleted-items' => 'All']) }}">
                            All
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
                        <button type="submit" class="btn btn-light"><i class="fa fa-search"></i></button>
                      </div>
                    </div>
                  </form>
                </div>
                <tr>
                  <th>#</th>
                    <th>Title</th>
                    <th>Created By</th>
                    <th>Updated By</th>
                    <th class="text-center">Status</th>
                    @if(auth()->user()->can('edit_categories') || auth()->user()->can('delete_categories'))
                      <th class="text-center">Actions</th>
                    @endif
                </tr>
              </thead>
              <tbody>
                @forelse($categories as $category)
                    <tr>
                      <td>{{ reversePagination($categories, $loop) }}</td>                      
                      <td>{{$category->title}}</td>
                      <td>{{$category->createdBy['name']}}</td>
                      <td>{{$category->updatedBy['name']}}</td>
                    
                      @if(auth()->user()->can('edit_categories'))
                        <td class="text-center">
                          <label class="switch">
                           <input type="checkbox" class="change-status" data-category-id="{{ $category->id }}" {{ $category->status ? 'checked' : '' }}>
                            <span class="slider round"></span>
                          </label>
                        </td>
                      @else
                        <td class="text-center">
                          @if($category->status == 1)
                            <span style="font-size: 12px;" class="label label-success">Active</span>
                          @else
                            <span style="font-size: 12px;" class="label label-danger">Inactive</span>
                          @endif
                        </td>
                      @endif
                      @if(auth()->user()->can('edit_categories') || auth()->user()->can('delete_categories'))
                        <td class="text-center">
                          @can('edit_categories')
                            <a class="btn btn-primary btn-sm action-button" href="{{ route('categories.edit', $category->id) }}" data-tooltip="Edit"><i class="fa fa fa-edit"></i></a>
                          @endcan
                          @can('delete_categories')
                            @if($category->deleted_at == null)
                              <button class="btn btn-danger btn-sm action-button" data-bs-toggle="modal" data-bs-target="#delete-modal{{$category->id}}"><i class="fa fa-trash"></i></button>
                            @else
                              <button class="btn btn-primary btn-sm action-button" data-bs-toggle="modal" data-bs-target="#restore-modal{{$category->id}}"><i class="fa fa-recycle"></i></button>
                              
                              <button class="btn btn-danger btn-sm action-button" data-bs-toggle="modal" data-bs-target="#force-delete-modal{{$category->id}}"><i class="fa fa-trash" style="color: red"></i></button>
                            @endif
                          @endcan
                        </td>
                      @endif
                    </tr>
                  @empty
                    <tr class="text-center">
                      <td colspan="6">No data available in table</td>
                    </tr>
                  @endforelse
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
          <div class="card-footer clearfix d-flex justify-content-center">
              {{ $categories->links('vendor.pagination.bootstrap-4') }}
          </div>
        </div>
      </div>
    <!--end::Row-->
    </div>
    @foreach($categories as $category)
      <form action="{{ route('categories.destroy', $category->id) }}" class="pull-xs-right5 card-link" method="POST">
        {{ csrf_field() }}
        {{method_field('DELETE')}}
        <div class="modal fade" id="delete-modal{{$category->id}}" tabindex="-1" aria-hidden="true">
          @include('backend.partials.delete-modal')
        </div>
      </form>

      <form action="{{ route('categories.restore', $category->id) }}" class="pull-xs-right5 card-link" method="POST">
        {{ csrf_field() }}
        <div class="modal fade" id="restore-modal{{$category->id}}" tabindex="-1" aria-hidden="true">
          @include('backend.partials.restore-modal')
        </div>
      </form>

      <form action="{{ route('categories.forceDestroy', $category->id) }}" class="pull-xs-right5 card-link" method="POST">
        {{ csrf_field() }}
        {{method_field('DELETE')}}
        <div class="modal fade" id="force-delete-modal{{$category->id}}" tabindex="-1" aria-hidden="true">
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
            let categoryId = $(this).data('category-id');
            let status = $(this).is(':checked') ? 1 : 0;

            $.ajax({
                url: `categories/change-status/${categoryId}`,
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