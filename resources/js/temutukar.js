// User's current position (Jakarta as default)
const userPosition = {
    lon: 106.8456,
    lat: -6.2088
};

// Store the fetched data globally
let itemsData = [];
let institutionsData = [];

// OpenLayers map setup
const container = document.getElementById('popup');
const content = document.getElementById('popup-content');
const closer = document.getElementById('popup-closer');

// Create an overlay for the popup
const overlay = new ol.Overlay({
    element: container,
    autoPan: {
        animation: {
            duration: 250
        }
    }
});

// Add a click handler to close the popup
closer.onclick = function() {
    overlay.setPosition(undefined);
    closer.blur();
    return false;
};

// Create map
const map = new ol.Map({
    target: 'map',
    layers: [
        new ol.layer.Tile({
            source: new ol.source.OSM()
        })
    ],
    overlays: [overlay],
    view: new ol.View({
        center: ol.proj.fromLonLat([userPosition.lon, userPosition.lat]),
        zoom: 12
    })
});

// Create layer groups
const itemsLayer = new ol.layer.Vector({
    source: new ol.source.Vector(),
    style: createItemStyle
});

const institutionsLayer = new ol.layer.Vector({
    source: new ol.source.Vector(),
    style: createInstitutionStyle
});

const userLayer = new ol.layer.Vector({
    source: new ol.source.Vector(),
    style: createUserStyle
});

map.addLayer(itemsLayer);
map.addLayer(institutionsLayer);
map.addLayer(userLayer);

// Add user marker
function addUserMarker(lon, lat) {
    userLayer.getSource().clear();
    
    const userFeature = new ol.Feature({
        geometry: new ol.geom.Point(ol.proj.fromLonLat([lon, lat])),
        name: 'Your Location'
    });
    
    userLayer.getSource().addFeature(userFeature);
}

// Style functions
function createUserStyle() {
    const markerElement = document.createElement('div');
    markerElement.innerHTML = '<div class="marker marker-user"><i class="fas fa-user" style="color: #4CAF50;"></i></div>';
    
    return new ol.style.Style({
        image: new ol.style.Icon({
            anchor: [0.5, 0.5],
            scale: 0.8,
            imgSize: [36, 36],
            img: markerElement,
            color: '#4CAF50'
        })
    });
}

function createItemStyle() {
    return new ol.style.Style({
        image: new ol.style.Circle({
            radius: 12,
            fill: new ol.style.Fill({
                color: '#E3F2FD'
            }),
            stroke: new ol.style.Stroke({
                color: '#1976D2',
                width: 2
            })
        }),
        text: new ol.style.Text({
            text: '\uf466', // Font Awesome box icon
            font: 'normal 14px FontAwesome',
            fill: new ol.style.Fill({
                color: '#1976D2'
            })
        })
    });
}

function createInstitutionStyle() {
    return new ol.style.Style({
        image: new ol.style.Circle({
            radius: 12,
            fill: new ol.style.Fill({
                color: '#FFF8E1'
            }),
            stroke: new ol.style.Stroke({
                color: '#FFA000',
                width: 2
            })
        }),
        text: new ol.style.Text({
            text: '\uf1ad', // Font Awesome building icon
            font: 'normal 14px FontAwesome',
            fill: new ol.style.Fill({
                color: '#FFA000'
            })
        })
    });
}

// Calculate distance between two points in kilometers
function calculateDistance(lon1, lat1, lon2, lat2) {
    const R = 6371; // Radius of the earth in km
    const dLat = deg2rad(lat2 - lat1);
    const dLon = deg2rad(lon2 - lon1);
    const a = 
        Math.sin(dLat/2) * Math.sin(dLat/2) +
        Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * 
        Math.sin(dLon/2) * Math.sin(dLon/2); 
    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
    const d = R * c; // Distance in km
    return parseFloat(d.toFixed(1));
}

function deg2rad(deg) {
    return deg * (Math.PI/180);
}

