<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//  =========================== LOGIN =====================================
$routes->get('/', 'Master_login::index');
$routes->post('/Master_login/login', 'Master_login::login');
$routes->get('/Master_login/logout', 'Master_login::logout');
$routes->post('/Master_login/regitrasi_users', 'Master_login::regitrasi_users');
$routes->post('/Master_login/lupa_password', 'Master_login::lupa_password');
$routes->get('/Master_login/reset_password/(:any)', 'Master_login::reset_password/$1');
$routes->post('/Master_login/change_new_password/(:any)', 'Master_login::change_new_password/$1');
$routes->post('/Master_login/updated_profile', 'Master_login::updated_profile', ['filter' => 'auth']);

// ============================ DASHBOARD ==================================
$routes->get('/dashboard', 'Home::index', ['filter' => 'auth']);
$routes->post('/dashboard/chart_status_mutu_air', 'Home::chart_status_mutu_air', ['filter' => 'auth']);
$routes->post('/dashboard/chart_index_kualitas_air', 'Home::chart_index_kualitas_air', ['filter' => 'auth']);
$routes->post('/dashboard/chart_beban_pencemaran_eksisting', 'Home::chart_beban_pencemaran_eksisting', ['filter' => 'auth']);
$routes->post('/dashboard/chart_status_mutu_udara', 'Home::chart_status_mutu_udara', ['filter' => 'auth']);
$routes->post('/dashboard/chart_index_kualitas_udara', 'Home::chart_index_kualitas_udara', ['filter' => 'auth']);

// ====================  SISTEM INFORMASI GEOGRAFIS =========================
$routes->get('/informasi_titik_pantau', 'Master_informasi_titik_pantau::index', ['filter' => 'auth']);
$routes->post('/Master_informasi_titik_pantau/ajax_list', 'Master_informasi_titik_pantau::ajax_list', ['filter' => 'auth']);
$routes->get('/Master_informasi_titik_pantau/detail_informasi_titik_pantau', 'Master_informasi_titik_pantau::detail_informasi_titik_pantau', ['filter' => 'auth']);
$routes->get('/titik_pantau', 'Master_titik_pantau::index', ['filter' => 'auth']);

// ============================= STATUS MUTU AIR ===========================
$routes->get('/status_mutu_air', 'Master_status_mutu_air::index', ['filter' => 'auth']);
$routes->post('/Master_status_mutu_air/ajax_list', 'Master_status_mutu_air::ajax_list', ['filter' => 'auth']);
$routes->get('/Master_status_mutu_air/deleted_status_mutu_air', 'Master_status_mutu_air::deleted_status_mutu', ['filter' => 'auth']);
$routes->get('/Master_status_mutu_air/show_updated_status_mutu_air', 'Master_status_mutu_air::show_updated_status_mutu_air', ['filter' => 'auth']);
$routes->get('/Master_status_mutu_air/detail_parameter_titik_pantau', 'Master_status_mutu_air::detail_parameter_titik_pantau', ['filter' => 'auth']);
$routes->get('/Master_status_mutu_air/eksport_status_mutu_air', 'Master_status_mutu_air::exspor_status_mutu_air', ['filter' => 'auth']);
$routes->post('/Master_status_mutu_air/add_status_mutu_air', 'Master_status_mutu_air::add_status_mutu_air', ['filter' => 'auth']);
$routes->post('/Master_status_mutu_air/update_status_mutu_air', 'Master_status_mutu_air::update_status_mutu_air', ['filter' => 'auth']);
$routes->post('/Master_status_mutu_air/import_status_mutu_air', 'Master_status_mutu_air::import_status_mutu_air', ['filter' => 'auth']);

