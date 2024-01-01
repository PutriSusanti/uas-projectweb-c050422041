<?php

namespace App\Http\Controllers\Api;
use App\Models\Schedule;
use App\Http\Resources\ScheduleResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $schedules = DB::table('schedules')
            ->when($request->input('subject_id'), function ($query, $subject_id) {
                return $query->where('subject_id', 'like', '%' . $subject_id . '%');
            })
            ->select('id', 'subject_id', 'hari', 'jam_mulai', 'jam_selesai', 'ruangan', 'kode_absensi', DB::raw('DATE_FORMAT(created_at, "%d %M %Y") as created_at'))
            ->orderBy('id', 'asc')
            ->paginate(15);
        return view('pages.schedules.index', compact('schedules'));
    }

    public function create()
    {
        return view('pages.schedules.create');
    }

    public function store(StoreScheduleRequest $request)
    {
        Schedule::create([
            'subject_id' => $request['subject_id'],
            'hari' => $request['hari'],
            'jam_mulai' => $request['jam_mulai'],
            'jam_selesai' => $request['jam_selesai'],
            'ruangan' => $request['ruangan'],
        ]);

        return redirect(route('schedule.index'))->with('success', 'Create New Schedule Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

     public function edit(Schedule $schedule)
     {
         return view('pages.schedules.edit')->with('schedule', $schedule);
     }

    public function update(UpdateScheduleRequest $request, Schedule $schedule)
    {
        $validate = $request->validated();
        $schedule->update($validate);
        return redirect()->route('schedule.index')->with('success', 'Edit Schedule Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('schedule.index')->with('success', 'Delete Schedule Successfully');
    }

    public function generateQRCode($id)
    {
        $schedule = Schedule::find($id);

        if (!$schedule) {
            abort(404);
        }

        // Customize the data to be included in the QR code
        $qrCodeData = "Schedule ID: {$schedule->id}\nSubject: {$schedule->subject_id}\nDay: {$schedule->hari}\nStart Time: {$schedule->jam_mulai}\nEnd Time: {$schedule->jam_selesai}";

        $qrCode = QrCode::size(200)->generate($qrCodeData);

        return view('schedule.generate-qrcode', compact('qrCode', 'schedule'));
    }

}
