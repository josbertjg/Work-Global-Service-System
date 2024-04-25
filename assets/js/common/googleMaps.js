const countryCode = 've'
let geocodificator;
if(!!google.maps){
  geocodificator = new google.maps.Geocoder();
}

const geocoder = {
  getCountryPlace: async (code = countryCode) => {
    return await geocodificator.geocode({address: code, componentRestrictions: {country: code}})
  },
  getPlaceByCoords: async (LatLng) => {
    return await geocodificator.geocode({location: LatLng})
  }
}
