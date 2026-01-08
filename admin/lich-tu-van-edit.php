<?php
ob_start();
include 'inc/header.php';
include '../classes/khach_hang.php';
include '../classes/tu_van.php';

if (Session::get('role') === '1' || Session::get('role') === '3') {

$khach_hang = new KhachHang();
$tu_van = new TuVan();

?>
<?php


$message = null;
$id = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $getById = $tu_van->getByIdLichTuVan($id);
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit']) && $id !== null) {
    $message = $tu_van->UpdateKhachHangTuVan($_POST, $id);
    if ($message['status'] == 'success') {
        $_SESSION['message'] = $message;
        header('Location: lich-tu-van-list.php');
        exit();
    }
}
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}

$statusArray = array(
    array('id' => '0', 'title' => 'Chưa được tư vấn'),
    array('id' => '1', 'title' => 'Đã được tư vấn'),
);


$getAllSelectKQ = $khach_hang->getAllSelectKQ();
?>



<form action="" method="post">

    <fieldset>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Lịch tư vấn</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cập nhật thông tin khách hàng đăng ký tư vấn</li>
            </ol>
        </nav>
        <div class="row">
            <div class="mb-3 col-sm-6">
                <label for="titleInput" class="form-label">Họ và tên</label>
                <input value="<?php echo $getById['hoten'] ?>" name="hoten" type="text" id="titleInput" class="form-control" disabled>
            </div>
            <div class="mb-3 col-sm-6">
                <label for="slugInput" class="form-label">Năm sinh</label>
                <input type="text" name="ngaysinh" value="<?php echo $getById['ngaysinh'] ?>" id="slugInput1" class="form-control" disabled>
            </div>
           
        </div>

        <div class="row">
        <div class="mb-3 col-sm-6">
                <label for="titleInput" class="form-label">Số diện thoại</label>
                <input value="0<?php echo $getById['sdt'] ?>" name="sdt" type="text" class="form-control" disabled>
            </div>
            <div class="mb-3 col-sm-6">
                <label for="slugInput" class="form-label">Triệu chứng</label>
                <input type="text" value="<?php echo $getById['trieuchung'] ?>" class="form-control" name="trieuchung" disabled>
            </div>
            
        </div>

        <div class="row">
            <div class="mb-3 col-sm-12">
                <label for="disabledSelect" class="form-label">Thông tin note với bệnh nhân:</label>
                <textarea id="content" name="note" class="tinymce"><?php echo $getById['note'] ?></textarea>
            </div>
        </div>
        <div class="row">
            <div class="mb-3 col-sm-2">
                <label for="idstatus" class="form-label">Tình trạng:</label>
                <select id="idstatus" class="form-select" name="status">
                    <?php if ($statusArray) : ?>
                        <?php foreach ($statusArray as $status) : ?>
                            <option value="<?php echo $status['id']; ?>" <?php echo (isset($getById['status']) && $getById['status'] == $status['id']) ? 'selected' : ''; ?>>
                                <?php echo $status['title']; ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </select>
            </div>
            <div class="mb-3 col-sm-2">
                <label for="idketqua" class="form-label">Kết quả:</label>
                <select id="idketqua" class="form-select" name="ketqua">
                    <?php if ($getAllSelectKQ) : ?>
                        <?php foreach ($getAllSelectKQ as $ketqua) : ?>
                            <option value="<?php echo $ketqua['id']; ?>" <?php echo (isset($getById['ketqua']) && $getById['ketqua'] == $ketqua['id']) ? 'selected' : ''; ?>>
                                <?php echo $ketqua['name']; ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </select>
            </div>
            <div class="mb-3 col-sm-2">
                <label for="idstatus" class="form-label">Mã hẹn:</label>
                <input type="text" value="<?php echo $getById['mahen'] ?>" class="form-control" name="mahen">
            </div>
            <div class="mb-3 col-sm-6">
                <label for="idstatus" class="form-label">Nguồn Url:</label>
                <input type="text" value="<?php echo $getById['nguon'] ?>" class="form-control" name="url" disabled>
            </div>

        </div>


        <div style="display: flex; gap:30px ">
            <button style="width: 100px;" name="submit" type="submit" class="btn btn-success">Lưu</button>
            <a style="width: 100px;" class="btn btn-danger" href="dat_lich_kham_list.php">Hủy</a>
        </div>
    </fieldset>
</form>

<script>

    document.addEventListener("DOMContentLoaded", function() {

        <?php if ($message): ?>
            toastr.<?php echo $message['status']; ?>('<?php echo $message['message']; ?>');
        <?php endif; ?>
    });


</script>
<?php include 'inc/footer.php'; ?>

<?php } else { ?>
    <div style="display: flex; align-items: center; justify-content: center; font-size: 30px; text-transform: uppercase; font-weight: 600; height: 90vh; color: red; ">Trang này không tồn tại</div>
<?php } ?>