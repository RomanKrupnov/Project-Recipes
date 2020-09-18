<template>
    <div>
        <div class="message_div">
            <div v-if="error" class="alert alert-danger alert-dismissible fade show" role="alert">
                <p> {{ message }}</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

        </div>
        <div class="recipe__card" v-if="isAvalible">
            <div class="recipe__card-head" v-bind:style="{backgroundImage: 'url(' + recipe.recipe.photo_head + ')'}">
                <!--<div class="recipe__author">
                    <img src="" alt="" class="recipe__author-img">
                    <p class="recipe__author-name"></p>
                </div>-->
                <div class="recipe__icons">
                    <div class="recipe__icons-wrap">
                        <div class="recipe__icon">
                            <img src="/images/icons/clock.svg" class="recipe__icon-img">
                            <p class="recipe__icon-txt">{{ recipe.recipe.cooking_time }}&nbsp;мин</p>
                        </div>
                        <div class="recipe__icon">
                            <img src="/images/icons/kkal.svg" class="recipe__icon-img">
                            <p class="recipe__icon-txt">{{ recipe.recipe.difficulty }}&nbsp;</p>
                        </div>
                        <div class="recipe__icon">
                            <img src="/images/icons/runner.svg" class="recipe__icon-img">
                            <p class="recipe__icon-txt">{{ recipe.recipe.kkal }} ккал</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="recipe__text">
                <h1 class="recipe__card-name">{{ recipe.recipe.name }}</h1>
                <div class="recipe__products">
                    <ul class="recipe__products-list">
                        <li v-for="product in recipe.products">{{ product.name }} - {{ product.pivot.quantity }}</li>
                    </ul>
                </div>
                <div v-html="recipe.recipe.description" class="recipe__card-desc"></div>
                <div class="recipe__card-footer">
                    <div v-if="authenticated && user && usersRecipe" class="recipe__card-btns">
                        <img v-on:click="deleteRecipe()" src="/images/icons/delete.svg" alt=""
                             class="recipe__card-btn">
                        <router-link :to="{name: 'update-recipe'}">
                        <img src="/images/icons/edit.svg" alt="" class="recipe__card-btn">
                        </router-link>
                    </div>
                    <div>
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button  class="button" style="margin-left:100px;">
                                    Добавить рецепт в список
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="recipe__card-share">
                        <a href="" class="recipe__card-btn"></a>
                        <a href="" class="recipe__card-btn"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Recipe",
        title: 'Рецепт:',
        props: ['authenticated', 'user'],

        data() {
            return {
                loading: false,
                recipe: {},
                error: null,
                id: null,
                message: '',
                usersRecipe: false,
                isAvalible: false,

            };
        },

        created() {
            this.getRecipe();
            this.getUser();
            this.addMessage();
        },
        methods: {
            getRecipe() {
                this.loading = true;
                this.id = this.$route.params.id;
                axios
                    .get('/api/recipes/' + this.id)
                    .then(response => {
                        this.recipe = response.data;
                        if(this.isAvalible || this.recipe.recipe.is_active === 1) {
                            this.isAvalible = true;
                        }
                    })
                    .catch(error => {
                        this.error = true;
                        this.message = error.message;
                    });
            },

            getUser() {
                axios
                .get('/api/check-recipe/' + this.id)
                .then(response => {
                    this.usersRecipe = response.data.message;
                    console.log(this.usersRecipe);
                    if(this.usersRecipe){
                       this.isAvalible = true;
                       console.log("from user "+ this.isAvalible);
                    }
                    if(!this.isAvalible){
                        this.error = true;
                        this.message = "Публичный доступ к рецепту закрыт";
                    }

                })
                .catch(error => {
                    console.log(error);
                })
            },
            deleteRecipe() {
                axios
                    .delete('/api/recipes/delete/' + this.id)
                    .then(response => {
                        this.$router.push({name: 'my-recipes'})
                    })
                    .catch(error => {
                        this.error = true;
                        this.message = error.response.data.message;
                    })
            },
            addMessage() {
                if (typeof (this.$route.params.message) === 'undefined') {
                    return
                }

                this.error = true;
                this.message = this.$route.params.message
            }
        }
    }
</script>

<style scoped>

</style>
