<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $table      = 'user';
    protected $primaryKey = 'user_id';
    protected $allowedFields = ['username', 'password', 'email', 'nama_lengkap', 'level'];

    public function getEmail()
    {
        $db = db_connect();
        $builder = $db->table('user');
        $builder->select('email');
        $query   = $builder->get();
        return $query->getResult();
    }

    public function getUsername()
    {
        $db = db_connect();
        $builder = $db->table('user');
        $builder->select('username');
        $query   = $builder->get();
        return $query->getResult();
    }

    public function getUser()
    {
        $db = db_connect();
        $builder = $db->table('user');
        $builder->orderBy('user_id', 'ASC');
        $query = $builder->get();
        return $query->getResult();
    }

    public function getUserWhere($user_id)
    {
        $db = db_connect();
        $builder = $db->table('user');
        $builder->select('user.user_id, user.username, user.email, user.nama_lengkap, profile.describe_profile, profile.photo_profile');
        $builder->join('profile', 'user.user_id = profile.user_id');
        $builder->where('user.user_id', $user_id);
        $query   = $builder->get();
        return $query->getResult();
    }

    public function getEditUser($user_id)
    {
        $db = db_connect();
        $builder = $db->table('user');
        $builder->select('user.user_id, user.username, user.password, user.email, user.nama_lengkap, profile.profile_id, profile.describe_profile, profile.photo_profile');
        $builder->join('profile', 'user.user_id = profile.user_id');
        $builder->where('user.user_id', $user_id);
        $query   = $builder->get();
        return $query->getRow();
    }

    public function deleteUser($user_id)
    {
        $db = db_connect();
        $builder = $db->table('user');
        $builder->delete(['user_id' => $user_id]);
    }

    public function getPaginated($num, $keyword = null)
    {
        // $db = db_connect();
        // $builder = $db->table('user');
        // $builder->select('user.user_id, user.username, user.email, user.nama_lengkap');
        // $builder = $this->builder();
        // $builder->join('profile', 'user.user_id = profile.user_id');
        // $builder->join('user_login', 'user.user_id = user_login.user_id');
        $builder = $this->builder();
        if ($keyword != '') {
            $builder->like('username', $keyword);
            $builder->orLike('user_id', $keyword);
            $builder->orLike('email', $keyword);
            $builder->orLike('nama_lengkap', $keyword);
            // $builder->orLike('describe_profile', $keyword);
            // $builder->orLike('tanggal', $keyword);
            // $builder->orLike('waktu', $keyword);
        }

        $builder->orderBy('user_id', 'ASC');
        return [
            'pengguna'  => $this->paginate($num),
            'pager'     => $this->pager,
        ];
    }
}
