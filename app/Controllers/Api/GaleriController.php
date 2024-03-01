<?php

namespace App\Controllers\Api;

use App\Models\GaleriModel;
use App\Models\CommentModel;
use App\Models\LikeModel;


use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class GaleriController extends ResourceController
{
    protected $galeriModel;
    protected $commentModel;
    protected $likeModel;



    public function __construct()
    {
        $this->galeriModel = new GaleriModel();
        $this->commentModel = new CommentModel();
        $this->likeModel = new LikeModel();

    }

    public function getPhoto(){

        $data = [
            'foto'  => $this->galeriModel->getFoto()
        ];

        return $this->respond($data, 200);

    }
    public function getUserPhoto(){
        $request = \Config\Services::request();

        $user_id = $request->getPost('user_id');
        
        $data = [
            'foto'  => $this->galeriModel->getFotoUser($user_id)
        ];

        return $this->respond($data, 200);
    }

    public function deletePhoto(){
        $request = \Config\Services::request();
        $id_photo = $request->getPost('id_photo');
        $user_id = $request->getPost('user_id');

     

        $foto = $this->galeriModel->getFotoWhere($id_photo);
        foreach ($foto as $f) {
            $nama_foto = $f->photo;
        }

        unlink('assets/img/gallery/' . $nama_foto);

        $this->galeriModel->delete($id_photo);
        $this->likeModel->deleteLikeFoto($id_photo);
        $this->commentModel->deleteComment($id_photo);

        return $this->respond("sukses", 200);
    }

    public function EditPhoto(){
        $request = \Config\Services::request();
        $id_photo = $request->getPost('id_photo');
        $judul = $request->getPost('judul_foto');
        $deskripsi = $request->getPost('deskripsi');
        $user_id = $request->getPost('user_id');

        $this->galeriModel->save([
            'id_photo'          => $id_photo,
            'judul_foto'        => $judul,
            'describe_photo'    => $deskripsi,
            'user_id'           => $user_id
        ]);

        return $this->respond("sukses", 200);

    }
}
