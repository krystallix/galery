<?php

namespace App\Controllers\Pengguna;

use App\Controllers\BaseController;

use App\Models\GaleriModel;
use App\Models\CommentModel;
use App\Models\LoginModel;
use App\Models\ProfileModel;
use App\Models\LikeModel;

class Pengguna extends BaseController
{
    protected $galeriModel;
    protected $commentModel;
    protected $loginModel;
    protected $profileModel;
    protected $likeModel;

    public function __construct()
    {
        $this->galeriModel = new GaleriModel();
        $this->commentModel = new CommentModel();
        $this->loginModel = new LoginModel();
        $this->profileModel = new ProfileModel();
        $this->likeModel = new LikeModel();
    }

    public function index()
    {
        $keyword = $this->request->getVar('keyword');

        $data = [
            'title'     => 'PHOTOMe | Home',
            'foto'      => $this->galeriModel->getFotoKeyword($keyword)
        ];

        return view('pengguna/halaman_utama/pengguna', $data);
    }

    public function detailFoto($id_photo)
    {
        $data = [
            'title'       => 'GaleriFoto | Detail',
            'detail_foto' => $this->galeriModel->getWhere($id_photo),
            'comment'     => $this->commentModel->getComment($id_photo),
            'uri'         => $this->request->getUri(),
            'validation'  => \Config\Services::validation()
        ];

        // dd($data['comment']);

        return view('pengguna/halaman_utama/detail_foto', $data);
    }



