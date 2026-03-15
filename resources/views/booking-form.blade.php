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
            <input type="text" id="name"
                   class="w-full border rounded p-2 mt-1"
                   placeholder="Enter your name">
        </div>

        <!-- Email -->
        <div>
            <label class="block text-sm font-medium">Email</label>
            <input type="email" id="email"
                   class="w-full border rounded p-2 mt-1"
                   placeholder="Enter your email">
        </div>

        <!-- Phone -->
        <div>
            <label class="block text-sm font-medium">Phone</label>
            <input type="text" id="phone"
                   class="w-full border rounded p-2 mt-1"
                   placeholder="Enter phone number">
        </div>

        <!-- Hotel -->
        <div>
            <label class="block text-sm font-medium">Hotel</label>
            <select id="hotel" class="w-full border rounded p-2 mt-1">
                <option value="">Select Hotel</option>
                <option>Sea Pearl</option>
                <option>Royal Tulip</option>
                <option>Radisson Blu</option>
            </select>
        </div>

        <!-- Payment Tabs -->
        <div>
            <label class="block text-sm font-medium mb-2">Payment Method</label>

            <div class="flex border rounded overflow-hidden">
                <button type="button"
                        id="oneTimeTab"
                        class="flex-1 py-2 bg-blue-600 text-white">
                        One Time
                </button>

                <button type="button"
                        id="installmentTab"
                        class="flex-1 py-2 bg-gray-200">
                        Installments
                </button>
            </div>
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
        <button
            type="submit"
            class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">
            Submit Booking
        </button>

        <p id="error" class="text-red-500 text-sm hidden"></p>

    </form>

</div>


<script>

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