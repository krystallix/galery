<?php

function userLogin()
{
    $db = \Config\Database::connect();
    return $db->table('user')->where('user_id', session('user_id'))->get()->getRow();
}

function userProfileLogin()
{
    $db = \Config\Database::connect();
    return $db->table('profile')->where('user_id', session('user_id'))->get()->getRow();
}
