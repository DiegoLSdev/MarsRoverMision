<script setup>
import { ref, onMounted } from 'vue'
import { startRover, getRoverStatus } from '../api/rover';

// reactive state
const x = ref(null);
const y = ref(null);
const direction = ref(null);
const statusData = ref(null);

// Function for loading the rover status
async function onLoadRoverStatus() {
  try {
    const data = await getRoverStatus();
    x.value = data.x;
    y.value = data.y;
    direction.value = data.direction;
    statusData.value = "";

    console.log('Rover status successfully loaded:', data);

    statusData.value = `
    Rover started at: (${data.x},${data.y}) 
    Direction : ${data.direction}`; 

  }catch (error) {
    error.value = 'Not able to load Rover Status';
    console.log('Error loading rover status:',error);
  }


}

// Render the obtained data into the template
// onMounted(onLoadRoverStatus);

</script>

<template>
  <div className="flex flex-col items-center m-4">
    <button className="m-4 bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded" 
      @click="onLoadRoverStatus">
          Rover Status
    </button>
    <div class="text-sm text-gray-500">
      <div v-if="statusData">
        <p v-for="(line, index) in statusData.split('\n')" :key="index">
          {{ line }}
        </p>
      </div>
    </div>

  </div>
</template>

<style scoped>

</style>
