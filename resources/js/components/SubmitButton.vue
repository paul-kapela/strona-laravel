<template>
    <button type="submit" class="btn btn-primary" ref="submitButton" disabled>
        {{ (this.language === 'pl' ? 'Prześlij' : 'Send') }}
    </button>
</template>

<script>
export default {
    props: [
        'language'
    ],
    mounted() {
        this.$root.$on('content_exists', (exists) => {
           this.$refs.submitButton.disabled = !exists;
        });
    }
}
</script>
