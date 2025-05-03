<script setup>
import { ref } from 'vue'
import { executeCommands } from '../api/rover';

const commands = ref(null);

async function onExecuteCommands() {
  try {
    const response = await executeCommands(commands.value);
    console.log('Commands executed successfully:', response);
    } catch (error) {
    console.log('Error executing commands:', error);
  }
}

</script>

<template>
  <div className="flex flex-col items-center m-4">
    <button className="m-4 bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded" 
      @click="onExecuteCommands">
      Execute Commands
    </button>
    <div>
        <input 
          class="w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
          v-model="commands" 
          type="text" 
          placeholder="Enter commands (e.g., FFLFFR)" 
        />
    </div>

  </div>
</template>

<style scoped>

</style>
