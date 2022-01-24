<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>


    </x-slot>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

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
    <script src="//code.jquery.com/jquery-2.0.2.min.js"></script>

    <script>
    $('.ui.dropdown').dropdown();

    function totalIt() {
        var total = 0;
        $(".subtotal").each(function() {
            var val = this.value;
            total += val == "" || isNaN(val) ? 0 : parseInt(val);
        });
        $("#total").val(total);
    }
    $(function() {
        var $to_clone = $('.tr_clone').first().clone();

        $("table").on('click', 'input.tr_clone_add', function() {
            var $tr = $(this).closest('.tr_clone');
            var $clone = $to_clone.clone();
            $clone.find(':text').val('');
            $tr.after($clone);
        });
        $("table").on('click', 'input.tr_clone_remove', function() {
            var $tr = $(this).closest('.tr_clone');
            if ($tr.index() > 1) $tr.remove(); // leave the first
            totalIt();
        });

        $(document).on("keyup", ".quantity, .price", function() {
            var $row = $(this).closest("tr"),
                prce = parseInt($row.find('.price').val()),
                qnty = parseInt($row.find('.quantity').val()),
                subTotal = prce * qnty;
            $row.find('.subtotal').val(isNaN(subTotal) ? 0 : subTotal);
            totalIt()
        });

    });
    $(document).ready(function() {

        $('.vehicle-type').on('change', function() {
            $('.price-input')
                .val(
                    $(this).find(':selected').data('price')
                );
        });
        $('select.material-price').change(function() {
            var materialValue = $(this).find(':selected').data('price');
            $(this).next('.material-total').val(materialValue);
        });


        document.getElementById("submit").onclick = function() {

            // document.getElementById("tab_logic").style.display="block";

            var table = document.getElementById("tab_logic");
            var row = table.insertRow(-1);
            var t = row.insertCell(0);
            var date = row.insertCell(1);
            var desc = row.insertCell(2);
            var amt = row.insertCell(3);
            var total = row.insertCell(4);

            date.innerHTML = document.getElementById("name").value;
            desc.innerHTML = document.getElementById("price").value;
            amt.innerHTML = document.getElementById("qty").value;
            total.innerHTML = document.getElementById("totall").value;

            // var name = document.getElementById("name").value;
            // var price = document.getElementById("price").value;
            // var qty = document.getElementById("qty").value;
            // t.innerHTML = document.getElementById("name").value;


            //         var markup =     "<tr id='addr0'> <td>1</td><td><input name='product[]' id='product' class='form-control productname' /></td>"+
            //                     "<td><input type='number' name='qty[]' placeholder='Enter Qty' class='form-control qty'step='0' min='0' /></td>"+
            //                     "<td><input type='number' id='price' name='price[]' placeholder='Enter Unit Price' value='      desc.innerHTML = document.getElementById('price').value;'"+
            //                         " class='form-control   price' step='0.00' min='0' /></td><td><input type='number' name='total[]' placeholder='0.00' class='form-control total'"+
            //                           " readonly /></td><td><button id='add_row' class='btn btn-default pull-left'>+</button></td><td><button id='delete_row' class='pull-right btn btn-default'>-</button>"+
            //                         "</td></tr><tr id='addr1'></tr>";
            // $("#table").append(markup);

            // var table =   '<tr><td>'+ count +'</td><td>'+ name + '</td><td>' + qty + '</td><td>' + price + '</td><td><strong><input type="hidden" id="total" value="'+total+'">' +total+ '</strong></td></tr>';
            //    $('#new').append(table);
            //    coubt++;
            return false;
        }
        //   $(document).on('change', '.productname', function() {
        //       var prod_id = $(this).val();

        //       var a = $(this).parent();
        //       console.log(prod_id);
        //       var op = "";
        //       $.ajax({
        //           type: 'get',
        //           url: '{!!URL::to('
        //           findPrice ')!!}',
        //           data: {
        //               'id': prod_id
        //           },
        //           dataType: 'json', //return data will be json
        //           success: function(data) {
        //               console.log("price");
        //               console.log(data.price);

        //               // here price is coloumn name in products table data.coln name

        //               document.getElementById("price").value = data.price;
        //               var x = data.price;
        //               console.log(x);

        //           },
        //           error: function() {}
        //       });
        //   });
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
                var qty = $(this).find('.qtyy').val();
                var price = $(this).find('.pricee').val();
                $(this).find('.totall').val(qty * price);
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

                        </tr>

                    </thead>
                    <tbody id="table">
                        <tr id='addr0'>
                            <td>1</td>
                            <td>
                                <div class="ui two column grid">
                                    <select id='name' class="form-control prod">
                                        <option value="0" disabled="true" selected="true">-Select-</option>
                                        @foreach ($products as $product)
                                        <option id='{{$product->id}}' value='{{$product->name}}'
                                            data-price='{{$product->price}}' class="vegitable custom-select">
                                            {{$product->name}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                            <td><input type="number" name='qty[]' placeholder='Enter Qty' class="form-control qty"
                                    step="0" min="0" /></td>
                            <td><input type="number" name='price[]' placeholder='Enter Unit Price'
                                    class="form-control price" step="0.00" min="0" /></td>
                            <td><input type="number" name='total[]' placeholder='0.00' class="form-control total"
                                    readonly /></td>
                        </tr>
                        <tr id='addr1'></tr>

                    </tbody>
                </table>
                <input type="text" class="prod_price">
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

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

            <form role="form">
                <div class="form-group vehicle-type">
                    <label for="Vehicle"> Product Name:</label>
                    <select id='name' class="form-control prod">
                        <option value="0" disabled="true" selected="true">-Select-</option>
                        @foreach ($products as $product)
                        <option id='{{$product->id}}' value='{{$product->name}}' data-price='{{$product->price}}'
                            class="vegitable custom-select">
                            {{$product->name}}
                        </option>
                        @endforeach
                    </select>

                </div>
                <div class="form-group">
                    <label for="price"> Price</label>
                    <input id='price' type="text" class="form-control pricee price-input" readonly>
                </div>
                <div class="form-group">
                    <label for="qty"> QTY</label>
                    <input id='qty' type="number" class="form-control qtyy">
                </div>
                <div class="form-group">
                    <label for="totall"> totall</label>
                    <input id='totall' type="number" class="form-control totall">
                </div>

                <p>
                    <input type="button" id="submit" value="Submit">
                </p>
                <table id="tab_logic"></table>
            </form>

        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <table width="100%" border="0">
        <thead>
            <tr>
                <th>Item</th>
                <th>Quantity</th>
                <th>U$ Price</th>
                <th>Subtotal</th>
                <th>Add</th>
                <th>Remove</th>
            </tr>
            <tr class="tr_clone">
                <td>
                    <div class="form-group vehicle-type">
                        <select id='name' class="form-control prod material-price">
                            <option value="0" disabled="true" selected="true">-Select-</option>
                            @foreach ($products as $product)
                            <option id='{{$product->id}}' value='{{$product->name}}' data-price='{{$product->price}}'
                                class="vegitable custom-select">
                                {{$product->name}}
                            </option>
                            @endforeach
                        </select>

                    </div>
                </td>
                <td><input type="text" size="5" maxlength="5" name="qtd"
                        class="quantity text ui-widget-content ui-corner-all"></td>
                <td><input type="text" size="10" maxlength="10" name="price"
                        class="price price-input material-total text ui-widget-content ui-corner-all"></td>
                <td><input type="text" size="10" maxlength="10" name="subtotal"
                        class="subtotal text ui-widget-content ui-corner-all"></td>
                <td><input type="button" name="add" value="Add" class="tr_clone_add"></td>
                <td><input type="button" name="remove" value="Remove" class="tr_clone_remove"></td>
            </tr>
    </table>
    <input type="text" readonly id="total" />


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <div class="container">
        <div class="row">
            <select class="material-price">
                <option data-price="100000" value="10">Material A</option>
                <option data-price="400000" value="20>">Material B</option>
                <option data-price="500000" value="30">Material C</option>
            </select>
            <input type="text" class="material-total" readonly />
        </div>

        <div class="row">
            <select id='name' class="form-control  material-price prod">
                <option value="0" disabled="true" selected="true">-Select-</option>
                @foreach ($products as $product)
                <option id='{{$product->id}}' value='{{$product->name}}' data-price='{{$product->price}}'
                    class="vegitable custom-select">
                    {{$product->name}}
                </option>
                @endforeach
            </select>
            <input type="text" class="material-total" readonly />
        </div>

</x-app-layout>