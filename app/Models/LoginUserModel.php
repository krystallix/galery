<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginUserModel extends Model
{
    protected $table      = 'user_login';
    protected $primaryKey = 'id_login';
    protected $allowedFields = ['user_id'];

    public function deleteUserLogin($user_id)
    {
        $db = db_connect();
        $builder = $db->table('user_login');
        $builder->delete(['user_id' => $user_id]);
    }

    public function getPaginated($num, $keyword = null)
    {
        $builder = $this->builder();
        $builder->join('user', 'user_login.user_id = user.user_id');
        if ($keyword != '') {
            $builder->like('username', $keyword);
            $builder->orLike('user.user_id', $keyword);
            $builder->orLike('email', $keyword);
            $builder->orLike('nama_lengkap', $keyword);
            $builder->orLike('tanggal', $keyword);
            $builder->orLike('waktu', $keyword);
        }
        $builder->orderBy('user.user_id', 'ASC');
        return [
            'traffic'   => $this->paginate($num),
            'pager'     => $this->pager,
        ];
    }
}
