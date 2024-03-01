<?php

namespace App\Controllers\Api;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\LoginModel;
use App\Models\ProfileModel;


class UserController extends ResourceController
{
    protected $loginModel;
    protected $profileModel;
    
    public function __construct()
    {
        $this->loginModel = new LoginModel();
        $this->profileModel = new ProfileModel();
    }
    
    public function getCurrentUser(){
        $request = \Config\Services::request();
        $user_id = $request->getPost('user_id');
        
        $current_user =  $this->loginModel->getUserWhere($user_id);
        
        return $this->respond(['data' => $current_user, 'status' => "sukses"], 200);
        
    }
    
    
    
    public function profileEdit()
    {
        // Validasi form
        $validationRules = [
            'nama_lengkap' => 'required|max_length[50]',
            'deskripsi_profile' => 'required|max_length[100]',
        ];
    
        $user_id = $this->request->getPost('user_id');
        $userData = $this->loginModel->find($user_id);

        if ($userData) {
            $currentUsername = $userData['username'];
            $currentEmail = $userData['email'];
        } else {
            // Handle case when user data is not found, for example, return an error response.
            return $this->response->setJSON(['status' => 'error', 'message' => 'User data not found.'])->setStatusCode(404);
        }

        if ($this->request->getPost('username') !== $currentUsername) {
            $validationRules['username'] = 'required|max_length[20]|is_unique[user.username]';
        }
    
        if ($this->request->getPost('email') !== $currentEmail) {
            $validationRules['email'] = 'required|valid_email|is_unique[user.email]';
        }
    
        if (!$this->validate($validationRules)) {
            $validation = \Config\Services::validation();
            return $this->response->setJSON(['status' => 'error', 'message' => $validation->getErrors()])->setStatusCode(400);
        }
    
        // Process password
        $password = $this->request->getPost('password');
        $options = ['cost' => 10];
        $password_hash = $password ? password_hash($password, PASSWORD_DEFAULT, $options) : null;
    
        // Save user data
        $userData = [
            'user_id' => $user_id,
            'username' => $this->request->getPost('username'),
            'password' => $password_hash,
            'email' => $this->request->getPost('email'),
            'nama_lengkap' => ucwords($this->request->getPost('nama_lengkap')),
        ];
    
        $this->loginModel->save($userData);
    
        // Process profile photo
        $useR = $this->profileModel->find($user_id);

        $profileLama = $useR["photo_profile"];
        $profileBaru = $this->request->getFile('foto');
    
        $photo_profile = $profileLama;
    
        if ($profileBaru->getError() != UPLOAD_ERR_NO_FILE) {
            // Only process the new photo if a file is uploaded
            unlink('assets/img/profile/' . $profileLama);
    
            $photo_profile = $profileBaru->getName();
            $profileBaru->move('assets/img/profile');
        }
    
        // Save profile data
        $this->profileModel->save([
            'profile_id' => $this->request->getPost('profile_id'),
            'user_id' => $user_id,
            'describe_profile' => $this->request->getPost('deskripsi_profile'),
            'photo_profile' => $photo_profile,
        ]);
    
        return $this->response->setJSON(['status' => 'success', 'message' => 'Profile berhasil diubah!'])->setStatusCode(200);
    }
}