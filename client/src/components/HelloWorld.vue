<script setup>
import { ref, onMounted } from 'vue'
import { startRover, getRoverStatus } from '../api/rover';

// reactive state
const x = ref(null);
const y = ref(null);
const direction = ref(null);
const error = ref('');

// Function for loading the rover status
async function onLoadRoverStatus() {
  try {
    const data = await getRoverStatus();
    x.value = data.x;
    y.value = data.y;
    direction.value = data.direction;
  }catch (error) {
    error.value = 'Not able to load Rover Status';
    console.log('Error loading rover status:',error);
  }
}

// Function for start (and load the rover status again)
async function onStartRover() {
  try {
    startRover({
      x: 0,
      y: 0,
      direction: 'N',
      grid_size: 200,
      obstacles: [[0,50]],
    });
    
    // Call getRoverstatus again
    const data = await getRoverStatus();
    x.value = data.x;
    y.value = data.y;
    direction.value = data.direction;
    console.log('Rover started successfully:', data);

  } catch (error) {
    error.value = error;
    console.log('Error starting rover:', error);
  }
}

// Render the obtained data into the template
onMounted(onLoadRoverStatus);

</script>

<template>
  <div>
    <h1>Rover Status</h1>
    <div>
      <p>X -> {{ x }}</p>
      <p>Y -> {{ y }}</p>
      <p>Direction -> {{ direction }}</p>
      <button @click="onLoadRoverStatus">Reload Status</button>
      <button @click="onStartRover">Start Rover</button>
    </div>

  </div>
</template>

<style scoped>

</style>
