 <footer class="footer" id="footer_pc">

 </footer>




 <script>
document.addEventListener('DOMContentLoaded', () => {
    function updateHeaderScripts() {
        // Xóa các script cũ nếu có
        const existingMobileScripts = document.querySelectorAll('script[id^="mobile-"]');
        const existingDesktopScripts = document.querySelectorAll('script[id^="desktop-"]');
        existingMobileScripts.forEach(script => script.remove());
        existingDesktopScripts.forEach(script => script.remove());

        if (window.innerWidth < 1000) {
            const mobileScripts = [{
                    src: '<?php echo $local ?>/js/mobile.min.js',
                    id: 'mobile-0'
                },
                // {
                //     src: 'js/siderbar_mobile.min.js',
                //     id: 'mobile-1'
                // },

            ];
            mobileScripts.forEach(({
                src,
                id
            }) => {
                const script = document.createElement('script');
                script.src = src;
                script.id = id;
                document.body.appendChild(script);
            });
        } else {
            const desktopScripts = [{
                    src: '<?php echo $local ?>/js/slider.min.js',
                    id: 'desktop-0'
                },

            ];
            desktopScripts.forEach(({
                src,
                id
            }) => {
                const script = document.createElement('script');
                script.src = src;
                script.id = id;
                document.body.appendChild(script);
            });
        }
    }

    updateHeaderScripts();

    window.addEventListener('resize', () => {
        updateHeaderScripts();
    });
});
 </script>
 </body>

 </html>