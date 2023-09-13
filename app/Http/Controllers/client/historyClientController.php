<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\chairModel;
use App\Models\ticketModel;
use App\Models\tripDayTimeBusModel;
use Illuminate\Http\Request;

class historyClientController extends Controller
{
    public function showHistory($id)
    {
        // $ticket = ticketModel::join('c_ng_g_x', 'c_ng_g_x.id_c_ng_g_x', '=', 'vexe.id_c_ng_g_x')
        //     ->join('xe', 'xe.idxe', '=', 'c_ng_g_x.idxe')
        //     ->where('idkh', $id)->get();
        $seats = chairModel::join('vexe', 'vexe.idghe', '=', 'ghe.idghe')
            ->join('xe', 'xe.idxe', '=', 'ghe.idxe')
            ->join('loaixe', 'loaixe.idlx', '=', 'xe.idlx')
            ->join('c_ng_g_x', 'c_ng_g_x.id_c_ng_g_x', '=', 'vexe.id_c_ng_g_x')
            ->join('chuyen', 'chuyen.idchuyen', '=', 'c_ng_g_x.idchuyen')
            ->join('ngaychay', 'ngaychay.idngay', '=', 'c_ng_g_x.idngay')
            ->join('gio', 'gio.idgio', '=', 'c_ng_g_x.idgio')
            ->join('tuyen', 'tuyen.idtuyen', '=', 'chuyen.idtuyen')
            ->where('TTV', $id)->orderBy('ngaychay', 'desc')->get();

        // $temp = ticketModel::where('TTV',$id)->get(); 
        // $seats = chairModel::join('vexe', 'vexe.idghe', '=', 'ghe.idghe')
        //     ->join('xe', 'xe.idxe', '=', 'ghe.idxe')
        //     ->join('loaixe', 'loaixe.idlx', '=', 'xe.idlx')
        //     ->join('c_ng_g_x', 'c_ng_g_x.id_c_ng_g_x', '=', 'vexe.id_c_ng_g_x')

        //     ->where('TTV', $id)->where('idkh', 1)->get();
        // dd($seats);
        return view('client.ticket.history', compact('seats'));
    }

    public function deleteSeat($id)
    {
        chairModel::find($id)->update([
            'datcho' => 0,
        ]);
        ticketModel::where('idghe', $id)->update([
            'TTV' => -1,
        ]);
        return redirect()->back();
    }
    public function deleteTicket($id)
    {
        chairModel::find($id)->update([
            'datcho' => 0,
        ]);
        ticketModel::where('idghe', $id)->delete();
        return redirect()->back();
    }
    public function finishTicket($id)
    {
        chairModel::find($id)->update([
            'datcho' => 0,
        ]);
        ticketModel::where('idghe', $id)->update([
            'TTV' => 2,
        ]);
        return redirect()->back();
    }
}
