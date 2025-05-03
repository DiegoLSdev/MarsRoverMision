<script setup>
import GetRoverStatus from './components/GetRoverStatus.vue'
import StartRover from './components/startRover.vue'
import RoverCommands from './components/RoverCommands.vue'
import RestartRover from './components/RestartRover.vue'
</script>

<template>
  <div className="flex flex-col items-center m-4">
    <h1 className="from-neutral-700 text-6xl font-semibold">MARS ROVER MISION</h1>
    <div className="flex m-6">
      <StartRover />
      <GetRoverStatus />
      <RoverCommands />
      <RestartRover />
    </div>
  </div>
</template>

<style scoped>
</style>
