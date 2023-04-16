<div>
    <h3>Selected Strategy: {{ ucwords(str_replace('_', ' ', $type)) }}</h3>
    <table class="table">
        <thead class="bg-blue text-white">
            <tr>
                <th>Creditor</th>
                <th>Original Balance</th>
                <th>Interest Paid</th>
                <th>Months To Pay Off</th>
                <th>Month Paid Off</th>
                <th>Action</th>
            </tr>

        </thead>
        <tbody>
            @foreach ($final_data as $index => $data)
                <tr data-toggle="collapse" data-target="#demo{{ $data['no_of_months'] }}" class="accordion-toggle">
                    <td>{{ $index }}</td>
                    <td>{{ $data['balance'] }}</td>
                    <td>{{ $data['interest_paid'] }}</td>
                    <td>{{ $data['no_of_months'] }}</td>
                    <td>{{ $data['calculate_months']->format('M-Y') }}</td>
                    <td><button class="btn btn-yellow text-white w-100">Monthly Breakdown</button></td>
                    {{-- {{ dd($data) }} --}}
                </tr>
                <tr>
                    <td colspan="12" class="hiddenRow" style="padding: 0 !important;">
                        <div class="accordian-body collapse" id="demo{{ $data['no_of_months'] }}">
                            <table class="table table-striped">
                                <thead class="bg-blue text-white">
                                    <tr>
                                        <th>Month</th>
                                        <th>Balance</th>
                                        <th>Amount Paid</th>
                                        <th>Interest</th>
                                        <th>Remaining Balance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['all_payments'] as $key => $payment)
                                        <tr class="bg-light">
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $payment['balance'] }}</td>
                                            <td>{{ $payment['amount_paid'] }}</td>
                                            <td>{{ $payment['interest'] }}</td>
                                            <td>{{ $payment['remaining_balance'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br> <br>
</div>
