<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserLoginController extends Controller
{
    public function index()
    {
        return view('pages.users.login.index');
    }

    public function store(Request $request, $user)
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
                $isValid = $user->login_code === $request->input('code');

                if (!$isValid) {

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
