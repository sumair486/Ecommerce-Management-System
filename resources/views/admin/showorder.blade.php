
<!DOCTYPE html>
<html lang="en">
  <head>
@include('admin.css')
  </head>
  <body>
@include('admin.sidebar')
      <!-- partial -->
@include('admin.navbar')
        <!-- partial -->

        <script>
            var msg = '{{Session::get('su')}}';
            var exist = '{{Session::has('su')}}';
            if(exist){
              alert(msg);
            }
          </script>
        <div class="container-fluid page-body-wrapper">
            <div class="container" align='center'>
                <table style="color: white;" class="table">
                    <tr>
                        <th>Customer name</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Product title</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
@foreach ($order as $orders)

             <tr>
                <td>{{$orders->name}}</td>
                <td>{{$orders->phone}}</td>
                <td>{{$orders->address}}</td>
                <td>{{$orders->product_title}}</td>
                <td>{{$orders->price}}</td>
                <td>{{$orders->quantity}}</td>
                <td>{{$orders->status}}</td>
                <td>
                    <a class="btn btn-success" href="{{url('updatestatus',$orders->id)}}">Delivered</a>

             </tr>
@endforeach
                </table>
            </div>
        </div>
          <!-- partial -->
@include('admin.script')
  </body>
</html>
