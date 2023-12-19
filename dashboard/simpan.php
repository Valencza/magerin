<?php

require "../config/koneksi.php";
$type = trim($_POST['type']);
$cmd = trim($_POST['cmd']);

// Function to handle file uploads and return the file name
function uploadFile($file, $allowedFormats, $uploadDirectory)
{
    $fileName = $file['name'];
    $fileTmp = $file['tmp_name'];
    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

    if (in_array($fileExtension, $allowedFormats)) {
        $newFileName = $uploadDirectory . $fileName;
        move_uploaded_file($fileTmp, $newFileName);
        return $fileName;
    } else {
        echo "Format file tidak diizinkan. Hanya file dengan format " . implode(', ', $allowedFormats) . " yang diizinkan.";
        return false;
    }
}

// Mengatur batas ukuran file yang diizinkan menjadi 10MB
ini_set('upload_max_filesize', '10M');
ini_set('post_max_size', '12M');

switch ($type) {
    case 'data_user':
        if ($cmd == "tambah" || $cmd == "edit") {
			$email = $_POST['email'];
            $username = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Mengenkripsi password
            $level = $_POST['level'];

            // Lokasi lengkap gambar
            $foto_profile_path = '';

            // Check if a new profile picture is being uploaded during edit
            if ($cmd == "edit" && $_FILES['foto_profile']['error'] == UPLOAD_ERR_OK) {
                $foto_profile = $_FILES['foto_profile']['name']; // Nama file gambar yang diunggah
                $target_directory = '../img/avatar/'; // Direktori tujuan untuk menyimpan gambar

                // Memindahkan file yang diunggah ke direktori tujuan
                if (move_uploaded_file($_FILES['foto_profile']['tmp_name'], $target_directory . $foto_profile)) {
                    $foto_profile_path = $target_directory . $foto_profile;

                    // Retrieve the old foto_profile path for deletion
                    $id_user = $_POST['id_user'];
                    $query = "SELECT foto_profile FROM tbl_user WHERE id_user='$id_user'";
                    $result = mysqli_query($conn, $query);

                    if ($result) {
                        $row = mysqli_fetch_assoc($result);
                        $old_foto_profile = $row['foto_profile'];

                        // Hapus foto profil lama jika ada
                        if (file_exists($old_foto_profile)) {
                            unlink($old_foto_profile);
                        }
                    }
                } else {
                    echo "Gagal mengunggah gambar.";
                }
            }

            if ($cmd == "tambah") {
                // Query untuk memasukkan data ke database
                $query = "INSERT INTO tbl_user (email, username, password, level, foto_profile)
                    VALUES ($email, '$username', '$password', '$level', '$foto_profile_path')";
            } elseif ($cmd == "edit") {
                // Proses pembaruan data ke database
                $id_user = $_POST['id_user'];
                $query = "UPDATE tbl_user SET username='$username',
                    password='$password',
                    level='$level'";

                // Add the new foto_profile path to the query if available
                if (!empty($foto_profile_path)) {
                    $query .= ", foto_profile='$foto_profile_path'";
                }

                $query .= " WHERE id_user='$id_user'";
            }

            $result = mysqli_query($conn, $query);

            if ($result) {
                header('Location:index.php?page=data_user');
            } else {
                echo "Gagal menyimpan/memperbarui data ke database: " . mysqli_error($conn);
            }
        } else {
            die(); // Jika bukan tambah atau edit, maka keluar.
        }
        break;

	case 'data_video':
		if ($cmd == "tambah") {
			// Pemeriksaan apakah file video diunggah
			if (isset($_FILES['video'])) {
				$video_name = $_FILES['video']['name'];
				$video_tmp = $_FILES['video']['tmp_name'];
				$video_extension = pathinfo($video_name, PATHINFO_EXTENSION);
				$allowed_video_formats = array("mp4", "mkv", "avi", "webm");

				if (in_array($video_extension, $allowed_video_formats)) {
					$upload_directory_video = '../img/video/'; // Direktori tempat video disimpan
					$new_video_name = $upload_directory_video . $video_name;

					// Pindahkan file video ke direktori yang ditentukan
					move_uploaded_file($video_tmp, $new_video_name);

					// Pemeriksaan apakah file gambar thumbnail diunggah
					if (isset($_FILES['thumbnail'])) {
						$thumbnail_name = $_FILES['thumbnail']['name'];
						$thumbnail_tmp = $_FILES['thumbnail']['tmp_name'];
						$thumbnail_extension = pathinfo($thumbnail_name, PATHINFO_EXTENSION);

						$allowed_thumbnail_formats = array("jpg", "jpeg", "png");

						if (in_array($thumbnail_extension, $allowed_thumbnail_formats)) {
							$upload_directory_thumbnail = '../img/thumbnail/'; // Direktori tempat gambar thumbnail disimpan
							$new_thumbnail_name = $upload_directory_thumbnail . $thumbnail_name;

							// Pindahkan file gambar thumbnail ke direktori yang ditentukan
							move_uploaded_file($thumbnail_tmp, $new_thumbnail_name);

							// Pemeriksaan apakah file gambar image_video diunggah
							if (isset($_FILES['image_video'])) {
								$image_video_name = $_FILES['image_video']['name'];
								$image_video_tmp = $_FILES['image_video']['tmp_name'];
								$image_video_extension = pathinfo($image_video_name, PATHINFO_EXTENSION);

								$allowed_image_formats = array("jpg", "jpeg", "png");

								if (in_array($image_video_extension, $allowed_image_formats)) {
									$upload_directory_image_video = '../img/poster/'; // Direktori tempat gambar image_video disimpan
									$new_image_video_name = $upload_directory_image_video . $image_video_name;

									// Pindahkan file gambar image_video ke direktori yang ditentukan
									move_uploaded_file($image_video_tmp, $new_image_video_name);

									$judul = mysqli_real_escape_string($conn, $_POST['judul']);
									$id_kategori = (int)$_POST['id_kategori'];
									$video = mysqli_real_escape_string($conn, $video_name);
									$trailer = mysqli_real_escape_string($conn, $_POST['trailer']);
									$tahun = mysqli_real_escape_string($conn, $_POST['tahun']);
									$durasi = mysqli_real_escape_string($conn, $_POST['durasi']);
									$rating = mysqli_real_escape_string($conn, $_POST['rating']);
									$deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
									$thumbnail = mysqli_real_escape_string($conn, $thumbnail_name);
									$image_video = mysqli_real_escape_string($conn, $image_video_name);

									mysqli_query($conn, "INSERT INTO tbl_video(judul, id_kategori, video, trailer, image_video, thumbnail, tahun, durasi, rating, deskripsi)
									VALUES('$judul', $id_kategori, '$video', '$trailer', '$image_video', '$thumbnail', '$tahun', '$durasi', '$rating', '$deskripsi')");
								} else {
									echo "Format gambar image_video tidak diizinkan. Hanya file dengan format jpg, jpeg, atau png yang diizinkan.";
								}
							} else {
								echo "File gambar image_video tidak diunggah.";
							}
						} else {
							echo "Format gambar thumbnail tidak diizinkan. Hanya file dengan format jpg, jpeg, atau png yang diizinkan.";
						}
					}
				} else {
					echo "Format video tidak diizinkan. Hanya file dengan format mp4, mkv, avi, dan webm yang diizinkan.";
				}
			}
		} elseif ($cmd == "edit") {
			// Pemeriksaan apakah file video diunggah
			if (isset($_FILES['video']) && $_FILES['video']['error'] === UPLOAD_ERR_OK) {
				$video_name = $_FILES['video']['name'];
				$video_tmp = $_FILES['video']['tmp_name'];
				$video_extension = pathinfo($video_name, PATHINFO_EXTENSION);
	
				$allowed_video_formats = array("mp4", "mkv", "avi", "webm");

				if (in_array($video_extension, $allowed_video_formats)) {
					$upload_directory_video = '../img/video/'; // Direktori tempat video disimpan
					$new_video_name = $upload_directory_video . $video_name;

					// Pindahkan file video ke direktori yang ditentukan
					move_uploaded_file($video_tmp, $new_video_name);

					// Pemeriksaan apakah file gambar thumbnail diunggah
					if (isset($_FILES['thumbnail'])) {
						$thumbnail_name = $_FILES['thumbnail']['name'];
						$thumbnail_tmp = $_FILES['thumbnail']['tmp_name'];
						$thumbnail_extension = pathinfo($thumbnail_name, PATHINFO_EXTENSION);

						$allowed_thumbnail_formats = array("jpg", "jpeg", "png");

						if (in_array($thumbnail_extension, $allowed_thumbnail_formats)) {
							$upload_directory_thumbnail = '../img/thumbnail/'; // Direktori tempat gambar thumbnail disimpan
							$new_thumbnail_name = $upload_directory_thumbnail . $thumbnail_name;

							// Pindahkan file gambar thumbnail ke direktori yang ditentukan
							move_uploaded_file($thumbnail_tmp, $new_thumbnail_name);

							// Pemeriksaan apakah file gambar image_video diunggah
							if (isset($_FILES['image_video'])) {
								$image_video_name = $_FILES['image_video']['name'];
								$image_video_tmp = $_FILES['image_video']['tmp_name'];
								$image_video_extension = pathinfo($image_video_name, PATHINFO_EXTENSION);

								$allowed_image_formats = array("jpg", "jpeg", "png");

								if (in_array($image_video_extension, $allowed_image_formats)) {
									$upload_directory_image_video = '../img/image_video/'; // Direktori tempat gambar image_video disimpan
									$new_image_video_name = $upload_directory_image_video . $image_video_name;

									// Pindahkan file gambar image_video ke direktori yang ditentukan
									move_uploaded_file($image_video_tmp, $new_image_video_name);

									$id_video = (int)$_POST['id_video'];
									$judul = mysqli_real_escape_string($conn, $_POST['judul']);
									$id_kategori = (int)$_POST['id_kategori'];
									$video = (isset($video_name)) ? mysqli_real_escape_string($conn, $video_name) : mysqli_real_escape_string($conn, $current_data['video']);
									$trailer = mysqli_real_escape_string($conn, $_POST['trailer']);
									$tahun = mysqli_real_escape_string($conn, $_POST['tahun']);
									$durasi = mysqli_real_escape_string($conn, $_POST['durasi']);
									$rating = mysqli_real_escape_string($conn, $_POST['rating']);
									$deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
									$thumbnail = (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] === UPLOAD_ERR_OK) ? mysqli_real_escape_string($conn, $_FILES['thumbnail']['name']) : mysqli_real_escape_string($conn, $current_data['thumbnail']);
									$image_video = (isset($_FILES['image_video']) && $_FILES['image_video']['error'] === UPLOAD_ERR_OK) ? mysqli_real_escape_string($conn, $_FILES['image_video']['name']) : mysqli_real_escape_string($conn, $current_data['image_video']);
							
									$queryValues = "judul='$judul', id_kategori=$id_kategori, video='$video', trailer='$trailer', 
													image_video='$image_video', thumbnail='$thumbnail', tahun='$tahun', durasi='$durasi', rating='$rating', deskripsi='$deskripsi'";
							
									$query = "UPDATE tbl_video SET $queryValues WHERE id_video=$id_video";
							
									mysqli_query($conn, $query);
								} else {
									echo "Format gambar image_video tidak diizinkan. Hanya file dengan format jpg, jpeg, atau png yang diizinkan.";
								}
							}
						} else {
							echo "Format gambar thumbnail tidak diizinkan. Hanya file dengan format jpg, jpeg, atau png yang diizinkan.";
						}
					}
				} else {
					echo "Format video tidak diizinkan. Hanya file dengan format mp4, mkv, avi, dan webm yang diizinkan.";
				}
			}
		} else {
			die("Aksi tidak valid.");
		}
		header('Location:index.php?page=data_video');
    break;

	case 'data_transaksi':
		if ($cmd == "tambah") {
			mysqli_query($conn, "INSERT INTO tbl_transaksi(nama)
			VALUES('$_POST[nama]')");
		} elseif ($cmd == "edit") {
			mysqli_query($conn, "UPDATE tbl_transaksi SET nama='$_POST[nama]'
			WHERE id_transaksi='$_POST[id_transaksi]'");
		} else {
			die(); //jika bukan tambah atau edit, lalu apa ? die aja lah :p
		}
		header('Location:index.php?page=data_transaksi');
		break;
	case 'data_komentar':
		if ($cmd == "tambah") {
			mysqli_query($conn, "INSERT INTO tbl_komentar(username,video,komentar)
			VALUES('$_POST[username]',
			'$_POST[video]',
			'$_POST[komentar]')");
		} elseif ($cmd == "edit") {
			mysqli_query($conn, "UPDATE tbl_komentar SET username='$_POST[username]',
				video='$_POST[video]',
				komentar='$_POST[komentar]'
				WHERE id_komentar='$_POST[id_komentar]'");
		} else {
			die(); //jika bukan tambah atau edit, lalu apa ? die aja lah :p
		}
		header('Location:index.php?page=data_komentar');
		break;
	case 'data_kategori':
		if ($cmd == "tambah") {
			mysqli_query($conn, "INSERT INTO tbl_kategori(nama_kategori)
				VALUES('$_POST[nama_kategori]')");
		} elseif ($cmd == "edit") {
			mysqli_query($conn, "UPDATE tbl_kategori SET nama_kategori='$_POST[nama_kategori]'
					WHERE id_kategori='$_POST[id_kategori]'");
		} else {
			die(); //jika bukan tambah atau edit, lalu apa ? die aja lah :p
		}
		header('Location:index.php?page=data_kategori');
		break;

	default:
		require_once("pages/404.php");
		break;
}
