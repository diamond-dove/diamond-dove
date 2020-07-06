<template>
    <div class="content">
        <div class="md-layout">
            <div
                    class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-70"
            >
                <create-client-form></create-client-form>
            </div>
        </div>
    </div>
</template>

<script>
    import CreateClientForm from '../../components/clients/CreateClientForm';

    export default {
        name: "CreateClient",
        components: {
            CreateClientForm
        }
    }
</script>

<style scoped>

</style>
