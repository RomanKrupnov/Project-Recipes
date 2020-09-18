<template>
    <div class="left__menu">
        <div class="logo-wrap"><router-link :to="{name: 'home'}" class="left__menu-link"><img src="/images/logo.png" alt="Logo" class="logo-img"></router-link></div>
        <div class="left__menu-wrap">
            <ul>
                <li class="left__menu-item"><router-link :to="{name: 'home'}" class="left__menu-link">Главная</router-link></li>
                <li class="left__menu-item"><router-link :to="{name: 'recipes', query: {page: 1}}" class="left__menu-link">Каталог рецептов</router-link></li>
                <li v-if="authenticated && user" class="left__menu-item"><router-link :to="{name: 'my-recipes', query: {page: 1}}" class="left__menu-link">Мои рецепты</router-link></li>
                <li v-if="authenticated && user" class="left__menu-item"><router-link :to="{name: 'add-recipe'}" class="left__menu-link">Добавить рецепт</router-link></li>
            </ul>
        </div>
        <div class="left__menu-social">
        </div>
    </div>
</template>

<script>
    export default {
        name: "LeftMenu",
        props: ['authenticated', 'user'],
    }
</script>