// ============================= STATUS MUTU UDARA ===========================
$routes->get('/status_mutu_udara', 'Master_status_mutu_udara::index', ['filter' => 'auth']);
$routes->post('/Master_status_mutu_udara/ajax_list', 'Master_status_mutu_udara::ajax_list', ['filter' => 'auth']);
$routes->get('/Master_status_mutu_udara/deleted_status_mutu_udara', 'Master_status_mutu_udara::deleted_status_mutu_udara', ['filter' => 'auth']);
$routes->get('/Master_status_mutu_udara/show_updated_status_mutu_udara', 'Master_status_mutu_udara::show_updated_status_mutu_udara', ['filter' => 'auth']);
$routes->get('/Master_status_mutu_udara/detail_parameter_titik_pantau', 'Master_status_mutu_udara::detail_parameter_titik_pantau', ['filter' => 'auth']);
$routes->get('/Master_status_mutu_udara/eksport_status_mutu_udara', 'Master_status_mutu_udara::exspor_status_mutu_udara', ['filter' => 'auth']);
$routes->post('/Master_status_mutu_udara/add_status_mutu_udara', 'Master_status_mutu_udara::add_status_mutu_udara', ['filter' => 'auth']);
$routes->post('/Master_status_mutu_udara/update_status_mutu_udara', 'Master_status_mutu_udara::update_status_mutu_udara', ['filter' => 'auth']);
$routes->post('/Master_status_mutu_udara/import_status_mutu_udara', 'Master_status_mutu_udara::import_status_mutu_udara', ['filter' => 'auth']);

// ============================= INDEX KUALITAS AIR ========================
$routes->get('/index_kualitas_air', 'Master_index_kualitas_air::index', ['filter' => 'auth']);
$routes->post('/Master_index_kualitas_air/ajax_list', 'Master_index_kualitas_air::ajax_list', ['filter' => 'auth']);

// ============================= INDEX KUALITAS UDARA ========================
$routes->get('/index_kualitas_udara', 'Master_index_kualitas_udara::index', ['filter' => 'auth']);
$routes->post('/Master_index_kualitas_udara/ajax_list', 'Master_index_kualitas_udara::ajax_list', ['filter' => 'auth']);

// ============================= BEBAN PEMCEMARAN EKSISTING BOD ================
$routes->get('/beban_pencemaran_eksisting_bod', 'Master_beban_pencemaran_eksisting_bod::index', ['filter' => 'auth']);
$routes->post('/Master_beban_pencemaran_eksisting_bod/ajax_list', 'Master_beban_pencemaran_eksisting_bod::ajax_list', ['filter' => 'auth']);
$routes->get('/Master_beban_pencemaran_eksisting_bod/detail_parameter_eksisting_bod', 'Master_beban_pencemaran_eksisting_bod::detail_parameter_eksisting_bod', ['filter' => 'auth']);
$routes->get('/Master_beban_pencemaran_eksisting_bod/deleted', 'Master_beban_pencemaran_eksisting_bod::deleted', ['filter' => 'auth']);
$routes->get('/Master_beban_pencemaran_eksisting_bod/show_updated', 'Master_beban_pencemaran_eksisting_bod::show_updated', ['filter' => 'auth']);
$routes->get('/Master_beban_pencemaran_eksisting_bod/eksport', 'Master_beban_pencemaran_eksisting_bod::eksport', ['filter' => 'auth']);
$routes->post('/Master_beban_pencemaran_eksisting_bod/import', 'Master_beban_pencemaran_eksisting_bod::import', ['filter' => 'auth']);
$routes->post('/Master_beban_pencemaran_eksisting_bod/add', 'Master_beban_pencemaran_eksisting_bod::add', ['filter' => 'auth']);
$routes->post('/Master_beban_pencemaran_eksisting_bod/update', 'Master_beban_pencemaran_eksisting_bod::update', ['filter' => 'auth']);

// ============================= POTENSIAL DOMESTIK ================
$routes->get('/potensial_domestik', 'Master_potensial_domestik::index', ['filter' => 'auth']);
$routes->post('/Master_potensial_domestik/ajax_list', 'Master_potensial_domestik::ajax_list', ['filter' => 'auth']);
$routes->get('/Master_potensial_domestik/detail_parameter', 'Master_potensial_domestik::detail_parameter', ['filter' => 'auth']);
$routes->get('/Master_potensial_domestik/deleted', 'Master_potensial_domestik::deleted', ['filter' => 'auth']);
$routes->get('/Master_potensial_domestik/show_updated', 'Master_potensial_domestik::show_updated', ['filter' => 'auth']);
$routes->get('/Master_potensial_domestik/eksport', 'Master_potensial_domestik::eksport', ['filter' => 'auth']);
$routes->post('/Master_potensial_domestik/import', 'Master_potensial_domestik::import', ['filter' => 'auth']);
$routes->post('/Master_potensial_domestik/add', 'Master_potensial_domestik::add', ['filter' => 'auth']);
$routes->post('/Master_potensial_domestik/update', 'Master_potensial_domestik::update', ['filter' => 'auth']);

