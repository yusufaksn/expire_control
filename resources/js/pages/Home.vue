<template>
    <div>
        <router-view></router-view>
    </div>
</template>

<script>
    export default {
        name: "Home",
        mounted() {
            this.$router.push({ name:'login'});
        }
    }
</script>

<style scoped>

</style>
