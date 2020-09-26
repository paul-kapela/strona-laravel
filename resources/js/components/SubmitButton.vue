<template>
    <button type="submit" class="btn btn-primary" ref="submitButton" disabled>
        {{ (this.language === 'pl' ? 'Prześlij' : 'Send') }}
    </button>
</template>

<script>
export default {
    props: [
        'language',
        'editing'
    ],
    mounted() {
        this.$root.$on('content_exists', (exists) => {
           this.$refs.submitButton.disabled = !exists;
        });

        this.$root.$on('attachments_exist', (exists) => {
            if (this.editing) {
                this.$refs.submitButton.disabled = !exists;
            }
        });
    }
}
</script>