// ============================= POTENSIAL PERTANIAN ================
$routes->get('/potensial_pertanian', 'Master_potensial_pertanian::index', ['filter' => 'auth']);
$routes->post('/Master_potensial_pertanian/ajax_list', 'Master_potensial_pertanian::ajax_list', ['filter' => 'auth']);
$routes->get('/Master_potensial_pertanian/detail_parameter', 'Master_potensial_pertanian::detail_parameter', ['filter' => 'auth']);
$routes->get('/Master_potensial_pertanian/deleted', 'Master_potensial_pertanian::deleted', ['filter' => 'auth']);
$routes->get('/Master_potensial_pertanian/show_updated', 'Master_potensial_pertanian::show_updated', ['filter' => 'auth']);
$routes->get('/Master_potensial_pertanian/eksport', 'Master_potensial_pertanian::eksport', ['filter' => 'auth']);
$routes->post('/Master_potensial_pertanian/import', 'Master_potensial_pertanian::import', ['filter' => 'auth']);
$routes->post('/Master_potensial_pertanian/add', 'Master_potensial_pertanian::add', ['filter' => 'auth']);
$routes->post('/Master_potensial_pertanian/update', 'Master_potensial_pertanian::update', ['filter' => 'auth']);

// ============================= POTENSIAL PETERNAKAN ================
$routes->get('/potensial_peternakan', 'Master_potensial_peternakan::index', ['filter' => 'auth']);
$routes->post('/Master_potensial_peternakan/ajax_list', 'Master_potensial_peternakan::ajax_list', ['filter' => 'auth']);
$routes->get('/Master_potensial_peternakan/detail_parameter', 'Master_potensial_peternakan::detail_parameter', ['filter' => 'auth']);
$routes->get('/Master_potensial_peternakan/deleted', 'Master_potensial_peternakan::deleted', ['filter' => 'auth']);
$routes->get('/Master_potensial_peternakan/show_updated', 'Master_potensial_peternakan::show_updated', ['filter' => 'auth']);
$routes->get('/Master_potensial_peternakan/eksport', 'Master_potensial_peternakan::eksport', ['filter' => 'auth']);
$routes->post('/Master_potensial_peternakan/import', 'Master_potensial_peternakan::import', ['filter' => 'auth']);
$routes->post('/Master_potensial_peternakan/add', 'Master_potensial_peternakan::add', ['filter' => 'auth']);
$routes->post('/Master_potensial_peternakan/update', 'Master_potensial_peternakan::update', ['filter' => 'auth']);

// ============================= POTENSIAL INDUSTRI 1 ================
$routes->get('/potensial_industri_1', 'Master_potensial_industri_1::index', ['filter' => 'auth']);
$routes->post('/Master_potensial_industri_1/ajax_list', 'Master_potensial_industri_1::ajax_list', ['filter' => 'auth']);
$routes->get('/Master_potensial_industri_1/detail_parameter', 'Master_potensial_industri_1::detail_parameter', ['filter' => 'auth']);
$routes->get('/Master_potensial_industri_1/deleted', 'Master_potensial_industri_1::deleted', ['filter' => 'auth']);
$routes->get('/Master_potensial_industri_1/show_updated', 'Master_potensial_industri_1::show_updated', ['filter' => 'auth']);
$routes->get('/Master_potensial_industri_1/eksport', 'Master_potensial_industri_1::eksport', ['filter' => 'auth']);
$routes->post('/Master_potensial_industri_1/import', 'Master_potensial_industri_1::import', ['filter' => 'auth']);
$routes->post('/Master_potensial_industri_1/add', 'Master_potensial_industri_1::add', ['filter' => 'auth']);
$routes->post('/Master_potensial_industri_1/update', 'Master_potensial_industri_1::update', ['filter' => 'auth']);

