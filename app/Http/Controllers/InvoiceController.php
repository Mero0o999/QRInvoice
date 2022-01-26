<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
  
      /**
       * Display a listing of the resource.
       *
       * @return \Illuminate\Http\Response
       */
      public function index()
      {
          $invoices = Invoice::latest()->paginate(5);
          return view('invoices.index',compact('invoices'))
              ->with('i', (request()->input('page', 1) - 1) * 5);
      }

      /**
       * Show the form for creating a new resource.
       *
       * @return \Illuminate\Http\Response
       */
      public function create()
      {
          return view('invoices.create');
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
      
          Invoice::create($request->all());
       
          return redirect()->route('invoices.index')
                          ->with('success','Invoice created successfully.');
      }
       
      /**
       * Display the specified resource.
       *
       * @param  \App\Invoice  $invoice
       * @return \Illuminate\Http\Response
       */
      public function show(Invoice $invoice)
      {
          return view('invoices.show',compact('invoice'));
      } 
       
      /**
       * Show the form for editing the specified resource.
       *
       * @param  \App\Invoice  $invoice
       * @return \Illuminate\Http\Response
       */
      public function edit(Invoice $invoice)
      {
          return view('invoices.edit',compact('invoice'));
      }
      
      /**
       * Update the specified resource in storage.
       *
       * @param  \Illuminate\Http\Request  $request
       * @param  \App\Invoice  $invoice
       * @return \Illuminate\Http\Response
       */
      public function update(Request $request, Invoice $invoice)
      {
          $request->validate([
              'name' => 'required',
              'price' => 'required',
          ]);
      
          $invoice->update($request->all());
      
          return redirect()->route('invoices.index')
                          ->with('success','Invoice updated successfully');
      }
      
      /**
       * Remove the specified resource from storage.
       *
       * @param  \App\Invoice  $invoice
       * @return \Illuminate\Http\Response
       */
      public function destroy(Invoice $invoice)
      {
          $invoice->delete();
      
          return redirect()->route('invoices.index')
                          ->with('success','Invoice deleted successfully');
      }
  }