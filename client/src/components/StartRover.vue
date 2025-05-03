<script setup>
import { ref } from 'vue'
import { startRover, getRoverStatus } from '../api/rover';

// reactive state
const x = ref(null);
const y = ref(null);
const direction = ref(null);
const startError = ref("");

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
    console.log('Rover started successfully:', data);

    // Let the user know below button
    startError.value = `Rover started successfully at position: (${data.x},${data.y}). Facing ${data.direction}`

  } catch (error) {
    startError.value = error;
    console.log('Error starting rover:', error);
  }
}

</script>



<template>
  <div>
    <h2>Rover Start</h2>
    <div>
      <button @click="onStartRover">Start Rover</button>
      <p>{{ startError }}</p>
    </div>

  </div>
</template>



<style scoped>

</style>
