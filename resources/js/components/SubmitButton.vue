<template>
  <button type="submit" class="w-full my-5 p-2 text-white bg-blue-500 hover:bg-blue-400 rounded-full" ref="submitButton" disabled>
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

    this.$root.$on('options_exist', (exists) => {
      if (this.editing) {
        this.$refs.submitButton.disabled = !exists;
      }
    })

    this.$root.$on('attachments_exist', (exists) => {
      if (this.editing) {
        this.$refs.submitButton.disabled = !exists;
      }
    });
  }
}
</script>
