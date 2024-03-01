<?php

namespace App\Models;

use CodeIgniter\Model;

class CommentModel extends Model
{
    protected $table      = 'comment_log';
    protected $primaryKey = 'id_comment';
    protected $allowedFields = ['comment', 'id_photo', 'user_id'];

    public function getComment($id_photo)
    {
        $db = db_connect();
        $builder = $db->table('comment_log');
        $builder->select('comment_log.id_comment, comment_log.comment, comment_log.id_photo, comment_log.user_id, user.username, profile.photo_profile');
        $builder->join('user', 'comment_log.user_id = user.user_id');
        $builder->join('profile', 'comment_log.user_id = profile.user_id');
        $builder->where('comment_log.id_photo', $id_photo);
        $query   = $builder->get();
        return $query->getResult();
    }

    public function deleteComment($id_photo)
    {
        $db = db_connect();
        $builder = $db->table('comment_log');
        $builder->delete(['id_photo' => $id_photo]);
        $query   = $builder->get();
        return $query->getResult();
    }

    public function jumlahComment($id_photo)
    {
        $db = db_connect();
        $builder = $db->table('comment_log');
        $builder->selectCount('comment');
        $builder->where('id_photo', $id_photo);
        $query   = $builder->get();
        return $query->getResult();
    }

    public function adminDeleteComment($id_photo, $user_id)
    {
        $db = db_connect();
        $query = $db->table('comment_log')
            ->where('id_photo', $id_photo)
            ->where('user_id', $user_id)
            ->delete();
    }

    public function jumlahCommentUser($user_id)
    {
        $db = db_connect();
        $builder = $db->table('comment_log');
        $builder->selectCount('id_photo');
        $builder->where('user_id', $user_id);
        $query   = $builder->get();
        return $query->getRow();
    }

    public function deleteCommentUser($user_id)
    {
        $db = db_connect();
        $builder = $db->table('comment_log');
        $builder->delete(['user_id' => $user_id]);
    }
}
