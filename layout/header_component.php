<header id="header_pc" class="header">
    <div class="header__top">
        <div class="header__top-left">
            <img loading="lazy" class="header__top-left-logo" src="<?php echo $local ?>/images/logo/logo2.webp"
                height="70px" width="250px" alt="...">
        </div>
        <div class="header__top-list">
            <div class="header__top-list-item">
                <div style="width: 35px;height: 35px;">
                    <img loading="lazy" class="header__top-list-item-icon"
                        src="<?php echo $local ?>/images/icons/icon_phone.webp" height="35px" width="35px"
                        alt="..."></img>
                </div>
                <div class="header__top-list-item-text">Đường dây nóng <br>
                    028-7776-7777
                </div>
            </div>
            <div class="header__top-list-item">
                <div style="width: 35px;height: 35px;">
                    <img loading="lazy" class="header__top-list-item-icon"
                        src="<?php echo $local ?>/images/icons/icon_user.webp" height="35px" width="35px"
                        alt="..."></img>
                </div>
                <div class="header__top-list-item-center">
                    <div class="header__top-list-item-center-top">Giờ làm việc
                        <br>
                        8:00 - 20:00
                    </div>
                    <h5 class="">
                        Tất cả các ngày trong tuần, kể cả ngày lễ
                    </h5>
                </div>
            </div>
            <div class="header__top-list-item">
                <div style="width: 35px;height: 35px;">
                    <img loading="lazy" class="header__top-list-item-icon"
                        src="<?php echo $local ?>/images/icons/icon_location.webp" height="35px" width="35px" alt="...">
                    </img>
                </div>
                <div class="header__top-list-item-center">
                    <div class="header__top-list-item-center-top">Địa chỉ
                    </div>
                    <h5 class="">
                        73 Kinh Dương Vương,
                        P.12, Q.6, TP.HCM
                    </h5>
                </div>
            </div>
        </div>
    </div>
    <div class="header__bottom">
        <nav class="header__bottom-nav">
            <ul class="header__bottom-nav-ul">
                <li>
                    <a href="<?php echo $local ?>">
                        <img loading="lazy" class="header__top-list-item-icon"
                            src="<?php echo $local ?>/images/icons/icon_home.webp" height="35px" width="35px" alt="...">
                        </img>
                    </a>
                </li>
                <li class="header__bottom-nav-ul-li header__bottom-border">
                    <a class="" target="_blank"
                        href="https://phongkhamdakhoanhatviet.vn/phong-kham-da-nhat-viet-phong-kham-da-khoa-uy-tin-tphcm-7.html">giới
                        thiệu</a>
                </li>
                <li class="header__bottom-nav-ul-li header__bottom-border header__bottom-positon">
                    <a class="" href="<?php echo $local ?>">danh mục bệnh</a>
                    <!-- <div class="header__menu">
                        <div></div>
                        <nav>
                            <?php foreach ($getAllChiTietKhoaAndBenh as $value) : ?>
                                <ul>
                                    <li>
                                        <span><?php echo $value['name']; ?></span>
                                    </li>
                                    <?php foreach ($value['danhSachBenh'] as $benh) : ?>
                                        <li class="header__menu-li">
                                            <a href="<?php echo $local ?>/danh-muc.php?khoa=<?php echo $value['slug'] ?>&benh=<?php echo $benh['slug'] ?>&page=1"><?php echo $benh['name']; ?></a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endforeach; ?>
                        </nav>
                    </div> -->
                </li>
                <li class="header__bottom-nav-ul-li header__bottom-border">
                    <a class="" href="<?php echo $local ?>/tin-tuc-y-khoa.html">tin tức y khoa</a>
                </li>
                <li class="header__bottom-nav-ul-li header__bottom-border">
                    <a class="" href="<?php echo $local ?>">tư vấn trực tuyến</a>
                </li>
            </ul>
        </nav>
    </div>
</header>

