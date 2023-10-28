<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\bankingModel;
use App\Models\chairModel;
use App\Models\orderModel;
use App\Models\ratingModel;
use App\Models\ticketModel;
use App\Models\tripDayTimeBusModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class historyClientController extends Controller
{
    public function showHistory($ttv)
    {
        // $ticket = ticketModel::join('c_ng_g_x', 'c_ng_g_x.id_c_ng_g_x', '=', 'vexe.id_c_ng_g_x')
        //     ->join('xe', 'xe.idxe', '=', 'c_ng_g_x.idxe')
        //     ->where('idkh', $id)->get();
        $idkh = auth('client')->user()->idkh;
        $pttts = bankingModel::get();
        // if ($ttv == 3) {
        //     $rates = orderModel::join('chitietdatcho', 'chitietdatcho.iddc', '=', 'datcho.iddc')
        //         ->join('nhanxet', 'nhanxet.iddc', '=', 'datcho.iddc')
        //         ->where('datcho.idkh', $idkh)
        //         ->where('idttv', $ttv)
        //         ->orWhere('idttv', 4)
        //         ->get();
        //     $seats = orderModel::join('c_ng_g_x', 'c_ng_g_x.id_c_ng_g_x', '=', 'datcho.id_c_ng_g_x')
        //         ->join('xe', 'xe.idxe', '=', 'c_ng_g_x.idxe')
        //         ->join('loaixe', 'loaixe.idlx', '=', 'xe.idlx')
        //         ->join('chuyen', 'chuyen.idchuyen', '=', 'c_ng_g_x.idchuyen')
        //         ->join('ngaychay', 'ngaychay.idngay', '=', 'c_ng_g_x.idngay')
        //         ->join('gio', 'gio.idgio', '=', 'c_ng_g_x.idgio')
        //         ->join('tuyen', 'tuyen.idtuyen', '=', 'chuyen.idtuyen')
        //         ->where('datcho.idkh', $idkh)
        //         ->where('idttv', $ttv)
        //         ->orWhere('idttv', 4)
        //         ->orderBy('ngaychay', 'desc')->paginate(2);

        //     $chairs = orderModel::join('chitietdatcho', 'chitietdatcho.iddc', '=', 'datcho.iddc')
        //         ->join('ghe', 'ghe.idghe', '=', 'chitietdatcho.idghe')
        //         ->where('datcho.idkh', $idkh)
        //         ->where('datcho.idttv', $ttv)
        //         ->orWhere('datcho.idttv', 4)
        //         ->orderBy('datcho.idttv', 'desc')->get();
        // } else {
            $rates = orderModel::join('chitietdatcho', 'chitietdatcho.iddc', '=', 'datcho.iddc')
                ->join('nhanxet', 'nhanxet.iddc', '=', 'datcho.iddc')
                ->where('datcho.idkh', $idkh)
                ->where('idttv', $ttv)
                // ->where('del','!=',1)
                ->where('del','!=',2)
                ->get();
            $seats = orderModel::join('c_ng_g_x', 'c_ng_g_x.id_c_ng_g_x', '=', 'datcho.id_c_ng_g_x')
                ->join('xe', 'xe.idxe', '=', 'c_ng_g_x.idxe')
                ->join('loaixe', 'loaixe.idlx', '=', 'xe.idlx')
                ->join('chuyen', 'chuyen.idchuyen', '=', 'c_ng_g_x.idchuyen')
                ->join('ngaychay', 'ngaychay.idngay', '=', 'c_ng_g_x.idngay')
                ->join('gio', 'gio.idgio', '=', 'c_ng_g_x.idgio')
                ->join('tuyen', 'tuyen.idtuyen', '=', 'chuyen.idtuyen')
                ->where('datcho.idkh', $idkh)
                ->where('idttv', $ttv)
                // ->where('del','!=',1)
                ->where('del','!=',2)
                ->orderBy('ngaychay', 'desc')->paginate(2);

            $chairs = orderModel::join('chitietdatcho', 'chitietdatcho.iddc', '=', 'datcho.iddc')
                ->join('ghe', 'ghe.idghe', '=', 'chitietdatcho.idghe')
                ->where('datcho.idkh', $idkh)
                ->where('datcho.idttv', $ttv)
                // ->where('del','!=',1)
                ->where('del','!=',2)
                ->orderBy('datcho.idttv', 'desc')
                ->get();
        // }
        //     // ->join('nhanxet', 'nhanxet.id_c_ng_g_x', '=', 'c_ng_g_x.id_c_ng_g_x')

        // dd($chairs);
        return view('client.ticket.history', compact('seats', 'rates', 'pttts', 'chairs'));
    }

    public function deleteSeat($id)
    {
        // chairModel::find($id)->update([
        //     'datcho' => 0, 
        // ]);
        orderModel::where('iddc', $id)->update([
            'idttv' => 0,
        ]);
        return redirect()->back();
    }
    public function deleteTicket($id)
    {
        // chairModel::find($id)->update([
        //     'datcho' => 0,
        // ]);
        // ticketModel::where('idghe', $id)->delete();
        orderModel::where('iddc', $id)->update([
            'del' => 2,
        ]);
        return redirect()->back();
    }
    public function deleteTicketDes($iddc)
    {
        // chairModel::find($id)->update([
        //     'datcho' => 0,
        // ]);
        ticketModel::where('iddc', $iddc)->delete();
        orderModel::where('iddc', $iddc)->delete();
        return redirect()->back();
    }
    public function deleteTicketRe($iddc)
    {
        orderModel::where('iddc', $iddc)->update([
            'idttv' => 1,
        ]);
        return redirect('client/history/1');
    }
    // khon duoc su dung
    public function finishTicket($id)
    {
        // chairModel::find($id)->update([
        //     'datcho' => 0,
        // ]);
        // ticketModel::where('idghe', $id)->update([
        //     'TTV' => 2,
        // ]);
        // return redirect()->back();
    }

    public function rating(Request $request)
    {
        $data = $request->all();
        $check = ratingModel::where('iddc', $data['iddc'])->exists();
        if ($check) {
            echo ("err");
        } else {
            ratingModel::create($data);
            echo ('success');
        }
        // // $data['maghe'];
    }
}
