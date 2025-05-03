<script setup>
import GetRoverStatus from './components/GetRoverStatus.vue'
import StartRover from './components/startRover.vue'
import RoverCommands from './components/RoverCommands.vue'
import RestartRover from './components/RestartRover.vue'
</script>

<template>
  <div>
    <h1>MARS ROVER MISION</h1>
    <div>
      <StartRover />
      <GetRoverStatus />
      <RoverCommands />
      <RestartRover />
    </div>
  </div>
</template>

<style scoped>
</style>
