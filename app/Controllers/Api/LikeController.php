<?php

namespace App\Controllers\Api;

use App\Models\GaleriModel;
use App\Models\LikeModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class LikeController extends ResourceController
{
    protected $galeriModel;
    protected $likeModel;
    
    public function __construct()
    {
        $this->galeriModel = new GaleriModel();
        $this->likeModel = new LikeModel();
    }

    public function Likes()
    {
        $request = \Config\Services::request();

        $id_photo = $request->getPost('id_photo');
        $user_id = $request->getPost('user_id');
        
        $cekLike = $this->likeModel->searchLike($id_photo, $user_id);        

        if (count($cekLike) == 0) {
            // tambahkan like
            $this->likeModel->save([
                'id_photo'  => $id_photo,
                'user_id'   => $user_id
            ]);

            $totalLike = $this->likeModel->totalLike($id_photo);
            return $this->respond(['status' => 'Liked', 'totalLike' => $totalLike], 200);
        } else {
            // hapus like
            $this->likeModel->deleteLike($id_photo, $user_id);

            $totalLike = $this->likeModel->totalLike($id_photo);
            return $this->respond(['status' => 'unLiked', 'totalLike' => $totalLike], 200);
        }
    }

    public function hasLiked(){
        $request = \Config\Services::request();

        $json = $request->getJSON();

        $id_photo = $json->id_photo;
        $user_id = $json->user_id;


        $hasLiked = $this->likeModel->hasLikedPhoto($id_photo, $user_id);

        return $this->response->setJSON(['hasLiked' => $hasLiked]);

    }
}