    public function addComment($id_photo, $user_id)
    {
        //validasi input
        if (!$this->validate([
            'comment' => [
                'rules'     => 'max_length[300]',
                'errors'    => [
                    'max_length'    => 'Komentar terlalu panjang!'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            // dd($validation);
            // return redirect()->to('/create')->withInput()->with('validation', $validation);
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        $this->commentModel->save([
            'comment'  => $this->request->getVar('comment'),
            'id_photo' => $id_photo,
            'user_id'  => $user_id
        ]);

        return redirect()->to('/detail/' . $id_photo);
    }

    public function tambahFoto()
    {
        $data = [
            'title'         => 'GaleriFoto | Post Foto',
            'validation'    => \Config\Services::validation()
        ];

        return view('pengguna/halaman_utama/tambah_foto', $data);
    }

    public function postFoto()
    {
        //validasi input
        if (!$this->validate([
            // 'foto' => [
            //     'rules'     => 'required',
            //     'errors'    => [
            //         'required'      => 'Pilih foto yang akan dipost!'
            //     ]
            // ],

            'judul_foto' => [
                'rules'     => 'required|max_length[50]',
                'errors'    => [
                    'required'      => 'Judul foto harus diisi!',
                    'max_length'    => 'Judul foto terlalu panjang!'
                ]
            ],

            'deskripsi' => [
                'rules'     => 'required|max_length[300]',
                'errors'    => [
                    'required'      => 'Deskripsi foto harus diisi!',
                    'max_length'    => 'Deskripsi foto terlalu panjang!'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            // dd($validation);
            // return redirect()->to('/create')->withInput()->with('validation', $validation);
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        //1. ambil file gambar foto profile
        $file_foto = $this->request->getFile('foto');

        //2. pindahkan file gambar sampul ke folder img
        $file_foto->move('assets/img/gallery');

        //3. ambil nama file gambar sampul
        $nama_fileFoto = $file_foto->getName();

        $user_id = userLogin()->user_id;

        $galeri = new GaleriModel();
        $data_insert = [
            'photo' => $nama_fileFoto,
            'judul_foto'   => $this->request->getVar('judul_foto'),
            'describe_photo' => $this->request->getVar('deskripsi'),
            'user_id'       => $user_id
        ];

        $galeri->insert($data_insert);
        $id_photo = $galeri->getInsertID();

        // $this->galeriModel->save([
        //     'photo' => $nama_fileFoto,
        //     'judul_foto'   => $this->request->getVar('judul_foto'),
        //     'describe_photo' => $this->request->getVar('deskripsi'),
        //     'user_id'       => $user_id
        // ]);

        session()->setFlashdata('pesan_insert', 'Berhasil post foto!');

        return redirect()->to('/detail/' . $id_photo);
    }

    public function myProfile()
    {
        $user_id = userLogin()->user_id;

        $data = [
            'title'     => 'GaleriFoto | My Profile',
            'foto'      => $this->galeriModel->getFotoUser($user_id)
        ];

        // dd($data['foto']);

        return view('pengguna/profile/my_profile', $data);
    }

    public function deleteFoto($id_photo)
    {
        $foto = $this->galeriModel->getFotoWhere($id_photo);

        foreach ($foto as $f) {
            $nama_foto = $f->photo;
        }

        // dd($nama_foto);

        unlink('assets/img/gallery/' . $nama_foto);

        $this->galeriModel->delete($id_photo);
        $this->commentModel->deleteComment($id_photo);
        $this->likeModel->deleteLikeFoto($id_photo);

        // unlink('../assets/img/gallery/' . $nama_foto);

        session()->setFlashdata('pesan_delete', 'Foto berhasil dihapus!');

        return redirect()->to('/my-profile');
    }

    public function edit($id_photo)
    {
        $data = [
            'title'     => 'GaleriFoto | Edit Foto',
            'edit_foto' => $this->galeriModel->getEditFoto($id_photo),
            'validation'    => \Config\Services::validation()
        ];

        return view('pengguna/profile/edit_foto', $data);
    }

    public function update($id_photo)
    {
        //validasi input
        if (!$this->validate([

            'judul_foto' => [
                'rules'     => 'required|max_length[50]',
                'errors'    => [
                    'required'      => 'Judul foto harus diisi!',
                    'max_length'    => 'Judul foto terlalu panjang!'
                ]
            ],

            'deskripsi' => [
                'rules'     => 'required|max_length[300]',
                'errors'    => [
                    'required'      => 'Deskripsi foto harus diisi!',
                    'max_length'    => 'Deskripsi foto terlalu panjang!'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            // dd($validation);
            // return redirect()->to('/create')->withInput()->with('validation', $validation);
            return redirect()->back()->withInput()->with('validation', $validation);
        }


        //ambil file gambar foto 
        $file_foto = $this->request->getFile('foto');
        $nama_fileFoto = $file_foto->getName();

        if ($nama_fileFoto == "") {

            $user_id = userLogin()->user_id;

            $this->galeriModel->save([
                'id_photo'          => $id_photo,
                'judul_foto'        => $this->request->getVar('judul_foto'),
                'describe_photo'    => $this->request->getVar('deskripsi'),
                'user_id'           => $user_id
            ]);
        } else {
            $db      = \Config\Database::connect();
            $query = $db->table('gallery')->select('photo')->getWhere(['id_photo' => $id_photo]);
            $fotoLama = $query->getRow();

            //pindahkan file gambar sampul ke folder img
            $file_foto->move('assets/img/gallery');

            //simpan ke database
            $user_id = userLogin()->user_id;

            $this->galeriModel->save([
                'id_photo'          => $id_photo,
                'photo'             => $nama_fileFoto,
                'judul_foto'        => $this->request->getVar('judul_foto'),
                'describe_photo'    => $this->request->getVar('deskripsi'),
                'user_id'           => $user_id
            ]);

            unlink('assets/img/gallery/' . $fotoLama->photo);
        }





        // //1. ambil file gambar foto profile
        // $file_foto = $this->request->getFile('foto');

        // // dd($file_foto);

        // //2. pindahkan file gambar sampul ke folder img
        // $file_foto->move('assets/img/gallery');

        // //3. ambil nama file gambar sampul
        // $nama_fileFoto = $file_foto->getName();

        // unlink('assets/img/gallery/' . $nama_fileFoto);

        // $user_id = userLogin()->user_id;

        // $this->galeriModel->save([
        //     'id_photo'          => $id_photo,
        //     'photo'             => $nama_fileFoto,
        //     'judul_foto'        => $this->request->getVar('judul_foto'),
        //     'describe_photo'    => $this->request->getVar('deskripsi'),
        //     'user_id'           => $user_id
        // ]);




        session()->setFlashdata('pesan_edit', 'Foto berhasil diubah!');

        return redirect()->to('/my-profile');
    }

    public function editProfile()
    {
        $data = [
            'title'     => 'GaleriFoto | Edit Profile',
            'user'      => userLogin(),
            'profile'   => userProfileLogin(),
            'password'  => userLogin()->password,
            'validation'    => \Config\Services::validation()
        ];

        return view('pengguna/profile/edit_profile', $data);
    }

    public function updateProfile($user_id)
    {
        // // List email terdaftar dari database
        // $emailTerdaftar = $this->loginModel->getEmail();

        // // email yang akan di cek, ambil dari inputan user
        // $NewEmailRegistration = $this->request->getVar('email');

        // // cek email apakah sudah terdaftar?
        // for ($i = 0; $i < count($emailTerdaftar); $i++) {
        //     if ($emailTerdaftar[$i]->email == $NewEmailRegistration) {

        //         $rule_email = 'required|valid_email';
        //         break;
        //     } else {
        //         $rule_email = 'required|valid_email|is_unique[user.email]';
        //     }
        // }



        // // List username terdaftar dari database
        // $userTerdaftar = $this->loginModel->getUsername();

        // // username yang akan di cek, ambil dari inputan user
        // $NewUsernameRegistration = $this->request->getVar('username');

        // // cek username apakah sudah terdaftar?
        // for ($i = 0; $i < count($userTerdaftar); $i++) {
        //     if ($userTerdaftar[$i]->username == $NewUsernameRegistration) {
        //         $rule_username = 'required|max_length[20]';
        //         break;
        //     } else {
        //         $rule_username = 'required|max_length[20]|is_unique[user.username]';
        //     }
        // }





        $db      = \Config\Database::connect();
        $query = $db->table('user')->select('username')->getWhere(['user_id' => $user_id]);
        $user = $query->getRow();
        $usernameLama = $user->username;


        // cek username
        $usernameNew = $this->request->getVar('username');

        if ($usernameNew == $usernameLama) {
            $rule_username = 'required|max_length[20]';
        } else {
            $rule_username = 'required|max_length[20]|is_unique[user.username]';
        }


        //cek email
        $db      = \Config\Database::connect();
        $query = $db->table('user')->select('email')->getWhere(['user_id' => $user_id]);
        $user = $query->getRow();
        $emailLama = $user->email;


        // email yang akan di cek, ambil dari inputan user
        $emailNew = $this->request->getVar('email');

        if ($emailNew == $emailLama) {
            $rule_email = 'required|valid_email';
        } else {
            $rule_email = 'required|valid_email|is_unique[user.email]';
        }



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

            'deskripsi_profile' => [
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
            ]
        ])) {
            $validation = \Config\Services::validation();
            // dd($validation);
            // return redirect()->to('/create')->withInput()->with('validation', $validation);
            return redirect()->back()->withInput()->with('validation', $validation);
        }


        //get password
        $password = $this->request->getVar('password');
        if (!$password == "") {
            $options = [
                'cost' => 10,
            ];

            $getPassword = $this->request->getVar('password');
            $password_hash = password_hash($getPassword, PASSWORD_DEFAULT, $options);

            $getNamaLengkap = $this->request->getVar('nama_lengkap');
            $nama_lengkap = ucwords($getNamaLengkap);

            $this->loginModel->save([
                'user_id'      => $this->request->getVar('user_id'),
                'username'     => $this->request->getVar('username'),
                'password'     => $password_hash,
                'email'        => $this->request->getVar('email'),
                'nama_lengkap' => $nama_lengkap,
                'level'        => $this->request->getVar('level')
            ]);
        } else {
            $getNamaLengkap = $this->request->getVar('nama_lengkap');
            $nama_lengkap = ucwords($getNamaLengkap);

            $this->loginModel->save([
                'user_id'      => $this->request->getVar('user_id'),
                'username'     => $this->request->getVar('username'),
                'email'        => $this->request->getVar('email'),
                'nama_lengkap' => $nama_lengkap,
                'level'        => $this->request->getVar('level')
            ]);
        }


        //get foto profile
        $profileLama = userProfileLogin()->photo_profile;
        $profileBaru = $this->request->getfile('foto');


        if ($profileBaru->getError() == 4) {
            $photo_profile = $profileLama;
        } else {
            //2. ambil nama file gambar sampul
            $photo_profile = $profileBaru->getName();

            unlink('assets/img/profile/' . $profileLama);

            //3. pindahkan file gambar sampul ke folder img
            $profileBaru->move('assets/img/profile');

            //3. ambil nama file gambar sampul
            // $photo_profile = $profileBaru->getName();
        }



        $this->profileModel->save([
            'profile_id' => $this->request->getVar('profile_id'),
            'user_id' => $this->request->getVar('user_id'),
            'describe_profile' => $this->request->getVar('deskripsi_profile'),
            'photo_profile' => $photo_profile
        ]);

        // if (!$profileLama == $photo_profile) {
        //     unlink('assets/img/profile/' . $photo_profile);
        // }

        session()->setFlashdata('pesan_edit', 'Profile berhasil diubah!');

        return redirect()->to('/my-profile');
    }

    public function userProfile($user_id)
    {
        $data = [
            'title'     => 'GaleriFoto | User',
            'user'      => $this->profileModel->getUserWhere($user_id),
            'foto'      => $this->galeriModel->getFotoUser($user_id)
        ];

        $userLain = $this->profileModel->getUserWhere($user_id);

        for ($i = 0; $i < count($userLain); $i++) {
            if ($userLain[$i]->user_id == userLogin()->user_id) {
                return redirect()->to(site_url('my-profile'));
                break;
            } else {
                return view('pengguna/halaman_utama/profile_user', $data);
            }
        }
    }

    // public function LikeUnlike($id_photo, $user_id)
    public function LikeUnlike($JsonData)
    {

        //decode data dari json
        // $DecodeData = json_decode($JsonData);

        $id_photo = "4";
        $user_id = "2";



        // fungsi untuk simpan ke database
        // $this->likeModel->save([
        //     'id_photo'  => $id_photo,
        //     'user_id'  => $user_id
        // ]);

        // echo "sukses like";


        // fungsi untuk cek ke database, apakah user sudah like photo? where user_id= && id_photo= '
        $cekLike = $this->likeModel->searchLike($id_photo, $user_id);

        // $where = array('id_photo' => $id_photo, 'user_id' => $user_id);
        // $this->likeModel->get($where, $table_name);

        // $db      = \Config\Database::connect();
        // $query = $db->table('like')->getWhere(['id_photo' => $id_photo]);
        // $user = $query->getRow();
        // $photo = $cekLike[1]->user_id;
        // dd($photo);

        // $id = "1";
        // $idu = "3";

        // if ($id == $id_photo && $idu == $user_id) {
        //     echo "sama";
        // } else {
        //     echo "beda";
        // }




        if (count($cekLike) == 0) {
            // tambahkan like
            $this->likeModel->save([
                'id_photo'  => $id_photo,
                'user_id'  => $user_id
            ]);
        } else {
            // hapus like

            $this->likeModel->deleteLike($id_photo, $user_id);
        }


        // fungsi untuk menghapus like dari database. 

        // Cara cek : 
        // isi user id dan id photo diatas. 
        // jalankan program langsung dari web dengan url. 




        // $Data = "sukses";

        // echo json_encode($Data);

        // return $this->respond($data, 200);

        // dd($JsonData);
        // //validasi input
        // if (!$this->validate([
        //     'comment' => [
        //         'rules'     => 'max_length[300]',
        //         'errors'    => [
        //             'max_length'    => 'Komentar terlalu panjang!'
        //         ]
        //     ]
        // ])) {
        //     $validation = \Config\Services::validation();
        //     // dd($validation);
        //     // return redirect()->to('/create')->withInput()->with('validation', $validation);
        //     return redirect()->back()->withInput()->with('validation', $validation);
        // }

        // $this->commentModel->save([
        //     'comment'  => $this->request->getVar('comment'),
        //     'id_photo' => $id_photo,
        //     'user_id'  => $user_id
        // ]);

        // return redirect()->to('/detail/' . $id_photo);
    }
}
