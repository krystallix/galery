<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\GaleriModel;
use App\Models\CommentModel;
use App\Models\LikeModel;
use App\Models\ProfileModel;
use App\Models\LoginUserModel;

class Admin extends BaseController
{
    protected $galeriModel;
    protected $commentModel;
    protected $likeModel;
    protected $profileModel;
    protected $loginUserModel;

    public function __construct()
    {
        $this->galeriModel = new GaleriModel();
        $this->commentModel = new CommentModel();
        $this->likeModel = new LikeModel();
        $this->profileModel = new ProfileModel();
        $this->loginUserModel = new LoginUserModel();
    }

    public function index()
    {
        $keyword = $this->request->getVar('keyword');

        $data = [
            'title'     => 'Admin | GaleriFoto | Dashboard',
            'menu'      => 'dashboard',
            'foto'      => $this->galeriModel->getFotoKeyword($keyword)
        ];

        return view('admin/admin', $data);
    }

    public function detailFoto($id_photo)
    {
        // $uri = $this->request->getUri();
        // $host = $uri->getHost();
        // $post = $uri->getPort();
        // $path = $uri->getPath();

        $host = $this->request->getUri()->getHost();
        $port = $this->request->getUri()->getPort();
        $path = $this->request->getPath();
        $uri = $host . ":" . $port . "/" . $path;

        // dd($uri);

        $data = [
            'title'         => 'Admin | GaleriFoto | Detail',
            'menu'          => '',
            'detail_foto'   => $this->galeriModel->getWhere($id_photo),
            'comment'       => $this->commentModel->getComment($id_photo),
            'jumlah_comment' => $this->commentModel->jumlahComment($id_photo),
            'jumlah_like'   => $this->likeModel->jumlahLike($id_photo),
            'uri'           => $uri
        ];

        return view('admin/detail_foto_admin', $data);
    }

    public function deleteFotoPengguna($id_photo)
    {
        $this->galeriModel->deleteFotoPengguna($id_photo);
        $this->commentModel->deleteComment($id_photo);
        $this->likeModel->deleteLikeFoto($id_photo);

        session()->setFlashdata('pesan_delete', 'Foto berhasil dihapus!');
        return redirect()->to('/admin');
    }

    public function deleteComment($id_photo, $user_id)
    {
        $this->commentModel->adminDeleteComment($id_photo, $user_id);

        session()->setFlashdata('pesan_delete', 'Komentar berhasil dihapus!');

        return redirect()->to('/admin/detail/' . $id_photo);
    }

    public function postFoto()
    {
        $data = [
            'title'     => 'Admin | GaleriFoto | Post',
            'menu'      => 'post',
            'validation'    => \Config\Services::validation()
        ];

        return view('admin/post_foto_admin', $data);
    }

    public function saveFoto()
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

        //1. ambil file gambar foto 
        $file_foto = $this->request->getFile('foto');

        //2. pindahkan file foto ke folder img
        $file_foto->move('assets/img/gallery');

        //3. ambil nama file foto
        $nama_fileFoto = $file_foto->getName();

        $user_id = userLogin()->user_id;

        $galeri = new GaleriModel();
        $data_insert = [
            'photo'             => $nama_fileFoto,
            'judul_foto'        => $this->request->getVar('judul_foto'),
            'describe_photo'    => $this->request->getVar('deskripsi'),
            'user_id'           => $user_id
        ];

        $galeri->insert($data_insert);
        $id_photo = $galeri->getInsertID();

        session()->setFlashdata('pesan_insert', 'Foto berhasil dipost!');

        return redirect()->to('/admin/detail/' . $id_photo);
    }

    public function profileUser($user_id)
    {
        $data = [
            'title'     => 'Admin | GaleriFoto | Profile User',
            'menu'      => '',
            'user'      => $this->profileModel->getUserWhere($user_id),
            'foto'      => $this->galeriModel->getFotoUser($user_id)
        ];

        $userLain = $this->profileModel->getUserWhere($user_id);

        for ($i = 0; $i < count($userLain); $i++) {
            if ($userLain[$i]->user_id == userLogin()->user_id) {
                return redirect()->to(site_url('admin/profile'));
                break;
            } else {
                return view('admin/profile_user', $data);
            }
        }
    }

    public function search()
    {
        $keyword = $this->request->getVar('keyword');

        $data = [
            'title'     => 'Admin | GaleriFoto | Dashboard',
            'menu'      => 'dashboard',
            'foto'      => $this->galeriModel->getKeyword($keyword)
        ];

        return view('admin/admin', $data);
    }

    public function traffic()
    {
        $keyword = $this->request->getVar('keyword');
        $data = $this->loginUserModel->getPaginated(8, $keyword);
        $data['title']  = 'Admin | GaleriFoto | Login History';
        $data['menu']   = 'pengguna';
        $data['keyword']    = $keyword;

        return view('admin/traffic', $data);
    }
}
