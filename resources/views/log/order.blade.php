@extends('layout.log')
@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Company</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Order</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
         
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Customer Order</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>SN</th>
                    <th>Order No</th>
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Customer Name</th>
                    <th>Contact Number</th>
                    <th>Quantity</th>
                    <th>Rate</th>
                    <th>Amount</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @php $count = 1; @endphp
                 @foreach($orders as $order)
                  <tr>
                    <td>{{$count++}}</td>
                    <td>{{$order->order_no}}</td>
                    <td>
                      <a target="_blank" href="{{asset('product/'.$order->image)}}">
                        <img src="{{asset('product/'.$order->image)}}" width="80px" height="80px">
                      </a>
                    </td>
                    <td>{{$order->product_name}}</td>
                    <td>{{$order->name}}</td>
                    <td>{{$order->contact_number}}</td>
                    <td>{{$order->quantity}}</td>
                    <td>{{$order->mrp}}</td>
                    <td>{{$order->mrp * $order->quantity}}</td>
                    <td>{{strtoupper($order->payment_method)}}</td>
                    <td>@if($order->status == 'ready-to-ship')
                          Ready To Ship
                        @else
                          {{ucfirst($order->status)}}
                        @endif
                        </td>
                    <td>
                        @if($order->status == 'delivered')
                          <button class="btn btn-primary btn-sm" disabled>Delivered</button>
                        @else
                        <a href="{{route('pharmacy.log.order.deliver',$order->id)}}" onClick="confirm('Are you sure to deliver this product?');" class="btn btn-primary btn-sm">Deliver</a>
                        @endif
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
@section('script')
    <!-- DataTables  & Plugins -->
    <script src="{{asset('assets/backend/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
   
   
    
    <!-- Page specific script -->
    <script>
    $(function () {
        $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
        "paging": false,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        });
    });
    </script>
@endsection
