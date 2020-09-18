<template>
    <agile v-if="isLoaded">
        <router-link :to="{name: 'show-recipe', params: {id: item.id}}" v-for="item in recipesData" :class="'slide slide--' + item.id" :key="item.id" v-bind:style="{ backgroundImage: 'url(' + item.photo_head + ')', backgroundSize: 'cover', backgroundRepeat: 'no-repeat'}">
                <h3 class="recipe__slider-txt">{{ item.name }}</h3>
        </router-link>
    </agile>
</template>

<script>
    export default {
        data: function () {
            return {
                recipesData: [],
                isLoaded: false
            }
        },
        created() {
            this.getSlider()
        },
        methods: {
            getSlider() {
                this.error = null;
                this.recipesData = null;

                axios
                    .get('/api/slider')
                    .then(response => {
                        (this.recipesData === null) ? this.recipesData = response.data : this.recipesData = null;
                        this.isLoaded = true
                    })
                    .catch(error => {
                        console.log(error);
                    });
            }
        }
    }
</script>

<style scoped>

</style>
