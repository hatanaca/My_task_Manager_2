
<template>
  <div id="app">
    <h1>{{ title }}</h1>
    <p v-if="message">Mensagem do backend: {{ message }}</p>
    <p v-else>Carregando...</p>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import axios from 'axios';

export default defineComponent({
  name: 'App',
  data() {
    return {
      title: 'Projeto Fullstack Vue + Laravel',
      message: ''
    };
  },
  mounted() {
    // Altere a URL conforme o endereço do seu backend (se estiver usando docker, pode ser localhost na porta mapeada)
    axios.get('http://localhost:9000/hello')
      .then(response => {
        this.message = response.data.message;
      })
      .catch(error => {
        console.error('Erro ao buscar a mensagem:', error);
      });
  }
});
</script>

<style>
/* Estilizações simples */
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  text-align: center;
  margin-top: 60px;
}
</style>

