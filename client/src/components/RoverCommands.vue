<script setup>
import { ref } from 'vue'
import { executeCommands } from '../api/rover';

const commands = ref(null);
const inputErrorMessage = ref(null);

async function onExecuteCommands() {
  try {
    const response = await executeCommands(commands.value);
    console.log('Commands executed successfully:', response);
    } catch (error) {
    console.log('Error executing commands:', error);

  }
}

// Function to only allow L, F, R (Deleting the rest of the commands)

function checkIfValidCommand(command) {
  const text  = event.target.value.toUpperCase();
  const filteredText = text.replace(/[^LFR]/g, '');
  commands.value = filteredText;
  // Let user know why other commands are not working
  if (text !== filteredText) {
    inputErrorMessage.value = "F = Forward | L Left Turn | R = Right Turn";
  } else {
    inputErrorMessage.value = null;
  }
}

</script>

<template>
  <div className="flex flex-col items-center m-4 justify-center">
    <button className="m-4 bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded" 
      @click="onExecuteCommands">
      Execute Commands
    </button>
    <input 
    @input="checkIfValidCommand()"
      class="w-[150px] p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
      v-model="commands" 
      type="text" 
      placeholder="Enter commands" 
    />

    <p v-if="inputErrorMessage"
        class="mt-2 text-sm text-red-800"> 
        {{ inputErrorMessage }}
    </p>


  </div>
</template>

<style scoped>

</style>
