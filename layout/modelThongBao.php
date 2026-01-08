
<style>
        /* Modal container */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            /* background-color: rgba(0, 0, 0, 0.4); */
        }

        /* Modal content */
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            border-radius: 8px;
            width: 440px;
            height: 250px;
            animation-duration: 1s;
            animation-name: slidein;
        }

        .modal-content > p {
            font-size: 22px;
            font-weight: 500;
            line-height: 34px;
            color: #e90101;
            text-align: center;
            margin-top: 50px;
        }

        @keyframes slidein {
            from {
                transform: translateX(150vw) scaleX(2);
            }

            to {
                transform: translateX(0) scaleX(1);
            }
        }

        @keyframes slideout {
            from {
                transform: translateX(0) scaleX(1);
            }

            to {
                transform: translateX(150vw) scaleX(2);
            }
        }

        /* Close button */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        @media only screen and (max-width: 900px) {
            .modal{
                top: 15%;
            }
            .modal-content{
                width: 90%;
                height: 250px;
                box-sizing: border-box;
            }
            .modal-content > p{
                font-size: 18px;
                font-weight: 500;
                line-height: 34px;
                color: #e90101;
                text-align: center;
                margin-top: 28px;
            }
            .modal-content{
                padding: 10px;
            }
        }
    </style>

<button style="display: none;" id="openModalBtn">Open Modal</button>

<!-- The Modal -->
<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <span class="close">&times;</span>
        <p>THÔNG CÁO : TRANG WEB ĐANG TRONG QUÁ TRÌNH THỬ NGHIỆM, ĐÂY CHỈ LÀ BẢN DEMO</p>
    </div>

</div>

<script>
    var modal = document.getElementById("myModal");

    var btn = document.getElementById("openModalBtn");

    var span = document.getElementsByClassName("close")[0];

    function openModal() {
        modal.style.display = "block";
        modal.querySelector('.modal-content').style.animationName = 'slidein';
    }

    btn.onclick = function() {
        openModal();
    }

    span.onclick = function() {
        closeModal();
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            closeModal();
        }
    }

    function closeModal() {
        const modalContent = modal.querySelector('.modal-content');
        modalContent.style.animationName = 'slideout';
        modalContent.addEventListener('animationend', function handler() {
            modal.style.display = 'none';
            modalContent.style.animationName = ''; // Reset animation name
            modalContent.removeEventListener('animationend', handler);
            setTimeout(openModal, 10000); // Reopen the modal after 40 seconds
        });
    }

    setTimeout(openModal, 5000);
</script>


