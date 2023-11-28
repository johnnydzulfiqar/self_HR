<?php

namespace App\Livewire;

use Illuminate\Support\Str;
use Livewire\Component;
use App\Models\Jadwal as Jadwals;
use App\Models\User as Users;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Jadwal extends Component
{
    public $jadwal_id, $user_id, $time_from, $time_to, $status = false, $addJadwal = false, $updateJadwal = false;

    protected $rules = [
        'time_from' => 'required',
        'time_to' => 'required',
    ];
    public function resetFields()
    {
        $this->time_from = '';
        $this->time_to = '';
        $this->status = 0;
    }
    public function render()
    {
        $jadwal = \App\Models\Jadwal::latest()->get();
        // $data = \App\Models\User::where(id === Auth::user()->id)->first();
        return view('livewire.jadwal', compact('jadwal'));
        $jadwaladmin = \App\Models\Jadwal::latest()->get();
        // $data = \App\Models\User::where(id === Auth::user()->id)->first();
        return view('livewire.admin.jadwaladmin', compact('jadwal'));
    }
    public function create()
    {
        $this->resetFields();
        $this->addJadwal = true;
        $this->updateJadwal = false;
    }
    public function store(Request $request)
    {
        $this->validate();
        $time_to = Carbon::parse($request->time_to);
        $time_from = Carbon::parse($request->time_from);
        $a =  $time_to->diffInDays($time_from);
        try {
            \App\Models\Jadwal::create([
                'time_from' => $this->time_from,
                'time_to' => $this->time_to,
                'status' => 0,
                'user_id' => Auth::user()->id,
                // 'jatah' => $a,
                // $time_to = Carbon::parse($this->time_from),
                // $time_from = Carbon::parse($this->time_to),
                // $a =  $time_to->diffInDays($time_from),
            ]);
            $user = \App\Models\User::findOrFail(Auth::user()->id);
            if (!$user) {
                session()->flash('error', 'user not found');
            } else {
                $time_to = Carbon::parse($this->time_from);
                $time_from = Carbon::parse($this->time_to);
                $a =  $time_to->diffInDays($time_from);
                $user->jatah = $user->jatah - $a;
                // dd($jatah);
                $user->save();
            }
            session()->flash('success', 'Jadwal Created Successfully!!');
            $this->resetFields();
            $this->addJadwal = false;
        } catch (\Exception $ex) {
            session()->flash('error', 'Something goes wrong!!');
        }
    }
    public function edit($id)
    {
        try {
            $jadwal = \App\Models\Jadwal::findOrFail($id);
            if (!$jadwal) {
                session()->flash('error', 'jadwal not found');
            } else {
                $this->time_from = $jadwal->time_from;
                $this->time_to = $jadwal->time_to;
                // $this->status = $jadwal->status;
                $this->jadwal_id = $jadwal->id;
                $this->updateJadwal = true;
                $this->addJadwal = false;
            }
        } catch (\Exception $ex) {
            session()->flash('error', 'Something goes wrong!!');
        }
    }
    public function update()
    {
        $this->validate();
        try {
            \App\Models\Jadwal::whereId($this->jadwal_id)->update([
                'time_from' => $this->time_from,
                'time_to' => $this->time_to,
                // 'status' => $this->status,
                // 'slug' => Str::slug($this->title)
            ]);
            session()->flash('success', 'Post Updated Successfully!!');
            $this->resetFields();
            $this->updateJadwal = false;
        } catch (\Exception $ex) {
            session()->flash('error', 'Something goes wrong!!');
        }
    }
    public function cancel()
    {
        $this->addJadwal = false;
        $this->updateJadwal = false;
        $this->resetFields();
    }
    public function destroy($id)
    {
        try {
            \App\Models\Jadwal::find($id)->delete();
            session()->flash('success', "Post Deleted Successfully!!");
        } catch (\Exception $e) {
            session()->flash('error', "Something goes wrong!!");
        }
    }
    // public function editadmin($id)
    // {
    //     try {
    //         $jadwal = \App\Models\Jadwal::findOrFail($id);
    //         if (!$jadwal) {
    //             session()->flash('error', 'jadwal not found');
    //         } else {
    //             $this->status = $jadwal->status = true;
    //             $this->updateJadwal = true;
    //             $this->addJadwal = false;
    //         }
    //     } catch (\Exception $ex) {
    //         session()->flash('error', 'Something goes wrong!!');
    //     }
    // }
    // public function updateadmin()
    // {
    //     try {
    //         \App\Models\Jadwal::whereId($this->jadwal_id)->update([
    //             'status' => $this->status = 1,
    //         ]);
    //         session()->flash('success', 'Post Updated Successfully!!');
    //     } catch (\Exception $ex) {
    //         session()->flash('error', 'Something goes wrong!!');
    //     }
    // }
    public function editadmin(Jadwal $id, Request $request)
    {
        $jadwal = Jadwal::find($request->id);
        $jadwal->laporan = $request->status;
        $jadwal->save();
        return redirect('/admin/home');
    }
}
