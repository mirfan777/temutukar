<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TemuTukar - Platform Tukar & Donasi Pakaian</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        .section-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
            width: 100%;
        }
        
        @media (max-width: 640px) {
            .hero-image {
                max-width: 100% !important;
            }
        }

        .gradient-bg-hero {
            background: linear-gradient(135deg, #6366F1 0%, #8B5CF6 50%, #EC4899 100%);
        }
        
        .gradient-text {
            background: linear-gradient(90deg, #6366F1, #EC4899);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        
        .gradient-border {
            position: relative;
            border: none;
        }
        
        .gradient-border::before {
            content: "";
            position: absolute;
            inset: 0;
            border-radius: 0.5rem;
            padding: 2px;
            background: linear-gradient(45deg, #6366F1, #EC4899);
            -webkit-mask: 
                linear-gradient(#fff 0 0) content-box, 
                linear-gradient(#fff 0 0);
            mask: 
                linear-gradient(#fff 0 0) content-box, 
                linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            pointer-events: none;
        }
        
        .feature-icon-gradient {
            background: linear-gradient(135deg, #6366F1 0%, #EC4899 100%);
        }

        .team-card-hover:hover {
            transform: translateY(-8px);
            transition: transform 0.3s ease;
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
    </style>
</head>
<body class="overflow-x-hidden">
    <!-- Navbar -->
    <div class="navbar bg-base-100 shadow-md fixed top-0 z-50 flex justify-center backdrop-blur-md bg-white/90">
        <div class="section-container flex justify-between">
            <div class="">
                <a class="btn btn-ghost normal-case text-xl">
                    <span class="gradient-text font-bold">TemuTukar</span>
                </a>
            </div>
            <div class="">
                <ul class="menu menu-horizontal px-1 hidden md:flex">
                    <li><a href="#home" class="hover:text-primary font-medium">Beranda</a></li>
                    <li><a href="#data" class="hover:text-primary font-medium">Data</a></li>
                    <li><a href="#features" class="hover:text-primary font-medium">Fitur</a></li>
                    <li><a href="#team" class="hover:text-primary font-medium">Tim</a></li>
                </ul>
                <div class="dropdown dropdown-end md:hidden">
                    <label tabindex="0" class="btn btn-ghost btn-circle">
                        <i class="fas fa-bars"></i>
                    </label>
                    <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52 mt-4">
                        <li><a href="#home">Beranda</a></li>
                        <li><a href="#data">Data</a></li>
                        <li><a href="#features">Fitur</a></li>
                        <li><a href="#team">Tim</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Hero Section -->
    <section id="home" class="max-screen pt-16 w-full gradient-bg-hero text-white">
        <div class="section-container hero-content flex-col lg:flex-row-reverse px-4 py-20 ">
            <img src="images/hero.png" alt="TemuTukar" class="lg:mt-56 mt-0 hero-image max-w-md md:max-w-lg lg:max-w-xl rounded-lg w-full drop-shadow-2xl animate-float"/>
            <div class="w-full lg:w-1/2">
                <h1 class="text-4xl md:text-6xl font-bold mb-2">TemuTukar</h1>
                <p class="py-2 text-xl md:text-3xl font-bold mb-3">Temukan. Tukarkan. Donasikan.</p>
                <p class="py-4 text-lg opacity-90">Platform Sistem Informasi Geografi yang menghubungkan Anda dengan orang-orang terdekat yang ingin bertukar pakaian atau menerima donasi pakaian. Bersama kita perlambat fast fashion, perpanjang umur pakaian, dan kurangi limbah tekstil untuk masa depan yang lebih berkelanjutan.</p>
                <div class="flex flex-wrap gap-4 mt-4">
                    <button class="btn btn-accent text-white shadow-lg shadow-accent/20 font-bold btn-lg">Mulai Sekarang</button>
                    <button class="btn bg-white text-primary hover:bg-white/90 font-bold btn-lg">Pelajari Lebih Lanjut</button>
                </div>
                
            </div>
        </div>
        
        <!-- Wave Separator -->
        <svg id="visual"  class="relative top-0" viewBox="0 50 900 300" class="w-screen"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"><path d="M0 224L25 227.3C50 230.7 100 237.3 150 237.8C200 238.3 250 232.7 300 228C350 223.3 400 219.7 450 216C500 212.3 550 208.7 600 213.5C650 218.3 700 231.7 750 232.2C800 232.7 850 220.3 875 214.2L900 208L900 451L875 451C850 451 800 451 750 451C700 451 650 451 600 451C550 451 500 451 450 451C400 451 350 451 300 451C250 451 200 451 150 451C100 451 50 451 25 451L0 451Z" fill="#ffffff" stroke-linecap="round" stroke-linejoin="miter"></path></svg>
    </section>
    

    <!-- Data Section -->
    <section id="data" class="py-24 bg-white">
        <div class="section-container px-4">
            <div class="text-center mb-12">
                <div class="badge badge-primary mb-4 py-3 px-4 text-white">DATA & STATISTIK</div>
                <h2 class="text-4xl font-bold mb-4">Krisis <span class="gradient-text">Limbah Tekstil</span></h2>
                <p class="text-lg max-w-3xl mx-auto">Industri fashion adalah salah satu kontributor terbesar polusi global. Lihat bagaimana limbah tekstil terus meningkat dan mengapa TemuTukar hadir sebagai solusi.</p>
            </div>
            
            <div class="flex flex-col lg:flex-row gap-8 items-center">
                <div class="w-full lg:w-1/2">
                    <div class="card bg-base-100 shadow-xl h-full gradient-border">
                        <div class="card-body">
                            <h3 class="card-title text-xl">Peningkatan Limbah Tekstil (2015-2025)</h3>
                            <div class="w-full h-64 md:h-80">
                                <canvas id="wasteChart"></canvas>
                            </div>
                            <p class="text-sm text-base-content/70 mt-4">Sumber: Estimasi berdasarkan data dari UN Environment Programme dan Ellen MacArthur Foundation</p>
                        </div>
                    </div>
                </div>
                
                <div class="w-full lg:w-1/2">
                    <div class="card bg-gradient-to-br from-indigo-50 to-pink-50 shadow-xl h-full">
                        <div class="card-body">
                            <h3 class="text-xl font-bold mb-4 gradient-text">Fakta Mengejutkan</h3>
                            <ul class="space-y-6">
                                <li class="flex items-start">
                                    <div class="flex-shrink-0 rounded-full p-3 bg-gradient-to-r from-indigo-500 to-purple-500 text-white shadow-lg mr-4">
                                        <i class="fas fa-water text-xl"></i>
                                    </div>
                                    <div>
                                        <span class="block text-lg font-semibold">Konsumsi Air</span>
                                        <span>Industri fashion menggunakan sekitar <strong>93 miliar meter kubik air</strong> setiap tahun, cukup untuk memenuhi kebutuhan 5 juta orang.</span>
                                    </div>
                                </li>
                                <li class="flex items-start">
                                    <div class="flex-shrink-0 rounded-full p-3 bg-gradient-to-r from-purple-500 to-pink-500 text-white shadow-lg mr-4">
                                        <i class="fas fa-trash text-xl"></i>
                                    </div>
                                    <div>
                                        <span class="block text-lg font-semibold">Pembuangan</span>
                                        <span>Sekitar <strong>85% tekstil bekas</strong> berakhir di tempat pembuangan sampah setiap tahunnya.</span>
                                    </div>
                                </li>
                                <li class="flex items-start">
                                    <div class="flex-shrink-0 rounded-full p-3 bg-gradient-to-r from-pink-500 to-purple-500 text-white shadow-lg mr-4">
                                        <i class="fas fa-recycle text-xl"></i>
                                    </div>
                                    <div>
                                        <span class="block text-lg font-semibold">Daur Ulang</span>
                                        <span>Hanya <strong>kurang dari 1%</strong> material yang digunakan untuk memproduksi pakaian yang didaur ulang menjadi pakaian baru.</span>
                                    </div>
                                </li>
                                <li class="flex items-start">
                                    <div class="flex-shrink-0 rounded-full p-3 bg-gradient-to-r from-indigo-500 to-blue-500 text-white shadow-lg mr-4">
                                        <i class="fas fa-tshirt text-xl"></i>
                                    </div>
                                    <div>
                                        <span class="block text-lg font-semibold">Pembuangan Personal</span>
                                        <span>Rata-rata, setiap orang membuang sekitar <strong>37kg pakaian</strong> setiap tahun.</span>
                                    </div>
                                </li>
                            </ul>
                            <div class="mt-6 bg-gradient-to-r from-indigo-100 to-purple-100 p-4 rounded-lg">
                                <p class="font-semibold">Bersama TemuTukar, kita dapat mengurangi angka-angka ini dengan memperpanjang umur pakaian melalui pertukaran dan donasi.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-24 bg-gradient-to-b from-white to-indigo-50">
        <div class="section-container px-4">
            <div class="text-center mb-16">
                <div class="badge badge-secondary mb-4 py-3 px-4 text-white">FITUR UTAMA</div>
                <h2 class="text-4xl font-bold mb-4">Fitur <span class="gradient-text">TemuTukar</span></h2>
                <p class="text-lg max-w-3xl mx-auto">Solusi geospasial inovatif untuk menghubungkan pakaian dengan pemilik baru dan mengurangi dampak limbah tekstil.</p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="card bg-white shadow-xl hover:shadow-2xl transition-all h-full border border-indigo-100 hover:-translate-y-2 duration-300">
                    <figure class="px-6 pt-6">
                        <div class="rounded-full feature-icon-gradient p-6 text-white shadow-lg shadow-indigo-500/20">
                            <i class="fas fa-search-location text-4xl"></i>
                        </div>
                    </figure>
                    <div class="card-body items-center text-center">
                        <h3 class="card-title text-center text-xl">Pencarian Berdasarkan Radius</h3>
                        <p>Temukan orang-orang di sekitar Anda yang ingin bertukar atau menerima donasi pakaian berdasarkan lokasi terdekat. Menghemat waktu dan biaya pengiriman.</p>
                        <div class="card-actions mt-4">
                            <button class="btn btn-sm btn-ghost btn-circle">
                                <i class="fas fa-arrow-right text-primary"></i>
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Feature 2 -->
                <div class="card bg-white shadow-xl hover:shadow-2xl transition-all h-full border border-indigo-100 hover:-translate-y-2 duration-300">
                    <figure class="px-6 pt-6">
                        <div class="rounded-full feature-icon-gradient p-6 text-white shadow-lg shadow-indigo-500/20">
                            <i class="fas fa-exchange-alt text-4xl"></i>
                        </div>
                    </figure>
                    <div class="card-body items-center text-center">
                        <h3 class="card-title text-center text-xl">Platform Pertukaran</h3>
                        <p>Sajikan pakaian Anda yang tidak terpakai dan temukan pakaian yang Anda inginkan. Bertukar dengan mudah dan cepat untuk perpanjang umur pakaian.</p>
                        <div class="card-actions mt-4">
                            <button class="btn btn-sm btn-ghost btn-circle">
                                <i class="fas fa-arrow-right text-primary"></i>
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Feature 3 -->
                <div class="card bg-white shadow-xl hover:shadow-2xl transition-all h-full border border-indigo-100 hover:-translate-y-2 duration-300">
                    <figure class="px-6 pt-6">
                        <div class="rounded-full feature-icon-gradient p-6 text-white shadow-lg shadow-indigo-500/20">
                            <i class="fas fa-hand-holding-heart text-4xl"></i>
                        </div>
                    </figure>
                    <div class="card-body items-center text-center">
                        <h3 class="card-title text-center text-xl">Donasi Pakaian</h3>
                        <p>Temukan lembaga sosial terdekat yang menerima donasi pakaian atau berikan langsung kepada individu yang membutuhkan melalui platform kami.</p>
                        <div class="card-actions mt-4">
                            <button class="btn btn-sm btn-ghost btn-circle">
                                <i class="fas fa-arrow-right text-primary"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Feature 4 -->
                <div class="card bg-white shadow-xl hover:shadow-2xl transition-all h-full border border-indigo-100 hover:-translate-y-2 duration-300">
                    <figure class="px-6 pt-6">
                        <div class="rounded-full feature-icon-gradient p-6 text-white shadow-lg shadow-indigo-500/20">
                            <i class="fas fa-map-marked-alt text-4xl"></i>
                        </div>
                    </figure>
                    <div class="card-body items-center text-center">
                        <h3 class="card-title text-center text-xl">Peta Interaktif</h3>
                        <p>Visualisasi lokasi pengguna dan lembaga sosial dalam peta interaktif dengan informasi detail untuk mempermudah perencanaan pertukaran atau donasi.</p>
                        <div class="card-actions mt-4">
                            <button class="btn btn-sm btn-ghost btn-circle">
                                <i class="fas fa-arrow-right text-primary"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Feature 5 -->
                <div class="card bg-white shadow-xl hover:shadow-2xl transition-all h-full border border-indigo-100 hover:-translate-y-2 duration-300">
                    <figure class="px-6 pt-6">
                        <div class="rounded-full feature-icon-gradient p-6 text-white shadow-lg shadow-indigo-500/20">
                            <i class="fas fa-building text-4xl"></i>
                        </div>
                    </figure>
                    <div class="card-body items-center text-center">
                        <h3 class="card-title text-center text-xl">Direktori Lembaga Sosial</h3>
                        <p>Database lengkap lembaga sosial yang terverifikasi yang menerima donasi pakaian, lengkap dengan informasi kontak dan kebutuhan spesifik.</p>
                        <div class="card-actions mt-4">
                            <button class="btn btn-sm btn-ghost btn-circle">
                                <i class="fas fa-arrow-right text-primary"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Feature 6 -->
                <div class="card bg-white shadow-xl hover:shadow-2xl transition-all h-full border border-indigo-100 hover:-translate-y-2 duration-300">
                    <figure class="px-6 pt-6">
                        <div class="rounded-full feature-icon-gradient p-6 text-white shadow-lg shadow-indigo-500/20">
                            <i class="fas fa-leaf text-4xl"></i>
                        </div>
                    </figure>
                    <div class="card-body items-center text-center">
                        <h3 class="card-title text-center text-xl">Dampak Lingkungan</h3>
                        <p>Pantau kontribusi Anda terhadap lingkungan melalui metrik yang menunjukkan penghematan air, pengurangan emisi karbon, dan penghematan energi.</p>
                        <div class="card-actions mt-4">
                            <button class="btn btn-sm btn-ghost btn-circle">
                                <i class="fas fa-arrow-right text-primary"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-16 text-center">
                <a href="#" class="btn btn-lg bg-gradient-to-r from-indigo-500 to-purple-500 hover:from-indigo-600 hover:to-purple-600 text-white border-0 shadow-lg shadow-indigo-500/30">Jelajahi Seluruh Fitur</a>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section id="team" class="py-24 bg-gradient-to-b from-indigo-50 to-white">
        <div class="section-container px-4">
            <div class="text-center mb-16">
                <div class="badge badge-accent mb-4 py-3 px-4 text-white">TIM KAMI</div>
                <h2 class="text-4xl font-bold mb-4">Tim Hebat di Balik <span class="gradient-text">TemuTukar</span></h2>
                <p class="text-lg max-w-3xl mx-auto">Kami adalah sekelompok individu yang bersemangat untuk mengatasi masalah limbah tekstil dan mempromosikan ekonomi sirkular melalui teknologi.</p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 justify-center">
                <!-- Team Member 1 -->
                <div class="card bg-white shadow-xl h-full team-card-hover">
                    <figure class="px-6 pt-6 relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/30 to-pink-500/30 rounded-full w-24 h-24 md:w-28 md:h-28 mx-auto top-6 blur-xl"></div>
                        <img src="/api/placeholder/150/150" alt="Maulana Irfan" class="rounded-full w-24 h-24 md:w-28 md:h-28 object-cover border-4 border-gradient-to-r from-indigo-500 to-pink-500 z-10" />
                    </figure>
                    <div class="card-body items-center text-center p-4 md:p-6">
                        <h3 class="card-title text-base md:text-lg">Maulana Irfan</h3>
                        <div class="badge badge-gradient-to-r from-indigo-500 to-pink-500 text-white">Project Lead</div>
                        <div class="flex gap-2 mt-4">
                            <a class="btn btn-circle btn-sm bg-gradient-to-r from-indigo-500 to-pink-500 text-white border-0 hover:opacity-90">
                                <i class="fab fa-linkedin"></i>
                            </a>
                            <a class="btn btn-circle btn-sm bg-gradient-to-r from-indigo-500 to-pink-500 text-white border-0 hover:opacity-90">
                                <i class="fab fa-github"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Team Member 2 -->
                <div class="card bg-white shadow-xl h-full team-card-hover">
                    <figure class="px-6 pt-6 relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/30 to-pink-500/30 rounded-full w-24 h-24 md:w-28 md:h-28 mx-auto top-6 blur-xl"></div>
                        <img src="/api/placeholder/150/150" alt="Zolla Perdana Putra Harahap" class="rounded-full w-24 h-24 md:w-28 md:h-28 object-cover border-4 border-gradient-to-r from-indigo-500 to-pink-500 z-10" />
                    </figure>
                    <div class="card-body items-center text-center p-4 md:p-6">
                        <h3 class="card-title text-base md:text-lg">Zolla Perdana Putra</h3>
                        <div class="badge badge-gradient-to-r from-indigo-500 to-pink-500 text-white">Backend Developer</div>
                        <div class="flex gap-2 mt-4">
                            <a class="btn btn-circle btn-sm bg-gradient-to-r from-indigo-500 to-pink-500 text-white border-0 hover:opacity-90">
                                <i class="fab fa-linkedin"></i>
                            </a>
                            <a class="btn btn-circle btn-sm bg-gradient-to-r from-indigo-500 to-pink-500 text-white border-0 hover:opacity-90">
                                <i class="fab fa-github"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Team Member 3 -->
                <div class="card bg-white shadow-xl h-full team-card-hover">
                    <figure class="px-6 pt-6 relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/30 to-pink-500/30 rounded-full w-24 h-24 md:w-28 md:h-28 mx-auto top-6 blur-xl"></div>
                        <img src="/api/placeholder/150/150" alt="Adrain Fardan Andi" class="rounded-full w-24 h-24 md:w-28 md:h-28 object-cover border-4 border-gradient-to-r from-indigo-500 to-pink-500 z-10" />
                    </figure>
                    <div class="card-body items-center text-center p-4 md:p-6">
                        <h3 class="card-title text-base md:text-lg">Adrain Fardan Andi</h3>
                        <div class="badge badge-gradient-to-r from-indigo-500 to-pink-500 text-white">Frontend Developer</div>
                        <div class="flex gap-2 mt-4">
                            <a class="btn btn-circle btn-sm bg-gradient-to-r from-indigo-500 to-pink-500 text-white border-0 hover:opacity-90">
                                <i class="fab fa-linkedin"></i>
                            </a>
                            <a class="btn btn-circle btn-sm bg-gradient-to-r from-indigo-500 to-pink-500 text-white border-0 hover:opacity-90">
                                <i class="fab fa-github"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Team Member 4 -->
                <div class="card bg-white shadow-xl h-full team-card-hover">
                    <figure class="px-6 pt-6 relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/30 to-pink-500/30 rounded-full w-24 h-24 md:w-28 md:h-28 mx-auto top-6 blur-xl"></div>
                        <img src="/api/placeholder/150/150" alt="Farhan Hakim" class="rounded-full w-24 h-24 md:w-28 md:h-28 object-cover border-4 border-gradient-to-r from-indigo-500 to-pink-500 z-10" />
                    </figure>
                    <div class="card-body items-center text-center p-4 md:p-6">
                        <h3 class="card-title text-base md:text-lg">Farhan Hakim</h3>
                        <div class="badge badge-gradient-to-r from-indigo-500 to-pink-500 text-white">GIS Specialist</div>
                        <div class="flex gap-2 mt-4">
                            <a class="btn btn-circle btn-sm bg-gradient-to-r from-indigo-500 to-pink-500 text-white border-0 hover:opacity-90">
                                <i class="fab fa-linkedin"></i>
                            </a>
                            <a class="btn btn-circle btn-sm bg-gradient-to-r from-indigo-500 to-pink-500 text-white border-0 hover:opacity-90">
                                <i class="fab fa-github"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- More team members -->
                <!-- Team Member 5 -->
                <div class="card bg-white shadow-xl h-full team-card-hover">
                    <figure class="px-6 pt-6 relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/30 to-pink-500/30 rounded-full w-24 h-24 md:w-28 md:h-28 mx-auto top-6 blur-xl"></div>
                        <img src="/api/placeholder/150/150" alt="Dian Rizky" class="rounded-full w-24 h-24 md:w-28 md:h-28 object-cover border-4 border-gradient-to-r from-indigo-500 to-pink-500 z-10" />
                    </figure>
                    <div class="card-body items-center text-center p-4 md:p-6">
                        <h3 class="card-title text-base md:text-lg">Dian Rizky</h3>
                        <div class="badge badge-gradient-to-r from-indigo-500 to-pink-500 text-white">UI/UX Designer</div>
                        <div class="flex gap-2 mt-4">
                            <a class="btn btn-circle btn-sm bg-gradient-to-r from-indigo-500 to-pink-500 text-white border-0 hover:opacity-90">
                                <i class="fab fa-linkedin"></i>
                            </a>
                            <a class="btn btn-circle btn-sm bg-gradient-to-r from-indigo-500 to-pink-500 text-white border-0 hover:opacity-90">
                                <i class="fab fa-github"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Team Member 6 -->
                <div class="card bg-white shadow-xl h-full team-card-hover">
                    <figure class="px-6 pt-6 relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/30 to-pink-500/30 rounded-full w-24 h-24 md:w-28 md:h-28 mx-auto top-6 blur-xl"></div>
                        <img src="/api/placeholder/150/150" alt="Rio Ferdinansya" class="rounded-full w-24 h-24 md:w-28 md:h-28 object-cover border-4 border-gradient-to-r from-indigo-500 to-pink-500 z-10" />
                    </figure>
                    <div class="card-body items-center text-center p-4 md:p-6">
                        <h3 class="card-title text-base md:text-lg">Rio Ferdinansya</h3>
                        <div class="badge badge-gradient-to-r from-indigo-500 to-pink-500 text-white">Data Analyst</div>
                        <div class="flex gap-2 mt-4">
                            <a class="btn btn-circle btn-sm bg-gradient-to-r from-indigo-500 to-pink-500 text-white border-0 hover:opacity-90">
                                <i class="fab fa-linkedin"></i>
                            </a>
                            <a class="btn btn-circle btn-sm bg-gradient-to-r from-indigo-500 to-pink-500 text-white border-0 hover:opacity-90">
                                <i class="fab fa-github"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Team Member 7 -->
                <div class="card bg-white shadow-xl h-full team-card-hover">
                    <figure class="px-6 pt-6 relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/30 to-pink-500/30 rounded-full w-24 h-24 md:w-28 md:h-28 mx-auto top-6 blur-xl"></div>
                        <img src="/api/placeholder/150/150" alt="Fahri Radiansyah" class="rounded-full w-24 h-24 md:w-28 md:h-28 object-cover border-4 border-gradient-to-r from-indigo-500 to-pink-500 z-10" />
                    </figure>
                    <div class="card-body items-center text-center p-4 md:p-6">
                        <h3 class="card-title text-base md:text-lg">Fahri Radiansyah</h3>
                        <div class="badge badge-gradient-to-r from-indigo-500 to-pink-500 text-white">Marketing Specialist</div>
                        <div class="flex gap-2 mt-4">
                            <a class="btn btn-circle btn-sm bg-gradient-to-r from-indigo-500 to-pink-500 text-white border-0 hover:opacity-90">
                                <i class="fab fa-linkedin"></i>
                            </a>
                            <a class="btn btn-circle btn-sm bg-gradient-to-r from-indigo-500 to-pink-500 text-white border-0 hover:opacity-90">
                                <i class="fab fa-github"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-24 relative">
        <div class="absolute inset-0 bg-gradient-to-r from-indigo-600 to-purple-600"></div>
        <div class="absolute inset-0 bg-[url('/api/placeholder/1400/500')] opacity-20 mix-blend-overlay"></div>
        <div class="section-container px-4 text-center relative z-10">
            <div class="max-w-3xl mx-auto glass-card rounded-2xl p-8 md:p-12 shadow-2xl">
                <h2 class="text-3xl md:text-4xl font-bold mb-6 text-white">Bergabunglah dengan Gerakan Keberlanjutan Tekstil</h2>
                <p class="text-lg max-w-2xl mx-auto mb-8 text-white/90">Setiap pertukaran dan donasi adalah langkah kecil menuju pengurangan limbah tekstil dan masa depan yang lebih berkelanjutan. Bergabunglah dengan TemuTukar sekarang dan jadilah bagian dari solusi.</p>
                <div class="flex flex-wrap justify-center gap-4">
                    <button class="btn btn-lg bg-white text-primary hover:bg-white/90 font-bold shadow-lg">Mulai Sekarang</button>
                    <button class="btn btn-lg btn-outline text-white border-white hover:bg-white/20">Hubungi Kami</button>
                </div>
                
                <div class="flex justify-center mt-12 space-x-6">
                    <a class="btn btn-circle btn-lg bg-white/20 hover:bg-white/30 border-0 text-white">
                        <i class="fab fa-facebook-f text-xl"></i>
                    </a>
                    <a class="btn btn-circle btn-lg bg-white/20 hover:bg-white/30 border-0 text-white">
                        <i class="fab fa-instagram text-xl"></i>
                    </a>
                    <a class="btn btn-circle btn-lg bg-white/20 hover:bg-white/30 border-0 text-white">
                        <i class="fab fa-twitter text-xl"></i>
                    </a>
                    <a class="btn btn-circle btn-lg bg-white/20 hover:bg-white/30 border-0 text-white">
                        <i class="fab fa-youtube text-xl"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-neutral text-neutral-content">
        <div class="section-container px-4 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">TemuTukar</h3>
                    <p class="mb-4">Platform inovatif untuk pertukaran dan donasi pakaian berbasis geospasial yang mendukung ekonomi sirkular dan keberlanjutan lingkungan.</p>
                    <div class="flex space-x-4">
                        <a class="btn btn-circle btn-sm btn-outline">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="btn btn-circle btn-sm btn-outline">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a class="btn btn-circle btn-sm btn-outline">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="btn btn-circle btn-sm btn-outline">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h3 class="footer-title">Tautan Cepat</h3>
                    <ul class="space-y-2">
                        <li><a class="link link-hover">Beranda</a></li>
                        <li><a class="link link-hover">Tentang Kami</a></li>
                        <li><a class="link link-hover">Fitur</a></li>
                        <li><a class="link link-hover">Cara Kerja</a></li>
                        <li><a class="link link-hover">Kontak</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="footer-title">Layanan</h3>
                    <ul class="space-y-2">
                        <li><a class="link link-hover">Tukar Pakaian</a></li>
                        <li><a class="link link-hover">Donasi Pakaian</a></li>
                        <li><a class="link link-hover">Temukan Lembaga Sosial</a></li>
                        <li><a class="link link-hover">Kalkulator Dampak</a></li>
                        <li><a class="link link-hover">Blog</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="footer-title">Hubungi Kami</h3>
                    <ul class="space-y-2">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 mr-2"></i>
                            <span>Jl. Teknologi No. 12, Jakarta Selatan, Indonesia</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone mr-2"></i>
                            <span>+62 21 123456</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-2"></i>
                            <span>info@temutukar.id</span>
                        </li>
                    </ul>
                    <div class="form-control mt-4">
                        <div class="join">
                            <input type="text" placeholder="Email Anda" class="input input-bordered join-item" />
                            <button class="btn btn-primary join-item">Langganan</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="divider my-8"></div>
            
            <div class="flex flex-col md:flex-row justify-between items-center">
                <p>© 2025 TemuTukar. Hak Cipta Dilindungi.</p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a class="link link-hover">Kebijakan Privasi</a>
                    <a class="link link-hover">Syarat & Ketentuan</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Chart.js initialization
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('wasteChart').getContext('2d');
            const wasteChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['2015', '2016', '2017', '2018', '2019', '2020', '2021', '2022', '2023', '2024', '2025'],
                    datasets: [{
                        label: 'Limbah Tekstil (Juta Ton)',
                        data: [92, 97, 103, 110, 118, 125, 134, 142, 151, 160, 170],
                        backgroundColor: 'rgba(99, 102, 241, 0.3)',
                        borderColor: 'rgba(99, 102, 241, 1)',
                        borderWidth: 3,
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: 'rgba(236, 72, 153, 1)',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 6,
                        pointHoverRadius: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: false,
                            title: {
                                display: true,
                                text: 'Juta Ton',
                                font: {
                                    weight: 'bold'
                                }
                            },
                            grid: {
                                color: 'rgba(107, 114, 128, 0.1)'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Tahun',
                                font: {
                                    weight: 'bold'
                                }
                            },
                            grid: {
                                display: false
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleFont: {
                                size: 14,
                                weight: 'bold'
                            },
                            bodyFont: {
                                size: 14
                            },
                            padding: 12,
                            callbacks: {
                                label: function(context) {
                                    return `${context.dataset.label}: ${context.raw} juta ton`;
                                }
                            }
                        },
                        legend: {
                            display: true,
                            position: 'top',
                            labels: {
                                font: {
                                    weight: 'bold'
                                },
                                padding: 16
                            }
                        }
                    }
                }
            });
            
            // Handle responsiveness
            function handleResize() {
                const width = window.innerWidth;
                if (width < 768) {
                    wasteChart.options.scales.x.ticks = {
                        maxRotation: 45,
                        minRotation: 45
                    };
                } else {
                    wasteChart.options.scales.x.ticks = {
                        maxRotation: 0,
                        minRotation: 0
                    };
                }
                wasteChart.update();
            }
            
            window.addEventListener('resize', handleResize);
            handleResize(); // Initialize on load
        });
        
        // Animation script
        $(document).ready(function() {
            // Smooth scroll
            $('a[href^="#"]').on('click', function(e) {
                e.preventDefault();
                
                $('html, body').animate({
                    scrollTop: $($(this).attr('href')).offset().top - 70
                }, 800);
            });
            
            // Scroll animations
            const animateOnScroll = function() {
                const elements = document.querySelectorAll('.card, .hero-content > *, section > div > h2, section > div > p, .grid');
                
                elements.forEach(element => {
                    const elementPosition = element.getBoundingClientRect().top;
                    const windowHeight = window.innerHeight;
                    
                    if (elementPosition < windowHeight * 0.85) {
                        element.classList.add('opacity-100', 'translate-y-0');
                        element.classList.remove('opacity-0', 'translate-y-8');
                    }
                });
            };
            
            // Initial setup for animations
            document.querySelectorAll('.card, .hero-content > *, section > div > h2, section > div > p, .grid').forEach(el => {
                el.classList.add('transition-all', 'duration-700', 'opacity-0', 'translate-y-8');
            });
            
            // Run on scroll and on page load
            window.addEventListener('scroll', animateOnScroll);
            window.addEventListener('load', animateOnScroll);
            
            // Trigger initial animation
            setTimeout(animateOnScroll, 300);
        });
    </script>
</body>
</html>