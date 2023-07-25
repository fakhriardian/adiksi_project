<script type="text/javascript"
src="https://app.sandbox.midtrans.com/snap/snap.js"
data-client-key="midtrans.client_key"></script>
@extends('layouts.transaction')
<div class="md:p-16 p-1">
    <div class="relative md:gap-20 gap-2 flex my-auto drop-shadow-2xl lg:flex-row flex-col items-center rounded-2xl md:h-[80vh] h-full dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
        <div class="absolute left-0 top-0 w-full h-full bg-center bg-cover -z-20 rounded-2xl hidden md:block"
            style="background-image: url(asset/gradient-background.png)">
        </div>
        <div class="flex flex-col bg-white rounded-2xl md:w-2/4 w-full h-full justify-between p-4 leading-normal">
            <div class="flex justify-between">
                <form method="post" action="{{ route('back.destroyBooking', $get->created_at) }}">
                    @csrf
                    @method('DELETE')
                    <button class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-gray-100 rounded-lg hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        Back
                    </button>
                </form>
                <h5 class="text-xl mt-1 font-bold tracking-tight text-gray-900 dark:text-white">
                    payment
                </h5>
            </div>
            <div class="flex-col p-3">
                <p class="text-xl font-normal ">
                    <h5 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                        {{ Auth()->user()->name }}
                    </h5>
                    please complete your payment
                </p>
            </div>

            <img class="object-cover w-full rounded-2xl" src="/asset/payment-vector.png" alt="">
            <p class="text-gray-500 text-xs">Copyright © 2023 - All right reserved by Adiksi coffee shop</p>
        </div>

        <div class="relative w-full mx-auto flex flex-col p-5 backdrop-blur-2xl drop-shadow-2xl rounded-2xl shadow dark:bg-gray-800 dark:border-gray-700 text-white">
            <div class="absolute left-0 top-0 w-full h-full bg-center bg-cover -z-20 rounded-2xl block lg:hidden"
                style="background-image: url(asset/gradient-background.png)">
            </div>
            <div class="relative w-full backdrop-blur-2xl p-5">
                <div class="flex justify-between items-center mb-6">
                    <div id="poppins" class="flex md:text-xl text-md font-bold">
                        Rincian transaksi
                    </div>
                    <div id="poppins" class="flex md:text-xl text-md font-bold">
                        Id : {{ $order_id }}
                    </div>
                </div>


                <div class="flex flex-col items-center rounded-lg md:flex-row md:max-w-xl">
                    <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-l-lg" src="/store-image/meetingroom.png" alt="">
                    <div class="flex-col p-4 w-full">
                        <div class="flex flex-col">
                            <h5 class="mb-4 md:text-4xl text-2xl font-bold tracking-tight text-gray-100 border-b-2">{{ $room }}</h5>
                            <div class="inline-flex items-center">
                                <p class="font-normal text-white text-xl dark:text-gray-400">
                                    {{ $start_time }} - {{ $end_time }}
                                </p>
                                <span class="bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ml-3">{{ $duration }} jam</span>
                            </div>
                            <div class="inline-flex items-center mt-4 gap-2">
                                <i class="fa-solid fa-users-rectangle text-3xl mb-2"></i>
                                <h5 class="mb-2 text-xl font-bold tracking-tight text-white">{{ $capacity }} Orang</h5>
                            </div>
                        </div>
                        <div class="inline-flex w-full justify-between items-center mt-10">
                            <span class="text-2xl font-bold text-white">Rp {{ $total }}</span>
                            <button id="pay-button" type="button" class="text-white mx-auto bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                                Pay now
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- midtrans --}}
<script type="text/javascript">
    // For example trigger on button clicked, or any time you need
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {
        // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
        window.snap.pay('{{ $snapToken }}', {
            onSuccess: function(result){
                /* You may add your own implementation here */
                alert("payment success!"); 

                axios.post('http://adiksi_main.test/' + 'booking_callback', result)
                .then(response => {
                    console.log(response)
                    window.location.href = '/booking-invoice/' + response.data
                })
                .catch(error => {
                    console.log(error)
                })

                console.log(result);
                },
                onPending: function(result){
                /* You may add your own implementation here */
                alert("wating your payment!"); console.log(result);
                },
                onError: function(result){
                /* You may add your own implementation here */
                alert("payment failed!"); console.log(result);
                },
                onClose: function(){
                /* You may add your own implementation here */
                alert('you closed the popup without finishing the payment');
            }
        })
    });
</script>
    
