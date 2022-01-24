<?php

namespace App\Http\Controllers\Auth;

use App\Events\AttendanceSigned;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\LocationType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        $locationType = LocationType::where('name', 'Physical')->first();

        $url = config('app.url') . "?source=523c9f80-7a68-4f9a-85f1-f1597d65a513";
        return view('pages.login.index', compact('url'));
    }

    public function store(Request $request)
    {
        $source = $request->input('source');

        $code = 200;
        $response = [
            'message' => [
                'title' => 'Terautentikasi.',
                'text' => 'Proses autentikasi berhasil dilakukan.'
            ]
        ];

        // check the login code availability (422)
        if (empty($request->input('code'))) {
            $code = 422;

            $response = [
                'message' => [
                    'title' => 'Kode login tidak tersedia.',
                    'text' => 'Mohon sertakan kode login Anda.'
                ]
            ];
        } else {

            try {

                // check the login code validity (403)
                $user = User::where('login_code', $request->input('code'))->first();

                if (empty($user)) {

                    $code = 403;

                    $response = [
                        'message' => [
                            'title' => 'Tidak Terauntentikasi.',
                            'text' => 'Mohon maaf, kami tidak dapat mengenali Anda, mohon ulangi kembali.'
                        ]
                    ];
                } else {

                    // Initiation Data
                    $event = 'ad22aa5c-03cf-40ae-a589-ca1a0454532d';
                    $onlineLocation = 'dd00a679-f0f0-45ae-9ab3-60baabcbbd67';

                    $siteLocation = "523c9f80-7a68-4f9a-85f1-f1597d65a513";

                    if (!empty($source)) {

                        if ($source !== $siteLocation) {
                            $code = 404;
                            $response = [
                                'message' => [
                                    'title' => 'Kode lokasi tidak ditemukan.',
                                    'text' => 'Mohon maaf, kami tidak dapat memeriksa lokasi Anda.'
                                ]
                            ];

                            return response($response, $code);
                        }

                        $locationType = $siteLocation;


                    } else {
                        $locationType = $onlineLocation;
                    }

                    DB::beginTransaction();

                    // authenticated! (200)
                    $checkAttendance = Attendance::whereBetween('created_at', [now()->isoFormat('YYYY-MM-DD 00:00:00.000'), now()->isoFormat('YYYY-MM-DD 23:59:59.000')])
                    ->where('user_id', $user->id)
                    ->count();

                    if (!$checkAttendance) {
                        $attendance = new Attendance();
                        $attendance->event_id = $event;
                        $attendance->user_id = $user->id;
                        $attendance->location_type_id = $locationType;
                        $attendance->created_at = now();
                        $attendance->created_by = $user->id;
                        $attendance->save();

                        $user->load('latestAttendance.locationType', 'profile');

                        $attendanceToday = Attendance::whereBetween('created_at', [now()->isoFormat('YYYY-MM-DD 00:00:00.000'), now()->isoFormat('YYYY-MM-DD 23:59:00.000')])->count();
                        $attendanceByWebsite = Attendance::where('location_type_id', 'dd00a679-f0f0-45ae-9ab3-60baabcbbd67')->count();
                        $attendanceByQRCode = Attendance::where('location_type_id', '523c9f80-7a68-4f9a-85f1-f1597d65a513')->count();

                        $totalUser = User::whereHas('roles', function($query) {
                            $query->where('name', 'participant');
                        })
                        ->count();

                        $attendanceData = [
                            'attendance-today' => $attendanceToday,
                            'attendance-online' => $attendanceByWebsite,
                            'attendance-offline' => $attendanceByQRCode,
                            'total-participant' => $totalUser
                        ];

                        AttendanceSigned::dispatch($user, $attendanceData);
                    }

                    DB::commit();


                    Auth::login($user);
                }

            } catch (\Throwable $th) {

                DB::rollBack();

                // something went wrong (500)
                $code = 500;

                $response = [
                    'message' => [
                        'title' => 'Terjadi Kesalahan.',
                        'text' => $th->getMessage()
                    ]
                ];
            }
        }

        return response($response, $code);

    }

    public function destroy()
    {
        Auth::logout();

        return redirect('/');
    }
}
