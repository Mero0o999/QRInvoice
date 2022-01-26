<?php
  
  namespace App\Http\Controllers;
     
  use App\Models\Product;
  use App\Exports\ProductExport;
  use App\Imports\ProductImport;



  use Illuminate\Http\Request;
  use Maatwebsite\Excel\Facades\Excel;

    
  class ProductController extends Controller
  {


      /**
    * @return \Illuminate\Support\Collection
    */
    public function importExportView()
    {
       return view('products.index');
    }
     
    /**
    * @return \Illuminate\Support\Collection
    */
    public function export() 
    {
        return Excel::download(new ProductExport, 'products.xlsx');
    }
     
    /**
    * @return \Illuminate\Support\Collection
    */
    public function import() 
    {
        Excel::import(new ProductImport,request()->file('file'));
             
        return back();
    }
    public function findPrice(Request $request){
	
		//it will get price if its id match with product id
		$p=Product::select('price')->where('id',$request->id)->first();
		
    	return response()->json($p);
	}

    public function index1()
    {
        $products = Product::All();
        return view('dashboard',compact('products'));
          //   ->with('i', (request()->input('page', 1) - 1) * 5);
    }


      /**
       * Display a listing of the resource.
       *
       * @return \Illuminate\Http\Response
       */
      public function index()
      {
          $products = Product::latest()->paginate(5);
          return view('products.index',compact('products'))
              ->with('i', (request()->input('page', 1) - 1) * 5);
      }

      /**
       * Show the form for creating a new resource.
       *
       * @return \Illuminate\Http\Response
       */
      public function create()
      {
          return view('products.create');
      }
      
      /**
       * Store a newly created resource in storage.
       *
       * @param  \Illuminate\Http\Request  $request
       * @return \Illuminate\Http\Response
       */
      public function store(Request $request)
      {
          $request->validate([
              'name' => 'required',
              'price' => 'required',
          ]);
      
          Product::create($request->all());
       
          return redirect()->route('products.index')
                          ->with('success','Product created successfully.');
      }
       
      /**
       * Display the specified resource.
       *
       * @param  \App\Product  $product
       * @return \Illuminate\Http\Response
       */
      public function show(Product $product)
      {
          return view('products.show',compact('product'));
      } 
       
      /**
       * Show the form for editing the specified resource.
       *
       * @param  \App\Product  $product
       * @return \Illuminate\Http\Response
       */
      public function edit(Product $product)
      {
          return view('products.edit',compact('product'));
      }
      
      /**
       * Update the specified resource in storage.
       *
       * @param  \Illuminate\Http\Request  $request
       * @param  \App\Product  $product
       * @return \Illuminate\Http\Response
       */
      public function update(Request $request, Product $product)
      {
          $request->validate([
              'name' => 'required',
              'price' => 'required',
          ]);
      
          $product->update($request->all());
      
          return redirect()->route('products.index')
                          ->with('success','Product updated successfully');
      }
      
      /**
       * Remove the specified resource from storage.
       *
       * @param  \App\Product  $product
       * @return \Illuminate\Http\Response
       */
      public function destroy(Product $product)
      {
          $product->delete();
      
          return redirect()->route('products.index')
                          ->with('success','Product deleted successfully');
      }
  }