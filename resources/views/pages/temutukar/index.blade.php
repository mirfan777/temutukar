<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TemuTukar - Aplikasi Berbagi Barang Bekas</title>
    @vite(['resources/css/app.css', 'resources/js/temutukar.js'])
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
    <!-- OpenLayers CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ol@7.5.1/ol.css">
    <script src="https://cdn.jsdelivr.net/npm/ol@7.5.1/dist/ol.js"></script>

    <style>
        #map {
            width: 100%;
            height: 100%;
        }
        .ol-popup {
            position: absolute;
            background-color: white;
            box-shadow: 0 1px 4px rgba(0,0,0,0.2);
            padding: 15px;
            border-radius: 10px;
            border: 1px solid #cccccc;
            bottom: 12px;
            left: -50px;
            min-width: 280px;
        }
        .ol-popup:after, .ol-popup:before {
            top: 100%;
            border: solid transparent;
            content: " ";
            height: 0;
            width: 0;
            position: absolute;
            pointer-events: none;
        }
        .ol-popup:after {
            border-top-color: white;
            border-width: 10px;
            left: 48px;
            margin-left: -10px;
        }
        .ol-popup:before {
            border-top-color: #cccccc;
            border-width: 11px;
            left: 48px;
            margin-left: -11px;
        }
        .ol-popup-closer {
            text-decoration: none;
            position: absolute;
            top: 2px;
            right: 8px;
        }
        .ol-popup-closer:after {
            content: "✖";
        }
        /* Custom marker styles */
        .marker {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.3);
        }
        .marker-user {
            background-color: #E8F5E9;
            border: 2px solid #4CAF50;
        }
        .marker-institution {
            background-color: #FFF8E1;
            border: 2px solid #FFA000;
        }
        .marker-item {
            background-color: #E3F2FD;
            border: 2px solid #1976D2;
        }
    </style>
</head>
<body class="light">
    <main>
        <div class="flex flex-col-reverse md:flex-row overflow-hidden">
            <div class="flex w-full md:w-[820px] h-screen">
                <div class="w-full rounded-2xl overflow-auto px-1">
                    <div class="flex flex-col items-center">
                        <div class="sticky top-0 z-50 w-full bg-white">
                            <label class="input w-full my-2">
                                <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none" stroke="currentColor">
                                        <circle cx="11" cy="11" r="8"></circle>
                                        <path d="m21 21-4.3-4.3"></path>
                                    </g>
                                </svg>
                                <input type="search" id="search-input" placeholder="Search"/>
                            </label>
                        </div>
                        
                        <!--  Institutions) -->
                        <h2 id="institutions-title" class="w-full p-2 text-black font-bold text-2xl">Donasikan Ke Lembaga Sosial</h2>
                        <div id="institutions-container">
                            <!-- Institutions will be loaded here -->
                            <div class="w-full text-center py-4">
                                <span class="loading loading-spinner loading-md"></span>
                            </div>
                        </div>
    
                        <!-- People (User Items) -->
                        <h2 id="items-title" class="w-full p-2 text-black font-bold text-2xl">People</h2>
                        <div id="items-container">
                            <!-- Items will be loaded here -->
                            <div class="w-full text-center py-4">
                                <span class="loading loading-spinner loading-md"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="md:h-screen relative w-full h-96">
                <!-- Filter -->
                <div class="flex items-center absolute z-[999] left-20 top-3">
                    <div class="filter flex flex-wrap gap-1">
                        <input class="btn btn-xs md:btn-sm filter-reset" type="radio" name="filter" value="all" checked aria-label="Tamplikan Semua" />
                        <input class="btn btn-xs md:btn-sm filter-option" type="radio" name="filter" value="items" aria-label="Tukar Dengan Orang lain"/>
                        <input class="btn btn-xs md:btn-sm filter-option" type="radio" name="filter" value="institutions" aria-label="Donasikan Ke Lembaga Sosial"/>
                        
                        <div id="distance-filter-container">
                            <select id="distance-filter" class="select select-xs md:select-sm">
                                <option value="all" selected>Jarak</option>
                                <option value="5">1 km - 5 km</option>
                                <option value="10">6 km - 10 km</option>
                                <option value="15">11 km - 15 km</option>
                            </select>
                        </div>
                        
                        <div id="category-filter-container">
                            <select id="category-filter" class="select select-xs md:select-sm">
                                <option value="all" selected>Semua Kategori</option>
                                <option value="Pakaian Anak">Pakaian Anak</option>
                                <option value="Pakaian Dewasa">Pakaian Dewasa</option>
                                <option value="Pakaian">Pakaian</option>
                                <option value="Sepatu & Sendal">Sepatu & Sendal</option>
                                <option value="Aksesoris">Aksesoris</option>
                                <option value="Kacamata">Kacamata</option>
                                <option value="Topi">Topi</option>
                                <option value="Elektronik">Elektronik</option>
                            </select>
                        </div>
                        
                        <div id="type-filter-container">
                            <select id="type-filter" class="select select-xs md:select-sm">
                                <option value="all" selected>Semua Tipe Lembaga Sosial</option>
                                <option value="Orang Terlantar">Orang Terlantar</option>
                                <option value="Panti Asuhan">Panti Asuhan</option>
                                <option value="Panti Jompo">Panti Jompo</option>
                                <option value="Yayasan Sosial">Yayasan Sosial</option>
                                <option value="Panti Rehabilitasi">Panti Rehabilitasi</option>
                                <option value="Rumah Singgah">Rumah Singgah</option>
                                <option value="Rumah Perlindungan">Rumah Perlindungan</option>
                                <option value="Panti Sosial">Panti Sosial</option>
                            </select>                                                  
                        </div>
                    </div>
                </div>
                <!-- endFilter -->
                <div id="map"></div>
                
                <!-- Popup container -->
                <div id="popup" class="ol-popup hidden">
                    <a href="#" id="popup-closer" class="ol-popup-closer"></a>
                    <div id="popup-content" class="rounded-lg"></div>
                </div>
            </div>
        </div>
    </main>
    <script src="{{ asset('js/temutukar.js') }}"></script>
        
</body>
</html>
                