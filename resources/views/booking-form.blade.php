<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hotel Share Booking</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

<div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-xl">

    <h2 class="text-2xl font-bold mb-6 text-center">Hotel Share Booking</h2>

    <form id="bookingForm" class="space-y-4">

        <!-- Name -->
        <div>
            <label class="block text-sm font-medium">Full Name</label>
            <input type="text" id="name" name="name"
                   class="w-full border rounded p-2 mt-1"
                   placeholder="Enter your name">
        </div>

        <!-- Address -->
        <div>
            <label class="block text-sm font-medium">Your Address</label>
            <input type="text" id="address" name="address"
                   class="w-full border rounded p-2 mt-1"
                   placeholder="Enter your address">
        </div>

        <!-- Phone -->
        <div>
            <label class="block text-sm font-medium">Phone Number</label>
            <input type="text" id="phone" name="phone"
                   class="w-full border rounded p-2 mt-1"
                   placeholder="Enter phone number">
        </div>

        <!-- Email -->
        <div>
            <label class="block text-sm font-medium">Email (Optional)</label>
            <input type="email" id="email"
                   class="w-full border rounded p-2 mt-1"
                   placeholder="Enter your email">
        </div>

        <div>
            <div class="block text-sm font-medium">Unit Price of Share (BDT):</div> <span id="unitprice">{{number_format(300000)}}</span>
        </div>

        <div>
            <label class="block text-sm font-medium">How many share do you want to buy?</label>
            <input type="number" id="count"
                   class="w-full border rounded p-2 mt-1"
                   min="1" value="1">
        </div>

        <div>
            <div class="block text-sm font-medium">Total Price in (BDT):</div> <span id="totalprice">{{number_format(300000)}}</span>
        </div>


        <!-- One Time Payment -->
        <div id="oneTimeSection">
            <label class="block text-sm font-medium">Full Payment Amount</label>
            <input type="number"
                   id="fullAmount"
                   class="w-full border rounded p-2 mt-1"
                   placeholder="Enter full amount">
        </div>

        <!-- Installment Payment -->
        <div id="installmentSection" class="hidden space-y-3">

            <div>
                <label class="block text-sm font-medium">Down Payment</label>
                <input type="number"
                       id="downPayment"
                       class="w-full border rounded p-2 mt-1"
                       placeholder="Enter down payment">
            </div>

            <div>
                <label class="block text-sm font-medium">Number of Installments</label>
                <input type="number"
                       id="installments"
                       class="w-full border rounded p-2 mt-1"
                       placeholder="Enter number of installments">
            </div>

        </div>

        <!-- Submit -->
        <button id="sslczPayBtn"
            type="submit"
            token="if you have any token validation"
            postdata=""
            order=" "
            endpoint="{{ url('/pay-via-ajax') }}"
            class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">
            Submit Booking
        </button>

        <p id="error" class="text-red-500 text-sm hidden"></p>

    </form>






    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
    <script>
        document.getElementById('sslczPayBtn').addEventListener('click', function () {
            var obj = {};
            obj.cus_name  = document.getElementById('name').value;
            obj.cus_phone = document.getElementById('phone').value;
            obj.cus_email = document.getElementById('email').value;
            obj.cus_amount = parseInt(document.getElementById('totalprice').textContent.replace(/,/g, ''));
            obj.cus_addr1 = document.getElementById('address').value;

            $('#sslczPayBtn').prop('postdata', obj);
        });

        (function (window, document) {
            var loader = function () {
                var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
                // script.src = "https://seamless-epay.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR LIVE
                script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR SANDBOX
                tag.parentNode.insertBefore(script, tag);
            };

            window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
        })(window, document);
    </script>

</div>


<script>

    document.getElementById('count').addEventListener('input', function () {
        const count = parseInt(this.value) || 0;
        const unitPrice = parseInt(document.getElementById('unitprice').textContent.replace(/,/g, '')) || 0;
        const total = count * unitPrice;
        document.getElementById('totalprice').textContent = total.toLocaleString('en-US');
    });

const oneTimeTab = document.getElementById('oneTimeTab')
const installmentTab = document.getElementById('installmentTab')

const oneTimeSection = document.getElementById('oneTimeSection')
const installmentSection = document.getElementById('installmentSection')

let paymentType = "one-time"


// TAB SWITCH
oneTimeTab.addEventListener('click', () => {

    paymentType = "one-time"

    oneTimeSection.classList.remove("hidden")
    installmentSection.classList.add("hidden")

    oneTimeTab.classList.add("bg-blue-600","text-white")
    installmentTab.classList.remove("bg-blue-600","text-white")
    installmentTab.classList.add("bg-gray-200")
})

installmentTab.addEventListener('click', () => {

    paymentType = "installment"

    installmentSection.classList.remove("hidden")
    oneTimeSection.classList.add("hidden")

    installmentTab.classList.add("bg-blue-600","text-white")
    oneTimeTab.classList.remove("bg-blue-600","text-white")
    oneTimeTab.classList.add("bg-gray-200")
})


// FORM VALIDATION
document.getElementById('bookingForm').addEventListener('submit', function(e){

    e.preventDefault()

    const name = document.getElementById('name').value.trim()
    const email = document.getElementById('email').value.trim()
    const phone = document.getElementById('phone').value.trim()
    const hotel = document.getElementById('hotel').value

    const error = document.getElementById('error')

    if(!name || !email || !phone || !hotel){
        error.innerText = "Please fill all required fields"
        error.classList.remove("hidden")
        return
    }

    if(paymentType === "one-time"){
        const amount = document.getElementById('fullAmount').value
        if(!amount){
            error.innerText = "Please enter full payment amount"
            error.classList.remove("hidden")
            return
        }
    }

    if(paymentType === "installment"){
        const down = document.getElementById('downPayment').value
        const installments = document.getElementById('installments').value

        if(!down || !installments){
            error.innerText = "Please complete installment details"
            error.classList.remove("hidden")
            return
        }
    }

    error.classList.add("hidden")

    alert("Form submitted successfully!")

})

</script>

</body>
</html>