
<template>
  <div class="Location">
    <label for="location">Location</label>
    <div id="location">
      <gmap-autocomplete @place_changed="setPlace" @input="value = $event.target.value"></gmap-autocomplete>
      <gmap-map
        :center="location"
        :zoom=this.zoom
        style="width: 100%; height: 300px">
        <gmap-marker
          :position="location"
          :clickable="true"
          :draggable="true"
          @click="center=location"
          @place_changed="setPlace"
          @position_changed="markerDrag($event)"
        ></gmap-marker>
      </gmap-map>
    </div>

    <input type="hidden" v-model="location.lat" name="lat">
    <input type="hidden" v-model="location.lng" name="lng">
  </div>
</template>

<script>
export default {
    props: ['lat', 'lng', 'zoomLevel'],

    created () {
        if (this.lat != null && this.lng != null) {
            this.location.lat = parseFloat(this.lat);
            this.location.lng = parseFloat(this.lng);
        }

        if (this.zoomLevel != null) {
            this.zoom = parseInt(this.zoomLevel);
        }
    },

    data () {
        return {
           zoom: 6,
            location: {
                lat: 22.538948,
                lng: 88.332537
            },
            markers: [{
                position: {lat: 10.0, lng: 10.0}
            }]
        }
    },

    methods: {
        setPlace (place) {
            // console.log(place);
            this.location = {
                lat: place.geometry.location.lat(),
                lng: place.geometry.location.lng()
            }
        },

        markerDrag (position) {
            //console.log(position);
            this.location = {
                lat: position.lat(),
                lng: position.lng()
            }
        }
    }
}
</script>
<style>
.vue-map-container{
    margin:30px 0px
}
</style>
