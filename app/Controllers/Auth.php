<?php

namespace App\Controllers;

use App\Models\LoginModel;
use App\Models\LoginUserModel;

class Auth extends BaseController
{
    protected $loginModel;

    public function __construct()
    {
        $this->loginModel = new LoginModel();
    }

    public function login()
    {
        $data = [
            'title'         => 'Geleri Foto | Login',
            'validation'    => \Config\Services::validation()
        ];

        if (session('user_id')) {
            return redirect()->to('/');
        }

        return view('auth/login', $data);
    }

    public function loginProses()
    {
        //validasi input
        if (!$this->validate([
            'email' => [
                'rules'     => 'required|valid_email',
                'errors'    => [
                    'required'      => 'Email harus diisi!',
                    'valid_email'   => 'Email tidak valid!'
                ]
            ],

            'password' => [
                'rules'     => 'required',
                'errors'    => [
                    'required'      => 'Password harus diisi!'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            // dd($validation);
            // return redirect()->to('/create')->withInput()->with('validation', $validation);
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        $post = $this->request->getPost();
        $db      = \Config\Database::connect();
        $query = $db->table('user')->getWhere(['email' => $post['email']]);
        $user = $query->getRow();
        if ($user) {
            if (password_verify($post['password'], $user->password)) {
                $params = ['user_id' => $user->user_id];
                session()->set($params);

                $login = new LoginUserModel();
                $data_insert = [
                    'user_id'   => userLogin()->user_id
                ];

                $login->insert($data_insert);


                return redirect()->to('/');
            } else {
                return redirect()->back()->withInput()->with('error', 'Password tidak sesuai!');
            }
        } else {
            return redirect()->back()->withInput()->with('error', 'Email tidak ditemukan!');
        }
    }

    public function registrasi()
    {
        $data = [
            'title'         => 'GaleriFoto | Registrasi',
            'validation'    => \Config\Services::validation()
        ];

        return view('auth/registrasi', $data);
    }

    public function registrasiProses()
    {
        // List email terdaftar dari database
        $emailTerdaftar = $this->loginModel->getEmail();

        // email yang akan di cek, ambil dari inputan user
        $NewEmailRegistration = $this->request->getVar('email');


        // $emailTerdaftar, tipe datane opo? 
        // $NewEmailRegistration tipe datane opo? 

        // rule'e simpel, kedua tipe data kui ujunge harus string ben iso di compare.

        // gini, tampilno $NewEmailRegistration sebagai string. 
        // lalu, tampilno emailterdaftar index ke-1. 
        // nek kui iso, tinggal di convert neng string. 

        // lanjut, emailterdaftar index ke-1



        // gini carane : 
        // $jenengVariable[index] -> key
        // dd($emailTerdaftar[1]->email);

        // aku pengen nampilke index ke-1, pie carane? ntah -_- sek
        // dd($emailTerdaftar->videoid);



        // cek email apakah sudah terdaftar?
        $err = "";
        for ($i = 0; $i < count($emailTerdaftar); $i++) {
            if ($emailTerdaftar[$i]->email == $NewEmailRegistration) {

                // dd($emailTerdaftar[$i]->email);
                // tampilke email ketika podo. 
                // woke, done, paham durung? 
                $rule_email = 'required|valid_email|is_unique[user.email]';
                // $err = "Email Already Registered, Please Login";
                // break'e ojo diilangi. nek tok ilangi ngebut ntar. 
                //nek break berarti hah kepie.
                // ketika email terdaftar podo karo email sek diinput, otomatis rule sesuai diatas. 

                // nek break'e diilangi, ntar ono kemungkinan ngebug ketika email selanjute enggak podo. 
                break;
            } else {
                $rule_email = 'required|valid_email';
            }
        }


        // List username terdaftar dari database
        $userTerdaftar = $this->loginModel->getUsername();

        // username yang akan di cek, ambil dari inputan user
        $NewUsernameRegistration = $this->request->getVar('username');

        for ($i = 0; $i < count($userTerdaftar); $i++) {
            if ($userTerdaftar[$i]->username == $NewUsernameRegistration) {

                // dd($emailTerdaftar[$i]->email);
                // tampilke email ketika podo. 
                // woke, done, paham durung? 
                $rule_username = 'required|max_length[20]|is_unique[user.username]';
                // $err = "Email Already Registered, Please Login";
                // break'e ojo diilangi. nek tok ilangi ngebut ntar. 
                //nek break berarti hah kepie.
                // ketika email terdaftar podo karo email sek diinput, otomatis rule sesuai diatas. 

                // nek break'e diilangi, ntar ono kemungkinan ngebug ketika email selanjute enggak podo. 
                break;
            } else {
                $rule_username = 'required|max_length[20]';
            }
        }


        // $AngkaDicari = 1;

        // for ($i = 0; $i < 3; $i++) {
        //     if ($i == $AngkaDicari) {
        //         echo "Hasil Akhir : ketemu";
        //         break;
        //     } else {
        //         echo "Hasil Akhir : tidak ketemu";
        //     }
        // }

        // hasil penjalanan program ::
        // angka dicari      | i 
        // 1 | 0 => Hasil Akhir : tidak ketemu
        // 1 | 1 => Hasil Akhir : ketemu

        // BREAK HERE!. 
        // Sehingga hasil akhir : ketemu. 

        // 1 | 2 => Hasil Akhir : tidak ketemu

        // ongko 1 kan haruse ketemu. 
        // Tapi karena enggak tok stop nganggo break, tetep lanjut neng perulangan selanjute. 
        // sehingga hasile tidak ketemu (BUG!).
        // ketika ketemu, harus di break. 

        // pahami sek kui. 
        // Ntar nek ditakoni bingung dirimu. 
        // Nggak kudu paham saiki, tapi penting banget diphami nek dirimu serius pengen dadi programmer. 

        // ikuu, tes sek programe. XD
        // dikoemn sek berarti. 
        // heem, karooo
        // diilangi fitur tes'e. 
        // maukan lehku ngetes dengan cara nampilke email ketika email'e wis teregistrasi. 
        // saiki diilangi. 


        // if ($err != "") {
        //     // return error ke fe
        //     // tampilken error. 
        //     // nek neng native, tinggal tak echo 
        //     echo "ADA error : " + $err;
        // } else {
        //     echo "tidak ada error";
        //     // lanjuut proses
        // }
        // done cek email apakah sudah terdaftar?

        // secara konsep kek gitu
        //terus aku kepie 

        // aku paham sek arep tok garap, cuman aku nggak paham framework. 
        // tak nei kisi2ne, dirimu sek garap. Aku nggak familiar sama sekali. Cuman iso nebak seko alur. 

        // oke, gini. 
        // fungsi neng nduwur cek'o. 
        // jalanke ben iso tampil "ADA ERROR", atau "TIDAK ADA ERROR";
        //tak jajale sek 
        // LIFE WAE GAPOPO, sory capslock. 
        // life wae gapopo, sekalian aku sinau. 
        // gasskan

        // dd($emailTerdaftar);


        // ora nganggo dd? wiss, sangar, wis kenal istilah dd saiki :D
        // aku murni nganggo native, dd pun ono neng native.  Kui sek arep cobo tak lakokke. Tulung DD ke .
        // echo $emailTerdaftar;

        // if ($emailTerdaftar == $this->request->getVar('email')) {
        //     $rule_email = 'required|valid_email|is_unique[user.email]';
        // } else {
        //     $rule_email = 'required|valid_email';
        // }


        // wokeh, arrayne sek endi sek tok ss mau? 
        // wokeh, terus, arep dipiekke? 
        //dicek, email sek neng database karo sek diinput user, nek podo tampilke email sudah terdaftar, nek bedo rpp
        // iyo, rpp :D

        // oke, email sek arep di daftar sek endi? 
        //emaile bebas 
        // woke, terus, array sek isine email sek iki? 
        //heem

        //validasi input
        if (!$this->validate([
            'username' => [
                'rules'     => $rule_username,
                'errors'    => [
                    'required'    => 'Username harus diisi!',
                    'max_length'  => 'Username maksimal 20 karakter!',
                    'is_unique'   => 'Username sudah terdaftar!'
                ]
            ],

            'nama_lengkap' => [
                'rules'     => 'required|max_length[50]',
                'errors'    => [
                    'required'      => 'Nama lengkap harus diisi!',
                    'max_length'    => 'Nama Lengkap terlalu panjang!'
                ]
            ],

            'desc_profile' => [
                'rules'     => 'required|max_length[100]',
                'errors'    => [
                    'required'      => 'Deskripsi harus diisi!',
                    'max_length'    => 'Deskripsi terlalu panjang!'
                ]
            ],

            'email' => [
                'rules'     => $rule_email,
                'errors'    => [
                    'required'      => 'Email harus diisi!',
                    'valid_email'   => 'Email tidak valid!',
                    'is_unique'     => 'Email sudah terdaftar!'
                ]
            ],

            'password' => [
                'rules'     => 'required',
                'errors'    => [
                    'required'      => 'Password harus diisi!'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            // dd($validation);
            // return redirect()->to('/create')->withInput()->with('validation', $validation);
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        $options = [
            'cost' => 10,
        ];

        $getPassword = $this->request->getVar('password');
        $password_hash = password_hash($getPassword, PASSWORD_DEFAULT, $options);

        $getNamaLengkap = $this->request->getVar('nama_lengkap');
        $nama_lengkap = ucwords($getNamaLengkap);

        $user = new LoginModel();
        $data_insert = [
            'username'     => $this->request->getVar('username'),
            'password'     => $password_hash,
            'email'        => $this->request->getVar('email'),
            'nama_lengkap' => $nama_lengkap,
            'level'        => $this->request->getVar('level')
        ];

        $user->insert($data_insert);
        $user_id = $user->getInsertID();

        //1. ambil file gambar foto profile
        $file_foto = $this->request->getFile('foto');

        //apakah tidak ada gambar yang diupload
        if ($file_foto->getError() == 4) {
            $nama_fileFoto = 'defaultProfile.jpg';
        } else {
            //2. pindahkan file gambar sampul ke folder img
            $file_foto->move('assets/img/profile');

            //3. ambil nama file gambar sampul
            $nama_fileFoto = $file_foto->getName();
        }

        $data_insertProfile = [
            'user_id' => $user_id,
            'describe_profile' => $this->request->getVar('desc_profile'),
            'photo_profile' => $nama_fileFoto
        ];

        $db      = \Config\Database::connect();
        $profile = $db->table('profile');
        $profile->insert($data_insertProfile);

        session()->setFlashdata('pesan_insert', 'Registrasi berhasil, silakan login!');

        return redirect()->to('/login');
    }

    public function logout()
    {
        session()->remove('user_id');

        return redirect()->to('/login');
    }
}
