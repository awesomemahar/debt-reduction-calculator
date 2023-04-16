<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class DebtRedcutionController extends Controller
{
    //
    public function reduction(Request $request)
    {
        # code...
        $page = 'Debt Reduction Calculator';
        return view('debt_reduction', compact('page'));
    }
    public function reductionPost(Request $request)
    {
        $resp = [];
        $resp['error'] = true;
        $start_date = $request->get('date');
        $creditor = $request->get('debt_name');
        $balances = $request->get('balance');
        $interests = $request->get('interest');
        $base_payments = $request->get('payment');
        $order = $request->get('order');
        $total_creditors = count($balances);
        $monthly_payment = $request->get('monthly_payment');
        $initial_snowball = $request->get('snowball');
        $type = $request->get('cal_type');
        $data = array();
        $sub_data = array();
        $months_to_payoff_array = array();
        if ($type == 'avalanche') {
            $reverse_interest = $interests;
            rsort($reverse_interest);
            foreach ($reverse_interest as $value) {
                $key = array_search($value, $interests);
                $sub_data['creditor'] = $creditor[$key];
                $sub_data['balance'] = $balances[$key];
                $sub_data['interest'] = $interests[$key];
                $sub_data['payment'] = $base_payments[$key];
                $sub_data['order'] = $order[$key];
                array_push($data, $sub_data);
            }
        } elseif ($type == 'order') {
            $sorted_order = $order;
            sort($sorted_order);
            foreach ($sorted_order as $value) {
                $key = array_search($value, $order);
                $sub_data['creditor'] = $creditor[$key];
                $sub_data['balance'] = $balances[$key];
                $sub_data['interest'] = $interests[$key];
                $sub_data['payment'] = $base_payments[$key];
                $sub_data['order'] = $order[$key];
                array_push($data, $sub_data);
            }
        } elseif ($type == 'snow_ball') {
            $duplicate = $balances;
            $sorted_balance = $balances;
            sort($sorted_balance);
            foreach ($sorted_balance as $value) {
                $key = array_search($value, $duplicate);
                $duplicate[$key] = 'done';
                $sub_data['creditor'] = $creditor[$key];
                $sub_data['balance'] = $balances[$key];
                $sub_data['interest'] = $interests[$key];
                $sub_data['payment'] = $base_payments[$key];
                $sub_data['order'] = $order[$key];
                array_push($data, $sub_data);
            }
        }
        //dd($duplicate,$data);

        if ($total_creditors > 0) {
            $final_data = array();
            $amount_to_pay = 0;
            $last_number_of_months = 0;
            $new_snowball = 0;
            foreach ($data as $index => $debt) {
                $interest_paid = 0;
                $creditor_all_data = array();
                $all_payments = array();
                $creditor_payment = array();
                $rate = (float)$debt['interest'];
                $remaining_balance = (int)$debt['balance'];
                $payment = (int)$debt['payment'];
                if ($index == 0) {
                    $monthly_payment = (int)($payment + $initial_snowball);
                } else {
                    $monthly_payment = (int)($payment + $initial_snowball);
                    for ($i = 0; $i < $index; $i++)
                        $monthly_payment += $data[$i]['payment'];
                    for ($i = 0; $i < $last_number_of_months; $i++) {
                        if ($i == $last_number_of_months - 1 && $amount_to_pay != 0) {
                            $creditor_payment['balance'] = $remaining_balance;
                            $per_month_interest = $this->calculate_interest($remaining_balance, $rate);
                            $interest_paid += $per_month_interest;
                            $payment = $monthly_payment - $amount_to_pay;
                            $remaining_balance = $this->pay_amount($remaining_balance, $payment, $rate);
                            $creditor_payment['amount_paid'] = $payment;
                            $creditor_payment['interest'] = $per_month_interest;
                            $creditor_payment['remaining_balance'] = $remaining_balance;
                            array_push($all_payments, $creditor_payment);
                        } else {
                            $creditor_payment['balance'] = $remaining_balance;
                            $per_month_interest = $this->calculate_interest($remaining_balance, $rate);
                            $interest_paid += $per_month_interest;
                            $remaining_balance = $this->pay_amount($remaining_balance, $payment, $rate);
                            $creditor_payment['amount_paid'] = $payment;
                            $creditor_payment['interest'] = $per_month_interest;
                            $creditor_payment['remaining_balance'] = $remaining_balance;
                            array_push($all_payments, $creditor_payment);
                        }
                    }
                }

                do {
                    $creditor_payment['balance'] = $remaining_balance;
                    if ($monthly_payment < $remaining_balance) {
                        $interest = $this->calculate_interest($remaining_balance, $rate);
                        $remaining_balance = $this->pay_amount($remaining_balance, $monthly_payment, $rate);
                        $creditor_payment['amount_paid'] = $monthly_payment;
                    } else {
                        $interest = $this->calculate_interest($remaining_balance, $rate);
                        $amount_to_pay = $remaining_balance + $interest;
                        $remaining_balance = $this->pay_amount($remaining_balance, $amount_to_pay, $rate);
                        $creditor_payment['amount_paid'] = $amount_to_pay;
                    }

                    $interest_paid += $interest;
                    $creditor_payment['interest'] = $interest;
                    $creditor_payment['remaining_balance'] = $remaining_balance;
                    array_push($all_payments, $creditor_payment);
                } while ($remaining_balance > 0);
                //dd($all_payments, $interest_paid);
                $creditor_all_data['balance'] = $debt['balance'];
                $creditor_all_data['interest_paid'] = $interest_paid;
                $creditor_all_data['no_of_months'] = count($all_payments);
                array_push($months_to_payoff_array, $creditor_all_data['no_of_months']);
                $creditor_all_data['calculate_months'] = Carbon::parse($start_date)->addMonth(count($all_payments));
                $creditor_all_data['all_payments'] = $all_payments;
                $final_data[$debt['creditor']] = $creditor_all_data;
                //Update Number of months
                $last_number_of_months = count($all_payments);
                //Update Snowball
                $new_snowball = $initial_snowball + $payment;
            }
            //dd($final_data);
            $max_months = max($months_to_payoff_array);
            // dd($final_data,$start_date,$type,$max_months,$months_to_payoff_array);
            if ($final_data) {
                $resp['error'] = false;
                $resp['result'] = view('reduction_result', compact('final_data', 'start_date', 'type', 'max_months'))->render();
            } else {
                $resp['message'] = 'Something went wrong, please try later.';
            }

            return response()->json($resp, 200);
        }
    }

    public function pay_amount($balance, $amount, $rate)
    {
        $interest = $this->calculate_interest($balance, $rate);
        if ($balance == $amount) {
            $remaining_bal = 0;
        } else {
            $remaining_bal = $balance - ($amount - $interest);
        }
        return $remaining_bal;
    }

    public function calculate_interest($balance, $rate)
    {
        return (float)number_format((($rate / 100) / 12) * $balance, 2);
    }
}
