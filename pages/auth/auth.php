<?php
// Memulai sesi
session_start();

function authenticate($email, $password)
{
    // Memanggil koneksi.php untuk menghubungkan ke database
    include "./koneksi.php";

    // Query untuk mencari data user berdasarkan email
    $query = "SELECT u.ID_USER, u.USERNAME, u.EMAIL, u.PASSWORD, 
              u.ROLE,
              f.BIO, 
              f.SPECIALIZATION, 
              f.ID_FREELANCER,
              c.FULL_NAME, 
              c.ID_CUSTOMER
              FROM users u
              LEFT JOIN freelancers f ON u.ID_USER = f.ID_USER
              LEFT JOIN customers c ON u.ID_USER = c.ID_USER
              WHERE u.email = '$email'";

    // Eksekusi query
    $result = mysqli_query($koneksi, $query);

    // Cek apakah query berhasil dieksekusi
    if (!$result) {
        die("Query gagal dijalankan: " . mysqli_error($koneksi));
    }

    // Ambil data user dari hasil query
    $hasiluser = mysqli_fetch_assoc($result);
    // echo "<pre>";
    // echo print_r($hasiluser);
    // echo "</pre>";

    // Verifikasi password dengan password_hash()
    if ($email && password_verify($password, $hasiluser['PASSWORD'])) {
        // Jika email dan password cocok, simpan data user ke dalam sesi
        $_SESSION['user'] = $hasiluser;
        // Check if the user is a freelancer or customer and if their full name is empty
        if ($hasiluser['ROLE'] == 'freelancers' && empty($hasiluser['BIO'])) {
            header('Location: ../../dashboard/form/form-wizard.php');
            exit();
        }
        return true;
    } else {
        // Jika email atau password tidak cocok, kembalikan false
        return false;
    }
}

function is_authenticated()
{
    return isset($_SESSION['user']);
}

function logout()
{
    unset($_SESSION['user']);
    session_destroy();
}

function register($email, $username, $password, $role, $fullname)
{
    include './koneksi.php';
    // Enkripsi password dengan fungsi password_hash() sebelum disimpan ke database
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Query untuk register data baru ke dalam tabel user dan freelancers atau customers
    $query = "INSERT INTO users (username, email, password, role) VALUES ('$username', '$email', '$password', '$role')";
    // Eksekusi query
    $result = mysqli_query($koneksi, $query);
    $id_user = mysqli_insert_id($koneksi);

    $query = "INSERT INTO $role (id_user, full_name) VALUES ('$id_user', '$fullname')";
    $result = mysqli_query($koneksi, $query);


    // Cek apakah query berhasil dieksekusi
    if (!$result) {
        die("Query gagal dijalankan: " . mysqli_error($koneksi));
        return false;
    } else {
        return true;
    }
}
// $_SESSION['timeout'] = time() + 1800;

// Mengecek apakah pengguna sudah login atau belum
// if (!isset($_SESSION['username'])) {
//     // Jika belum, arahkan ke halaman login
//     header('Location: login.php');
//     exit;
// }

// // Mengecek apakah sesi sudah kadaluwarsa atau belum
// $inactive = 21600; // Set waktu sesi aktif dalam detik (6 jam)
// $session_life = time() - $_SESSION['timeout'];

// if ($session_life > $inactive) {
//     session_unset();
//     session_destroy();
//     header('Location: pages/authentication/login.php');
//     exit;
// }

// Refresh waktu timeout pada sesi
// $_SESSION['timeout'] = time();

// Halaman setelah login
// echo 'Selamat datang di halaman utama ' . $_SESSION['username'] . '!';