
<!DOCTYPE html>
<html lang="en">
  <head>
@include('admin.css')

<style>

    .title{
        font-size: 25px;
        color: white;
        padding-top: 25px;
    }
</style>
  </head>
  <body>
@include('admin.sidebar')
@include('admin.navbar')


        <div class="container-fluid page-body-wrapper">
            <div class="container" align='center'>
            <h1 class="title">Add Product</h1>

            @if (Session::get('fail'))
            <div class="alert alert-danger">
                {{Session::get('fail')}}
            </div>
        @endif


        @if (Session::get('success'))
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
        @endif

            <form class="form mt-4" action="{{url('uploadproduct')}}" method="post" enctype="multipart/form-data">

                @csrf


            <div class="form-group">
                <label>Product title</label>
                <input type="text" name="title" class="form-control text-black"  placeholder="Please Enter">
        </div>

        <div class="form-group">
            <label>Price</label>
            <input type="number" name="price" class="form-control text-black"  placeholder="Please Enter">
    </div>

    <div class="form-group">
        <label>Description</label>
        <input type="text" name="description" class="form-control text-black"  placeholder="Please Enter">
</div>

<div class="form-group">
    <label>Quantity</label>
    <input type="number" name="quantity" class="form-control text-black" placeholder="Please Enter">
</div>

<div class="form-group">
    <input type="file" name="file">
</div>

<div class="form-group">
    <input type="submit" class="btn btn-success">
</div>
        </form>
        </div>
        </div>


@include('admin.script')
  </body>
</html>
