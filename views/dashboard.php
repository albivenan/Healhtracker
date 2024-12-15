<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - HealthTracker</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #f6f9fc 0%, #eef2f7 100%);
        }
        .card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .form-input {
            transition: all 0.3s ease;
        }
        .form-input:focus {
            transform: translateY(-2px);
        }
        .stat-card {
            border-radius: 1rem;
            overflow: hidden;
            position: relative;
        }
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, rgba(59, 130, 246, 0.1), rgba(147, 51, 234, 0.1));
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .stat-card:hover::before {
            opacity: 1;
        }
    </style>
</head>
<body class="gradient-bg min-h-screen">
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="/albi/dashboard" class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 text-transparent bg-clip-text">HealthTracker</a>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <button class="flex items-center space-x-2 text-gray-700 hover:text-blue-500 focus:outline-none">
                            <img class="h-8 w-8 rounded-full object-cover" src="https://ui-avatars.com/api/?name=<?php echo urlencode($_SESSION['user']); ?>&background=random" alt="Profile">
                            <span><?php echo htmlspecialchars($_SESSION['user']); ?></span>
                        </button>
                    </div>
                    <a href="/albi/logout" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition duration-150">Keluar</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 py-8">
        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="stat-card bg-white p-6 rounded-xl shadow-lg" data-aos="fade-up" data-aos-delay="100">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 mr-4">
                        <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Berat Badan</p>
                        <p class="text-2xl font-bold text-gray-800" data-stat="weight">-- kg</p>
                    </div>
                </div>
            </div>

            <div class="stat-card bg-white p-6 rounded-xl shadow-lg" data-aos="fade-up" data-aos-delay="200">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-100 mr-4">
                        <svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Tekanan Darah</p>
                        <p class="text-2xl font-bold text-gray-800" data-stat="blood-pressure">--/--</p>
                    </div>
                </div>
            </div>

            <div class="stat-card bg-white p-6 rounded-xl shadow-lg" data-aos="fade-up" data-aos-delay="300">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 mr-4">
                        <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Kalori Terbakar</p>
                        <p class="text-2xl font-bold text-gray-800" data-stat="calories">-- kcal</p>
                    </div>
                </div>
            </div>

            <div class="stat-card bg-white p-6 rounded-xl shadow-lg" data-aos="fade-up" data-aos-delay="400">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100 mr-4">
                        <svg class="h-6 w-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Langkah Hari Ini</p>
                        <p class="text-2xl font-bold text-gray-800" data-stat="steps">--</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <div class="card bg-white p-6 rounded-xl shadow-lg" data-aos="fade-up">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Berat Badan</h2>
                <canvas id="weightChart" class="w-full"></canvas>
            </div>

            <div class="card bg-white p-6 rounded-xl shadow-lg" data-aos="fade-up">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Tekanan Darah</h2>
                <canvas id="bloodPressureChart" class="w-full"></canvas>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Form Input Data Kesehatan -->
            <div class="card bg-white p-6 rounded-xl shadow-lg" data-aos="fade-up">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Input Data Kesehatan</h2>
                <form action="/albi/health-data" method="POST" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2" for="weight">
                            Berat Badan (kg)
                        </label>
                        <input class="form-input w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               type="number" step="0.1" name="weight" id="weight" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2" for="systolic">
                            Tekanan Darah Sistolik
                        </label>
                        <input class="form-input w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               type="number" name="systolic" id="systolic" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2" for="diastolic">
                            Tekanan Darah Diastolik
                        </label>
                        <input class="form-input w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               type="number" name="diastolic" id="diastolic" required>
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-blue-500 to-purple-600 text-white py-2 px-4 rounded-lg hover:from-blue-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transform hover:scale-105 transition duration-150">
                        Simpan Data
                    </button>
                </form>
            </div>

            <!-- Rekomendasi Menu -->
            <div class="card bg-white p-6 rounded-xl shadow-lg" data-aos="fade-up">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Rekomendasi Menu Hari Ini</h2>
                <div class="space-y-6">
                    <div class="p-4 bg-blue-50 rounded-lg">
                        <h3 class="font-bold text-blue-800 mb-2">Sarapan</h3>
                        <p class="text-blue-600">Oatmeal dengan buah-buahan</p>
                        <p class="text-sm text-blue-500 mt-1">350 kalori</p>
                    </div>
                    <div class="p-4 bg-purple-50 rounded-lg">
                        <h3 class="font-bold text-purple-800 mb-2">Makan Siang</h3>
                        <p class="text-purple-600">Nasi merah dengan ikan panggang</p>
                        <p class="text-sm text-purple-500 mt-1">450 kalori</p>
                    </div>
                    <div class="p-4 bg-green-50 rounded-lg">
                        <h3 class="font-bold text-green-800 mb-2">Makan Malam</h3>
                        <p class="text-green-600">Sup sayuran dengan tahu</p>
                        <p class="text-sm text-green-500 mt-1">300 kalori</p>
                    </div>
                </div>
            </div>

            <!-- Aktivitas Fisik -->
            <div class="card bg-white p-6 rounded-xl shadow-lg" data-aos="fade-up">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Aktivitas Fisik</h2>
                
                <!-- Alert untuk feedback -->
                <div id="activityAlert" class="hidden mb-4">
                    <div class="p-4 rounded-lg"></div>
                </div>

                <form id="activityForm" action="/albi/activity" method="POST" class="space-y-4" onsubmit="submitActivityForm(event)">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2" for="steps">
                            Jumlah Langkah
                        </label>
                        <input class="form-input w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               type="number" name="steps" id="steps" min="0" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2" for="exercise_duration">
                            Durasi Olahraga (menit)
                        </label>
                        <input class="form-input w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               type="number" name="exercise_duration" id="exercise_duration" min="0" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2" for="exercise_type">
                            Jenis Olahraga
                        </label>
                        <select class="form-input w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                name="exercise_type" id="exercise_type" required>
                            <option value="">Pilih jenis olahraga</option>
                            <option value="walking">Jalan</option>
                            <option value="running">Lari</option>
                            <option value="cycling">Bersepeda</option>
                            <option value="swimming">Berenang</option>
                            <option value="other">Lainnya</option>
                        </select>
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-blue-500 to-purple-600 text-white py-2 px-4 rounded-lg hover:from-blue-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transform hover:scale-105 transition duration-150">
                        Catat Aktivitas
                    </button>
                </form>
            </div>
        </div>
    </main>

    <script>
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });

        // Fetch dan update data
        async function fetchAndUpdateData() {
            try {
                // Fetch health data
                const healthResponse = await fetch('/albi/health-data/weekly');
                const healthData = await healthResponse.json();
                
                // Fetch activity data
                const activityResponse = await fetch('/albi/activity/daily');
                const activityData = await activityResponse.json();
                
                // Update stats
                updateStats(healthData, activityData);
                
                // Update charts
                updateCharts(healthData);
            } catch (error) {
                console.error('Error fetching data:', error);
            }
        }

        // Update stats
        function updateStats(healthData, activityData) {
            // Update weight (mengambil data terbaru)
            const latestWeight = healthData.weight[healthData.weight.length - 1] || '--';
            document.querySelector('[data-stat="weight"]').textContent = latestWeight + ' kg';

            // Update blood pressure (mengambil data terbaru)
            const latestSystolic = healthData.systolic[healthData.systolic.length - 1] || '--';
            const latestDiastolic = healthData.diastolic[healthData.diastolic.length - 1] || '--';
            document.querySelector('[data-stat="blood-pressure"]').textContent = `${latestSystolic}/${latestDiastolic}`;

            // Update activity stats
            document.querySelector('[data-stat="steps"]').textContent = (activityData.total_steps || 0).toLocaleString();
            document.querySelector('[data-stat="calories"]').textContent = (activityData.total_calories || 0).toLocaleString() + ' kcal';
        }

        // Update charts
        function updateCharts(data) {
            // Destroy existing charts if they exist
            const existingWeightChart = Chart.getChart('weightChart');
            const existingBPChart = Chart.getChart('bloodPressureChart');
            
            if (existingWeightChart) {
                existingWeightChart.destroy();
            }
            if (existingBPChart) {
                existingBPChart.destroy();
            }

            // Weight chart
            new Chart(document.getElementById('weightChart').getContext('2d'), {
                type: 'line',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Berat Badan (kg)',
                        data: data.weight,
                        borderColor: 'rgb(59, 130, 246)',
                        tension: 0.1,
                        fill: false
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: false
                        }
                    }
                }
            });

            // Blood pressure chart
            new Chart(document.getElementById('bloodPressureChart').getContext('2d'), {
                type: 'line',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Sistolik',
                        data: data.systolic,
                        borderColor: 'rgb(139, 92, 246)',
                        tension: 0.1,
                        fill: false
                    },
                    {
                        label: 'Diastolik',
                        data: data.diastolic,
                        borderColor: 'rgb(236, 72, 153)',
                        tension: 0.1,
                        fill: false
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: false
                        }
                    }
                }
            });
        }

        // Initial fetch
        fetchAndUpdateData();

        // Refresh data every 5 minutes
        setInterval(fetchAndUpdateData, 5 * 60 * 1000);

        async function submitActivityForm(event) {
            event.preventDefault();
            const form = event.target;
            const alertDiv = document.getElementById('activityAlert');
            const alertContent = alertDiv.querySelector('div');

            try {
                const formData = new FormData(form);
                const response = await fetch(form.action, {
                    method: 'POST',
                    body: formData
                });

                const result = await response.json();

                if (response.ok) {
                    // Sukses
                    alertContent.className = 'p-4 rounded-lg bg-green-100 text-green-700 border border-green-400';
                    alertContent.textContent = 'Aktivitas berhasil dicatat!';
                    form.reset();
                    // Refresh data
                    fetchAndUpdateData();
                } else {
                    // Error
                    alertContent.className = 'p-4 rounded-lg bg-red-100 text-red-700 border border-red-400';
                    alertContent.textContent = result.error || 'Gagal mencatat aktivitas';
                }
            } catch (error) {
                alertContent.className = 'p-4 rounded-lg bg-red-100 text-red-700 border border-red-400';
                alertContent.textContent = 'Terjadi kesalahan saat mencatat aktivitas';
            }

            // Tampilkan alert
            alertDiv.classList.remove('hidden');
            
            // Sembunyikan alert setelah 5 detik
            setTimeout(() => {
                alertDiv.classList.add('hidden');
            }, 5000);
        }
    </script>
</body>
</html> 