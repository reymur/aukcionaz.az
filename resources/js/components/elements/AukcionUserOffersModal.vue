<template>
    <!-- Modal -->
    <div class="modal fade" :id="'auksionUserOffersModal'+id" tabindex="-1" :aria-labelledby="'auksionUserOffersModal'+id" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" :id="'auksionUserOffersModal'+id">Təklif</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    AuksionUserOffersModal
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "auksionUserOffersModal",
    props: ['id']
}
</script>

<style scoped>

</style>
