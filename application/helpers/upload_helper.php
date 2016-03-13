<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function common_check_upload_input($CI) {
	$fn = NULL;
	$headers = $CI->input->request_headers(TRUE);
	if (isset($headers)) {
		$keys = array('X_FILENAME', 'X-FILENAME'); // IIS 会将头部改成第二个
		foreach ($headers as $key => $value) {
			if (array_search(strtoupper($key), $keys)) {
				$fn = $value;
				break;
			}
		}
	}
	// $fn = $CI->input->get_request_header('X_FILENAME', TRUE);
	if (!$fn) {
		return common_result(404, '请选择上传的文件');
	}

	$validFormats = array('jpg', 'gif', 'png', 'jpeg');
	$ext = pathinfo($fn, PATHINFO_EXTENSION);
	if (!isset($ext)) {
		return common_result(500, '文件格式不支持: '.$ext);
	}
	$ext = strtolower($ext);
	if (!in_array($ext, $validFormats)) {
		return common_result(500, '文件格式不支持: '.$ext);
	}
	unset($validFormats);
	return common_result_ok($ext);
}

function generate_fn($CI, $ext) {
	$CI->load->helper('string');
	$salt = random_string('alnum', 10);
	return date('Y-m-d-H-i-s', time()).'-'.$salt.'.'.$ext;
}

// =======================================
// 上传头像
function save_avatar($CI, $uid) {
	$check_result = common_check_upload_input($CI); // 获取扩展名
	if (!is_ok_result($check_result)) { return $check_result; }

	$ext = $check_result['data'];

	$tempFileName = generate_fn($CI, $ext);
	$tempFilePath = 'uploads/avatar/'. $uid . '/';
	$tempFileAbsPath = FCPATH . $tempFilePath;
	if (!file_exists($tempFileAbsPath)) {
		mkdir($tempFileAbsPath);
	}
    file_put_contents(
        $tempFileAbsPath . $tempFileName,
        file_get_contents('php://input')
    );
    return common_result_ok($tempFilePath . $tempFileName);
}

function delete_avatar($CI, $file) {
	if (isset($file) && !empty($file)) {
		$fileAbsPath = FCPATH . $file;
		if (file_exists($fileAbsPath)) {
			@unlink($fileAbsPath);
		}
	}
}

function delete_old_avatar($CI, $new_avatar) {
	$old_avatar = get_user_field('avatar');
	if (isset($old_avatar) && !empty($old_avatar)
		&& isset($new_avatar) && !empty($new_avatar)) {
		if ($old_avatar != $new_avatar) {
			delete_avatar($CI, $old_avatar);
		}
	}
}



// =======================================
// 上传房源图片
function save_house_image($CI, $uid, $hid, $sub) {
	$check_result = common_check_upload_input($CI); // 获取扩展名
	if (!is_ok_result($check_result)) { return $check_result; }

	$ext = $check_result['data'];

	$tempFileName = generate_fn($CI, $ext);
	$tempFilePath = 'uploads/house/'. $sub . '-' . $uid . '-' . $hid . '/';
	$tempFileAbsPath = FCPATH . $tempFilePath;
	if (!file_exists($tempFileAbsPath)) {
		mkdir($tempFileAbsPath);
	}
    file_put_contents(
        $tempFileAbsPath . $tempFileName,
        file_get_contents('php://input')
    );
    return common_result_ok($tempFilePath . $tempFileName);
}

function delete_house_image($CI, $file) {
	if (isset($file) && !empty($file)) {
		$fileAbsPath = FCPATH . $file;
		if (file_exists($fileAbsPath)) {
			@unlink($fileAbsPath);
		}
	}
}

function delete_old_house_image($CI, $old_house_image, $new_house_image) {
	if (isset($old_house_image) && !empty($old_house_image)
		&& isset($new_house_image) && !empty($new_house_image)) {
		if ($old_house_image != $new_house_image) {
			delete_avatar($CI, $old_house_image);
		}
	}
}
