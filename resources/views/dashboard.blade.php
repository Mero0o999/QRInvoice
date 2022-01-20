<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>


    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script>
    $(document).ready(function() {
        var i = 1;
        $("#add_row").click(function() {
            b = i - 1;
            $('#addr' + i).html($('#addr' + b).html()).find('td:first-child').html(i + 1);
            $('#tab_logic').append('<tr id="addr' + (i + 1) + '"></tr>');
            i++;
        });
        $("#delete_row").click(function() {
            if (i > 1) {
                $("#addr" + (i - 1)).html('');
                i--;
            }
            calc();
        });

        $('#tab_logic tbody').on('keyup change', function() {
            calc();
        });
        $('#tax').on('keyup change', function() {
            calc_total();
        });


    });

    function calc() {
        $('#tab_logic tbody tr').each(function(i, element) {
            var html = $(this).html();
            if (html != '') {
                var qty = $(this).find('.qty').val();
                var price = $(this).find('.price').val();
                $(this).find('.total').val(qty * price);

                calc_total();
            }
        });
    }

    function calc_total() {
        total = 0;
        $('.total').each(function() {
            total += parseInt($(this).val());
        });
        $('#sub_total').val(total.toFixed(2));
        tax_sum = total / 100 * $('#tax').val();
        $('#tax_amount').val(tax_sum.toFixed(2));
        $('#total_amount').val((tax_sum + total).toFixed(2));
    }
    </script>
    <!------ Include the above in your HEAD tag ---------->
    <br>
    <div class="container">
        <div class="row clearfix">
            <div class="col-md-9">
                <table class="table table-bordered table-hover" id="tab_logic">
                    <thead>
                        <tr>
                            <th class="text-center"> # </th>
                            <th class="text-center"> Product </th>
                            <th class="text-center"> Qty </th>
                            <th class="text-center"> Price </th>
                            <th class="text-center"> Total </th>
                            <th class="text-center"> ADD </th>
                            <th class="text-center"> Delete </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id='addr0'>
                            <td>1</td>
                            <td> <select name='product[]' id="product" class="form-control">
                                    @foreach ($products as $product)
                                    <option id='{{$product->id}}' value='{{$product->name}}'
                                        class="vegitable custom-select">
                                        {{$product->name}}
                                    </option>
                                    @endforeach
                                </select></td>
                            <td><input type="number" name='qty[]' placeholder='Enter Qty' class="form-control qty"
                                    step="0" min="0" /></td>
                            <td><input type="number" name='price[]' placeholder='Enter Unit Price'
                                    class="form-control price" step="0.00" min="0" /></td>

                            <td><input type="number" name='total[]' placeholder='0.00' class="form-control total"
                                    readonly /></td>
                            <td> <button id="add_row" class="btn btn-default pull-left">+</button>
                            </td>
                            <td> <button id='delete_row' class="pull-right btn btn-default">-</button>

                            </td>


                        </tr>
                        <tr id='addr1'></tr>
                    </tbody>
                </table>
            </div>
            <div class="pull-right col-md-3">
                <table class="table table-bordered table-hover" id="tab_logic_total">
                    <tbody>
                        <tr>
                            <th class="text-center">Sub Total</th>
                            <td class="text-center"><input type="number" name='sub_total' placeholder='0.00'
                                    class="form-control" id="sub_total" readonly /></td>
                        </tr>
                        <tr>
                            <th class="text-center">Tax</th>
                            <td class="text-center">
                                <div class="input-group mb-2 mb-sm-0">
                                    <input type="number" class="form-control" id="tax" placeholder="0">
                                    <div class="input-group-addon">%</div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center">Tax Amount</th>
                            <td class="text-center"><input type="number" name='tax_amount' id="tax_amount"
                                    placeholder='0.00' class="form-control" readonly /></td>
                        </tr>
                        <tr>
                            <th class="text-center">Grand Total</th>
                            <td class="text-center"><input type="number" name='total_amount' id="total_amount"
                                    placeholder='0.00' class="form-control" readonly /></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- <div class="row clearfix">
    <div class="col-md-12">
      <button id="add_row" class="btn btn-default pull-left">Add Row</button>
      <button id='delete_row' class="pull-right btn btn-default">Delete Row</button>
    </div>
  </div> -->
        <div class="row clearfix" style="margin-top:20px">

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script>
            $(document).ready(function() {
            $('#category').on('change', function() {
               var ID = $(this).val();
               if(ID) {
                   $.ajax({
                       url: '/getPrice/'+ID,
                       type: "GET",
                       data : {"_token":"{{ csrf_token() }}"},
                       dataType: "json",
                       success:function(data)
                       {
                         if(data){
                            $('#price').empty();
                            $('#price').append('<option hidden>Choose Producr</option>'); 
                            $.each(data, function(key, course){
                                $('select[name="price"]').append('<option value="'+ key +'">' + course.name+ '</option>');
                            });
                        }else{
                            $('#course').empty();
                        }
                     }
                   });
               }else{
                 $('#course').empty();
               }
            });
            });
        </script>
</x-app-layout>