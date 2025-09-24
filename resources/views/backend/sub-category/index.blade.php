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
    <div class="alert alert-success" id="home-visibility-change-alert">
      Home Visibility Changed Sucessfully.
    </div>
    <!--begin::Row-->
    <div class="row">
      <div class="col-md-11">
        <div class="card mb-4">
          <div class="card-header"><h3 class="card-title">Sub Categories Table</h3></div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered table-striped">
              <thead>
                @can('add_sub_categories')
                  <div class="add-item">
                    <a class="btn btn-light add-button" href="{{route('sub-categories.create')}}"><i class="fa fa-plus" aria-hidden="true"></i></a>
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
                            <a class="dropdown-item" href="{{ route('sub-categories.index') }}">
                                All
                            </a>
                        </li>
                        <li>
                          <a class="dropdown-item" href="{{ route('sub-categories.index', ['filter_by' => 'status', 'status' => 'Active']) }}">
                            Active
                          </a>
                        </li>
                        <li>
                          <a class="dropdown-item" href="{{ route('sub-categories.index', ['filter_by' => 'status', 'status' => 'Inactive']) }}">
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
                            <a class="dropdown-item" href="{{ route('sub-categories.index') }}">
                              Without Deleted
                            </a>
                        </li>
                        <li>
                          <a class="dropdown-item" href="{{ route('sub-categories.index', ['filter_by' => 'deleted-items', 'deleted-items' => 'Only Deleted']) }}">
                            Only Deleted
                          </a>
                        </li>
                        <li>
                          <a class="dropdown-item" href="{{ route('sub-categories.index', ['filter_by' => 'deleted-items', 'deleted-items' => 'All']) }}">
                            All
                          </a>
                        </li>
                    </ul>
                  </div>

                  <div class="dropdown inline">
                      <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                      @if(request('category') != null)
                        {{ request('category') }}
                      @else
                        Filter by Categories
                      @endif
                      <ul class="dropdown-menu scrollable-menu">
                          <li>
                              <a href="{{ route('sub-categories.index') }}">
                               All
                              </a>
                          </li>
                          @foreach($categories as $category)
                            <li>
                              <a href="{{ route('sub-categories.index', ['filter_by' => 'category', 'category' => $category->slug ]) }}">
                                {{ $category->title }}
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
                    <th class="text-center">Home Visibilty</th>
                    <th class="text-center">Status</th>
                    @if(auth()->user()->can('edit_sub_categories') || auth()->user()->can('delete_sub_categories'))
                      <th class="text-center">Actions</th>
                    @endif
                </tr>
              </thead>
              <tbody>
                @forelse($sub_categories as $sub_category)
                    <tr>
                      <td>{{ reversePagination($sub_categories, $loop) }}</td>                      
                      <td>{{$sub_category->title}}</td>
                      <td>{{$sub_category->createdBy['name']}}</td>
                      <td>{{$sub_category->updatedBy['name']}}</td>

                      @if(auth()->user()->can('edit_sub_categories'))
                        <td class="text-center">
                          <label class="switch">
                            <input type="checkbox" class="change-home-visibility" data-home-visibility="{{ $sub_category->id }}" {{ $sub_category->home_visibility ? 'checked' : '' }}>
                            <span class="slider round"></span>
                          </label>
                        </td>

                        <td class="text-center">
                          <label class="switch">
                           <input type="checkbox" class="change-status" data-sub-category-id="{{ $sub_category->id }}" {{ $sub_category->status ? 'checked' : '' }}>
                            <span class="slider round"></span>
                          </label>
                        </td>
                      @else
                        <td class="text-center">
                          @if($sub_category->home_visibility == 1)
                            <span style="font-size: 12px;" class="label label-success">Active</span>
                          @else
                            <span style="font-size: 12px;" class="label label-danger">Inactive</span>
                          @endif
                        </td>

                        <td class="text-center">
                          @if($sub_category->status == 1)
                            <span style="font-size: 12px;" class="label label-success">Active</span>
                          @else
                            <span style="font-size: 12px;" class="label label-danger">Inactive</span>
                          @endif
                        </td>
                      @endif
                      @if(auth()->user()->can('edit_sub_categories') || auth()->user()->can('delete_sub_categories'))
                        <td class="text-center">
                          @can('edit_sub_categories')
                            <a class="btn btn-primary btn-sm action-button" href="{{ route('sub-categories.edit', $sub_category->id) }}" data-tooltip="Edit"><i class="fa fa fa-edit"></i></a>
                          @endcan
                          @can('delete_sub_categories')
                            @if($sub_category->deleted_at == null)
                              <button class="btn btn-danger btn-sm action-button" data-bs-toggle="modal" data-bs-target="#delete-modal{{$sub_category->id}}"><i class="fa fa-trash"></i></button>
                            @else
                              <button class="btn btn-primary btn-sm action-button" data-bs-toggle="modal" data-bs-target="#restore-modal{{$sub_category->id}}"><i class="fa fa-recycle"></i></button>
                              
                              <button class="btn btn-danger btn-sm action-button" data-bs-toggle="modal" data-bs-target="#force-delete-modal{{$sub_category->id}}"><i class="fa fa-trash" style="color: red"></i></button>
                            @endif
                          @endcan
                        </td>
                      @endif
                    </tr>
                  @empty
                    <tr class="text-center">
                      <td colspan="7">No data available in table</td>
                    </tr>
                  @endforelse
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
          <div class="card-footer clearfix d-flex justify-content-center">
              {{ $sub_categories->links('vendor.pagination.bootstrap-4') }}
          </div>
        </div>
      </div>
    <!--end::Row-->
    </div>
    @foreach($sub_categories as $sub_category)
      <form action="{{ route('sub-categories.destroy', $sub_category->id) }}" class="pull-xs-right5 card-link" method="POST">
        {{ csrf_field() }}
        {{method_field('DELETE')}}
        <div class="modal fade" id="delete-modal{{$sub_category->id}}" tabindex="-1" aria-hidden="true">
          @include('backend.partials.delete-modal')
        </div>
      </form>

      <form action="{{ route('sub-categories.restore', $sub_category->id) }}" class="pull-xs-right5 card-link" method="POST">
        {{ csrf_field() }}
        <div class="modal fade" id="restore-modal{{$sub_category->id}}" tabindex="-1" aria-hidden="true">
          @include('backend.partials.restore-modal')
        </div>
      </form>

      <form action="{{ route('sub-categories.forceDestroy', $sub_category->id) }}" class="pull-xs-right5 card-link" method="POST">
        {{ csrf_field() }}
        {{method_field('DELETE')}}
        <div class="modal fade" id="force-delete-modal{{$sub_category->id}}" tabindex="-1" aria-hidden="true">
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
            let subCategoryId = $(this).data('sub-category-id');
            let val = $(this).is(':checked') ? 1 : 0;

            $.ajax({
                url: `sub-categories/change-status/${subCategoryId}`,
                method: 'POST',
                data: {
                    status: val
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

        $('.change-home-visibility').on('change', function () {
            let subCategoryId = $(this).data('home-visibility');
            let val = $(this).is(':checked') ? 1 : 0;

            $.ajax({
                url: `sub-categories/change-home-visibility/${subCategoryId}`,
                method: 'POST',
                data: {
                    home_visibility: val
                },
                success: function (response) {
                    if (response.success) {
                        $('#home-visibility-change-alert').fadeIn().delay(2000).fadeOut();
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