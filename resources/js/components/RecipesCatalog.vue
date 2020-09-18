<template>
    <div class="recipes__wrapper">
        <div class="recipes__filter">
            <select name="recipes-filter" id="recipes-filter" hidden>
                <option value="Новые рецепты"></option>
                <option value="Популярные"></option>
                <option value="Рекомендуем"></option>
            </select>
        </div>
        <div class="message_div">
            <div v-if="error" class="alert alert-danger alert-dismissible fade show" role="alert">
                <p> {{ message }}</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div v-if="visible" class="alert alert-warning alert-dismissible fade show" role="alert">
                <p>Нет доступных рецептов</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        <div style="margin-left:180px; margin-bottom:30px"><img src="/images/icons/image.png" alt="Banner"></div>
        <div class="recipes__grid">
            <div class="recipes__card" v-for="recipe in recipes">
                <router-link :to="{ name: 'show-recipe', params: {id: recipe.id}}" class="recipe__link">
                    <div class="card mb-3 ml-3 recipeCard">
                        <div class="row no-gutters">
                            <div class="col-md-6 recipe-card-img"
                                 v-bind:style="{ backgroundImage: 'url(' + recipe.photo_head +')', backgroundSize: 'cover' }">
                            </div>
                            <div class="col-md-6 d-flex flex-column recipe-card-txt">
                                <div class="card-body">
                                    <div class="card-title recipeTitle text-center mb-4">{{ recipe.name }}
                                    </div>
                                    <div class="d-flex mb-3 text-center">
                                        <div class="col-4 options mr-1 p-1">
                                            <img class="recipeIcon mr-1 mb-1" src="/images/icons/clock.svg"
                                                 alt="">{{
                                            recipe.cooking_time }} мин
                                        </div>
                                        <div class="col-4 options mr-1 p-1">
                                            <img class="recipeIcon mr-1 mb-1" src="/images/icons/kkal.svg"
                                                 alt="">{{ recipe.difficulty }}
                                        </div>
                                        <div class="col-4 options mr-1 p-1">
                                            <img class="recipeIcon mr-1 mb-1" src="/images/icons/runner.svg"
                                                 alt="ccal"> {{ recipe.kkal }}
                                        </div>
                                    </div>
                                    <p class="card-text ingredients text-justify" v-if="recipe.description.length<180">
                                        {{ recipe.description }} </p>
                                    <p class="card-text ingredients text-justify" v-else> {{
                                        recipe.description.substring(0,180)+"..." }} </p>
                                </div>
                                <div class="card-footer bg-transparent p-0 m-0">
                                    <div class="d-flex m-2 justify-content-between align-content-between">
                                        <div class="ml-2">
                                            <button class="bg-transparent border-0 footer_option"><img
                                                src="/images/like.png" alt=""></button>
                                            <span class="like">16</span></div>
                                        <div class="d-flex justify-content-between align-content-between">
                                            <button class="bg-transparent border-0 footer_option"><img
                                                src="/images/vk.png" alt=""></button>
                                            <button class="bg-transparent border-0 footer_option ml-3"><img
                                                src="/images/facebook.png" alt=""></button>
                                            <button class="bg-transparent border-0 footer_option ml-3"><img
                                                src="/images/odnoklassniki.png" alt=""></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </router-link>
            </div>
        </div>

        <paginate v-if="totalPages > 1"
                  :page-count="totalPages"
                  :page-range="3"
                  :margin-pages="2"
                  :click-handler="getReceipies"
                  :prev-text="'Prev'"
                  :next-text="'Next'"
                  :container-class="'pagination'"
                  :page-class="'page-item'">
        </paginate>

    </div>
</template>

<script>
    export default {
        name: "Recipes",
        title: "Рецепты",
        data() {
            return {
                recipes: null,
                error: null,
                page: this.$route.query.page,
                totalPages: 0,
                visible: false,
            };
        },
        created() {
            this.getReceipies(this.page);
        },
        methods: {
            getReceipies(pageNum) {
                this.error = null;
                this.recipes = null;

                if (typeof pageNum === 'undefined') {
                    pageNum = this.$route.query.page;
                }

                axios
                    .get('/api/recipes?page=' + pageNum)
                    .then(response => {

                        this.totalPages = response.data.last_page;

                        if (this.$route.query.page !== pageNum) {
                            this.$router.push({name: "recipes", query: {page: pageNum}});
                        }

                        if(response.data.data.length === 0) {
                            this.visible = true;
                        }

                        (this.recipes === null) ? this.recipes = response.data.data : this.recipes = null;
                    })
                    .catch(error => {
                        this.error = true;
                        this.message = error.message;
                    });
            },
        },
    }
</script>

<style>
    .pagination {

    }

    .page-item {
        padding: 0 10px;
        margin: 0 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
</style>
