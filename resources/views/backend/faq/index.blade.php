@extends('layouts.backend')

@section('title')
  Faq
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
          <div class="card-header"><h3 class="card-title">Faqs Table</h3></div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered table-striped">
              <thead>
                @can('add_faqs')
                  <div class="add-item">
                    <a class="btn btn-light add-button" href="{{route('faqs.create')}}"><i class="fa fa-plus" aria-hidden="true"></i></a>
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
                            <a class="dropdown-item" href="{{ route('faqs.index') }}">
                                All
                            </a>
                        </li>
                        <li>
                          <a class="dropdown-item" href="{{ route('faqs.index', ['filter_by' => 'status', 'status' => 'Active']) }}">
                            Active
                          </a>
                        </li>
                        <li>
                          <a class="dropdown-item" href="{{ route('faqs.index', ['filter_by' => 'status', 'status' => 'Inactive']) }}">
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
                            <a class="dropdown-item" href="{{ route('faqs.index') }}">
                              Without Deleted
                            </a>
                        </li>
                        <li>
                          <a class="dropdown-item" href="{{ route('faqs.index', ['filter_by' => 'deleted-items', 'deleted-items' => 'Only Deleted']) }}">
                            Only Deleted
                          </a>
                        </li>
                        <li>
                          <a class="dropdown-item" href="{{ route('faqs.index', ['filter_by' => 'deleted-items', 'deleted-items' => 'All']) }}">
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
                  <th>Faq</th>
                  <th>Created By</th>
                  <th>Updated By</th>
                  <th class="text-center">Status</th>
                  @if(auth()->user()->can('edit_faqs') || auth()->user()->can('delete_faqs'))
                    <th class="text-center">Actions</th>
                  @endif
                </tr>
              </thead>
              <tbody>
                @forelse($faqs as $faq)
                    <tr>
                      <td>{{ reversePagination($faqs, $loop) }}</td>                      
                      <td>{{$faq->faq}}</td>
                      <td>{{$faq->createdBy['name']}}</td>
                      <td>{{$faq->updatedBy['name']}}</td>
                    
                      @if(auth()->user()->can('edit_faqs'))
                        <td class="text-center">
                          <label class="switch">
                           <input type="checkbox" class="change-status" data-faq-id="{{ $faq->id }}" {{ $faq->status ? 'checked' : '' }}>
                            <span class="slider round"></span>
                          </label>
                        </td>
                      @else
                        <td class="text-center">
                          @if($faq->status == 1)
                            <span style="font-size: 12px;" class="label label-success">Active</span>
                          @else
                            <span style="font-size: 12px;" class="label label-danger">Inactive</span>
                          @endif
                        </td>
                      @endif
                      @if(auth()->user()->can('edit_faqs') || auth()->user()->can('delete_faqs'))
                        <td class="text-center">
                          @can('edit_faqs')
                            <a class="btn btn-primary btn-sm action-button" href="{{ route('faqs.edit', $faq->id) }}" data-tooltip="Edit"><i class="fa fa fa-edit"></i></a>
                          @endcan
                          @can('delete_faqs')
                            @if($faq->deleted_at == null)
                              <button class="btn btn-danger btn-sm action-button" data-bs-toggle="modal" data-bs-target="#delete-modal{{$faq->id}}"><i class="fa fa-trash"></i></button>
                            @else
                              <button class="btn btn-primary btn-sm action-button" data-bs-toggle="modal" data-bs-target="#restore-modal{{$faq->id}}"><i class="fa fa-recycle"></i></button>
                              
                              <button class="btn btn-danger btn-sm action-button" data-bs-toggle="modal" data-bs-target="#force-delete-modal{{$faq->id}}"><i class="fa fa-trash" style="color: red"></i></button>
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
              {{ $faqs->links('vendor.pagination.bootstrap-4') }}
          </div>
        </div>
      </div>
    <!--end::Row-->
    </div>
    @foreach($faqs as $faq)
      <form action="{{ route('faqs.destroy', $faq->id) }}" class="pull-xs-right5 card-link" method="POST">
        {{ csrf_field() }}
        {{method_field('DELETE')}}
        <div class="modal fade" id="delete-modal{{$faq->id}}" tabindex="-1" aria-hidden="true">
          @include('backend.partials.delete-modal')
        </div>
      </form>

      <form action="{{ route('faqs.restore', $faq->id) }}" class="pull-xs-right5 card-link" method="POST">
        {{ csrf_field() }}
        <div class="modal fade" id="restore-modal{{$faq->id}}" tabindex="-1" aria-hidden="true">
          @include('backend.partials.restore-modal')
        </div>
      </form>

      <form action="{{ route('faqs.forceDestroy', $faq->id) }}" class="pull-xs-right5 card-link" method="POST">
        {{ csrf_field() }}
        {{method_field('DELETE')}}
        <div class="modal fade" id="force-delete-modal{{$faq->id}}" tabindex="-1" aria-hidden="true">
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
            let faqId = $(this).data('faq-id');
            let status = $(this).is(':checked') ? 1 : 0;

            $.ajax({
                url: `faqs/change-status/${faqId}`,
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