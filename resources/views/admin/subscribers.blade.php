@extends('admin.layouts.dashboard')
@section('title','Dashboard')

@section('content')

<div class="container pl-2 pr-2 pt-3 pb-3">
    <div class="row ml-2 mr-3">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">PSVs of the Year</h3>

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
                    <th>Subscriber Email</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($Subscribers as $Subscriber )
                      <tr>
                        <td>{{ $Subscriber->email }}</td>
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

