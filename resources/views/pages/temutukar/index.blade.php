<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/ol@v10.5.0/dist/ol.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ol@v10.5.0/ol.css">

    <style>
        .tooltip {
            position: relative;
            display: inline-block;
        }
        .tooltip .tooltip-content {
            visibility: hidden;
            position: absolute;
            z-index: 1;
            bottom: 125%;
            left: 50%;
            transform: translateX(-50%);
            background-color: #333;
            color: white;
            padding: 5px;
            border-radius: 4px;
            opacity: 0;
            transition: opacity 0.3s;
        }
        .tooltip:hover .tooltip-content {
            visibility: visible;
            opacity: 1;
        }
        .map {
            width: 100%;
            height: 100%;
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
                                <input type="search" required placeholder="Search"/>
                            </label>
                        </div>
                        
                        <!-- Tukar Poin (Institutions) -->
                        <h2 class="w-full p-2 text-black font-bold text-2xl">Tukar Poin</h2>
                        @foreach($institutions as $institution)
                        <div class="card card-border bg-base-100 rounded-none border-gray-200 w-full hover:bg-base-300">
                            <div class="card-body p-0">
                                <div class="flex gap-2">
                                    <div class="p-2 w-40 h-40">
                                        <img class="w-36 h-36 object-center m-2 rounded-xl"
                                        src="{{ asset('images/institutions/' . $institution->id . '.jpg') }} "
                                        alt="img" />
                                    </div>
                                    <div class="flex flex-col gap-1">
                                        <div class="flex gap-2 items-center mt-2">
                                            <div class="flex flex-col">
                                                <h2 class="font-bold">{{ $institution->name }}</h2>
                                                <p class="text-xs">{{ $institution->distance }} km</p>
                                            </div>
                                        </div>
                                        <div>
                                            <p>{{ $institution->street }}, {{ $institution->district }}, {{ $institution->city }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
    
                        <!-- People (User Items) -->
                        <h2 class="w-full p-2 text-black font-bold text-2xl">People</h2>
                        @foreach($items as $item)
                        <div class="card card-border bg-base-100 rounded-none border-gray-200 w-full h-48 hover:bg-base-300">
                            <div class="card-body p-0">
                                <div class="flex gap-2">
                                    <div class="p-2 w-56 h-40">
                                        <img class="w-36 h-36 object-center rounded-xl"
                                        src="{{ asset('storage/' . $item->image) }}"
                                        alt="img" />
                                    </div>
                                    <div class="flex flex-col w-full gap-2">
                                        <div class="flex gap-2 items-center mt-2">
                                            <div class="avatar avatar-placeholder">
                                                <div class="bg-neutral text-neutral-content w-8 h-8 rounded-full">
                                                    <span class="text-xs">{{ substr($item->user->name, 0, 2) }}</span>
                                                </div>
                                            </div>
                                            <div class="flex flex-col">
                                                <h2 class="font-bold">{{ $item->title }}</h2>
                                                <p class="text-xs">{{ $item->user->name }} | {{ $item->distance }} km</p>
                                            </div>
                                        </div>
                                        <div>
                                            <p>{{ $item->description }}</p>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <div class="tooltip">
                                                <div class="tooltip-content">
                                                    <div class="test-xs text-slate-50">kategori baju</div>
                                                </div>
                                                <img src="{{ asset('icons/cloth.svg') }}" alt="" class="w-4">
                                            </div>
                                            <p>{{ $item->category }}</p>
                                        </div>
                                        <div class="flex gap-2 items-center">
                                            <div class="tooltip">
                                                <div class="tooltip-content">
                                                    <div class="test-xs text-slate-50">Persyaratan dalam menukar baju</div>
                                                </div>
                                                <img src="{{ asset('icons/agreement.svg') }}" alt="" class="w-4">
                                            </div>
                                            <p>{{ $item->terms_description }}</p>
                                        </div>
                                        <div class="w-36">
                                            <button class="btn btn-xs btn-success text-white font-bold w-full">
                                                <img src="{{ asset('icons/chat.svg') }}" alt="" class="w-3"> Chat
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div id="map" class="md:h-screen w-full h-96">
                <!-- Filter -->
                <div class="flex items-center relative z-[999] left-16 top-10">
                    <div class="filter flex gap-1">
                        <input class="btn btn-xs md:btn-sm filter-reset" type="radio" name="filter" aria-label="All"/>
                        <input class="btn btn-xs md:btn-sm" type="radio" name="filter" aria-label="Tukar Dengan Orang lain"/>
                        <input class="btn btn-xs md:btn-sm" type="radio" name="filter" aria-label="Tukar Poin"/>
                        <div>
                            <select class="select select-xs md:select-sm">
                                <option selected>Jarak</option>
                                <option>1 km - 5 km</option>
                                <option>6 km - 10 km</option>
                                <option>11 km - 15 km</option>
                            </select>
                        </div>
                        <div>
                            <select id="category-filter" class="select select-xs md:select-sm">
                                <option selected>Semua Kategori</option>
                                <option>Pakaian Anak</option>
                                <option>Pakaian Dewasa</option>
                                <option>Sepatu & Sendal</option>
                                <option>Aksesoris</option>
                                <option>Kacamata</option>
                                <option>Topi</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- endFilter -->
            </div>
        </div>
    </main>
</body>
</html>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Membuat peta menggunakan OpenLayers
        const map = new ol.Map({
            target: 'map',  // Target element peta
            layers: [
                new ol.layer.Tile({
                    source: new ol.source.OSM()  // Layer OSM (OpenStreetMap)
                })
            ],
            view: new ol.View({
                center: ol.proj.fromLonLat([106.816666, -6.208763]),  // Ganti dengan koordinat pusat peta
                zoom: 13
            })
        });

        // Layer GeoJSON dari WFS (Web Feature Service)
        const vectorLayer = new ol.layer.Vector({
            source: new ol.source.Vector({
                format: new ol.format.GeoJSON(),
                url: 'http://localhost:8080/geoserver/TemuTukar/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=TemuTukar%3Aitems&outputFormat=application%2Fjson&maxFeatures=50',  
            }),
            style: new ol.style.Style({
                image: new ol.style.Icon({
                    anchor: [0.5, 1],
                    src: 'icons/icon-swap.svg',  // Icon marker, bisa diganti sesuai kebutuhan
                    scale: 1.5  // Menambah skala ikon, ubah nilai sesuai kebutuhan
                })
            })
        });

        // Menambahkan vectorLayer ke peta
        map.addLayer(vectorLayer);

        // Marker untuk current user
        const userMarker = new ol.Feature({
            geometry: new ol.geom.Point(ol.proj.fromLonLat([106.816666, -6.208763])),  // Ganti dengan koordinat pengguna
            name: 'Current User'
        });

        const userLayer = new ol.layer.Vector({
            source: new ol.source.Vector({
                features: [userMarker]
            }),
            style: new ol.style.Style({
                image: new ol.style.Icon({
                    anchor: [0.5, 1],
                    src: 'icons/user-icon.svg',  // Ganti dengan ikon untuk current
                    src: 'icons/user-icon.svg',  // Ganti dengan ikon untuk current user
                    scale: 1.5  // Ukuran ikon, bisa disesuaikan
                })
            })
        });

        // Menambahkan userLayer ke peta
        map.addLayer(userLayer);

        // Menambahkan popup untuk marker (untuk pengguna)
        const popup = new ol.Overlay({
            element: document.getElementById('popup'), // Pastikan popup element sudah ada di HTML
            autoPan: true,
            autoPanAnimation: {
                duration: 250
            }
        });
        map.addOverlay(popup);

        // Fungsi untuk menampilkan popup ketika marker diklik
        map.on('click', function (event) {
            const feature = map.forEachFeatureAtPixel(event.pixel, function (feature) {
                return feature;
            });

            if (feature) {
                const coordinate = event.coordinate;
                const userName = feature.get('name');  // Dapatkan nama pengguna dari atribut marker

                // Menampilkan informasi di popup
                popup.setPosition(coordinate);
                document.getElementById('popup-content').innerHTML = '<div><strong>' + userName + '</strong></div>';
            }
        });

        // Tambahkan element popup di HTML
        const popupElement = document.createElement('div');
        popupElement.id = 'popup';
        popupElement.classList.add('ol-popup');
        document.body.appendChild(popupElement);

        // Tambahkan konten untuk popup
        const popupContent = document.createElement('div');
        popupContent.id = 'popup-content';
        popupElement.appendChild(popupContent);

        // Menambahkan style untuk popup
        // const style = document.createElement('style');
        // style.innerHTML = `
        //     .ol-popup {
        //         position: absolute;
        //         background: white;
        //         padding: 15px;
        //         border: 1px solid #ccc;
        //         box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        //         border-radius: 4px;
        //         max-width: 200px;
        //         width: auto;
        //         font-size: 14px;
        //     }
        //     .ol-popup:after {
        //         content: '';
        //         position: absolute;
        //         top: 100%;
        //         left: 50%;
        //         margin-left: -5px;
        //         border-width: 5px;
        //         border-style: solid;
        //         border-color: white transparent transparent transparent;
        //     }
        // `;
        // document.head.appendChild(style);
    });
</script>
</body>
</html>