<header id="header__mobile" class="header__mobile">
    <div class="header__mobile-top">
        <div class="header__mobile-top-left">
            <img loading="lazy" onclick="showSidebar()" class="header__mobile-top-left-icon"
                src="<?php echo $local ?>/images/icons/menu_white.webp" height="25px" width="25px" alt="..."></img>
            <img loading="lazy" onclick="hidenSidebar()" class="header__mobile-top-left-icon-close"
                src="<?php echo $local ?>/images/icons/icon_close.webp" height="25px" width="25px" alt="..."></img>
        </div>
        <div class="header__mobile-top-center">
            Phòng khám đa khoa nhật việt
        </div>
        <div class="header__mobile-top-left">

        </div>
    </div>
    <div class="header__mobile-row">
        <a href="<?php echo $local ?>" class="header__mobile-row-left" aria-label="logo_mobile">
            <img loading="lazy" width="100%" height="40px"
                src="<?php echo $local ?>/images/logo_mobile/logo_mobile.webp" alt="">
        </a>
        <a href="tel:+02877767777" class="header__mobile-row-right">
            <img loading="lazy" class="header__mobile-row-right-icon"
                src="<?php echo $local ?>/images/icons/icon_phone_no.webp" height="30px" width="25px" alt="..."></img>
            <div class="header__mobile-row-right-hotline">
                <div>TƯ VẤN TRỰC TUYẾN</div>
                <span>028-7776-7777</span>
            </div>
        </a>
    </div>
    <div class="header__mobile-banner">
        <img src="<?php echo $local ?>/images/banner/mobile_banner.webp" alt="Banner" width="1200" height="400"
            style="width:100%; height:auto;" fetchpriority="high">
    </div>

    <nav>
        <ul class="sidebar_mobile">
            <li>
                <a href="<?php echo $local ?>/phong-kham-da-nhat-viet-phong-kham-da-khoa-uy-tin-tphcm-7.html">giới
                    thiệu</a>
            </li>
            <li class="sidebar_mobile_li">
                <div onclick="showShelectOption()">
                    <span>danh mục bệnh</span>
                    <img loading="lazy" src="<?php echo $local ?>/images/icons/icon_down.png" alt="">
                </div>
                <!-- <ul class="sidebar_mobile_li-option">
                    <?php foreach ($getMenuMobile as $value) : ?>
                        <li class="sidebar_mobile_li-option-li">
                            <div data-option="<?php echo $value['id'] ?>" class="sidebar_mobile_li-option-li-div">
                                <span><?php echo $value['name'] ?></span>
                                <img src="<?php echo $local ?>/images/icons/add.webp" alt="">
                            </div>
                            <ul>
                                <?php foreach ($value['dsBenh'] as $item) : ?>
                                    <li>
                                        <a href="<?php echo $local ?>/danh-muc.php?khoa=<?php echo $value['slug'] ?>&benh=<?php echo $item['slug'] ?>&page=1"> <?php echo $item['name'] ?></a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                    <?php endforeach; ?>
                </ul> -->
            </li>

            <li>
                <a href="<?php echo $local ?>/tin-tuc-y-khoa.html">tin tức y khoa</a>
            </li>
            <li>
                <a href="<?php echo $local ?>">tư vấn trực tuyến </a>
            </li>
        </ul>
    </nav>
</header>

<!-- <script>
    function showOption(optionId) {
        const allOptions = document.querySelectorAll('.sidebar_mobile_li-option-li ul');
        const allItems = document.querySelectorAll('.sidebar_mobile_li-option-li');

        allOptions.forEach(option => {
            option.classList.remove('option__show');
            option.classList.add('option__hidden');
        });

        allItems.forEach(item => {
            item.style.borderBottom = ""; // Reset border
        });

        const optionToShow = document.querySelector(`.sidebar_mobile_li-option-li div[data-option="${optionId}"]`);
        const menuToShow = optionToShow ? optionToShow.nextElementSibling : null;
        const parentItem = optionToShow ? optionToShow.parentElement : null;

        if (menuToShow) {
            menuToShow.classList.remove('option__hidden');
            menuToShow.classList.add('option__show');
        }

        if (parentItem) {
            parentItem.style.borderBottom = "0px";
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        showOption(1);

        document.querySelectorAll('.sidebar_mobile_li-option-li-div').forEach(div => {
            div.addEventListener('click', () => {
                const optionId = div.getAttribute('data-option');
                showOption(optionId);
            });
        });
    });

    
</script> -->

<div id="toast-container"></div>