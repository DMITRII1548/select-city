# Installation 

## Запустить следующие команды:

### git clone ссылка на данный репозиторий

### composer install

### php artisan key:generate

### npm install

### npm run build

### php artisan migrate --seed

### php artisan serve

Затем откройте http://127.0.0.1:8000/form в вашем браузере.

## Информация по бэкенду 

### Роуты

routes/api.php

```php
Route::get('/cities', [CityController::class, 'index']); // Получаем все города
Route::get("/cities/{city}/prefix", [CityController::class, 'getCityByPrefix']); // получаем города по префиксу или части названия
Route::get('/cities/{city}', [CityController::class, 'show']); // получаем город
```

routes/web.php

```php
Route::get('{page}', IndexController::class)->where('page', '.*'); // Основа для spa приложения все запросы идут в этот контроллер 

```

## Информация по frontend
resources/js/Views/Form.vue 

Сдесь находится vue с формой, в которой можно выбрать города

### Описание всех методов и переменных

```js
    data() {
      return {
        cities: null, // Города которые отображаются
        prefix: "", // Префикс для вывода только некоторых городов
        selectedCitiesIds: [], // id выбранных городов получаемые из select
        choicedCities: [], // здесь находятся id выбранных всех выбранных городов
        selectedCities: [] // здесь находится полная информация о выбранных городах
      }
    },
```

```js
    methods: {
      // Получаем все города
      getAllCities() {
        axios.get('/api/cities')
          .then(res => {
            this.cities = res.data
          })
      }, 

      // Получаем города по префиксу
      getCitiesByPrefix() {
        if (this.prefix) {
          axios.get(`/api/cities/${this.prefix}/prefix`)
            .then(res => {
              this.cities = res.data
            })
        } else {
          this.getAllCities()
        }
      },

      // Получаем город по id
      getCity(id) {
        axios.get(`/api/cities/${id}`)
            .then(res => {
                return res.data
            })
      },

      // Удаляем выбранный город из выбранных
      removeSelectedCity(cityId) {
        this.choicedCities = this.choicedCities.filter(id => id !== cityId)
        this.selectedCitiesIds = this.selectedCitiesIds.filter(id => id !== cityId)
        this.selectedCities = this.selectedCities.filter(city => city.id !== cityId)
      },

      // Отображаем выбранные города
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
```
