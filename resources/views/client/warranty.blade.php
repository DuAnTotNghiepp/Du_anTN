@extends('client.layouts.app')

@section('content')
<section class="policy">
    <div class="policy-content">
        <div class="policy-section">
            <h2><i class="fas fa-calendar-check"></i> Thời Gian Bảo Hành</h2>
            <p>Toàn bộ sản phẩm đều có bảo hành 1 năm từ ngày mua hàng. Bảo hành chỉ áp dụng cho lỗi do nhà sản xuất.</p>
        </div>

        <div class="policy-section">
            <h2><i class="fas fa-shield-alt"></i> Điều Kiện Bảo Hành</h2>
            <p>Chính sách bảo hành bao gồm lỗi do vật liệu và gia công trong điều kiện sử dụng bình thường.</p>
        </div>

        <div class="policy-section">
            <h2><i class="fas fa-clipboard-check"></i> Cách Thức Yêu Cầu Bảo Hành</h2>
            <p>Giữ lại hóa đơn mua hàng và liên hệ bộ phận CSKH để được hỗ trợ bảo hành nhanh chóng.</p>
        </div>

        <div class="policy-section">
            <h2><i class="fas fa-exclamation-circle"></i> Hạn Chế Bảo Hành</h2>
            <p>Chính sách không áp dụng cho các trường hợp hư hỏng do sử dụng sai, tai nạn, hoặc tự ý sửa chữa.</p>
        </div>
    </div>
</section>

<button id="backToTop" title="Lên đầu trang"><i class="fas fa-arrow-up"></i></button>
<script>
    // Hiển thị nút lên đầu trang khi cuộn
window.onscroll = function() {
    const backToTopButton = document.getElementById('backToTop');
    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
        backToTopButton.style.display = 'block';
    } else {
        backToTopButton.style.display = 'none';
    }
};

// Cuộn lên đầu trang khi nhấn nút
document.getElementById('backToTop').onclick = function() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
};

</script>

<style>
    /* Reset chung */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #e0f7fa, #f1f8e9);
    color: #333;
    line-height: 1.6;
}


/* Phần nội dung chính sách */
.policy {
    max-width: 800px;
    margin: 2em auto;
    background: #fff;
    padding: 2em;
    border-radius: 15px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.policy:hover {
    transform: translateY(-5px);
}

.policy-section {
    margin-bottom: 1.5em;
}

.policy-section h2 {
    color: #42a5f5;
    margin-bottom: 0.5em;
    font-size: 1.6em;
    display: flex;
    align-items: center;
}

.policy-section h2 i {
    margin-right: 0.6em;
    font-size: 1.2em;
    color: #26c6da;
}

.policy-section p {
    font-size: 1.1em;
    color: #555;
}

/* Nút lên đầu trang */
#backToTop {
    display: none;
    position: fixed;
    bottom: 30px;
    right: 30px;
    background: #42a5f5;
    color: #fff;
    border: none;
    padding: 12px 15px;
    border-radius: 50%;
    font-size: 18px;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    transition: background 0.3s ease, transform 0.3s ease;
}

#backToTop:hover {
    background: #26c6da;
    transform: scale(1.1);
}

</style>
@endsection
