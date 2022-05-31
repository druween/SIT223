<template>
  <Loginpage/>
</template>

<script>
import Loginpage from './components/LoginPage.vue'

export default {
  name: 'App',
  components: {
    Loginpage
  }
}
</script>

<style>
#app {
  margin: 0px;
  padding: 0px;
  font-family: Verdana, Geneva, Tahoma, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

body {
  margin: 0px;
}
</style>
