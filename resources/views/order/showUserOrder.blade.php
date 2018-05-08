<style>
    #showOptionOrder {
        background-color: white;
        box-shadow: 0 1px 1px 0 rgba(0,0,0,.05);
        padding:0px 15px

    }
    #orderOptions {
        border-radius: 2px;
        background-color: white;
        margin-bottom: 10px;
        box-shadow: 0 1px 1px 0 rgba(0,0,0,.05);
    }
    .orderOption {
        padding: 1%;
        text-align: center;
        width: 33%;
        display: inline-block;
    }
    .orderOption.chose{
        border-bottom: 2px solid orangered;
    }
    .orderOption strong {
        color: orangered;
    }
</style>
<div id="orderOptions">
    <div class="orderOption chose" role="button" id="waitting">
        <strong>Chờ Lấy Hàng</strong>
    </div>
    <div class="orderOption" role="button" id="shipping">
        <strong>Đang Giao</strong>
    </div>
    <div class="orderOption" role="button" id="wasPaid">
        <strong>Đã Thanh Toán</strong>
    </div>
</div>
<div id="showOptionOrder" >

</div>
<script>
    $(document).ready(function () {
        $('#showOptionOrder').load('./showOptionOrder/waitting');
    });
    function showOrderOption(element, page) {
        console.log(element);
        element.siblings('.orderOption').removeClass('chose');
        element.addClass('chose');
        $.ajax({
            url: page,
            method: "GET",
            success: function (result) {
                $('#showOptionOrder').html(result);
            }
        });
    }
    $('#waitting').click(function () {
        showOrderOption($(this), './showOptionOrder/waitting')
    });
    $('#shipping').click(function () {
        showOrderOption($(this), './showOptionOrder/shipping')
    });
    $('#wasPaid').click(function () {
        showOrderOption($(this), './showOptionOrder/waspaid')
    });


</script>