// Fetch items data with CQL filter
async function fetchItems(filterStr = '') {
    try {
        let url = 'http://localhost:8080/geoserver/TemuTukar/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=TemuTukar%3Aitems&outputFormat=application%2Fjson&maxFeatures=50';
        
        if (filterStr) {
            url += `&CQL_FILTER=${encodeURIComponent(filterStr)}`;
        }
        
        const response = await fetch(url);
        const data = await response.json();
        
        // Add distance property to each item
        data.features.forEach(item => {
            const coords = item.geometry.coordinates;
            item.properties.distance = calculateDistance(
                userPosition.lon, 
                userPosition.lat, 
                coords[0], 
                coords[1]
            );
        });
        
        // Sort by distance
        data.features.sort((a, b) => a.properties.distance - b.properties.distance);
        
        itemsData = data;
        renderItems(data);
        addItemsToMap(data);
        
        return data;
    } catch (error) {
        console.error('Error fetching items:', error);
        document.getElementById('items-container').innerHTML = '<div class="alert alert-error">Failed to load items data</div>';
        return { features: [] };
    }
}

// Fetch institutions data with CQL filter
async function fetchInstitutions(filterStr = '') {
    try {
        let url = 'http://localhost:8080/geoserver/TemuTukar/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=TemuTukar%3Ainstitutions&outputFormat=application%2Fjson&maxFeatures=50';
        
        if (filterStr) {
            url += `&CQL_FILTER=${encodeURIComponent(filterStr)}`;
        }
        
        const response = await fetch(url);
        const data = await response.json();
        
        // Add distance property to each institution
        data.features.forEach(institution => {
            const coords = institution.geometry.coordinates;
            institution.properties.distance = calculateDistance(
                userPosition.lon, 
                userPosition.lat, 
                coords[0], 
                coords[1]
            );
        });
        
        // Sort by distance
        data.features.sort((a, b) => a.properties.distance - b.properties.distance);
        
        institutionsData = data;
        renderInstitutions(data);
        addInstitutionsToMap(data);
        
        return data;
    } catch (error) {
        console.error('Error fetching institutions:', error);
        document.getElementById('institutions-container').innerHTML = '<div class="alert alert-error">Failed to load institutions data</div>';
        return { features: [] };
    }
}

// Render items to the sidebar
function renderItems(data) {
    const container = document.getElementById('items-container');
    
    if (data.features.length === 0) {
        container.innerHTML = '<div class="text-center py-4">No items available</div>';
        return;
    }
    
    let html = '';
    
    data.features.forEach(feature => {
        const item = feature.properties;
        const itemId = feature.id.split('.')[1];
        
        html += `
        <div class="card card-border bg-base-100 rounded-none border-gray-200 w-full h-48 hover:bg-base-300 item-card" data-id="${itemId}">
            <div class="card-body p-0">
                <div class="flex gap-2">
                    <div class="p-2 w-56 h-40">
                        <img class="w-36 h-36 object-center rounded-xl"
                        src="/api/placeholder/300/300"
                        alt="${item.title}" />
                    </div>
                    <div class="flex flex-col w-full gap-2">
                        <div class="flex gap-2 items-center mt-2">
                            <div class="avatar avatar-placeholder">
                                <div class="bg-neutral text-neutral-content w-8 h-8 rounded-full">
                                    <span class="text-xs">ID${item.user_id}</span>
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <h2 class="font-bold">${item.title}</h2>
                                <p class="text-xs">User ID: ${item.user_id} | ${item.distance} km</p>
                            </div>
                        </div>
                        <div>
                            <p>${item.description}</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="tooltip">
                                <div class="tooltip-content">
                                    <div class="test-xs text-slate-50">kategori barang</div>
                                </div>
                                <i class="fas fa-tag w-4"></i>
                            </div>
                            <p>${item.category}</p>
                        </div>
                        <div class="flex gap-2 items-center">
                            <div class="tooltip">
                                <div class="tooltip-content">
                                    <div class="test-xs text-slate-50">Persyaratan dalam menukar</div>
                                </div>
                                <i class="fas fa-handshake w-4"></i>
                            </div>
                            <p>${item.terms_description}</p>
                        </div>
                        <div class="w-36">
                            <button class="btn btn-xs btn-success text-white font-bold w-full">
                                <i class="fas fa-comment-dots w-3"></i> Chat
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        `;
    });
    
    container.innerHTML = html;
    
    // Add click event to show on map
    document.querySelectorAll('.item-card').forEach(card => {
        card.addEventListener('click', function() {
            const itemId = this.getAttribute('data-id');
            const feature = data.features.find(f => f.id.split('.')[1] === itemId);
            
            if (feature) {
                const coords = feature.geometry.coordinates;
                const position = ol.proj.fromLonLat([coords[0], coords[1]]);
                
                // Fly to the item location
                map.getView().animate({
                    center: position,
                    zoom: 15,
                    duration: 500
                });
                
                // Show popup
                setTimeout(() => {
                    showItemPopup(feature, position);
                }, 500);
            }
        });
    });
}

