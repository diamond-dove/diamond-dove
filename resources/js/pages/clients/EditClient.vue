<template>
    <div class="content">
        <div class="md-layout">
            <div
                    class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-70"
            >
                <edit-client-form></edit-client-form>
            </div>
        </div>
    </div>
</template>

<script>
    import EditClientForm from '../../components/clients/EditClientForm';

    export default {
        name: "EditClient",
        components: {
            EditClientForm
        }
    }
</script>

<style scoped>

</style>
