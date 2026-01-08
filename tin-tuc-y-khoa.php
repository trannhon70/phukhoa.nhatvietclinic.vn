<?php include 'inc/header.php' ?>
<link rel="stylesheet" href="<?php echo $local ?>/css/tin-tuc-y-khoa.min.css">
</head>

<?php
$current_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
$current_url .= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$parsed_url = parse_url($current_url);

$path = parse_url($parsed_url['path'], PHP_URL_PATH); // Lấy phần path từ URL
$filename = basename($path, ".html"); // Lấy tên file và loại bỏ .html

$getByIdTT = null;
if ($filename === 'tin-tuc-y-khoa') {
    $getByIdTT = $tin_tuc->getOneLimitTinTuc();
} else {
    $getByIdTT = $tin_tuc->getByslug_tintuc($filename);
}

?>

<body>
    <?php include 'layout/header_component.php' ?>
    <main>
        <?php include 'layout/slider_component.php' ?>
        <div class="danhmuc">
            <div class="danhmuc__left">

                <div class="danhmuc__left-div">
                    <div class="danhmuc__left-banner">
                        <img loading="lazy" class="danhmuc__left-banner-img"
                            src="<?php echo $local ?>/images/banner/banner_khuyen_mai.webp" height="380px" width="250px"
                            alt="..."></img>
                    </div>
                </div>

            </div>
            <div class="danhmuc__right">
                <?php if (Session::get('role') === '1' || Session::get('role') === '2') {
                ?>

                <a class="chinh-sua"
                    href="<?php echo $local ?>/admin/tin-tuc-edit.php?edit=<?php echo $getByIdTT['id'] ?>"><i
                        style="font-size:19px" class="bx bxs-pencil"></i>chỉnh sửa</a>

                <?php } ?>
                <div class="danhmuc__right-title"><?php echo $getByIdTT['tieu_de'] ?></div>
                <div id="bg_mobile_km">
                    <img width="100%" height="auto" src="<?php echo $local ?>/images/logo_mobile/bg_mobile_km.gif"
                        alt="...">
                </div>
                <hr>
                <div class="danhmuc__right-content" id="bai-viet">
                    <?php echo htmlspecialchars_decode($getByIdTT['content']); ?> </div>

            </div>
        </div>
    </main>

    <script>
    document.addEventListener('DOMContentLoaded', (event) => {
        //images gây shock
        const shockElements = document.querySelectorAll('.shock_img');
        shockElements.forEach(shockElement => {

            shockElement.classList = 'hiden_img'
            const viewdiv = document.createElement('div');
            viewdiv.id = 'viewdiv';
            viewdiv.className = 'view';
            viewdiv.textContent = 'Hình ảnh có nội dung gây shock !! cân nhất trước khi xem';

            const viewbutton = document.createElement('button');
            viewbutton.id = 'viewbutton';
            viewbutton.className = 'view_button';
            viewbutton.textContent = 'click vào xem';
            // Append the button to the parent of the shockElement (image-container)
            shockElement.appendChild(viewdiv);
            shockElement.appendChild(viewbutton);

            // Add click event listener to the button
            viewbutton.addEventListener('click', () => {
                // Remove the blur effect
                shockElement.classList.remove('blurred');
                shockElement.classList.remove('hiden_img');
                // Hide the button
                viewdiv.classList.add('hidden');
                viewbutton.classList.add('hidden');
            });
        })

        let baiVietElement = document.getElementById('bai-viet');
        if (baiVietElement) {
            let pElements = baiVietElement.getElementsByTagName('p');
            for (let i = 0; i < pElements.length; i++) {
                pElements[i].style.color = '#000000'; // Ghi đè CSS trước đó
                pElements[i].style.fontWeight = 400;
                pElements[i].style.fontSize = '14px';
                pElements[i].style.lineHeight = '27px';
            }

            let h2Elements = baiVietElement.getElementsByTagName('h2');
            for (let i = 0; i < h2Elements?.length; i++) {
                h2Elements[i].style.color = '#0060A7';
                h2Elements[i].style.fontWeight = '700';
                h2Elements[i].style.fontSize = '23px';
                h2Elements[i].style.textTransform = 'capitalize';
                h2Elements[i].style.background =
                    'url("<?php echo $local ?>/images/icons/icon_cong.webp") no-repeat left center';
                h2Elements[i].style.backgroundSize = '23px 23px';
                h2Elements[i].style.paddingLeft = '25px';
                h2Elements[i].style.margin = '7px 0px';

            }

            let h3Element = baiVietElement.getElementsByTagName('h3');

            for (let i = 0; i < h3Element.length; i++) {
                h3Element[i].style.color = '#00D8D8';
                h3Element[i].style.fontWeight = '700';
                h3Element[i].style.fontSize = '21px';
                h3Element[i].style.textTransform = 'capitalize';
                h3Element[i].style.background =
                    'url("<?php echo $local ?>/images/icons/icon_mui.gif") no-repeat left center';
                h3Element[i].style.backgroundSize = '21px 21px';
                h3Element[i].style.paddingLeft = '25px';
                h3Element[i].style.display = 'flex';
                h3Element[i].style.alignItems = 'center';
                h3Element[i].style.height = '25px';
                h3Element[i].style.margin = '7px 0px';
            }
        }

        let imgElements = baiVietElement.getElementsByTagName('img');
        if (imgElements) {
            for (let i = 0; i < imgElements.length; i++) {
                // convert link img
                if (imgElements[i].src.startsWith('<?php echo $local ?>/ckeditor/uploads/') == true) {
                    let urlParts = imgElements[i].src.split('/');
                    let fileName = urlParts[urlParts.length - 1];
                    imgElements[i].src = '<?php echo $local ?>/admin/ckeditor/uploads/' + fileName;
                }

                //hiển thị css img chatbox
                if (imgElements[i].src.startsWith(
                        '<?php echo $local ?>/ckfinder/userfiles/images/Chat/Chat-Dakhoa.gif') ==
                    // if (imgElements[i].src.startsWith(
                    //         'http://localhost/ckfinder/userfiles/images/Chat/Chat-Dakhoa.gif') ==
                    true) {
                    imgElements[i].style.borderRadius = '8px';
                    let divWrapper = document.createElement('p');
                    divWrapper.className = 'glow-on-hover';
                    imgElements[i].parentNode.insertBefore(divWrapper, imgElements[i]);
                    divWrapper.appendChild(imgElements[i])
                }
            }

        }

        //xử lý menu left scroll
        var rightBottom = document.querySelector('.danhmuc__left-div');
        var containerRow = document.querySelector('.danhmuc');
        var rightColumn = document.querySelector('.danhmuc__right');
        var rightCenter = document.querySelector('.danhmuc__left-div');
        var baiViet = document.getElementById('bai-viet');

        if (rightBottom && containerRow && rightColumn && rightCenter && baiViet) {
            window.addEventListener('scroll', function() {
                var containerRowRect = containerRow.getBoundingClientRect();
                var rightColumnRect = rightColumn.getBoundingClientRect();
                var rightBottomHeight = rightBottom.offsetHeight;
                var rightCenterRect = rightCenter.getBoundingClientRect();
                var baiVietRect = baiViet.getBoundingClientRect();

                // Kiểm tra khi scroll đến hết nội dung của id="bai-viet"
                if (baiVietRect.bottom > window.innerHeight) {
                    if (containerRowRect.bottom - (rightBottomHeight - 700) <= window.innerHeight) {
                        rightBottom.style.position = 'absolute';
                        rightBottom.style.bottom = '0';
                        rightBottom.style.top = 'unset';
                    } else if (rightColumnRect.top + rightCenterRect.height <= 0) {
                        rightBottom.style.position = 'fixed';
                        rightBottom.style.top = '20px';
                        rightBottom.style.bottom = 'unset';
                        rightBottom.style.width = '250px';
                    } else {
                        rightBottom.style.position = 'relative';
                        rightBottom.style.top = 'unset';
                        rightBottom.style.bottom = 'unset';
                    }
                } else {
                    rightBottom.style.position = 'relative';
                    rightBottom.style.top = 'unset';
                    rightBottom.style.bottom = 'unset';
                }
            });
        } else {
            console.warn("One or more elements were not found in the DOM.");
        }
    })
    </script>

    <?php include 'inc/footer.php' ?>