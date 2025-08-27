@extends('layouts.app')
@section('title', 'Monitoring Device')

@section('content')
<div class="container my-4">
    <div class="text-center mb-3">
        <h2>Status Jaringan Device</h2>
        <p id="summary"><strong>Total Aktif:</strong> 0 | <strong>Tidak Aktif:</strong> 0</p>
    </div>

    <style>
        .mySlides {
            display: none;
            transition: opacity 0.5s ease-in-out;
        }
        .device-card {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 15px;
            margin: 10px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            flex: 1 0 20%; /* Allow 20 devices per row */
        }
        .active {
            background-color: rgb(16, 148, 16);
            color: white;
        }
        .inactive {
            background-color: red;
            color: white;
        }
    </style>

    <div class="slideshow-container" id="slideshow-container"></div>
</div>

<script>
    let slideIndex = 0;
    let slides = [];

    function chunkArray(array, size) {
        const result = [];
        for (let i = 0; i < array.length; i += size) {
            result.push(array.slice(i, i + size));
        }
        return result;
    }

    async function fetchStatus() {
        try {
            const response = await fetch('/device-status');
            const data = await response.json();

            document.getElementById('summary').innerHTML = `
                <strong>Total Aktif:</strong> ${data.totalUp} |
                <strong>Tidak Aktif:</strong> ${data.totalDown}
            `;

            const container = document.getElementById('slideshow-container');
            container.innerHTML = '';

            const chunks = chunkArray(data.devices, 20); // Display 20 devices per slide

            chunks.forEach((group, i) => {
                let html = `<div class="mySlides" style="display: ${i === 0 ? 'block' : 'none'};"><div class="row justify-content-center">`;

                group.forEach(device => {
                    const label = device.status === 'UP' ? '✔ Aktif' : '✘ Tidak Merespon';
                    const colorClass = device.status === 'UP' ? 'active' : 'inactive';

                    html += `
                        <div class="device-card col-md-3 mb-4 ${colorClass}">
                            <h6 class="fw-bold">${device.name}</h6>
                            <p class="mb-0">${device.ip}</p>
                            <p class="fw-bold">${label}</p>
                        </div>
                    `;
                });

                html += `</div></div>`;
                container.innerHTML += html;
            });

            slides = document.getElementsByClassName("mySlides");
        } catch (e) {
            console.error("❌ Gagal fetch data:", e);
        }
    }

    function showSlides() {
        if (slides.length === 0) return;
        for (let i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slideIndex = (slideIndex + 1) % slides.length;
        if (slides[slideIndex]) {
            slides[slideIndex].style.display = "block";
        }
    }

    // Initial fetch and setup
    fetchStatus();
    setInterval(showSlides, 5000);
    setInterval(fetchStatus, 10000); // setiap 10 detik
</script>

@endsection