// Render institutions to the sidebar
function renderInstitutions(data) {
    const container = document.getElementById('institutions-container');
    
    if (data.features.length === 0) {
        container.innerHTML = '<div class="text-center py-4">No institutions available</div>';
        return;
    }
    
    let html = '';
    
    data.features.forEach(feature => {
        const institution = feature.properties;
        const institutionId = feature.id.split('.')[1];
        
        html += `
        <div class="card card-border bg-base-100 rounded-none border-gray-200 w-full hover:bg-base-300 institution-card" data-id="${institutionId}">
            <div class="card-body p-0">
                <div class="flex gap-2">
                    <div class="p-2 w-40 h-40">
                        <img class="w-36 h-36 object-center m-2 rounded-xl"
                        src="/api/placeholder/300/300"
                        alt="${institution.name}" />
                    </div>
                    <div class="flex flex-col gap-1">
                        <div class="flex gap-2 items-center mt-2">
                            <div class="flex flex-col">
                                <h2 class="font-bold">${institution.name}</h2>
                                <p class="text-xs">${institution.distance} km</p>
                            </div>
                        </div>
                        <div>
                            <p>${institution.street}, ${institution.district}, ${institution.city}</p>
                        </div>
                        <div class="flex items-center gap-2 mt-1">
                            <div class="tooltip">
                                <div class="tooltip-content">
                                    <div class="test-xs text-slate-50">Jenis Lembaga</div>
                                </div>
                                <i class="fas fa-building w-4"></i>
                            </div>
                            <p>${institution.type}</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="tooltip">
                                <div class="tooltip-content">
                                    <div class="test-xs text-slate-50">Kontak</div>
                                </div>
                                <i class="fas fa-phone w-4"></i>
                            </div>
                            <p>${institution.phone_number}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        `;
    });
    
    container.innerHTML = html;
    
    // Add click event to show on map
    document.querySelectorAll('.institution-card').forEach(card => {
        card.addEventListener('click', function() {
            const institutionId = this.getAttribute('data-id');
            const feature = data.features.find(f => f.id.split('.')[1] === institutionId);
            
            if (feature) {
                const coords = feature.geometry.coordinates;
                const position = ol.proj.fromLonLat([coords[0], coords[1]]);
                
                // Fly to the institution location
                map.getView().animate({
                    center: position,
                    zoom: 15,
                    duration: 500
                });
                
                // Show popup
                setTimeout(() => {
                    showInstitutionPopup(feature, position);
                }, 500);
            }
        });
    });
}

// Add items to the map
function addItemsToMap(data) {
    // Clear existing features
    itemsLayer.getSource().clear();
    
    // Convert GeoJSON features to OpenLayers features
    const features = new ol.format.GeoJSON().readFeatures(data, {
        featureProjection: 'EPSG:3857'
    });
    
    // Add features to layer
    itemsLayer.getSource().addFeatures(features);
}

// Add institutions to the map
function addInstitutionsToMap(data) {
    // Clear existing features
    institutionsLayer.getSource().clear();
    
    // Convert GeoJSON features to OpenLayers features
    const features = new ol.format.GeoJSON().readFeatures(data, {
        featureProjection: 'EPSG:3857'
    });
    
    // Add features to layer
    institutionsLayer.getSource().addFeatures(features);
}

// Show item popup
function showItemPopup(feature, position) {
    const item = feature.properties;
    
    const popupContent = `
    <div class="p-4 max-w-xs">
        <div class="text-lg font-bold text-blue-800 mb-2">${item.title}</div>
        <div class="text-sm mb-2">
            <span class="font-medium">User ID:</span> ${item.user_id} | 
            <span class="font-medium">Distance:</span> ${item.distance} km
        </div>
        <div class="flex items-center gap-2 mb-2">
            <i class="fas fa-tag text-blue-600"></i>
            <span class="text-sm">${item.category}</span>
        </div>
        <div class="text-sm mb-3">${item.description}</div>
        <div class="flex items-center gap-2 mb-3">
            <i class="fas fa-handshake text-blue-600"></i>
            <span class="text-sm">${item.terms_description}</span>
        </div>
        <button class="btn btn-sm bg-green-500 hover:bg-green-600 text-white font-bold w-full">
            <i class="fas fa-comment-dots mr-2"></i> Chat
        </button>
    </div>
    `;
    
    content.innerHTML = popupContent;
    container.classList.remove('hidden');
    overlay.setPosition(position);
}

