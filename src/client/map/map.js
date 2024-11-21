document.addEventListener("DOMContentLoaded", async () => {
  const map = L.map('map').setView([0, 0], 13); 

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 18,
    attribution: '© OpenStreetMap contributors',
  }).addTo(map);

  try {
    const response = await fetch('https://ipinfo.io/json?token=2ea4bca1706f48'); 
    const data = await response.json();
    const [lat, lon] = data.loc.split(',');
   
    const marker = L.marker([lat, lon]).addTo(map);
    marker.bindPopup(`<b>Your IP:</b> ${data.ip}`).openPopup();

    map.setView([lat, lon], 13);
  } catch (error) {
    console.error('Error fetching geolocation:', error);
    alert('Unable to fetch geolocation data.');
  }
});
