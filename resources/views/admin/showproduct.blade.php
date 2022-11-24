
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

        <div class="container-fluid page-body-wrapper">
            <div class="container" align="center">

                @if (Session::get('successful'))
                <div class="alert alert-success">
                    {{Session::get('successful')}}
                </div>
                @endif


                @if (Session::get('failed'))
                <div class="alert alert-danger">
                    {{Session::get('failed')}}
                </div>
                @endif

                <h1 style="font-size:25px;padding-bottom:20px;">Show Product</h1>
                <table class="table table-stripped text-white ">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Price</th>
                            <th>Description</th>
                            <th>Quantity</th>
                            <th>Images</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($data as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td>{{$product->title}}</td>
                            <td>{{$product->price}}</td>
                            <td>{{$product->description}}</td>
                            <td>{{$product->quantity}}</td>
                            <td><img style="height: 100px;width:100px" src="/productimage/{{$product->image}}"></td>
                            <td><a class="btn btn-success" href="{{url('updateview')}}/{{$product->id}}">Update</td>
                            <td><a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete')" href="{{url('/deleteproduct')}}/{{$product->id}}">Delete</td>


                        </tr>

                        @endforeach

                    </tbody>
            </table>



            </div>
        </div>
        <!-- partial -->
@include('admin.script')
  </body>
</html>
