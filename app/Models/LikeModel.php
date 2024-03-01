<?php

namespace App\Models;

use CodeIgniter\Model;

class LikeModel extends Model
{
    protected $table      = 'like';
    protected $primaryKey = 'id_like';
    protected $allowedFields = ['id_photo', 'user_id'];

    public function searchLike($id_photo, $user_id)
    {
        return $this->where('id_photo', $id_photo)
            ->where('user_id', $user_id)
            ->get()
            ->getResult();
    }

    public function deleteLike($id_photo, $user_id)
    {
        return $this->where('id_photo', $id_photo)
            ->where('user_id', $user_id)
            ->delete();
    }

    public function totalLike($id_photo)
    {
        return $this->where('id_photo', $id_photo)
            ->countAllResults();
    }

    public function hasLikedPhoto($id_photo, $user_id)
    {
        return $this->where('id_photo', $id_photo)
            ->where('user_id', $user_id)
            ->countAllResults() > 0;
    }



    public function jumlahLike($id_photo)
    {
        $db = db_connect();
        $builder = $db->table('like');
        $builder->selectCount('user_id');
        $builder->where('id_photo', $id_photo);
        $query   = $builder->get();
        return $query->getResult();
    }

    public function deleteLikeFoto($id_photo)
    {
        $db = db_connect();
        $builder = $db->table('like');
        $builder->delete(['id_photo' => $id_photo]);
        $query   = $builder->get();
        return $query->getResult();
    }

    public function jumlahLikeUser($user_id)
    {
        $db = db_connect();
        $builder = $db->table('like');
        $builder->selectCount('id_photo');
        $builder->where('user_id', $user_id);
        $query   = $builder->get();
        return $query->getRow();
    }

    public function deleteLikeUser($user_id)
    {
        $db = db_connect();
        $builder = $db->table('like');
        $builder->delete(['user_id' => $user_id]);
    }
}
