<?php

namespace App\Http\Controllers\client\momo;

use App\Http\Controllers\Controller;
use App\Models\chairModel;
use App\Models\clientModel;
use App\Models\orderModel;
use App\Models\ticketModel;
use App\Models\workModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class momoController extends Controller
{
   public function momoPay()
    {
        $data_ticket = Session::get('data');
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";


        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua MoMo";
        $amount = $data_ticket['giave'];
        $orderId = time() . "";
        if (!auth('client')->user()) {
            $redirectUrl = "http://busline.com/client/ticket";
            $ipnUrl = "http://busline.com/client/ticket";
        } else {
            $redirectUrl = "http://busline.com/client/history/0";
            $ipnUrl = "http://busline.com/client/history/0";
        }
        $extraData = "";


        $partnerCode = $partnerCode;
        $accessKey =  $accessKey;
        $serectkey = $secretKey;
        $orderId = $orderId; // Mã đơn hàng
        $orderInfo = $orderInfo;
        $amount = $amount;
        $ipnUrl = $ipnUrl;
        $redirectUrl = $redirectUrl;
        $extraData = $extraData;

        $requestId = time() . "";
        $requestType = "payWithATM";
        // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
        //before sign HMAC SHA256 signature
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $serectkey);
        $data = array(
            'partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        );
        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);  // decode json
        // dd($data['id_c_ng_g_x']);

        // return redirect('client/history/0');


        // $buss = chairModel::join('c_ng_g_x', 'ghe.idxe', '=', 'c_ng_g_x.idxe')->where('id_c_ng_g_x', $data_ticket['id_c_ng_g_x'])->where('maghe', $data_ticket['maghe'])->first();
        if (!auth('client')->user()) {
            // $success = "Chúng tôi sẽ gọi đến số điện thoại của quý khách để xác nhận!";
            // $data_ticket['idghe'] = $buss['idghe'];
            // $data_ticket['TTV'] = 0;
            // $data_ticket['rate'] = 0;

            // ticketModel::create($data_ticket);
            // chairModel::find($buss['idghe'])->update([
            //     'datcho' => 1,
            // ]);
            // $data_ticket['TTV'] = 0;
            // orderModel::create($data_ticket);
            // $iddc = orderModel::get()->last();
            // $data_ticket['iddc'] = $iddc->iddc;
            // foreach ($data_ticket['idghes'] as $checkbox) {
            //     $data_ticket['idghe'] = $checkbox;
            //     ticketModel::create($data_ticket);
            // }
            $data_ticket['idttv'] = 1;
            $money = 0;
            foreach ($data_ticket['idghes'] as $checkbox) {
                $money++;
            }
            $data_ticket['tongtien'] = $money * $data_ticket['giave'];
            $data_ticket['del'] = 0;
            orderModel::create($data_ticket);
            $iddc = orderModel::get()->last();
            $data_ticket['iddc'] = $iddc->iddc;
            // dd($data);
            foreach ($data_ticket['idghes'] as $checkbox) {
                $data_ticket['idghe'] = $checkbox;
                ticketModel::create($data_ticket);
            }
            workModel::where('idkh', 999999999)->delete();
            // $data_ticket['idghe'] = $buss['idghe'];
            // $data_ticket['TTV'] = 0;
            // orderModel::create($data_ticket);
            // $iddc = orderModel::get()->last();
            // $data_ticket['iddc'] = $iddc->iddc;
            // ticketModel::create($data_ticket);
        } else {
            // $user = clientModel::join('nguoidung', 'nguoidung.idnd', '=', 'khachhang.idnd')
            //     ->where('idkh', auth('client')->user()->idkh)->first();
            // $name = $user->tennd;
            // Mail::send('client.email.sendMail', compact('name'), function ($email) use ($name) {
            //     $email->subject('BUSLINE');
            //     $email->to(auth('client')->user()->email, $name);
            // });
            // $data_ticket['idghe'] = $buss['idghe'];
            // $data_ticket['TTV'] = 0;
            // $data_ticket['rate'] = 0;

            // $data_ticket['idkh'] = auth('client')->user()->idkh;
            // ticketModel::create($data_ticket);
            // chairModel::find($buss['idghe'])->update([
            //     'datcho' => 1,
            // ]);
            $user = clientModel::join('nguoidung', 'nguoidung.idnd', '=', 'khachhang.idnd')
                ->where('idkh', auth('client')->user()->idkh)->first();
            $name = $user->tennd;
            // dd(auth('client')->user()->email);
            \Illuminate\Support\Facades\Mail::send('client.email.sendMail', compact('name'), function ($email) use ($name) {
                $email->subject('BUSLINE');
                $email->to(auth('client')->user()->email, $name);
            });

            // $data_ticket['idkh'] = auth('client')->user()->idkh;
            // $data_ticket['TTV'] = 0;
            // orderModel::create($data_ticket);
            // $iddc = orderModel::get()->last();
            // $data_ticket['iddc'] = $iddc->iddc;
            // foreach ($data_ticket['idghes'] as $checkbox) {
            //     $data_ticket['idghe'] = $checkbox;
            //     ticketModel::create($data_ticket);
            // }
            $success = "Đặt vé xe thành công.";

            $data_ticket['idkh'] = auth('client')->user()->idkh;
            $data_ticket['idttv'] = 1;
            $money = 0;
            foreach ($data_ticket['idghes'] as $checkbox) {
                $money++;
            }
            $data_ticket['tongtien'] = $money * $data_ticket['giave'];
            $data_ticket['del'] = 0;
            orderModel::create($data_ticket);
            $iddc = orderModel::get()->last();
            $data_ticket['iddc'] = $iddc->iddc;
            // dd($data);
            foreach ($data_ticket['idghes'] as $checkbox) {
                $data_ticket['idghe'] = $checkbox;
                ticketModel::create($data_ticket);
            }
            workModel::where('idkh', auth('client')->user()->idkh)->delete();
        }
        return redirect()->to($jsonResult['payUrl']);
        //Just a example, please check more in there

        // header('Location: ' . $jsonResult['payUrl']);
    }
    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }
}
