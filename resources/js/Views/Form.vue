<template>
    <form class="container mt-5">
      <h1>Выбирете города</h1>
      <input v-model="prefix" @keyup="getCitiesByPrefix" placeholder="Напишите название города" type="text" class="form-control" ref="input">

      <template v-if="cities">
        <select @change="drawSelectedCities" name="cities[]" v-model="selectedCitiesIds" class="form-select mt-2" ref="select" multiple>
            <template v-for="city in cities">
              <option :value="city.id">{{ city.name }}</option>
            </template>
        </select>
      </template>
      <div v-if="selectedCities" class="border p-4 d-flex flex-wrap gap-2 mt-2">
        <template  v-for="city in selectedCities">
          <div class="border p-2 d-flex gap-3">
              {{ city.name }}
              <div @click="removeSelectedCity(city.id)" class="cross">

              </div>
          </div>
        </template>
      </div>
    </form>
  </template>

  <script>
  export default {
    name: 'Form',

    data() {
      return {
        cities: null,
        prefix: "",
        selectedCitiesIds: [],
        choicedCities: [],
        selectedCities: []
      }
    },

    methods: {
      getCitiesByPrefix() {
        if (this.prefix.length > 2) {
          axios.get(`/api/cities/${this.prefix}/prefix`)
            .then(res => {
              this.cities = res.data
            })
        }
      },

      getCity(id) {
        axios.get(`/api/cities/${id}`)
            .then(res => {
                return res.data
            })
      },

      removeSelectedCity(cityId) {
        this.choicedCities = this.choicedCities.filter(id => id !== cityId)
        this.selectedCitiesIds = this.selectedCitiesIds.filter(id => id !== cityId)
        this.selectedCities = this.selectedCities.filter(city => city.id !== cityId)
      },

      drawSelectedCities() {
        this.choicedCities = this.selectedCitiesIds.filter(id => !this.selectedCities.some(city => city.id === id))
        // = this.selectedCitiesIds
        this.choicedCities.forEach(id => {
            axios.get(`/api/cities/${id}`)
                .then(res => {
                    this.selectedCities.push(res.data)
                })
        })
      }
    }
  }
</script>

<style scoped>
.cross {
  position: relative;
  width: 15px;
  height: 15px;
}

.cross::before {
  content: "";
  top: 5px;
  position: absolute;
  background: #000;
  width: 1px;
  height: 15px;
  transform: rotate(45deg)
}

.cross::after {
  content: "";
  top: 5px;
  position: absolute;
  background: #000;
  width: 1px;
  height: 15px;
  transform: rotate(135deg)
}
</style>
