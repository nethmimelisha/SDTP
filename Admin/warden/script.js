// Initialize the map
var map = L.map('map').setView([7.8731, 80.7718], 13);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

// Property data
var properties = [
  {
    name: 'OYO Flagship Lakshmi Sri Boarding Lodging House',
    description: '2 bedrooms + 1 bed',
    price: 'LKR 2,573',
    amenities: 'Air conditioning, Wi-Fi, Kitchen',
    nearbyPlaces: '9.4 km away',
    latitude: 7.8731,
    longitude: 80.7718
  },
  {
    name: '16 Bedouin Themed Glamping Luxury Tents',
    description: '2 bedrooms + 4 bathrooms',
    price: 'LKR 477K',
    amenities: 'Private Pool, BBQ, Outdoor Seating',
    nearbyPlaces: '930 m away',
    latitude: 7.8847,
    longitude: 80.7876
  },
  {
    name: 'Tranquil Staycation - Independent Duplex House',
    description: '2 bedrooms, 2 bathrooms',
    price: 'LKR 477K',
    amenities: 'Private Pool, Parking, Garden',
    nearbyPlaces: 'About 200 m away',
    latitude: 7.8718,
    longitude: 80.7701
  },
  {
    name: 'Paradise Pool Villa by JadeCapsi',
    description: '2 bedrooms, 2 bathrooms',
    price: 'LKR 66,761',
    amenities: 'Private Pool, BBQ, Garden',
    nearbyPlaces: '45 min (113 km) away',
    latitude: 7.9125,
    longitude: 80.5845
  },
  {
    name: 'A2 Farms',
    description: '3 bedrooms, 2 bathrooms',
    price: 'LKR 26.8K',
    amenities: 'Farmhouse, Garden, Parking',
    nearbyPlaces: '1 hr (130 km) away',
    latitude: 7.6342,
    longitude: 80.9572
  }
];

// Add location markers to the map
properties.forEach(function(property) {
  L.marker([property.latitude, property.longitude]).addTo(map)
    .on('click', function() {
      displayPropertyDetails(property);
    });
});

// Function to display property details
function displayPropertyDetails(property) {
  document.getElementById('property-name').textContent = property.name;
  document.getElementById('property-description').textContent = property.description;
  document.getElementById('property-price').textContent = property.price;
  document.getElementById('property-amenities').textContent = property.amenities;
  document.getElementById('property-nearby').textContent = property.nearbyPlaces;
}