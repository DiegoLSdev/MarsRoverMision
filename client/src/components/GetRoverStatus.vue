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

// Render the obtained data into the template
onMounted(onLoadRoverStatus);

</script>

<template>
  <div>
    <h2>Rover Status</h2>
    <div>
      <p>Rover position: ({{ x }},{{ y }})</p>
      <p>Direction: {{ direction }}</p>
      <button @click="onLoadRoverStatus">Reload Rover Status</button>
    </div>

  </div>
</template>

<style scoped>

</style>
