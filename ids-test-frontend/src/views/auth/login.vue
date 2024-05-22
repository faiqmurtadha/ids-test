<script setup>

</script>

<template>
  <div class="uk-container">
    <h1>Login</h1>
    <form @submit.prevent="login">
      <div class="uk-margin">
        <input class="uk-input" type="email" v-model="email" placeholder="Email">
      </div>
      <div class="uk-margin">
        <input class="uk-input" type="password" v-model="password" placeholder="Password">
      </div>
      <button class="uk-button uk-button-primary" type="submit">Login</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      formData: {
        email: '',
        password: ''
      }
    };
  },
  methods: {
    async login() {
      try {
        const response = await axios.post('https://localhost:8000/api/login', this.formData);
        console.log('Response:', response.data);
      } catch (error) {
        console.error('Error login:', error);
      }
    }
  }
}
</script>

<style scoped>
/* Gaya khusus untuk komponen Login */
</style>