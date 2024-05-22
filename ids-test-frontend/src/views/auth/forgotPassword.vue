<script setup>

</script>

<template>
  <div class="uk-container">
    <h1>Send Reset Password</h1>
    <form @submit.prevent="forgot">
      <div class="uk-margin">
        <input class="uk-input" type="email" v-model="email" placeholder="Email">
      </div>
      <button class="uk-button uk-button-primary" type="submit">Send</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      formData: {
        email: ''
      }
    };
  },
  methods: {
    async forgot() {
      try {
        const response = await axios.post('https://localhost:8000/api/send-password-reset-link', this.formData);
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