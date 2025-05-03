<script setup>
import { ref } from 'vue'
import { startRover, getRoverStatus, executeCommands, restartRover } from '../api/rover';

// reactive state
const x = ref(null);
const y = ref(null);
const direction = ref(null);
const errorData = ref("");
const gridSize = ref(null);
const obstacles = ref (null);
const restartData = ref("");


// Function for restart (and load the rover status again)
async function onRestartRover() {
  try{
  await restartRover();
  const restartData = await getRoverStatus();
  x.value = restartData.x;
  y.value = restartData.y;
  direction.value = restartData.direction;
  gridSize.value = restartData.gridSize;
  obstacles.value = restartData.obstacles;
  } catch (error) {
    errorData.value = error;
    console.log('Error restarting rover:', error);
  }
}

</script>
<template>
  <div className="action">
    <h2>Rover Restart</h2>
    <div>
      <button @click="onRestartRover">Restart Rover</button>
      {{ restartData }}
    </div>

  </div>
</template>



<style scoped>

</style>
