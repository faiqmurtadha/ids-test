<template>
  <div class="uk-container">
    <h1>Register</h1>
    <form @submit.prevent="register">
      <div class="uk-margin">
        <input class="uk-input" type="email" v-model="email" placeholder="Email">
      </div>
      <div class="uk-margin">
        <input class="uk-input" type="text" v-model="phone" placeholder="Phone">
      </div>
      <div class="uk-margin">
        <input class="uk-input" type="password" v-model="password" placeholder="Password">
      </div>
      <div class="uk-margin">
        <input class="uk-input" type="password" v-model="password_confirmation" placeholder="Password Confirmation">
      </div>
      <button class="uk-button uk-button-primary" type="submit">Register</button>
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
        phone: '',
        password: '',
        password_confirmation: ''
      }
    };
  },
  methods: {
    async register() {
      try {
        const response = await axios.post('https://localhost:8000/api/register', this.formData);
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