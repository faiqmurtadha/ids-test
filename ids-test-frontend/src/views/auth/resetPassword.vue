<script setup>

</script>

<template>
  <div class="uk-container">
    <h1>Reset Password</h1>
    <form @submit.prevent="reset">
      <div class="uk-margin">
        <input class="uk-input" type="password" v-model="old_password" placeholder="Old Password">
      </div>
      <div class="uk-margin">
        <input class="uk-input" type="password" v-model="password" placeholder="Password">
      </div>
      <div class="uk-margin">
        <input class="uk-input" type="password" v-model="password_confirmation" placeholder="Password Confirmation">
      </div>
      <button class="uk-button uk-button-primary" type="submit">Reset</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      formData: {
        old_password: '',
        password: '',
        password_confirmation: ''
      }
    };
  },
  methods: {
    async reset() {
      try {
        const response = await axios.post('https://localhost:8000/api/reset-password', this.formData);
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