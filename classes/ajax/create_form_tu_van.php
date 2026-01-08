<?php
session_start();
include_once('../../lib/database.php');
include_once('../../helpers/format.php');
$fm = new Format();
$db = new Database();

header('Content-Type: application/json'); // Đảm bảo phản hồi dưới dạng JSON

$data = json_decode(file_get_contents("php://input"), true);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($data)) {
    $hoten = isset($data['hoten']) ? htmlspecialchars(strip_tags($data['hoten'])) : '';
    $ngaysinh = isset($data['ngaysinh']) ? htmlspecialchars(strip_tags($data['ngaysinh'])) : '';
    $sdt = isset($data['sdt']) ? htmlspecialchars(strip_tags($data['sdt'])) : '';
    $trieuchung = isset($data['trieuchung']) ? htmlspecialchars(strip_tags($data['trieuchung'])) : '';
    
    $url = isset($data['url']) ? htmlspecialchars(strip_tags($data['url'])) : '';

    $created_at = $fm->created_at();
    $formatted_date = date('Y-m-d', strtotime($created_at));

    if (!empty($hoten) && !empty($ngaysinh) && !empty($sdt) && !empty($trieuchung)) {

        // Kiểm tra xem số điện thoại đã được đăng ký trong ngày chưa
        $check_created = "SELECT * FROM `admin_tuvan` WHERE sdt = '$sdt' AND DATE(created_at) = '$formatted_date'";
        $check_result = $db->select($check_created);
        
        if ($check_result && $check_result->num_rows > 0) {
            echo json_encode(['status' => 'error', 'message' => 'Số điện thoại này đã được đăng ký trong ngày hôm nay']);
            exit();
        } else {
            // Insert dữ liệu vào bảng admin_tuvan
            $sql = "INSERT INTO admin_tuvan (hoten, ngaysinh, sdt, trieuchung, status, note, ketqua, nguon, user_tuvan, mahen, created_at) 
                    VALUES ('$hoten', '$ngaysinh', '$sdt', '$trieuchung', 0, '', 0, '$url', 0, '', '$created_at')";

            $result = $db->insert($sql);

            if ($result) {
                echo json_encode(['status' => 'success', 'message' => 'Cảm ơn quý khách đã để lại thông tin, chúng tôi sẽ liên hệ với khách hàng trong thời sớm nhất!']);
                exit();
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Lỗi khi lưu dữ liệu']);
                exit();
            }
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Tất cả các trường không được bỏ trống']);
        exit();
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Yêu cầu không hợp lệ']);
    exit();
}
?>
