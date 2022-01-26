@extends('invoices.layout')
 
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Invoices</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('invoices.create') }}"> Create New Invoice</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="card-body">
            <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="form-control">
                <br>
                <button class="btn btn-success">Import Invoice Data</button>
                <a class="btn btn-warning" href="{{ route('export') }}">Export Invoice Data</a>
            </form>
        </div>
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Price</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($invoices as $product)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->price }}</td>
            <td>
                <form action="{{ route('invoices.destroy',$product->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('invoices.show',$product->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('invoices.edit',$product->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $invoices->links() !!}
      
@endsection