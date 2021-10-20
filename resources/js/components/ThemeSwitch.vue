<template>
  <button @click="onThemeChange()" class="flex">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 p-2 text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 rounded-full" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
    </svg>

    <h3 class="ml-2 lg:hidden font-semibold leading-9">{{ labels['change'] }}</h3>
  </button>
</template>

<script>
export default {
  props: [
    'labels',
  ],
  methods: {
    onThemeChange() {
      if (localStorage.theme == 'dark') {
        localStorage.theme = 'light';
        document.querySelector('html').classList.remove('dark');
      } else {
        localStorage.theme = 'dark';
        document.querySelector('html').classList.add('dark');
      }
    }
  }
}
</script>