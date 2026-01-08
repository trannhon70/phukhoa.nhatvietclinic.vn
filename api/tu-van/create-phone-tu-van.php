<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

include_once('../../lib/database.php');
include_once('../../helpers/format.php');

$fm = new Format();
$db = new Database();

$data = json_decode(file_get_contents("php://input"), true);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($data['sdt'])) {
    // Xử lý và chuẩn bị dữ liệu
    $sdt = isset($data['sdt']) ? htmlspecialchars(strip_tags($data['sdt'])) : '';
    $nguon = isset($data['url']) ? htmlspecialchars(strip_tags($data['url'])) : '';


    if (!empty($sdt)) {
        $created_at = $fm->created_at();
        $formatted_date = date('Y-m-d', strtotime($created_at));
        // Kiểm tra xem số điện thoại đã được đăng ký trong ngày chưa
        $check_created = "SELECT * FROM `admin_tuvan` WHERE sdt = '$sdt' AND DATE(created_at) = '$formatted_date'";
        $check_result = $db->select($check_created);

        if ($check_result && $check_result->num_rows > 0) {
            echo json_encode(['status' => 'error', 'message' => 'Số điện thoại này đã được đăng ký trong ngày hôm nay']);
            exit();
        } else {
            $sql = "INSERT INTO admin_tuvan (hoten, ngaysinh, sdt, trieuchung, status, note, ketqua, nguon, user_tuvan, created_at) 
                VALUES ('', '', '$sdt', '', 0, '', 0, '$nguon', 0, '$created_at')";
            $result = $db->insert($sql);
            if ($result) {
                echo json_encode(['status' => 'success', 'message' => 'Cảm ơn quý khách đã để lại thông tin, chúng tôi sẽ liên hệ với khách hàng trong thời sớm nhất!']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Lỗi khi lưu dữ liệu']);
            }
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Số điện thoại không được bỏ trống!']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Yêu cầu không hợp lệ']);
}
