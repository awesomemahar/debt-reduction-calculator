<div>
    <h3>Selected Strategy: {{ucwords(str_replace('_',' ',$type))}}</h3>
    <table class="table">
        <thead class="bg-blue text-white">
        <tr>
            <th>Creditor</th>
            <th>Original Balance</th>
            <th>Interest Paid</th>
            <th>Months To Pay Off</th>
            <th>Month Paid Off</th>
        </tr>

        </thead>
        <tbody>
        @foreach($final_data as $index=> $data)
            <tr>
                <td>{{ $index }}</td>
                <td>{{ $data['balance'] }}</td>
                <td>{{ $data['interest_paid'] }}</td>
                <td>{{ $data['no_of_months'] }}</td>
                <td>{{ $data['calculate_months']->format('M-Y') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <br> <br>
{{--    <h4>Monthly Payments</h4>--}}
{{--    <table class="table table-striped table-hover table-reflow">--}}
{{--        @foreach($final_data as $index=> $data)--}}
{{--            <th>--}}
{{--                {{ ucwords($index) }}--}}
{{--            </th>--}}
{{--        @endforeach--}}
{{--        <?php--}}
{{--            $rows_count =  count($final_data);--}}
{{--            $count = 1;--}}
{{--            $check = array_key_first($final_data);--}}
{{--            $unique_val = array();--}}
{{--            ?>--}}
{{--        @foreach($final_data as $main_index=>$data)--}}
{{--            <?php--}}
{{--                array_push($unique_val, $main_index);--}}
{{--                ?>--}}
{{--            @foreach($data['all_payments'] as $index=> $row )--}}
{{--                <tr>--}}
{{--                    @for($counter = 1; $counter <= $rows_count; $counter++)--}}
{{--                        <td class="{{ $check }}">--}}
{{--                            {{ $row['amount_paid'] }}--}}
{{--                            {{ (count($unique_val)== $counter ? number_format($row['amount_paid'],2): '') }}--}}
{{--                            {{ (in_array($counter, range(1,count($unique_val))) ? number_format($row['amount_paid'],2): '') }}--}}
{{--                        </td>--}}
{{--                    @endfor--}}
{{--                </tr>--}}
{{--            @endforeach--}}
{{--                <?php--}}
{{--                $check = $main_index;--}}
{{--                ?>--}}
{{--        @endforeach--}}
{{--    </table>--}}
</div>

