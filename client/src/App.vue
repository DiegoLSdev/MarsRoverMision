<script setup>
import GetRoverStatus from './components/GetRoverStatus.vue'
import StartRover from './components/startRover.vue'
import RoverCommands from './components/RoverCommands.vue'
</script>

<template>
  <div>
    <h1>MARS ROVER MISION</h1>
    <div>
      <StartRover />
      <GetRoverStatus />
      <RoverCommands />
    </div>
  </div>
</template>

<style scoped>
</style>
