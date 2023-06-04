<script src="../path/to/flowbite/dist/flowbite.min.js"></script>
<script src="https://unpkg.com/taos@1.0.2/dist/taos.js"></script>
{{-- fontawesome --}}
<script src="https://kit.fontawesome.com/bc51f3fd1e.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script>
    // get the carousel and its inner element
    const carousel = document.querySelector('.carousel');

    let isDragging = false;
    let startX;
    let scrollLeft;

    carousel.addEventListener('touchstart', e => {
        isDragging = true;
        startX = e.touches[0].pageX - carousel.offsetLeft;
        scrollLeft = carousel.scrollLeft;
    });

    carousel.addEventListener('mousemove', e => {
        if (!isDragging) return;
        e.preventDefault();
        const x = e.pageX - carousel.offsetLeft;
        const walk = (x - startX) * 2;
        carousel.scrollLeft = scrollLeft - walk;
    });

    carousel.addEventListener('touchmove', e => {
        if (!isDragging) return;
        e.preventDefault();
        const x = e.touches[0].pageX - carousel.offsetLeft;
        const walk = (x - startX) * 2;
        carousel.scrollLeft = scrollLeft - walk;
    });

    // add event listeners for mousedown, mousemove, and mouseup
    carousel.addEventListener('mousedown', e => {
        isDragging = true;
        startX = e.pageX - carousel.offsetLeft;
        scrollLeft = carousel.scrollLeft;
    });

    carousel.addEventListener('mousemove', e => {
        if (!isDragging) return;
        e.preventDefault();
        const x = e.pageX - carousel.offsetLeft;
        const walk = (x - startX) * 2;
        carousel.scrollLeft = scrollLeft - walk;
    });

    carousel.addEventListener('mouseup', () => {
        isDragging = false;
    });

    carousel.addEventListener('mouseleave', () => {
        isDragging = false;
    });
</script>

<script>
    // Retrieve the HTML elements
    const items = document.querySelectorAll(".item");
    const cartlist = document.querySelectorAll('.data-cart-list')
    console.log(cartlist)
    const totalProduct = document.querySelector(".totalItem")
    // Data that add in cart
    const dataCart = []

    // Create an array of objects to store the price and quantity for each item
    const cart = [];
    items.forEach((item) => {
        const priceElement = item.querySelector(".price");
        const price = parseFloat(priceElement.innerText);
        const counterElement = item.querySelector(".counter");
        const totalElement = item.querySelector(".total");
        const image = item.querySelector(".item-image");
        const name = item.querySelector(".item-name");
        const rawItem = item.querySelector(".itemPerProduct");

        cart.push({
            price,
            counterElement,
            totalElement,
            image,
            name,
            rawItem
        });

        // Set the initial total price for the item
        // totalElement.innerText = `Rp${(0).toLocaleString("id-ID")}`;
    });

    // Add event listeners to the buttons
    items.forEach((item, index) => {
        const minusButton = item.querySelector(".minus");
        const plusButton = item.querySelector(".plus");
        const cartButton = item.querySelector(".add-to-cart-btn");
        const {
            price,
            counterElement,
            totalElement,
            rawItem
        } = cart[index];

        minusButton.addEventListener("click", () => {
            let currentValue = parseInt(counterElement.innerText);
            if (currentValue > 1) {
                currentValue -= 1;
                counterElement.innerText = currentValue;
                document.querySelector(`.counterQty-${index + 1}`).value = currentValue;
                const totalPrice = currentValue * price;
                totalElement.innerText = `Rp ${totalPrice.toLocaleString("id-ID")}`;
            }
        });

        plusButton.addEventListener("click", () => {
            let currentValue = parseInt(counterElement.innerText);
            currentValue += 1;
            counterElement.innerText = currentValue;
            document.querySelector(`.counterQty-${index + 1}`).value = currentValue;
            const totalPrice = currentValue * price;
            totalElement.innerText = `Rp ${totalPrice.toLocaleString("id-ID")}`;
        });

    });
</script>
{{-- calculate change --}}
<script>
    const num1Input = document.getElementById('num1');
    const num2Input = document.getElementById('num2');
    const resultOutput = document.getElementById('change');

    // Define the function to calculate the result
    function calculateResult() {
        const num1 = Number(num1Input.value);
        const num2 = Number(num2Input.value);
        const result = num1 - num2;
        document.getElementById("change").value = result;
    }

    // Attach the event listeners to the input fields
    num1Input.addEventListener('input', calculateResult);
    num2Input.addEventListener('input', calculateResult);
</script>
{{-- sweetalert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
<script>
    document.querySelector(".delete").addEventListener('click', function(){
        Swal.fire({
            icon: 'success',
            title: 'Pesanan berhasil dihapus!',
            showConfirmButton: false,
        })
    });
</script>

<script>
    function printSection() {
        var section = document.getElementById("printSection");
        var sectionContent = section.innerHTML;
        var originalContent = document.body.innerHTML;
        document.body.innerHTML = sectionContent;
        window.print();
        document.body.innerHTML = originalContent;
    }
</script>