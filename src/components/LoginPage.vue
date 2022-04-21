<template>
  <div class = "background">
  </div>
  <div class="main-container">
    <div class = "card">
      <div class = "heading">
        <h1>Company name</h1>
      </div>
      <div class = "username">
        <input type = "text" id = "user_name" placeholder = "username">
      </div>
      <div class = "password">
        <input type = "text" id = "password" placeholder = "password">
      </div>
      <div class = "buttons">
        <button>Login</button>
        <button>Sign up</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Login'
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.background {
  position: fixed;
  left: 0;
  right: 0;
  z-index: 1;
  height: 100vh;
  display: block;
  background-image: url('~@/assets/login-wall.jpg');
  filter: blur(8px);
}

.main-container {
  z-index: 32;
  position: relative;
  margin: 0px;
  padding: 0px;
  border: 0px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100vh;
}

.card {
  background-color: white;
  height: 40%;
  width: 50%;
  max-height: 400px;
  box-shadow: 0 4px 8px 0 grey;
  transition: 0.1s;
  padding: 10px;
}

input {
  height: 20%;
  width: 60%;
  padding: 10px;
  border-radius: 25px;
}

.heading {
  padding: 25px;
}

.username, .password {
  padding: 10px;
}

.buttons {
  display: flex;
  align-items: center;
  justify-content: center;
}

button {
  padding: 10px;
  margin: 20px;
  margin-top: 40px;
  width: 30%;
  border-radius: 25px;
  color: white;
  background-color: black;
}

button:hover {
  background-color: grey;
}
</style>
