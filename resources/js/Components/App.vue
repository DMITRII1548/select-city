<template>

<div>
    <router-view :key="$route.fullPath"></router-view>
</div>


</template>

<script>
export default {
    name: "App",

    data() {
        return {
            accessToken: null
        }
    },

}
</script>

<style scoped>

</style>
