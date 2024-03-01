<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfileModel extends Model
{
    protected $table      = 'profile';
    protected $primaryKey = 'profile_id';
    protected $allowedFields = ['user_id', 'describe_profile', 'photo_profile'];

    public function getUserWhere($user_id)
    {
        $db = db_connect();
        $builder = $db->table('user');
        $builder->select('user.user_id, user.username, user.nama_lengkap, profile.describe_profile, profile.photo_profile');
        $builder->join('profile', 'user.user_id = profile.user_id');
        $builder->where('user.user_id', $user_id);
        $query   = $builder->get();
        return $query->getResult();
    }

    public function deleteProfile($user_id)
    {
        $db = db_connect();
        $builder = $db->table('profile');
        $builder->delete(['user_id' => $user_id]);
    }
}
