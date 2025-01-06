<template>
    <div class="history-container">
        <h1>L'histoire de dantec market</h1>
        <div class="historia">
            <div class="historia-section">
                <img src="/images/dantecmarket1.1.jpg" alt="Image 1">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ut consectetur sapien. Pellentesque fermentum enim nec vehicula fermentum.</p>
            </div>
            <div class="historia-section">
                <p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed non nunc id risus posuere cursus.</p>
                <img src="/images/dantecmarket1.1.jpg" alt="Image 2">
            </div>
            <div class="historia-section">
                <img src="/images/dantecmarket1.1.jpg" alt="Image 3">
                <p>Nullam in felis ac enim fermentum hendrerit. Vivamus elementum velit at diam aliquam, et rhoncus purus scelerisque.</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    setup() {

    }
}
</script>

<style scoped>
.history-container {
    max-width: 80vh;
    margin: 20vh auto;
    h1{
        color: #FAFAFA;
        font-size: 5vh;
    }
}

.historia {
    display: flex;
    flex-direction: column;
}

.historia-section {
    margin-bottom: 4vh;
}

.historia-section p {
    margin-top: 2vh;
    font-size: 2.8vh;
    color: #FAFAFA;
}

.historia-section img {
    width: 100%;
    max-width: 50vh;
    margin-top: 2vh;
}
</style>