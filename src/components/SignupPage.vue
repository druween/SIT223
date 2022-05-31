<template>
  <div class = "container">
    <div id = "left">
      <div id = "logo">
        <h1>LOGO</h1>
      </div>
      <div id = "text">
        <p>To keep connected with us please login with your personal info</p>
      </div>
      <div id = "sign-in">
        <button @click = "signin">SIGN IN</button>
      </div>
    </div>
    <div id = "right">
      <div id = "sign-uptext">
        <h1>Create Account</h1>
      </div>
      <div id = "info">
        <input v-model = "name" placeholder = "name" required>
        <input v-model = "email" placeholder= "&#9993; Email" required>
        <br>
        <input v-model = "pass" placeholder= "&#128274; Password" type = "password" required>
      </div>
      <div id = "sign-up">
        <button @click = "signup">SIGN UP</button>
      </div>
      <div id = "links">
        <p>Or connect with us on social media</p>
        <p>facebook</p>
        <p>instagram</p>
        <p>twitter</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Signup',
  data: function () {
    return {
    name: "",
    email: "",
    pass: ""
    }
  },
  methods: {
    signin() {
      console.log("sign in");
    },
    signup() {
      console.log("sign up with", this.name, " mail:", this.email, " with pass:", this.pass);
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.container {
  background: rgb(235, 231, 231);
  height: 100vh;
  width: 100vw;
  display:flex;
  flex-direction: row;
  justify-content: center;
  align-items: center;
}

#left, #right {
  height: 60vh;
  width: 40vw;
  max-width: 550px;
  max-height: 500px;
  display: flex;
  flex-direction: column;
  align-items: stretch;
  justify-content: center;
  border-radius: 25px;
}

#left {
  color: white;
  background-color: rgba(8, 164, 126, 25);
}

#left #logo {
  height: 4vh;
  width: 40vw;
  margin-top: 7.5vh;
  margin-bottom: 7.5vh;
  align-self: center;
}

#left #text {
  height: 4vh;
  width: 40vw;
  margin-top: 15vh;
  font-size: 15px;
  align-self: center;
}

#left button {
  height: 4vh;
  width: 15vw;
  margin-top: 7.5vh;
  margin-bottom: 7.5vh;
  color: white;
  background-color: rgba(8, 190, 150, 25);
  border:none;
  border-radius: 25px;
}

#left button:hover {
  background-color: rgba(8, 210, 180, 25);
}

#left button:active {
  transform: translateY(0.5vh);
}

#right {
  background-color: white;
}

#right #sign-intext {
  color: rgba(8, 164, 126, 25);
}

#right input {
  width: 75%;
  height: 4vh;
  border-radius: 25px;
  margin-top: 1vh;
  text-align: center;
  border: 0;
  background-color: rgb(240, 231, 231);
}

#right button {
  height: 4vh;
  width: 15vw;
  margin-top: 7.5vh;
  color: white;
  background-color: rgba(8, 190, 150, 25);
  border-color: white;
  border-radius: 25px;
  border: none;
}

#right button:hover {
  background-color: rgba(8, 210, 180, 25);
}

#right button:active {
  transform: translateY(0.5vh);
}

#links {
  align-items: center;
  font-size: 15px;
}

@media only screen and (max-width: 600px) {
  .container {
    flex-direction: column;
    height: auto;
    width: 100vw;
  }

  #left, #right {
    border-radius: 0;
    height: auto;
    width: 100vw;
  }

  #left #text, #right #sign-intext {
    width: 100vw;
  }

  #right input {
    width: 75vw;
  }

  #left button, #right button {
    width: 50vw;
  }
}
</style>