<template>
    <div class="container">
        <router-view :key="$route.fullPath" :authUser="auth_user"></router-view>
    </div>
</template>

<script>
    export default {
        props:['auth_user'],
    }
</script>

<style scoped>

</style>