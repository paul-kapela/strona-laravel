<template>
  <div class="picker">
    <div v-for="(option, index) in options" v-bind:key="index" class="inline">
      <input type="radio" :name="name" :id="option.name" :value="option.id" class="hidden" :checked="selection == option.id" @change="onOptionChange()">
      <label :for="option.name" class="mr-1 text-xl cursor-pointer">{{ labels[option.name] }}</label>
    </div>
  </div>
</template>

<script>
export default {
  props: [
    'name',
    'initial',
    'options',
    'labels',
  ],
  data() {
    return {
      selection: this.initial
    };
  },
  methods: {
    onOptionChange() {
      this.$root.$emit('options_exist', true);
    }
  }
}
</script>