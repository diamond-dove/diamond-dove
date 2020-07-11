<template>
    <div class="content">
        <div class="md-layout">
            <div
                    class="md-layout-item md-size-100"
            >
                <create-loan-form></create-loan-form>
            </div>
        </div>
    </div>
</template>

<script>
    import CreateLoanForm from '../../components/loans/CreateLoanForm';

    export default {
        name: "CreateClient",
        components: {
            CreateLoanForm
        }
    }
</script>

<style scoped>

</style>
