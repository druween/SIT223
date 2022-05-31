<template>
 <div class = "container">
     <div id = "logo">
         <h2>LOGO</h2>
     </div>
     <div id = "right">
         <button>Home</button>
         <button>About Us</button>
         <button>Recalls</button>
         <button>News</button>
         <button>My Account</button>
     </div>
 </div>
</template>

<script>
export default {
    name: "Nav"
}
</script>

<style scoped>
.container {
    height: 10vh;
    width: 100vw;
    display: flex;
    flex-direction: row;
    align-items: stretch;
    background-color: transparent;
}

#logo {
    margin-left: 5vw;
}

#right {
    flex: 1;
    display: flex;
    justify-content: right;
}

#right button {
    color: rgba(8, 164, 126, 25);
    background-color: rgb(235, 231, 231, .8);
    border-radius: 8px;
    height: 5vh;
    width: 10vw;
    min-width: 60px;
    margin-right: 1vw;
    margin-top: 1vh;
    margin-bottom: 1vh;
    border: none;
}

#right button:hover {
    background-color: white;
}

#right button:active {
    transform: translateY(0.5vh);
}
</style>