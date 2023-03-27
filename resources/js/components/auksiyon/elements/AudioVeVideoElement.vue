<template>
    <div class="">
        <div v-if="product" class="">
            {{ product.title }}
        </div>
    </div>
</template>

<script>
export default {
    name: "audioVeVideo",
    props: ['product']
}
</script>

<style scoped>

</style>
