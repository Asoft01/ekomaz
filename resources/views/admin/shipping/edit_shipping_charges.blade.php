@extends('layouts.admin_layout.admin_layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Catalogues</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Shipping Charges</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        @if($errors->any())
        <div class="alert alert-danger" style="margin-top: 10px;">
          <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      @if(Session::has('success_message'))
                <div class="alert alert-success alert-dismissable fade show" role="alert" style="margin-top:10px;">
                {{ Session::get('success_message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <?php Session::forget('success_message'); ?>
            @endif
          <form name="shippingForm" id="shippingForm"  action="{{ url('admin/edit-shipping-charges/'.$shippingDetails['id']) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Update Shipping Charges</h3>

                <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                        <div class="col-md-6">
                            
                            <div class="form-group">
                                <label for="country">Shipping Country</label>
                                <input readonly type="text" class="form-control" value="{{ $shippingDetails['country'] }}">
                            </div>
                        </div>
                    <!-- /.col -->
                </div>

                <div class="row">
                    <div class="col-md-6">                    
                        <div class="form-group">
                            <label for="0_500g">Shipping Charges (0-500g)</label>
                            <input type="text" class="form-control" name="0_500g" id="0_500g" placeholder="Enter Shipping Charges" @if(!empty($shippingDetails['0_500g'])) value="{{ $shippingDetails['0_500g'] }}" @else value="{{ old('0_500g') }}" @endif>
                        </div>
                    </div>
                <!-- /.col -->
                </div>

                <div class="row">
                  <div class="col-md-6">                    
                      <div class="form-group">
                          <label for="501_1000g">Shipping Charges (501_1000g)</label>
                          <input type="text" class="form-control" name="501_1000g" id="501_1000g" placeholder="Enter Shipping Charges" @if(!empty($shippingDetails['501_1000g'])) value="{{ $shippingDetails['501_1000g'] }}" @else value="{{ old('501_1000g') }}" @endif>
                      </div>
                  </div>
              <!-- /.col -->
              </div>
                
                <div class="row">
                  <div class="col-md-6">                    
                      <div class="form-group">
                          <label for="1001_2000g">Shipping Charges (1001_2000g)</label>
                          <input type="text" class="form-control" name="1001_2000g" id="1001_2000g" placeholder="Enter Shipping Charges" @if(!empty($shippingDetails['1001_2000g'])) value="{{ $shippingDetails['1001_2000g'] }}" @else value="{{ old('1001_2000g') }}" @endif>
                      </div>
                  </div>
                </div>
              
              <div class="row">
                <div class="col-md-6">                    
                    <div class="form-group">
                        <label for="2001_5000g">Shipping Charges (2001_5000g)</label>
                        <input type="text" class="form-control" name="2001_5000g" id="2001_5000g" placeholder="Enter Shipping Charges" @if(!empty($shippingDetails['2001_5000g'])) value="{{ $shippingDetails['2001_5000g'] }}" @else value="{{ old('2001_5000g') }}" @endif>
                    </div>
                </div>
            <!-- /.col -->
            </div>

              
            <div class="row">
              <div class="col-md-6">                    
                  <div class="form-group">
                      <label for="above_5000g">Shipping Charges (above_5000g)</label>
                      <input type="text" class="form-control" name="above_5000g" id="above_5000g" placeholder="Enter Shipping Charges" @if(!empty($shippingDetails['above_5000g'])) value="{{ $shippingDetails['above_5000g'] }}" @else value="{{ old('above_5000g') }}" @endif>
                  </div>
              </div>
          <!-- /.col -->
          </div>
          
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </div>
          </form>        
        </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection