<template>
    <!-- Modal -->
    <div class="modal fade" :id="'auksionUserInfoModal'+id" tabindex="-1" :aria-labelledby="'auksionUserInfoModal'+id" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" :id="'auksionUserInfoModal'+id">Məlumat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    auksionUserInfoModal
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
    name: "AukcionUserInfoModal",
    props: ['id']
}
</script>

<style scoped>

</style>
