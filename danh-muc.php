<?php include 'inc/header.php' ?>
<link rel="stylesheet" href="<?php echo $local ?>/css/danh-muc.min.css">
</head>
<?php
$current_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
$current_url .= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$parsed_url = parse_url($current_url);
parse_str($parsed_url['query'], $query_params);

$khoa_slug = isset($query_params['khoa']) ? $query_params['khoa'] : null;
$benh_slug = isset($query_params['benh']) ? $query_params['benh'] : null;
$page = isset($query_params['page']) ? $query_params['page'] : 1;

$getDanhMucBenhByKhoa = $khoas->getDanhMucBenhByKhoa($khoa_slug);
$getTTBenhAndKhoa = $khoas->getTTBenhAndKhoa($khoa_slug, $benh_slug);

//danh sách bài viết theo slug bệnh
$limit = 5;
$offset = ($page - 1) * $limit;
// Lấy danh sách bài viết theo phân trang
$list_BV_pagination = $post->getPagingBaiVietTheoBenh($benh_slug, $limit, $offset);
// Lấy tổng số bài viết
$total_articles = $post->getTotalCountById($benh_slug);
// Tính toán tổng số trang
$total_pages = ceil($total_articles / $limit);
// var_dump($list_BV_pagination);
?>

<body>
    <?php include 'layout/header_component.php' ?>
    <main>
        <?php include 'layout/slider_component.php' ?>
        <div id="danhmuc_ds" class="danhmuc">
            <div class="danhmuc__left">
                <?php foreach ($getDanhMucBenhByKhoa as $value): ?>
                    <span class="danhmuc__left-span"><?php echo $value['name'] ?></span>
                    <ul class="danhmuc__left-ul">
                        <?php foreach ($value['danhSachBenh'] as $benh): ?>
                            <li
                                class="danhmuc__left-li <?php echo ($benh_slug === $benh['slug']) ? 'danhmuc__left-li-active' : ''; ?>">
                                <a
                                    href="<?php echo $local ?>/danh-muc.php?khoa=<?php echo $value['slug'] ?>&benh=<?php echo $benh['slug'] ?>&page=1"><?php echo $benh['name']; ?></a>
                            </li>
                        <?php endforeach; ?>

                    </ul>
                <?php endforeach; ?>

                <div class="danhmuc__left-banner">
                    <img loading="lazy" class="danhmuc__left-banner-img"
                        src="<?php echo $local ?>/images/banner/banner_khuyen_mai.webp" height="380px" width="250px"
                        alt="..."></img>
                </div>

            </div>
            <div class="danhmuc__right">
                <?php foreach ($list_BV_pagination as $value): ?>
                    <span class="danhmuc__right-title">
                        <?php echo $value['name'] ?>
                    </span>
                    <?php foreach ($value['danhSachBaiViet'] as $item): ?>
                        <div class="danhmuc__right-card">
                            <div class="danhmuc__right-card-left">
                                <img loading="lazy" class="danhmuc__right-card-img"
                                    src="<?php echo $local ?>/admin/uploads/<?php echo $item['img'] ?>" height="150px"
                                    width="150px" alt="..."></img>
                            </div>
                            <div class="danhmuc__right-card-right">
                                <div class="danhmuc__right-card-right-title">
                                    <?php echo $item['tieu_de'] ?>
                                </div>
                                <div class="danhmuc__right-card-right-text">
                                    <?php echo $item['descriptions'] ?>
                                </div>
                                <div class="danhmuc__right-card-right-footer">
                                    <a class="danhmuc__right-card-right-footer-button" href="<?php echo $local ?>">hỏi bác
                                        sĩ</a>
                                    <a class="danhmuc__right-card-right-footer-button1"
                                        href="<?php echo $local ?>/<?php echo $khoa_slug ?>/<?php echo $item['slug'] ?>.html">chi
                                        tiết</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endforeach; ?>

                <div class="danhmuc__right-paging">
                    <!-- Link trang trước -->
                    <?php if ($page > 1): ?>
                        <a class="danhmuc__right-paging-prev"
                            href="<?php echo $local . '/danh-muc.php' . '?khoa=' . $khoa_slug . '&benh=' . $benh_slug . '&page=' . ($page - 1); ?>">
                            <svg width="30" height="30" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                <path fill="white"
                                    d="M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z">
                                </path>
                            </svg>
                        </a>
                    <?php endif; ?>

                    <!-- Hiển thị số trang -->
                    <?php
                    $start_page = max(1, $page - 2);
                    $end_page = min($total_pages, $page + 2);

                    if ($start_page > 1) {
                        echo '<a class="danhmuc__right-paging-number" href="' . $local . '/danh-muc.php' . '?khoa=' . $khoa_slug . '&benh=' . $benh_slug . '&page=1">1</a>';
                        if ($start_page > 2) {
                            echo '<span class="danhmuc__right-paging-number">...</span>';
                        }
                    }

                    for ($i = $start_page; $i <= $end_page; $i++) {
                        $active_class = ($i == $page) ? 'danhmuc__right-paging-number-active' : '';
                        echo '<a class="danhmuc__right-paging-number ' . $active_class . '" href="' . $local . '/danh-muc.php' . '?khoa=' . $khoa_slug . '&benh=' . $benh_slug . '&page=' . $i . '">' . $i . '</a>';
                    }

                    if ($end_page < $total_pages) {
                        if ($end_page < $total_pages - 1) {
                            echo '<span class="danhmuc__right-paging-number">...</span>';
                        }
                        echo '<a class="danhmuc__right-paging-number" href="' . $local . '/danh-muc.php' . '?khoa=' . $khoa_slug . '&benh=' . $benh_slug . '&page=' . $total_pages . '">' . $total_pages . '</a>';
                    }
                    ?>

                    <!-- Link trang sau -->
                    <?php if ($page < $total_pages): ?>
                        <a class="danhmuc__right-paging-prev"
                            href="<?php echo $local . '/danh-muc.php' . '?khoa=' . $khoa_slug . '&benh=' . $benh_slug . '&page=' . ($page + 1); ?>">
                            <svg width="30" height="30" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                <path fill="white"
                                    d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z">
                                </path>
                            </svg>
                        </a>
                    <?php endif; ?>
                </div>

                <div class="danhmuc__right-share">
                    <div class="danhmuc__right-share-title">
                        hãy chia sẽ cùng chúng tôi
                    </div>
                    <div class="danhmuc__right-share-icon">
                        <a href="<?php echo $local ?>">
                            <img loading="lazy" class="danhmuc__right-share-icon-img"
                                src="<?php echo $local ?>/images/icons/icon_zalo.webp" width="50px" height="50px"
                                alt="..."></img>
                        </a>

                        <a href="<?php echo $local ?>">
                            <img loading="lazy" class="danhmuc__right-share-icon-img"
                                src="<?php echo $local ?>/images/icons/icon_fb.webp" width="50px" height="50px"
                                alt="..."></img>

                        </a>

                    </div>
                </div>
            </div>
        </div>
        <div id="danhmuc_dspc" class="danhmuc_mobile">
            <div class="danhmuc_mobile-title"><?php echo $getTTBenhAndKhoa['khoa'] ?></div>
            <div class="danhmuc_mobile-title1"><?php echo $getTTBenhAndKhoa['benh'] ?></div>
            <div class="danhmuc_mobile-list">
                <?php foreach ($list_BV_pagination as $value): ?>
                    <?php foreach ($value['danhSachBaiViet'] as $item): ?>
                        <div class="danhmuc_mobile-card">
                            <div class="danhmuc_mobile-card-left">
                                <img loading="lazy" src="<?php echo $local ?>/admin/uploads/<?php echo $item['img'] ?>"
                                    alt="...">
                            </div>
                            <div class="danhmuc_mobile-card-right">
                                <h5><?php echo $item['tieu_de'] ?></h5>
                                <div>
                                    <a class="danhmuc_mobile-card-right-bs" href="<?php echo $local ?>">HỎI BÁC SĨ</a>
                                    <a class="danhmuc_mobile-card-right-chi-tiet"
                                        href="<?php echo $local ?>/<?php echo $khoa_slug ?>/<?php echo $item['slug'] ?>.html">CHI
                                        TIẾT</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </div>
            <div class="danhmuc__right-paging">
                <!-- Link trang trước -->
                <?php if ($page > 1): ?>
                    <a class="danhmuc__right-paging-prev"
                        href="<?php echo $local . '/danh-muc.php' . '?khoa=' . $khoa_slug . '&benh=' . $benh_slug . '&page=' . ($page - 1); ?>">
                        <svg width="30" height="30" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                            <path fill="white"
                                d="M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z">
                            </path>
                        </svg>
                    </a>
                <?php endif; ?>

                <!-- Hiển thị số trang -->
                <?php
                $start_page = max(1, $page - 2);
                $end_page = min($total_pages, $page + 2);

                if ($start_page > 1) {
                    echo '<a class="danhmuc__right-paging-number" href="' . $local . '/danh-muc.php' . '?khoa=' . $khoa_slug . '&benh=' . $benh_slug . '&page=1">1</a>';
                    if ($start_page > 2) {
                        echo '<span class="danhmuc__right-paging-number">...</span>';
                    }
                }

                for ($i = $start_page; $i <= $end_page; $i++) {
                    $active_class = ($i == $page) ? 'danhmuc__right-paging-number-active' : '';
                    echo '<a class="danhmuc__right-paging-number ' . $active_class . '" href="' . $local . '/danh-muc.php' . '?khoa=' . $khoa_slug . '&benh=' . $benh_slug . '&page=' . $i . '">' . $i . '</a>';
                }

                if ($end_page < $total_pages) {
                    if ($end_page < $total_pages - 1) {
                        echo '<span class="danhmuc__right-paging-number">...</span>';
                    }
                    echo '<a class="danhmuc__right-paging-number" href="' . $local . '/danh-muc.php' . '?khoa=' . $khoa_slug . '&benh=' . $benh_slug . '&page=' . $total_pages . '">' . $total_pages . '</a>';
                }
                ?>

                <!-- Link trang sau -->
                <?php if ($page < $total_pages): ?>
                    <a class="danhmuc__right-paging-prev"
                        href="<?php echo $local . '/danh-muc.php' . '?khoa=' . $khoa_slug . '&benh=' . $benh_slug . '&page=' . ($page + 1); ?>">
                        <svg width="30" height="30" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                            <path fill="white"
                                d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z">
                            </path>
                        </svg>
                    </a>
                <?php endif; ?>
            </div>
            <div style="width: 100%;">
                <img loading="lazy" width="100%" height="auto"
                    src="<?php echo $local ?>/images/logo_mobile/bg_mobile_km.gif" alt="...">
            </div>

        </div>
    </main>

    <script>
        function formatPhoneNumber(phoneNumber) {
            let cleaned = ('' + phoneNumber).replace(/\D/g, '');
            let match = cleaned.match(/^(\d{4})(\d{3})(\d{3})$/);
            if (match) {
                return '(' + match[1] + ') ' + match[2] + '-' + match[3];
            }
            return null;
        }
        document.querySelector('button[name="submitTuVan"]').addEventListener('click', function(event) {
            event.preventDefault(); // Ngăn chặn hành động mặc định của nút submit

            let form = document.getElementById('form-tuvan');
            let inputs = form.getElementsByTagName('input');
            let formData = {};

            for (let i = 0; i < inputs.length; i++) {
                let input = inputs[i];
                formData[input.name] = input.value;
            }

            formData['url'] = window.location.href;

            if (formData.hoten !== '' && formData.ngaysinh !== '' && formData.sdt !== '' && formData.trieuchung !==
                '') {
                if (formatPhoneNumber(formData.sdt)) {
                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", "<?php echo $local ?>/classes/ajax/create_form_tu_van.php", true);
                    xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            let response = JSON?.parse(xhr.responseText);
                            if (response.status === 'success') {
                                toastr(response.message, 'success');
                                for (let i = 0; i < inputs.length; i++) {
                                    let input = inputs[i];
                                    input.value = '';
                                }

                            } else {
                                toastr(response.message, 'warning');
                            }
                        }
                    };


                    xhr.send(JSON.stringify(formData));
                } else {
                    toastr("Số điện thoại không hợp lệ!", 'warning');
                }

            } else {
                toastr("Tất cả các trường không được bỏ trống!", 'warning');
            }


        });
    </script>

    <?php include 'inc/footer.php' ?>