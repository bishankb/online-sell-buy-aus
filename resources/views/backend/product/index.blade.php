@extends('layouts.backend')

@section('title')
  Product
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
          <div class="card-header"><h3 class="card-title">Products Table</h3></div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered table-striped">
              <thead>
                @can('add_products')
                  <div class="add-item">
                    <a class="btn btn-light add-button" href="{{route('products.addCategories')}}"><i class="fa fa-plus" aria-hidden="true"></i></a>
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
                            <a class="dropdown-item" href="{{ route('products.index') }}">
                                All
                            </a>
                        </li>
                        <li>
                          <a class="dropdown-item" href="{{ route('products.index', ['filter_by' => 'status', 'status' => 'Active']) }}">
                            Active
                          </a>
                        </li>
                        <li>
                          <a class="dropdown-item" href="{{ route('products.index', ['filter_by' => 'status', 'status' => 'Inactive']) }}">
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
                            <a class="dropdown-item" href="{{ route('products.index') }}">
                              Without Deleted
                            </a>
                        </li>
                        <li>
                          <a class="dropdown-item" href="{{ route('products.index', ['filter_by' => 'deleted-items', 'deleted-items' => 'Only Deleted']) }}">
                            Only Deleted
                          </a>
                        </li>
                        <li>
                          <a class="dropdown-item" href="{{ route('products.index', ['filter_by' => 'deleted-items', 'deleted-items' => 'All']) }}">
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
                      </button>
                      <ul class="dropdown-menu scrollable-menu">
                          <li>
                              <a class="dropdown-item" href="{{ route('products.index') }}">
                               All
                              </a>
                          </li>
                          @foreach($categories as $category)
                            <li>
                              <a class="dropdown-item" href="{{ route('products.index', ['filter_by' => 'category', 'category' => $category->slug ]) }}">
                                {{ $category->title }}
                              </a>
                            </li>
                          @endforeach
                      </ul>
                    </div>

                    <div class="dropdown inline">
                      <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        @if(request('sub_category') != null)
                          {{ request('sub_category') }}
                        @else
                          Filter by Sub-Categories
                        @endif
                      </button>
                      <ul class="dropdown-menu scrollable-menu">
                          <li>
                              <a class="dropdown-item" href="{{ route('products.index') }}">
                               All
                              </a>
                          </li>
                          @foreach($sub_categories as $sub_category)
                            <li>
                              <a class="dropdown-item" href="{{ route('products.index', ['filter_by' => 'sub_category', 'sub_category' => $sub_category->slug ]) }}">
                                {{ $sub_category->title }}
                              </a>
                            </li>
                          @endforeach
                      </ul>
                    </div>

                    <div class="dropdown inline">
                      <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        @if(request('sold-items') != null)
                          {{ request('sold-items') }}
                        @else
                          Filter by Sold Items
                        @endif
                      </button>
                      <ul class="dropdown-menu scrollable-menu">
                          <li>
                              <a class="dropdown-item" href="{{ route('products.index') }}">
                                All
                              </a>
                          </li>
                          <li>
                            <a class="dropdown-item" href="{{ route('products.index', ['filter_by' => 'sold-items', 'sold-items' => 'Sold Items']) }}">
                              Sold Items
                            </a>
                          </li>
                          <li>
                            <a class="dropdown-item" href="{{ route('products.index', ['filter_by' => 'sold-items', 'sold-items' => 'Unsold Items']) }}">
                              Unsold Items
                            </a>
                          </li>
                      </ul>
                    </div>

                    <div class="dropdown inline">
                      <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        @if(request('featured-items') != null)
                          {{ request('featured-items') }}
                        @else
                          Filter by Featured Items
                        @endif
                      </button>
                      <ul class="dropdown-menu scrollable-menu">
                          <li>
                              <a class="dropdown-item" href="{{ route('products.index') }}">
                                All
                              </a>
                          </li>
                          <li>
                            <a class="dropdown-item" href="{{ route('products.index', ['filter_by' => 'featured-items', 'featured-items' => 'Featured Items']) }}">
                              Featured Items
                            </a>
                          </li>
                          <li>
                            <a class="dropdown-item" href="{{ route('products.index', ['filter_by' => 'featured-items', 'featured-items' => 'UnFeatured Items']) }}">
                              UnFeatured Items
                            </a>
                          </li>
                      </ul>
                    </div>

                    <div class="dropdown inline">
                      <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        @if(request('expired-items') != null)
                          {{ request('expired-items') }}
                        @else
                          Filter by Expired Items
                        @endif
                      </button>
                      <ul class="dropdown-menu scrollable-menu">
                          <li>
                              <a class="dropdown-item" href="{{ route('products.index') }}">
                                All
                              </a>
                          </li>
                          <li>
                            <a class="dropdown-item" href="{{ route('products.index', ['filter_by' => 'expired-items', 'expired-items' => 'Expired Items']) }}">
                              Expired Items
                            </a>
                          </li>
                          <li>
                            <a class="dropdown-item" href="{{ route('products.index', ['filter_by' => 'expired-items', 'expired-items' => 'Unexpired Items']) }}">
                              Unexpired Items
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
                  <th>Catgory</th>
                  <th>SubCatgory</th>
                  @can('edit_products')
                    <th>Images</th>
                  @endcan
                  <th>Sold</th>
                  <th>Feature</th>
                  <th>Expired On</th>
                  <th>Created By</th>
                  <th>Updated By</th>
                  <th class="text-center">Status</th>
                  @if(auth()->user()->can('edit_products') || auth()->user()->can('delete_products'))
                    <th class="text-center">Actions</th>
                  @endif
                </tr>
              </thead>
              <tbody>
                @forelse($products as $product)
                    <tr>
                      <td>{{ reversePagination($products, $loop) }}</td>                      
                      <td>{{ Str::limit($product->title, $limit = 18, $end = '...') }}</td>
                      @if(isset($product->category->title))
                        <td>{{$product->category->title}}</td>
                      @else
                        <td>Deleted</td>
                      @endif
                      @if(isset($product->subCategory->title))
                        <td>{{$product->subCategory->title}}</td>
                      @endif
                      @can('edit_products')
                        <td>
                          <a href="{{route('products.addImages', $product->slug)}}">Manage</a>
                        </td>
                      @endcan
                      @if(auth()->user()->can('edit_products'))
                        <td>
                          @if($product->is_sold == 0)
                            <button class="btn btn-link" data-bs-toggle="modal" data-bs-target="#mark-sold-modal{{$product->slug}}">Unsold</button>
                          @else
                            <button class="btn btn-link" data-bs-toggle="modal" data-bs-target="#mark-unsold-modal{{$product->slug}}">Sold</button>
                          @endif
                        </td>

                        <td>
                          @if($product->is_featured == 0)
                            <button class="btn btn-link" data-bs-toggle="modal" data-bs-target="#mark-featured-modal{{$product->slug}}">Unfeatured</button>
                          @else
                            <button class="btn btn-link" data-bs-toggle="modal" data-bs-target="#mark-unfeatured-modal{{$product->slug}}">Featured</button>
                          @endif
                        </td>
                      @else
                        <td>
                          @if($product->is_sold == 0)
                            Unsold
                          @else
                            Sold
                          @endif
                        </td>
                        <td>
                          @if($product->is_featured == 0)
                            Unfeatured
                          @else
                            Featured
                          @endif
                        </td>
                      @endif

                      <td>
                        @if($product->expiry_period < Carbon\Carbon::now())
                          Expired
                        @else
                          {{ Carbon\Carbon::parse($product->expiry_period)->format('d M, Y') }}
                        @endif  
                      </td>

                      <td>{{$product->createdBy['name']}}</td>
                      <td>{{$product->updatedBy['name']}}</td>
                    
                      @if(auth()->user()->can('edit_products'))
                        <td class="text-center">
                          <label class="switch">
                           <input type="checkbox" class="change-status" data-product-id="{{ $product->slug }}" {{ $product->status ? 'checked' : '' }}>
                            <span class="slider round"></span>
                          </label>
                        </td>
                      @else
                        <td class="text-center">
                          @if($product->status == 1)
                            <span style="font-size: 12px;" class="label label-success">Active</span>
                          @else
                            <span style="font-size: 12px;" class="label label-danger">Inactive</span>
                          @endif
                        </td>
                      @endif
                      @if(auth()->user()->can('edit_products') || auth()->user()->can('delete_products'))
                        <td class="text-center">
                          @can('edit_products')
                            <a class="btn btn-primary btn-sm action-button" href="{{ route('products.edit', $product->slug) }}" data-tooltip="Edit"><i class="fa fa fa-edit"></i></a>
                          @endcan
                          @can('delete_products')
                            @if($product->deleted_at == null)
                              <button class="btn btn-danger btn-sm action-button" data-bs-toggle="modal" data-bs-target="#delete-modal{{$product->slug}}"><i class="fa fa-trash"></i></button>
                            @else
                              <button class="btn btn-primary btn-sm action-button" data-bs-toggle="modal" data-bs-target="#restore-modal{{$product->slug}}"><i class="fa fa-recycle"></i></button>
                              
                              <button class="btn btn-danger btn-sm action-button" data-bs-toggle="modal" data-bs-target="#force-delete-modal{{$product->slug}}"><i class="fa fa-trash" style="color: red"></i></button>
                            @endif
                          @endcan
                          @can('edit_products')
                            @if($product->expiry_period < Carbon\Carbon::now())
                              <button class="btn btn-info btn-sm action-button" data-bs-toggle="modal" data-bs-target="#renew-modal{{$product->slug}}"><i class="fa fa-refresh"></i></button>
                            @endif
                          @endcan
                        </td>
                      @endif
                    </tr>
                  @empty
                    <tr class="text-center">
                      <td colspan="11">No data available in table</td>
                    </tr>
                  @endforelse
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
          <div class="card-footer clearfix d-flex justify-content-center">
              {{ $products->links('vendor.pagination.bootstrap-4') }}
          </div>
        </div>
      </div>
    <!--end::Row-->
    </div>
    @foreach($products as $product)
      <form action="{{ route('products.destroy', $product->slug) }}" class="pull-xs-right5 card-link" method="POST">
        {{ csrf_field() }}
        {{method_field('DELETE')}}
        <div class="modal fade" id="delete-modal{{$product->slug}}" tabindex="-1" aria-hidden="true">
          @include('backend.partials.delete-modal')
        </div>
      </form>

      <form action="{{ route('products.restore', $product->slug) }}" class="pull-xs-right5 card-link" method="POST">
        {{ csrf_field() }}
        <div class="modal fade" id="restore-modal{{$product->slug}}" tabindex="-1" aria-hidden="true">
          @include('backend.partials.restore-modal')
        </div>
      </form>

      <form action="{{ route('products.forceDestroy', $product->slug) }}" class="pull-xs-right5 card-link" method="POST">
        {{ csrf_field() }}
        {{method_field('DELETE')}}
        <div class="modal fade" id="force-delete-modal{{$product->slug}}" tabindex="-1" aria-hidden="true">
          @include('backend.partials.force-delete-modal')
        </div>
      </form>

      <form action="{{ route('products.markSold', $product->slug) }}" class="pull-xs-right5 card-link" method="POST">
        {{ csrf_field() }}
        {{method_field('PATCH')}}
        <div class="modal fade" id="mark-sold-modal{{$product->slug}}" tabindex="-1" aria-hidden="true">
          @include('backend.partials.mark-sold-modal')
        </div>
      </form>

      <form action="{{ route('products.markSold', $product->slug) }}" class="pull-xs-right5 card-link" method="POST">
        {{ csrf_field() }}
        {{method_field('PATCH')}}
        <div class="modal fade" id="mark-unsold-modal{{$product->slug}}" tabindex="-1" aria-hidden="true">
          @include('backend.partials.mark-unsold-modal')
        </div>
      </form>

      <form action="{{ route('products.markFeatured', $product->slug) }}" class="pull-xs-right5 card-link" method="POST">
        {{ csrf_field() }}
        {{method_field('PATCH')}}
        <div class="modal fade" id="mark-featured-modal{{$product->slug}}" tabindex="-1" aria-hidden="true">
          @include('backend.partials.mark-featured-modal')
        </div>
      </form>

      <form action="{{ route('products.markFeatured', $product->slug) }}" class="pull-xs-right5 card-link" method="POST">
        {{ csrf_field() }}
        {{method_field('PATCH')}}
        <div class="modal fade" id="mark-unfeatured-modal{{$product->slug}}" tabindex="-1" aria-hidden="true">
          @include('backend.partials.mark-unfeatured-modal')
        </div>
      </form>

      <form action="{{ route('products.renew', $product->slug) }}" class="pull-xs-right5 card-link" method="POST">
        {{ csrf_field() }}
        {{method_field('PATCH')}}
        <div class="modal fade" id="renew-modal{{$product->slug}}" tabindex="-1" aria-hidden="true">
          @include('backend.partials.renew-modal')
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
            let productId = $(this).data('product-id');
            let status = $(this).is(':checked') ? 1 : 0;

            $.ajax({
                url: `products/change-status/${productId}`,
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