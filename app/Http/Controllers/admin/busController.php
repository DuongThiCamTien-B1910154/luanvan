<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\admin\busRequest;
use App\Models\busModel;
use App\Models\chairModel;
use App\Models\tripDayTimeBusModel;
use App\Models\tripModel;

class busController extends Controller
{
    public function showBus(Request $request)
    {

        $this->data['title'] = "Thành viên";
        $this->data['error'] = "Vui lòng kiểm tra lại !";
        $search = $request['search'] ?? "";

        if ($search != "") {

            $this->data['datas'] = busModel::where('bienso', 'LIKE', "%$search%")->get();
        } else {
            $this->data['datas'] = busModel::get();
        }
        // dd($search);
        // $this->data['datas'] = User::join('chucvu', 'nguoidung.idcv', '=', 'chucvu.idcv')
        //     ->get(['nguoidung.*', 'chucvu.*']);

        return view('admin.bus.listBus', $this->data, compact('search'));
    }

    public function showFormAddBus()
    {
        return view('admin.bus.addBus');
    }
    public function addBus(busRequest $request)
    {
        // $input = $request->input();
        // dd($input);
        $success = "Thêm thành công!";
        $data = $request->all();
        // dd($request->idlx);
        if ($request->has('file_upload')) {
            $file = $request->file_upload;
            $file_name = $file->getClientoriginalName();
            // dd($file_name);
            // $images = $file_name;
            $file->move(public_path('uploads'), $file_name);
            $data['file_upload'] = $file_name;
        }
        busModel::create($data);
        $xe = busModel::all()->last();
        // dd($xe->idxe);
        if ($request->idlx == 1) {
            $temp = 20;
        } else if ($request->idlx == 2) {
            $temp = 24;
        } else if ($request->idlx == 3) {
            $temp = 16;
        }
        for ($i = 1; $i <= $temp; $i++) {
            if ($temp == 20) {
                if ($i <= 10) {
                    $data['maghe'] = 'A' .  $i;
                    $data['datcho'] = 0;
                    $data['idxe'] = $xe->idxe;
                    chairModel::create($data);
                } else {
                    $data['maghe'] = 'B' .  $i - 10;
                    // dd( $data['maghe']);
                    $data['datcho'] = 0;
                    $data['idxe'] = $xe->idxe;
                    chairModel::create($data);
                }
            } else {
                $data['maghe'] = 'A' .  $i;
                $data['datcho'] = 0;
                $data['idxe'] = $xe->idxe;
                // dd($data);
                chairModel::create($data);
            }

            // dd($data);
        }
        return redirect()->back()->with('success', $success);
    }


    public function showFormEdit($id)
    {
        $datas = busModel::find($id);
        return view('admin.bus.editBus', compact('datas'));
    }

    public function editBus(busRequest $request, $id)
    {
        $success = "Thành công !";
        $input =  $request->all();
        $dataImages = busModel::where('idxe', $id)->first();

        if ($request->has('file_upload')) {
            $file = $request->file_upload;
            $file_name = $file->getClientoriginalName();
            $file->move(public_path('uploads'), $file_name);
            busModel::where('idxe', $id)->update([
                'bienso' => $request->bienso,
                'namsx' => $request->namsx,
                'idlx' => $request->idlx,
                'file_upload' => $file_name
            ]);
            return redirect()->action([busController::class, 'showBus'])->with('success', $success);
        }
        $input['file_upload'] = $dataImages->file_upload;
        $input = request()->except(['_token', 'submit']);
        busModel::where('idxe', $id)->update(
            $input
        );

        chairModel::where('idxe', $id)->get()->each->delete();
        $xe = busModel::find($id);
        // dd($xe->idxe);
        if ($request->idlx == 1) {
            $temp = 20;
        } else if ($request->idlx == 2) {
            $temp = 24;
        } else if ($request->idlx == 3) {
            $temp = 16;
        }
        for ($i = 1; $i <= $temp; $i++) {
            if ($temp == 20) {
                if ($i <= 10) {
                    $data['maghe'] = 'A' .  $i;
                    $data['datcho'] = 0;
                    $data['idxe'] = $xe->idxe;
                    chairModel::create($data);
                } else {
                    $data['maghe'] = 'B' .  $i - 10;
                    // dd( $data['maghe']);
                    $data['datcho'] = 0;
                    $data['idxe'] = $xe->idxe;
                    chairModel::create($data);
                }
            } else {
                $data['maghe'] = 'A' .  $i;
                $data['datcho'] = 0;
                $data['idxe'] = $xe->idxe;
                // dd($data);
                chairModel::create($data);
            }

            // dd($data);
        }
        // $success = "Cập nhật thành công.";
        // $data = busModel::find($id);
        // // $idtuyen = $request->input('idtuyen');
        // $data->bienso = $request->bienso;
        // $data->namsx = $request->namsx;
        // $data->idlx = $request->idlx;
        // $data->save();
        // return view('admin.users.listUser')->with('success', $success);
        return redirect()->action([busController::class, 'showBus'])->with('success', $success);
    }
    public function deleteBus($id)
    {
        $success = "Xóa thành công.";

        $data = busModel::find($id);
        // dd($data->idxe);
        chairModel::where('idxe', $id)->get()->each->delete();

        tripDayTimeBusModel::where('idxe', $id)->update([
            'idxe' => null,
        ]);
        // dd($day_time['idchuyen']);
        // tripModel::find()->delete($day_time['idchuyen']);
        busModel::find($id)->delete();
        return redirect()->action([busController::class, 'showBus'])->with('success', $success);
    }

    public function chairBus($id)
    {
        // dd($id);
        $datas = chairModel::where('idxe', $id)->get();
        // dd($datas);
        $bus = busModel::find($id);

        return view('admin.bus.chairBus', compact('datas', 'bus'));
    }

    public function chair(Request $request)
    {
        dd($request->all());
    }
}
