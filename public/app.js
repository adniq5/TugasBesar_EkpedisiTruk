document.addEventListener('DOMContentLoaded', function() {
    // Mengambil data customer dan order dari backend
    fetchCustomers();
    fetchOrders();

    // Menangani pengiriman form
    document.getElementById('dataForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Mencegah pengiriman form secara default

        // Mengumpulkan data dari form
        const customer_id = document.getElementById('customer_id').value;
        const order_id = document.getElementById('order_id').value;
        const quantity = document.getElementById('quantity').value;
        const price = document.getElementById('price').value;
        const is_paid = document.getElementById('is_paid').checked;
        const proof = document.getElementById('proof').files[0];

        // Menghitung total biaya
        const total_amount = quantity * price; // Ganti dengan logika harga yang sesuai
        document.getElementById('total_amount').value = total_amount;

        // Membuat objek data booking
        const bookingData = {
            customer_id: customer_id,
            order_id: order_id,
            quantity: quantity,
            price: price,
            total_amount: total_amount,
            is_paid: is_paid,
            proof: proof
        };

        // Mengirim data ke backend (ganti '/api/booking' dengan endpoint yang sesuai)
        fetch('/api/booking', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(bookingData),
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Response tidak ok');
            }
            return response.json();
        })
        .then(data => {
            document.getElementById('message').innerText = 'Booking berhasil dikirim!';
            // Reset form
            document.getElementById('dataForm').reset();
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('message').innerText = 'Terjadi kesalahan saat mengirim data.';
        });
    });
});

// Fungsi untuk mengambil data customer
function fetchCustomers() {
    fetch('/api/customers') // Ganti dengan endpoint yang sesuai
        .then(response => response.json())
        .then(data => {
            const customerSelect = document.getElementById('customer_id');
            data.forEach(customer => {
                const option = document.createElement('option');
                option.value = customer.id;
                option.textContent = customer.name;
                customerSelect.appendChild(option);
            });
        })
        .catch(error => console.error('Error fetching customers:', error));
}

// Fungsi untuk mengambil data order
function fetchOrders() {
    fetch('/api/orders') // Ganti dengan endpoint yang sesuai
        .then(response => response.json())
        .then(data => {
            const orderSelect = document.getElementById('order_id');
            data.forEach(order => {
                const option = document.createElement('option');
                option.value = order.id;
                option.textContent = order.id; // Ganti dengan nama yang sesuai
                orderSelect.appendChild(option);
            });
        })
        .catch(error => console.error('Error fetching orders:', error));
}
