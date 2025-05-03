<script setup>
import GetRoverStatus from './components/GetRoverStatus.vue'
import StartRover from './components/startRover.vue'
</script>

<template>
  <div>
    <h1>MARS ROVER MISION</h1>
    <div>
      <StartRover />
      <GetRoverStatus />
    </div>
  </div>
</template>

<style scoped>
.logo {
  height: 6em;
  padding: 1.5em;
  will-change: filter;
  transition: filter 300ms;
}
.logo:hover {
  filter: drop-shadow(0 0 2em #646cffaa);
}
.logo.vue:hover {
  filter: drop-shadow(0 0 2em #42b883aa);
}
</style>
