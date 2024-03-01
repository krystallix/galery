<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\LoginModel;
use App\Models\GaleriModel;
use App\Models\CommentModel;
use App\Models\LikeModel;
use App\Models\ProfileModel;
use App\Models\LoginUserModel;

class DataPengguna extends BaseController
{
    protected $loginModel;
    protected $galeriModel;
    protected $commentModel;
    protected $likeModel;
    protected $profileModel;
    protected $loginUserModel;

    public function __construct()
    {
        $this->loginModel = new LoginModel();
        $this->galeriModel = new GaleriModel();
        $this->commentModel = new CommentModel();
        $this->likeModel = new LikeModel();
        $this->profileModel = new ProfileModel();
        $this->loginUserModel = new LoginUserModel();
    }

    public function index()
    {
        // $data = [
        //     'title'     => 'Admin | GaleriFoto | Data Pengguna',
        //     'menu'      => 'pengguna',
        //     'pengguna'  => $this->loginModel->getUser()
        // ];

        $keyword = $this->request->getVar('keyword');
        $data = $this->loginModel->getPaginated(8, $keyword);
        $data['title']  = 'Admin | GaleriFoto | Data Pengguna';
        $data['menu']   = 'pengguna';
        $data['keyword']    = $keyword;

        return view('admin/dataPengguna/data_pengguna', $data);
    }

    public function detail($user_id)
    {
        $data = [
            'title'         => 'Admin | GaleriFoto | Data Pengguna | Detail',
            'menu'          => 'pengguna',
            'pengguna'      => $this->loginModel->getUserWhere($user_id),
            'jumlahPost'    => $this->galeriModel->jumlahPost($user_id),
            'jumlahComment' => $this->commentModel->jumlahCommentUser($user_id),
            'jumlahLike'    => $this->likeModel->jumlahLikeUser($user_id)
        ];

        return view('admin/dataPengguna/detail_pengguna', $data);
    }

    public function tambahPengguna()
    {
        $data = [
            'title'     => 'Admin | GaleriFoto | Data Pengguna | Tambah Pengguna',
            'menu'      => 'pengguna',
            'validation'    => \Config\Services::validation()
        ];

        return view('admin/dataPengguna/add_pengguna', $data);
    }

    public function savePengguna()
    {

        // List email terdaftar dari database
        $emailTerdaftar = $this->loginModel->getEmail();

        // email yang akan di cek, ambil dari inputan user
        $emailBaru = $this->request->getVar('email');

        // cek email apakah sudah terdaftar?
        for ($i = 0; $i < count($emailTerdaftar); $i++) {
            if ($emailTerdaftar[$i]->email == $emailBaru) {

                $rule_email = 'required|valid_email|is_unique[user.email]';
                break;
            } else {
                $rule_email = 'required|valid_email';
            }
        }

        // List username terdaftar dari database
        $userTerdaftar = $this->loginModel->getUsername();

        // username yang akan di cek, ambil dari inputan user
        $usernameBaru = $this->request->getVar('username');

        for ($i = 0; $i < count($userTerdaftar); $i++) {
            if ($userTerdaftar[$i]->username == $usernameBaru) {

                $rule_username = 'required|max_length[20]|is_unique[user.username]';
                break;
            } else {
                $rule_username = 'required|max_length[20]';
            }
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

        session()->setFlashdata('pesan_insert', 'Tambah data pengguna berhasil!');

        return redirect()->to('/admin/pengguna');
    }

    public function editPengguna($user_id)
    {
        $data = [
            'title'     => 'Admin | GaleriFoto | Data Pengguna | Edit Pengguna',
            'menu'      => 'pengguna',
            'user'      => $this->loginModel->getEditUser($user_id),
            'validation'    => \Config\Services::validation()
        ];

        return view('admin/dataPengguna/edit_pengguna', $data);
    }

    public function updatePengguna($user_id)
    {
        $db             = \Config\Database::connect();
        $query          = $db->table('user')->select('username')->getWhere(['user_id' => $user_id]);
        $user           = $query->getRow();
        $usernameLama   = $user->username;

        // cek username
        $usernameNew = $this->request->getVar('username');

        if ($usernameNew == $usernameLama) {
            $rule_username = 'required|max_length[20]';
        } else {
            $rule_username = 'required|max_length[20]|is_unique[user.username]';
        }

        //cek email
        $db         = \Config\Database::connect();
        $query      = $db->table('user')->select('email')->getWhere(['user_id' => $user_id]);
        $user       = $query->getRow();
        $emailLama  = $user->email;


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
        $db      = \Config\Database::connect();
        $query = $db->table('profile')->select('photo_profile')->getWhere(['user_id' => $user_id]);
        $profile = $query->getRow();

        $profileLama = $profile->photo_profile;
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

        session()->setFlashdata('pesan_edit', 'Data pengguna berhasil diubah!');

        return redirect()->to('/admin/pengguna');
    }

    public function deletePengguna($user_id)
    {
        $this->loginModel->deleteUser($user_id);
        $this->profileModel->deleteProfile($user_id);
        $this->galeriModel->deleteFoto($user_id);
        $this->likeModel->deleteLikeUser($user_id);
        $this->commentModel->deleteCommentUser($user_id);
        $this->loginUserModel->deleteUserLogin($user_id);

        // $db      = \Config\Database::connect();
        // $this->$db->table('user')->delete(['user_id' => $user_id]);
        // $this->$db->table('profile')->delete(['user_id' => $user_id]);
        // $this->$db->table('gallery')->delete(['user_id' => $user_id]);
        // $this->$db->table('like')->delete(['user_id' => $user_id]);
        // $this->$db->table('comment_log')->delete(['user_id' => $user_id]);
        // $this->$db->table('user_login')->delete(['user_id' => $user_id]);

        session()->setFlashdata('pesan_delete', 'Data pengguna berhasil dihapus!');
        return redirect()->to('/admin/pengguna');
    }
}