// ============================= POTENSIAL INDUSTRI 2 ================
$routes->get('/potensial_industri_2', 'Master_potensial_industri_2::index', ['filter' => 'auth']);
$routes->post('/Master_potensial_industri_2/ajax_list', 'Master_potensial_industri_2::ajax_list', ['filter' => 'auth']);
$routes->get('/Master_potensial_industri_2/detail_parameter', 'Master_potensial_industri_2::detail_parameter', ['filter' => 'auth']);
$routes->get('/Master_potensial_industri_2/deleted', 'Master_potensial_industri_2::deleted', ['filter' => 'auth']);
$routes->get('/Master_potensial_industri_2/show_updated', 'Master_potensial_industri_2::show_updated', ['filter' => 'auth']);
$routes->get('/Master_potensial_industri_2/eksport', 'Master_potensial_industri_2::eksport', ['filter' => 'auth']);
$routes->post('/Master_potensial_industri_2/import', 'Master_potensial_industri_2::import', ['filter' => 'auth']);
$routes->post('/Master_potensial_industri_2/add', 'Master_potensial_industri_2::add', ['filter' => 'auth']);
$routes->post('/Master_potensial_industri_2/update', 'Master_potensial_industri_2::update', ['filter' => 'auth']);

// ============================= POTENSIAL INDUSTRI 3 ================
$routes->get('/potensial_industri_3', 'Master_potensial_industri_3::index', ['filter' => 'auth']);
$routes->post('/Master_potensial_industri_3/ajax_list', 'Master_potensial_industri_3::ajax_list', ['filter' => 'auth']);
$routes->get('/Master_potensial_industri_3/detail_parameter', 'Master_potensial_industri_3::detail_parameter', ['filter' => 'auth']);
$routes->get('/Master_potensial_industri_3/deleted', 'Master_potensial_industri_3::deleted', ['filter' => 'auth']);
$routes->get('/Master_potensial_industri_3/show_updated', 'Master_potensial_industri_3::show_updated', ['filter' => 'auth']);
$routes->get('/Master_potensial_industri_3/eksport', 'Master_potensial_industri_3::eksport', ['filter' => 'auth']);
$routes->post('/Master_potensial_industri_3/import', 'Master_potensial_industri_3::import', ['filter' => 'auth']);
$routes->post('/Master_potensial_industri_3/add', 'Master_potensial_industri_3::add', ['filter' => 'auth']);
$routes->post('/Master_potensial_industri_3/update', 'Master_potensial_industri_3::update', ['filter' => 'auth']);

// ==============================  KONFIGURASI ==============================
$routes->get('/users', 'Master_users::index', ['filter' => 'auth']);
$routes->get('/Master_users/show_update_users', 'Master_users::show_update_users', ['filter' => 'auth']);
$routes->get('/Master_users/deleted_users', 'Master_users::deleted_users', ['filter' => 'auth']);
$routes->post('/Master_users/ajax_list', 'Master_users::ajax_list', ['filter' => 'auth']);
$routes->post('/Master_users/add_users', 'Master_users::add_users', ['filter' => 'auth']);
$routes->post('/Master_users/update_users', 'Master_users::update_users', ['filter' => 'auth']);

// ---- aktivitas user ----
$routes->get('/aktivitas_users', 'Master_aktivitas::index', ['filter' => 'auth']);
$routes->post('/Master_aktivitas/ajax_list', 'Master_aktivitas::ajax_list', ['filter' => 'auth']);
$routes->get('/Master_aktivitas/export', 'Master_aktivitas::export', ['filter' => 'auth']);

// ----- rumus -----
$routes->get('/rumus', 'Master_rumus::index', ['filter' => 'auth']);
$routes->get('/Master_rumus/deleted_rumus', 'Master_rumus::deleted_rumus', ['filter' => 'auth']);
$routes->post('/Master_rumus/ajax_list', 'Master_rumus::ajax_list', ['filter' => 'auth']);
$routes->post('/Master_rumus/add_rumus', 'Master_rumus::add_rumus', ['filter' => 'auth']);
