<template>
    <div class="col-12">
        <div class="for__phone_image_consumer" id="for-phone-image-consumer">
            <show-for-phone-screen
                :product="product"
            ></show-for-phone-screen>
        </div>
        <div class="for__desktop_image_consumer" id="for-desktop-image-consumer">
            <show-for-desktop-screen
                :product="product"
            ></show-for-desktop-screen>
        </div>
    </div>
</template>

<script>

// images/products/
export default {
    name: "ProductShow",
    props:['product'],
}
</script>

<style scoped>

</style>
