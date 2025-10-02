@extends('layouts.backend')

@section('title')
  Buyer Question
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
          <div class="card-header"><h3 class="card-title">Buyer Questions Table</h3></div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered table-striped">
              <thead>
                @can('add_buyer_questions')
                  <div class="add-item">
                    <a class="btn btn-light add-button" href="{{route('buyer-questions.create')}}"><i class="fa fa-plus" aria-hidden="true"></i></a>
                  </div>
                @endcan
                <div class="filter">
                  <label>&nbsp Filters: </label>
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
                            <a class="dropdown-item" href="{{ route('buyer-questions.index') }}">
                             All
                            </a>
                        </li>
                        @foreach($categories as $category)
                          <li>
                            <a class="dropdown-item" href="{{ route('buyer-questions.index', ['filter_by' => 'category', 'category' => $category->slug ]) }}">
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
                            <a class="dropdown-item" href="{{ route('buyer-questions.index') }}">
                             All
                            </a>
                        </li>
                        @foreach($sub_categories as $sub_category)
                          <li>
                            <a class="dropdown-item" href="{{ route('buyer-questions.index', ['filter_by' => 'sub_category', 'sub_category' => $sub_category->slug ]) }}">
                              {{ $sub_category->title }}
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
                  <th>Category</th>
                  <th>Question</th>
                  <th>Asked By</th>
                  <th>Asked On</th>
                  <th>Reply</th>
                  @if(auth()->user()->can('edit_buyer_questions') || auth()->user()->can('delete_buyer_questions'))
                    <th class="text-center">Actions</th>
                  @endif
                </tr>
              </thead>
              <tbody>
                @forelse($buyer_questions as $buyer_question)
                    <tr @if($buyer_question->answer2 == null) class="font-bold" @endif>
                      <td>{{ reversePagination($buyer_questions, $loop) }}</td>                      
                      <td>
                        @if(isset($buyer_question->product->title))
                          <a href="{{ route('product.show', $buyer_question->product->slug) }}" target="__blank">{{$buyer_question->product->title}}</a>
                        @else
                          <i>Deleted</i>
                        @endif
                      </td>
                      <td>
                        @if(isset($buyer_question->product->category->title))
                          {{$buyer_question->product->category->title}}
                        @else
                          <i>Deleted</i>
                        @endif
                      </td>
                      <td>
                        {{ $buyer_question->question }}
                      </td>
                      <td>
                        @if(isset($buyer_question->askedBy->name))
                          {{$buyer_question->askedBy->name}}
                        @else
                          <i>Deleted</i>
                        @endif
                      </td>
                      <td>
                        {{$buyer_question->created_at->format('d M, y')}}
                      </td>
                      <td>
                        @if($buyer_question->answer2 == null)
                          <a href="{{ route('buyer-questions.reply', $buyer_question->question_id) }}" class="red-color">Reply</a>
                        @else
                          <a href="{{ route('buyer-questions.reply', $buyer_question->question_id) }}" class="red-color">Replied</a>
                        @endif
                      </td>
    
                      @if(auth()->user()->can('edit_buyer_questions') || auth()->user()->can('delete_buyer_questions'))
                        <td class="text-center">
                          @can('edit_buyer_questions')
                            <a class="btn btn-primary btn-sm action-button" href="{{ route('buyer-questions.edit', $buyer_question->id) }}" data-tooltip="Edit"><i class="fa fa fa-edit"></i></a>
                          @endcan
                          @can('delete_buyer_questions')
                            <button class="btn btn-danger btn-sm action-button" data-bs-toggle="modal" data-bs-target="#delete-modal{{$buyer_question->id}}"><i class="fa fa-trash"></i></button>
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
              {{ $buyer_questions->links('vendor.pagination.bootstrap-4') }}
          </div>
        </div>
      </div>
    <!--end::Row-->
    </div>
    @foreach($buyer_questions as $buyer_question)
      <form action="{{ route('buyer-questions.destroy', $buyer_question->id) }}" class="pull-xs-right5 card-link" method="POST">
        {{ csrf_field() }}
        {{method_field('DELETE')}}
        <div class="modal fade" id="delete-modal{{$buyer_question->id}}" tabindex="-1" aria-hidden="true">
          @include('backend.partials.delete-modal')
        </div>
      </form>
    @endforeach
    <!--end::Container-->
  </div>
@endsection

