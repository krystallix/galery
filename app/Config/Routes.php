<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
$routes->get('/', 'Pengguna\Pengguna::index');
$routes->post('/', 'Pengguna\Pengguna::index');
$routes->get('/detail/(:num)', 'Pengguna\Pengguna::detailFoto/$1');
$routes->post('/komentar/(:num)/(:num)', 'Pengguna\Pengguna::addComment/$1/$2');
$routes->get('/post', 'Pengguna\Pengguna::tambahFoto');
$routes->post('/postFoto', 'Pengguna\Pengguna::postFoto');
$routes->get('/my-profile', 'Pengguna\Pengguna::myProfile');
$routes->post('/update-profile/(:num)', 'Pengguna\Pengguna::updateProfile/$1');
$routes->delete('/delete/(:num)', 'Pengguna\Pengguna::deleteFoto/$1');
$routes->get('/edit/(:num)', 'Pengguna\Pengguna::edit/$1');
$routes->post('/update/(:num)', 'Pengguna\Pengguna::update/$1');
$routes->get('/edit-profile', 'Pengguna\Pengguna::editProfile');
$routes->get('/profile-user/(:num)', 'Pengguna\Pengguna::userProfile/$1');


$routes->get('/admin', 'Admin\Admin::index');
$routes->post('/admin', 'Admin\Admin::index');
$routes->get('/admin/detail/(:num)', 'Admin\Admin::detailFoto/$1');
$routes->delete('/delete-foto-pengguna/(:num)', 'Admin\Admin::deleteFotoPengguna/$1');
$routes->delete('/delete-comment/(:num)/(:num)', 'Admin\Admin::deleteComment/$1/$2');
$routes->get('/admin/post', 'Admin\Admin::postFoto');
$routes->post('/admin/saveFoto', 'Admin\Admin::saveFoto');
$routes->get('/admin/profileUser/(:num)', 'Admin\Admin::profileUser/$1');
// $routes->post('/admin/search', 'Admin\Admin::search');
$routes->get('/admin/traffic', 'Admin\Admin::traffic');
$routes->post('/admin/traffic', 'Admin\Admin::traffic');

$routes->get('/admin/pengguna', 'Admin\DataPengguna::index');
$routes->post('/admin/pengguna', 'Admin\DataPengguna::index');
$routes->get('/admin/login-history-pengguna/(:num)', 'Admin\DataPengguna::traffic/$1');
$routes->get('/admin/detailPengguna/(:num)', 'Admin\DataPengguna::detail/$1');
$routes->get('/admin/tambahPengguna', 'Admin\DataPengguna::tambahPengguna');
$routes->post('/admin/savePengguna', 'Admin\DataPengguna::savePengguna');
$routes->get('/admin/editPengguna/(:num)', 'Admin\DataPengguna::editPengguna/$1');
$routes->post('/admin/update-pengguna/(:num)', 'Admin\DataPengguna::updatePengguna/$1');
$routes->delete('/admin/deletePengguna/(:num)', 'Admin\DataPengguna::deletePengguna/$1');

$routes->get('/admin/profile', 'Admin\ProfileAdmin::index');
$routes->post('/admin/profile', 'Admin\ProfileAdmin::index');
$routes->post('/admin/update-profile/(:num)', 'Admin\ProfileAdmin::updateProfile/$1');
$routes->delete('/admin/delete/(:num)', 'Admin\ProfileAdmin::deleteFoto/$1');
$routes->get('/admin/editProfile', 'Admin\ProfileAdmin::editProfile');
$routes->get('/admin/edit/(:num)', 'Admin\ProfileAdmin::edit/$1');
$routes->post('/admin/update/(:num)', 'Admin\ProfileAdmin::updateFoto/$1');

$routes->get('/login', 'Auth::login');
$routes->post('/loginProses', 'Auth::loginProses');
$routes->get('/registrasi', 'Auth::registrasi');
$routes->post('/registrasiProses', 'Auth::registrasiProses');

$routes->get('/logout', 'Auth::logout');

// API 
$routes->get('/detail-foto/(:num)', 'Api\DetailController::showDetail/$1');
$routes->post('/likes', 'Api\LikeController::likes');
$routes->post('/has-liked', 'Api\LikeController::hasLiked');
$routes->post('/comment', 'Api\DetailController::comment');
$routes->get('/getPhoto', 'Api\GaleriController::getPhoto');
$routes->post('/getUserPhoto', 'Api\GaleriController::getUserPhoto');
$routes->post('/getCurrentUser', 'Api\UserController::getCurrentUser');
$routes->post('/delete-photo', 'Api\GaleriController::deletePhoto');
$routes->post('/edit-photo', 'Api\GaleriController::editPhoto');
$routes->post('/profile-edit', 'Api\UserController::profileEdit');

