<template>
  <Nav/>
  <div class = "container">
      <div id = "search">
          <div id = "search-select">
              <input v-model = "manufacturer" placeholder = "Manufacturer">
              <input v-model = "year" placeholder = "Year">
              <input v-model = "make" placeholder = "Make">
              <input v-model = "model" placeholder = "Model">
          </div>
          <div id = "search-button">
              <button @click = "search">Search</button>
          </div>
      </div>
  </div>
  <div class = "content">
      <h3>Recent recalls</h3>
      <div id = "recent">
          <div class = "card" v-for = "item in items" v-bind:key = "item">
              <img :src = "image">
              <div id = "card-content">
                <h4>recall</h4>
                <p>recall from manufacturer</p>
                <button>Details</button>
              </div>
          </div>
      </div>
      <h3>News</h3>
      <div id = "news">
          <div class = "card" v-for = "item in items" v-bind:key = "item">
              <img :src = "image">
              <div id = "card-content">
                <h4>News</h4>
                <p>News from manufacturer</p>
                <button>Details</button>
              </div>
          </div>
      </div>
  </div>
</template>

<script>
import Nav from "./Navbar.vue"
import image from '@/assets/car.jpg'

export default {
    name: "Home",
    components: {
        Nav
    },
    data: function () {
        return {
            manufacturer: "",
            year: "",
            make: "",
            model: "",
            image: image,
            items: [1, 2, 3]
        }
    },
    methods: {
        search() {
            console.log(this.manufacturer, this.year, this.make, this.model);
        }
    }
}
</script>

<style scoped>
Nav {
    height: 10vh;
}

.container {
    background-color: rgba(8, 164, 126, 0.7);
    height: 8vh;
    width: 100vw;
}

#search {
    display: flex;
    align-items: center;
    justify-content: center;
    margin: none;
}

#search input {
    height: 3vh;
    width: 15vw;
    margin-left: 1vw;
    border: none;
    border-radius: 8px;
    text-align: center;
}

#search input:focus {
    outline: none;
}

#search button {
    margin-left: 1vw;
    height: 3vh;
    width: 10vw;
    border: none;
    border-radius: 8px;
    background-color: grey;
    color: white;
}

#search button:active {
    background-color: white;
}

.content {
    margin: 0;
    padding: 0;
    width: 100vw;
    background-color: rgba(8, 164, 126, 0.7);
    height: 100vh;
}

#recent, #news {
    display: flex;
    flex-direction: row;
    justify-content: left;
}

.card {
    width: auto;
    height: auto;
    background-color: white;
    color: rgb(66, 103, 178);
    margin-top: 5vh;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    transition: 0.1s;
    margin-right: 1vw;
    margin-left: 2vw;
    opacity: 0.8;
}

.card:hover {
    box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
}

h3 {
    text-align: left;
    color: white;
}

img {
    object-fit: contain;
}

.card button {
    height: 3vh;
    width: 10vw;
    border: none;
    border-radius: 8px;
    background-color: grey;
    color: white;
    margin-bottom: 1vh;
}

.card button:active {
    background-color: white;
}

</style>