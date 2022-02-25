@extends('admin.layouts.dashboard')
@section('title','Dashboard')

@section('content')

{{-- display success message on a successful action --}}
@if(Session::has('success'))
<div style="width:95%; margin:auto" class="alert alert-success" role="alert">
  {{ Session::get('success') }}
</div>
@endif

<div class="container pl-2 pr-2 pt-3 pb-3">
    <div class="row ml-2 mr-3">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Cars for Auction</h3>

              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>make</th>
                    <th>model</th>
                    <th>year</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

                  @foreach ($Auctioncars as $Auctioncar )
                      <tr>
                        <td>{{ $Auctioncar->carfor }}</td>
                        <td>{{ $Auctioncar->category }}</td>
                        <td>{{ $Auctioncar->make }}</td>
                        <td>{{ $Auctioncar->model }}</td>
                        <td>{{ $Auctioncar->manufacture_year }}</td>
                        <td><a href="/admin-car-auction-details/{{ $Auctioncar->id }}" class="btn btn-sm btn-info">more details</a></td>
                        <td><a href="/admin-delete-auction-car/{{ $Auctioncar->id }}" class="btn btn-sm btn-danger">delete</a></td>
                        @if ($Auctioncar->published == 'YES')
                        <td><a href="/admin-unpublish-auction-car/{{ $Auctioncar->id }}" class="btn btn-sm btn-warning">unpublish</a></td>
                        @else
                         <td><a href="/admin-publish-auction-car/{{ $Auctioncar->id }}" class="btn btn-sm btn-success">publish</a></td>
                        @endif  
                      </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
</div>
@endsection

