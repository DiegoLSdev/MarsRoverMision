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

    const data = await getRoverStatus();

    x.value = data.x;
    y.value = data.y;
    direction.value = data.direction;
    gridSize.value = data.gridSize;
    obstacles.value = data.obstacles;
  
  } catch (error) {
    errorData.value = error;
    console.log('Error restarting rover:', error);
  }

  restartData.value = `
    Rover returned at: (${x.value},${y.value}) 
    Direction : ${direction.value}
    Grid size: ${gridSize.value}`;
}

</script>
<template>
  <div className="flex flex-col items-center m-4">
    <button className="m-4 bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded" 
      @click="onRestartRover">
      Restart Rover
    </button>  

    <div>
      <p v-for="(line, idx) in restartData.split('\n')" 
        :key="idx"
        v-text="line.trim()"
        class="text-sm text-gray-500">
    </p>
    </div>

  </div>
</template>



<style scoped>

</style>
