@extends('client.layouts.app')

@section('content')
<div class="container">
    <section class="steps">
        <div class="step">
            <div class="icon">&#128722;</div>
            <h2>Bước 1: Chọn Sản Phẩm</h2>
            <p>Tìm kiếm sản phẩm mà bạn yêu thích và xem chi tiết sản phẩm để đưa ra quyết định.</p>
            <button onclick="showDetails(1)">Xem thêm</button>
            <div class="details" id="details-1">
                <p>Khi chọn sản phẩm, hãy xem kỹ các thông tin như kích thước, màu sắc, đánh giá từ khách hàng khác.</p>
                <img src="{{ asset('assets/images/product/added-p2.png') }}" alt="">
            </div>
        </div>

        <div class="step">
            <div class="icon">&#128717;</div>
            <h2>Bước 2: Thêm Vào Giỏ Hàng</h2>
            <p>Chọn sản phẩm và số lượng rồi thêm vào giỏ hàng của bạn.</p>
            <button onclick="showDetails(2)">Xem thêm</button>
            <div class="details" id="details-2">
                <p>Trong giỏ hàng, bạn có thể điều chỉnh số lượng hoặc xóa sản phẩm nếu muốn.</p>
            </div>
        </div>

        <!-- Bước Nhập Thông Tin Giao Hàng -->
        <div class="step">
            <div class="icon">&#128100;</div>
            <h2>Bước 3: Nhập Thông Tin Người Nhận</h2>
            <p>Vui lòng nhập thông tin cá nhân để chúng tôi có thể giao hàng đến địa chỉ của bạn.</p>
            <button onclick="showDetails(3)">Xem thêm</button>
            <div class="details" id="details-3">
                <p>Bạn hãy nhập thông tin về người nhận hàng.</p>
            </div>
        </div>

        <div class="step">
            <div class="icon">&#128179;</div>
            <h2>Bước 4: Thanh Toán</h2>
            <p>Chọn phương thức thanh toán và nhập thông tin giao hàng.</p>
            <button onclick="showDetails(4)">Xem thêm</button>
            <div class="details" id="details-3">
                <p>Bạn có thể thanh toán qua nhiều hình thức: thẻ ngân hàng, ví điện tử, hoặc COD (thanh toán khi nhận hàng).</p>
            </div>
        </div>

        <div class="step">
            <div class="icon">&#128230;</div>
            <h2>Bước 5: Nhận Hàng</h2>
            <p>Kiểm tra đơn hàng và nhận sản phẩm tại địa chỉ của bạn.</p>
            <button onclick="showDetails(5)">Xem thêm</button>
            <div class="details" id="details-4">
                <p>Bạn sẽ được thông báo khi đơn hàng được giao. Hãy kiểm tra sản phẩm và liên hệ hỗ trợ nếu cần.</p>
            </div>
        </div>
    </section>
</div>

<script>
    function showDetails(step) {
    const details = document.getElementById(`details-${step}`);
    const isVisible = details.style.display === 'block';
    details.style.display = isVisible ? 'none' : 'block';
}
</script>
<style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
body {
    font-family: 'Poppins', sans-serif;
    line-height: 1.6;
    background-color: #f4f7f6;
}

.steps {
    max-width: 900px;
    margin: 40px auto;
    padding: 20px;
    display: flex;
    flex-direction: column;
    gap: 20px;
}
.step {
    background: #fff;
    border-radius: 10px;
    padding: 30px;
    position: relative;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}
.step:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
}
.icon {
    font-size: 2.5rem;
    color: #2575fc;
    position: absolute;
    top: 20px;
    right: 20px;
}
h2 {
    color: #333;
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 10px;
}
.step button {
    background: #2575fc;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-top: 15px;
    transition: background 0.3s ease;
}
.step button:hover {
    background: #6a11cb;
}
.details {
    display: none;
    margin-top: 10px;
    color: #555;
    font-size: 0.9rem;
    line-height: 1.5;
}
form {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin-top: 15px;
}
form label {
    font-weight: 600;
    color: #333;
}
form input {
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 1rem;
}
form button {
    background: #2575fc;
    color: #fff;
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s ease;
}
form button:hover {
    background: #6a11cb;
}
</style>
@endsection
