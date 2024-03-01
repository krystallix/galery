<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\GaleriModel;
use App\Models\CommentModel;
use App\Models\LikeModel;
use App\Models\LoginModel;
use App\Models\ProfileModel;

class ProfileAdmin extends BaseController
{
    protected $galeriModel;
    protected $commentModel;
    protected $likeModel;
    protected $loginModel;
    protected $profileModel;

    public function __construct()
    {
        $this->galeriModel = new GaleriModel();
        $this->commentModel = new CommentModel();
        $this->likeModel = new LikeModel();
        $this->loginModel = new LoginModel();
        $this->profileModel = new ProfileModel();
    }

    public function index()
    {
        $user_id = userLogin()->user_id;

        $data = [
            'title'     => 'Admin | GaleriFoto | My Profile',
            'menu'      => '',
            'foto'      => $this->galeriModel->getFotoUser($user_id)
        ];

        return view('admin/profileAdmin/profile_admin', $data);
    }

    public function deleteFoto($id_photo)
    {
        $foto = $this->galeriModel->getFotoWhere($id_photo);

        foreach ($foto as $f) {
            $nama_foto = $f->photo;
        }

        unlink('assets/img/gallery/' . $nama_foto);

        $this->galeriModel->delete($id_photo);
        $this->commentModel->deleteComment($id_photo);
        $this->likeModel->deleteLikeFoto($id_photo);

        session()->setFlashdata('pesan_delete', 'Foto berhasil dihapus!');

        return redirect()->to('/admin/profile');
    }

    public function edit($id_photo)
    {
        $data = [
            'title'         => 'Admin | GaleriFoto | Edit',
            'menu'          => '',
            'edit_foto'     => $this->galeriModel->getEditFoto($id_photo),
            'validation'    => \Config\Services::validation()
        ];

        return view('admin/profileAdmin/edit_foto_admin', $data);
    }

    public function updateFoto($id_photo)
    {
        // //validasi input
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

        session()->setFlashdata('pesan_edit', 'Foto berhasil diubah!');

        return redirect()->to('/admin/profile');
    }

    public function editProfile()
    {
        $data = [
            'title'     => 'Admin | GaleriFoto | Edit Profile',
            'menu'      => '',
            'user'      => userLogin(),
            'profile'   => userProfileLogin(),
            'password'  => userLogin()->password,
            'validation'    => \Config\Services::validation()
        ];

        return view('admin/profileAdmin/edit_profile_admin', $data);
    }

    public function updateProfile($user_id)
    {
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

        session()->setFlashdata('pesan_edit', 'Profile berhasil diubah!');

        return redirect()->to('/admin/profile');
    }
}