// Show institution popup
function showInstitutionPopup(feature, position) {
    const institution = feature.properties;
    
    const popupContent = `
    <div class="p-4 max-w-xs">
        <div class="text-lg font-bold text-amber-800 mb-2">${institution.name}</div>
        <div class="flex items-center gap-2 mb-2">
            <i class="fas fa-building text-amber-600"></i>
            <span class="text-sm">${institution.type}</span>
        </div>
        <div class="flex items-center gap-2 mb-2">
            <i class="fas fa-map-marker-alt text-amber-600"></i>
            <span class="text-sm">${institution.street}, ${institution.district}, ${institution.city}</span>
        </div>
        <div class="flex items-center gap-2 mb-2">
            <i class="fas fa-route text-amber-600"></i>
            <span class="text-sm">${institution.distance} km dari lokasi Anda</span>
        </div>
        <div class="flex items-center gap-2 mb-3">
            <i class="fas fa-phone text-amber-600"></i>
            <span class="text-sm">${institution.phone_number}</span>
        </div>
    </div>
    `;
    
    content.innerHTML = popupContent;
    container.classList.remove('hidden');
    overlay.setPosition(position);
}

// Map click handler to show popups
map.on('click', function(evt) {
    const feature = map.forEachFeatureAtPixel(evt.pixel, function(feature) {
        return feature;
    });
    
    if (feature) {
        const geometry = feature.getGeometry();
        const position = geometry.getCoordinates();
        
        // Check which layer the feature belongs to
        if (institutionsLayer.getSource().hasFeature(feature)) {
            showInstitutionPopup(feature.getProperties(), position);
        } else if (itemsLayer.getSource().hasFeature(feature)) {
            showItemPopup(feature.getProperties(), position);
        } else if (userLayer.getSource().hasFeature(feature)) {
            content.innerHTML = '<div class="p-4"><strong>Your Location</strong></div>';
            container.classList.remove('hidden');
            overlay.setPosition(position);
        }
    } else {
        closer.click();
    }
});

