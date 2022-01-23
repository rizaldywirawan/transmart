<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        $url = config('app.url');
        return view('pages.login.index', compact('url'));
    }

    public function store(Request $request)
    {
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

                    // authenticated! (200)
                    Auth::login($user);
                }

            } catch (\Throwable $th) {

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
}
