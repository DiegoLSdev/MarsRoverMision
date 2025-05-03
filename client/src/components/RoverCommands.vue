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
  <div className="border">
    <h2>Execute Commands</h2>
    <div>
        <label for="">Commands</label>
        <input v-model="commands" type="text" placeholder="Enter commands (e.g., FFLFFR)" />
        <button @click="onExecuteCommands"> Execute Commands</button>
    </div>

  </div>
</template>

<style scoped>

</style>