// Apply filters based on UI selections
function applyFilters() {
    const filterType = document.querySelector('input[name="filter"]:checked').value;
    const distanceValue = document.getElementById('distance-filter').value;
    const searchValue = document.getElementById('search-input').value.toLowerCase();
    
    let itemsCqlFilters = [];
    let institutionsCqlFilters = [];
    
    // Distance filter
    if (distanceValue !== 'all') {
        // Distance filtering will be done client-side after data is fetched
    }
    
    // Category filter (for items only)
    if (filterType !== 'institutions') {
        const categoryValue = document.getElementById('category-filter').value;
    }
    // Category filter (for items only)
    if (filterType !== 'institutions') {
        const categoryValue = document.getElementById('category-filter').value;
        if (categoryValue !== 'all') {
            itemsCqlFilters.push(`category = '${categoryValue}'`);
        }
    }
    
    // Type filter (for institutions only)
    if (filterType !== 'items') {
        const typeValue = document.getElementById('type-filter').value;
        if (typeValue !== 'all') {
            institutionsCqlFilters.push(`type = '${typeValue}'`);
        }
    }
    
    // Search filter
    if (searchValue) {
        if (filterType !== 'institutions') {
            itemsCqlFilters.push(`title ILIKE '%${searchValue}%' OR description ILIKE '%${searchValue}%'`);
        }
        if (filterType !== 'items') {
            institutionsCqlFilters.push(`name ILIKE '%${searchValue}%' OR city ILIKE '%${searchValue}%'`);
        }
    }
    
    // Build CQL filter strings
    const itemsCql = itemsCqlFilters.length > 0 ? itemsCqlFilters.join(' AND ') : '';
    const institutionsCql = institutionsCqlFilters.length > 0 ? institutionsCqlFilters.join(' AND ') : '';
    
    // Fetch data based on filter type
    if (filterType === 'all' || filterType === 'items') {
        fetchItems(itemsCql).then(data => {
            // Apply client-side distance filtering if needed
            if (distanceValue !== 'all') {
                const distanceNum = parseInt(distanceValue);
                const filteredData = {
                    ...data,
                    features: data.features.filter(feature => {
                        const distance = feature.properties.distance;
                        if (distanceValue === '5') return distance <= 5;
                        if (distanceValue === '10') return distance > 5 && distance <= 10;
                        if (distanceValue === '15') return distance > 10 && distance <= 15;
                        return true;
                    })
                };
                renderItems(filteredData);
                addItemsToMap(filteredData);
            }
        });
        
        document.getElementById('items-title').style.display = 'block';
        document.getElementById('items-container').style.display = 'block';
    } else {
        document.getElementById('items-title').style.display = 'none';
        document.getElementById('items-container').style.display = 'none';
        itemsLayer.getSource().clear();
    }
    
    if (filterType === 'all' || filterType === 'institutions') {
        fetchInstitutions(institutionsCql).then(data => {
            // Apply client-side distance filtering if needed
            if (distanceValue !== 'all') {
                const distanceNum = parseInt(distanceValue);
                const filteredData = {
                    ...data,
                    features: data.features.filter(feature => {
                        const distance = feature.properties.distance;
                        if (distanceValue === '5') return distance <= 5;
                        if (distanceValue === '10') return distance > 5 && distance <= 10;
                        if (distanceValue === '15') return distance > 10 && distance <= 15;
                        return true;
                    })
                };
                renderInstitutions(filteredData);
                addInstitutionsToMap(filteredData);
            }
        });
        
        document.getElementById('institutions-title').style.display = 'block';
        document.getElementById('institutions-container').style.display = 'block';
    } else {
        document.getElementById('institutions-title').style.display = 'none';
        document.getElementById('institutions-container').style.display = 'none';
        institutionsLayer.getSource().clear();
    }
}

// Toggle filter visibility based on selection
function updateFilterVisibility() {
    const filterType = document.querySelector('input[name="filter"]:checked').value;
    
    // Distance filter is always visible
    document.getElementById('distance-filter-container').style.display = 'block';
    
    // Toggle category filter visibility
    if (filterType === 'institutions') {
        document.getElementById('category-filter-container').style.display = 'none';
    } else {
        document.getElementById('category-filter-container').style.display = 'block';
    }
    
    // Toggle type filter visibility
    if (filterType === 'items') {
        document.getElementById('type-filter-container').style.display = 'none';
    } else {
        document.getElementById('type-filter-container').style.display = 'block';
    }
    
    // Apply filters
    applyFilters();
}

// Initialize map and data
function initializeApp() {
    // Get user's location
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            position => {
                userPosition.lat = position.coords.latitude;
                userPosition.lon = position.coords.longitude;
                
                // Update map view
                map.getView().setCenter(ol.proj.fromLonLat([userPosition.lon, userPosition.lat]));
                
                // Add user marker
                addUserMarker(userPosition.lon, userPosition.lat);
                
                // Fetch initial data
                fetchItems();
                fetchInstitutions();
            },
            error => {
                console.warn('Error getting location:', error);
                // Use default position (Jakarta)
                addUserMarker(userPosition.lon, userPosition.lat);
                fetchItems();
                fetchInstitutions();
            }
        );
    } else {
        console.warn('Geolocation is not supported by this browser');
        // Use default position (Jakarta)
        addUserMarker(userPosition.lon, userPosition.lat);
        fetchItems();
        fetchInstitutions();
    }
    
    // Add event listeners for filters
    document.querySelectorAll('input[name="filter"]').forEach(radio => {
        radio.addEventListener('change', updateFilterVisibility);
    });
    
    document.getElementById('distance-filter').addEventListener('change', applyFilters);
    document.getElementById('category-filter').addEventListener('change', applyFilters);
    document.getElementById('type-filter').addEventListener('change', applyFilters);
    document.getElementById('search-input').addEventListener('input', applyFilters);
    
    // Initial filter visibility update
    updateFilterVisibility();
}

// Initialize the application when DOM is ready
document.addEventListener('DOMContentLoaded', initializeApp);