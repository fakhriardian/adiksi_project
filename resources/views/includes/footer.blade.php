<footer class="footer footer-center p-4 mt-4 bg-base-200 text-base-content">
    <div class="grid grid-flow-col gap-4">
        <a href="/" class="link link-hover">Home</a> 
        <a href="/pesan" class="link link-hover">Pesan</a> 
        <a href="/menu" class="link link-hover">Menu</a> 
        <a href="/lokasi-store" class="link link-hover">Lokasi</a>
        <a href="/hubungi-kami" class="link link-hover">Hubungi Kami</a>
    </div> 
    <div>
        @foreach ($contact as $item)            
            <div class="flex justify-center gap-10 p-2">
                <a href="{{ $item['insta'] }}" target="_blank">
                    <i class="fa-brands fa-instagram text-3xl"></i> 
                </a> 
                <a href="{{ $item['tiktok'] }}" target="_blank">
                    <i class="fa-brands fa-tiktok text-3xl"></i>
                </a>
                <a href="https://web.whatsapp.com/send/?phone={{ $item['telp'] }}&text=Hi+admin?" target="_blank">
                    <i class="fa-solid fa-phone text-3xl"></i>
                </a>
            </div>
        @endforeach
    </div> 
    <div>
        <p>Copyright © 2023 - All right reserved by Adiksi coffee shop</p>
    </div>
</footer>