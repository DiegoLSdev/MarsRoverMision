<script setup>
import { ref } from 'vue'
import { startRover, getRoverStatus } from '../api/rover';

// reactive state
const x = ref(null);
const y = ref(null);
const direction = ref(null);
const errorData = ref("");
const gridSize = ref(null);
const obstacles = ref (null);

// Function for start (and load the rover status again)
async function onStartRover() {
  try {
    await startRover({
      x: 0,
      y: 0,
      direction: 'N',
      gridSize: 200,
      obstacles: [[0,50]],
    });
    
    // Call getRoverstatus again
    const data = await getRoverStatus();
    x.value = data.x;
    y.value = data.y;
    direction.value = data.direction;
    gridSize.value = data.gridSize;
    obstacles.value = data.obstacles;
    errorData.value = "";
 
    console.log('Rover started successfully:', data);

    // Let the user know below button
    errorData.value = `
    Rover started at: (${data.x},${data.y}) 
    Direction : ${data.direction}
    Grid size: ${data.gridSize}
    Obstacles: ${data.obstacles.map(obstacle => `(${obstacle[0]},${obstacle[1]})`).join(', ')} `;
    

  } catch (error) {
    errorData.value = error;
    console.log('Error starting rover:', error);
  }
}
</script>



<template>
  <div className="flex flex-col items-center m-4">
    <div>
        <button className="m-4 bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded" @click="onStartRover">
          Start Rover
        </button>
    </div>
    <p v-for="(line, idx) in errorData.split('\n')" 
        :key="idx"
        v-text="line.trim()"
        class="text-sm text-gray-500">
    </p>
  </div>
</template>

