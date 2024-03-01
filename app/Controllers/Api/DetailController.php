<?php

namespace App\Controllers\Api;

use App\Models\GaleriModel;
use App\Models\CommentModel;
use App\Models\LikeModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class DetailController extends ResourceController
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

    public function showDetail($id_photo)
    {
        $data = [
            'title'       => 'GaleriFoto | Detail',
            'detail_foto' => $this->galeriModel->getWhere($id_photo),
            'totalLike'   => $this->likeModel->totalLike($id_photo),
            'comment'     => $this->commentModel->getComment($id_photo),
            'uri'         => $this->request->getUri(),
        ];

        return $this->respond($data, 200);
    }

    public function comment() {
        $request = \Config\Services::request();
        $id_photo = $request->getPost('id_photo');
        $user_id = $request->getPost('user_id');
        $comment = $request->getPost('comment');
    
        // validasi input
        $validationRules = [
            'comment' => [
                'rules'  => 'max_length[300]',
                'errors' => [
                    'max_length' => 'Komentar terlalu panjang!'
                ]
            ]
        ];
    
        if (!$this->validate($validationRules)) {
            $validation = \Config\Services::validation();
            return json_encode(['error' => $validation->getErrors()]);
        }
    
        $this->commentModel->save([
            'comment'  => $comment,
            'id_photo' => $id_photo,
            'user_id'  => $user_id
        ]);
    
        // get comment
        $comments =  $this->commentModel->getComment($id_photo);
    
        return $this->respond(['data' => $comments, 'status' => "sukses"], 200);
    }
    
}
