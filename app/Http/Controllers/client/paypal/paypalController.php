<?php

namespace App\Http\Controllers\client\paypal;

use App\Models\chairModel;
use App\Models\clientModel;
use App\Models\ticketModel;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

use App\Models\productModel;
use App\Models\User;
use App\Models\orderModel;
use App\Models\detailOrderModel;
use Cart;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class paypalController extends Controller
{
    //     private $gateway;
    //     public function  __construct()
    //     {
    //         $this->gateway = Omnipay::create('Paypal_Rest');
    //         $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
    //         $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
    //         $this->gateway->settestMode(true);
    //     }

    //     public function pay(Request $request)
    //     {
    //             try {
    //                 $res = $this->gateway->purchase(array(
    //                     'amount' => $request->amount,
    //                     'returnUrl' => url('success'),
    //                     'cancelUrl' => url('cancel')

    //                 ))->send();
    //                 if ($res->isRedirect()) {
    //                     $res->redirect();
    //                 } else {
    //                     return $res->getMessage();
    //                 }
    //             } catch (\Throwable $th) {
    //             }
    //     }

    /**
     * create transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function createTransaction()
    {
        return view('transaction');
    }

    /**
     * process transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function processTransaction(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();


        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('successTransaction', ['input' => $request->input]),
                "cancel_url" => route('cancelTransaction'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $request->giave,
                    ]
                ]
            ]
        ]);
        // dd(123);
        if (isset($response['id']) && $response['id'] != null) {

            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }
            return redirect()->route('createTransaction')->with('error', 'Something went wrong.');
        } else {
            return redirect()->route('createTransaction')->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    /**
     * success transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function successTransaction(Request $request)
    {
        // return $request->input;
        // dd(456);
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            $data = Session::get('data');
            $buss = chairModel::join('c_ng_g_x', 'ghe.idxe', '=', 'c_ng_g_x.idxe')->where('id_c_ng_g_x', $data['id_c_ng_g_x'])->where('maghe', $data['maghe'])->first();
            if (!auth('client')->user()) {
                $success = "Chúng tôi sẽ gọi đến số điện thoại của quý khách để xác nhận!";
                $data['idghe'] = $buss['idghe'];
                $data['TTV'] = 0;
                $data['rate'] = 0;
                ticketModel::create($data);
                chairModel::find($buss['idghe'])->update([
                    'datcho' => 1,
                ]);
                return redirect('client/ticket')->with('success', $success);
            }
            $user = clientModel::join('nguoidung', 'nguoidung.idnd', '=', 'khachhang.idnd')
                ->where('idkh', auth('client')->user()->idkh)->first();
            $name = $user->tennd;
            Mail::send('client.email.sendMail', compact('name'), function ($email) use ($name) {
                $email->subject('BUSLINE');
                $email->to(auth('client')->user()->email, $name);
            });
            $data['idghe'] = $buss['idghe'];
            $data['TTV'] = 0;
            $data['rate'] = 0;

            $data['idkh'] = auth('client')->user()->idkh;
            ticketModel::create($data);
            chairModel::find($buss['idghe'])->update([
                'datcho' => 1,
            ]);
            return redirect('client/history/0');
        } else {
            $error = "Thanh toán qua PAYPAL thất bại!";
            return redirect('client/ticket')->with('error', $error);
        }
    }

    /**
     * cancel transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelTransaction(Request $request)
    {
        // dd(789);
        return redirect('client/ticket');
        // ->route('createTransaction')
        // ->with('error', $response['message'] ?? 'You have canceled the transaction.');
    }
}
