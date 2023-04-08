@extends('layouts.master')

@section('content')

    <div class="header bg-blue pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <h6 class="h2 text-white d-inline-block mb-5">Debt Reduction Calculator</h6>


            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="card">
            <div class="card-header">Debt Reduction Calculator</div>
            <div class="card-body">
                <div class="row mb-2">
                    @if(file_exists('assets/admin/uploads/_FL_1636714337.mp4'))
                        <div class="col-md-12">
                            <video controls style="height: 300px; width: 100%">
                                <source src="{{ asset('assets/admin/uploads/_FL_1636714337.mp4') }}" type="video/mp4">
                            </video>
                        </div>
                    @endif
                </div>
                <form action="{{ route('reduction.debt.post') }}" method="POST" id="debtForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label for="example-text-input"
                                       class="col-md-4 col-form-label form-control-label">Balance
                                    Date:</label>
                                <div class="col-md-8">
                                    <input class="form-control" type="date" name="date" required id="example-date-input">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-9">
                            <h4>Creditor Information Table</h4>
                        </div>
                        <div class="col-md-3 text-right">
                            <button class="btn btn-blue text-white text-right btn-add" data-task="more">Add New Row (Max 10)</button>
                        </div>
                    </div>
                    <table class="table fixed" id="debtTable">
                        <thead class="bg-blue text-white">
                        <tr class="text-center">
                            <th>Row</th>
                            <th>Creditor</th>
                            <th>Balance</th>
                            <th>Interest</th>
                            <th>Payment</th>
                            <th>Order</th>
                            <th>Interest-Only</th>
                            <th></th>
                        </tr>

                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td><input type="text"   class="form-control input-debt debt0" name="debt_name[]" required></td>
                            <td><input type="number" class="form-control input-balance balance0" name="balance[]" data-row="0" min="1" step="0.01" required></td>
                            <td><input type="number" class="form-control input-interest interest0" name="interest[]"  data-row="0"  min="0"  step="0.01" required></td>
                            <td><input type="number" class="form-control input-payment payment0" name="payment[]"  data-row="0"  min="1"  step="0.01" required></td>
                            <td><input type="number" class="form-control input-order order0" name="order[]"   data-row="0"  min="1" max="10" required></td>
                            <td><input type="number" class="form-control input-cal cal0" name="cal_int[]"  data-row="0" disabled></td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>

                    <div class="row mt-4">
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="example-text-input"
                                       class="col-md-4 col-form-label form-control-label">Total Balance</label>
                                <div class="col-md-8">
                                    <input type="number" class="form-control total-balance" name="total_balance" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="example-text-input"
                                       class="col-md-4 col-form-label form-control-label">Total Payment</label>
                                <div class="col-md-8">
                                    <input type="number" disabled class="form-control total-payment" name="total_payment">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="example-text-input"
                                       class="col-md-4 col-form-label form-control-label">Monthly Payment</label>
                                <div class="col-md-8">
                                    <input type="number" class="form-control monthly-payment" name="monthly_payment" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="example-text-input"
                                       class="col-md-4 col-form-label form-control-label">Initial Snowball</label>
                                <div class="col-md-8">
                                    <input type="number" class="form-control snowball" name="snowball"  readonly required>
                                    <span class="text-danger sp-snow-ball"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="example-text-input"
                                       class="col-md-4 col-form-label form-control-label">Strategy</label>
                                <div class="col-md-8">
                                    <select name="cal_type" id="type" class="form-control">
                                        <option value="snow_ball">Snowball (Lowest Balance First)</option>
                                        <option value="avalanche">Avalanche (Highest Interest First)</option>
                                        <option value="order">By Order</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <button type="submit" class="btn btn-yellow text-white w-100">Calculate</button>
                            </div>
                        </div>

                    </div>
                </form>
                <div class="row">
                    <div class="col-md-12 attach-debt">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        $(document).ready(function(){

            var maxField = 10; //Input fields increment limitation
            var addButton = $('.btn-add'); //Add button selector
            var row_count = 1; //Initial field counter is 1
            $(addButton).click(function(e){
                e.preventDefault();
                var fieldHTML = '<tr> <td>'+(row_count+1)+'</td> <td><input type="text" class="form-control input-debt debt'+(row_count)+'" name="debt_name[]" required></td> <td><input type="number" class="form-control input-balance balance'+(row_count)+'" name="balance[]" data-row="'+(row_count)+'" min="1" step="0.01" required></td> <td><input type="number" class="form-control input-interest interest'+(row_count)+'" name="interest[]" data-row="'+(row_count)+'" min="0" step="0.01" required></td> <td><input type="number" class="form-control input-payment payment'+(row_count)+'" name="payment[]" data-row="'+(row_count)+'" min="1" step="0.01" required></td> <td><input type="number" class="form-control input-order order'+(row_count)+'" name="order[]" data-row="'+(row_count)+'" min="1" max="10" required></td> <td><input type="number" class="form-control input-cal cal'+(row_count)+'" name="cal_int[]" data-row="'+(row_count)+'" disabled></td><td> <a href="javascript:void(0);" class="remove_button mb-3 float-right"><img src="{{ asset('assets/img/remove-icon.png') }}"/></a></td> </tr>'
                if(row_count < maxField){
                    row_count++; //Increment field counter
                    $("#debtTable").append(fieldHTML);
                }

            });



            var timer = null;
            $(document).on('keyup', '.input-balance', function(){
                let balance = $(this).val();
                let row = $(this).data('row');
                let rate = $('.interest'+row).val();
                var interest;
                clearTimeout(timer);
                timer = setTimeout(function() {

                    var sum = 0;
                    //iterate through each textboxes and add the values
                    $(".input-balance").each(function () {

                        //add only if the value is number
                        if (!isNaN(this.value) && this.value.length != 0) {
                            sum += parseFloat(this.value);
                        }

                    });
                    //.toFixed() method will roundoff the final sum to 2 decimal places
                    $(".total-balance").val(sum.toFixed(2));

                    if(balance && rate){
                        interest = (rate/100)/12*balance;
                        interest = interest.toFixed(2);
                    }else{
                        interest = '';
                    }
                    $('.cal'+row).val(interest);
                }, 1000); //W
            });

            var timer2 = null;
            $(document).on('keyup', '.input-interest', function(){
                let rate = $(this).val();
                let row = $(this).data('row');
                let balance = $('.balance'+row).val();
                var interest;
                clearTimeout(timer2);
                timer2 = setTimeout(function() {
                    if(balance && rate){
                        interest = (rate/100)/12*balance;
                        interest = interest.toFixed(2);
                    }else{
                        interest = '';
                    }
                    $('.cal'+row).val(interest);
                }, 1000); //W
            });

            var timer3 = null;
            $(document).on('keyup', '.input-payment', function(){

                clearTimeout(timer3);
                timer3 = setTimeout(function() {
                    var sum = 0;
                    //iterate through each textboxes and add the values
                    $(".input-payment").each(function () {

                        //add only if the value is number
                        if (!isNaN(this.value) && this.value.length != 0) {
                            sum += parseFloat(this.value);
                        }

                    });

                    $(".total-payment").val(sum.toFixed(2));
                    let balance = $(".total-payment").val();
                    let monthly = $('.monthly-payment').val();
                    let monthly_payment = monthly - balance;
                    if(monthly_payment > 0 ){
                        $('.sp-snow-ball').text('');
                        $(".snowball").val(monthly_payment);
                    }else{
                        $(".snowball").val('');
                        $('.sp-snow-ball').text('Need to Increase Monthly Payment');
                    }
                    //
                }, 1000); //W
            });

            var timer4 = null;
            $(document).on('keyup', '.monthly-payment', function(){
                let balance = $(".total-payment").val();
                let monthly = $(this).val();
                clearTimeout(timer4);
                timer4 = setTimeout(function() {
                    let monthly_payment = monthly - balance;
                    if(monthly_payment > 0 ){
                        $('.sp-snow-ball').text('');
                        $(".snowball").val(monthly_payment);
                    }else{
                        $(".snowball").val('');
                        $('.sp-snow-ball').text('Need to Increase Monthly Payment');
                    }

                }, 1000); //
            });
            // var timer2 = null;
            // $(document).on('click', '.input-interest', function(){
            //     let text = $(this).val();
            //     let row = $(this).data('row');
            //     clearTimeout(timer2);
            //     timer = setTimeout(function() {
            //         alert(row);
            //     }, 1000); //W
            // });

            $('#debtTable').on('click', '.remove_button', function(e){
                e.preventDefault();
                $(this).parent().parent('tr').remove(); //Remove field html
                row_count--; //Decrement field counter
            });
            //hang on event of form with id=myform
            $("#debtForm").submit(function(e) {
                e.preventDefault();

                $.ajax({
                    url:"{{route('reduction.debt.post')}}",
                    method:"POST",
                    data:$('#debtForm').serialize(),
                    type:'json',
                    success: function(resp){
                        $('.attach-debt').html(resp.result);
                    },
                    error: function(error){
                        console.log(error)
                    }

                });

            });

        });
    </script>
@endsection
