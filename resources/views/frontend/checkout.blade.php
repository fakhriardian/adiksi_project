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
                <form method="post" action="{{ route('back.destroy', $get->created_at) }}">
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
    
        <div class="relative w-full mx-auto flex flex-col p-6 backdrop-blur-2xl drop-shadow-2xl rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 text-white">
            <div class="absolute left-0 top-0 w-full h-full bg-center bg-cover -z-20 rounded-2xl block lg:hidden"
                style="background-image: url(asset/gradient-background.png)">
            </div>
            <div class="relative w-full backdrop-blur-2xl p-5">
                <div class="flex justify-between items-center mb-2">
                    <div id="poppins" class="flex text-xl font-bold">
                        Rincian pembelian
                    </div>
                    <div id="poppins" class="flex text-xl font-bold">
                        No meja : {{ $number }}
                    </div>
                </div>
                <hr class="mb-5">
                <div class="flex h-[40vh] flex-row overflow-x-auto overflow-y-auto w-full gap-5">
                    <div class="flex flex-col w-full">
                        <div id="poppins" class="text-lg mb-2">
                            Item
                        </div>
                        @foreach ($name as $item)
                            <div class="h-20 md:h-fit flex items-center">
                                <p class="mb-3 font-normal">{{ $item }}</p>
                            </div>
                        @endforeach
                    </div>
                    <div class="flex flex-col w-full">
                        <div id="poppins" class="text-lg mb-2">
                            Option
                        </div>
                        @foreach ($option as $item)
                            <div class="h-20 md:h-fit flex items-center">
                                <p class="mb-3 font-normal ">{{ $item }}</p>
                            </div>
                        @endforeach
                    </div>
                    <div class="flex flex-col w-fit items-center">
                        <div id="poppins" class="text-lg text-center mb-2">
                            Qty
                        </div>
                        @foreach ($qty as $item)
                            <div class="h-20 md:h-fit flex items-center">
                                <p class="mb-3 font-normal ">{{ $item }}</p>
                            </div>
                        @endforeach
                    </div>
                    <div class="flex flex-col w-full items-end">
                        <div id="poppins" class="text-lg mb-2">
                            Price
                        </div>
                        @foreach ($price as $item)
                            <div class="h-20 md:h-fit flex items-center">
                                <p class="mb-3 font-normal ">Rp {{ $item }}</p>
                            </div>
                        @endforeach
                    </div>
        
                </div>
                <hr class="mb-4">
                <div class="flex justify-between mb-4">
                    <div id="poppins" class="text-xl">
                        Total
                    </div>
                    <div id="poppins" class="text-xl">
                        Rp {{ $total }}
                    </div>
                </div>
                <div class="flex justify-between">
                    <div>
                        <button id="pay-button" type="button" class="text-white mx-auto bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                            Pay with E-Money
                        </button>
                    </div>
                    <div>

                        <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="text-white block mx-auto bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700" type="button">
                            Pay at casheer
                        </button>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="popup-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
        <div class="relative w-full h-full max-w-md md:h-auto">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="popup-modal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-6 text-center">
                    <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Lanjutkan pembayaran melalui kasir?</h3>
                    <form method="POST" action="{{ route('confirm', $order_id) }}">
                        @csrf
                        <button type="submit" class="text-white mx-auto bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                            Pay at casheer
                        </button>
                    </form>
                    <button data-modal-hide="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
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

                axios.post('http://adiksi_main.test/' + 'midtrans_callback', result)
                .then(response => {
                    console.log(response)
                    window.location.href = '/invoice/' + response.data
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
    
