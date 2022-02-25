@extends('admin.layouts.dashboard')
@section('title','Dashboard')

@section('content')

<div class="container pl-2 pr-2 pt-3 pb-3">

    {{-- display success message on a successful action --}}
    @if(Session::has('success'))
    <div  class="alert alert-success" role="alert">
      {{ Session::get('success') }}
    </div>
    @endif

    <div class="row ml-2 mr-3">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Enter Mpesa Amount</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">

                <div id="login" style="width:60%; border:0px;">                  
                    <form method="POST" action="/admin-mpesa-amount">
                     @csrf
                      <div class="mb-3">
                        <label for="email" class="form-label">Amount</label>
                        <input type="number" class="form-control" name="amount" min="0" required autocomplete="email" autofocus id="amount"> 
                    </div>
                      <button  type="submit" class="btn btn-primary">Set Amount</button>
                    </form>
                    </div> <!--==end of <div id="login">==-->          
            </div>
            <div class="card-footer">
                <p style="font-weight:bold; font-size:30px;">Current Amount : KSH {{ $MpesaAmount[0]->amount }}</p>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
</div>
@endsection

