@extends('layouts.backend')

@section('title')
    Dashboard
@endsection

@section('content')
  <div class="container-fluid">
    <div class="row">

      <div class="col-lg-3 col-6">
        <div class="small-box text-bg-primary">
          <div class="inner">
            <h3>{{$totalProduct}}</h3>
            <p>Total Products</p>
          </div>
          <i class="small-box-icon fa fa-shopping-cart"></i>
          <a
            href="{{route('products.index')}}"
            class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover"
          >
            More info <i class="bi bi-link-45deg"></i>
          </a>
        </div>
      </div>

      <div class="col-lg-3 col-6">
        <div class="small-box text-bg-success">
          <div class="inner">
            <h3>{{$totalUser}}</h3>
            <p>Total Users</p>
          </div>
          <i class="small-box-icon fa fa-user"></i>
          <a
            href="{{route('users.index')}}"
            class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover"
          >
            More info <i class="bi bi-link-45deg"></i>
          </a>
        </div>
      </div>

      <div class="col-lg-3 col-6">
        <div class="small-box text-bg-warning">
          <div class="inner">
            <h3>{{$totalCategory}}</h3>
            <p>Total Categories</p>
          </div>
          <i class="small-box-icon fa fa-shopping-list"></i>
          <a
            href="{{route('categories.index')}}"
            class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover"
          >
            More info <i class="bi bi-link-45deg"></i>
          </a>
        </div>
      </div>

      <div class="col-lg-3 col-6">
        <div class="small-box text-bg-danger">
          <div class="inner">
            <h3>{{$totalSubCategory}}</h3>
            <p>Total Sub Categories</p>
          </div>
          <i class="small-box-icon fa fa-list-alt"></i>
          <a
            href="{{route('sub-categories.index')}}"
            class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover"
          >
            More info <i class="bi bi-link-45deg"></i>
          </a>
        </div>
      </div>

      <div class="col-lg-3 col-6">
        <div class="small-box text-bg-info">
          <div class="inner">
            <h3>{{$totalSoldProduct}}</h3>
            <p>Total Sold Product</p>
          </div>
          <i class="small-box-icon fa fa-money"></i>
          <a
            href="{{ route('products.index', ['filter_by' => 'sold-items', 'sold-items' => 'Sold Items']) }}"
            class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover"
          >
            More info <i class="bi bi-link-45deg"></i>
          </a>
        </div>
      </div>

      <div class="col-lg-3 col-6">
        <div class="small-box text-bg-primary">
          <div class="inner">
            <h3>{{$totalFeaturedProduct}}</h3>
            <p>Total Feature Product</p>
          </div>
          <i class="small-box-icon fa fa-star"></i>
          <a
            href="{{ route('products.index', ['filter_by' => 'featured-items', 'featured-items' => 'Featured Items']) }}"
            class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover"
          >
            More info <i class="bi bi-link-45deg"></i>
          </a>
        </div>
      </div>

      <div class="col-lg-3 col-6">
        <div class="small-box text-bg-danger">
          <div class="inner">
            <h3>{{$totalExpiredProduct}}</h3>
            <p>Total Expired Product</p>
          </div>
          <i class="small-box-icon fa fa-warning"></i>
          <a
            href="{{ route('products.index', ['filter_by' => 'expired-items', 'expired-items' => 'Expired Items']) }}"
            class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover"
          >
            More info <i class="bi bi-link-45deg"></i>
          </a>
        </div>
      </div>

    </div>
  </div>
@endsection
